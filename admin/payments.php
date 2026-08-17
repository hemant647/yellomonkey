<?php
require_once '../config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'includes/header.php';

$db = getDB();
$payments = $db->query("SELECT * FROM payments ORDER BY created_at DESC")->fetchAll();
?>

<div class="mb-8">
    <h1 class="text-3xl font-black text-white uppercase tracking-wider mb-2">Payment Records</h1>
    <p class="text-gray-400 text-sm">View all payments initiated from the website.</p>
</div>

<div class="bg-card rounded-2xl border border-white/5 shadow-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-white/5 border-b border-white/5">
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Name / Email</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Notes</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                <?php foreach($payments as $pay): ?>
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="px-6 py-4 text-sm text-gray-300 whitespace-nowrap"><?php echo date('M d, Y h:i A', strtotime($pay['created_at'])); ?></td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-white"><?php echo htmlspecialchars($pay['name']); ?></div>
                        <div class="text-sm text-gray-400"><?php echo htmlspecialchars($pay['email']); ?></div>
                    </td>
                    <td class="px-6 py-4 text-sm font-bold text-green-400 whitespace-nowrap">
                        $<?php echo number_format($pay['amount'], 2); ?>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-300 max-w-xs truncate" title="<?php echo htmlspecialchars($pay['notes']); ?>">
                        <?php echo htmlspecialchars($pay['notes'] ?: '-'); ?>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <?php if($pay['payment_status'] == 'completed'): ?>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Completed</span>
                        <?php elseif($pay['payment_status'] == 'failed'): ?>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Failed</span>
                        <?php else: ?>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Pending</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                
                <?php if(empty($payments)): ?>
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500 text-sm">No payment records found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
