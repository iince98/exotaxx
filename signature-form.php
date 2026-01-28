<?php 
// Set page title
$page_title = "Signature Form - ExoTaxx GmbH";

// Custom CSS for this page
$custom_css = '
<style>
    .signature-container {
        max-width: 800px;
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

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 600;
        font-size: 14px;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="tel"],
    .form-group textarea {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s;
        font-family: inherit;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
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
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-primary:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
    }

    .submit-section {
        margin-top: 30px;
        text-align: center;
    }

    .error {
        color: #dc3545;
        font-size: 13px;
        margin-top: 5px;
        display: none;
    }

    .success-message {
        background: #d4edda;
        color: #155724;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: none;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.7);
        animation: fadeIn 0.3s;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .modal-content {
        background: white;
        margin: 10% auto;
        padding: 30px;
        border-radius: 15px;
        max-width: 500px;
        text-align: center;
        animation: slideIn 0.3s;
    }

    @keyframes slideIn {
        from { transform: translateY(-50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .modal-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 25px;
    }

    .btn-download {
        background: #28a745;
        color: white;
    }

    .btn-download:hover {
        background: #218838;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
    }

    .btn-email {
        background: #007bff;
        color: white;
    }

    .btn-email:hover {
        background: #0056b3;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
    }

    .loading {
        display: none;
        text-align: center;
        padding: 20px;
    }

    .spinner {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #667eea;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        margin: 0 auto;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    @media (max-width: 768px) {
        .form-content {
            padding: 25px;
        }

        .signature-header h1 {
            font-size: 24px;
        }

        #signatureCanvas {
            width: 100%;
            height: auto;
        }

        .modal-content {
            margin: 20% 15px;
        }
    }
</style>
';

// Custom JS for this page
$custom_js = '
<!-- Load jsPDF library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    // Tab switching
    document.querySelectorAll(".tab-btn").forEach(btn => {
        btn.addEventListener("click", function() {
            const tab = this.dataset.tab;
            
            document.querySelectorAll(".tab-btn").forEach(b => b.classList.remove("active"));
            document.querySelectorAll(".tab-content").forEach(t => t.classList.remove("active"));
            
            this.classList.add("active");
            document.getElementById(tab + "-tab").classList.add("active");
        });
    });

    // Signature Canvas
    const canvas = document.getElementById("signatureCanvas");
    const ctx = canvas.getContext("2d");
    let isDrawing = false;
    let hasSignature = false;

    // Set canvas background to white
    ctx.fillStyle = "white";
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    ctx.strokeStyle = "#000";
    ctx.lineWidth = 2;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";

    function startDrawing(e) {
        isDrawing = true;
        const rect = canvas.getBoundingClientRect();
        const x = (e.clientX || e.touches[0].clientX) - rect.left;
        const y = (e.clientY || e.touches[0].clientY) - rect.top;
        ctx.beginPath();
        ctx.moveTo(x, y);
    }

    function draw(e) {
        if (!isDrawing) return;
        e.preventDefault();
        const rect = canvas.getBoundingClientRect();
        const x = (e.clientX || e.touches[0].clientX) - rect.left;
        const y = (e.clientY || e.touches[0].clientY) - rect.top;
        ctx.lineTo(x, y);
        ctx.stroke();
        hasSignature = true;
    }

    function stopDrawing() {
        isDrawing = false;
    }

    canvas.addEventListener("mousedown", startDrawing);
    canvas.addEventListener("mousemove", draw);
    canvas.addEventListener("mouseup", stopDrawing);
    canvas.addEventListener("mouseout", stopDrawing);

    canvas.addEventListener("touchstart", startDrawing);
    canvas.addEventListener("touchmove", draw);
    canvas.addEventListener("touchend", stopDrawing);

    function clearCanvas() {
        ctx.fillStyle = "white";
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        hasSignature = false;
    }

    // File Upload
    const uploadArea = document.getElementById("uploadArea");
    const fileInput = document.getElementById("signatureUpload");
    const uploadPreview = document.getElementById("uploadPreview");
    const uploadedImage = document.getElementById("uploadedImage");
    let uploadedFile = null;

    uploadArea.addEventListener("click", () => fileInput.click());

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
        const file = e.dataTransfer.files[0];
        handleFile(file);
    });

    fileInput.addEventListener("change", (e) => {
        const file = e.target.files[0];
        handleFile(file);
    });

    function handleFile(file) {
        if (!file) return;
        
        if (!file.type.match("image/(png|jpeg|jpg)")) {
            alert("Please upload a PNG or JPG image");
            return;
        }

        if (file.size > 5 * 1024 * 1024) {
            alert("File size should not exceed 5MB");
            return;
        }

        const reader = new FileReader();
        reader.onload = (e) => {
            uploadedImage.src = e.target.result;
            uploadedFile = e.target.result;
            uploadArea.style.display = "none";
            uploadPreview.style.display = "block";
        };
        reader.readAsDataURL(file);
    }

    function clearUpload() {
        uploadedFile = null;
        uploadedImage.src = "";
        fileInput.value = "";
        uploadArea.style.display = "block";
        uploadPreview.style.display = "none";
    }

    // Form validation
    function validateForm() {
        let isValid = true;
        const errors = document.querySelectorAll(".error");
        errors.forEach(e => e.style.display = "none");

        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const phone = document.getElementById("phone").value.trim();
        const message = document.getElementById("message").value.trim();

        if (!name || !/^[a-zA-Z ]+$/.test(name)) {
            document.getElementById("nameError").textContent = "Please enter a valid name (letters only)";
            document.getElementById("nameError").style.display = "block";
            isValid = false;
        }

        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            document.getElementById("emailError").textContent = "Please enter a valid email address";
            document.getElementById("emailError").style.display = "block";
            isValid = false;
        }

        if (!phone || !/^[0-9]+$/.test(phone)) {
            document.getElementById("phoneError").textContent = "Please enter a valid phone number (numbers only)";
            document.getElementById("phoneError").style.display = "block";
            isValid = false;
        }

        if (!message || !/^[a-zA-Z0-9. ]+$/.test(message)) {
            document.getElementById("messageError").textContent = "Please enter a valid message (letters, numbers, and spaces only)";
            document.getElementById("messageError").style.display = "block";
            isValid = false;
        }

        // Check signature
        const activeTab = document.querySelector(".tab-btn.active").dataset.tab;
        if (activeTab === "draw" && !hasSignature) {
            document.getElementById("signatureError").textContent = "Please draw your signature";
            document.getElementById("signatureError").style.display = "block";
            isValid = false;
        } else if (activeTab === "upload" && !uploadedFile) {
            document.getElementById("signatureError").textContent = "Please upload a signature image";
            document.getElementById("signatureError").style.display = "block";
            isValid = false;
        }

        return isValid;
    }

    // Global variables for PDF
    let generatedPDF = null;
    let formData = {};

    // Form submission
    document.getElementById("signatureForm").addEventListener("submit", async function(e) {
        e.preventDefault();

        if (!validateForm()) {
            return;
        }

        // Show loading
        document.getElementById("loading").style.display = "block";
        this.style.display = "none";

        // Collect form data
        formData = {
            name: document.getElementById("name").value,
            email: document.getElementById("email").value,
            phone: document.getElementById("phone").value,
            message: document.getElementById("message").value
        };

        // Get signature
        const activeTab = document.querySelector(".tab-btn.active").dataset.tab;
        let signatureImage;
        
        if (activeTab === "draw") {
            signatureImage = canvas.toDataURL("image/png");
        } else {
            signatureImage = uploadedFile;
        }

        // Generate PDF
        try {
            await generatePDF(formData, signatureImage);
            
            // Hide loading
            document.getElementById("loading").style.display = "none";
            
            // Show success modal
            document.getElementById("successModal").style.display = "block";
        } catch (error) {
            console.error("Error generating PDF:", error);
            alert("Error generating PDF. Please try again.");
            document.getElementById("loading").style.display = "none";
            this.style.display = "block";
        }
    });

    async function generatePDF(data, signature) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Add title
        doc.setFontSize(22);
        doc.setTextColor(102, 126, 234);
        doc.text("Signed Document", 105, 20, { align: "center" });

        // Add horizontal line
        doc.setDrawColor(102, 126, 234);
        doc.setLineWidth(0.5);
        doc.line(20, 25, 190, 25);

        // Add form data
        doc.setFontSize(12);
        doc.setTextColor(0, 0, 0);
        
        let yPos = 40;
        
        doc.setFont(undefined, "bold");
        doc.text("Full Name:", 20, yPos);
        doc.setFont(undefined, "normal");
        doc.text(data.name, 60, yPos);
        
        yPos += 10;
        doc.setFont(undefined, "bold");
        doc.text("Email:", 20, yPos);
        doc.setFont(undefined, "normal");
        doc.text(data.email, 60, yPos);
        
        yPos += 10;
        doc.setFont(undefined, "bold");
        doc.text("Phone:", 20, yPos);
        doc.setFont(undefined, "normal");
        doc.text(data.phone, 60, yPos);
        
        yPos += 15;
        doc.setFont(undefined, "bold");
        doc.text("Message/Comments:", 20, yPos);
        
        yPos += 7;
        doc.setFont(undefined, "normal");
        const splitMessage = doc.splitTextToSize(data.message, 170);
        doc.text(splitMessage, 20, yPos);
        
        yPos += (splitMessage.length * 7) + 15;

        // Add signature
        doc.setFont(undefined, "bold");
        doc.text("Signature:", 20, yPos);
        
        yPos += 5;
        doc.addImage(signature, "PNG", 20, yPos, 80, 30);
        
        yPos += 35;
        doc.setFont(undefined, "normal");
        doc.setFontSize(10);
        doc.setTextColor(100, 100, 100);
        doc.text("Date: " + new Date().toLocaleDateString(), 20, yPos);

        // Add footer
        doc.setFontSize(8);
        doc.setTextColor(150, 150, 150);
        doc.text("This document was digitally signed on " + new Date().toLocaleString(), 105, 285, { align: "center" });

        generatedPDF = doc;
    }

    function downloadPDF() {
        if (generatedPDF) {
            generatedPDF.save("signed-document-" + Date.now() + ".pdf");
        }
    }

    function sendEmail() {
        if (!generatedPDF) {
            alert("No PDF available");
            return;
        }

        // Convert PDF to base64
        const pdfBase64 = generatedPDF.output("datauristring").split(",")[1];

        // Create form data
        const formDataToSend = new FormData();
        formDataToSend.append("name", formData.name);
        formDataToSend.append("email", formData.email);
        formDataToSend.append("phone", formData.phone);
        formDataToSend.append("message", formData.message);
        formDataToSend.append("pdf", pdfBase64);

        // Send via AJAX to signature-email.php
        fetch("assets/php/signature-email.php", {
            method: "POST",
            body: formDataToSend
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            closeModal();
            location.reload();
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Error sending email. Please try again.");
        });
    }

    function closeModal() {
        document.getElementById("successModal").style.display = "none";
        location.reload();
    }
