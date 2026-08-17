<?php
$seo_title = $seo_title ?? 'Website Design, Development | Digital Marketing Company in Houston';
$seo_desc = $seo_desc ?? 'Expand your online reach with YelloMonkey Labs. Best digital marketing company in Houston, we offer expert services, including website design, development, SEO, etc.';
$seo_canonical = $seo_canonical ?? 'https://yellomonkey.com' . $_SERVER['REQUEST_URI'];
$current_page = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
if (empty($current_page) || $current_page == 'index.php') $current_page = 'index';
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
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="bg-dark text-light font-body antialiased selection:bg-primary selection:text-dark">
    
    <!-- Header / Navbar -->
    <header class="fixed w-full top-0 z-50 bg-dark/90 backdrop-blur-md border-b border-white/10 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="/" class="flex items-center gap-2 group">
                        <img src="/assets/images/Vector-120x15.webp" alt="YelloMonkey" class="h-5 md:h-6 object-contain">
                    </a>
                </div>
                
                <!-- Desktop Navigation -->
                <nav class="hidden md:flex space-x-8">
                    <a href="/about" class="text-sm font-medium transition-colors duration-200 <?php echo $current_page == 'about' ? 'text-primary border-b-2 border-primary pb-1' : 'text-light hover:text-primary'; ?>">About Us</a>
                    <a href="/services" class="text-sm font-medium transition-colors duration-200 <?php echo $current_page == 'services' ? 'text-primary border-b-2 border-primary pb-1' : 'text-light hover:text-primary'; ?>">Services</a>
                    <a href="/subscription" class="text-sm font-medium transition-colors duration-200 <?php echo $current_page == 'subscription' ? 'text-primary border-b-2 border-primary pb-1' : 'text-light hover:text-primary'; ?>">Subscription</a>
                    <a href="/work" class="text-sm font-medium transition-colors duration-200 <?php echo $current_page == 'work' ? 'text-primary border-b-2 border-primary pb-1' : 'text-light hover:text-primary'; ?>">Our Work</a>
                    <a href="/testimonials" class="text-sm font-medium transition-colors duration-200 <?php echo $current_page == 'testimonials' ? 'text-primary border-b-2 border-primary pb-1' : 'text-light hover:text-primary'; ?>">Testimonials</a>
                    <a href="/blogs" class="text-sm font-medium transition-colors duration-200 <?php echo ($current_page == 'blogs' || $current_page == 'blog_single') ? 'text-primary border-b-2 border-primary pb-1' : 'text-light hover:text-primary'; ?>">Blog</a>
                    <a href="/contact" class="text-sm font-medium transition-colors duration-200 <?php echo $current_page == 'faq' ? 'text-primary border-b-2 border-primary pb-1' : 'text-light hover:text-primary'; ?>">FAQ</a>
                    <a href="/contact" class="text-sm font-medium transition-colors duration-200 <?php echo $current_page == 'contact' ? 'text-primary border-b-2 border-primary pb-1' : 'text-light hover:text-primary'; ?>">Contact Us</a>
                </nav>
                
                <!-- CTA Buttons -->
                <div class="hidden lg:flex items-center gap-3">
                    <a href="https://calendly.com/995/usa-30-min-meet?month=2026-08" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center justify-center gap-2 px-4 h-[44px] border-2 border-primary rounded-lg bg-dark text-white hover:bg-primary hover:text-dark transition-colors duration-200">
                        <svg class="w-5 h-5 transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm4.2 14.2L11 11.8V6h1.5v5.2l4.5 3.7-.8 1.3z"/></svg>
                        <div class="text-[10px] font-bold leading-tight tracking-widest text-left uppercase">
                            Schedule<br>Meeting
                        </div>
                    </a>
                    <a href="/client-form" class="group inline-flex items-center justify-center gap-2 px-4 h-[44px] border-2 border-primary rounded-lg bg-dark text-white hover:bg-primary hover:text-dark transition-colors duration-200">
                        <svg class="w-5 h-5 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        <div class="text-[10px] font-bold tracking-widest uppercase">
                            Client Form
                        </div>
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
                <a href="/about" class="block px-3 py-4 text-base font-medium transition-colors duration-200 text-center w-full border-b border-white/5 <?php echo $current_page == 'about' ? 'text-primary' : 'text-light hover:text-primary'; ?>">About Us</a>
                <a href="/services" class="block px-3 py-4 text-base font-medium transition-colors duration-200 text-center w-full border-b border-white/5 <?php echo $current_page == 'services' ? 'text-primary' : 'text-light hover:text-primary'; ?>">Services</a>
                <a href="/subscription" class="block px-3 py-4 text-base font-medium transition-colors duration-200 text-center w-full border-b border-white/5 <?php echo $current_page == 'subscription' ? 'text-primary' : 'text-light hover:text-primary'; ?>">Subscription</a>
                <a href="/work" class="block px-3 py-4 text-base font-medium transition-colors duration-200 text-center w-full border-b border-white/5 <?php echo $current_page == 'work' ? 'text-primary' : 'text-light hover:text-primary'; ?>">Our Work</a>
                <a href="/testimonials" class="block px-3 py-4 text-base font-medium transition-colors duration-200 text-center w-full border-b border-white/5 <?php echo $current_page == 'testimonials' ? 'text-primary' : 'text-light hover:text-primary'; ?>">Testimonials</a>
                <a href="/blogs" class="block px-3 py-4 text-base font-medium transition-colors duration-200 text-center w-full border-b border-white/5 <?php echo ($current_page == 'blogs' || $current_page == 'blog_single') ? 'text-primary' : 'text-light hover:text-primary'; ?>">Blog</a>
                <a href="/contact" class="block px-3 py-4 text-base font-medium transition-colors duration-200 text-center w-full border-b border-white/5 <?php echo $current_page == 'faq' ? 'text-primary' : 'text-light hover:text-primary'; ?>">FAQ</a>
                <a href="/contact" class="block px-3 py-4 text-base font-medium transition-colors duration-200 text-center w-full <?php echo $current_page == 'contact' ? 'text-primary' : 'text-light hover:text-primary'; ?>">Contact Us</a>
                <div class="pt-4 w-full px-4 flex flex-col gap-3">
                    <a href="https://calendly.com/995/usa-30-min-meet?month=2026-08" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center gap-2 w-full px-6 py-3 border-2 border-primary text-base font-bold rounded-md text-white hover:bg-primary hover:text-dark transition-all duration-200 uppercase tracking-widest">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm4.2 14.2L11 11.8V6h1.5v5.2l4.5 3.7-.8 1.3z"/></svg>
                        Schedule Meeting
                    </a>
                    <a href="/client-form" class="flex items-center justify-center gap-2 w-full px-6 py-3 border-2 border-primary text-base font-bold rounded-md text-white hover:bg-primary hover:text-dark transition-all duration-200 uppercase tracking-widest">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        Client Form
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Global Sticky Pay Now Button -->
    <a href="/pay" class="fixed right-0 top-1/3 z-[100] bg-primary text-dark font-black text-sm uppercase tracking-widest py-6 px-2 rounded-l-lg hover:bg-yellow-400 transition-colors shadow-lg shadow-black/50 flex items-center justify-center border-l-2 border-y-2 border-primary" style="writing-mode: vertical-rl; transform: rotate(180deg);">
        Pay Now
    </a>
    
    <!-- Main Content Wrapper -->
    <main class="pt-20">
