<?php
/**
 * Email-Handler für die Stundenzettel-Einreichung
 * Verarbeitet Formulardaten, dekodiert das PDF und versendet es als Anhang.
 */

// ----------------- FEHLERBERICHTERSTATTUNG -----------------
error_reporting(E_ALL);
ini_set('display_errors', 0); // In Produktion auf 0 setzen
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/timesheet_email_debug.log');

header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');

$response = [
    'success' => false,
    'message' => '',
    'debug' => []
];

/**
 * Hilfsfunktion für Debug-Logs
 */
function debugLog($msg) {
    global $response;
    $logEntry = date('Y-m-d H:i:s') . " - $msg\n";
    file_put_contents(__DIR__ . '/timesheet_email_debug.log', $logEntry, FILE_APPEND);
    $response['debug'][] = $msg;
}

try {
    debugLog("Stundenzettel-E-Mail-Prozess gestartet");

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Ungültige Anfrage-Methode.');
    }

    if (!function_exists('mail')) {
        throw new Exception('Die PHP mail() Funktion ist auf diesem Server deaktiviert.');
    }

    // ----------------- DATENERFASSUNG -----------------
    $company     = $_POST['firma'] ?? '';
    $employeeID  = $_POST['personalnummer'] ?? '';
    $lastName    = $_POST['nachname'] ?? '';
    $firstName   = $_POST['vorname'] ?? '';
    $senderEmail = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $month       = $_POST['monat'] ?? '';
    $year        = $_POST['jahr'] ?? '';

    $pdfBase64        = $_POST['pdf'] ?? ''; 
    $signatureDataUrl = $_POST['signatureDataUrl'] ?? ''; 

    // Empfänger
    $adminEmail = 'info@exotaxx.de';
    $ccEmail    = 'iince98@gmail.com';

    debugLog("Daten empfangen für: $lastName, $firstName (ID: $employeeID)");

    if (empty($company) || empty($employeeID) || empty($lastName) || empty($firstName) || empty($senderEmail)) {
        throw new Exception('Alle persönlichen Pflichtfelder müssen ausgefüllt sein.');
    }

    if (!filter_var($senderEmail, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Bitte geben Sie eine gültige E-Mail-Adresse an.');
    }

    // ----------------- PDF DEKODIERUNG -----------------
    if (empty($pdfBase64)) {
        throw new Exception('PDF-Daten fehlen in der Anfrage.');
    }
    
    if (strpos($pdfBase64, ',') !== false) {
        $pdfBase64 = explode(',', $pdfBase64)[1];
    }
    
    $pdfData = base64_decode($pdfBase64);
    if ($pdfData === false) {
        throw new Exception('Fehler beim Dekodieren der PDF-Daten.');
    }
    debugLog("PDF erfolgreich dekodiert. Größe: " . strlen($pdfData) . " Bytes.");

    // ----------------- E-MAIL KONSTRUKTION -----------------
    $fromName  = 'ExoTaxx GmbH - Zeiterfassung';
    $fromEmail = 'noreply@exotaxx.de';
    $subject   = "Neuer Stundenzettel eingereicht - $lastName $firstName";
    
    $boundary = md5(time() . uniqid());

    // Header
    $headers  = "From: $fromName <$fromEmail>\r\n";
    $headers .= "Reply-To: $senderEmail\r\n";
    $headers .= "Cc: $ccEmail\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // ----------------- E-MAIL TEXT (HTML) -----------------
    $htmlContent = "
    <html>
    <body style='font-family: Arial, sans-serif; color: #333;'>
        <div style='background: #4e73df; color: white; padding: 20px; border-radius: 8px;'>
            <h1>Stundenzettel Einreichung</h1>
        </div>
        <div style='padding: 20px; border: 1px solid #eee; border-radius: 8px; margin-top: 10px;'>
            <p><strong>Firma:</strong> " . htmlspecialchars($company) . "</p>
            <p><strong>Personalnummer:</strong> " . htmlspecialchars($employeeID) . "</p>
            <p><strong>Name:</strong> " . htmlspecialchars("$firstName $lastName") . "</p>
            <p><strong>Zeitraum:</strong> " . htmlspecialchars("$month $year") . "</p>
            <hr style='border: 0; border-top: 1px solid #eee; margin: 20px 0;'>
            <p>Der unterschriebene Stundenzettel wurde dieser E-Mail als PDF angehängt.</p>
            <div style='margin-top: 20px;'>
                <strong>Digitale Unterschrift:</strong><br>
                <img src='$signatureDataUrl' alt='Unterschrift' style='max-width: 300px; border: 1px solid #ddd; margin-top: 10px; background: #fff;'>
            </div>
        </div>
    </body>
    </html>";

    $message = "--$boundary\r\n";
    $message .= "Content-Type: text/html; charset=UTF-8\r\n";
    $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $message .= $htmlContent . "\r\n\r\n";

    // ----------------- PDF ANHANG -----------------
    $safeLastName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $lastName);
    $pdfFilename  = "Stundenzettel_" . $safeLastName . "_" . date('Y-m-d') . ".pdf";

    $message .= "--$boundary\r\n";
    $message .= "Content-Type: application/pdf; name=\"$pdfFilename\"\r\n";
    $message .= "Content-Transfer-Encoding: base64\r\n";
    $message .= "Content-Disposition: attachment; filename=\"$pdfFilename\"\r\n\r\n";
    $message .= chunk_split(base64_encode($pdfData)) . "\r\n";
    $message .= "--$boundary--";

    // ----------------- VERSAND -----------------
    // Sendet an Admin und eine Kopie an den Mitarbeiter
    $recipients = "$adminEmail, $senderEmail";
    debugLog("Versandversuch an: $recipients");

    if (@mail($recipients, $subject, $message, $headers)) {
        debugLog("E-Mail erfolgreich versendet.");
        $response['success'] = true;
        $response['message'] = 'Ihr Stundenzettel wurde erfolgreich versendet!';
    } else {
        throw new Exception('Der Server konnte die E-Mail nicht versenden. Bitte kontaktieren Sie den Support.');
    }

} catch (Exception $e) {
    debugLog("KRITISCHER FEHLER: " . $e->getMessage());
    $response['success'] = false;
    $response['message'] = $e->getMessage();
}

echo json_encode($response, JSON_PRETTY_PRINT);