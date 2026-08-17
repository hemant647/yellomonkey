<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Require PHPMailer classes manually since we don't have Composer
require_once __DIR__ . '/PHPMailer/src/Exception.php';
require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/src/SMTP.php';

/**
 * Send an email using PHPMailer with SMTP.
 * 
 * @param string|array $to Email address(es) to send to.
 * @param string $subject Email subject.
 * @param string $htmlBody HTML content of the email.
 * @param string|null $replyTo Optional reply-to address.
 * @return bool True on success, false on failure.
 */
function sendMail($to, $subject, $htmlBody, $replyTo = null) {
    // 1. Log email locally (useful for localhost testing)
    $logDir = dirname(__DIR__) . '/scratch';
    if (!is_dir($logDir)) {
        mkdir($logDir, 0777, true);
    }
    
    $logFile = $logDir . '/email_transmissions.log';
    
    // Determine the primary recipient for logging
    $primaryTo = is_array($to) ? implode(', ', $to) : $to;
    
    $logMessage = "[" . date('Y-m-d H:i:s') . "] EMAIL SENT TO: " . $primaryTo . "\n" .
                   "FROM: " . SMTP_EMAIL_FROM . "\n" .
                   "SUBJECT: " . $subject . "\n" .
                   "MESSAGE (HTML):\n" . $htmlBody . "\n" .
                   "--------------------------------------------------\n";
    
    file_put_contents($logFile, $logMessage, FILE_APPEND);

    // 2. Outbound Titan SMTP transmission via PHPMailer
    if (defined('TITAN_SMTP_PASSWORD') && !empty(TITAN_SMTP_PASSWORD)) {
        $mail = new PHPMailer(true);

        try {
            // Hostinger Titan SMTP Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.titan.email'; 
            $mail->SMTPAuth   = true;
            $mail->Username   = SMTP_EMAIL_FROM;
            $mail->Password   = TITAN_SMTP_PASSWORD; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Titan uses SSL on 465
            $mail->Port       = 465;

            // Sender info
            $mail->setFrom(SMTP_EMAIL_FROM, 'Yellomonkey Labs');
            
            if ($replyTo) {
                $mail->addReplyTo($replyTo);
            }

            // Add recipients
            if (is_array($to)) {
                foreach ($to as $address) {
                    $address = trim($address);
                    if (!empty($address)) {
                        $mail->addAddress($address);
                    }
                }
            } else {
                if (strpos($to, ',') !== false) {
                    $addresses = explode(',', $to);
                    foreach ($addresses as $address) {
                        $address = trim($address);
                        if (!empty($address)) {
                            $mail->addAddress($address);
                        }
                    }
                } else {
                    $mail->addAddress($to);
                }
            }

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $htmlBody;
            $mail->AltBody = strip_tags(str_replace(['<br>', '<br/>', '</p>'], "\n", $htmlBody));

            return $mail->send();
        } catch (Exception $e) {
            return false;
        }
    }

    return true;
}
