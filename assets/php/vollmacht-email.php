<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/vollmacht_debug.log');

header('Content-Type: application/json');

$response = ['success' => false, 'message' => '', 'debug' => []];

function debugLog($message) {
    global $response;
    file_put_contents(__DIR__ . '/vollmacht_debug.log', date('Y-m-d H:i:s') . ' - ' . $message . "\n", FILE_APPEND);
    $response['debug'][] = $message;
}

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Invalid method.');

    $vgName = isset($_POST['vg_name']) ? trim($_POST['vg_name']) : 'Unbekannt';
    $customerEmail = isset($_POST['customer_email']) ? trim($_POST['customer_email']) : '';
    $pdfBase64 = isset($_POST['pdf']) ? $_POST['pdf'] : '';

    // FIX: Define these BEFORE building $toRecipients
    $companyEmail = 'info@exotaxx.de';
    $ccEmail = 'iince98@gmail.com';
    $toRecipients = $companyEmail . ", " . $customerEmail;

    if (empty($customerEmail)) throw new Exception('Email fehlt.');
    if (empty($pdfBase64)) throw new Exception('PDF fehlt.');

    $pdfData = base64_decode($pdfBase64);
    $boundary = md5(time());
    $subject = 'Neue Vollmacht - ' . $vgName;

    $headers  = "From: ExoTaxx <noreply@exotaxx.de>\r\n";
    $headers .= "Reply-To: $customerEmail\r\n";
    $headers .= "Cc: $ccEmail\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

    $message = "--$boundary\r\n";
    $message .= "Content-Type: text/html; charset=UTF-8\r\n\r\n";
    $message .= "<h1>Neue Vollmacht erhalten</h1><p>Name: $vgName</p>\r\n";
    $message .= "--$boundary\r\n";
    $message .= "Content-Type: application/pdf; name=\"Vollmacht.pdf\"\r\n";
    $message .= "Content-Transfer-Encoding: base64\r\n";
    $message .= "Content-Disposition: attachment; filename=\"Vollmacht.pdf\"\r\n\r\n";
    $message .= chunk_split(base64_encode($pdfData)) . "\r\n";
    $message .= "--$boundary--";

    debugLog("Sending to: $toRecipients");

    if (@mail($toRecipients, $subject, $message, $headers)) {
        $response['success'] = true;
        $response['message'] = 'Erfolgreich gesendet!';
    } else {
        throw new Exception('Mail-Server Fehler.');
    }

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);