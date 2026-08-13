<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Design, Development | Digital Marketing Company in Houston</title>
    <meta name="description" content="Expand your online reach with YelloMonkey Labs. Best digital marketing company in Houston, we offer expert services, including website design, development, SEO, etc.">
    
    <!-- Google Fonts: Bebas Neue for headings, Source Sans 3 for body -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Sans+3:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (via CDN for Core PHP prototype) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
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
                    <a href="services.php" class="text-sm font-medium text-light hover:text-primary transition-colors duration-200">Services</a>
                    <a href="#" class="text-sm font-medium text-light hover:text-primary transition-colors duration-200">Our Work</a>
                    <a href="#" class="text-sm font-medium text-light hover:text-primary transition-colors duration-200">Clients</a>
                    <a href="#" class="text-sm font-medium text-light hover:text-primary transition-colors duration-200">Testimonials</a>
                    <a href="#" class="text-sm font-medium text-light hover:text-primary transition-colors duration-200">FAQ</a>
                </nav>
                
                <!-- CTA Button -->
                <div class="hidden md:flex">
                    <a href="#" class="inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-sm font-bold rounded-md text-dark bg-primary hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary focus:ring-offset-dark transition-all duration-200 transform hover:-translate-y-0.5">
                        Start A Project
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button type="button" class="text-light hover:text-primary focus:outline-none" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Main Content Wrapper -->
    <main class="pt-20">
