<?php
$seo_title = $seo_title ?? 'Website Design, Development | Digital Marketing Company in Houston';
$seo_desc = $seo_desc ?? 'Expand your online reach with YelloMonkey Labs. Best digital marketing company in Houston, we offer expert services, including website design, development, SEO, etc.';
$seo_canonical = $seo_canonical ?? 'https://yellomonkey.com' . $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($seo_title); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($seo_desc); ?>">
    <link rel="canonical" href="<?php echo htmlspecialchars($seo_canonical); ?>">
    
    <!-- Google Fonts: Bebas Neue for headings, Source Sans 3 for body -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Sans+3:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (via CDN for Core PHP prototype) -->
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    
    <!-- Tailwind Configuration -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#FFC107',    // Yellow accent from screenshot
                        dark: '#111111',       // Main background
                        darker: '#0a0a0a',     // Darker sections
                        card: '#1c1c1c',       // Card backgrounds
                        light: '#F9FAFB',      // Main text
                        muted: '#9CA3AF'       // Muted text
                    },
                    fontFamily: {
                        heading: ['"Bebas Neue"', 'sans-serif'],
                        body: ['"Source Sans 3"', 'sans-serif']
                    }
                }
            }
        }
    </script>
    
    <!-- Custom CSS for specific microinteractions and utilities -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-dark text-light font-body antialiased selection:bg-primary selection:text-dark">
    
    <!-- Header / Navbar -->
    <header class="fixed w-full top-0 z-50 bg-dark/90 backdrop-blur-md border-b border-white/10 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="/" class="flex items-center gap-2 group">
                        <img src="assets/images/Vector-120x15.webp" alt="YelloMonkey" class="h-5 md:h-6 object-contain">
                    </a>
                </div>
                
                <!-- Desktop Navigation -->
                <nav class="hidden md:flex space-x-8">
                    <a href="about.php" class="text-sm font-medium text-light hover:text-primary transition-colors duration-200">About Us</a>
                    <a href="services.php" class="text-sm font-medium text-light hover:text-primary transition-colors duration-200">Services</a>
                    <a href="subscription.php" class="text-sm font-medium text-light hover:text-primary transition-colors duration-200">Subscription</a>
                    <a href="work.php" class="text-sm font-medium text-light hover:text-primary transition-colors duration-200">Our Work</a>
                    <a href="testimonials.php" class="text-sm font-medium text-light hover:text-primary transition-colors duration-200">Testimonials</a>
                    <a href="blogs.php" class="text-sm font-medium text-light hover:text-primary transition-colors duration-200">Blog</a>
                    <a href="#" class="text-sm font-medium text-light hover:text-primary transition-colors duration-200">FAQ</a>
                    <a href="contact.php" class="text-sm font-medium text-primary border-b-2 border-primary pb-1 transition-colors duration-200">Contact Us</a>
                </nav>
                
                <!-- CTA Button -->
                <div class="hidden md:flex">
                    <a href="#" class="inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-sm font-bold rounded-md text-dark bg-primary hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary focus:ring-offset-dark transition-all duration-200 transform hover:-translate-y-0.5">
                        Start A Project
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button type="button" id="mobile-menu-toggle" class="text-light hover:text-primary focus:outline-none p-2" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg id="menu-icon-open" class="h-6 w-6 block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg id="menu-icon-close" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div id="mobile-menu-container" class="md:hidden hidden bg-darker/95 backdrop-blur-xl border-b border-white/10 overflow-hidden transition-all duration-300 shadow-2xl">
            <div class="px-4 pt-2 pb-6 space-y-2 flex flex-col items-center justify-center">
                <a href="about.php" class="block px-3 py-4 text-base font-medium text-light hover:text-primary transition-colors duration-200 text-center w-full border-b border-white/5">About Us</a>
                <a href="services.php" class="block px-3 py-4 text-base font-medium text-light hover:text-primary transition-colors duration-200 text-center w-full border-b border-white/5">Services</a>
                <a href="subscription.php" class="block px-3 py-4 text-base font-medium text-light hover:text-primary transition-colors duration-200 text-center w-full border-b border-white/5">Subscription</a>
                <a href="work.php" class="block px-3 py-4 text-base font-medium text-light hover:text-primary transition-colors duration-200 text-center w-full border-b border-white/5">Our Work</a>
                <a href="testimonials.php" class="block px-3 py-4 text-base font-medium text-light hover:text-primary transition-colors duration-200 text-center w-full border-b border-white/5">Testimonials</a>
                <a href="blogs.php" class="block px-3 py-4 text-base font-medium text-light hover:text-primary transition-colors duration-200 text-center w-full border-b border-white/5">Blog</a>
                <a href="#" class="block px-3 py-4 text-base font-medium text-light hover:text-primary transition-colors duration-200 text-center w-full border-b border-white/5">FAQ</a>
                <a href="contact.php" class="block px-3 py-4 text-base font-medium text-primary transition-colors duration-200 text-center w-full">Contact Us</a>
                <div class="pt-4 w-full px-4">
                    <a href="#" class="block w-full text-center px-6 py-3 border border-transparent text-base font-bold rounded-md text-dark bg-primary hover:bg-yellow-400 focus:outline-none transition-all duration-200">
                        Start A Project
                    </a>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Main Content Wrapper -->
    <main class="pt-20">
