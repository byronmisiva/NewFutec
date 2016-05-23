<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>coke/edge_includes/edge.6.0.0.min.js"></script>
    <style>
        .edgeLoad-EDGE-28231535 { visibility:hidden; }
        
        #pbl-coke{
        margin: 160px auto;
    	position: relative;
	    width: 1341px;
	    height: auto;
	    background-color: transparent !important;
        }
        
        .pbl-union{
	        height: 100%;left: 0;position: fixed;top: 0;
	    	width: 100%;
	    	z-index: 100000000;display:none;
        }
    </style>
    <script>
    AdobeEdge.loadComposition(baseUrl+'coke/union_layer', 'EDGE-28231535', {
	    scaleToFit: "none",
	    centerStage: "none",
	    minW: "0px",
	    maxW: "undefined",
	    width: "1330px",
	    height: "600px"
	}, {dom: [ ]}, {dom: [ ]});	
    </script>
<div class="pbl-union" >
    <div id="pbl-coke">
    	<div id="Stage" class="EDGE-28231535"></div>
    </div>
</div>
<script type="text/javascript">
function activarPbl(){
	$("#div-gpt-ad-1450734059657-0").hide();
	$("#div-gpt-ad-1450734059657-1").hide();
	$(".pbl-union").fadeIn();
	
	$(".Stage_boton_abre_id").click();	
}	
</script>



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