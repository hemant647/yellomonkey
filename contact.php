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
            
            // Send email notification
            $to = ADMIN_NOTIFICATION_EMAIL;
            $subject = "New Contact Inquiry from $name";
            $email_content = "You have received a new contact inquiry:\n\n";
            $email_content .= "Name: $name\n";
            $email_content .= "Company: $company\n";
            $email_content .= "Email: $email\n";
            $email_content .= "Phone: $phone\n";
            $email_content .= "Services Requested: $services\n";
            
            $headers = "From: " . SMTP_EMAIL_FROM . "\r\n";
            $headers .= "Reply-To: $email\r\n";
            
            mail($to, $subject, $email_content, $headers);
            
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
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">
        
        <?php echo $message; ?>

        <h1 class="text-center text-white text-2xl md:text-3xl font-bold font-heading mb-16 tracking-wide">
            Hello, Yellomonkey Team!,
        </h1>

        <form action="#" method="POST" class="space-y-12">
            <input type="hidden" name="form_type" value="contact">
            
            <!-- Row 1: Name & Company -->
            <div class="flex flex-col md:flex-row md:items-end gap-6 md:gap-12">
                <div class="flex-1 flex flex-col md:flex-row md:items-end gap-4">
                    <label for="name" class="text-white text-lg font-bold whitespace-nowrap mb-2 md:mb-0">My name is</label>
                    <input type="text" id="name" name="name" placeholder="Your Name" class="w-full bg-transparent border-0 border-b border-gray-500 text-light/80 placeholder-gray-500 focus:ring-0 focus:border-white focus:outline-none transition-colors pb-2 px-0 text-lg" required>
                </div>
                
                <div class="flex-1 flex flex-col md:flex-row md:items-end gap-4 mt-6 md:mt-0">
                    <label for="company" class="text-white text-lg font-bold whitespace-nowrap mb-2 md:mb-0">from</label>
                    <input type="text" id="company" name="company" placeholder="Website or company name" class="w-full bg-transparent border-0 border-b border-gray-500 text-light/80 placeholder-gray-500 focus:ring-0 focus:border-white focus:outline-none transition-colors pb-2 px-0 text-lg" required>
                </div>
            </div>

            <!-- Row 2: Email & Phone -->
            <div class="flex flex-col md:flex-row md:items-end gap-6 md:gap-12">
                <div class="flex-1 flex flex-col md:flex-row md:items-end gap-4">
                    <label for="email" class="text-white text-lg font-bold whitespace-nowrap mb-2 md:mb-0">Email ID</label>
                    <input type="email" id="email" name="email" placeholder="Your email" class="w-full bg-transparent border-0 border-b border-gray-500 text-light/80 placeholder-gray-500 focus:ring-0 focus:border-white focus:outline-none transition-colors pb-2 px-0 text-lg" required>
                </div>
                
                <div class="flex-1 flex flex-col md:flex-row md:items-end gap-4 mt-6 md:mt-0 md:pl-16">
                    <input type="tel" id="phone" name="phone" placeholder="Your contact number" class="w-full bg-transparent border-0 border-b border-gray-500 text-light/80 placeholder-gray-500 focus:ring-0 focus:border-white focus:outline-none transition-colors pb-2 px-0 text-lg">
                </div>
            </div>

            <!-- Row 3: Services -->
            <div class="flex flex-col md:flex-row gap-6 md:gap-12 mt-16 pt-8">
                <div class="md:w-48 flex-shrink-0">
                    <label class="text-white text-lg font-bold block mb-4 md:mb-0">Service Request</label>
                </div>
                
                <div class="flex-1 flex flex-wrap gap-3">
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
                        <div class="px-5 py-2.5 rounded-full bg-[#4a4a4a] text-white/90 text-sm hover:bg-[#5a5a5a] peer-checked:bg-primary peer-checked:text-dark font-medium transition-all duration-200 select-none">
                            <?php echo $service; ?>
                        </div>
                    </label>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Row 4: reCAPTCHA & Submit -->
            <div class="flex flex-col items-center justify-center mt-24 relative pt-12">
                <!-- Mock reCAPTCHA for visual matching -->
                <div class="absolute left-0 top-12 hidden md:block">
                    <div class="bg-white border border-gray-300 rounded shadow-sm p-3 flex items-center space-x-4">
                        <div class="w-6 h-6 border-2 border-gray-300 rounded-sm bg-white"></div>
                        <span class="text-sm font-medium text-gray-700">I'm not a robot</span>
                        <div class="flex flex-col items-center justify-center ml-8 opacity-70">
                            <svg class="w-6 h-6 text-blue-500 mb-1" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/></svg>
                            <span class="text-[10px] text-gray-500 leading-none">reCAPTCHA</span>
                            <span class="text-[8px] text-gray-400 leading-none">Privacy - Terms</span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-48 h-48 bg-primary text-dark font-medium text-xl uppercase tracking-wider rounded-full hover:scale-105 hover:bg-yellow-400 transition-all duration-300 shadow-[0_0_40px_rgba(255,214,0,0.3)] hover:shadow-[0_0_60px_rgba(255,214,0,0.5)]">
                    Submit
                </button>
            </div>

        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
