<?php 
// Set page title
$page_title = "Personalfragebogen - ExoTaxx GmbH";

// Custom CSS for this page
$custom_css = '
<style>
    .signature-container {
        max-width: 1000px;
        margin: 50px auto;
        background: white;
        border-radius: 15px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        overflow: hidden;
    }

    .signature-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        text-align: center;
    }

    .signature-header h1 {
        font-size: 28px;
        margin-bottom: 10px;
    }

    .signature-header p {
        font-size: 14px;
        opacity: 0.9;
    }

    .form-content {
        padding: 40px;
    }

    .form-section {
        margin-bottom: 40px;
        padding: 25px;
        background: #f8f9fa;
        border-radius: 10px;
        border-left: 4px solid #667eea;
    }

    .form-section h2 {
        color: #667eea;
        font-size: 20px;
        margin-bottom: 20px;
        font-weight: 700;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-row.address-row {
        grid-template-columns: 2fr 1fr 2fr;
    }

    .form-group {
        margin-bottom: 0;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 600;
        font-size: 13px;
    }

    .form-group label .required {
        color: #dc3545;
        margin-left: 3px;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="tel"],
    .form-group input[type="date"],
    .form-group input[type="number"],
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 10px 12px;
        border: 2px solid #e0e0e0;
        border-radius: 6px;
        font-size: 14px;
        transition: all 0.3s;
        font-family: inherit;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 80px;
    }

    .radio-group, .checkbox-group {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .radio-item, .checkbox-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .radio-item input[type="radio"],
    .checkbox-item input[type="checkbox"] {
        width: auto;
        margin: 0;
        cursor: pointer;
    }

    .radio-item label,
    .checkbox-item label {
        margin: 0;
        font-weight: normal;
        cursor: pointer;
    }

    .time-distribution {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 10px;
    }

    .time-distribution .day-input {
        text-align: center;
    }

    .time-distribution .day-input label {
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .time-distribution .day-input input {
        text-align: center;
    }

    /* File Upload Section */
    .file-upload-section {
        margin-top: 30px;
        padding: 25px;
        background: #f8f9fa;
        border-radius: 10px;
        border-left: 4px solid #667eea;
    }

    .file-upload-section h3 {
        color: #667eea;
        font-size: 18px;
        margin-bottom: 15px;
        font-weight: 700;
    }

    .file-upload-area {
        border: 3px dashed #d0d0d0;
        border-radius: 10px;
        padding: 40px;
        text-align: center;
        transition: all 0.3s;
        background: white;
        cursor: pointer;
        margin-bottom: 20px;
    }

    .file-upload-area:hover {
        border-color: #667eea;
        background: #f8f9ff;
    }

    .file-upload-area.dragover {
        border-color: #667eea;
        background: #f0f3ff;
    }

    .file-upload-icon {
        font-size: 48px;
        margin-bottom: 15px;
        color: #667eea;
    }

    #additionalFiles {
        position: absolute;
        width: 1px;
        height: 1px;
        opacity: 0;
        overflow: hidden;
        z-index: -1;
    }

    .file-list {
        margin-top: 15px;
    }

    .file-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 15px;
        background: white;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        margin-bottom: 10px;
        transition: all 0.3s;
    }

    .file-item:hover {
        border-color: #667eea;
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.1);
    }

    .file-info {
        display: flex;
        align-items: center;
        gap: 10px;
        flex: 1;
    }

    .file-icon {
        font-size: 24px;
        color: #667eea;
    }

    .file-details {
        flex: 1;
    }

    .file-name {
        font-weight: 600;
        color: #333;
        font-size: 14px;
        margin-bottom: 2px;
    }

    .file-size {
        font-size: 12px;
        color: #6c757d;
    }

    .file-remove {
        background: #dc3545;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .file-remove:hover {
        background: #c82333;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }

    .signature-section {
        margin-top: 30px;
        padding: 25px;
        background: #f8f9fa;
        border-radius: 10px;
    }

    .signature-section h3 {
        color: #333;
        margin-bottom: 20px;
        font-size: 18px;
    }

    .signature-tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    .tab-btn {
        flex: 1;
        padding: 12px;
        border: 2px solid #e0e0e0;
        background: white;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .tab-btn.active {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .upload-area {
        border: 3px dashed #d0d0d0;
        border-radius: 10px;
        padding: 40px;
        text-align: center;
        transition: all 0.3s;
        background: white;
        cursor: pointer;
    }

    .upload-area:hover {
        border-color: #667eea;
        background: #f8f9ff;
    }

    .upload-area.dragover {
        border-color: #667eea;
        background: #f0f3ff;
    }

    .upload-icon {
        font-size: 48px;
        margin-bottom: 15px;
        color: #667eea;
    }

    #signatureUpload {
        display: none;
    }

    .signature-preview {
        margin-top: 20px;
        text-align: center;
        display: none;
    }

    .signature-preview img {
        max-width: 300px;
        max-height: 150px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        padding: 10px;
        background: white;
    }

    .canvas-container {
        background: white;
        border-radius: 10px;
        padding: 15px;
    }

    #signatureCanvas {
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        cursor: crosshair;
        touch-action: none;
        display: block;
        margin: 0 auto;
        max-width: 100%;
    }

    .canvas-controls {
        display: flex;
        gap: 10px;
        margin-top: 15px;
        justify-content: center;
    }

    .btn {
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-clear {
        background: #6c757d;
        color: white;
    }

    .btn-clear:hover {
        background: #5a6268;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-size: 16px;
        padding: 15px 40px;
        margin-top: 30px;
        width: 100%;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .btn-primary:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    #loading {
        display: none;
        text-align: center;
        padding: 40px;
    }

    .spinner {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #667eea;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
        margin: 0 auto 20px;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background: white;
        padding: 40px;
        border-radius: 15px;
        max-width: 500px;
        text-align: center;
        animation: slideIn 0.3s;
    }

    @keyframes slideIn {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .success-icon {
        font-size: 64px;
        color: #28a745;
        margin-bottom: 20px;
    }

    .modal-content h2 {
        color: #333;
        margin-bottom: 15px;
    }

    .modal-content p {
        color: #6c757d;
        margin-bottom: 30px;
    }

    .btn-success {
        background: #28a745;
        color: white;
        padding: 12px 30px;
        margin: 5px;
    }

    .btn-success:hover {
        background: #218838;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
    }

    .error-message {
        color: #dc3545;
        font-size: 13px;
        margin-top: 5px;
        display: none;
    }

    @media (max-width: 768px) {
        .signature-container {
            margin: 20px;
        }

        .form-content {
            padding: 20px;
        }

        .form-section {
            padding: 15px;
        }

        .time-distribution {
            grid-template-columns: repeat(4, 1fr);
        }

        #signatureCanvas {
            width: 100%;
            height: auto;
        }
    }
</style>
';

// Include header
include 'header.php'; 
?>

<div class="signature-container">
    <div class="signature-header">
        <h1>Mitteilung über die Beendigung des Arbeitsverhältnisses</h1>
        <p>Bitte füllen Sie alle erforderlichen Felder aus</p>
    </div>

    <div class="form-content">
        <form id="personalForm" method="POST">

            <!-- Firmeninformationen -->
            <div class="form-section">
                <h2>Firmeninformationen</h2>

                <div class="form-row">
                    <div class="form-group">
                        <label>Firma *</label>
                        <input type="text" name="firma" required>
                    </div>
                </div>

                <div class="form-row address-row">
                    <div class="form-group">
                        <label>Straße und Hausnummer *</label>
                        <input type="text" name="strasse" required>
                    </div>
                    <div class="form-group">
                        <label>PLZ *</label>
                        <input type="text" name="plz" required>
                    </div>
                    <div class="form-group">
                        <label>Ort *</label>
                        <input type="text" name="ort" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>E-Mail *</label>
                        <input type="email" name="customer_email" required>
                    </div>
                    <div class="form-group">
                        <label>Telefon *</label>
                        <input type="tel" name="telefon" required>
                    </div>
                </div>
            </div>

            <!-- Mitarbeiter -->
            <div class="form-section">
                <h2>Angaben zum Mitarbeiter</h2>

                <div class="form-row">
                    <div class="form-group">
                        <label>Nachname *</label>
                        <input type="text" name="familienname" required>
                    </div>
                    <div class="form-group">
                        <label>Geburtsname</label>
                        <input type="text" name="geburtsname">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Vorname *</label>
                        <input type="text" name="vorname" required>
                    </div>
                    <div class="form-group">
                        <label>Geburtsdatum *</label>
                        <input type="date" name="geburtsdatum" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Austrittsdatum *</label>
                        <input type="date" name="austrittsdatum" required>
                    </div>
                    <div class="form-group">
                        <label>Wer hat gekündigt? *</label>
                        <select name="kuendigung_durch" required>
                            <option value="">Bitte auswählen</option>
                            <option value="Arbeitgeber">Arbeitgeber</option>
                            <option value="Arbeitnehmer">Arbeitnehmer</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- File Upload Section -->
            <div class="file-upload-section">
                <h3>Kündigung Dokumente</h3>
                <p style="color: #6c757d; margin-bottom: 15px; font-size: 14px;">
                    Fügen Sie weitere Kündigung Dokumente hinzu
                </p>
                
                <div class="file-upload-area" id="fileUploadArea">
                    <div class="file-upload-icon">📁</div>
                    <p style="margin: 0 0 10px 0; font-weight: 600;">Dateien hochladen</p>
                    <p style="margin: 0; color: #6c757d; font-size: 14px;">
                        Klicken Sie hier oder ziehen Sie Dateien hierher
                    </p>
                    <p style="margin: 10px 0 0 0; color: #6c757d; font-size: 12px;">
                        Alle Dateitypen sind erlaubt
                    </p>
                </div>
                
                <input type="file" id="additionalFiles" multiple required>
                
                <div id="fileList" class="file-list"></div>
            </div>

            <!-- Unterschrift -->
            <div class="signature-section">
                <h3>Unterschrift *</h3>

                <canvas id="signatureCanvas" width="600" height="200" 
                        style="border:2px solid #ccc; border-radius:8px;"></canvas>
                <br>
                <button type="button" onclick="clearCanvas()">Löschen</button>
            </div>

            <button type="submit" class="btn btn-primary">
                Formular absenden
            </button>

        </form>

        <div id="loading" style="display:none;">
            Wird verarbeitet...
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
// File upload click trigger and file handling
document.addEventListener("DOMContentLoaded", function () {

const fileInput = document.getElementById("additionalFiles");
const uploadArea = document.getElementById("fileUploadArea");
const fileListContainer = document.getElementById("fileList");

if (fileInput && uploadArea) {
    uploadArea.addEventListener("click", () => {
        fileInput.click();
    });
    
    // Handle file selection
    fileInput.addEventListener("change", function() {
        displayFiles(this.files);
    });
    
    // Drag and drop functionality
    uploadArea.addEventListener("dragover", (e) => {
        e.preventDefault();
        uploadArea.classList.add("dragover");
    });
    
    uploadArea.addEventListener("dragleave", () => {
        uploadArea.classList.remove("dragover");
    });
    
    uploadArea.addEventListener("drop", (e) => {
        e.preventDefault();
        uploadArea.classList.remove("dragover");
        
        const dt = new DataTransfer();
        const existingFiles = fileInput.files;
        
        // Add existing files
        for (let i = 0; i < existingFiles.length; i++) {
            dt.items.add(existingFiles[i]);
        }
        
        // Add dropped files
        for (let i = 0; i < e.dataTransfer.files.length; i++) {
            dt.items.add(e.dataTransfer.files[i]);
        }
        
        fileInput.files = dt.files;
        displayFiles(fileInput.files);
    });
}

function displayFiles(files) {
    fileListContainer.innerHTML = "";
    
    if (files.length === 0) {
        return;
    }
    
    Array.from(files).forEach((file, index) => {
        const fileItem = document.createElement("div");
        fileItem.className = "file-item";
        
        const fileInfo = document.createElement("div");
        fileInfo.className = "file-info";
        
        const fileIcon = document.createElement("div");
        fileIcon.className = "file-icon";
        fileIcon.textContent = getFileIcon(file.name);
        
        const fileDetails = document.createElement("div");
        fileDetails.className = "file-details";
        
        const fileName = document.createElement("div");
        fileName.className = "file-name";
        fileName.textContent = file.name;
        
        const fileSize = document.createElement("div");
        fileSize.className = "file-size";
        fileSize.textContent = formatFileSize(file.size);
        
        fileDetails.appendChild(fileName);
        fileDetails.appendChild(fileSize);
        
        fileInfo.appendChild(fileIcon);
        fileInfo.appendChild(fileDetails);
        
        const removeBtn = document.createElement("button");
        removeBtn.className = "file-remove";
        removeBtn.type = "button";
        removeBtn.innerHTML = "🗑️ Entfernen";
        removeBtn.onclick = () => removeFile(index);
        
        fileItem.appendChild(fileInfo);
        fileItem.appendChild(removeBtn);
        
        fileListContainer.appendChild(fileItem);
    });
}

function removeFile(indexToRemove) {
    const dt = new DataTransfer();
    const files = fileInput.files;
    
    for (let i = 0; i < files.length; i++) {
        if (i !== indexToRemove) {
            dt.items.add(files[i]);
        }
    }
    
    fileInput.files = dt.files;
    displayFiles(fileInput.files);
}

function getFileIcon(filename) {
    const ext = filename.split('.').pop().toLowerCase();
    
    const iconMap = {
        'pdf': '📄',
        'doc': '📝',
        'docx': '📝',
        'xls': '📊',
        'xlsx': '📊',
        'jpg': '🖼️',
        'jpeg': '🖼️',
        'png': '🖼️',
        'gif': '🖼️',
        'zip': '📦',
        'rar': '📦',
        'txt': '📃',
        'csv': '📈'
    };
    
    return iconMap[ext] || '📎';
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    
    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
}

});

let canvas = document.getElementById("signatureCanvas");
let ctx = canvas.getContext("2d");
let isDrawing = false;
let generatedPDF = null;

ctx.lineWidth = 2;
ctx.lineCap = "round";

canvas.addEventListener("mousedown", e => {
    isDrawing = true;
    ctx.beginPath();
    ctx.moveTo(e.offsetX, e.offsetY);
});

canvas.addEventListener("mousemove", e => {
    if (!isDrawing) return;
    ctx.lineTo(e.offsetX, e.offsetY);
    ctx.stroke();
});

canvas.addEventListener("mouseup", () => isDrawing = false);
canvas.addEventListener("mouseout", () => isDrawing = false);

function clearCanvas() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}

function validateSignature() {
    const pixelData = ctx.getImageData(0, 0, canvas.width, canvas.height).data;
    return pixelData.some(channel => channel !== 0);
}

document.getElementById("personalForm").addEventListener("submit", async function(e){
    e.preventDefault();

    if (!validateSignature()) {
        alert("Bitte unterschreiben.");
        return;
    }

    document.getElementById("loading").style.display = "block";

    const formData = new FormData(this);

    const signature = canvas.toDataURL("image/png");

    await generatePDF(formData, signature);

    const pdfBase64 = generatedPDF.output("datauristring").split(",")[1];

    const sendData = new FormData();
    sendData.append("pdf", pdfBase64);
    sendData.append("customer_email", formData.get("customer_email"));
    sendData.append("name", formData.get("familienname") + ", " + formData.get("vorname"));
    const files = document.getElementById("additionalFiles").files;

    if (files.length === 0) {
        alert("Bitte mindestens ein Kündigungsdokument hochladen.");
        document.getElementById("loading").style.display = "none";
        return;
    }

    // Append ALL files
    for (let i = 0; i < files.length; i++) {
        sendData.append("attachments[]", files[i]);
    }
    const response = await fetch("assets/php/kuendigung-email.php", {
        method: "POST",
        body: sendData
    });

    const result = await response.json();

    document.getElementById("loading").style.display = "none";

    if(result.success){
        alert("Erfolgreich gesendet!");
        location.reload();
    } else {
        alert("Fehler beim Senden.");
    }
});

async function generatePDF(data, signature) {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    let y = 20;

    function add(label, value){
        if(!value) return;
        doc.setFont(undefined,"bold");
        doc.text(label+":",20,y);
        doc.setFont(undefined,"normal");
        doc.text(String(value),80,y);
        y+=8;
    }

    doc.setFontSize(16);
    doc.text("Mitteilung über die Beendigung des Arbeitsverhältnisses",105,y,{align:"center"});
    y+=15;

    doc.setFontSize(12);

    add("Firma", data.get("firma"));
    add("Straße", data.get("strasse"));
    add("PLZ/Ort", data.get("plz")+" "+data.get("ort"));
    add("E-Mail", data.get("customer_email"));
    add("Telefon", data.get("telefon"));

    y+=10;

    add("Nachname", data.get("familienname"));
    add("Geburtsname", data.get("geburtsname"));
    add("Vorname", data.get("vorname"));
    add("Geburtsdatum", data.get("geburtsdatum"));
    add("Austrittsdatum", data.get("austrittsdatum"));
    add("Kündigung durch", data.get("kuendigung_durch"));

    y+=15;

    doc.text("Unterschrift:",20,y);
    y+=5;
    doc.addImage(signature,"PNG",20,y,60,25);

    generatedPDF = doc;
}
</script>

<?php include 'footer.php'; ?>