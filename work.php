<?php
// Our Work (Portfolio) Page

$projects_json = file_get_contents('extracted_portfolio.json');
$projects = json_decode($projects_json, true);

// Let's add some mock categories for the filtering system
$categories = ['All', 'Web Design', 'Crypto', 'App Development', 'Services'];

foreach ($projects as &$project) {
    // Assign mock categories based on name for demonstration
    if (strpos(strtolower($project['title']), 'crypto') !== false) {
        $project['category'] = 'Crypto';
    } elseif (strpos(strtolower($project['title']), 'app') !== false || strpos(strtolower($project['title']), 'socal') !== false) {
        $project['category'] = 'App Development';
    } elseif (strpos(strtolower($project['title']), 'service') !== false || strpos(strtolower($project['title']), 'consulting') !== false) {
        $project['category'] = 'Services';
    } else {
        $project['category'] = 'Web Design';
    }
}
unset($project); // break the reference

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="relative pt-32 pb-20 md:pt-40 md:pb-32 overflow-hidden bg-white">
    <div class="absolute top-0 right-0 w-1/2 h-full bg-primary/10 rounded-l-[100px] pointer-events-none z-0 hidden lg:block"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10 text-center">
        <div class="inline-block mb-4 px-4 py-1.5 rounded-full bg-primary/20 border border-primary/30 text-dark font-bold text-sm tracking-wider uppercase">
            Our Portfolio
        </div>
        <h1 class="font-heading text-6xl md:text-7xl lg:text-8xl font-black leading-tight mb-8 text-dark tracking-normal uppercase">
            Discover Our <br>
            <span class="text-primary relative inline-block">
                Creative Work
                <svg class="absolute -bottom-2 left-0 w-full h-3 text-dark opacity-20" viewBox="0 0 100 10" preserveAspectRatio="none"><path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="4" fill="none"/></svg>
            </span>
        </h1>
        <p class="text-dark/70 text-lg md:text-xl leading-relaxed mb-10 font-medium max-w-2xl mx-auto">
            We offer an impressive portfolio of web design, development, and digital marketing projects. Our creative solutions have helped businesses succeed online.
        </p>
    </div>
</section>

<!-- Portfolio Grid Section -->
<section class="py-24 bg-dark relative border-t border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Filter Tabs -->
        <div class="flex flex-wrap justify-center gap-4 mb-16">
            <?php foreach($categories as $index => $category): ?>
                <button 
                    class="filter-btn px-6 py-2 rounded-full font-bold text-sm tracking-wider uppercase transition-all duration-300 <?php echo $index === 0 ? 'bg-primary text-dark' : 'bg-white/10 text-white hover:bg-white/20'; ?>"
                    data-filter="<?php echo $category; ?>"
                >
                    <?php echo $category; ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 portfolio-grid">
            <?php foreach($projects as $project): ?>
                <div 
                    class="portfolio-item relative rounded-[24px] overflow-hidden group h-[400px] shadow-2xl transition-transform duration-500 hover:-translate-y-2 cursor-pointer"
                    data-category="<?php echo $project['category']; ?>"
                    data-gif="<?php echo !empty($project['hover_image_local']) ? $project['hover_image_local'] : ''; ?>"
                    onclick="window.open('<?php echo $project['link']; ?>', '_blank')"
                >
                    <!-- Default State (Static Background Image) -->
                    <img 
                        src="<?php echo $project['bg_image_local']; ?>" 
                        alt="<?php echo $project['title']; ?>" 
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                    >
                    
                    <!-- Overlay & Content -->
                    <div class="absolute inset-0 bg-gradient-to-t from-dark via-dark/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-500"></div>
                    
                    <div class="absolute inset-0 p-8 flex flex-col justify-end">
                        <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                            <span class="text-primary text-sm font-bold tracking-wider uppercase mb-2 block opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                                <?php echo $project['category']; ?>
                            </span>
                            <h3 class="text-3xl font-bold text-white mb-0 drop-shadow-md"><?php echo $project['title']; ?></h3>
                            
                            <div class="mt-4 flex items-center text-white/80 text-sm font-bold uppercase tracking-wider opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-200">
                                View Live
                                <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- Hover Popup Container -->
<div id="hover-popup" class="fixed inset-0 pointer-events-none z-[100] flex items-center justify-center opacity-0 transition-opacity duration-300" style="display: none;">
    <!-- Semi-transparent backdrop -->
    <div class="absolute inset-0 bg-dark/80 backdrop-blur-sm"></div>
    <!-- Popup content -->
    <div class="relative bg-dark p-2 rounded-2xl shadow-2xl max-w-4xl w-[90%] transform scale-95 transition-transform duration-300" id="hover-popup-content">
        <img id="hover-popup-img" src="" class="w-full h-auto max-h-[80vh] object-contain rounded-xl border border-white/10">
    </div>
</div>

<!-- CTA Section (Reused from services.php) -->
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

<!-- Filtering Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');
    
    // Popup Elements
    const popup = document.getElementById('hover-popup');
    const popupContent = document.getElementById('hover-popup-content');
    const popupImg = document.getElementById('hover-popup-img');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Update active button state
            filterBtns.forEach(b => {
                b.classList.remove('bg-primary', 'text-dark');
                b.classList.add('bg-white/10', 'text-white');
            });
            btn.classList.remove('bg-white/10', 'text-white');
            btn.classList.add('bg-primary', 'text-dark');

            // Filter items
            const filterValue = btn.getAttribute('data-filter');
            
            portfolioItems.forEach(item => {
                const itemCategory = item.getAttribute('data-category');
                if (filterValue === 'All' || filterValue === itemCategory) {
                    item.style.display = 'block';
                    // Trigger a reflow for animation
                    item.offsetHeight; 
                    item.style.opacity = '1';
                    item.style.transform = 'scale(1)';
                } else {
                    item.style.opacity = '0';
                    item.style.transform = 'scale(0.9)';
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 300);
                }
            });
        });
    });

    // Hover Popup Logic
    portfolioItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            const gifSrc = item.getAttribute('data-gif');
            if(gifSrc) {
                popupImg.src = gifSrc;
                popup.style.display = 'flex';
                // Trigger reflow
                popup.offsetHeight;
                popup.classList.remove('opacity-0');
                popup.classList.add('opacity-100');
                popupContent.classList.remove('scale-95');
                popupContent.classList.add('scale-100');
            }
        });

        item.addEventListener('mouseleave', () => {
            popup.classList.remove('opacity-100');
            popup.classList.add('opacity-0');
            popupContent.classList.remove('scale-100');
            popupContent.classList.add('scale-95');
            setTimeout(() => {
                popup.style.display = 'none';
                popupImg.src = '';
            }, 300);
        });
    });
});
</script>

<?php include 'includes/footer.php'; ?>
