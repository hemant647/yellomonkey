<?php
require_once '../config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'includes/header.php';

$db = getDB();

// Delete entry
if (isset($_POST['delete_id'])) {
    $stmt = $db->prepare("DELETE FROM contacts WHERE id = ?");
    $stmt->execute([$_POST['delete_id']]);
}

$entries = $db->query("SELECT * FROM contacts ORDER BY created_at DESC")->fetchAll();
?>

<div class="mb-8">
    <h1 class="text-3xl font-black text-white uppercase tracking-wider mb-2">Contact Entries</h1>
    <p class="text-gray-400 text-sm">View and manage inquiries from the contact form.</p>
</div>

<div class="bg-card rounded-2xl border border-white/5 shadow-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-white/5 border-b border-white/5">
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Name / Company</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Contact Info</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Services</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                <?php foreach($entries as $entry): ?>
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="px-6 py-4 text-sm text-gray-300 align-top"><?php echo date('M d, Y h:i A', strtotime($entry['created_at'])); ?></td>
                    <td class="px-6 py-4 text-sm align-top">
                        <div class="font-bold text-white"><?php echo htmlspecialchars($entry['name']); ?></div>
                        <div class="text-gray-400 text-xs mt-1"><?php echo htmlspecialchars($entry['company'] ?: '-'); ?></div>
                    </td>
                    <td class="px-6 py-4 text-sm align-top">
                        <div class="text-white"><a href="mailto:<?php echo htmlspecialchars($entry['email']); ?>" class="hover:text-primary"><?php echo htmlspecialchars($entry['email']); ?></a></div>
                        <div class="text-gray-400 text-xs mt-1"><?php echo htmlspecialchars($entry['phone'] ?: '-'); ?></div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-300 align-top max-w-xs">
                        <?php echo htmlspecialchars($entry['services_requested'] ?: 'None selected'); ?>
                    </td>
                    <td class="px-6 py-4 text-sm align-top">
                        <form method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?');">
                            <input type="hidden" name="delete_id" value="<?php echo $entry['id']; ?>">
                            <button type="submit" class="text-red-400 hover:text-red-300 text-xs font-bold uppercase">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                
                <?php if(empty($entries)): ?>
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500 text-sm">No contact entries found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
