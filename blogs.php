<?php
require_once 'config.php';
$seo_title = 'Our Blog | Yellomonkey Labs';
$seo_desc = 'Read the latest insights on design, development, and digital marketing from the experts at Yellomonkey Labs.';
include 'includes/header.php';

$db = getDB();
$posts = $db->query("
    SELECT p.title, p.slug, p.featured_image, p.created_at, u.username as author 
    FROM posts p 
    LEFT JOIN users u ON p.author_id = u.id 
    WHERE p.status = 'published' 
    ORDER BY p.created_at DESC
")->fetchAll();
?>

<!-- Hero Section -->
<section class="pt-32 pb-20 relative overflow-hidden bg-dark">
    <div class="absolute right-0 top-0 w-1/2 opacity-20 pointer-events-none">
        <img src="assets/images/Vector-1.webp" alt="Decoration" class="w-full h-full object-cover mix-blend-multiply">
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <h1 class="font-heading text-6xl md:text-8xl font-black text-white uppercase tracking-wider mb-6">Our Blog</h1>
        <p class="text-xl text-gray-400 max-w-2xl font-medium">Insights, strategies, and thoughts from the creative minds at Yellomonkey Labs.</p>
    </div>
</section>

<!-- Blog Grid -->
<section class="py-20 bg-darker min-h-[50vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <?php if(empty($posts)): ?>
            <div class="text-center py-20">
                <h3 class="text-2xl font-bold text-gray-500">No published posts yet. Check back soon!</h3>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <?php foreach($posts as $post): ?>
                    <a href="/blogs/<?php echo urlencode($post['slug']); ?>" class="group block">
                        <div class="bg-card rounded-3xl overflow-hidden border border-white/5 shadow-xl transition-all duration-300 group-hover:-translate-y-2 group-hover:shadow-[0_20px_40px_-15px_rgba(255,193,7,0.15)] flex flex-col h-full">
                            <!-- Image -->
                            <div class="relative h-64 overflow-hidden bg-darker">
                                <?php if ($post['featured_image']): ?>
                                    <img src="<?php echo htmlspecialchars($post['featured_image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center bg-gray-900">
                                        <img src="assets/images/Vector-120x15.webp" class="h-4 opacity-20" alt="Yellomonkey">
                                    </div>
                                <?php endif; ?>
                                <div class="absolute inset-0 bg-gradient-to-t from-dark/90 to-transparent"></div>
                            </div>
                            
                            <!-- Content -->
                            <div class="p-8 flex-1 flex flex-col">
                                <div class="text-primary text-xs font-bold uppercase tracking-wider mb-3">
                                    <?php echo date('M d, Y', strtotime($post['created_at'])); ?> &bull; By <?php echo htmlspecialchars($post['author'] ?: 'Yellomonkey'); ?>
                                </div>
                                <h3 class="text-2xl font-bold text-white mb-4 line-clamp-3 group-hover:text-primary transition-colors">
                                    <?php echo htmlspecialchars($post['title']); ?>
                                </h3>
                                <div class="mt-auto pt-4 flex items-center text-gray-400 text-sm font-bold uppercase tracking-wide group-hover:text-white transition-colors">
                                    Read Article 
                                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
    </div>
</section>

<?php include 'includes/footer.php'; ?>
