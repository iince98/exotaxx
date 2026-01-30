<?php
/**
 * Email Handler for Employee Questionnaire
 * Sends form PDF and attachments to company email
 * Sends confirmation to customer email
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
    $customerEmail = isset($_POST['customer_email']) ? trim($_POST['customer_email']) : '';
    $pdfBase64 = isset($_POST['pdf']) ? $_POST['pdf'] : '';
    
    // Company email (where all submissions go)
    $companyEmail = 'info@exotaxx.com';
    
    // CC email addresses (for notifications)
    $ccEmails = 'iince98@gmail.com';

    debugLog("Form data received - Name: $name, Customer Email: $customerEmail");

    // Validate inputs
    if (empty($name)) {
        throw new Exception('Name is required');
    }

    if (empty($customerEmail) || !filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Valid customer email is required');
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
    $from_email = 'noreply@' . ($_SERVER['HTTP_HOST'] ?? 'exotaxx.com');
    $from_name = 'ExoTaxx GmbH - Personalfragebogen';
    
    debugLog("Email will be sent to: $companyEmail from: $from_email");
    
    // =====================================
    // SEND EMAIL TO COMPANY
    // =====================================
    
    // Create a unique boundary
    $boundary = md5(time() . rand());
    
    // Email subject
    $subject = 'Neuer Personalfragebogen - ' . $name;
    
    // Email headers
    $headers = "From: " . $from_name . " <" . $from_email . ">\r\n";
    $headers .= "Reply-To: " . $customerEmail . "\r\n";
    
    // Add CC headers
    if (!empty($ccEmails)) {
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
    
    // HTML body
    $htmlBody = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; padding: 20px; }
            .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; text-align: center; margin-bottom: 20px; border-radius: 10px; }
            .content { background: #f8f9fa; padding: 20px; border-radius: 10px; }
            .info { margin: 10px 0; padding: 10px; background: white; border-radius: 5px; }
            .info strong { color: #667eea; }
            .attachment-note { background: #e7f3ff; border-left: 4px solid #667eea; padding: 15px; margin-top: 20px; border-radius: 5px; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h1>📋 Neuer Personalfragebogen eingegangen</h1>
        </div>
        <div class='content'>
            <h2>Mitarbeiterinformationen</h2>
            <div class='info'><strong>Name:</strong> " . htmlspecialchars($name) . "</div>
            <div class='info'><strong>E-Mail:</strong> " . htmlspecialchars($customerEmail) . "</div>
            <div class='info'><strong>Eingereicht am:</strong> " . date('d.m.Y H:i:s') . "</div>
            
            <div class='attachment-note'>
                <strong>📎 Anhänge:</strong><br>
                Der ausgefüllte Personalfragebogen ist als PDF angehängt.";
    
    // Check if there are additional attachments
    if (isset($_FILES['attachments']) && is_array($_FILES['attachments']['name'])) {
        $attachmentCount = count($_FILES['attachments']['name']);
        if ($attachmentCount > 0) {
            $htmlBody .= "<br>Zusätzlich wurden " . $attachmentCount . " weitere Dokument(e) angehängt.";
        }
    }
    
    $htmlBody .= "
            </div>
        </div>
    </body>
    </html>";
    
    $message .= $htmlBody . "\r\n\r\n";
    
    // Attach the generated Questionnaire PDF
    $message .= "--" . $boundary . "\r\n";
    $message .= "Content-Type: application/pdf; name=\"Personalfragebogen_" . $name . "_" . date('Y-m-d') . ".pdf\"\r\n";
    $message .= "Content-Transfer-Encoding: base64\r\n";
    $message .= "Content-Disposition: attachment; filename=\"Personalfragebogen_" . $name . "_" . date('Y-m-d') . ".pdf\"\r\n\r\n";
    $message .= chunk_split(base64_encode($pdfData)) . "\r\n";

    // Attach additional uploaded files
    if (isset($_FILES['attachments']) && is_array($_FILES['attachments']['name'])) {
        foreach ($_FILES['attachments']['tmp_name'] as $key => $tmpName) {
            if ($_FILES['attachments']['error'][$key] === UPLOAD_ERR_OK) {
                $fileName = $_FILES['attachments']['name'][$key];
                $fileType = $_FILES['attachments']['type'][$key];
                $fileContent = file_get_contents($tmpName);
                
                // Determine mime type if not provided
                if (empty($fileType)) {
                    $fileType = 'application/octet-stream';
                }
                
                $message .= "--" . $boundary . "\r\n";
                $message .= "Content-Type: $fileType; name=\"$fileName\"\r\n";
                $message .= "Content-Transfer-Encoding: base64\r\n";
                $message .= "Content-Disposition: attachment; filename=\"$fileName\"\r\n\r\n";
                $message .= chunk_split(base64_encode($fileContent)) . "\r\n";
                
                debugLog("Attached extra file: $fileName (Size: " . strlen($fileContent) . " bytes)");
            }
        }
    }

    // End of message
    $message .= "--" . $boundary . "--";
    
    debugLog("Message body prepared - Total size: " . strlen($message) . " bytes");
    
    // Attempt to send email to company
    debugLog("Attempting to send email to company...");
    
    $mailResult = @mail($companyEmail, $subject, $message, $headers);
    
    if ($mailResult) {
        debugLog("Company email sent successfully");
        
        // =====================================
        // SEND CONFIRMATION EMAIL TO CUSTOMER
        // =====================================
        
        try {
            debugLog("Attempting to send confirmation email to customer: $customerEmail");
            sendConfirmationEmail($customerEmail, $name, $pdfData);
            debugLog("Confirmation email sent to customer");
            
            $response['success'] = true;
            $response['message'] = 'Formular erfolgreich gesendet! Sie erhalten eine Bestätigung per E-Mail.';
            
        } catch (Exception $e) {
            debugLog("Confirmation email failed: " . $e->getMessage());
            // Still mark as success since company email was sent
            $response['success'] = true;
            $response['message'] = 'Formular erfolgreich gesendet! (Hinweis: Bestätigungs-E-Mail konnte nicht zugestellt werden)';
        }
        
    } else {
        debugLog("mail() returned FALSE - Email was NOT sent");
        
        // Check for common issues
        $sendmail = ini_get('sendmail_path');
        if (empty($sendmail)) {
            debugLog("Issue: sendmail_path is not configured");
        }
        
        throw new Exception('E-Mail konnte nicht gesendet werden. Bitte kontaktieren Sie den Support.');
    }
    
} catch (Exception $e) {
    debugLog("ERROR: " . $e->getMessage());
    
    $response['success'] = false;
    $response['message'] = 'Fehler: ' . $e->getMessage();
    
    // Add helpful suggestions
    if (strpos($e->getMessage(), 'mail()') !== false || strpos($e->getMessage(), 'gesendet') !== false) {
        $response['message'] .= "\n\nMögliche Lösungen:\n";
        $response['message'] .= "• Überprüfen Sie die Spam-Ordner\n";
        $response['message'] .= "• Ihr Hosting-Provider blockiert möglicherweise E-Mails\n";
        $response['message'] .= "• Kontaktieren Sie Ihren Hosting-Support";
    }
}

// Add server info to debug
$response['debug'][] = "Server: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown');
$response['debug'][] = "PHP Version: " . phpversion();
$response['debug'][] = "Sendmail Path: " . (ini_get('sendmail_path') ?: 'Not set');
$response['debug'][] = "Upload Max Filesize: " . ini_get('upload_max_filesize');
$response['debug'][] = "Post Max Size: " . ini_get('post_max_size');

// Return JSON response
echo json_encode($response, JSON_PRETTY_PRINT);
exit;

/**
 * Send confirmation email to the customer
 */
