</div>
    </div>




    <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="<?= base_url()?>/public/assets/js/jquery-3.6.0.min.js"></script>

    <script src="<?= base_url()?>/public/assets/js/popper.min.js"></script>
    <script src="<?= base_url()?>/public/assets/js/bootstrap.min.js"></script>

    <script src="<?= base_url()?>/public/assets/js/swiper-bundle.min.js"></script>

    <script src="<?= base_url()?>/public/assets/js/waypoints.min.js"></script>

    <script src="<?= base_url()?>/public/assets/js/jquery.counterup.min.js"></script>

    <script src="<?= base_url()?>/public/assets/js/isotope.pkgd.min.js"></script>

    <script src="<?= base_url()?>/public/assets/js/jquery.fancybox.min.js"></script>

    <script src="<?= base_url()?>/public/assets/js/gsap.min.js"></script>
    <script src="<?= base_url()?>/public/assets/js/simpleParallax.min.js"></script>
    <script src="<?= base_url()?>/public/assets/js/TweenMax.min.js"></script>

    <script src="<?= base_url()?>/public/assets/js/jquery.marquee.min.js"></script>

    <script src="<?= base_url()?>/public/assets/js/wow.min.js"></script>

    <script src="<?= base_url()?>/public/assets/js/sidebar.js"></script>

    <script src="<?= base_url()?>/public/assets/js/preloader.js"></script>
    <script src="<?= base_url()?>/public/assets/js/custom.js"></script>
    <script>
        $(".marquee_text").marquee({
            direction: "left",
            duration: 40000,
            gap: 50,
            delayBeforeStart: 0,
            duplicated: true,
            startVisible: true,
        });
        $(".marquee_text2").marquee({
            direction: "left",
            duration: 40000,
            gap: 50,
            delayBeforeStart: 0,
            duplicated: true,
            startVisible: true,
        });
    </script>
	
	<?php
        if (!empty ($footer_asset_link)) {
            foreach ($footer_asset_link as $link) {
                echo "<script src='" . base_url() . 'public/' . $link . "'></script>";
            }
        }
        if (!empty ($footer_link)) {
            foreach ($footer_link as $link) {
                require_once ('js/' . $link);
            }
        }
    ?>

</body>

</html>