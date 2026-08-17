<?php
require_once '../config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'includes/header.php';

$db = getDB();

// Delete Blog Post
$message = '';
if (isset($_POST['delete_id']) && verify_csrf_token($_POST['csrf_token'] ?? '')) {
    try {
        $stmt = $db->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->execute([$_POST['delete_id']]);
        $message = "<div class='bg-green-500/20 text-green-400 p-4 rounded mb-6 border border-green-500/50'>Blog post deleted successfully.</div>";
    } catch(PDOException $e) {
        $message = "<div class='bg-red-500/20 text-red-400 p-4 rounded mb-6 border border-red-500/50'>Error deleting post: " . $e->getMessage() . "</div>";
    }
}

// Fetch all posts with author username
$posts = $db->query("
    SELECT p.id, p.title, p.status, p.created_at, p.updated_at, u.username as author 
    FROM posts p 
    LEFT JOIN users u ON p.author_id = u.id 
    ORDER BY p.created_at DESC
")->fetchAll();
?>

<div class="flex justify-between items-end mb-8 border-b border-white/5 pb-6">
    <div>
        <h1 class="text-3xl font-black text-white uppercase tracking-wider mb-2">Manage Blogs</h1>
        <p class="text-gray-400 text-sm">View, edit, or delete your published and drafted blog posts.</p>
    </div>
    <a href="blog_publish.php" class="inline-flex items-center px-6 py-3 bg-primary text-dark font-bold rounded-lg hover:bg-yellow-400 transition-colors uppercase tracking-wider text-sm">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Write New Blog
    </a>
</div>

<?php echo $message; ?>

<div class="bg-card rounded-2xl border border-white/5 shadow-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-white/5 border-b border-white/5">
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Author</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                <?php foreach($posts as $post): ?>
                <tr class="hover:bg-white/5 transition-colors group">
                    <td class="px-6 py-4">
                        <div class="text-sm font-bold text-white max-w-md truncate"><?php echo htmlspecialchars($post['title']); ?></div>
                    </td>
                    <td class="px-6 py-4">
                        <?php if($post['status'] === 'published'): ?>
                            <span class="px-3 py-1 bg-green-500/20 text-green-400 text-xs font-bold rounded-full uppercase tracking-wider">Published</span>
                        <?php else: ?>
                            <span class="px-3 py-1 bg-gray-500/20 text-gray-400 text-xs font-bold rounded-full uppercase tracking-wider">Draft</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-300">
                        <?php echo htmlspecialchars($post['author'] ?: 'Unknown'); ?>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-400">
                        <?php echo date('M d, Y', strtotime($post['created_at'])); ?>
                    </td>
                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="blog_publish.php?id=<?php echo $post['id']; ?>" class="text-primary hover:text-yellow-300 text-xs font-bold uppercase transition-colors inline-block">Edit</a>
                        <form method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this blog post? This action cannot be undone.');">
                            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generate_csrf_token()); ?>">
                            <input type="hidden" name="delete_id" value="<?php echo $post['id']; ?>">
                            <button type="submit" class="text-red-400 hover:text-red-300 text-xs font-bold uppercase transition-colors">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                
                <?php if(empty($posts)): ?>
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500 text-sm">You haven't written any blog posts yet.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
