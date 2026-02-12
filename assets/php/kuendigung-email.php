<?php
/**
 * Email Handler for Termination Notification
 * Sends generated PDF + uploaded termination document
 */

// ENABLE FULL ERROR REPORTING
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/termination_email_debug.log');

// JSON headers
header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');

$response = [
    'success' => false,
    'message' => '',
    'debug' => []
];

function debugLog($message) {
    global $response;
    $logMessage = date('Y-m-d H:i:s') . ' - ' . $message . "\n";
    file_put_contents(__DIR__ . '/termination_email_debug.log', $logMessage, FILE_APPEND);
    $response['debug'][] = $message;
}

try {

    debugLog("Termination email handler started");

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    if (!function_exists('mail')) {
        throw new Exception('mail() function is not available.');
    }

    // ===============================
    // GET FORM DATA
    // ===============================

    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $customerEmail = isset($_POST['customer_email']) ? trim($_POST['customer_email']) : '';
    $pdfBase64 = isset($_POST['pdf']) ? $_POST['pdf'] : '';

    $companyEmail = 'info@exotaxx.de';
    $ccEmail = 'iince98@gmail.com';

    debugLog("Form data received - Name: $name | Email: $customerEmail");

    if (empty($name)) {
        throw new Exception('Name is required.');
    }

    if (empty($customerEmail) || !filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Valid customer email is required.');
    }

    if (empty($pdfBase64)) {
        throw new Exception('PDF data missing.');
    }

    // Decode PDF
    $pdfData = base64_decode($pdfBase64);
    if ($pdfData === false) {
        throw new Exception('Invalid PDF base64.');
    }

    debugLog("PDF decoded. Size: " . strlen($pdfData) . " bytes");

    // ===============================
    // EMAIL CONFIG
    // ===============================

    $from_email = 'noreply@' . ($_SERVER['HTTP_HOST'] ?? 'exotaxx.de');
    $from_name = 'ExoTaxx GmbH - Kündigungsmitteilung';

    $boundary = md5(time() . rand());

    $subject = 'Neue Kündigungsmitteilung - ' . $name;

    $headers  = "From: $from_name <$from_email>\r\n";
    $headers .= "Reply-To: $customerEmail\r\n";
    $headers .= "Cc: $ccEmail\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

    $toRecipients = $companyEmail . ", " . $customerEmail;

    // ===============================
    // EMAIL BODY
    // ===============================

    $message  = "--$boundary\r\n";
    $message .= "Content-Type: text/html; charset=UTF-8\r\n";
    $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";

    $htmlBody = "
    <html>
    <head>
        <meta charset='UTF-8'>
        <style>
            body { font-family: Arial, sans-serif; padding:20px; color:#333; }
            .header { background:#dc3545; color:white; padding:20px; border-radius:8px; text-align:center; }
            .content { background:#f8f9fa; padding:20px; margin-top:20px; border-radius:8px; }
            .info { margin-bottom:10px; padding:10px; background:white; border-radius:5px; }
            .info strong { color:#dc3545; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h1>📄 Neue Mitteilung über die Beendigung</h1>
        </div>
        <div class='content'>
            <div class='info'><strong>Mitarbeiter:</strong> " . htmlspecialchars($name) . "</div>
            <div class='info'><strong>E-Mail:</strong> " . htmlspecialchars($customerEmail) . "</div>
            <div class='info'><strong>Eingereicht am:</strong> " . date('d.m.Y H:i:s') . "</div>
            <p>Die unterschriebene Mitteilung ist als PDF angehängt.</p>
        </div>
    </body>
    </html>
    ";

    $message .= $htmlBody . "\r\n\r\n";

    // ===============================
    // ATTACH GENERATED PDF
    // ===============================

    $pdfFilename = "Kuendigungsmitteilung_" . preg_replace('/[^a-zA-Z0-9_-]/', '_', $name) . "_" . date('Y-m-d') . ".pdf";

    $message .= "--$boundary\r\n";
    $message .= "Content-Type: application/pdf; name=\"$pdfFilename\"\r\n";
    $message .= "Content-Transfer-Encoding: base64\r\n";
    $message .= "Content-Disposition: attachment; filename=\"$pdfFilename\"\r\n\r\n";
    $message .= chunk_split(base64_encode($pdfData)) . "\r\n";

    // ===============================
    // ATTACH UPLOADED TERMINATION FILE
    // ===============================

    if (isset($_FILES['attachments']) && is_array($_FILES['attachments']['name'])) {

        foreach ($_FILES['attachments']['tmp_name'] as $key => $tmpName) {
    
            if ($_FILES['attachments']['error'][$key] === UPLOAD_ERR_OK) {
    
                $fileName = $_FILES['attachments']['name'][$key];
                $fileType = $_FILES['attachments']['type'][$key] ?: 'application/octet-stream';
                $fileContent = file_get_contents($tmpName);
    
                $message .= "--$boundary\r\n";
                $message .= "Content-Type: $fileType; name=\"$fileName\"\r\n";
                $message .= "Content-Transfer-Encoding: base64\r\n";
                $message .= "Content-Disposition: attachment; filename=\"$fileName\"\r\n\r\n";
                $message .= chunk_split(base64_encode($fileContent)) . "\r\n";
    
                debugLog("Attached file: $fileName");
            }
        }
    }
    

    $message .= "--$boundary--";

    debugLog("Sending email to: $toRecipients");

    $mailResult = @mail($toRecipients, $subject, $message, $headers);

    if ($mailResult) {
        debugLog("Email successfully sent.");
        $response['success'] = true;
        $response['message'] = 'Formular erfolgreich gesendet!';
    } else {
        debugLog("mail() failed.");
        throw new Exception('E-Mail konnte nicht gesendet werden.');
    }

} catch (Exception $e) {

    debugLog("ERROR: " . $e->getMessage());

    $response['success'] = false;
    $response['message'] = 'Fehler: ' . $e->getMessage();
}

// Server debug info
$response['debug'][] = "Server: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown');
$response['debug'][] = "PHP Version: " . phpversion();
$response['debug'][] = "Upload Max Filesize: " . ini_get('upload_max_filesize');
$response['debug'][] = "Post Max Size: " . ini_get('post_max_size');

echo json_encode($response, JSON_PRETTY_PRINT);
exit;
?>