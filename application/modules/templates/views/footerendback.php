<!-- Bootstrap core JavaScript-->
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-hover-dropdown.js') ?>"></script>
<!-- FlexSlider -->
<script defer src="<?php echo base_url('assets/js/jquery.flexslider-min.js') ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/fitdivs.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/scripts.js?a=13') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/notificacion.js') ?>"></script>


<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.lightbox.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/slider.min.js') ?>"></script>

<!-- Optional FlexSlider Additions -->
<script src="<?php echo base_url('assets/js/jquery.easing.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.mousewheel.js') ?>"></script>

<!--fuera de juego -->
<script src="<?= base_url() ?>assets/js/jquery.easing.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.touchSwipe.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.liquid-slider.min.js"></script>

<!-- Third, add the GalleryView Javascript and CSS files -->
<script type="text/javascript" src="<?= base_url() ?>assets/js/jcarousellite_1.0.1.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.lazyload.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-scrollto.js"></script>

<script src="<?php echo base_url('assets/js/smartbanner/jquery.smartbanner.js') ?>"></script>

<?php
$idtipo = $this->uri->segment(2);
$tipo = array("noticia", "nuestrosembajadores", "lavoz", "zonafe", "equipo", "masleido");
if (in_array($idtipo, $tipo)) { ?>
    <!--   script teads  se muestra cuando es noticia abierta-->
    <script type="text/javascript">
        window._ttf = window._ttf || [];
        _ttf.push({
            pid          : 39281
            ,lang        : "es"
            ,slot        : '.noticia-body > p'
            ,format      : "inread"
            ,minSlot     : 1
            ,components  : { mute: {delay :3}, skip: {delay :3} }
            ,css         : "margin: 0px 0px 10px;"
        });

        (function (d) {
            var js, s = d.getElementsByTagName('script')[0];
            js = d.createElement('script');
            js.async = true;
            js.src = '//cdn.teads.tv/media/format.js';
            s.parentNode.insertBefore(js, s);
        })(window.document);
    </script>
    <?php
} else { ?>
    <!--   script teads  home, zona fe, otras -->
    <script type="text/javascript">
        window._ttf = window._ttf || [];
        _ttf.push({
            pid          : 48650
            ,lang        : "es"
            ,slot        : '.row .navbar .navbar-collapse'
            ,format      : "inboard"
            ,components  : { mute: {delay :0}, skip: {delay :3} }
            ,css         : "padding: 0px 10px;"
        });

        (function (d) {
            var js, s = d.getElementsByTagName('script')[0];
            js = d.createElement('script');
            js.async = true;
            js.src = '//cdn.teads.tv/media/format.js';
            s.parentNode.insertBefore(js, s);
        })(window.document);
    </script>
    <?php
}
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('.hidden-menu').css('display', 'none');
        // inicializa menu
        $(document).on('click', '.fhmm .dropdown-menu', function (e) {
            e.stopPropagation()
        })
        // Menu drop down effect
        $('.dropdown-toggle').dropdownHover().dropdown();
        $(".fhmm").fitVids();

        // Initiate Lightbox
        $('.image-item > a').lightbox();
    });
</script>

<?php
if (isset($fe_splash))
    echo $fe_splash;
?>

<?php
if (isset($fe_scritp_footer))
    echo $fe_scritp_footer;
?>

<!-- Taboola  tracking add 20151023-->
<script type="text/javascript">
    window._taboola = window._taboola || [];
    _taboola.push({flush: true});
</script>
<!-- End Taboola  tracking add 20151023-->


<!-- Start Alexa Certify Javascript -->
<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script>
<script type="text/javascript">_atrk_opts = {atrk_acct: "A9Dnf1aUOO00Gi", domain: "futbolecuador.com"};
    atrk();</script>
<noscript>
    <img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=A9Dnf1aUOO00Gi" style="display: none" height="1"
         width="1" alt=""/>
</noscript>
<!-- End Alexa Certify Javascript -->


<!-- Alexa.com -->
<div style='display: none;'>
    <a href="http://www.alexa.com/siteinfo/www.futbolecuador.com">
        <script type='text/javascript' src='http://xslt.alexa.com/site_stats/js/t/a?url=www.futbolecuador.com'></script>
    </a> <a href="http://www.alexa.com/siteinfo/www.futbolecuador.com?p=rwidget#reviews"><img
            src='http://www.alexa.com/images/widgets/blue/light/v1-125x60.png'
            alt='Review www.futbolecuador.com on alexa.com'/> </a>
</div>
<!-- FIN Alexa.com -->


</body>
</html>