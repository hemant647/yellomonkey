<?php
require_once '../config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'includes/header.php';

$db = getDB();

// Delete subscriber
if (isset($_POST['delete_id'])) {
    $stmt = $db->prepare("DELETE FROM subscribers WHERE id = ?");
    $stmt->execute([$_POST['delete_id']]);
}

$subscribers = $db->query("SELECT * FROM subscribers ORDER BY created_at DESC")->fetchAll();
?>

<div class="mb-8">
    <h1 class="text-3xl font-black text-white uppercase tracking-wider mb-2">Newsletter Subscribers</h1>
    <p class="text-gray-400 text-sm">View and manage email subscribers from the website footer.</p>
</div>

<div class="bg-card rounded-2xl border border-white/5 shadow-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-white/5 border-b border-white/5">
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Date Subscribed</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Email Address</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                <?php foreach($subscribers as $sub): ?>
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="px-6 py-4 text-sm text-gray-300"><?php echo date('M d, Y h:i A', strtotime($sub['created_at'])); ?></td>
                    <td class="px-6 py-4 text-sm font-bold text-white"><?php echo htmlspecialchars($sub['email']); ?></td>
                    <td class="px-6 py-4 text-sm">
                        <form method="POST" onsubmit="return confirm('Remove this subscriber?');">
                            <input type="hidden" name="delete_id" value="<?php echo $sub['id']; ?>">
                            <button type="submit" class="text-red-400 hover:text-red-300 text-xs font-bold uppercase">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                
                <?php if(empty($subscribers)): ?>
                <tr>
                    <td colspan="3" class="px-6 py-12 text-center text-gray-500 text-sm">No subscribers found yet.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
