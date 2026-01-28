<!doctype html>
<html lang="en">

<?php 
include 'header.php'; 
?>

<body>


    <!-- main-area -->
    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area d-flex align-items-center"
            style="background-image:url(assets/img/bg/header-bg.jpg)">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-12 col-lg-12">
                        <div class="breadcrumb-wrap text-center">
                            <div class="breadcrumb-title">
                                <h2>Kontaktieren Sie uns</h2>
                                <div class="breadcrumb-wrap">

                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Kontakt</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->

        <!--contact services-area -->
        <section id="services" class="services-area pt-120 pb-90 fix">
            <div class="container">

                <div class="row">
                    <div class="col-lg-4 col-md-4 mb-3">
                        <div class="services-box text-center">
                            <div class="services-icon">
                                <i class="fal fa-map-marker-alt"></i>
                            </div>
                            <div class="services-content2">
                                <h5>Unsere Adresse</h5>
                                <p>Vogelsanger Weg 91,<br>40470 Düsseldorf</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 mb-3">

                        <div class="services-box text-center">
                            <div class="services-icon">
                                <i class="fal fa-envelope"></i>
                            </div>
                            <div class="services-content2">
                                <h5>Email Address</h5>
                                <p>info@exotaxx.de <br /> <br /> </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 mb-3">

                        <div class="services-box text-center">
                            <div class="services-icon">
                                <i class="fal fa-phone"></i>
                            </div>
                            <div class="services-content2">
                                <h5>Telefon</h5>
                                <p> +49 21154249080 </p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- services-area-end -->

        <!-- contact-area -->
        <section id="contact" class="contact-area contact-bg pt-120 pb-120 p-relative fix" style="background: #f6faff;">
            <div class="ab-ani2"><img src="assets/img/bg/shape-1.png" alt="img"></div>
            <div class="ab-ani3"><img src="assets/img/bg/shape-1.png" alt="img"></div>

            <div class="container">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact-bg02">
                            <div class="section-title center-align">

                                <h2>
                                    Senden Sie Ihre Nachricht
                                </h2>

                            </div>

                            <form action="/fineco/assets/php/contact.php" method="post" class="contact-form mt-30"  id="contact-form">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="contact-field p-relative c-name mb-15">
                                            <input type="text" id="name" name="name" placeholder="Your Name"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="contact-field p-relative c-subject mb-15">
                                            <input type="text" id="email" name="email" placeholder="Your Eamil" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="contact-field p-relative c-subject mb-15">
                                            <input type="text" id="phone" name="phone" placeholder="Your Phone" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="contact-field p-relative c-option mb-15">
                                            <select name="services" id="sr">
                                                <option value="#">Service auswählen</option>
                                                <option value="1">Unternehmensberatung</option>
                                                <option value="2">Existenz- und Unternehmensgründung</option>
                                                <option value="2">Allg. Finanz- und Lohnbuchhaltung</option>
                                                  <option value="1">Unternehmensberatung</option>
                                                <option value="2">Finanzbuchhaltung</option>
                                                <option value="2">Lohnbuchhaltung</option>
                                                  <option value="1">Rechnungswesen</option>
                                                <option value="2">Buchhaltungsdienste</option>
                                                <option value="2">Unternehmensbuchführung</option>
                                                  <option value="1">Erstellen der Laufenden Lohn- und Gehaltsabrechnungen</option>
                                                <option value="2">Debitoren- und Kreditorenüberwachung</option>
                                                <option value="2">Erstellung von Betriebswirtschaftlichen und buchhalterischen Auswertungen</option>
                                                  <option value="1">Sekretariatsdienste</option>
                                                <option value="2">Schreibdienste</option>
                                                <option value="2">Hol- und Bringservice Ihrer Unterlagen- nach Vereinbarung</option>
                                                  <option value="1">Anträge Lohnfortzahlungen</option>
                                                <option value="2">Unterstützung in Buchhalterischen Fragestellungen</option>
                                                <option value="2">Buchen der laufenden Geschäftsvorfälle der Finanzbuchhaltung</option>
                                                  <option value="1">Fertigen der Lohnsteuermeldungen
und der Sozialversicherungsmeldungen</option>
                                                <option value="2">Förderprogramm für EU-Projekte</option>
                                                <option value="2">Bürodienstleistungen</option>
                                                  <option value="1">Buchführungswesen</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="contact-field p-relative c-message mb-30">
                                            <textarea name="message" id="message" cols="30" rows="10"
                                                placeholder="Your Message" required></textarea>
                                        </div>
                                        <div class="slider-btn">
                                            <button class="btn theme-btn active" data-animation="fadeInRight"
                                                data-delay=".8s">Send</button>
                                        </div>
                                    </div>
                                </div>

                            </form>

                            <div class="col-lg-12 my-2">
                                <div class="form-messege text-success"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
<div style="text-align:center; margin-bottom:10px;">
  <strong>📍 Exotaxx GmbH</strong><br>
  Vogelsanger Weg 91, 40470 Düsseldorf
</div>

<iframe
  src="https://maps.google.com/maps?q=Vogelsanger%20Weg%2091,%2040470%20D%C3%BCsseldorf&output=embed"
  width="600"
  height="615"
  style="border:0;"
  allowfullscreen=""
  loading="lazy"
  referrerpolicy="no-referrer-when-downgrade">
</iframe>

                    </div>
                </div>
            </div>

        </section>
        <!-- contact-area-end -->



    </main>
    <!-- main-area-end -->
    <?php 
include 'footer.php'; 
?>
</body>


</html>