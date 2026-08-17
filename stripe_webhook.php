<?php
require_once 'config.php';

// Retrieve the request's body and parse it as JSON
$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '';

// Verify the signature manually to ensure it came from Stripe
function verifySignature($payload, $sig_header, $secret) {
    if (!$sig_header) return false;
    
    // Parse the header
    $parts = explode(',', $sig_header);
    $timestamp = '';
    $signatures = [];
    
    foreach ($parts as $part) {
        $keyVal = explode('=', trim($part), 2);
        if (count($keyVal) === 2) {
            if ($keyVal[0] === 't') {
                $timestamp = $keyVal[1];
            } elseif ($keyVal[0] === 'v1') {
                $signatures[] = $keyVal[1];
            }
        }
    }
    
    if (!$timestamp || empty($signatures)) return false;
    
    // Prevent replay attacks (reject if older than 5 minutes)
    if (abs(time() - $timestamp) > 300) return false;
    
    // Compute the expected signature
    $signed_payload = $timestamp . '.' . $payload;
    $expected_sig = hash_hmac('sha256', $signed_payload, $secret);
    
    // Check if expected signature is in the header's signatures
    foreach ($signatures as $sig) {
        if (hash_equals($expected_sig, $sig)) {
            return true;
        }
    }
    
    return false;
}

// Ensure the request came from Stripe by verifying the signature
if (!verifySignature($payload, $sig_header, STRIPE_WEBHOOK_SECRET)) {
    http_response_code(400);
    echo 'Webhook signature verification failed.';
    exit;
}

$event = json_decode($payload, true);

if ($event) {
    // Handle the checkout.session.completed event
    if ($event['type'] === 'checkout.session.completed') {
        $session = $event['data']['object'];
        
        $session_id = $session['id'];
        
        try {
            $db = getDB();
            $stmt = $db->prepare("UPDATE payments SET payment_status = 'completed' WHERE stripe_session_id = ?");
            $stmt->execute([$session_id]);
        } catch (Exception $e) {
            http_response_code(500);
            echo 'Database error.';
            exit;
        }
    }
    
    http_response_code(200);
    echo 'Success';
} else {
    http_response_code(400);
    echo 'Invalid payload';
}
?>
