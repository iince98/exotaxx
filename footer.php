    </main>
    <!-- main-area-end -->

    <!-- footer -->
    <footer class="footer-bg footer-p">
        <div class="footer-top  pt-70  pb-40">
            <div class="container">
                <div class="row justify-content-between">

                    <div class="col-xl-4 col-lg-4 col-sm-6">
                        <div class="footer-widget mb-30">
                            <div class="f-widget-title mb-30">
                                <img src="assets/img/logo/logo-white.png" alt="img">
                            </div>
                            <div class="f-contact">
                                <ul>
                                    <li>
                                        <i class="icon fal fa-map-marker-alt"></i>
                                        <span>Vogelsanger Weg 91,<br>40470 Düsseldorf</span>
                                    </li>
                                    <li>
                                        <i class="icon fal fa-phone"></i>
                                        <span>+49 21154249080</span>
                                    </li>
                                    <li><i class="icon fal fa-envelope"></i>
                                        <span>
                                            <a href="mailto:info@exotaxx.de">info@exotaxx.de</a>
                                        </span>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-sm-6">
                        <div class="footer-widget mb-30">
                            <div class="f-widget-title">
                                <h2>Quick Links</h2>
                            </div>
                            <div class="footer-link">
                                <ul>
                                    <li><a href="index.php"><i class="far fa-angle-double-right"></i> Home</a></li>
                                    <li><a href="about.php"><i class="far fa-angle-double-right"></i> About Us</a></li>
                                    <li><a href="services.php"><i class="far fa-angle-double-right"></i> Leistungen </a>
                                    </li>
                                    <li><a href="contact.php"><i class="far fa-angle-double-right"></i> Kontakt</a>
                                    </li>
                                    <li><a href="index.php"><i class="far fa-angle-double-right"></i> Blog </a></li>
                              
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-sm-6">
                        <div class="footer-widget mb-30">
                            <div class="f-widget-title">
                                <h2>Important Links</h2>
                            </div>
                            <div class="footer-link">
                                <ul>
                                    <li><a href="index.php"><i class="far fa-angle-double-right"></i> FAQ</a></li>
                                    <li><a href="contact.php"><i class="far fa-angle-double-right"></i> Support</a></li>
                                    <li><a href="index.php"><i class="far fa-angle-double-right"></i> Team</a></li>
                                    <li><a href="index.php"><i class="far fa-angle-double-right"></i> Pricing</a>
                                    </li>
                                    <li><a href="term-condition.php"><i class="far fa-angle-double-right"></i> Datenschutzrichtlinie</a></li>
                                    <li><a href="privacy-policy.php"><i class="far fa-angle-double-right"></i>Impressum </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-sm-6">
                        <div class="footer-widget mb-30">
                            <div class="f-widget-title mb-30">
                                <h2>Newsletter</h2>
                            </div>
                            <div class="footer-link">
                                <div class="subricbe p-relative" data-animation="fadeInDown" data-delay=".4s">
                                    <form action="#" method="post" class="contact-form ">
                                        <input type="text" id="email2" name="email2" class="header-input"
                                            placeholder="Your Email..." required>
                                        <button class="btn header-btn"> <i class="fal fa-paper-plane"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <div class="footer-social  mt-30">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="copyright-wrap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        Copyright © <span id="date"></span> <a href="#" class="text-primary">Exotaxx GmbH</a>. All rights reserved.
                    </div>
                    <div class="col-lg-6 text-right text-xl-right">
                        <ul>
                            <li><a href="term-condition.php">Datenschutzrichtlinie</a></li>
                            <li><a href="privacy-policy.php">Impressum</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </footer>
    <!-- footer-end -->

    <!-- JS -->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/modernizr-3.5.0.min.js"></script>
    <script src="assets/js/one-page-nav-min.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/paroller.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/js_isotope.pkgd.min.js"></script>
    <script src="assets/js/imagesloaded.min.js"></script>
    <script src="assets/js/parallax.min.js"></script>
    <script src="assets/js/jquery.waypoints.min.js"></script>
    <script src="assets/js/jquery.countdown.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/jquery.scrollUp.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <script src="assets/js/jquery.meanmenu.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
        // Set current year in footer
        document.getElementById('date').textContent = new Date().getFullYear();
    </script>
    
    <?php 
    // Allow pages to add custom JS
    if (isset($custom_js)) {
        echo $custom_js;
    }
    ?>
</body>
</html>
