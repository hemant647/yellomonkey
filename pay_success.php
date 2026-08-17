<?php
require_once 'config.php';
session_start();

$session_id = $_GET['session_id'] ?? '';
$status_updated = false;

if ($session_id) {
    try {
        // Just verify the session exists in our database, but DO NOT update the status.
        // The webhook (stripe_webhook.php) is now exclusively responsible for marking payments as completed.
        $db = getDB();
        $stmt = $db->prepare("SELECT id FROM payments WHERE stripe_session_id = ?");
        $stmt->execute([$session_id]);
        if ($stmt->rowCount() > 0) {
            $status_updated = true; // Indicates it's a valid session they are returning from
        }
    } catch (Exception $e) {
        // error handling
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful - YelloMonkey Labs</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { primary: '#FFC107', dark: '#111111' } } } }
    </script>
</head>
<body class="bg-dark min-h-screen flex items-center justify-center p-6">
    <div class="bg-[#1c1c1c] p-10 rounded-2xl max-w-lg w-full text-center border border-white/10 shadow-2xl">
        <div class="w-20 h-20 bg-green-500/20 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <h1 class="text-3xl font-black text-white uppercase tracking-wider mb-4">Payment Successful!</h1>
        <p class="text-gray-400 mb-8">Thank you for your payment. Your transaction has been completed securely.</p>
        <a href="/" class="inline-block px-8 py-3 bg-primary text-dark font-bold uppercase tracking-wider rounded-md hover:bg-yellow-400 transition-colors">Return to Home</a>
    </div>
</body>
</html>
