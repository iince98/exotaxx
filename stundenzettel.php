<?php 
$page_title = "Stundenzettel - ExoTaxx GmbH";

$custom_css = '
<style>
/* ---------------- Container & General ---------------- */
.timesheet-container {
    max-width: 1100px;
    margin: 40px auto;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    overflow: hidden;
    font-family: "Segoe UI", Arial, sans-serif;
}

.timesheet-header {
    background: #4e73df;
    color: white;
    padding: 25px;
    text-align: center;
}

.form-content { padding: 30px; }

.form-section {
    margin-bottom: 30px;
    padding: 20px;
    background: #f8f9fc;
    border-radius: 8px;
    border-left: 5px solid #4e73df;
}

.form-section h2, .form-section h3 {
    color: #4e73df;
    margin-top: 0;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 600;
    font-size: 13px;
}

.form-group input, .form-group select {
    width: 100%;
    padding: 8px;
    border: 1px solid #d1d3e2;
    border-radius: 4px;
}

/* ---------------- Table ---------------- */
.table-responsive { overflow-x: auto; margin-top: 15px; }
.timesheet-table { width: 100%; border-collapse: collapse; font-size: 12px; min-width: 900px; }
.timesheet-table th, .timesheet-table td { border: 1px solid #e3e6f0; padding: 6px; text-align: center; }
.timesheet-table th { background: #f1f3f9; }
.timesheet-table input { width: 100%; border: 1px solid transparent; text-align: center; padding: 4px; }
.timesheet-table input[type="date"] { font-size: 11px; width: 130px; }

/* ---------------- Signature Section ---------------- */
.signature-tabs { display: flex; gap: 10px; margin-bottom: 15px; }
.tab-btn {
    flex: 1; padding: 10px; border: 1px solid #d1d3e2; background: #fff;
    cursor: pointer; border-radius: 5px; font-weight: 600; transition: 0.3s;
}
.tab-btn.active { background: #4e73df; color: white; border-color: #4e73df; }
.tab-content { display: none; }
.tab-content.active { display: block; }

.canvas-container { background: #fff; border: 1px solid #d1d3e2; border-radius: 8px; padding: 10px; }
#signatureCanvas { display: block; margin: 0 auto; background: #fff; touch-action: none; border: 1px inset #eee; }
.canvas-controls { margin-top: 10px; text-align: center; }

.upload-area {
    border: 2px dashed #d1d3e2; border-radius: 8px; padding: 30px;
    text-align: center; background: #fff; cursor: pointer; transition: 0.3s;
}
.upload-area:hover { background: #f1f3f9; border-color: #4e73df; }
#signatureUpload { display: none; }
.signature-preview { margin-top: 15px; text-align: center; display: none; }
.signature-preview img { max-width: 100%; max-height: 150px; border: 1px solid #d1d3e2; padding: 5px; background: white; }

.required { color: #e74a3b; }
.btn-submit { background: #4e73df; color: white; padding: 15px; width: 100%; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; font-size: 16px; margin-top: 20px; }
.btn-clear { background: #858796; color: white; padding: 5px 15px; border: none; border-radius: 4px; cursor: pointer; }
</style>
';

include 'header.php'; 
?>

<div class="timesheet-container" id="pdf-content">
    <div class="timesheet-header">
        <h1>Stundenzettel</h1>
        <p>ExoTaxx GmbH - Monatliche Arbeitszeitdokumentation</p>
    </div>

    <div class="form-content">
        <form id="timesheetForm">
            <div class="form-section">
                <h2>Persönliche Angaben</h2>
                <div class="form-row">
                    <div class="form-group"><label>Firma</label><input type="text" name="firma" required></div>
                    <div class="form-group"><label>Personalnummer</label><input type="text" name="personalnummer" required></div>
                </div>
                <div class="form-row">
                    <div class="form-group"><label>Nachname</label><input type="text" name="nachname" required></div>
                    <div class="form-group"><label>Vorname</label><input type="text" name="vorname" required></div>
                    <div class="form-group"><label>E-Mail</label><input type="email" name="email" required></div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Monat</label>
                        <select name="monat" required>
                            <?php foreach(["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"] as $m) echo "<option value='$m'>$m</option>"; ?>
                        </select>
                    </div>
                    <div class="form-group"><label>Jahr</label><input type="number" name="jahr" value="<?= date('Y') ?>"></div>
                </div>
            </div>

            <div class="form-section">
                <h2>Zeiterfassung</h2>
                <div class="table-responsive">
                    <table class="timesheet-table">
                        <thead>
                            <tr>
                                <th>Tag</th>
                                <th>Beginn</th>
                                <th>Pause (Min)</th>
                                <th>Ende</th>
                                <th>Dauer (Std)</th>
                                <th>Aufgezeichnet am</th>
                                <th>Bemerkung</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i=1; $i<=31; $i++): ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><input type="time" class="t-start"></td>
                                <td><input type="number" class="t-break" value="0"></td>
                                <td><input type="time" class="t-end"></td>
                                <td><input type="text" class="t-total" readonly></td>
                                <td><input type="date" class="t-date"></td>
                                <td><input type="text" class="t-note" placeholder="..."></td>
                            </tr>
                            <?php endfor; ?>
                        </tbody>
                        <tfoot>
                            <tr style="background:#f1f3f9; font-weight:bold;">
                                <td colspan="4" style="text-align:right">Gesamtstunden:</td>
                                <td id="grand-total">0.00</td>
                                <td colspan="2">Std</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="form-section signature-section">
                <h3>Unterschrift <span class="required">*</span></h3>
                <div class="signature-tabs">
                    <button type="button" class="tab-btn active" data-tab="draw">Zeichnen</button>
                    <button type="button" class="tab-btn" data-tab="upload">Hochladen</button>
                </div>
                <div class="tab-content active" id="drawTab">
                    <div class="canvas-container">
                        <canvas id="signatureCanvas" width="600" height="200"></canvas>
                        <div class="canvas-controls">
                            <button type="button" class="btn-clear" onclick="clearCanvas()">Löschen</button>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="uploadTab">
                    <div class="upload-area" id="uploadArea">
                        <div class="upload-icon">📷</div>
                        <p style="margin: 0 0 10px 0; font-weight: 600;">Unterschrift hochladen</p>
                        <p style="margin: 0; color: #6c757d; font-size: 14px;">Klicken Sie hier oder ziehen Sie ein Bild hierher</p>
                        <p style="margin: 10px 0 0 0; color: #6c757d; font-size: 12px;">PNG, JPG, JPEG</p>
                    </div>
                    <input type="file" id="signatureUpload" accept="image/*">
                    <div class="signature-preview" id="signaturePreview">
                        <img id="signatureImg" src="" alt="Unterschrift">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-submit" id="submitBtn">Stundenzettel absenden</button>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

<script>
// --- TABS & CANVAS LOGIC ---
document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
        btn.classList.add('active');
        document.getElementById(btn.dataset.tab + 'Tab').classList.add('active');
    });
});

const canvas = document.getElementById('signatureCanvas');
const ctx = canvas.getContext('2d');
let drawing = false;
canvas.addEventListener('mousedown', startPos);
canvas.addEventListener('mousemove', draw);
window.addEventListener('mouseup', stopPos);
canvas.addEventListener('touchstart', (e) => { e.preventDefault(); startPos(e.touches[0]); });
canvas.addEventListener('touchmove', (e) => { e.preventDefault(); draw(e.touches[0]); });
canvas.addEventListener('touchend', stopPos);
function startPos(e) { drawing = true; ctx.beginPath(); draw(e); }
function stopPos() { drawing = false; ctx.closePath(); }
function draw(e) {
    if (!drawing) return;
    const rect = canvas.getBoundingClientRect();
    ctx.lineWidth = 2; ctx.lineCap = 'round'; ctx.strokeStyle = '#000';
    ctx.lineTo(e.clientX - rect.left, e.clientY - rect.top); ctx.stroke();
}
function clearCanvas() { ctx.clearRect(0, 0, canvas.width, canvas.height); }

// --- UPLOAD ---
const uploadArea = document.getElementById('uploadArea');
const fileInput = document.getElementById('signatureUpload');
const previewImg = document.getElementById('signatureImg');
uploadArea.onclick = () => fileInput.click();
fileInput.onchange = (e) => {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (event) => {
            previewImg.src = event.target.result;
            document.getElementById('signaturePreview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
};

// HELPER: Format Date to DD.MM.YYYY
function formatEuropeanDate(dateStr) {
    if(!dateStr) return "";
    const date = new Date(dateStr);
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();
    return `${day}.${month}.${year}`;
}

// --- CALCULATIONS ---
document.querySelectorAll('.timesheet-table tbody tr').forEach(row => {
    row.addEventListener('input', () => {
        const start = row.querySelector('.t-start')?.value;
        const end = row.querySelector('.t-end')?.value;
        const pause = parseFloat(row.querySelector('.t-break')?.value) || 0;
        const totalInput = row.querySelector('.t-total');
        if(start && end) {
            const s = new Date(`1970-01-01T${start}:00`);
            const e = new Date(`1970-01-01T${end}:00`);
            let diff = (e - s) / 3600000;
            if(diff < 0) diff += 24; 
            totalInput.value = Math.max(0, diff - (pause/60)).toFixed(2);
        }
        let grandTotal = 0;
        document.querySelectorAll('.t-total').forEach(i => grandTotal += parseFloat(i.value) || 0);
        document.getElementById('grand-total').innerText = grandTotal.toFixed(2);
    });
});

// --- SUBMISSION ---
document.getElementById("timesheetForm").addEventListener("submit", async function(e) {
    e.preventDefault();
    const btn = document.getElementById('submitBtn');
    const activeTab = document.querySelector('.tab-btn.active').dataset.tab;
    let finalSig = activeTab === 'draw' ? canvas.toDataURL("image/png") : previewImg.src;

    if(!finalSig || finalSig.length < 1000) { alert("Bitte leisten Sie eine Unterschrift."); return; }

    btn.disabled = true;
    btn.innerText = "Wird gesendet...";

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    doc.setFontSize(18);
    doc.text("STUNDENZETTEL", 14, 22);
    doc.setFontSize(10);
    doc.setTextColor(100);
    doc.text(`Firma: ${this.firma.value}`, 14, 32);
    doc.text(`Mitarbeiter: ${this.vorname.value} ${this.nachname.value} (ID: ${this.personalnummer.value})`, 14, 37);
    doc.text(`Zeitraum: ${this.monat.value} ${this.jahr.value}`, 14, 42);

    const tableRows = [];
    document.querySelectorAll(".timesheet-table tbody tr").forEach(row => {
        const start = row.querySelector(".t-start").value;
        if (start) {
            const dateValue = row.querySelector(".t-date").value;
            tableRows.push([
                row.cells[0].innerText,
                start, 
                row.querySelector(".t-break").value + " Min",
                row.querySelector(".t-end").value,
                row.querySelector(".t-total").value + " Std",
                formatEuropeanDate(dateValue), // Umwandlung in TT.MM.JJJJ für das PDF
                row.querySelector(".t-note").value
            ]);
        }
    });

    doc.autoTable({
        head: [["Tag", "Beginn", "Pause", "Ende", "Dauer", "Datum", "Bemerkung"]],
        body: tableRows,
        startY: 50,
        theme: 'grid',
        headStyles: { fillColor: [78, 115, 223] },
        foot: [['', '', '', 'Gesamt:', document.getElementById('grand-total').innerText + " Std", '', '']],
        footStyles: { fillColor: [240, 240, 240], textColor: [0, 0, 0], fontStyle: 'bold' }
    });

    const finalY = doc.lastAutoTable.finalY + 10;
    doc.setTextColor(0);
    doc.text("Unterschrift:", 14, finalY + 10);
    doc.addImage(finalSig, 'PNG', 14, finalY + 15, 50, 15);

    const pdfBase64 = doc.output('datauristring').split(',')[1];
    const formData = new FormData(this);
    formData.append('pdf', pdfBase64);
    formData.append('signatureDataUrl', finalSig);

    fetch('assets/php/stundenzettel-email.php', { method: 'POST', body: formData })
    .then(res => res.json())
    .then(data => {
        if(data.success) { alert("Erfolgreich gesendet!"); location.reload(); }
        else { alert("Fehler: " + data.message); btn.disabled = false; }
    }).catch(() => { alert("Netzwerkfehler."); btn.disabled = false; });
});
</script>

<?php include 'footer.php'; ?>