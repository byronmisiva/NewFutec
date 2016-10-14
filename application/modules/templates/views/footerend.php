<style>
.bannerNoticiaGrande{
	position: relative;
    width: 700px;
    height: 500px;
    margin: 8% auto;
    background-color: transparent !important;
    padding: 10px;
}

.bannerMini{
	position: fixed;
    bottom: 0;
    width: 100%;
    display: none;
    z-index: 10000;
    height: 90px;
    background-color: #11314b;
}

.bannerMayor{
	position:fixed;top: 0;
	left:0;width: 100%;height:100%;
	display:none;
	background-color: rgba(0,0,0,0.8);
	z-index: 10000;
	ccursor:pointer;
}

</style>

<div class="bannerMini" >
	<div class="contenedorNoticiapeque"></div>
</div>


<div class="bannerMayor" onclick="$('.bannerMayor').hide(); window.localStorage['estadoVisita'] =  parseInt( window.localStorage['estadoVisita']) + 1 ;">
	<div class="bannerNoticiaGrande"></div>
</div>

<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>unionlayer/pichincha/edge_includes/edge.6.0.0.min.js"></script>
    <style>
        .edgeLoad-EDGE-28231535 { visibility:hidden; }        
        #pbl-coke{        margin: 160px auto;position: relative;width: 1341px;height: auto;background-color: transparent !important;}
        .pbl-union{height: 100%;left: 0;position: fixed;top: 0;width: 100%;z-index: 100000000;display:none;}
    </style>
    <script>
    AdobeEdge.loadComposition(baseUrl+'unionlayer/pichincha/union_layer', 'EDGE-28231535', {
	    scaleToFit: "none",centerStage: "none",minW: "0px",maxW: "undefined",width: "1330px",height: "600px"}, {dom: [ ]}, {dom: [ ]});	
    </script>
<div class="pbl-union" >
    <div id="pbl-coke">
    	<div id="Stage" class="EDGE-28231535"></div>
    	<!-- /1022247/FE_NEW_UNIONLAYER -->
		<div id='div-gpt-ad-1464046739579-0' style='height: 600px;width: 800px;position: absolute;top: 0;left: 264px;'>
			<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1464046739579-0'); });
			</script>
		</div>
    </div>
</div>
<script type="text/javascript"> 
function activarPbl(){
	$("#div-gpt-ad-1450734059657-0").hide();
	$("#div-gpt-ad-1450734059657-1").hide();
	$(".pbl-union").fadeIn();
	$(".Stage_boton_abre_id").click();	
    setTimeout(function(){    	
        document.getElementById('Stage_contenedor_Rectangle').appendChild(div);
    }, 1500);
}	

<?php  if(($this->uri->segment(1) == "site") && ($this->uri->segment(2) == "noticia")){ ?>
	$(".body-principal").attr('onMouseMove','verificarLocalStorage()');
	var anchoTotal = screen.width;
<?php }?>

if( window.localStorage['estadoVisita'] != null) {	
    window.localStorage['estadoVisita'] =  parseInt( window.localStorage['estadoVisita']) + 1 ;
}else{
	window.localStorage['estadoVisita'] = 0;
}
	    
</script>
<!-- Bootstrap core JavaScript-->

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

	<script src="<?= base_url() ?>assets/js/jquery.easing.js"></script>
	<script src="<?= base_url() ?>assets/js/jquery.liquid-slider.min.js"></script>
	<script src="<?= base_url() ?>assets/js/jquery.touchSwipe.min.js"></script>
	<!-- Third, add the GalleryView Javascript and CSS files -->
	<script type="text/javascript" src="<?= base_url() ?>assets/js/jcarousellite_1.0.1.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.lazyload.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-scrollto.js"></script>	

	<?php 
		if($verMobile == "1"){ ?>
			<!-- <script src="<?php echo base_url('assets/js/smartbanner/jquery.smartbanner.js') ?>"></script>-->
			<script src="<?php echo base_url('assets/js/jquery.smartbanner.js') ?>"></script>
	<?php }?>


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
if (isset($fe_scritp_footer)){
echo "<!-- <div>Hola Jairo </div>-->";
    echo $fe_scritp_footer;
}?>

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
<?php 
	if($verMobile == "1"){ ?>	
	<script>
	$.smartbanner({
		  title: "Alertas Futbolecuador", // What the title of the app should be in the banner (defaults to <title>)
		  author: "futbolecuador.com", // What the author of the app should be in the banner (defaults to <meta name="author"> or hostname)
		  price: 'Gratis', // Price of the app
		  appStoreLanguage: 'us', // Language code for App Store
		  inAppStore: 'En App Store', // Text of price for iOS
		  inGooglePlay: 'En Google Play', // Text of price for Android
		  inAmazonAppStore: 'In the Amazon Appstore',
		  inWindowsStore: null, // Text of price for Windows
		  GooglePlayParams: null, // Aditional parameters for the market
		  icon: "http://www.futbolecuador.com/imagenes/app/icono.png", // The URL of the icon (defaults to <meta name="apple-touch-icon">)
		  iconGloss: null, // Force gloss effect for iOS even for precomposed
		  url: null, // The URL for the button. Keep null if you want the button to link to the app store.
		  button: 'Instalar', // Text for the install button
		  scale: 'auto', // Scale based on viewport size (set to 1 to disable)
		  speedIn: 300, // Show animation speed of the banner
		  speedOut: 400, // Close animation speed of the banner
		  daysHidden: 1, // Duration to hide the banner after being closed (0 = always show banner)
		  daysReminder: 45, // Duration to hide the banner after "VIEW" is clicked *separate from when the close button is clicked* (0 = always show banner)
		  force: null, // Choose 'ios', 'android' or 'windows'. Don't do a browser check, just always show this banner
		  hideOnInstall: false, // Hide the banner after "VIEW" is clicked.
		  layer: false, // Display as overlay layer or slide down the page
		  iOSUniversalApp: true, // If the iOS App is a universal app for both iPad and iPhone, display Smart Banner to iPad users, too.      
		  appendToSelector: '.separador10-xs', //Append the banner to a specific selector
		  onInstall: function() {
		     //alert('Click install');
			  $("#smartbanner").hide();
		  },
		  onClose: function() {
		     //alert('Click close');
			  $("#smartbanner").hide();
		  }
		});


	</script>

<?php }?>

</body>
</html>