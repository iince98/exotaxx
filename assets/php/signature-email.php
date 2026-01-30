<?php
/**
 * Email Handler with Enhanced Debugging
 * Use this version to identify email issues
 */

// ENABLE FULL ERROR REPORTING
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/email_debug.log');

// Set headers
header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');

// Response array
$response = [
    'success' => false,
    'message' => '',
    'debug' => []
];

// Log function
function debugLog($message) {
    global $response;
    $logMessage = date('Y-m-d H:i:s') . ' - ' . $message . "\n";
    file_put_contents(__DIR__ . '/email_debug.log', $logMessage, FILE_APPEND);
    $response['debug'][] = $message;
}

try {
    debugLog("Email handler started");
    
    // Check if mail function exists
    if (!function_exists('mail')) {
        throw new Exception('mail() function is not available on this server. Please use SMTP method.');
    }
    debugLog("mail() function is available");
    
    // Check if request is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method: ' . $_SERVER['REQUEST_METHOD']);
    }
    debugLog("POST request received");

    // Get form data
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $pdfBase64 = isset($_POST['pdf']) ? $_POST['pdf'] : '';
    
    // NEW: Get CC email addresses
    // $ccEmails = isset($_POST['cc_emails']) ? trim($_POST['cc_emails']) : '';
    // // You can also hardcode CC addresses if needed:
    $ccEmails = 'duyguince@yahoo.com';

    debugLog("Form data received - Name: $name, Email: $email");

    // Validate inputs
    if (empty($name)) {
        throw new Exception('Name is required');
    }

    if (empty($pdfBase64)) {
        throw new Exception('PDF data is missing');
    }

    // Decode the base64 PDF
    $pdfData = base64_decode($pdfBase64);
    if ($pdfData === false) {
        throw new Exception('Invalid PDF data - base64_decode failed');
    }
    
    $pdfSize = strlen($pdfData);
    debugLog("PDF decoded successfully - Size: " . $pdfSize . " bytes");

    // Configuration
    $to = 'iince98@gmail.com';
    $from_email = 'noreply@' . ($_SERVER['HTTP_HOST'] ?? 'exotaxx.com');
    $from_name = 'ExoTaxx GmbH - Personalfragebogen';
    
    debugLog("Email will be sent to: $to from: $from_email");
    
    // Create a unique boundary
    $boundary = md5(time() . rand());
    
    // Email subject
    $subject = 'Neuer Personalfragebogen - ' . $name;
    
    // Email headers
    $headers = "From: " . $from_name . " <" . $from_email . ">\r\n";
    $headers .= "Reply-To: " . ($email ? $email : $from_email) . "\r\n";
    
    // ADD CC HEADERS
    if (!empty($ccEmails)) {
        // Split multiple CC emails if separated by commas or semicolons
        $ccArray = preg_split('/[;,]+/', $ccEmails);
        $validCCEmails = [];
        
        foreach ($ccArray as $ccEmail) {
            $ccEmail = trim($ccEmail);
            if (!empty($ccEmail) && filter_var($ccEmail, FILTER_VALIDATE_EMAIL)) {
                $validCCEmails[] = $ccEmail;
            }
        }
        
        if (!empty($validCCEmails)) {
            $headers .= "Cc: " . implode(', ', $validCCEmails) . "\r\n";
            debugLog("CC emails added: " . implode(', ', $validCCEmails));
        }
    }
    
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $boundary . "\"\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    
    debugLog("Headers prepared");
    
    // Email body
    $message = "--" . $boundary . "\r\n";
    $message .= "Content-Type: text/html; charset=UTF-8\r\n";
    $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";


    
    // Simple HTML body for testing
    $htmlBody = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; padding: 20px; }
            .header { background: #667eea; color: white; padding: 20px; text-align: center; margin-bottom: 20px; }
            .content { background: #f8f9fa; padding: 20px; }
            .info { margin: 10px 0; padding: 10px; background: white; }
            .cc-notice { background: #fff3cd; border-left: 4px solid #ffc107; padding: 10px; margin-top: 20px; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h1>Neuer Personalfragebogen</h1>
        </div>
        <div class='content'>
            <h2>Mitarbeiterinformationen</h2>
            <div class='info'><strong>Name:</strong> " . htmlspecialchars($name) . "</div>";
    
    if (!empty($email)) {
        $htmlBody .= "<div class='info'><strong>E-Mail:</strong> " . htmlspecialchars($email) . "</div>";
    }
    
    if (!empty($phone)) {
        $htmlBody .= "<div class='info'><strong>Telefon:</strong> " . htmlspecialchars($phone) . "</div>";
    }
    
    // Add CC notice to email body if applicable
    if (!empty($ccEmails)) {
        $htmlBody .= "<div class='info'><strong>CC an:</strong> " . htmlspecialchars($ccEmails) . "</div>";
    }
    
    $htmlBody .= "
            <div class='info'><strong>Eingereicht am:</strong> " . date('d.m.Y H:i:s') . "</div>
            <div style='margin-top: 20px; padding: 15px; background: #e7f3ff;'>
                <strong>Anhang:</strong> Der ausgefüllte Personalfragebogen ist als PDF angehängt.
            </div>";
    
    // Add CC notice
    if (!empty($ccEmails)) {
        $htmlBody .= "
            <div class='cc-notice'>
                <strong>ℹ️ Diese E-Mail wurde auch an folgende Empfänger gesendet:</strong><br>
                " . htmlspecialchars($ccEmails) . "
            </div>";
    }
    
    $htmlBody .= "
        </div>
    </body>
    </html>";
    
    $message .= $htmlBody . "\r\n\r\n";
    
    // PDF attachment
    // ... (Previous logic for generating $htmlBody and the main PDF attachment)

    // 1. Attach the generated Questionnaire PDF (from Base64)
    $message .= "--" . $boundary . "\r\n";
    $message .= "Content-Type: application/pdf; name=\"Personalfragebogen_" . date('Y-m-d') . ".pdf\"\r\n";
    $message .= "Content-Transfer-Encoding: base64\r\n";
    $message .= "Content-Disposition: attachment; filename=\"Personalfragebogen_" . date('Y-m-d') . ".pdf\"\r\n\r\n";
    $message .= chunk_split(base64_encode($pdfData)) . "\r\n";

    // 2. NEW: Attach additional uploaded files from the user
    if (isset($_FILES['attachments'])) {
        foreach ($_FILES['attachments']['tmp_name'] as $key => $tmpName) {
            if ($_FILES['attachments']['error'][$key] === UPLOAD_ERR_OK) {
                $fileName = $_FILES['attachments']['name'][$key];
                $fileType = $_FILES['attachments']['type'][$key];
                $fileContent = file_get_contents($tmpName);
                
                $message .= "--" . $boundary . "\r\n";
                $message .= "Content-Type: $fileType; name=\"$fileName\"\r\n";
                $message .= "Content-Transfer-Encoding: base64\r\n";
                $message .= "Content-Disposition: attachment; filename=\"$fileName\"\r\n\r\n";
                $message .= chunk_split(base64_encode($fileContent)) . "\r\n";
                
                debugLog("Attached extra file: $fileName");
            }
        }
    }

    // End of message
    $message .= "--" . $boundary . "--";
    
    debugLog("Message body prepared - Total size: " . strlen($message) . " bytes");
    
    // Attempt to send email
    debugLog("Attempting to send email...");
    
    // Suppress warnings and capture them
    $oldErrorHandler = set_error_handler(function($errno, $errstr, $errfile, $errline) {
        debugLog("PHP Warning: $errstr in $errfile on line $errline");
        return true;
    });
    
    $mailResult = mail($to, $subject, $message, $headers);
    
    restore_error_handler();
    
    if ($mailResult) {
        debugLog("mail() returned TRUE - Email should be sent");
        
        $response['success'] = true;
        $response['message'] = 'E-Mail erfolgreich gesendet! ✓';
        
        // Try to send confirmation email
        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            debugLog("Attempting to send confirmation email to: $email");
            try {
                sendConfirmationEmail($email, $name, $pdfData);
                debugLog("Confirmation email sent");
            } catch (Exception $e) {
                debugLog("Confirmation email failed: " . $e->getMessage());
                // Don't fail the main request if confirmation fails
            }
        }
        
    } else {
        debugLog("mail() returned FALSE - Email was NOT sent");
        
        // Check for common issues
        $possibleIssues = [];
        
        // Check if sendmail is configured
        $sendmail = ini_get('sendmail_path');
        if (empty($sendmail)) {
            $possibleIssues[] = "sendmail_path is not configured";
        }
        
        debugLog("Possible issues: " . implode(", ", $possibleIssues));
        
        throw new Exception('mail() function returned false. Check debug log for details.');
    }
    
} catch (Exception $e) {
    debugLog("ERROR: " . $e->getMessage());
    
    $response['success'] = false;
    $response['message'] = 'Fehler: ' . $e->getMessage();
    
    // Add helpful suggestions
    if (strpos($e->getMessage(), 'mail()') !== false) {
        $response['message'] .= "\n\nMögliche Lösungen:\n";
        $response['message'] .= "1. Überprüfen Sie die Spam-Ordner\n";
        $response['message'] .= "2. Ihr Hosting-Provider blockiert möglicherweise E-Mails\n";
        $response['message'] .= "3. Verwenden Sie SMTP (PHPMailer) für zuverlässigeren Versand\n";
        $response['message'] .= "4. Kontaktieren Sie Ihren Hosting-Support\n";
    }
}

// Add server info to debug
$response['debug'][] = "Server: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown');
$response['debug'][] = "PHP Version: " . phpversion();
$response['debug'][] = "Sendmail Path: " . (ini_get('sendmail_path') ?: 'Not set');

// Return JSON response
echo json_encode($response, JSON_PRETTY_PRINT);
exit;

/**
 * Send confirmation email to the employee
 */
function sendConfirmationEmail($to, $name, $pdfData) {
    $boundary = md5(time() . rand());
    
    $subject = 'Bestätigung - ExoTaxx GmbH';
    
    $from_email = 'noreply@' . ($_SERVER['HTTP_HOST'] ?? 'exotaxx.com');
    
    $headers = "From: ExoTaxx GmbH <$from_email>\r\n";
    $headers .= "Reply-To: hr@exotaxx.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $boundary . "\"\r\n";
    
    $message = "--" . $boundary . "\r\n";
    $message .= "Content-Type: text/html; charset=UTF-8\r\n";
    $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    
    $htmlBody = "
    <!DOCTYPE html>
    <html>
    <body style='font-family: Arial, sans-serif; padding: 20px;'>
        <div style='background: #667eea; color: white; padding: 20px; text-align: center;'>
            <h1>✓ Bestätigung</h1>
        </div>
        <div style='padding: 20px; background: #f8f9fa;'>
            <p>Sehr geehrte(r) " . htmlspecialchars($name) . ",</p>
            <p>Ihr Personalfragebogen wurde erfolgreich eingereicht!</p>
            <p>Eine Kopie finden Sie im Anhang.</p>
            <p>Mit freundlichen Grüßen,<br>Ihr ExoTaxx GmbH Team</p>
        </div>
    </body>
    </html>";
    
    $message .= $htmlBody . "\r\n\r\n";
    
    // Attach PDF
    $message .= "--" . $boundary . "\r\n";
    $message .= "Content-Type: application/pdf; name=\"Ihre_Personalfragebogen.pdf\"\r\n";
    $message .= "Content-Transfer-Encoding: base64\r\n";
    $message .= "Content-Disposition: attachment; filename=\"Ihre_Personalfragebogen.pdf\"\r\n\r\n";
    $message .= chunk_split(base64_encode($pdfData)) . "\r\n";
    $message .= "--" . $boundary . "--";
    
    return mail($to, $subject, $message, $headers);
}
?>