</script>
';

// Include header
include 'header.php'; 
?>

<!-- Page Content -->
<section class="contact-area pt-120 pb-120" style="background: #f6faff;">
    <div class="container">
        <div class="signature-container">
            <div class="signature-header">
                <h1>Document Signature Form</h1>
                <p>Please fill out the form and provide your signature</p>
            </div>

            <div class="form-content">
                <div class="success-message" id="successMessage"></div>

                <form id="signatureForm">
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" required>
                        <span class="error" id="nameError"></span>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" required>
                        <span class="error" id="emailError"></span>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" id="phone" name="phone" required>
                        <span class="error" id="phoneError"></span>
                    </div>

                    <div class="form-group">
                        <label for="message">Message/Comments *</label>
                        <textarea id="message" name="message" required></textarea>
                        <span class="error" id="messageError"></span>
                    </div>

                    <div class="signature-section">
                        <h3>Provide Your Signature *</h3>
                        
                        <div class="signature-tabs">
                            <button type="button" class="tab-btn active" data-tab="upload">
                                📤 Upload Signature
                            </button>
                            <button type="button" class="tab-btn" data-tab="draw">
                                ✍️ Draw Signature
                            </button>
                        </div>

                        <div class="tab-content active" id="upload-tab">
                            <div class="upload-area" id="uploadArea">
                                <div class="upload-icon">📝</div>
                                <h4>Drop signature image here or click to browse</h4>
                                <p style="font-size: 13px; color: #666; margin-top: 10px;">
                                    Accepts: PNG, JPG, JPEG (Max 5MB)
                                </p>
                                <input type="file" id="signatureUpload" accept="image/png,image/jpeg,image/jpg">
                            </div>
                            <div class="signature-preview" id="uploadPreview">
                                <img id="uploadedImage" src="" alt="Signature Preview">
                                <p style="margin-top: 10px;">
                                    <button type="button" class="btn btn-clear" onclick="clearUpload()">Remove</button>
                                </p>
                            </div>
                        </div>

                        <div class="tab-content" id="draw-tab">
                            <div class="canvas-container">
                                <canvas id="signatureCanvas" width="700" height="200"></canvas>
                                <div class="canvas-controls">
                                    <button type="button" class="btn btn-clear" onclick="clearCanvas()">Clear</button>
                                </div>
                            </div>
                        </div>
                        <span class="error" id="signatureError"></span>
                    </div>

                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary">Generate PDF Document</button>
                    </div>
                </form>

                <div class="loading" id="loading">
                    <div class="spinner"></div>
                    <p style="margin-top: 15px; color: #666;">Generating your PDF...</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Success Modal -->
<div id="successModal" class="modal">
    <div class="modal-content">
        <h2 style="color: #28a745; margin-bottom: 15px;">✓ PDF Generated Successfully!</h2>
        <p style="color: #666; margin-bottom: 20px;">Your document has been created. What would you like to do?</p>
        <div class="modal-buttons">
            <button class="btn btn-download" onclick="downloadPDF()">
                💾 Download PDF
            </button>
            <button class="btn btn-email" onclick="sendEmail()">
                📧 Send via Email
            </button>
        </div>
        <p style="margin-top: 20px;">
            <button class="btn btn-clear" onclick="closeModal()">Close</button>
        </p>
    </div>
</div>

<?php 
// Include footer
include 'footer.php'; 
?>
