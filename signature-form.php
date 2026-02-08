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
        display: none;
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
        <h1>📋 Personalfragebogen für Mitarbeiter</h1>
        <p>Bitte füllen Sie alle erforderlichen Felder aus</p>
    </div>

    <div class="form-content">
        <form id="personalForm" method="POST">
            <!-- Personal Information Section -->
            <div class="form-section">
                <h2>📝 Persönliche Angaben</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label>Firma <span class="required">*</span> </label> 
                        <input type="text" name="firma" placeholder="Firma eingeben">
                    </div>
                    <div class="form-group">
                        <label>Firma Adresse <span class="required">*</span> </label> 
                        <input type="text" name="firma_adresse" placeholder="Firma Adresse eingeben">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Nachname <span class="required">*</span></label>
                        <input type="text" name="familienname" placeholder="Nachname" required>
                    </div>
                    <div class="form-group">
                        <label>Geburtsname</label>
                        <input type="text" name="geburtsname" placeholder="Geburtsname">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Vorname <span class="required">*</span></label>
                        <input type="text" name="vorname" placeholder="Vorname" required>
                    </div>
                    <div class="form-group">
                        <label>Geburtsdatum <span class="required">*</span></label>
                        <input type="date" name="geburtsdatum" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group full-width">
                        <label>Straße und Hausnummer <span class="required">*</span></label>
                        <input type="text" name="strasse" placeholder="Straße und Hausnummer" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>PLZ <span class="required">*</span></label>
                        <input type="text" name="plz" placeholder="PLZ" required>
                    </div>
                    <div class="form-group">
                        <label>Ort <span class="required">*</span></label>
                        <input type="text" name="ort" placeholder="Ort" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>E-Mail (für Benachrichtigungen) <span class="required">*</span></label>
                        <input type="email" name="customer_email" id="customer_email" placeholder="ihre.email@beispiel.de" required>
                        <small style="color: #6c757d; font-size: 12px;">An diese Adresse wird eine Bestätigung gesendet</small>
                    </div>
                    <div class="form-group">
                        <label>Telefon</label>
                        <input type="tel" name="telefon" placeholder="+49 123 456789">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Geschlecht</label>
                        <div class="radio-group">
                            <div class="radio-item">
                                <input type="radio" id="geschlecht_m" name="geschlecht" value="Männlich">
                                <label for="geschlecht_m">Männlich</label>
                            </div>
                            <div class="radio-item">
                                <input type="radio" id="geschlecht_w" name="geschlecht" value="Weiblich">
                                <label for="geschlecht_w">Weiblich</label>
                            </div>
                            <div class="radio-item">
                                <input type="radio" id="geschlecht_d" name="geschlecht" value="Divers">
                                <label for="geschlecht_d">Divers</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Staatsangehörigkeit</label>
                        <input type="text" name="staatsangehoerigkeit" placeholder="z.B. Deutsch">
                    </div>
                    <div class="form-group">
                        <label>Versicherungsnummer</label>
                        <input type="text" name="versicherungsnummer" placeholder="Versicherungsnummer">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Geburtsort</label>
                        <input type="text" name="geburtsort" placeholder="Geburtsort">
                    </div>
                    <div class="form-group">
                        <label>Schwerbehindert</label>
                        <div class="radio-group">
                            <div class="radio-item">
                                <input type="radio" id="schwerbehindert_ja" name="schwerbehindert" value="Ja">
                                <label for="schwerbehindert_ja">Ja</label>
                            </div>
                            <div class="radio-item">
                                <input type="radio" id="schwerbehindert_nein" name="schwerbehindert" value="Nein">
                                <label for="schwerbehindert_nein">Nein</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>IBAN</label>
                        <input type="text" name="iban" placeholder="DE89370400440532013000">
                    </div>
                    <div class="form-group">
                        <label>BIC</label>
                        <input type="text" name="bic" placeholder="COBADEFFXXX">
                    </div>
                </div>
            </div>

            <!-- Employment Section -->
            <div class="form-section">
                <h2>💼 Beschäftigung</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label>Eintrittsdatum <span class="required">*</span></label>
                        <input type="date" name="eintrittsdatum" required>
                    </div>
                    <div class="form-group">
                        <label>Beschäftigungsbetrieb</label>
                        <input type="text" name="beschaeftigungsbetrieb" placeholder="Betrieb">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Berufsbezeichnung</label>
                        <input type="text" name="berufsbezeichnung" placeholder="z.B. Buchhalter">
                    </div>
                    <div class="form-group">
                        <label>Ausgeübte Tätigkeit</label>
                        <input type="text" name="ausgeuebte_taetigkeit" placeholder="Tätigkeit">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Art der Beschäftigung</label>
                        <select name="beschaeftigungsart">
                            <option value="">Bitte wählen...</option>
                            <option value="Vollzeit">Vollzeit</option>
                            <option value="Teilzeit">Teilzeit</option>
                            <option value="Geringfügig">Geringfügig</option>
                            <option value="Aushilfe">Aushilfe</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Probezeit (Monate)</label>
                        <input type="number" name="probezeit" placeholder="z.B. 6">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Wöchentliche Arbeitszeit (Std.)</label>
                        <input type="number" name="wochenarbeitszeit" placeholder="40" step="0.5">
                    </div>
                    <div class="form-group">
                        <label>Arbeitszeit-Typ</label>
                        <select name="arbeitszeit_typ">
                            <option value="">Bitte wählen...</option>
                            <option value="Fest">Fest</option>
                            <option value="Flexibel">Flexibel</option>
                            <option value="Schichtarbeit">Schichtarbeit</option>
                        </select>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label>Stundenverteilung pro Woche</label>
                    <div class="time-distribution">
                        <div class="day-input">
                            <label>Mo</label>
                            <input type="number" name="mo" placeholder="0" step="0.5" min="0">
                        </div>
                        <div class="day-input">
                            <label>Di</label>
                            <input type="number" name="di" placeholder="0" step="0.5" min="0">
                        </div>
                        <div class="day-input">
                            <label>Mi</label>
                            <input type="number" name="mi" placeholder="0" step="0.5" min="0">
                        </div>
                        <div class="day-input">
                            <label>Do</label>
                            <input type="number" name="do" placeholder="0" step="0.5" min="0">
                        </div>
                        <div class="day-input">
                            <label>Fr</label>
                            <input type="number" name="fr" placeholder="0" step="0.5" min="0">
                        </div>
                        <div class="day-input">
                            <label>Sa</label>
                            <input type="number" name="sa" placeholder="0" step="0.5" min="0">
                        </div>
                        <div class="day-input">
                            <label>So</label>
                            <input type="number" name="so" placeholder="0" step="0.5" min="0">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Urlaubsanspruch (Tage/Jahr)</label>
                        <input type="number" name="urlaubsanspruch" placeholder="30">
                    </div>
                </div>
            </div>

            <!-- Education Section -->
            <div class="form-section">
                <h2>🎓 Ausbildung</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label>Schulabschluss</label>
                        <select name="schulabschluss">
                            <option value="">Bitte wählen...</option>
                            <option value="Hauptschulabschluss">Hauptschulabschluss</option>
                            <option value="Realschulabschluss">Realschulabschluss</option>
                            <option value="Fachabitur">Fachabitur</option>
                            <option value="Abitur">Abitur</option>
                            <option value="Ohne Abschluss">Ohne Abschluss</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Berufsausbildung</label>
                        <input type="text" name="berufsausbildung" placeholder="z.B. Kaufmann/-frau">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Ausbildungsbeginn</label>
                        <input type="date" name="ausbildung_beginn">
                    </div>
                    <div class="form-group">
                        <label>Ausbildungsende</label>
                        <input type="date" name="ausbildung_ende">
                    </div>
                </div>
            </div>

            <!-- Tax Section -->
            <div class="form-section">
                <h2>💶 Steuer</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label>Steuer-Identifikationsnummer</label>
                        <input type="text" name="steuer_id" placeholder="12345678901">
                    </div>
                    <div class="form-group">
                        <label>Finanzamt-Nummer</label>
                        <input type="text" name="finanzamt_nr" placeholder="Finanzamt-Nr.">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Steuerklasse</label>
                        <select name="steuerklasse">
                            <option value="">Bitte wählen...</option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                            <option value="V">V</option>
                            <option value="VI">VI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kinderfreibeträge</label>
                        <input type="number" name="kinderfreibetraege" placeholder="0" step="0.5" min="0">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Konfession</label>
                        <select name="konfession">
                            <option value="">Bitte wählen...</option>
                            <option value="Evangelisch">Evangelisch (ev)</option>
                            <option value="Katholisch">Katholisch (rk)</option>
                            <option value="Keine">Keine</option>
                            <option value="Sonstige">Sonstige</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Social Insurance Section -->
            <div class="form-section">
                <h2>🏥 Sozialversicherung</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label>Krankenkasse</label>
                        <input type="text" name="krankenkasse" placeholder="Name der Krankenkasse">
                    </div>
                    <div class="form-group">
                        <label>Elterneigenschaft</label>
                        <div class="radio-group">
                            <div class="radio-item">
                                <input type="radio" id="eltern_ja" name="elterneigenschaft" value="Ja">
                                <label for="eltern_ja">Ja</label>
                            </div>
                            <div class="radio-item">
                                <input type="radio" id="eltern_nein" name="elterneigenschaft" value="Nein">
                                <label for="eltern_nein">Nein</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Compensation Section -->
            <div class="form-section">
                <h2>💰 Entlohnung</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label>Bezeichnung 1</label>
                        <input type="text" name="lohn_bezeichnung1" placeholder="z.B. Grundgehalt">
                    </div>
                    <div class="form-group">
                        <label>Betrag 1 (€)</label>
                        <input type="number" name="lohn_betrag1" placeholder="3000" step="0.01">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Bezeichnung 2</label>
                        <input type="text" name="lohn_bezeichnung2" placeholder="z.B. Bonus">
                    </div>
                    <div class="form-group">
                        <label>Betrag 2 (€)</label>
                        <input type="number" name="lohn_betrag2" placeholder="500" step="0.01">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Stundenlohn (€)</label>
                        <input type="number" name="stundenlohn" placeholder="15.50" step="0.01">
                    </div>
                </div>
            </div>

            <!-- File Upload Section -->
            <div class="file-upload-section">
                <h3>📎 Zusätzliche Dokumente</h3>
                <p style="color: #6c757d; margin-bottom: 15px; font-size: 14px;">
                    Fügen Sie weitere Dokumente hinzu (z.B. Lebenslauf, Zeugnisse, Zertifikate)
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
                
                <input type="file" id="additionalFiles" multiple accept="*/*">
                
                <div id="fileList" class="file-list"></div>
            </div>

            <!-- Signature Section -->
            <div class="signature-section">
                <h3>✍️ Unterschrift <span class="required">*</span></h3>
                
                <div class="signature-tabs">
                    <button type="button" class="tab-btn active" data-tab="draw">Zeichnen</button>
                    <button type="button" class="tab-btn" data-tab="upload">Hochladen</button>
                </div>

                <!-- Draw Tab -->
                <div class="tab-content active" id="drawTab">
                    <div class="canvas-container">
                        <canvas id="signatureCanvas" width="600" height="200"></canvas>
                        <div class="canvas-controls">
                            <button type="button" class="btn btn-clear" onclick="clearCanvas()">Löschen</button>
                        </div>
                    </div>
                </div>

                <!-- Upload Tab -->
                <div class="tab-content" id="uploadTab">
                    <div class="upload-area" id="uploadArea">
                        <div class="upload-icon">📷</div>
                        <p style="margin: 0 0 10px 0; font-weight: 600;">Unterschrift hochladen</p>
                        <p style="margin: 0; color: #6c757d; font-size: 14px;">
                            Klicken Sie hier oder ziehen Sie ein Bild hierher
                        </p>
                        <p style="margin: 10px 0 0 0; color: #6c757d; font-size: 12px;">
                            Unterstützte Formate: PNG, JPG, JPEG
                        </p>
                    </div>
                    <input type="file" id="signatureUpload" accept="image/*">
                    <div class="signature-preview" id="signaturePreview">
                        <img id="signatureImg" src="" alt="Unterschrift">
                    </div>
                </div>

                <div class="error-message" id="signatureError"></div>
            </div>

            <button type="submit" class="btn btn-primary" id="submitBtn">
                📨 Formular absenden
            </button>
        </form>

        <div id="loading">
            <div class="spinner"></div>
            <p style="color: #667eea; font-weight: 600;">Wird verarbeitet...</p>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div id="successModal" class="modal">
    <div class="modal-content">
        <div class="success-icon">✅</div>
        <h2>Erfolgreich gesendet!</h2>
        <p>Ihr Personalfragebogen wurde erfolgreich übermittelt.<br>Sie erhalten eine Bestätigung per E-Mail.</p>
        <button class="btn btn-success" onclick="closeModal()">Schließen</button>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    let canvas, ctx, isDrawing = false;
    let uploadedFile = null;
    let formData = {};
    let generatedPDF = null;
    let uploadedFiles = [];

    // Initialize canvas
    window.onload = function() {
        canvas = document.getElementById("signatureCanvas");
        ctx = canvas.getContext("2d");
        ctx.strokeStyle = "#000";
        ctx.lineWidth = 2;
        ctx.lineCap = "round";

        // Mouse events
        canvas.addEventListener("mousedown", startDrawing);
        canvas.addEventListener("mousemove", draw);
        canvas.addEventListener("mouseup", stopDrawing);
        canvas.addEventListener("mouseout", stopDrawing);

        // Touch events
        canvas.addEventListener("touchstart", handleTouch);
        canvas.addEventListener("touchmove", handleTouch);
        canvas.addEventListener("touchend", stopDrawing);
    };

    function startDrawing(e) {
        isDrawing = true;
        const rect = canvas.getBoundingClientRect();
        ctx.beginPath();
        ctx.moveTo(e.clientX - rect.left, e.clientY - rect.top);
    }

    function draw(e) {
        if (!isDrawing) return;
        const rect = canvas.getBoundingClientRect();
        ctx.lineTo(e.clientX - rect.left, e.clientY - rect.top);
        ctx.stroke();
    }

    function stopDrawing() {
        isDrawing = false;
    }

    function handleTouch(e) {
        e.preventDefault();
        const touch = e.touches[0];
        const mouseEvent = new MouseEvent(e.type === "touchstart" ? "mousedown" : "mousemove", {
            clientX: touch.clientX,
            clientY: touch.clientY
        });
        canvas.dispatchEvent(mouseEvent);
    }

    function clearCanvas() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }

    // Tab switching
    document.querySelectorAll(".tab-btn").forEach(btn => {
        btn.addEventListener("click", function() {
            const tab = this.dataset.tab;
            
            document.querySelectorAll(".tab-btn").forEach(b => b.classList.remove("active"));
            document.querySelectorAll(".tab-content").forEach(c => c.classList.remove("active"));
            
            this.classList.add("active");
            document.getElementById(tab + "Tab").classList.add("active");
        });
    });

    // File Upload Section
    const fileUploadArea = document.getElementById("fileUploadArea");
    const additionalFilesInput = document.getElementById("additionalFiles");
    const fileList = document.getElementById("fileList");

    fileUploadArea.addEventListener("click", () => {
        additionalFilesInput.click();
    });

    fileUploadArea.addEventListener("dragover", (e) => {
        e.preventDefault();
        fileUploadArea.classList.add("dragover");
    });

    fileUploadArea.addEventListener("dragleave", () => {
        fileUploadArea.classList.remove("dragover");
    });

    fileUploadArea.addEventListener("drop", (e) => {
        e.preventDefault();
        fileUploadArea.classList.remove("dragover");
        const files = e.dataTransfer.files;
        handleFileSelection(files);
    });

    additionalFilesInput.addEventListener("change", (e) => {
        handleFileSelection(e.target.files);
    });

    function handleFileSelection(files) {
        for (let file of files) {
            uploadedFiles.push(file);
        }
        displayFileList();
    }

    function displayFileList() {
        fileList.innerHTML = '';
        
        uploadedFiles.forEach((file, index) => {
            const fileItem = document.createElement('div');
            fileItem.className = 'file-item';
            
            const fileSize = formatFileSize(file.size);
            
            fileItem.innerHTML = `
                <div class="file-info">
                    <div class="file-icon">📄</div>
                    <div class="file-details">
                        <div class="file-name">${file.name}</div>
                        <div class="file-size">${fileSize}</div>
                    </div>
                </div>
                <button type="button" class="file-remove" onclick="removeFile(${index})">
                    ❌ Entfernen
                </button>
            `;
            
            fileList.appendChild(fileItem);
        });
    }

    function removeFile(index) {
        uploadedFiles.splice(index, 1);
        displayFileList();
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
    }

    // Signature Upload
    const uploadArea = document.getElementById("uploadArea");
    const signatureUpload = document.getElementById("signatureUpload");
    const signaturePreview = document.getElementById("signaturePreview");
    const signatureImg = document.getElementById("signatureImg");

    uploadArea.addEventListener("click", () => {
        signatureUpload.click();
    });

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
        if (file && file.type.startsWith("image/")) {
            processSignatureImage(file);
        }
    });

    signatureUpload.addEventListener("change", (e) => {
        const file = e.target.files[0];
        if (file) {
            processSignatureImage(file);
        }
    });

    function processSignatureImage(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            uploadedFile = e.target.result;
            signatureImg.src = uploadedFile;
            signaturePreview.style.display = "block";
        };
        reader.readAsDataURL(file);
    }

    // Validation
    function validateForm() {
        const signatureError = document.getElementById("signatureError");
        let isValid = true;

        // Check signature
        const activeTab = document.querySelector(".tab-btn.active").dataset.tab;
        
        if (activeTab === "draw") {
            const canvasData = ctx.getImageData(0, 0, canvas.width, canvas.height);
            const pixels = canvasData.data;
            let hasDrawing = false;
            
            for (let i = 0; i < pixels.length; i += 4) {
                if (pixels[i + 3] > 0) {
                    hasDrawing = true;
                    break;
                }
            }
            
            if (!hasDrawing) {
                signatureError.textContent = "Bitte zeichnen Sie Ihre Unterschrift";
                signatureError.style.display = "block";
                isValid = false;
            } else {
                signatureError.style.display = "none";
            }
        } else {
            if (!uploadedFile) {
                signatureError.textContent = "Bitte laden Sie ein Unterschriftsbild hoch";
                signatureError.style.display = "block";
                isValid = false;
            } else {
                signatureError.style.display = "none";
            }
        }
        
        return isValid;
    }

    // Form submission
    document.getElementById("personalForm").addEventListener("submit", async function(e) {
        e.preventDefault();

        if (!validateForm()) {
            return;
        }

        // Show loading
        document.getElementById("loading").style.display = "block";
        this.style.display = "none";

        // Collect all form data
        const form = e.target;
        formData = {};
        
        // Get all form elements
        const formElements = form.elements;
        for (let i = 0; i < formElements.length; i++) {
            const element = formElements[i];
            if (element.name) {
                if (element.type === 'checkbox') {
                    formData[element.name] = element.checked;
                } else if (element.type === 'radio') {
                    if (element.checked) {
                        formData[element.name] = element.value;
                    }
                } else {
                    formData[element.name] = element.value;
                }
            }
        }

        // Get signature
        const activeTab = document.querySelector(".tab-btn.active").dataset.tab;
        let signatureImage;
        
        if (activeTab === "draw") {
            signatureImage = canvas.toDataURL("image/png");
        } else {
            signatureImage = uploadedFile;
        }

        // Generate PDF and send email
        try {
            await generatePDF(formData, signatureImage);
            await sendEmail();
        } catch (error) {
            console.error("Error:", error);
            alert("Fehler beim Senden. Bitte versuchen Sie es erneut.");
            document.getElementById("loading").style.display = "none";
            this.style.display = "block";
        }
    });

    async function generatePDF(data, signature) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        let yPos = 20;
        const leftMargin = 20;
        const pageHeight = 280;

        // Helper function to check if new page is needed
        function checkNewPage(neededSpace = 10) {
            if (yPos + neededSpace > pageHeight) {
                doc.addPage();
                yPos = 20;
            }
        }

        // Title
        doc.setFontSize(18);
        doc.setTextColor(102, 126, 234);
        doc.text("Personalfragebogen für Mitarbeiter", 105, yPos, { align: "center" });
        
        yPos += 10;
        doc.setDrawColor(102, 126, 234);
        doc.setLineWidth(0.5);
        doc.line(20, yPos, 190, yPos);
        
        yPos += 15;

        // Section helper function
        function addSection(title) {
            checkNewPage(20);
            doc.setFontSize(14);
            doc.setTextColor(102, 126, 234);
            doc.text(title, leftMargin, yPos);
            yPos += 8;
        }

        // Field helper function
        function addField(label, value, newLine = false) {
            if (!value || value === "false") return;
            
            checkNewPage();
            doc.setFontSize(10);
            doc.setTextColor(0, 0, 0);
            doc.setFont(undefined, "bold");
            doc.text(label + ":", leftMargin, yPos);
            doc.setFont(undefined, "normal");
            
            const labelWidth = doc.getTextWidth(label + ": ");
            const valueX = newLine ? leftMargin : leftMargin + labelWidth + 2;
            
            if (newLine) {
                yPos += 5;
            }
            
            // Handle long text
            const maxWidth = 170 - (newLine ? 0 : labelWidth);
            const splitText = doc.splitTextToSize(String(value), maxWidth);
            doc.text(splitText, valueX, yPos);
            
            yPos += (splitText.length * 5) + 2;
        }

        // Personal Information
        addSection("Persönliche Angaben");
        addField("Firma", data.firma);
        addField("Firma Adresse", data.firma_adresse);
        addField("Personalnummer", data.personalnummer);
        addField("Nachname", data.familienname);
        addField("Geburtsname", data.geburtsname);
        addField("Vorname", data.vorname);
        addField("Geburtsdatum", data.geburtsdatum);
        addField("Straße", data.strasse);
        addField("PLZ/Ort", data.plz + " " + data.ort);
        addField("E-Mail", data.customer_email);
        addField("Telefon", data.telefon);
        addField("Geschlecht", data.geschlecht);
        addField("Staatsangehörigkeit", data.staatsangehoerigkeit);
        addField("Versicherungsnummer", data.versicherungsnummer);
        addField("Geburtsort", data.geburtsort);
        addField("Schwerbehindert", data.schwerbehindert);
        addField("IBAN", data.iban);
        addField("BIC", data.bic);

        yPos += 5;

        // Employment
        addSection("Beschäftigung");
        addField("Eintrittsdatum", data.eintrittsdatum);
        addField("Beschäftigungsbetrieb", data.beschaeftigungsbetrieb);
        addField("Berufsbezeichnung", data.berufsbezeichnung);
        addField("Ausgeübte Tätigkeit", data.ausgeuebte_taetigkeit);
        addField("Art", data.beschaeftigungsart);
        addField("Probezeit", data.probezeit);
        addField("Wöchentliche Arbeitszeit", data.wochenarbeitszeit ? data.wochenarbeitszeit + " Std." : "");
        addField("Arbeitszeit-Typ", data.arbeitszeit_typ);
        
        if (data.mo || data.di || data.mi || data.do || data.fr || data.sa || data.so) {
            let distribution = "Mo:" + (data.mo||0) + " Di:" + (data.di||0) + " Mi:" + (data.mi||0) + 
                              " Do:" + (data.do||0) + " Fr:" + (data.fr||0) + " Sa:" + (data.sa||0) + " So:" + (data.so||0);
            addField("Stundenverteilung", distribution, true);
        }
        
        addField("Urlaubsanspruch", data.urlaubsanspruch);

        yPos += 5;

        // Education
        addSection("Ausbildung");
        addField("Schulabschluss", data.schulabschluss);
        addField("Berufsausbildung", data.berufsausbildung);
        addField("Ausbildungsbeginn", data.ausbildung_beginn);
        addField("Ausbildungsende", data.ausbildung_ende);

        yPos += 5;

        // Tax
        addSection("Steuer");
        addField("Steuer-ID", data.steuer_id);
        addField("Finanzamt-Nr", data.finanzamt_nr);
        addField("Steuerklasse", data.steuerklasse);
        addField("Kinderfreibeträge", data.kinderfreibetraege);
        addField("Konfession", data.konfession);

        yPos += 5;

        // Social Insurance
        addSection("Sozialversicherung");
        addField("Krankenkasse", data.krankenkasse);
        addField("Elterneigenschaft", data.elterneigenschaft);

        yPos += 5;

        // Compensation
        if (data.lohn_bezeichnung1 || data.lohn_betrag1) {
            addSection("Entlohnung");
            addField(data.lohn_bezeichnung1 || "Gehalt", data.lohn_betrag1 ? "€ " + data.lohn_betrag1 : "");
            if (data.lohn_bezeichnung2) {
                addField(data.lohn_bezeichnung2, data.lohn_betrag2 ? "€ " + data.lohn_betrag2 : "");
            }
            if (data.stundenlohn) {
                addField("Stundenlohn", "€ " + data.stundenlohn);
            }
            yPos += 5;
        }

        // Signature
        checkNewPage(50);
        doc.setFontSize(12);
        doc.setTextColor(0, 0, 0);
        doc.setFont(undefined, "bold");
        doc.text("Unterschrift Arbeitnehmer:", leftMargin, yPos);
        
        yPos += 5;
        doc.addImage(signature, "PNG", leftMargin, yPos, 60, 25);
        
        yPos += 30;
        doc.setFont(undefined, "normal");
        doc.setFontSize(9);
        doc.text("Datum: " + new Date().toLocaleDateString("de-DE"), leftMargin, yPos);

        // Footer
        doc.setFontSize(8);
        doc.setTextColor(150, 150, 150);
        doc.text("Erstellt am: " + new Date().toLocaleString("de-DE"), 105, 285, { align: "center" });

        generatedPDF = doc;
    }

    async function sendEmail() {
        if (!generatedPDF) {
            throw new Error("No PDF available");
        }

        const pdfBase64 = generatedPDF.output("datauristring").split(",")[1];
        const formDataToSend = new FormData();
        
        // Add basic info
        formDataToSend.append("name", formData.familienname + ", " + formData.vorname);
        formDataToSend.append("customer_email", formData.customer_email);
        formDataToSend.append("firma_adresse", formData.firma_adresse || "");
        formDataToSend.append("pdf", pdfBase64);

        // Add additional uploaded files
        uploadedFiles.forEach((file, index) => {
            formDataToSend.append('attachments[]', file);
        });

        const response = await fetch("assets/php/signature-email.php", {
            method: "POST",
            body: formDataToSend
        });
        
        const data = await response.json();
        
        // Hide loading
        document.getElementById("loading").style.display = "none";
        
        if (data.success) {
            // Show success modal
            document.getElementById("successModal").style.display = "flex";
        } else {
            throw new Error(data.message || "Fehler beim Senden");
        }
    }

    function closeModal() {
        document.getElementById("successModal").style.display = "none";
        location.reload();
    }
</script>

<?php 
// Include footer
include 'footer.php'; 
?>