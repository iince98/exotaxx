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
        margin: 5% auto;
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
        margin-top: 20px;
    }

    .btn-download, .btn-email {
        flex: 1;
        background: white;
        color: #667eea;
        border: 2px solid #667eea;
    }

    .btn-download:hover, .btn-email:hover {
        background: #667eea;
        color: white;
    }

    .loading {
        display: none;
        text-align: center;
        padding: 40px;
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

    .employer-note {
        background: #fff3cd;
        border: 1px solid #ffc107;
        padding: 10px 15px;
        border-radius: 6px;
        font-size: 12px;
        color: #856404;
        margin-bottom: 15px;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .time-distribution {
            grid-template-columns: repeat(4, 1fr);
        }

        #signatureCanvas {
            width: 100%;
            height: 150px;
        }
    }
</style>
';

// Include header
include 'header.php'; 
?>

<!-- Page Content -->
<section class="contact-area pt-120 pb-120" style="background: #f6faff;">
    <div class="container">
        <div class="signature-container">
            <div class="signature-header">
                <h1>Personalfragebogen für Mitarbeiter</h1>
                <p>Employee Questionnaire - Please fill out all required fields carefully</p>
            </div>

            <div class="form-content">
                <div class="success-message" id="successMessage"></div>

                <div class="employer-note">
                    <strong>Hinweis:</strong> Dieser Personalfragebogen dient zur Vorerfassung von Personaldaten für das DATEV-Lohnabrechnungsprogramm.
                </div>

                <form id="personalForm">
                    <!-- Personal Information -->
                    <div class="form-section">
                        <h2>📋 Persönliche Angaben (Personal Information)</h2>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="firma">Firma (Company)</label>
                                <input type="text" id="firma" name="firma">
                            </div>
                            <div class="form-group">
                                <label for="personalnummer">Personalnummer (Employee Number)</label>
                                <input type="text" id="personalnummer" name="personalnummer">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="familienname">Familienname (Last Name) <span class="required">*</span></label>
                                <input type="text" id="familienname" name="familienname" required>
                            </div>
                            <div class="form-group">
                                <label for="geburtsname">ggf. Geburtsname (Birth Name)</label>
                                <input type="text" id="geburtsname" name="geburtsname">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="vorname">Vorname (First Name) <span class="required">*</span></label>
                                <input type="text" id="vorname" name="vorname" required>
                            </div>
                            <div class="form-group">
                                <label for="geburtsdatum">Geburtsdatum (Date of Birth) <span class="required">*</span></label>
                                <input type="date" id="geburtsdatum" name="geburtsdatum" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group full-width">
                                <label for="strasse">Straße und Hausnummer (Street and Number) <span class="required">*</span></label>
                                <input type="text" id="strasse" name="strasse" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="plz">PLZ (Postal Code) <span class="required">*</span></label>
                                <input type="text" id="plz" name="plz" required>
                            </div>
                            <div class="form-group">
                                <label for="ort">Ort (City) <span class="required">*</span></label>
                                <input type="text" id="ort" name="ort" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Geschlecht (Gender) <span class="required">*</span></label>
                                <div class="radio-group">
                                    <div class="radio-item">
                                        <input type="radio" id="geschlecht_m" name="geschlecht" value="männlich" required>
                                        <label for="geschlecht_m">Männlich (Male)</label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" id="geschlecht_w" name="geschlecht" value="weiblich">
                                        <label for="geschlecht_w">Weiblich (Female)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="staatsangehoerigkeit">Staatsangehörigkeit (Nationality)</label>
                                <input type="text" id="staatsangehoerigkeit" name="staatsangehoerigkeit">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="versicherungsnummer">Versicherungsnummer (Insurance Number)</label>
                                <input type="text" id="versicherungsnummer" name="versicherungsnummer">
                            </div>
                            <div class="form-group">
                                <label for="geburtsort">Geburtsort, -land (Place of Birth)</label>
                                <input type="text" id="geburtsort" name="geburtsort" placeholder="nur bei fehlender Versicherungs-Nr.">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Schwerbehindert (Severely Disabled)</label>
                                <div class="radio-group">
                                    <div class="radio-item">
                                        <input type="radio" id="schwerbehindert_ja" name="schwerbehindert" value="ja">
                                        <label for="schwerbehindert_ja">Ja (Yes)</label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" id="schwerbehindert_nein" name="schwerbehindert" value="nein" checked>
                                        <label for="schwerbehindert_nein">Nein (No)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="arbeitnehmernummer">Arbeitnehmernummer Sozialkasse Bau</label>
                                <input type="text" id="arbeitnehmernummer" name="arbeitnehmernummer">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="iban">IBAN <span class="required">*</span></label>
                                <input type="text" id="iban" name="iban" required>
                            </div>
                            <div class="form-group">
                                <label for="bic">BIC</label>
                                <input type="text" id="bic" name="bic">
                            </div>
                        </div>
                    </div>

                    <!-- Employment Information -->
                    <div class="form-section">
                        <h2>💼 Beschäftigung (Employment)</h2>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="eintrittsdatum">Eintrittsdatum (Start Date) <span class="required">*</span></label>
                                <input type="date" id="eintrittsdatum" name="eintrittsdatum" required>
                            </div>
                            <div class="form-group">
                                <label for="ersteintrittsdatum">Ersteintrittsdatum (First Entry Date)</label>
                                <input type="date" id="ersteintrittsdatum" name="ersteintrittsdatum">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="beschaeftigungsbetrieb">Beschäftigungsbetrieb (Workplace)</label>
                                <input type="text" id="beschaeftigungsbetrieb" name="beschaeftigungsbetrieb">
                            </div>
                            <div class="form-group">
                                <label for="berufsbezeichnung">Berufsbezeichnung (Job Title)</label>
                                <input type="text" id="berufsbezeichnung" name="berufsbezeichnung">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group full-width">
                                <label for="ausgeuebte_taetigkeit">Ausgeübte Tätigkeit (Position/Activity)</label>
                                <input type="text" id="ausgeuebte_taetigkeit" name="ausgeuebte_taetigkeit">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Art der Beschäftigung (Type of Employment)</label>
                                <div class="radio-group">
                                    <div class="radio-item">
                                        <input type="radio" id="haupt" name="beschaeftigungsart" value="Hauptbeschäftigung" checked>
                                        <label for="haupt">Hauptbeschäftigung (Main)</label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" id="neben" name="beschaeftigungsart" value="Nebenbeschäftigung">
                                        <label for="neben">Nebenbeschäftigung (Secondary)</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Probezeit (Probation Period)</label>
                                <div class="radio-group">
                                    <div class="radio-item">
                                        <input type="radio" id="probezeit_ja" name="probezeit" value="ja">
                                        <label for="probezeit_ja">Ja (Yes)</label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" id="probezeit_nein" name="probezeit" value="nein" checked>
                                        <label for="probezeit_nein">Nein (No)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="probezeit_dauer">Dauer der Probezeit (Duration)</label>
                                <input type="text" id="probezeit_dauer" name="probezeit_dauer" placeholder="z.B. 6 Monate">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Weitere Beschäftigungen? (Other Employments?)</label>
                                <div class="radio-group">
                                    <div class="radio-item">
                                        <input type="radio" id="weitere_ja" name="weitere_beschaeftigung" value="ja">
                                        <label for="weitere_ja">Ja (Yes)</label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" id="weitere_nein" name="weitere_beschaeftigung" value="nein" checked>
                                        <label for="weitere_nein">Nein (No)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Geringfügige Beschäftigung? (Marginal Employment?)</label>
                                <div class="radio-group">
                                    <div class="radio-item">
                                        <input type="radio" id="geringfuegig_ja" name="geringfuegig" value="ja">
                                        <label for="geringfuegig_ja">Ja (Yes)</label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" id="geringfuegig_nein" name="geringfuegig" value="nein" checked>
                                        <label for="geringfuegig_nein">Nein (No)</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="wochenarbeitszeit">Wöchentliche Arbeitszeit (Weekly Hours) <span class="required">*</span></label>
                                <input type="number" id="wochenarbeitszeit" name="wochenarbeitszeit" step="0.5" required>
                            </div>
                            <div class="form-group">
                                <label>Arbeitszeit (Working Time)</label>
                                <div class="radio-group">
                                    <div class="radio-item">
                                        <input type="radio" id="vollzeit" name="arbeitszeit_typ" value="Vollzeit" checked>
                                        <label for="vollzeit">Vollzeit (Full-time)</label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" id="teilzeit" name="arbeitszeit_typ" value="Teilzeit">
                                        <label for="teilzeit">Teilzeit (Part-time)</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group full-width">
                            <label>Verteilung der wöchentlichen Arbeitszeit (Weekly Hour Distribution)</label>
                            <div class="time-distribution">
                                <div class="day-input">
                                    <label for="mo">Mo</label>
                                    <input type="number" id="mo" name="mo" step="0.5" min="0" max="24">
                                </div>
                                <div class="day-input">
                                    <label for="di">Di</label>
                                    <input type="number" id="di" name="di" step="0.5" min="0" max="24">
                                </div>
                                <div class="day-input">
                                    <label for="mi">Mi</label>
                                    <input type="number" id="mi" name="mi" step="0.5" min="0" max="24">
                                </div>
                                <div class="day-input">
                                    <label for="do">Do</label>
                                    <input type="number" id="do" name="do" step="0.5" min="0" max="24">
                                </div>
                                <div class="day-input">
                                    <label for="fr">Fr</label>
                                    <input type="number" id="fr" name="fr" step="0.5" min="0" max="24">
                                </div>
                                <div class="day-input">
                                    <label for="sa">Sa</label>
                                    <input type="number" id="sa" name="sa" step="0.5" min="0" max="24">
                                </div>
                                <div class="day-input">
                                    <label for="so">So</label>
                                    <input type="number" id="so" name="so" step="0.5" min="0" max="24">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="urlaubsanspruch">Urlaubsanspruch (Vacation Days)</label>
                                <input type="number" id="urlaubsanspruch" name="urlaubsanspruch" placeholder="Kalenderjahr">
                            </div>
                            <div class="form-group">
                                <label for="baugewerbe_seit">Im Baugewerbe beschäftigt seit</label>
                                <input type="date" id="baugewerbe_seit" name="baugewerbe_seit">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="kostenstelle">Kostenstelle (Cost Center)</label>
                                <input type="text" id="kostenstelle" name="kostenstelle">
                            </div>
                            <div class="form-group">
                                <label for="abt_nummer">Abteilungsnummer (Dept. Number)</label>
                                <input type="text" id="abt_nummer" name="abt_nummer">
                            </div>
                            <div class="form-group">
                                <label for="personengruppe">Personengruppe (Personnel Group)</label>
                                <input type="text" id="personengruppe" name="personengruppe">
                            </div>
                        </div>
                    </div>

                    <!-- Education -->
                    <div class="form-section">
                        <h2>🎓 Ausbildung (Education)</h2>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label>Höchster Schulabschluss (Highest School Degree)</label>
                                <select id="schulabschluss" name="schulabschluss">
                                    <option value="">Bitte wählen...</option>
                                    <option value="ohne">Ohne Schulabschluss</option>
                                    <option value="haupt">Haupt-/Volksschulabschluss</option>
                                    <option value="mittlere">Mittlere Reife/gleichwertiger Abschluss</option>
                                    <option value="abitur">Abitur/Fachabitur</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Höchste Berufsausbildung (Highest Vocational Training)</label>
                                <select id="berufsausbildung" name="berufsausbildung">
                                    <option value="">Bitte wählen...</option>
                                    <option value="ohne">Ohne beruflichen Ausbildungsabschluss</option>
                                    <option value="anerkannt">Anerkannte Berufsausbildung</option>
                                    <option value="meister">Meister/Techniker/gleichwertiger Fachschulabschluss</option>
                                    <option value="bachelor">Bachelor</option>
                                    <option value="diplom">Diplom/Magister/Master/Staatsexamen</option>
                                    <option value="promotion">Promotion</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="ausbildung_beginn">Beginn der Ausbildung (Training Start)</label>
                                <input type="date" id="ausbildung_beginn" name="ausbildung_beginn">
                            </div>
                            <div class="form-group">
                                <label for="ausbildung_ende">Voraussichtliches Ende (Expected End)</label>
                                <input type="date" id="ausbildung_ende" name="ausbildung_ende">
                            </div>
                        </div>
                    </div>

                    <!-- Contract Terms -->
                    <div class="form-section">
                        <h2>📝 Befristung (Contract Terms)</h2>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label>Arbeitsverhältnis befristet? (Fixed-term Contract?)</label>
                                <div class="radio-group">
                                    <div class="radio-item">
                                        <input type="radio" id="befristet_ja" name="befristet" value="ja">
                                        <label for="befristet_ja">Ja (Yes)</label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" id="befristet_nein" name="befristet" value="nein" checked>
                                        <label for="befristet_nein">Nein (No)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="befristung_datum">Befristung zum (Contract End Date)</label>
                                <input type="date" id="befristung_datum" name="befristung_datum">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="vertrag_abschluss">Abschluss Arbeitsvertrag am (Contract Date)</label>
                                <input type="date" id="vertrag_abschluss" name="vertrag_abschluss">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="checkbox-item">
                                <input type="checkbox" id="bea_widerspruch" name="bea_widerspruch">
                                <label for="bea_widerspruch">Ich widerspreche der elektronischen Übermittlung von Bescheinigungen (I object to electronic transmission)</label>
                            </div>
                        </div>
                    </div>

                    <!-- Tax Information -->
                    <div class="form-section">
                        <h2>💰 Steuer (Tax Information)</h2>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="steuer_id">Steuerliche Identifikationsnummer <span class="required">*</span></label>
                                <input type="text" id="steuer_id" name="steuer_id" required>
                            </div>
                            <div class="form-group">
                                <label for="finanzamt_nr">Finanzamt-Nr.</label>
                                <input type="text" id="finanzamt_nr" name="finanzamt_nr">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="steuerklasse">Steuerklasse/Faktor (Tax Class)</label>
                                <input type="text" id="steuerklasse" name="steuerklasse">
                            </div>
                            <div class="form-group">
                                <label for="kinderfreibetraege">Kinderfreibeträge (Child Allowances)</label>
                                <input type="number" id="kinderfreibetraege" name="kinderfreibetraege" step="0.5" min="0">
                            </div>
                            <div class="form-group">
                                <label for="konfession">Konfession (Religion)</label>
                                <select id="konfession" name="konfession">
                                    <option value="">Bitte wählen...</option>
                                    <option value="ev">Evangelisch</option>
                                    <option value="rk">Römisch-Katholisch</option>
                                    <option value="keine">Keine</option>
                                    <option value="andere">Andere</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Social Insurance -->
                    <div class="form-section">
                        <h2>🏥 Sozialversicherung (Social Insurance)</h2>
                        
                        <div class="form-row">
                            <div class="form-group full-width">
                                <label for="krankenkasse">Gesetzliche Krankenkasse (Health Insurance)</label>
                                <input type="text" id="krankenkasse" name="krankenkasse" placeholder="bei PKV: letzte gesetzliche Krankenkasse">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Elterneigenschaft (Parental Status)</label>
                                <div class="radio-group">
                                    <div class="radio-item">
                                        <input type="radio" id="eltern_ja" name="elterneigenschaft" value="ja">
                                        <label for="eltern_ja">Ja (Yes)</label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" id="eltern_nein" name="elterneigenschaft" value="nein" checked>
                                        <label for="eltern_nein">Nein (No)</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="kv">KV (Health Insurance Status)</label>
                                <input type="text" id="kv" name="kv">
                            </div>
                            <div class="form-group">
                                <label for="rv">RV (Pension Insurance)</label>
                                <input type="text" id="rv" name="rv">
                            </div>
                            <div class="form-group">
                                <label for="av">AV (Unemployment Insurance)</label>
                                <input type="text" id="av" name="av">
                            </div>
                            <div class="form-group">
                                <label for="pv">PV (Care Insurance)</label>
                                <input type="text" id="pv" name="pv">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="uv_gefahrentarif">UV-Gefahrentarif</label>
                                <input type="text" id="uv_gefahrentarif" name="uv_gefahrentarif">
                            </div>
                            <div class="form-group">
                                <label for="deuev_status">DEÜV-Status</label>
                                <input type="text" id="deuev_status" name="deuev_status">
                            </div>
                        </div>
                    </div>

                    <!-- Compensation -->
                    <div class="form-section">
                        <h2>💵 Entlohnung (Compensation)</h2>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="lohn_bezeichnung1">Bezeichnung (Description)</label>
                                <input type="text" id="lohn_bezeichnung1" name="lohn_bezeichnung1" placeholder="z.B. Grundgehalt">
                            </div>
                            <div class="form-group">
                                <label for="lohn_betrag1">Betrag (Amount)</label>
                                <input type="number" id="lohn_betrag1" name="lohn_betrag1" step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="lohn_gueltig1">Gültig ab (Valid from)</label>
                                <input type="date" id="lohn_gueltig1" name="lohn_gueltig1">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="lohn_bezeichnung2">Bezeichnung 2</label>
                                <input type="text" id="lohn_bezeichnung2" name="lohn_bezeichnung2">
                            </div>
                            <div class="form-group">
                                <label for="lohn_betrag2">Betrag 2</label>
                                <input type="number" id="lohn_betrag2" name="lohn_betrag2" step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="stundenlohn">Stundenlohn (Hourly Wage)</label>
                                <input type="number" id="stundenlohn" name="stundenlohn" step="0.01">
                            </div>
                        </div>
                    </div>

                    <!-- VWL (Capital Formation) -->
                    <div class="form-section">
                        <h2>📊 Vermögenswirksame Leistungen (VWL)</h2>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="vwl_empfaenger">Empfänger VWL (VWL Recipient)</label>
                                <input type="text" id="vwl_empfaenger" name="vwl_empfaenger">
                            </div>
                            <div class="form-group">
                                <label for="vwl_betrag">Betrag (Amount)</label>
                                <input type="number" id="vwl_betrag" name="vwl_betrag" step="0.01">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="vwl_ag_anteil">AG-Anteil (Employer Share)</label>
                                <input type="number" id="vwl_ag_anteil" name="vwl_ag_anteil" step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="vwl_seit">Seit wann (Since)</label>
                                <input type="date" id="vwl_seit" name="vwl_seit">
                            </div>
                            <div class="form-group">
                                <label for="vwl_vertragsnr">Vertragsnr. (Contract No.)</label>
                                <input type="text" id="vwl_vertragsnr" name="vwl_vertragsnr">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="vwl_iban">IBAN</label>
                                <input type="text" id="vwl_iban" name="vwl_iban">
                            </div>
                            <div class="form-group">
                                <label for="vwl_bic">BIC</label>
                                <input type="text" id="vwl_bic" name="vwl_bic">
                            </div>
                        </div>
                    </div>

                    <!-- Documents Checklist -->
                    <div class="form-section">
                        <h2>📄 Arbeitspapiere (Employment Documents)</h2>
                        
                        <div class="checkbox-group" style="flex-direction: column;">
                            <div class="checkbox-item">
                                <input type="checkbox" id="doc_arbeitsvertrag" name="doc_arbeitsvertrag">
                                <label for="doc_arbeitsvertrag">Arbeitsvertrag liegt vor (Employment contract available)</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="doc_lst" name="doc_lst">
                                <label for="doc_lst">Bescheinigung über LSt.-Abzug liegt vor (Tax deduction certificate)</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="doc_sv" name="doc_sv">
                                <label for="doc_sv">SV-Ausweis liegt vor (Social security card)</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="doc_krankenkasse" name="doc_krankenkasse">
                                <label for="doc_krankenkasse">Mitgliedsbescheinigung Krankenkasse liegt vor (Health insurance certificate)</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="doc_pkv" name="doc_pkv">
                                <label for="doc_pkv">Bescheinigung der privaten Krankenversicherung liegt vor (Private health insurance cert.)</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="doc_vwl" name="doc_vwl">
                                <label for="doc_vwl">VWL Vertrag liegt vor (VWL contract available)</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="doc_eltern" name="doc_eltern">
                                <label for="doc_eltern">Nachweis Elterneigenschaft liegt vor (Parental status proof)</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="doc_altersversorgung" name="doc_altersversorgung">
                                <label for="doc_altersversorgung">Vertrag Betriebliche Altersversorgung liegt vor (Pension contract)</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="doc_schwerbehindert" name="doc_schwerbehindert">
                                <label for="doc_schwerbehindert">Schwerbehindertenausweis liegt vor (Disability ID)</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="doc_sozialkasse" name="doc_sozialkasse">
                                <label for="doc_sozialkasse">Unterlagen Sozialkasse Bau/Maler liegt vor (Construction social fund documents)</label>
                            </div>
                        </div>
                    </div>

                    <!-- Previous Employment -->
                    <div class="form-section">
                        <h2>📅 Vorbeschäftigungszeiten (Previous Employment)</h2>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="vorbesch_von">Zeitraum von (Period from)</label>
                                <input type="date" id="vorbesch_von" name="vorbesch_von">
                            </div>
                            <div class="form-group">
                                <label for="vorbesch_bis">Zeitraum bis (Period to)</label>
                                <input type="date" id="vorbesch_bis" name="vorbesch_bis">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="vorbesch_art">Art der Beschäftigung (Type of Employment)</label>
                                <input type="text" id="vorbesch_art" name="vorbesch_art">
                            </div>
                            <div class="form-group">
                                <label for="vorbesch_tage">Anzahl der Beschäftigungstage (Number of Days)</label>
                                <input type="number" id="vorbesch_tage" name="vorbesch_tage">
                            </div>
                        </div>
                    </div>

                    <!-- Signature Section -->
                    <div class="form-section">
                        <h2>✍️ Unterschrift (Signature)</h2>
                        
                        <div class="employer-note" style="margin-bottom: 20px;">
                            <strong>Erklärung:</strong> Ich versichere, dass die vorstehenden Angaben der Wahrheit entsprechen. Ich verpflichte mich, meinem Arbeitgeber alle Änderungen unverzüglich mitzuteilen.
                        </div>

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

                        <div class="form-row" style="margin-top: 20px;">
                            <div class="form-group">
                                <label for="unterschrift_datum">Datum (Date) <span class="required">*</span></label>
                                <input type="date" id="unterschrift_datum" name="unterschrift_datum" required>
                            </div>
                            <div class="form-group">
                                <label for="vertreter_datum">Bei Minderjährigen - Datum Vertreter</label>
                                <input type="date" id="vertreter_datum" name="vertreter_datum">
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h2>📎 Zusätzliche Dokumente (Additional Documents)</h2>
                        <p style="font-size: 13px; color: #666; margin-bottom: 15px;">
                            Laden Sie hier zusätzliche Dokumente hoch (z.B. Ausweiskopie, Krankenkassenkarte, etc.)
                        </p>
                        <div class="form-group">
                            <input type="file" id="additionalFiles" name="additionalFiles[]" multiple accept=".pdf,.jpg,.jpeg,.png">
                            <div id="fileList" style="margin-top: 10px; font-size: 13px;"></div>
                        </div>
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
        <p style="color: #666; margin-bottom: 20px;">Your Personalfragebogen has been created. What would you like to do?</p>
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

