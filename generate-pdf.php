<?php
// Fehlerberichterstattung einschalten, falls etwas schief geht
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!file_exists('fpdf.php')) {
    die("Fehler: fpdf.php wurde nicht im Verzeichnis gefunden. Bitte laden Sie die Datei hoch.");
}

require('fpdf.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['kundenname'])) {
    
    // Eingaben bereinigen
    $name = $_POST['kundenname'];
    $nachricht = $_POST['nachricht'];

    // PDF Initialisieren
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    // UTF-8 zu ISO-8859-1 konvertieren für Umlaute (ä, ö, ü, ß)
    $titel = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Kundenbestätigung');
    $label_name = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Kundenname: ');
    $label_text = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Nachricht: ');
    
    $pdf->Cell(0, 10, $titel, 0, 1, 'C');
    $pdf->Ln(10);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, $label_name . iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $name), 0, 1);
    $pdf->Ln(5);
    $pdf->Cell(0, 10, $label_text, 0, 1);
    $pdf->MultiCell(0, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $nachricht));

    // PDF zum Download schicken
    $pdf->Output('D', 'Kunden_Dokument.pdf');
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>PDF Generator Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; line-height: 1.6; }
        .container { max-width: 500px; background: #f4f4f4; padding: 20px; border-radius: 8px; }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; }
        button { background: #007bff; color: white; padding: 10px 15px; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>

<div class="container">
    <h2>PDF-Erstellung Test</h2>
    <form method="post">
        <label>Name des Kunden:</label>
        <input type="text" name="kundenname" placeholder="z.B. Max Mustermann" required>
        
        <label>Ihre Nachricht (Umlaute möglich):</label>
        <textarea name="nachricht" rows="5" placeholder="Geben Sie hier Text ein..."></textarea>
        
        <button type="submit">PDF Generieren & Herunterladen</button>
    </form>
</div>

</body>
</html>