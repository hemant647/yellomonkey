<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Cancelled - YelloMonkey Labs</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { primary: '#FFC107', dark: '#111111' } } } }
    </script>
</head>
<body class="bg-dark min-h-screen flex items-center justify-center p-6">
    <div class="bg-[#1c1c1c] p-10 rounded-2xl max-w-lg w-full text-center border border-white/10 shadow-2xl">
        <div class="w-20 h-20 bg-red-500/20 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </div>
        <h1 class="text-3xl font-black text-white uppercase tracking-wider mb-4">Payment Cancelled</h1>
        <p class="text-gray-400 mb-8">Your payment process was cancelled. No charges were made.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/pay" class="inline-block px-8 py-3 bg-primary text-dark font-bold uppercase tracking-wider rounded-md hover:bg-yellow-400 transition-colors">Try Again</a>
            <a href="/" class="inline-block px-8 py-3 border border-white/20 text-white font-bold uppercase tracking-wider rounded-md hover:bg-white/5 transition-colors">Return Home</a>
        </div>
    </div>
</body>
</html>
