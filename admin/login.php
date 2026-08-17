<?php
session_start();
require_once '../config.php';

// If already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username && $password) {
        $db = getDB();
        $stmt = $db->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: index.php");
            exit;
        } else {
            $error = 'Invalid username or password.';
        }
    } else {
        $error = 'Please enter both username and password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Yellomonkey Labs</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FFD600',
                        dark: '#111111',
                        card: '#1E1E1E'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-dark text-white h-screen flex items-center justify-center">
    <div class="bg-card p-10 rounded-[30px] border-4 border-white/5 shadow-2xl w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-black text-white uppercase tracking-wider mb-2">Admin Panel</h1>
            <div class="w-16 h-1 bg-primary mx-auto rounded-full"></div>
        </div>
        
        <?php if ($error): ?>
            <div class="bg-red-500/20 text-red-400 p-3 rounded mb-6 text-sm text-center border border-red-500/50">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-bold text-gray-400 mb-2">Username</label>
                <input type="text" name="username" class="w-full bg-dark border border-white/10 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary transition-colors" required>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-400 mb-2">Password</label>
                <input type="password" name="password" class="w-full bg-dark border border-white/10 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary transition-colors" required>
            </div>
            <button type="submit" class="w-full py-4 bg-primary text-dark font-black rounded-lg hover:bg-yellow-400 transition-colors uppercase tracking-wider mt-4">
                Login
            </button>
        </form>
    </div>
</body>
</html>