<!-- Load jsPDF library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    let canvas, ctx, isDrawing = false;
    let uploadedFile = null;
    let generatedPDF = null;
    let formData = {};

    // Initialize on page load
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize canvas
        canvas = document.getElementById("signatureCanvas");
        ctx = canvas.getContext("2d");
        ctx.strokeStyle = "#000";
        ctx.lineWidth = 2;
        ctx.lineCap = "round";

        // Set today's date as default
        document.getElementById("unterschrift_datum").valueAsDate = new Date();

        // Tab switching
        document.querySelectorAll(".tab-btn").forEach(btn => {
            btn.addEventListener("click", function() {
                document.querySelectorAll(".tab-btn").forEach(b => b.classList.remove("active"));
                document.querySelectorAll(".tab-content").forEach(c => c.classList.remove("active"));
                
                this.classList.add("active");
                document.getElementById(this.dataset.tab + "-tab").classList.add("active");
            });
        });

        // Canvas drawing events
        canvas.addEventListener("mousedown", startDrawing);
        canvas.addEventListener("mousemove", draw);
        canvas.addEventListener("mouseup", stopDrawing);
        canvas.addEventListener("mouseout", stopDrawing);
        
        // Touch events for mobile
        canvas.addEventListener("touchstart", handleTouchStart);
        canvas.addEventListener("touchmove", handleTouchMove);
        canvas.addEventListener("touchend", stopDrawing);

        // File upload
        const uploadArea = document.getElementById("uploadArea");
        const fileInput = document.getElementById("signatureUpload");

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
            handleFiles(e.dataTransfer.files);
        });

        fileInput.addEventListener("change", (e) => {
            handleFiles(e.target.files);
        });
    });

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

    function handleTouchStart(e) {
        e.preventDefault();
        const touch = e.touches[0];
        const rect = canvas.getBoundingClientRect();
        isDrawing = true;
        ctx.beginPath();
        ctx.moveTo(touch.clientX - rect.left, touch.clientY - rect.top);
    }

    function handleTouchMove(e) {
        e.preventDefault();
        if (!isDrawing) return;
        const touch = e.touches[0];
        const rect = canvas.getBoundingClientRect();
        ctx.lineTo(touch.clientX - rect.left, touch.clientY - rect.top);
        ctx.stroke();
    }

    function clearCanvas() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }

    function handleFiles(files) {
        if (files.length === 0) return;
        
        const file = files[0];
        
        if (!file.type.match("image.*")) {
            alert("Please upload an image file");
            return;
        }

        if (file.size > 5 * 1024 * 1024) {
            alert("File size must be less than 5MB");
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            uploadedFile = e.target.result;
            document.getElementById("uploadedImage").src = uploadedFile;
            document.getElementById("uploadPreview").style.display = "block";
        };
        reader.readAsDataURL(file);
    }

    function clearUpload() {
        uploadedFile = null;
        document.getElementById("uploadPreview").style.display = "none";
        document.getElementById("signatureUpload").value = "";
    }

    function validateForm() {
        let isValid = true;
        
        // Validate signature
        const activeTab = document.querySelector(".tab-btn.active").dataset.tab;
        const signatureError = document.getElementById("signatureError");
        
        if (activeTab === "draw") {
            const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
            const isEmpty = !imageData.data.some(channel => channel !== 0);
            
            if (isEmpty) {
                signatureError.textContent = "Please provide a signature";
                signatureError.style.display = "block";
                isValid = false;
            } else {
                signatureError.style.display = "none";
            }
        } else {
            if (!uploadedFile) {
                signatureError.textContent = "Please upload a signature image";
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
        addField("Personalnummer", data.personalnummer);
        addField("Nachname", data.familienname);
        addField("Geburtsname", data.geburtsname);
        addField("Vorname", data.vorname);
        addField("Geburtsdatum", data.geburtsdatum);
        addField("Straße", data.strasse);
        addField("PLZ/Ort", data.plz + " " + data.ort);
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
        addField("Wöchentliche Arbeitszeit", data.wochenarbeitszeit + " Std.");
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
        doc.text("Datum: " + (data.unterschrift_datum || new Date().toLocaleDateString("de-DE")), leftMargin, yPos);

        // Footer
        doc.setFontSize(8);
        doc.setTextColor(150, 150, 150);
        doc.text("Erstellt am: " + new Date().toLocaleString("de-DE"), 105, 285, { align: "center" });

        generatedPDF = doc;
    }

    function downloadPDF() {
        if (generatedPDF) {
            generatedPDF.save("Personalfragebogen-" + Date.now() + ".pdf");
        }
    }

    function sendEmail() {
    if (!generatedPDF) {
        alert("No PDF available");
        return;
    }

    const pdfBase64 = generatedPDF.output("datauristring").split(",")[1];
    const formDataToSend = new FormData();
    
    // Add basic info
    formDataToSend.append("name", formData.familienname + ", " + formData.vorname);
    formDataToSend.append("email", formData.email || "");
    formDataToSend.append("pdf", pdfBase64);

    // NEW: Add additional uploaded files
    const fileInput = document.getElementById('additionalFiles');
    for (let i = 0; i < fileInput.files.length; i++) {
        formDataToSend.append('attachments[]', fileInput.files[i]);
    }

    fetch("assets/php/signature-email.php", {
        method: "POST",
        body: formDataToSend
    })
    .then(response => response.json()) // Updated to expect JSON
    .then(data => {
        if(data.success) {
            alert("Erfolgreich gesendet!");
            location.reload();
        } else {
            alert("Fehler: " + data.message);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Error sending email.");
    });
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