function sendConfirmationEmail($to, $name, $pdfData) {
    $boundary = md5(time() . rand() . 'confirmation');
    
    $subject = 'Bestätigung - ExoTaxx GmbH Personalfragebogen';
    
    $from_email = 'noreply@' . ($_SERVER['HTTP_HOST'] ?? 'exotaxx.com');
    
    $headers = "From: ExoTaxx GmbH <$from_email>\r\n";
    $headers .= "Reply-To: info@exotaxx.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $boundary . "\"\r\n";
    
    $message = "--" . $boundary . "\r\n";
    $message .= "Content-Type: text/html; charset=UTF-8\r\n";
    $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    
    $htmlBody = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; padding: 20px; }
            .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 10px; }
            .header h1 { margin: 0; font-size: 28px; }
            .content { background: #f8f9fa; padding: 30px; margin-top: 20px; border-radius: 10px; }
            .success-icon { font-size: 64px; text-align: center; margin-bottom: 20px; }
            .message { background: white; padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #28a745; }
            .footer { text-align: center; margin-top: 30px; color: #6c757d; font-size: 12px; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h1>✅ Bestätigung</h1>
        </div>
        <div class='content'>
            <div class='success-icon'>✅</div>
            <div class='message'>
                <p><strong>Sehr geehrte(r) " . htmlspecialchars($name) . ",</strong></p>
                <p>vielen Dank für das Ausfüllen des Personalfragebogens!</p>
                <p>Ihr Fragebogen wurde erfolgreich bei uns eingereicht und wird schnellstmöglich bearbeitet.</p>
                <p>Eine Kopie Ihres ausgefüllten Fragebogens finden Sie im Anhang dieser E-Mail.</p>
                <p style='margin-top: 30px;'>
                    <strong>Mit freundlichen Grüßen,</strong><br>
                    Ihr ExoTaxx GmbH Team
                </p>
            </div>
            <div class='footer'>
                <p>Diese E-Mail wurde automatisch generiert. Bitte antworten Sie nicht auf diese Nachricht.</p>
                <p>Bei Fragen wenden Sie sich bitte an: hr@exotaxx.com</p>
            </div>
        </div>
    </body>
    </html>";
    
    $message .= $htmlBody . "\r\n\r\n";
    
    // Attach PDF copy
    $message .= "--" . $boundary . "\r\n";
    $message .= "Content-Type: application/pdf; name=\"Ihr_Personalfragebogen.pdf\"\r\n";
    $message .= "Content-Transfer-Encoding: base64\r\n";
    $message .= "Content-Disposition: attachment; filename=\"Ihr_Personalfragebogen_ExoTaxx.pdf\"\r\n\r\n";
    $message .= chunk_split(base64_encode($pdfData)) . "\r\n";
    $message .= "--" . $boundary . "--";
    
    $result = @mail($to, $subject, $message, $headers);
    
    if (!$result) {
        throw new Exception("Failed to send confirmation email");
    }
    
    return $result;
}
?>