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
