<?php
// Client Form Page
require_once 'config.php';
include 'includes/header.php';
?>

<section class="min-h-screen py-24 bg-[#232323] relative flex items-center justify-center pt-32">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">
        
        <div class="text-center mb-12">
            <h1 class="text-white text-4xl md:text-5xl font-black font-heading tracking-wide mb-4 uppercase">
                Client Form
            </h1>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                Please fill out the form below to help us understand your needs better.
            </p>
        </div>

        <div class="bg-white p-2 md:p-4 rounded-3xl shadow-2xl flex justify-center w-full overflow-hidden">
            <div class="w-full max-w-[640px] flex justify-center">
                <iframe 
                    src="https://docs.google.com/forms/d/e/1FAIpQLScwKreg7fTJgREiPI_2OHY6JoLAmoXo_FQ1fephu9sHDj7Jfw/viewform?embedded=true" 
                    width="100%" 
                    height="1405" 
                    frameborder="0" 
                    marginheight="0" 
                    marginwidth="0"
                    class="w-full max-w-[640px] bg-transparent"
                    style="border-radius: 12px;"
                >Loading…</iframe>
            </div>
        </div>

    </div>
</section>

<?php include 'includes/footer.php'; ?>
