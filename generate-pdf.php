<?php
require('fpdf.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['customer_name'])) {
    // 1. Capture Input
    $name = htmlspecialchars($_POST['customer_name']);
    $message = htmlspecialchars($_POST['message']);

    // 2. Initialize FPDF
    $pdf = new FPDF();
    $pdf->AddPage();
    
    // 3. Add Content
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Customer Receipt');
    $pdf->Ln(20); // Line break
    
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, "Customer Name: " . $name, 0, 1);
    $pdf->MultiCell(0, 10, "Message: " . $message);
    
    // 4. Output/Download
    $pdf->Output('D', 'Customer_Document.pdf'); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>PDF Test Endpoint</title>
</head>
<body>
    <h2>PDF Generator Test</h2>
    <form method="post">
        <label>Name:</label><br>
        <input type="text" name="customer_name" required><br><br>
        
        <label>Message:</label><br>
        <textarea name="message"></textarea><br><br>
        
        <button type="submit">Generate & Download PDF</button>
    </form>
</body>
</html>