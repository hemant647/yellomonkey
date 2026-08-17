<?php
// Contact Us Page
require_once 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type']) && $_POST['form_type'] === 'contact') {
    $name = trim($_POST['name'] ?? '');
    $company = trim($_POST['company'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $services = isset($_POST['services']) && is_array($_POST['services']) ? implode(', ', $_POST['services']) : '';

    if ($name && $email) {
        try {
            $db = getDB();
            $stmt = $db->prepare("INSERT INTO contacts (name, company, email, phone, services_requested) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $company, $email, $phone, $services]);
            
            // 1. Send HTML email notification to Admins
            $to = ADMIN_NOTIFICATION_EMAIL;
            $subject = "New Project Inquiry from $name ($company)";
            
            $admin_html = "
            <html>
            <head>
                <style>
                    body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #333; line-height: 1.6; }
                    .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 8px; background: #fafafa; }
                    .header { background: #ffc107; color: #111; padding: 15px 20px; border-radius: 6px 6px 0 0; text-align: center; }
                    .content { padding: 20px; background: #fff; border-radius: 0 0 6px 6px; }
                    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
                    th, td { padding: 12px; border-bottom: 1px solid #eee; text-align: left; }
                    th { color: #666; width: 120px; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h2 style='margin:0; font-size:20px; text-transform:uppercase;'>New Lead Received!</h2>
                    </div>
                    <div class='content'>
                        <p><strong>$name</strong> has just submitted a new project inquiry through the website.</p>
                        <table>
                            <tr><th>Name</th><td>$name</td></tr>
                            <tr><th>Company</th><td>$company</td></tr>
                            <tr><th>Email</th><td><a href='mailto:$email'>$email</a></td></tr>
                            <tr><th>Phone</th><td>$phone</td></tr>
                            <tr><th>Services</th><td>$services</td></tr>
                        </table>
                    </div>
                </div>
            </body>
            </html>";

            require_once 'includes/mailer.php';
            
            // Send to admins (sendMail handles comma-separated lists automatically)
            sendMail($to, $subject, $admin_html, $email);

            // 2. Send automated HTML Thank You email to User
            $user_subject = "Thank you for reaching out to Yellomonkey!";
            
            $user_html = "
            <html>
            <head>
                <style>
                    body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #111; line-height: 1.6; }
                    .container { max-width: 600px; margin: 0 auto; padding: 30px; border-radius: 12px; background: #1a1a1a; color: #f5f5f5; text-align: center; }
                    .header { margin-bottom: 25px; }
                    .btn { display: inline-block; padding: 12px 30px; background: #ffc107; color: #111; text-decoration: none; font-weight: bold; border-radius: 6px; text-transform: uppercase; letter-spacing: 1px; margin-top: 20px; }
                    .footer { margin-top: 40px; font-size: 12px; color: #888; }
                </style>
            </head>
            <body style='background:#f4f4f5; padding:20px;'>
                <div class='container'>
                    <div class='header'>
                        <h1 style='color:#ffc107; margin:0;'>YELLOMONKEY</h1>
                    </div>
                    <h2 style='font-size:24px; margin-top:0;'>Hello, $name!</h2>
                    <p style='font-size:16px; color:#ccc; max-width:400px; margin: 0 auto;'>
                        Thank you for reaching out to us. We have received your inquiry and our team is currently reviewing your details. 
                        We typically respond within 24 hours.
                    </p>
                    <p style='font-size:16px; color:#ccc; margin-top: 15px;'>
                        In the meantime, feel free to schedule a direct meeting with us!
                    </p>
                    <a href='https://calendly.com/995/usa-30-min-meet?month=2026-08' class='btn'>Book a Call Now</a>
                    
                    <div class='footer'>
                        &copy; " . date('Y') . " Yellomonkey Labs. All rights reserved.
                    </div>
                </div>
            </body>
            </html>";

            // Send to user
            sendMail($email, $user_subject, $user_html, 'info@yellomonkey.com');
            
            $message = "<div class='bg-green-500/20 text-green-400 p-4 rounded-lg mb-8 text-center border border-green-500/50 max-w-2xl mx-auto'>Thank you for your inquiry, $name! We'll get back to you shortly.</div>";
        } catch (PDOException $e) {
            $message = "<div class='bg-red-500/20 text-red-400 p-4 rounded-lg mb-8 text-center border border-red-500/50 max-w-2xl mx-auto'>An error occurred. Please try again later.</div>";
        }
    } else {
        $message = "<div class='bg-red-500/20 text-red-400 p-4 rounded-lg mb-8 text-center border border-red-500/50 max-w-2xl mx-auto'>Please fill in all required fields.</div>";
    }
}

include 'includes/header.php';
?>

<!-- Conversational Contact Form Section -->
<section class="min-h-screen py-24 bg-[#232323] relative flex items-center justify-center pt-32">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">
        
        <?php echo $message; ?>

        <div class="text-center mb-16">
            <h1 class="text-white text-4xl md:text-5xl font-black font-heading tracking-wide mb-4 uppercase">
                Let's Talk Business
            </h1>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                Fill out the form below and our team will get back to you within 24 hours to discuss your project.
            </p>
        </div>

        <div class="bg-[#1a1a1a] p-8 md:p-12 rounded-3xl border border-white/5 shadow-2xl">
            <form action="#" method="POST" class="space-y-8">
                <input type="hidden" name="form_type" value="contact">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Name -->
                    <div class="space-y-2">
                        <label for="name" class="text-white font-bold text-sm tracking-wider uppercase">Name</label>
                        <input type="text" id="name" name="name" placeholder="John Doe" class="w-full bg-[#2a2a2a] border border-white/10 rounded-xl px-5 py-4 text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all" required>
                    </div>
                    
                    <!-- Company -->
                    <div class="space-y-2">
                        <label for="company" class="text-white font-bold text-sm tracking-wider uppercase">Company / Website</label>
                        <input type="text" id="company" name="company" placeholder="Acme Inc" class="w-full bg-[#2a2a2a] border border-white/10 rounded-xl px-5 py-4 text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all" required>
                    </div>
                    
                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="text-white font-bold text-sm tracking-wider uppercase">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="john@example.com" class="w-full bg-[#2a2a2a] border border-white/10 rounded-xl px-5 py-4 text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all" required>
                    </div>
                    
                    <!-- Phone -->
                    <div class="space-y-2">
                        <label for="phone" class="text-white font-bold text-sm tracking-wider uppercase">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="(555) 123-4567" class="w-full bg-[#2a2a2a] border border-white/10 rounded-xl px-5 py-4 text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                    </div>
                </div>

                <!-- Services -->
                <div class="pt-4 space-y-4">
                    <label class="text-white font-bold text-sm tracking-wider uppercase block">What services are you interested in?</label>
                    <div class="flex flex-wrap gap-3">
                        <?php
                        $services = [
                            'Web Development', 'Website Design', 'Email Marketing', 
                            'Mobile App Development', 'Social Media Marketing', 
                            'Search Engine Marketing', 'PPC', 'SEO'
                        ];
                        foreach($services as $i => $service):
                        ?>
                        <label class="cursor-pointer">
                            <input type="checkbox" name="services[]" value="<?php echo htmlspecialchars($service); ?>" class="peer sr-only">
                            <div class="px-6 py-3 rounded-xl bg-[#2a2a2a] border border-white/10 text-white/70 text-sm hover:bg-[#333] peer-checked:bg-primary peer-checked:border-primary peer-checked:text-dark font-bold transition-all duration-200 select-none">
                                <?php echo $service; ?>
                            </div>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- Submit -->
                <div class="pt-8">
                    <button type="submit" class="w-full md:w-auto px-12 py-5 bg-primary text-dark font-black text-sm rounded-xl hover:bg-yellow-400 hover:shadow-[0_0_20px_rgba(255,193,7,0.3)] transition-all transform hover:-translate-y-1 uppercase tracking-widest flex items-center justify-center gap-3">
                        Submit Request
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
