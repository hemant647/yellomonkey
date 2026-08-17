<?php
require_once '../config.php';

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'superadmin') {
    // If not superadmin, redirect to index
    header("Location: index.php");
    exit;
}

// Now include header (which handles its own basic session check)
include 'includes/header.php';

$message = '';
$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if ($username && $email && $password) {
        try {
            // Check if username or email exists
            $stmt = $db->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$username, $email]);
            if ($stmt->fetch()) {
                $message = "<div class='bg-red-500/20 text-red-400 p-4 rounded mb-6 border border-red-500/50'>Username or Email already exists.</div>";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $db->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'staff')");
                $stmt->execute([$username, $email, $hashedPassword]);
                $message = "<div class='bg-green-500/20 text-green-400 p-4 rounded mb-6 border border-green-500/50'>Staff member added successfully!</div>";
            }
        } catch (PDOException $e) {
            $message = "<div class='bg-red-500/20 text-red-400 p-4 rounded mb-6 border border-red-500/50'>Database Error: " . $e->getMessage() . "</div>";
        }
    } else {
        $message = "<div class='bg-red-500/20 text-red-400 p-4 rounded mb-6 border border-red-500/50'>All fields are required.</div>";
    }
}

// Handle Delete Staff
if (isset($_POST['delete_staff_id'])) {
    try {
        $stmt = $db->prepare("DELETE FROM users WHERE id = ? AND role = 'staff'");
        $stmt->execute([$_POST['delete_staff_id']]);
        $message = "<div class='bg-green-500/20 text-green-400 p-4 rounded mb-6 border border-green-500/50'>Staff member deleted successfully.</div>";
    } catch(PDOException $e) {
        $message = "<div class='bg-red-500/20 text-red-400 p-4 rounded mb-6 border border-red-500/50'>Error: " . $e->getMessage() . "</div>";
    }
}

// Handle Change Password
if (isset($_POST['change_password_id']) && isset($_POST['new_password'])) {
    $new_password = $_POST['new_password'];
    if (strlen($new_password) > 0) {
        try {
            $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $db->prepare("UPDATE users SET password = ? WHERE id = ? AND role = 'staff'");
            $stmt->execute([$hashedPassword, $_POST['change_password_id']]);
            $message = "<div class='bg-green-500/20 text-green-400 p-4 rounded mb-6 border border-green-500/50'>Password updated successfully.</div>";
        } catch(PDOException $e) {
            $message = "<div class='bg-red-500/20 text-red-400 p-4 rounded mb-6 border border-red-500/50'>Error: " . $e->getMessage() . "</div>";
        }
    }
}

// Fetch current staff
$staffList = $db->query("SELECT id, username, email, role, created_at FROM users WHERE role = 'staff' ORDER BY created_at DESC")->fetchAll();
?>

<div class="mb-8">
    <h1 class="text-3xl font-black text-white uppercase tracking-wider mb-2">Staff Management</h1>
    <p class="text-gray-400 text-sm">Add and manage staff members with access to this panel.</p>
</div>

<?php echo $message; ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Add Staff Form -->
    <div class="lg:col-span-1">
        <div class="bg-card p-6 rounded-2xl border border-white/5 shadow-xl">
            <h3 class="text-white font-bold mb-6 border-b border-white/5 pb-2">Add New Staff</h3>
            <form method="POST" class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-400 mb-2">Username</label>
                    <input type="text" name="username" required class="w-full bg-dark border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-primary transition-colors text-sm">
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-400 mb-2">Email Address</label>
                    <input type="email" name="email" required class="w-full bg-dark border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-primary transition-colors text-sm">
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-400 mb-2">Password</label>
                    <input type="password" name="password" required class="w-full bg-dark border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-primary transition-colors text-sm">
                </div>
                
                <button type="submit" class="w-full py-3 bg-primary text-dark font-black rounded-lg hover:bg-yellow-400 transition-colors uppercase tracking-wider mt-4">
                    Create Account
                </button>
            </form>
        </div>
    </div>
    
    <!-- Current Staff List -->
    <div class="lg:col-span-2">
        <div class="bg-card rounded-2xl border border-white/5 shadow-xl overflow-hidden">
            <div class="p-6 border-b border-white/5">
                <h3 class="text-white font-bold">Current Staff Members</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-white/5">
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Username</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Date Added</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        <?php foreach($staffList as $staff): ?>
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4 text-sm font-bold text-white"><?php echo htmlspecialchars($staff['username']); ?></td>
                            <td class="px-6 py-4 text-sm text-gray-300"><?php echo htmlspecialchars($staff['email']); ?></td>
                            <td class="px-6 py-4 text-sm text-gray-400"><?php echo date('M d, Y', strtotime($staff['created_at'])); ?></td>
                            <td class="px-6 py-4 text-right space-x-3">
                                <!-- Change Password -->
                                <button type="button" class="text-primary hover:text-yellow-300 text-xs font-bold uppercase transition-colors" onclick="let p = prompt('Enter new password for <?php echo htmlspecialchars($staff['username']); ?>:'); if(p) { document.getElementById('pass_input_<?php echo $staff['id']; ?>').value = p; document.getElementById('pass_form_<?php echo $staff['id']; ?>').submit(); }">
                                    Change Pass
                                </button>
                                <form id="pass_form_<?php echo $staff['id']; ?>" method="POST" style="display:none;">
                                    <input type="hidden" name="change_password_id" value="<?php echo $staff['id']; ?>">
                                    <input type="hidden" name="new_password" id="pass_input_<?php echo $staff['id']; ?>" value="">
                                </form>
                                
                                <!-- Delete -->
                                <form method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this staff member?');">
                                    <input type="hidden" name="delete_staff_id" value="<?php echo $staff['id']; ?>">
                                    <button type="submit" class="text-red-400 hover:text-red-300 text-xs font-bold uppercase transition-colors">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <?php if(empty($staffList)): ?>
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500 text-sm">No staff members found.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
