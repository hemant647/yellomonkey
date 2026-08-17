<?php
require_once '../config.php';
include 'includes/header.php';

$message = '';
$db = getDB();

$edit_id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$post_data = [
    'title' => '', 'content' => '', 'meta_title' => '', 'meta_description' => '', 'canonical_url' => '', 'status' => 'draft', 'featured_image' => ''
];

// Fetch existing post if editing
if ($edit_id) {
    $stmt = $db->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$edit_id]);
    $existing = $stmt->fetch();
    if ($existing) {
        $post_data = $existing;
    } else {
        $edit_id = null; // invalid ID
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $meta_title = trim($_POST['meta_title'] ?? '');
    $meta_description = trim($_POST['meta_description'] ?? '');
    $canonical_url = trim($_POST['canonical_url'] ?? '');
    $status = $_POST['status'] ?? 'draft';
    
    // Generate slug from title
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));

    $featured_image = $post_data['featured_image']; // Keep existing by default

    // Handle File Upload
    if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/images/blog/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
        $fileName = time() . '_' . basename($_FILES['featured_image']['name']);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['featured_image']['tmp_name'], $targetPath)) {
            $featured_image = 'assets/images/blog/' . $fileName;
        } else {
            $message = "<div class='bg-red-500/20 text-red-400 p-4 rounded mb-6 border border-red-500/50'>Failed to upload image.</div>";
        }
    }

    if (!$message && $title && $content) {
        try {
            if ($edit_id) {
                // Update
                $stmt = $db->prepare("UPDATE posts SET title=?, slug=?, content=?, featured_image=?, meta_title=?, meta_description=?, canonical_url=?, status=? WHERE id=?");
                $stmt->execute([
                    $title, $slug, $content, $featured_image, $meta_title, $meta_description, $canonical_url, $status, $edit_id
                ]);
                $message = "<div class='bg-green-500/20 text-green-400 p-4 rounded mb-6 border border-green-500/50'>Blog post updated successfully!</div>";
            } else {
                // Insert
                $stmt = $db->prepare("INSERT INTO posts (title, slug, content, featured_image, meta_title, meta_description, canonical_url, author_id, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $title, $slug, $content, $featured_image, $meta_title, $meta_description, $canonical_url, $_SESSION['user_id'], $status
                ]);
                $edit_id = $db->lastInsertId();
                $message = "<div class='bg-green-500/20 text-green-400 p-4 rounded mb-6 border border-green-500/50'>Blog post published successfully!</div>";
            }
            
            // Re-fetch to update form fields
            $stmt = $db->prepare("SELECT * FROM posts WHERE id = ?");
            $stmt->execute([$edit_id]);
            $post_data = $stmt->fetch();
            
        } catch (PDOException $e) {
            $message = "<div class='bg-red-500/20 text-red-400 p-4 rounded mb-6 border border-red-500/50'>Error: " . $e->getMessage() . "</div>";
        }
    } else if (!$message) {
        $message = "<div class='bg-red-500/20 text-red-400 p-4 rounded mb-6 border border-red-500/50'>Title and content are required.</div>";
    }
}
?>

<div class="mb-8">
    <h1 class="text-3xl font-black text-white uppercase tracking-wider mb-2"><?php echo $edit_id ? 'Edit Blog' : 'Publish Blog'; ?></h1>
    <p class="text-gray-400 text-sm"><?php echo $edit_id ? 'Update your existing blog post.' : 'Create and publish a new blog post.'; ?></p>
</div>

<?php echo $message; ?>

<form method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Main Content Column -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-card p-6 rounded-2xl border border-white/5 shadow-xl">
            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-400 mb-2">Post Title *</label>
                <input type="text" name="title" required value="<?php echo htmlspecialchars($post_data['title']); ?>" class="w-full bg-dark border border-white/10 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary transition-colors text-lg font-bold" placeholder="Enter an engaging title...">
            </div>
            
            <div>
                <label class="block text-sm font-bold text-gray-400 mb-2">Content *</label>
                <!-- TinyMCE initialized here -->
                <textarea name="content" id="editor"><?php echo htmlspecialchars($post_data['content']); ?></textarea>
            </div>
        </div>
    </div>
    
    <!-- Sidebar Settings Column -->
    <div class="space-y-6">
        <div class="bg-card p-6 rounded-2xl border border-white/5 shadow-xl">
            <h3 class="text-white font-bold mb-4 border-b border-white/5 pb-2">Publishing Options</h3>
            
            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-400 mb-2">Status</label>
                <select name="status" class="w-full bg-dark border border-white/10 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary transition-colors">
                    <option value="draft" <?php echo $post_data['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                    <option value="published" <?php echo $post_data['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                </select>
            </div>
            
            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-400 mb-2">Featured Image</label>
                <?php if ($post_data['featured_image']): ?>
                    <div class="mb-2">
                        <img src="../<?php echo htmlspecialchars($post_data['featured_image']); ?>" class="w-full h-32 object-cover rounded-lg border border-white/10">
                    </div>
                <?php endif; ?>
                <input type="file" name="featured_image" accept="image/*" class="w-full text-gray-400 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-primary file:text-dark hover:file:bg-yellow-400 transition-colors">
            </div>

            <button type="submit" class="w-full py-4 bg-primary text-dark font-black rounded-lg hover:bg-yellow-400 transition-colors uppercase tracking-wider">
                <?php echo $edit_id ? 'Update Post' : 'Save Post'; ?>
            </button>
        </div>
        
        <div class="bg-card p-6 rounded-2xl border border-white/5 shadow-xl">
            <h3 class="text-white font-bold mb-4 border-b border-white/5 pb-2">SEO Settings</h3>
            
            <div class="mb-4">
                <label class="block text-sm font-bold text-gray-400 mb-2">Meta Title</label>
                <input type="text" name="meta_title" value="<?php echo htmlspecialchars($post_data['meta_title']); ?>" class="w-full bg-dark border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-primary transition-colors text-sm">
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-bold text-gray-400 mb-2">Meta Description</label>
                <textarea name="meta_description" rows="3" class="w-full bg-dark border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-primary transition-colors text-sm"><?php echo htmlspecialchars($post_data['meta_description']); ?></textarea>
            </div>
            
            <div>
                <label class="block text-sm font-bold text-gray-400 mb-2">Canonical URL</label>
                <input type="url" name="canonical_url" value="<?php echo htmlspecialchars($post_data['canonical_url']); ?>" placeholder="https://..." class="w-full bg-dark border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-primary transition-colors text-sm">
            </div>
        </div>
    </div>
</form>

<script>
    tinymce.init({
        selector: '#editor',
        height: 500,
        skin: 'oxide-dark',
        content_css: 'dark',
        plugins: 'anchor autolink charmap code codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | code | blocks fontfamily fontsize | image media link | bold italic underline | align lineheight | numlist bullist | removeformat',
        menubar: false,
        image_title: true,
        automatic_uploads: true,
        file_picker_types: 'image',
        images_upload_url: 'upload_image.php',
        images_upload_credentials: true
    });
</script>

<?php include 'includes/footer.php'; ?>
