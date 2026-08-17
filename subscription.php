<?php
// Design on Subscription Page

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="relative pt-32 pb-20 md:pt-40 md:pb-32 overflow-hidden bg-white">
    <div class="absolute top-0 right-0 w-1/2 h-full bg-primary/10 rounded-l-[100px] pointer-events-none z-0 hidden lg:block"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="text-left">
                <div class="inline-block mb-4 px-4 py-1.5 rounded-full bg-primary/20 border border-primary/30 text-dark font-bold text-sm tracking-wider uppercase">
                    Subscription
                </div>
                <h1 class="font-heading text-5xl md:text-6xl lg:text-7xl font-black leading-tight mb-6 text-dark tracking-normal uppercase">
                    Design Like a Boss <br>
                    <span class="text-primary relative inline-block">
                        With Your Personal Squad
                        <svg class="absolute -bottom-2 left-0 w-full h-3 text-dark opacity-20" viewBox="0 0 100 10" preserveAspectRatio="none"><path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="4" fill="none"/></svg>
                    </span>
                </h1>
                <p class="text-dark/70 text-lg md:text-xl leading-relaxed mb-10 font-medium max-w-xl">
                    Your Monthly Dose of Creative Power! Apps, websites, logos & more. The Entrepreneur's Design Dream Team.
                </p>
                <a href="#pricing" class="inline-flex items-center justify-center px-8 py-4 bg-dark text-white font-bold rounded-lg hover:bg-primary hover:text-dark transition-colors tracking-wide shadow-md">
                    View Subscriptions
                </a>
            </div>
            <div class="relative hidden lg:block">
                <div class="absolute -inset-4 bg-primary/20 rounded-[40px] transform rotate-3 scale-105"></div>
                <img src="assets/images/subscription/Asset-5-711x1024.png.webp" alt="Design on Subscription" class="relative w-full max-w-md mx-auto h-auto rounded-[30px] shadow-2xl border-4 border-white object-cover" onerror="this.src='https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80'">
            </div>
        </div>
    </div>
</section>

