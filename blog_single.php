<?php
require_once 'config.php';

$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
if (!$slug) {
    header("Location: blogs.php");
    exit;
}

$db = getDB();
$stmt = $db->prepare("
    SELECT p.*, u.username as author 
    FROM posts p 
    LEFT JOIN users u ON p.author_id = u.id 
    WHERE p.slug = ? AND p.status = 'published'
");
$stmt->execute([$slug]);
$post = $stmt->fetch();

if (!$post) {
    header("HTTP/1.0 404 Not Found");
    $seo_title = '404 - Post Not Found | Yellomonkey Labs';
    include 'includes/header.php';
    echo "<div class='pt-40 pb-20 text-center min-h-[60vh]'><h1 class='text-5xl font-black text-white mb-4'>Post Not Found</h1><a href='blogs.php' class='text-primary hover:underline'>Return to Blog</a></div>";
    include 'includes/footer.php';
    exit;
}

// Set dynamic SEO variables for the header
$seo_title = $post['meta_title'] ?: $post['title'] . ' | Yellomonkey Labs';
$seo_desc = $post['meta_description'] ?: strip_tags(substr($post['content'], 0, 160)) . '...';
if ($post['canonical_url']) {
    $seo_canonical = $post['canonical_url'];
}

include 'includes/header.php';
?>

<!-- Blog Header -->
<section class="pt-32 pb-12 bg-darker">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="text-primary text-sm font-bold uppercase tracking-widest mb-6">
            Published <?php echo date('F j, Y', strtotime($post['created_at'])); ?> &nbsp;&bull;&nbsp; By <?php echo htmlspecialchars($post['author'] ?: 'Yellomonkey'); ?>
        </div>
        <h1 class="font-heading text-5xl md:text-7xl font-black text-white leading-tight mb-8">
            <?php echo htmlspecialchars($post['title']); ?>
        </h1>
    </div>
    
    <?php if ($post['featured_image']): ?>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="rounded-3xl overflow-hidden border border-white/10 shadow-2xl relative aspect-video">
            <img src="/<?php echo ltrim($post['featured_image'], '/'); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="w-full h-full object-cover">
        </div>
    </div>
    <?php endif; ?>
</section>

<!-- Blog Content -->
<section class="py-16 bg-dark">
    <!-- Using Tailwind Typography (prose) to style the raw HTML from TinyMCE -->
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose prose-invert prose-lg prose-yellow max-w-none">
            <?php 
                // Output raw HTML content from TinyMCE safely.
                // Note: Ensure purifier or sanitization is used on input if not trusting admins.
                echo $post['content']; 
            ?>
        </div>
    </div>
</section>

<!-- Read More / Return -->
<section class="py-12 bg-darker border-t border-white/5 text-center">
    <a href="/blogs" class="inline-flex items-center px-8 py-4 bg-primary text-dark font-bold rounded-lg hover:bg-yellow-400 transition-colors uppercase tracking-wider">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to All Blogs
    </a>
</section>

<?php include 'includes/footer.php'; ?>
