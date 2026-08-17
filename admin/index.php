<?php
require_once '../config.php';
include 'includes/header.php';

$db = getDB();

// Fetch quick stats
$stats = [
    'posts' => $db->query("SELECT COUNT(*) FROM posts")->fetchColumn(),
    'contacts' => $db->query("SELECT COUNT(*) FROM contacts")->fetchColumn(),
    'subscribers' => $db->query("SELECT COUNT(*) FROM subscribers")->fetchColumn(),
    'staff' => $db->query("SELECT COUNT(*) FROM users")->fetchColumn()
];

// Fetch recent inquiries
$recent_inquiries = $db->query("SELECT name, company, email, created_at FROM contacts ORDER BY created_at DESC LIMIT 5")->fetchAll();
?>

<div class="mb-8">
    <h1 class="text-3xl font-black text-white uppercase tracking-wider mb-2">Dashboard Overview</h1>
    <p class="text-gray-400 text-sm">Welcome back to the Yellomonkey Labs backend.</p>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <!-- Stat Box -->
    <div class="bg-card p-6 rounded-2xl border border-white/5">
        <div class="text-gray-400 text-sm font-bold uppercase tracking-wider mb-1">Total Posts</div>
        <div class="text-4xl font-black text-white"><?php echo $stats['posts']; ?></div>
    </div>
    
    <div class="bg-card p-6 rounded-2xl border border-white/5">
        <div class="text-gray-400 text-sm font-bold uppercase tracking-wider mb-1">Contact Entries</div>
        <div class="text-4xl font-black text-white"><?php echo $stats['contacts']; ?></div>
    </div>
    
    <div class="bg-card p-6 rounded-2xl border border-white/5">
        <div class="text-gray-400 text-sm font-bold uppercase tracking-wider mb-1">Newsletter Subs</div>
        <div class="text-4xl font-black text-primary"><?php echo $stats['subscribers']; ?></div>
    </div>
    
    <div class="bg-card p-6 rounded-2xl border border-white/5">
        <div class="text-gray-400 text-sm font-bold uppercase tracking-wider mb-1">Staff Members</div>
        <div class="text-4xl font-black text-white"><?php echo $stats['staff']; ?></div>
    </div>
</div>

<!-- Recent Activity -->
<div class="bg-card rounded-2xl border border-white/5 overflow-hidden">
    <div class="p-6 border-b border-white/5 flex justify-between items-center">
        <h2 class="text-xl font-bold text-white">Recent Inquiries</h2>
        <a href="entries.php" class="text-sm text-primary hover:underline">View All</a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-white/5">
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Company</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Email</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                <?php foreach($recent_inquiries as $inq): ?>
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="px-6 py-4 text-sm text-gray-300"><?php echo date('M d, Y', strtotime($inq['created_at'])); ?></td>
                    <td class="px-6 py-4 text-sm font-bold text-white"><?php echo htmlspecialchars($inq['name']); ?></td>
                    <td class="px-6 py-4 text-sm text-gray-300"><?php echo htmlspecialchars($inq['company'] ?: '-'); ?></td>
                    <td class="px-6 py-4 text-sm text-gray-300"><?php echo htmlspecialchars($inq['email']); ?></td>
                </tr>
                <?php endforeach; ?>
                
                <?php if(empty($recent_inquiries)): ?>
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-500 text-sm">No recent inquiries found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
