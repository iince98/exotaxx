<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo isset($page_title) ? $page_title : 'ExoTaxx GmbH'; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon (Google & browsers) -->
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/meanmenu.css">
    <link rel="stylesheet" href="assets/css/default.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    
    <?php 
    // Allow pages to add custom CSS
    if (isset($custom_css)) {
        echo $custom_css;
    }
    ?>
</head>

<body>
    <!-- preloader -->
    <div class="preloader">
        <div class="loader">
            <div id="loader-content">
              <div></div>
              <div></div>
              <div></div>
              <div></div>
            </div>
          </div>
    </div>
    <!-- preloader -->

    <!-- header -->
    <header class="header-area header-area2">
        <div class="header-top second-header d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8 col-md-8 p-2 d-none  d-md-block">
                        <div class="header-cta">
                            <ul>
                                <li>
                                    <div class="text" >
                                        <i class="fal fa-map-marker-alt"></i>
                                        <div class="box"><strong>Vogelsanger Weg 91,</strong><strong>40470 Düsseldorf</strong></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="text">
                                        <i class="fal fa-phone"></i>
                                        <div class="box"><strong>Rufen Sie uns an</strong><strong>+49 21154249080</strong></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="text">
                                        <i class="fal fa-envelope"></i>
                                        <div class="box"><strong>Kontakt:</strong><strong><a href="mailto:info@exotaxx.de">info@exotaxx.de</a></strong></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="text">
                                        <i class="fal fa-clock"></i>
                                        <div class="box"><strong>Mo-Fr :</strong> <strong>09:00AM - 6:00PM</strong></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 d-none d-lg-block">
                        <div class="header-social text-right">
                            <span>
                                <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                                <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                                <a href="#" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                                <a href="#" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="header-sticky" class="menu-area">
            <div class="container">
                <div class="second-menu">
                    <div class="row align-items-center">
                        <div class="col-xl-2 col-lg-2 p-0">
                            <div class="logo">
                                <a href="index.php"><img src="assets/img/logo/logo.png" alt="logo"></a>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8">
                            <div class="main-menu text-right text-xl-center">
                                <nav id="mobile-menu" style="display: block;">
                                    <ul>
                                        <li><a href="index.php">Hauptseite</a></li>
                                    
                                        <li><a href="services.php">Leistungen</a></li>
                                    
                                        <li><a href="about.php">Über uns</a></li>
                                    
                                        <li class="has-sub">
                                            <a href="#">Online Anfrage</a>
                                            <ul>
                                                <li>
                                                    <a href="signature-form.php">Personalfragebogen</a>
                                                </li>
                                            </ul>
                                        </li>
                                    
                                        <li><a href="contact.php">Kontakt</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 text-right d-none d-lg-block text-right text-xl-right">
                            <div class="login">
                                <ul>
                                    <li>
                                        <div class="second-header-btn">
                                            <a href="contact.php" class="btn">Kontakt</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile-menu"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

    <!-- main-area -->
    <main>
