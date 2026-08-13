<?php include 'includes/header.php'; ?>

<!-- Hero Section -->
<section class="relative pt-32 pb-20 md:pt-40 md:pb-32 overflow-hidden bg-white">
    <!-- Abstract graphic element -->
    <div class="absolute top-0 right-0 w-1/2 h-full bg-primary/10 rounded-l-[100px] pointer-events-none z-0 hidden lg:block"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            <!-- Text Content -->
            <div class="text-left">
                <div class="inline-block mb-4 px-4 py-1.5 rounded-full bg-primary/20 border border-primary/30 text-dark font-bold text-sm tracking-wider uppercase">
                    Our Services
                </div>
                <h1 class="font-heading text-6xl md:text-7xl lg:text-8xl font-black leading-tight mb-8 text-dark tracking-normal uppercase">
                    Inspiring New<br>
                    <span class="text-primary relative inline-block">
                        Opportunities
                        <svg class="absolute -bottom-2 left-0 w-full h-3 text-dark opacity-20" viewBox="0 0 100 10" preserveAspectRatio="none"><path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="4" fill="none"/></svg>
                    </span><br>
                    for Your Business
                </h1>
                
                <p class="text-dark/70 text-lg md:text-xl leading-relaxed mb-10 font-medium max-w-lg">
                    We are a diverse, flexible team with a passion for digital marketing, comprised of creative and motivated professionals. At Yellomonkey, we do not have hierarchical layers; instead, we focus on delivering a data-driven and individualized digital marketing service while attentively listening to the needs of our customers. We are transforming at the same rate as the world's best companies to maximize customer satisfaction and profitability for our clients.
                </p>

                <a href="#" class="inline-flex items-center justify-center px-10 py-5 bg-dark text-white font-bold text-lg rounded-xl hover:bg-black hover:shadow-2xl hover:shadow-dark/30 transition-all duration-300 transform hover:-translate-y-1 group">
                    <span class="mr-3">Let's Talk</span>
                    <span class="w-10 h-10 rounded-full bg-primary flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </span>
                </a>
            </div>

            <!-- Image Content -->
            <div class="relative mt-12 lg:mt-0">
                <div class="absolute -inset-4 bg-primary rounded-[40px] transform rotate-3 scale-105 opacity-20"></div>
                <div class="absolute -inset-4 bg-dark rounded-[40px] transform -rotate-2 scale-105 opacity-10"></div>
                <div class="relative rounded-[30px] overflow-hidden shadow-2xl border-4 border-white">
                    <img src="assets/images/cover-.webp" alt="Cool Results" class="w-full h-[600px] object-cover hover:scale-105 transition-transform duration-1000" onerror="this.src='https://images.unsplash.com/photo-1550751827-4bd374c3f58b?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80'">
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Services Grid Section -->
<section class="py-32 bg-gray-50 border-t border-gray-200 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="text-center mb-24">
            <h2 class="font-heading text-6xl md:text-7xl font-black text-dark inline-block relative tracking-tight">
                Our Services
                <div class="absolute -bottom-6 left-1/2 transform -translate-x-1/2 w-32 h-2 bg-primary rounded-full"></div>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $services = [
                ['title' => 'Website Development', 'icon' => 'WebDev_Black.bb715f10.svg.webp', 'desc' => 'We code the backend of our websites with efficient code to load quick, have your site secured, and easy to navigate. You\'ll always get an A or B grade with the metrics score, which will help you rank better on search engines.'],
                ['title' => 'Website Design', 'icon' => 'WebsiteDesign_Black.a4e5ae70.svg.webp', 'desc' => 'Our process creates an interactive user experience, with each section carefully designed to engage with users to have them click on the page and product. By creating hundreds of websites, we\'ve created a formula for success that brings in more traffic and engagement with lighting quick load speed.'],
                ['title' => 'Custom Web Development', 'icon' => 'desktop-application-app-icon.webp', 'desc' => 'We aid in the delivery of custom web development projects that support business processes and improve customer connections by analyzing the company’s preferences, wants, and domain requirements in depth'],
                
                ['title' => 'Search Engine Optimization', 'icon' => 'Vector-1.webp', 'desc' => 'SEO is an integral part of any companies growth strategy and through highly researched keywords and only white hat approaches we make sure to provide the best results to rank you on Google from local to international'],
                ['title' => 'Social Media Marketing', 'icon' => 'SMM_black.ad0ce79d.svg.webp', 'desc' => 'Working together with your creativity, we tailor make your social media campaigns that fit with your brand. Whether it\'s Instagram, Facebook, google or TikTok we sit down and listen to your end goal and collaborate to create a custom plan that fits you and your business.'],
                ['title' => 'Search Engine Marketing', 'icon' => 'Vector-2.webp', 'desc' => 'Search engine marketing, or SEM, is a type of digital marketing used to make a website visible on search engine results pages (SERPs). The term used to be used for both free and paid search activities, like search engine optimization'],
                
                ['title' => 'PPC Marketing', 'icon' => 'PPC_black.4383e0cf.svg.webp', 'desc' => 'PPC campaigns are a powerful tool to jumpstart your business by bringing quick results to your business or brand. With our carefully curated campaigns, we test your ads every 72 hours to make sure the proper keywords, landing pages, and advertising slogans are there to bring maximum ROA on your campaign'],
                ['title' => 'E-Mail Marketing', 'icon' => 'EmailMarketing_black.a75db5cb.svg.webp', 'desc' => 'Working together with your creativity, we tailor make your social media campaigns that fit with your brand. Whether it\'s Instagram, Facebook, google or TikTok we sit down and listen to your end goal and collaborate to create a custom plan that fits you and your business.'],
                ['title' => 'Local SEO', 'icon' => 'Vector-3.webp', 'desc' => 'In 2020, nearly half of all Google searches targeted local services and businesses. That\'s millions of potential customers looking for nearby businesses and local SEO can be used to connect them to the businesses in their backyard. That\'s what local SEO does.'],
                
                ['title' => 'Mobile App Development', 'icon' => 'AppDev_black.d5aafd5e.svg.webp', 'desc' => 'With our team of Mobile app developers, we will be able to create your vision into reality. No matter how simple or intricate, our creative team will walk you through the process step by step and provide a proper MVP.'],
                ['title' => 'iOS App Development', 'icon' => 'ios-icon-images-25.png', 'desc' => 'iOS app development services go beyond the creation of standalone applications. Yellomonkey Labs create apps that serve as third-party connectors for a wide range of applications, including healthcare, POS systems, and nearly anything else imaginable.'],
                ['title' => 'Android App Development', 'icon' => '4298553.png', 'desc' => 'We do not confine our services to Smartphones. Our Android mobile app development portfolio is a testament to our proficiency across numerous Android devices and platforms.'],
                
                ['title' => 'Content Marketing', 'icon' => 'Content_black.38635f13.svg.webp', 'desc' => 'Content marketing optimization is essential in today’s competitive digital landscape. With the abundance of content available online, companies need to stand out from the crowd by creating high-quality, relevant content that resonates with their target audience'],
                ['title' => 'E-Commerce Website', 'icon' => 'Vector-4.webp', 'desc' => 'Ecommerce website design and development services facilitate the creation of a superior ecommerce experience in order to attract today’s demanding consumers.'],
                ['title' => 'Custom Web Development', 'icon' => 'desktop-application-app-icon.webp', 'desc' => 'We aid in the delivery of custom web development projects that support business processes and improve customer connections by analyzing the company’s preferences, wants, and domain requirements in depth'],
                
                ['title' => 'Custom Website Design', 'icon' => 'monitor.png', 'desc' => 'In the digital world, making a good first impression is necessary. A great web design is one way to get people to visit your site. People like websites that look good and are easy to use. Let our web design team help you make a website that works on all devices and makes a good impression.'],
                ['title' => 'Graphic & Logo Design', 'icon' => 'Group.webp', 'desc' => 'Look around your office or home for a moment. How many logos do you see? And what do you think these logos mean? The design of your logo is one of the first steps in building your company\'s identity, image, and brand. The design of a logo is also often the first thing a customer notices about your business.'],
                ['title' => 'Responsive-Website-Design', 'icon' => 'desktop-application-app-icon.webp', 'desc' => 'Create a captivating online presence with our responsive website design services. Engage your audience across devices and boost your digital success.']
            ];
            
            foreach($services as $index => $service):
            ?>
            <div class="bg-white rounded-[24px] p-10 flex flex-col h-full group hover:-translate-y-2 transition-transform duration-500 shadow-xl shadow-gray-200/50 relative overflow-hidden border border-gray-100">
                
                <!-- Hover Glow -->
                <div class="absolute bottom-0 left-0 w-full h-1 bg-gray-200 group-hover:bg-primary transition-colors duration-500"></div>

                <div class="w-16 h-16 rounded-[18px] bg-primary/10 flex items-center justify-center mb-8 group-hover:bg-primary group-hover:rotate-6 transition-all duration-300">
                    <img src="assets/images/services/<?php echo $service['icon']; ?>" alt="<?php echo $service['title']; ?> Icon" class="w-8 h-8 object-contain filter brightness-0 opacity-80 group-hover:opacity-100 transition-all duration-300" onerror="this.style.display='none'">
                </div>
                
                <h3 class="text-2xl font-bold text-dark mb-4 tracking-tight"><?php echo $service['title']; ?></h3>
                
                <p class="text-dark/60 text-sm leading-relaxed mb-8 flex-grow font-medium">
                    <?php echo $service['desc']; ?>
                </p>
                
                <a href="#" class="inline-flex items-center text-dark font-bold text-sm uppercase tracking-wider group-hover:text-primary transition-colors mt-auto">
                    Know more
                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-32 bg-dark relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">
            
            <!-- Sticky Image Left Side -->
            <div class="relative lg:sticky lg:top-32 h-fit">
                <h2 class="font-heading text-5xl md:text-7xl font-black text-white mb-6 leading-tight tracking-tight">
                    Why Choose<br><span class="text-primary">Yellomonkey?</span>
                </h2>
                <p class="text-light/80 text-lg md:text-xl font-medium mb-12 max-w-lg">
                    Sometimes, you just need a little push in the right direction: With our experience in digital marketing, we help businesses grow by generating targeted traffic.
                </p>
                
                <div class="relative rounded-[30px] overflow-hidden p-2 group bg-white/5 border border-white/10">
                    <img src="assets/images/digi2-scaled.webp" alt="Team collaborating" class="w-full h-auto rounded-[20px] object-cover group-hover:scale-105 transition-transform duration-700">
                </div>
            </div>

            <!-- Accordion List Right Side -->
            <div class="space-y-6 pt-10 lg:pt-0">
                <?php
                $reasons = [
                    [
                        "title" => "We listen, suggest, and update",
                        "desc" => "Instead of trying to fit every business into a \"one size fits all\" product, we take the time to work with you to design a solution that fits like a glove."
                    ],
                    [
                        "title" => "Maximize Marketing ROI",
                        "desc" => "You can get an honest and measurable return on your investment by using the best SEO, Web Design, Social Media, and Reputation Management services."
                    ],
                    [
                        "title" => "Performance Monitoring",
                        "desc" => "Through different internet marketing, design, and development channels, our project managers promote transparency."
                    ],
                    [
                        "title" => "Commitment to Quality",
                        "desc" => "We pay close attention to our client's requests and deliver the agreed-upon space, time, and materials for the project."
                    ],
                    [
                        "title" => "Intellect and Experience",
                        "desc" => "Our team consists of highly qualified experts in many different areas of digital marketing and SEO domains. To provide world-class service and become a true business partner on every project."
                    ]
                ];
                foreach($reasons as $i => $reason):
                ?>
                <div class="group border-b border-white/10 pb-6 cursor-pointer">
                    <div class="flex justify-between items-center">
                        <h4 class="text-2xl font-bold text-white group-hover:text-primary transition-colors pr-8 leading-tight">
                            <span class="text-primary/50 text-sm font-mono mr-4 inline-block transform -translate-y-1">0<?php echo $i+1; ?></span>
                            <?php echo $reason['title']; ?>
                        </h4>
                        <div class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center group-hover:bg-primary group-hover:border-primary transition-colors shrink-0">
                            <svg class="w-4 h-4 text-white group-hover:text-dark transform group-hover:rotate-45 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                    </div>
                    <!-- Hidden description that expands on hover -->
                    <div class="grid grid-rows-[0fr] group-hover:grid-rows-[1fr] transition-all duration-300">
                        <p class="overflow-hidden text-light/70 text-base leading-relaxed pl-12 mt-0 group-hover:mt-6 transition-all duration-300 font-medium">
                            <?php echo $reason['desc']; ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-32 relative overflow-hidden flex items-center bg-cover bg-center bg-no-repeat" style="background-image: url('assets/images/CTA-1-scaled.webp'); min-height: 500px;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <div class="max-w-md text-dark pt-8">
            <h2 class="font-body text-4xl md:text-5xl font-bold leading-tight mb-4 tracking-tight">READY TO GROW YOUR BUSINESS?</h2>
            <p class="text-base md:text-lg font-bold mb-10 text-white drop-shadow-md">
                Contact us to work with a results-driven digital marketing agency
            </p>
            <div class="flex flex-row flex-wrap gap-4">
                <a href="#" class="inline-flex items-center justify-center px-8 py-3.5 bg-black text-primary font-bold rounded-lg hover:bg-gray-900 transition-colors tracking-wide text-sm shadow-md">
                    Get The Proposal
                </a>
                <a href="#" class="inline-flex items-center justify-center px-8 py-3.5 bg-black text-primary font-bold rounded-lg hover:bg-gray-900 transition-colors tracking-wide text-sm shadow-md">
                    Call Now
                </a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
