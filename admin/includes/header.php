<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yellomonkey Labs - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- TinyMCE CDN for Blog WYSIWYG -->
    <script src="https://cdn.tiny.cloud/1/uk8vg6zwdq1vxe1qktbmnxtrkvuxpqhhjr090y5nrz9yo5ot/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FFD600',
                        dark: '#111111',
                        darker: '#0a0a0a',
                        card: '#1E1E1E'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-darker text-white font-sans min-h-screen flex flex-col md:flex-row">

    <!-- Sidebar Navigation -->
    <aside class="w-full md:w-64 bg-dark border-r border-white/5 flex flex-col hidden md:flex shrink-0 min-h-screen">
        <div class="p-6 border-b border-white/5">
            <h2 class="text-xl font-black text-white uppercase tracking-wider">YelloMonkey<span class="text-primary">Admin</span></h2>
            <p class="text-xs text-gray-400 mt-1">Logged in as <?php echo htmlspecialchars($_SESSION['username']); ?></p>
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="index.php" class="block px-4 py-3 rounded-lg transition-colors <?php echo $current_page == 'index.php' ? 'bg-primary text-dark font-bold' : 'text-gray-400 hover:bg-white/5 hover:text-white'; ?>">
                Dashboard
            </a>
            <a href="blogs.php" class="block px-4 py-3 rounded-lg transition-colors <?php echo ($current_page == 'blogs.php' || $current_page == 'blog_publish.php') ? 'bg-primary text-dark font-bold' : 'text-gray-400 hover:bg-white/5 hover:text-white'; ?>">
                Manage Blogs
            </a>
            <a href="entries.php" class="block px-4 py-3 rounded-lg transition-colors <?php echo $current_page == 'entries.php' ? 'bg-primary text-dark font-bold' : 'text-gray-400 hover:bg-white/5 hover:text-white'; ?>">
                Contact Entries
            </a>
            <a href="subscribers.php" class="block px-4 py-3 rounded-lg transition-colors <?php echo $current_page == 'subscribers.php' ? 'bg-primary text-dark font-bold' : 'text-gray-400 hover:bg-white/5 hover:text-white'; ?>">
                Subscribers
            </a>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'superadmin'): ?>
            <div class="pt-4 mt-4 border-t border-white/5">
                <a href="add_staff.php" class="block px-4 py-3 rounded-lg transition-colors <?php echo $current_page == 'add_staff.php' ? 'bg-primary text-dark font-bold' : 'text-gray-400 hover:bg-white/5 hover:text-white'; ?>">
                    Add Staff Member
                </a>
            </div>
            <?php endif; ?>
        </nav>
        <div class="p-4 border-t border-white/5">
            <a href="logout.php" class="block w-full text-center px-4 py-2 border border-red-500/50 text-red-400 rounded-lg hover:bg-red-500 hover:text-white transition-colors">
                Logout
            </a>
        </div>
    </aside>

    <!-- Mobile Header -->
    <header class="md:hidden bg-dark p-4 border-b border-white/5 flex justify-between items-center">
        <h2 class="text-lg font-black text-white uppercase tracking-wider">YM<span class="text-primary">Admin</span></h2>
        <button id="mobile-menu-btn" class="text-white p-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1 p-6 md:p-10 overflow-y-auto">
