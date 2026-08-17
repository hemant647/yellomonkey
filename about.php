<?php
// About Us Page

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="relative pt-32 pb-20 md:pt-40 md:pb-32 overflow-hidden bg-white">
    <div class="absolute top-0 right-0 w-1/2 h-full bg-primary/10 rounded-l-[100px] pointer-events-none z-0 hidden lg:block"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="text-left">
                <div class="inline-block mb-4 px-4 py-1.5 rounded-full bg-primary/20 border border-primary/30 text-dark font-bold text-sm tracking-wider uppercase">
                    About Us
                </div>
                <h1 class="font-heading text-6xl md:text-7xl lg:text-8xl font-black leading-tight mb-8 text-dark tracking-normal uppercase">
                    Choose Wisely <br>
                    <span class="text-primary relative inline-block">
                        With No Regrets
                        <svg class="absolute -bottom-2 left-0 w-full h-3 text-dark opacity-20" viewBox="0 0 100 10" preserveAspectRatio="none"><path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="4" fill="none"/></svg>
                    </span>
                </h1>
                <p class="text-dark/70 text-lg md:text-xl leading-relaxed mb-10 font-medium max-w-xl">
                    Make the right choice for your future. We offer top-notch internet marketing services, specializing in creating customized strategies to drive online success for businesses.
                </p>
            </div>
            <div class="relative hidden lg:block">
                <div class="absolute -inset-4 bg-primary/20 rounded-[40px] transform rotate-3 scale-105"></div>
                <img src="assets/images/about/b2.webp" alt="About Us Banner" class="relative w-full h-auto rounded-[30px] shadow-2xl border-4 border-white object-cover">
            </div>
        </div>
    </div>
</section>

<!-- Our Mission Section -->
<section class="py-24 bg-dark relative border-t border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="relative">
                <div class="absolute -inset-4 bg-primary rounded-[40px] transform -rotate-3 scale-105 opacity-20"></div>
                <div class="relative rounded-[30px] overflow-hidden shadow-2xl border-4 border-white/10">
                    <img src="assets/images/about/b3.webp" alt="Our Mission" class="w-full h-auto object-cover hover:scale-105 transition-transform duration-1000" onerror="this.src='https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80'">
                </div>
            </div>
            <div>
                <h2 class="font-heading text-5xl md:text-6xl font-black text-white inline-block relative tracking-tight mb-8">
                    Our Mission
                    <div class="absolute -bottom-4 left-0 w-16 h-2 bg-primary rounded-full"></div>
                </h2>
                <p class="text-light/70 text-lg leading-relaxed mb-8 font-medium">
                    At Yellomonkey Labs, our mission is to deliver data-driven and individualized digital marketing services while attentively listening to the needs of our customers. We are transforming at the same rate as the world's best companies to maximize customer satisfaction and profitability for our clients.
                </p>
                <div class="grid grid-cols-2 gap-6 mt-12">
                    <div class="border-l-4 border-primary pl-4">
                        <h4 class="text-3xl font-bold text-white mb-2 font-heading">150+</h4>
                        <p class="text-sm text-light/60 font-bold uppercase tracking-wider">Projects Delivered</p>
                    </div>
                    <div class="border-l-4 border-primary pl-4">
                        <h4 class="text-3xl font-bold text-white mb-2 font-heading">98%</h4>
                        <p class="text-sm text-light/60 font-bold uppercase tracking-wider">Client Satisfaction</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-24 bg-gray-50 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h2 class="font-heading text-5xl md:text-6xl font-black text-dark inline-block relative tracking-tight mb-8">
            Why Choose Us?
            <div class="absolute -bottom-4 left-1/2 transform -translate-x-1/2 w-24 h-2 bg-primary rounded-full"></div>
        </h2>
        <h3 class="text-3xl font-bold text-dark mb-6">You're Unstoppable With Yellomonkey Labs by your side!</h3>
        <p class="text-dark/70 text-lg leading-relaxed max-w-4xl mx-auto font-medium">
            There are many reasons why you should choose to work with Yellomonkey Labs. We are experienced and hyper-focused on your success, which means we will bring you the most efficient and visible results. Additionally, we are transparent and keep our clients informed of every step in their growth process. We adapt to our client’s needs, creating customized solutions that yield precisely the success they are seeking. As a team of doers, we believe anything is possible!
        </p>
    </div>
</section>

