<?php
// Testimonials Page

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="relative pt-32 pb-20 md:pt-40 md:pb-32 overflow-hidden bg-white">
    <div class="absolute top-0 left-0 w-1/2 h-full bg-primary/10 rounded-r-[100px] pointer-events-none z-0 hidden lg:block"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10 text-center">
        <div class="inline-block mb-4 px-4 py-1.5 rounded-full bg-primary/20 border border-primary/30 text-dark font-bold text-sm tracking-wider uppercase">
            Client Success
        </div>
        <h1 class="font-heading text-6xl md:text-7xl lg:text-8xl font-black leading-tight mb-8 text-dark tracking-normal uppercase">
            Our <br>
            <span class="text-primary relative inline-block">
                Testimonials
                <svg class="absolute -bottom-2 left-0 w-full h-3 text-dark opacity-20" viewBox="0 0 100 10" preserveAspectRatio="none"><path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="4" fill="none"/></svg>
            </span>
        </h1>
        <p class="text-dark/70 text-lg md:text-xl leading-relaxed mb-10 font-medium max-w-2xl mx-auto">
            Don't just take our word for it. Hear directly from our clients about how Yellomonkey Labs transformed their businesses and delivered cool results.
        </p>
    </div>
</section>

<!-- Testimonials Grid -->
<section class="py-24 bg-dark relative border-t border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            <?php
            $testimonials = [
                ['title' => 'Cool Results | Yellomonkey Labs', 'yt_id' => 'slVjL1VNHzQ'],
                ['title' => 'Serenity Community Health', 'yt_id' => 'mCfcsdGPNfs'],
                ['title' => 'Hook Optics', 'yt_id' => 'o-HlxnpP_iA'],
                ['title' => 'Client Testimonial', 'yt_id' => 'XMFC4UOFDZY'],
                ['title' => 'Client Success Story', 'yt_id' => 'VN9Rjty0eqs']
            ];

            foreach($testimonials as $testim):
            ?>
            <div class="bg-card rounded-[30px] overflow-hidden shadow-2xl border-4 border-white/5 hover:border-primary/50 transition-colors duration-500 group flex flex-col h-full">
                <!-- Video Container (16:9 Aspect Ratio) -->
                <div class="relative w-full pt-[56.25%] bg-black">
                    <iframe 
                        class="absolute top-0 left-0 w-full h-full border-0" 
                        src="https://www.youtube.com/embed/<?php echo $testim['yt_id']; ?>?rel=0&modestbranding=1" 
                        title="<?php echo $testim['title']; ?>" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
                
                <div class="p-8 flex-grow flex flex-col justify-center">
                    <div class="flex items-center mb-4">
                        <!-- Quote Icon -->
                        <div class="text-primary opacity-50">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-white font-heading leading-tight group-hover:text-primary transition-colors">
                        <?php echo $testim['title']; ?>
                    </h3>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA Section (Reused) -->
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