<!-- Value Proposition / Features Section -->
<section class="py-24 bg-dark relative border-t border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h2 class="font-heading text-4xl md:text-5xl font-black text-white inline-block relative tracking-tight mb-16">
            The Entrepreneur's Design Dream Team
            <div class="absolute -bottom-4 left-1/2 transform -translate-x-1/2 w-24 h-2 bg-primary rounded-full"></div>
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 text-left">
            <?php
            $features = [
                ['title' => 'Creativity + Innovation', 'img' => 'Figure-→-icon_1.png.webp', 'desc' => 'Our vibrant environment encourages best design practices and pushes creative boundaries.'],
                ['title' => 'Trusted Design Partnership', 'img' => 'Figure-→-icon_2.png-1.webp', 'desc' => 'We believe in strong partnerships with our clients, built on open communication and mutual respect, for the best design outcomes.'],
                ['title' => 'User Centric', 'img' => 'Figure-→-icon_3.png.webp', 'desc' => 'We prioritize understanding and exceeding the needs of our (and your) users in every design decision.'],
                ['title' => 'Real Result', 'img' => 'Figure-→-icon_4.png.webp', 'desc' => 'Our designs are driven by real results and user feedback, for a constantly evolving experience.'],
                ['title' => 'Design with Impact', 'img' => 'Figure-→-icon_5.png.webp', 'desc' => 'We believe in the power of designs to create positive changes in the world and your business.'],
                ['title' => 'Passion for Excellence', 'img' => 'Figure-→-icon_6.png.webp', 'desc' => 'Every member of our team is driven by a genuine love for design. This fuels our dedication to deliver and exceed your expectations.']
            ];
            
            foreach($features as $feat):
            ?>
            <div class="bg-card rounded-[24px] p-8 border border-white/5 hover:border-primary/50 transition-colors duration-300 group">
                <div class="mb-6">
                    <img src="assets/images/subscription/<?php echo $feat['img']; ?>" alt="<?php echo $feat['title']; ?>" class="h-16 w-16 object-contain filter brightness-0 invert opacity-80 group-hover:opacity-100 group-hover:brightness-100 group-hover:invert-0 transition-all" onerror="this.style.display='none'">
                </div>
                <h3 class="text-xl font-bold text-white mb-3 group-hover:text-primary transition-colors"><?php echo $feat['title']; ?></h3>
                <p class="text-light/60 text-sm leading-relaxed">
                    <?php echo $feat['desc']; ?>
                </p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section id="pricing" class="py-24 bg-gray-50 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h2 class="font-heading text-4xl md:text-5xl font-black text-dark inline-block relative tracking-tight mb-16">
            Our Subscriptions
            <div class="absolute -bottom-4 left-1/2 transform -translate-x-1/2 w-24 h-2 bg-primary rounded-full"></div>
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-5xl mx-auto">
            <!-- Tier 1 -->
            <div class="bg-white rounded-[30px] p-10 border-4 border-gray-100 shadow-xl relative overflow-hidden transition-transform duration-300 hover:-translate-y-2 text-left">
                <h3 class="text-2xl font-bold text-dark font-heading uppercase mb-2">Standard</h3>
                <div class="flex items-baseline mb-8">
                    <span class="text-5xl font-black text-dark tracking-tighter">$869</span>
                    <span class="text-dark/50 ml-2 font-bold">/mo</span>
                </div>
                
                <ul class="space-y-4 mb-10">
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-primary flex-shrink-0 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-dark/80 font-medium">One request at a time</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-primary flex-shrink-0 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-dark/80 font-medium">Average 48 hour delivery</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-primary flex-shrink-0 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-dark/80 font-medium">Unlimited brands</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-primary flex-shrink-0 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-dark/80 font-medium">Unlimited users</span>
                    </li>
                </ul>
                <a href="/contact" class="block w-full py-4 bg-dark text-white text-center font-bold rounded-lg hover:bg-gray-800 transition-colors uppercase tracking-wide">
                    Subscribe Now
                </a>
            </div>
            
            <!-- Tier 2 (Pro) -->
            <div class="bg-dark rounded-[30px] p-10 border-4 border-primary shadow-2xl relative overflow-hidden transition-transform duration-300 hover:-translate-y-2 text-left">
                <div class="absolute top-0 right-0 bg-primary text-dark font-black text-xs uppercase tracking-wider py-1 px-4 rounded-bl-lg">Recommended</div>
                <h3 class="text-2xl font-bold text-white font-heading uppercase mb-2">Pro</h3>
                <div class="flex items-baseline mb-8">
                    <span class="text-5xl font-black text-primary tracking-tighter">$1000</span>
                    <span class="text-light/50 ml-2 font-bold">/mo</span>
                </div>
                
                <ul class="space-y-4 mb-10">
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-primary flex-shrink-0 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-light/90 font-medium">Two requests at a time</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-primary flex-shrink-0 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-light/90 font-medium">Average 24-48 hour delivery</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-primary flex-shrink-0 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-light/90 font-medium">Unlimited brands</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-primary flex-shrink-0 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-light/90 font-medium">Unlimited users</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-primary flex-shrink-0 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-light/90 font-medium flex items-center">Priority support <span class="ml-2 bg-primary/20 text-primary text-xs px-2 py-0.5 rounded uppercase">Pro</span></span>
                    </li>
                </ul>
                <a href="/contact" class="block w-full py-4 bg-primary text-dark text-center font-bold rounded-lg hover:bg-primary/90 transition-colors uppercase tracking-wide">
                    Subscribe Now
                </a>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-24 bg-dark relative border-t border-white/5">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <h2 class="font-heading text-4xl md:text-5xl font-black text-white inline-block relative tracking-tight">
                Frequently Asked Questions
                <div class="absolute -bottom-4 left-1/2 transform -translate-x-1/2 w-24 h-2 bg-primary rounded-full"></div>
            </h2>
        </div>
        
        <div class="space-y-4">
            <?php
            $faqs = [
                "Why wouldn't I just hire a full-time designer?" => "Good question! For starters, the annual cost of a full-time senior-level designer now exceeds $100,000, plus benefits. You may not always have enough work to keep them busy at all times, so you're stuck paying for time you aren't able to utilize. With the monthly plan, you can pause and resume your subscription as often as you need.",
                "Is there a limit to how many requests I can have?" => "Once subscribed, you're able to add as many design requests to your queue as you'd like, and they will be delivered one by one.",
                "How fast will I receive my designs?" => "On average, most requests are completed in just two days or less. However, more complex requests can take longer.",
                "What if I don't like the design?" => "No worries! We'll continue to revise the design until you're 100% satisfied.",
                "How does the pause feature work?" => "Billing cycles are based on 31 day period. If you use the service for 21 days, and then decide to pause your subscription, you'll have 10 days of service remaining to be used anytime in the future."
            ];
            
            foreach($faqs as $q => $a):
            ?>
            <details class="bg-card rounded-xl border border-white/5 group open:border-primary/50 transition-colors">
                <summary class="flex justify-between items-center font-bold cursor-pointer list-none p-6 text-white group-open:text-primary transition-colors">
                    <span><?php echo $q; ?></span>
                    <span class="transition group-open:rotate-180">
                        <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg>
                    </span>
                </summary>
                <div class="text-light/60 px-6 pb-6 text-sm leading-relaxed">
                    <?php echo $a; ?>
                </div>
            </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA Section (Reused) -->
<section class="py-32 relative overflow-hidden flex items-center bg-cover bg-center bg-no-repeat" style="background-image: url('assets/images/CTA-1-scaled.webp'); min-height: 500px;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full text-center md:text-left">
        <div class="max-w-xl mx-auto md:mx-0 text-dark pt-8">
            <h2 class="font-body text-4xl md:text-5xl font-bold leading-tight mb-4 tracking-tight">Let's talk about your design dreams</h2>
            <p class="text-base md:text-lg font-bold mb-10 text-white drop-shadow-md">
                Explore design possibilities with Yellow Monkey Labs. No pressure, just results.
            </p>
            <div class="flex flex-row flex-wrap justify-center md:justify-start gap-4">
                <a href="https://calendly.com/995/usa-30-min-meet?month=2026-08" target="_blank" class="inline-flex items-center justify-center px-8 py-3.5 bg-black text-primary font-bold rounded-lg hover:bg-gray-900 transition-colors tracking-wide text-sm shadow-md">
                    Book a Meeting
                </a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