<!-- Our Process -->
<section class="py-24 bg-dark relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <h2 class="font-heading text-5xl md:text-6xl font-black text-white inline-block relative tracking-tight">
                Our Process
                <div class="absolute -bottom-4 left-1/2 transform -translate-x-1/2 w-24 h-2 bg-primary rounded-full"></div>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $steps = [
                ['title' => 'Understand', 'img' => '1-1.webp', 'desc' => 'We ensure that your website is not like any other website on the internet- ensuring that it is truly unique to you and your brand. We want you to stand out from the rest!'],
                ['title' => 'Design', 'img' => '2-2.webp', 'desc' => 'Now that we understand your project and requirements, we strive to create a unique and effective design that will stand out and deliver your message.'],
                ['title' => 'Develop', 'img' => '3-1.webp', 'desc' => 'Our team of developers brings you the best in business with their top-notch skills and unique approach to development. We develop what has been designed based on your requirements.'],
                ['title' => 'Review', 'img' => '4-1.webp', 'desc' => 'We take your feedback and develop a website that caters to your specific needs, ensuring that it is different from any other site on the web.'],
                ['title' => 'Optimize', 'img' => '5-1.webp', 'desc' => 'We optimize your platform for speed, SEO, and user experience, guaranteeing that you not only look great but perform flawlessly under pressure.'],
                ['title' => 'Go Live', 'img' => '6-1.webp', 'desc' => 'We go live with your site only after we have taken a strong look at every step, every part of the process, and are sure you like it too!']
            ];
            
            foreach($steps as $i => $step):
            ?>
            <div class="bg-card rounded-[24px] p-8 border border-white/5 hover:border-primary/50 transition-colors duration-300 group">
                <div class="flex items-center mb-6">
                    <div class="text-primary/20 text-6xl font-heading font-black mr-4 group-hover:text-primary transition-colors">
                        0<?php echo $i+1; ?>
                    </div>
                    <img src="assets/images/about/<?php echo $step['img']; ?>" alt="<?php echo $step['title']; ?>" class="h-16 w-16 object-contain filter brightness-0 invert opacity-80 group-hover:opacity-100 transition-opacity" onerror="this.style.display='none'">
                </div>
                <h3 class="text-2xl font-bold text-white mb-4"><?php echo $step['title']; ?></h3>
                <p class="text-light/60 text-sm leading-relaxed">
                    <?php echo $step['desc']; ?>
                </p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Technologies We Use -->
<section class="py-24 bg-white relative border-t border-gray-100 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center mb-12">
        <h2 class="font-heading text-4xl md:text-5xl font-black text-dark inline-block relative tracking-tight">
            Technologies We Use
        </h2>
    </div>
    
    <!-- Simple Marquee Setup -->
    <div class="relative w-full overflow-hidden flex" style="background: transparent;">
        <div class="animate-marquee whitespace-nowrap flex items-center space-x-16 py-4">
            <?php
            // The downloaded SVG tech logos
            $techs = [
                'TB_2.35f6d555.svg-150x150.webp', 'TB_3.25d20d86.svg-150x150.webp', 
                'TB_6.8b920359.svg-150x150.webp', 'TB_7.55551d6a.svg-150x150.webp',
                'TB_10.2e624e99.svg-150x150.webp', 'TB_11.beaa3ed7.svg-150x150.webp',
                'TB_13.4424a106.svg-150x150.webp', 'TB_14.e61a30bb.svg-150x150.webp',
                'TB_15.db25a35c.svg-150x150.webp', 'TB_17.f4dab599.svg-150x150.webp',
                'TB_18.cc6bed82.svg-150x150.webp'
            ];
            
            // Output twice for seamless loop
            for($loop = 0; $loop < 2; $loop++) {
                foreach($techs as $tech) {
                    echo '<img src="assets/images/about/' . $tech . '" alt="Tech Logo" class="h-16 md:h-20 w-auto object-contain filter grayscale hover:grayscale-0 transition-all duration-300 mx-8">';
                }
            }
            ?>
        </div>
    </div>
</section>

<style>
/* Simple CSS Marquee Animation */
@keyframes marquee {
  0% { transform: translateX(0); }
  100% { transform: translateX(-50%); } /* Shift by exactly half since we duplicate the content */
}
.animate-marquee {
  animation: marquee 20s linear infinite;
}
.animate-marquee:hover {
  animation-play-state: paused;
}
</style>

<!-- CTA Section (Reused) -->
<section class="py-32 relative overflow-hidden flex items-center bg-cover bg-center bg-no-repeat" style="background-image: url('assets/images/CTA-1-scaled.webp'); min-height: 500px;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <div class="max-w-md text-dark pt-8">
            <h2 class="font-body text-4xl md:text-5xl font-bold leading-tight mb-4 tracking-tight">READY TO GROW YOUR BUSINESS?</h2>
            <p class="text-base md:text-lg font-bold mb-10 text-white drop-shadow-md">
                Contact us to work with a results-driven digital marketing agency
            </p>
            <div class="flex flex-row flex-wrap gap-4">
                <a href="/client-form" class="inline-flex items-center justify-center px-8 py-3.5 bg-black text-primary font-bold rounded-lg hover:bg-gray-900 transition-colors tracking-wide text-sm shadow-md">
                    Get The Proposal
                </a>
                <a href="https://calendly.com/995/usa-30-min-meet?month=2026-08" target="_blank" class="inline-flex items-center justify-center px-8 py-3.5 bg-black text-primary font-bold rounded-lg hover:bg-gray-900 transition-colors tracking-wide text-sm shadow-md">
                    Call Now
                </a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
