<?php
require_once '../config.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

include 'includes/header.php';

$message = '';
$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF
    $csrf_token = $_POST['csrf_token'] ?? '';
    if (!verify_csrf_token($csrf_token)) {
        $message = "<div class='bg-red-500/20 text-red-400 p-4 rounded mb-6 border border-red-500/50'>Invalid security token. Please try again.</div>";
    } else {
        $current_password = $_POST['current_password'] ?? '';
        $new_password = $_POST['new_password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
    
    if ($current_password && $new_password && $confirm_password) {
        if ($new_password !== $confirm_password) {
            $message = "<div class='bg-red-500/20 text-red-400 p-4 rounded mb-6 border border-red-500/50'>New passwords do not match.</div>";
        } else {
            try {
                // Verify current password
                $stmt = $db->prepare("SELECT password FROM users WHERE id = ?");
                $stmt->execute([$_SESSION['user_id']]);
                $user = $stmt->fetch();
                
                if ($user && password_verify($current_password, $user['password'])) {
                    // Update password
                    $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
                    $updateStmt = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
                    $updateStmt->execute([$hashedPassword, $_SESSION['user_id']]);
                    $message = "<div class='bg-green-500/20 text-green-400 p-4 rounded mb-6 border border-green-500/50'>Password changed successfully!</div>";
                } else {
                    $message = "<div class='bg-red-500/20 text-red-400 p-4 rounded mb-6 border border-red-500/50'>Current password is incorrect.</div>";
                }
            } catch (PDOException $e) {
                $message = "<div class='bg-red-500/20 text-red-400 p-4 rounded mb-6 border border-red-500/50'>Database Error: " . $e->getMessage() . "</div>";
            }
        }
    } else {
        $message = "<div class='bg-red-500/20 text-red-400 p-4 rounded mb-6 border border-red-500/50'>All fields are required.</div>";
        }
    } // End CSRF else block
}
?>

<div class="mb-8">
    <h1 class="text-3xl font-black text-white uppercase tracking-wider mb-2">Change Password</h1>
    <p class="text-gray-400 text-sm">Update your account password.</p>
</div>

<?php echo $message; ?>

<div class="max-w-md">
    <div class="bg-card p-6 rounded-2xl border border-white/5 shadow-xl">
        <form method="POST" class="space-y-4">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generate_csrf_token()); ?>">
            <div>
                <label class="block text-sm font-bold text-gray-400 mb-2">Current Password</label>
                <input type="password" name="current_password" required class="w-full bg-dark border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-primary transition-colors text-sm">
            </div>
            
            <div>
                <label class="block text-sm font-bold text-gray-400 mb-2">New Password</label>
                <input type="password" name="new_password" required class="w-full bg-dark border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-primary transition-colors text-sm">
            </div>
            
            <div>
                <label class="block text-sm font-bold text-gray-400 mb-2">Confirm New Password</label>
                <input type="password" name="confirm_password" required class="w-full bg-dark border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-primary transition-colors text-sm">
            </div>
            
            <button type="submit" class="w-full py-3 bg-primary text-dark font-black rounded-lg hover:bg-yellow-400 transition-colors uppercase tracking-wider mt-4">
                Update Password
            </button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
