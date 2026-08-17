<?php
require_once 'config.php';
session_start();

$error = '';
$redirect_url = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Basic CSRF
    $csrf = $_POST['csrf_token'] ?? '';
    if (!verify_csrf_token($csrf)) {
        $error = "Invalid security token.";
    } else {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $amount = (float)($_POST['amount'] ?? 0);
        $notes = trim($_POST['notes'] ?? '');

        if (!$name || !$email || $amount <= 0) {
            $error = "Please fill in all required fields and provide a valid amount.";
        } else {
            try {
                $db = getDB();
                
                // 1. Insert into database as 'pending'
                $stmt = $db->prepare("INSERT INTO payments (name, email, amount, notes, payment_status) VALUES (?, ?, ?, ?, 'pending')");
                $stmt->execute([$name, $email, $amount, $notes]);
                $payment_id = $db->lastInsertId();

                // 2. Create Stripe Checkout Session via cURL
                $stripe_secret = STRIPE_SECRET_KEY;
                $success_url = "http://" . $_SERVER['HTTP_HOST'] . "/pay_success?session_id={CHECKOUT_SESSION_ID}";
                $cancel_url = "http://" . $_SERVER['HTTP_HOST'] . "/pay_cancel";

                $ch = curl_init('https://api.stripe.com/v1/checkout/sessions');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_USERPWD, $stripe_secret . ':');
                
                $data = http_build_query([
                    'payment_method_types' => ['card'],
                    'line_items' => [
                        [
                            'price_data' => [
                                'currency' => 'usd',
                                'product_data' => [
                                    'name' => 'Custom Payment - YelloMonkey Labs',
                                    'description' => "Payment from " . $name . ($notes ? " (" . $notes . ")" : "")
                                ],
                                'unit_amount' => intval($amount * 100), // Stripe expects cents
                            ],
                            'quantity' => 1,
                        ]
                    ],
                    'mode' => 'payment',
                    'success_url' => $success_url,
                    'cancel_url' => $cancel_url,
                    'client_reference_id' => $payment_id,
                    'customer_email' => $email
                ]);

                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                $response = curl_exec($ch);
                curl_close($ch);

                $result = json_decode($response, true);

                if (isset($result['id']) && isset($result['url'])) {
                    // Update DB with session ID
                    $stmt = $db->prepare("UPDATE payments SET stripe_session_id = ? WHERE id = ?");
                    $stmt->execute([$result['id'], $payment_id]);

                    // Redirect to Stripe Checkout
                    header("Location: " . $result['url']);
                    exit;
                } else {
                    $error = "Stripe Error: " . ($result['error']['message'] ?? 'Unknown error occurred.');
                }
            } catch (Exception $e) {
                $error = "System Error: " . $e->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay Now - YelloMonkey Labs</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FFC107',
                        dark: '#111111',
                        darker: '#0a0a0a',
                        card: '#1c1c1c',
                        light: '#F9FAFB',
                        muted: '#9CA3AF'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-darker min-h-screen text-light font-sans antialiased">
    
    <!-- Header simple -->
    <header class="absolute top-0 left-0 w-full z-50 p-6">
        <a href="/" class="block">
            <img src="/assets/images/Vector-120x15.webp" alt="YelloMonkey" class="h-6 object-contain">
        </a>
    </header>

    <div class="flex flex-col lg:flex-row min-h-screen">
        
        <!-- Left Side: Branding -->
        <div class="hidden lg:flex lg:w-1/2 bg-dark flex-col justify-center px-12 xl:px-24 relative overflow-hidden">
            <!-- decorative bg image could go here -->
            <div class="absolute inset-0 opacity-10" style="background-image: url('/assets/images/about-header-bg.webp'); background-size: cover; background-position: center;"></div>
            <div class="relative z-10">
                <h1 class="text-5xl xl:text-6xl font-black text-white uppercase tracking-wider mb-6 leading-tight">
                    Digital Marketing<br>Agency
                </h1>
                <div class="bg-card/80 backdrop-blur border border-white/10 p-8 rounded-2xl max-w-lg mt-8 shadow-2xl">
                    <h2 class="text-2xl font-bold text-white mb-4">Stellar Experience In Digital Marketing</h2>
                    <p class="text-muted text-sm leading-relaxed mb-6">
                        Yellomonkey Labs is a creative digital marketing agency based in Houston, Texas. We help businesses experience phenomenal growth with our innovative and effective digital marketing strategies.
                    </p>
                    <a href="/contact" class="inline-block px-6 py-2 bg-primary text-dark font-bold text-xs uppercase tracking-wider rounded-md hover:bg-yellow-400 transition-colors">Let's Talk</a>
                </div>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="w-full lg:w-1/2 bg-white flex flex-col justify-center px-6 py-24 sm:px-12 lg:px-24">
            
            <div class="max-w-md w-full mx-auto">
                <h2 class="text-3xl font-black text-dark uppercase tracking-wider mb-8 text-center lg:text-left">Pay Now</h2>
                
                <?php if ($error): ?>
                    <div class="bg-red-50 text-red-500 border border-red-200 p-4 rounded-md text-sm mb-6 font-medium">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" class="space-y-5">
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generate_csrf_token()); ?>">
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Name *</label>
                        <input type="text" name="name" required placeholder="Your Name" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-gray-900 transition-all">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email Address *</label>
                        <input type="email" name="email" required placeholder="Email Address" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-gray-900 transition-all">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Custom Payment Amount *</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="text-gray-500 font-medium">$</span>
                            </div>
                            <input type="number" step="0.01" min="1" name="amount" id="payment_amount" required placeholder="0.00" class="w-full pl-8 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-gray-900 transition-all">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Notes:</label>
                        <textarea name="notes" rows="4" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-gray-900 transition-all"></textarea>
                    </div>
                    
                    <button type="submit" class="w-full py-4 bg-[#3B99FC] text-white font-bold rounded-md hover:bg-blue-500 transition-colors uppercase tracking-wider shadow-lg flex items-center justify-center gap-2 mt-4" id="submit_btn">
                        Register And Pay <span id="btn_amount">$0</span>
                    </button>
                    
                    <p class="text-center text-xs text-gray-500 mt-4 flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                        Payments are securely processed by Stripe.
                    </p>
                </form>
            </div>
        </div>
    </div>

    <script>
        const amountInput = document.getElementById('payment_amount');
        const btnAmount = document.getElementById('btn_amount');
        
        amountInput.addEventListener('input', function() {
            const val = parseFloat(this.value);
            if (!isNaN(val) && val > 0) {
                // format to 2 decimal places if needed, but for display round is often fine
                btnAmount.textContent = '$' + val.toLocaleString('en-US', {minimumFractionDigits: 0, maximumFractionDigits: 2});
            } else {
                btnAmount.textContent = '$0';
            }
        });
    </script>
</body>
</html>
