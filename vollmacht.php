<?php
/**
 * Vollmacht Form - ExoTaxx GmbH
 */
$page_title = "Vollmacht - ExoTaxx GmbH";

$custom_css = '
<style>
    .signature-container { max-width: 1000px; margin: 50px auto; background: white; border-radius: 15px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); overflow: hidden; }
    .signature-header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; }
    .form-content { padding: 40px; }
    .form-section { margin-bottom: 40px; padding: 25px; background: #f8f9fa; border-radius: 10px; border-left: 4px solid #667eea; }
    .form-section h2 { color: #667eea; font-size: 20px; margin-bottom: 20px; font-weight: 700; }
    .form-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 20px; }
    .form-group label { display: block; margin-bottom: 8px; color: #333; font-weight: 600; font-size: 13px; }
    .form-group input { width: 100%; padding: 10px; border: 2px solid #e0e0e0; border-radius: 6px; }
    .canvas-container { background: white; border: 2px solid #e0e0e0; border-radius: 10px; padding: 15px; text-align: center; }
    #signatureCanvas { border: 1px solid #ccc; cursor: crosshair; touch-action: none; max-width: 100%; background: #fff; }
    .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 15px; width: 100%; border: none; border-radius: 8px; font-weight: 700; cursor: pointer; margin-top: 20px; }
</style>
';

include 'header.php'; 
?>

<div class="signature-container">
    <div class="signature-header">
        <h1>Vollmacht Erteilen</h1>
        <p>Bitte füllen Sie die Daten des Vollmachtgebers aus</p>
    </div>

    <div class="form-content">
        <form id="vollmachtForm">
            <div class="form-section">
                <h2>Vollmachtgeber (Ihre Daten)</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label>Name / Firma *</label>
                        <input type="text" name="vg_name" required placeholder="z.B. Max Mustermann / Muster GmbH">
                    </div>
                    <div class="form-group">
                        <label>Rechtsform</label>
                        <input type="text" name="vg_rechtsform" placeholder="z.B. Einzelunternehmen">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Straße und Hausnummer *</label>
                        <input type="text" name="vg_strasse" required>
                    </div>
                    <div class="form-group">
                        <label>PLZ / Ort *</label>
                        <input type="text" name="vg_ort" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>E-Mail (für den Versand) *</label>
                        <input type="email" name="customer_email" required>
                    </div>
                    <div class="form-group">
                        <label>Datum *</label>
                        <input type="date" name="datum" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h2>Vollmachtnehmer (ExoTaxx)</h2>
                <p><strong>Kompass Buchhaltung Düsseldorf / ExoTaxx Innoventis GmbH</strong><br>
                Oguz Serbetcioglu, Vogelsanger Weg 91, 40470 Düsseldorf</p>
            </div>

            <div class="form-section">
                <h2>Unterschrift Vollmachtgeber</h2>
                <div class="canvas-container">
                    <canvas id="signatureCanvas" width="600" height="200"></canvas>
                    <br>
                    <button type="button" onclick="clearCanvas()" style="margin-top:10px;">Löschen</button>
                </div>
            </div>

            <button type="submit" class="btn-primary">Vollmacht Generieren & Senden</button>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
const canvas = document.getElementById("signatureCanvas");
const ctx = canvas.getContext("2d");
let isDrawing = false;

ctx.fillStyle = "white";
ctx.fillRect(0, 0, canvas.width, canvas.height);
ctx.lineWidth = 2;
ctx.lineCap = "round";
ctx.strokeStyle = "black";

function getPos(e) {
    const rect = canvas.getBoundingClientRect();
    return {
        x: (e.clientX || (e.touches && e.touches[0].clientX)) - rect.left,
        y: (e.clientY || (e.touches && e.touches[0].clientY)) - rect.top
    };
}

function startDrawing(e) { isDrawing = true; const pos = getPos(e); ctx.beginPath(); ctx.moveTo(pos.x, pos.y); }
function draw(e) { if (!isDrawing) return; e.preventDefault(); const pos = getPos(e); ctx.lineTo(pos.x, pos.y); ctx.stroke(); }
function stopDrawing() { isDrawing = false; }

canvas.addEventListener("mousedown", startDrawing);
canvas.addEventListener("mousemove", draw);
canvas.addEventListener("mouseup", stopDrawing);
canvas.addEventListener("touchstart", startDrawing, {passive: false});
canvas.addEventListener("touchmove", draw, {passive: false});
canvas.addEventListener("touchend", stopDrawing);

function clearCanvas() { ctx.fillStyle = "white"; ctx.fillRect(0, 0, canvas.width, canvas.height); }

document.getElementById("vollmachtForm").addEventListener("submit", async function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const signature = canvas.toDataURL("image/png");

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    let y = 20;

    // Header
    doc.setFontSize(18);
    doc.setFont(undefined, 'bold');
    doc.text("Vollmacht", 105, y, { align: "center" });
    y += 15;

    // Vollmachtgeber & Nehmer
    doc.setFontSize(10);
    doc.text("Vollmachtgeber:", 20, y);
    doc.setFont(undefined, 'normal');
    doc.text(`${formData.get("vg_name")}, ${formData.get("vg_rechtsform") || ""}`, 60, y);
    doc.text(`${formData.get("vg_strasse")}, ${formData.get("vg_ort")}`, 60, y + 5);
    y += 15;

    doc.setFont(undefined, 'bold');
    doc.text("Vollmachtnehmer:", 20, y);
    doc.setFont(undefined, 'normal');
    doc.text("Kompass Buchhaltung Düsseldorf / ExoTaxx Innoventis GmbH", 60, y);
    doc.text("Oguz Serbetcioglu, Vogelsanger Weg 91, 40470 Düsseldorf", 60, y + 5);
    y += 15;

    // Haupttext (Kompakterer Zeilenabstand)
    const mainText = `Vollmacht, uns in allen Steuerangelegenheiten vor den hierfür zuständigen Behörden und Gerichten zu vertreten.\n\nDer Bevollmächtigte ist befugt, für uns verbindliche Erklärungen abzugeben, Rechtsbehelfe und Rechtsmittel einzulegen und zurückzunehmen und rechtsverbindliche Unterschriften zu leisten. Steuerbescheide und alle sonstigen Verwaltungsakte (einschließlich förmlicher Zustellungen) sowie Urteile und gerichtliche Verfügungen sind ausschließlich dem Bevollmächtigten bekanntzugeben. Diese Vollmacht erstreckt sich ebenfalls auf Erklärungen zur Sozialversicherungspflicht bzw. private Krankenversicherung.\n\nDer Vollmachtgeber versichert, dass er die zur Ausübung der Tätigkeiten erforderlichen Belege und sonstigen Unterlagen vollständig und richtig der Vollmachtnehmerin zur Verfügung stellt.`;
    
    const splitMain = doc.splitTextToSize(mainText, 170);
    doc.text(splitMain, 20, y);
    y += (splitMain.length * 5) + 5;

    // Zusätzliche Aufgaben
    doc.setFont(undefined, 'bold');
    doc.text("Zusätzliche Aufgaben:", 20, y);
    doc.setFont(undefined, 'normal');
    y += 7;
    
    const addText = [
        "mich gegenüber allen Finanzämtern sowie den Zollbehörden der Bundesrepublik Deutschland in sämtlichen steuerlichen und zollrechtlichen Angelegenheiten zu vertreten. Die Vollmacht umfasst insbesondere:",
        "- Beantragung, Entgegennahme und Verwaltung der USt-IdNr.",
        "- Abgabe, Entgegennahme und Berichtigung von Steuererklärungen/Anmeldungen",
        "- Einreichung von Anträgen und sonstigen steuerlichen Mitteilungen",
        "- Entgegennahme von Bescheiden und Schriftverkehr",
        "- Einlegung und Begründung von Einsprüchen sowie Rechtsbehelfsverfahren",
        "- Vertretung in allen damit zusammenhängenden Verfahren bis zu deren Abschluss",
        "- Laufende Lohn- und Finanzbuchhaltung (USt-VA, LSt-Anmeldung, ZM, Lohnsteuerbescheinigung)",
        "- Allgemeine Bürodienstleistungen",
        "- Vertretung vor Behörden, Krankenkassen, Berufsgenossenschaften"
    ];

    addText.forEach(line => {
        if (y > 270) { doc.addPage(); y = 20; } // Neue Seite falls zu voll
        let splitLine = doc.splitTextToSize(line, 170);
        doc.text(splitLine, 20, y);
        y += (splitLine.length * 5);
    });

    y += 10;
    if (y > 260) { doc.addPage(); y = 20; }

    doc.text("Diese Vollmacht berechtigt auch zur Bestellung von Unterbevollmächtigten und gilt bis auf Widerruf.", 20, y);
    y += 15;

    // Datum & Unterschrift
    const rawDate = formData.get("datum").split("-");
    const formattedDate = `${rawDate[2]}.${rawDate[1]}.${rawDate[0]}`;

    doc.text(`Düsseldorf, den ${formattedDate}`, 20, y);
    y += 10;
    doc.text("Unterschrift Vollmachtgeber:", 20, y);
    doc.addImage(signature, "PNG", 20, y + 5, 60, 20);

    // Versand Logik bleibt gleich...
    const pdfBase64 = doc.output("datauristring").split(",")[1];
    const sendData = new FormData();
    sendData.append("pdf", pdfBase64);
    sendData.append("vg_name", formData.get("vg_name"));
    sendData.append("customer_email", formData.get("customer_email"));

    try {
        const response = await fetch("assets/php/vollmacht-email.php", { method: "POST", body: sendData });
        const result = await response.json();
        if(result.success) { alert("Vollmacht erfolgreich gesendet!"); location.reload(); }
        else { alert("Fehler: " + result.message); }
    } catch (error) { alert("Ein technischer Fehler ist aufgetreten."); }
});
</script>

<?php include 'footer.php'; ?>