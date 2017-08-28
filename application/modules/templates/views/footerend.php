<link href="<?php echo base_url('assets/css/fhmm.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
<?php if($verMobile == "0"){ ?>
	<?php 
		//carga de banner 1x1 solo para la version desktio
 		$this->load->module("banners");
 		echo $this->banners->banner_video_der();
		?>
	<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>unionlayer/panini/edge_includes/edge.6.0.0.min.js"></script>
	<style>
    .edgeLoad-EDGE-518637820,.edgeLoad-EDGE-11811655, .edgeLoad-EDGE-11811650, .edgeLoad-EDGE-4146339
    .edgeLoad-EDGE-11811645, .EDGE-61983072, .edgeLoad-EDGE-24483998{ visibility:hidden; }                
     #pbl-coke{margin: 25px auto;position: relative;width: 1341px;height: auto;background-color: transparent !important;}
    .pbl-coke2{position: absolute;top: 120px;left: 264px;width: 60px;height: 15px;background-color: #000;color: #fff;font-size: 12px;padding-left: 10px;}
    .pbl-union, .pbl-union2, .pbl-union3, .pbl_unionajax,
    .pbl-union4, .pbl-union5, .pbl-union6{height: 100%;left: 0;position: fixed;top: 120px;
    	width: 100%;z-index: 100000000;display:none;
    }

    .pbl_unionajax-noticia{
    	height: 100%;left: 0;position: fixed;top: 0;
    	width: 100%;z-index: 100000000;display:none;	
    }
    
    #Stage_arranca, #Stage_cierra{
    display:none !important;
    }

  </style>

<style>
	.contenedor-expandibl{
		margin: 25px auto;
		position: relative;
		width: 800px;
		height: 600px;
	}

	.btn-cerrar-expandible{
		position: absolute;
		right: 45px;
		top: 25px;	
	}
</style>

  <script>
  	AdobeEdge.loadComposition(baseUrl+'unionlayer/kia_marzo/index', 'EDGE-518637820', {
	    scaleToFit: "none",centerStage: "none",minW: "0px",maxW: "undefined",
	    width: "1330px",
	    height: "600px"},
	     {dom: [ ]}, {dom: [ ]});
  </script>
    <div class="pbl-union" >
	   <div id="pbl-coke">
	   	<div id="Stage" class="EDGE-518637820"></div>
	    </div>
	</div>
	<script>
    AdobeEdge.loadComposition(baseUrl+'unionlayer/reto/index', 'EDGE-24483998', {
    scaleToFit: "none",centerStage: "none",minW: "0px",maxW: "undefined",
    width: "1330px",height: "600px"}, {dom: [ ]}, {dom: [ ]});
  </script>
  <div class="pbl-union2" >
	    <div id="pbl-coke">
	    	<div id="Stage" class="EDGE-24483998"></div>    	
	    </div>
	</div>
	<script>
	    AdobeEdge.loadComposition(baseUrl+'unionlayer/patio_tuerca/uno/centro_new', 'EDGE-11811645', {
	    scaleToFit: "none",centerStage: "none",minW: "0px",maxW: "undefined",width: "1330px",height: "600px"}, {dom: [ ]}, {dom: [ ]});	
    </script>
	  <div class="pbl-union4" >
	    <div id="pbl-coke">
	    	<div id="Stage" class="EDGE-11811645"></div>
	    </div>
	</div>
	<script>
	    AdobeEdge.loadComposition(baseUrl+'unionlayer/patio_tuerca/promo/centro_new', 'EDGE-11811615', {
	    scaleToFit: "none",centerStage: "none",minW: "0px",maxW: "undefined",width: "1330px",height: "600px"}, {dom: [ ]}, {dom: [ ]});	
    </script>
	  <div class="pbl-union5" >
	    <div id="pbl-coke">
	    	<div id="Stage" class="EDGE-11811615"></div>
	    </div>
	</div>
	<script>
	    AdobeEdge.loadComposition(baseUrl+'unionlayer/kia/kia', 'EDGE-61983072', {
	    scaleToFit: "none",centerStage: "none",minW: "0px",maxW: "undefined",width: "1330px",height: "600px"}, {dom: [ ]}, {dom: [ ]});	
    </script>
	<div class="pbl-union6" >
	    <div id="pbl-coke">
	    	<div id="Stage" class="EDGE-61983072"></div>
	    </div>
	</div>
		
	<div class="pbl_unionajax"></div>
	<div class="pbl_unionajax-noticia"></div>

	<div class="pbl-union3" >
	<div id="pbl-coke">
		<div id='div-gpt-ad-1464046739579-0' style='height: 600px;width: 800px;position: absolute;top: 0;left: 264px;'>
		<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1464046739579-0'); });
		</script>
		</div>
	<div style="position: absolute;	top: 0;	right: 274px;width: 64px;height: 15px;background-color: #000;color: #fff;font-size: 12px;
		text-align: center;cursor: pointer;" onclick="cerrarPblgeneral()">
		Cerrar
	</div>
	</div>
	</div>
			
	<script type="text/javascript">
	function cerrarPblgeneral(){
		$('.pbl_unionajax').hide();
		$('.pbl_unionajax').html("");
		$('.pbl-union').fadeOut();
		$('.pbl-union2').fadeOut();
		$('.pbl-union3').fadeOut();
		$('.pbl-union4').fadeOut();
		$('.pbl-union5').fadeOut();
		$('.pbl-union6').fadeOut();
		$(".EDGE-61983072").css("visibility","hidden");
		$('#div-gpt-ad-1450734059657-0').show();
		$('#div-gpt-ad-1450734059657-1').show();		
	}
	
	function activarPbl(){
		$("#div-gpt-ad-1450734059657-0").hide();
		$("#div-gpt-ad-1450734059657-1").hide();
		$(".pbl-union").fadeIn();
		$(".pbl-union3").fadeIn();
		$("#Stage_arranca").click();
		$(".EDGE-518637820").css("visibility","visible");
	}
	function activarPbl2(){
		$("#div-gpt-ad-1450734059657-0").hide();
		$("#div-gpt-ad-1450734059657-1").hide();		
		$(".pbl-union2").fadeIn();
		$(".pbl-union3").fadeIn();
		$("#Stage_boton_galaxy").click();
	}	
	/*patioTuerca1*/
	function activarPbl3(){
		$("#div-gpt-ad-1450734059657-0").hide();
		$("#div-gpt-ad-1450734059657-1").hide();
		$(".pbl-union4").fadeIn();
		$(".pbl-union3").fadeIn();
		$("#Stage_start_patiotuercav2").click();
	}

	/*patioTuerca2*/
	function activarPbl4(){
		$("#div-gpt-ad-1450734059657-0").hide();
		$("#div-gpt-ad-1450734059657-1").hide();
		$(".pbl-union5").fadeIn();
		$(".pbl-union3").fadeIn();
		$("#Stage_start_patiotuercapromo").click();
	}
	/*kia*/
	function activarPbl5(){
		$("#div-gpt-ad-1450734059657-0").hide();
		$("#div-gpt-ad-1450734059657-1").hide();
		$(".EDGE-61983072").css("visibility","visible");
		$(".pbl-union6").fadeIn();
		$(".pbl-union3").fadeIn();
		$("#Stage_start_kia").click();
	}

/*carga de union layer con ajax*/
	function activarUnionlayer(){
		$(".pbl_unionajax").load("<?php echo base_url('/banners/fe_union')?>");
		$("#div-gpt-ad-1450734059657-0").hide();
		$("#div-gpt-ad-1450734059657-1").hide();
		$(".pbl_unionajax").fadeIn();
		$(".pbl-union3").fadeIn();
	}

	function activarUnionlayerS8(){
		/*$(".pbl_unionajax").load("http://www.futbolecuador.com/unionlayer/samsung8/index.html");*/
		$(".pbl_unionajax").load("<?php echo base_url('')?>banners/fe_union2");
		$("#div-gpt-ad-1450734059657-0").hide();
		$("#div-gpt-ad-1450734059657-1").hide();
		$(".pbl_unionajax").fadeIn();
		$(".pbl-union3").fadeIn();
	}

	function activarUnionlayerKia(){
		$(".pbl_unionajax").load("<?php echo base_url('')?>banners/fe_union3");
		$("#div-gpt-ad-1450734059657-0").hide();
		$("#div-gpt-ad-1450734059657-1").hide();
		$(".pbl_unionajax").fadeIn();
		$(".pbl-union3").fadeIn();
	}

	function activarUnionlayerKiaSport(){
		$(".pbl_unionajax").load("<?php echo base_url('')?>banners/fe_union4");
		$("#div-gpt-ad-1450734059657-0").hide();
		$("#div-gpt-ad-1450734059657-1").hide();
		$(".pbl_unionajax").fadeIn();
		$(".pbl-union3").fadeIn();
	}

	function unionlayerFord(){
		$(".pbl_unionajax").load("<?php echo base_url('')?>banners/fe_union_ford");
		$("#div-gpt-ad-1450734059657-0").hide();
		$("#div-gpt-ad-1450734059657-1").hide();
		$(".pbl_unionajax").fadeIn();
		$(".pbl-union3").fadeIn();
	}

	function unionlayerSony(){
		$(".pbl_unionajax").load("<?php echo base_url()?>banners/fe_sony");
		$("#div-gpt-ad-1450734059657-0").hide();
		$("#div-gpt-ad-1450734059657-1").hide();
		$(".pbl_unionajax").fadeIn();
		$(".pbl-union3").fadeIn();
	}

	function unionlayerCoke(){
		$(".pbl_unionajax-noticia").html("");
		var contenidoIframe = "<div id='pbl-coke'><iframe class='contenedor-video' width='800' height='600' src='http://www.futbolecuador.com/unionlayer/noticia-expandible/coca/expandido/index.html' scrolling='no'></iframe><div class='btn-cerrar-expandible'>Cerrar</div></div>	";
		$(".pbl_unionajax-noticia").html(contenidoIframe);
		$(".pbl_unionajax-noticia").fadeIn();
	}
</script>	
<?php }?>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-hover-dropdown.js') ?>"></script>
<script defer src="<?php echo base_url('assets/js/jquery.flexslider-min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/fitdivs.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/scripts.js?a=20') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/notificacion.js') ?>"></script>

<!-- <script type="text/javascript" src="<?php echo base_url('assets/js/psw.js') ?>"></script>-->

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.lightbox.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/slider.min.js') ?>"></script>
	
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

if (isset($fe_scritp_footer)){
    echo $fe_scritp_footer;
}?>
<!-- Taboola  tracking add 20151023-->
<script type="text/javascript">
    window._taboola = window._taboola || [];
    _taboola.push({flush: true});
</script>
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script>
<script type="text/javascript">_atrk_opts = {atrk_acct: "A9Dnf1aUOO00Gi", domain: "futbolecuador.com"};
    atrk();
</script>
<noscript>
    <img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=A9Dnf1aUOO00Gi" style="display: none" height="1"
         width="1" alt=""/>
</noscript>
<!-- End Alexa Certify Javascript -->
<!-- Alexa.com -->
<div style='display: none;'>
    <a href="http://www.alexa.com/siteinfo/www.futbolecuador.com">
        <script type='text/javascript' src='http://xslt.alexa.com/site_stats/js/t/a?url=www.futbolecuador.com'></script>
    </a>
    <a href="http://www.alexa.com/siteinfo/www.futbolecuador.com?p=rwidget#reviews">
	<img
            src='http://www.alexa.com/images/widgets/blue/light/v1-125x60.png'
            alt='Review www.futbolecuador.com on alexa.com'/> 
    </a>
    <a href="http://www.alexa.com/siteinfo/www.futbolecuador.com">
	<script type='text/javascript' src='http://xslt.alexa.com/site_stats/js/s/a?url=www.futbolecuador.com'></script>
    </a>
</div>


<!-- FIN Alexa.com -->
<?php 
	if($verMobile == "1"){ ?>	
	<script>
	$.smartbanner({
		  title: "Futbolecuador.com", // What the title of the app should be in the banner (defaults to <title>)
		  author: "futbolecuador.com", // What the author of the app should be in the banner (defaults to <meta name="author"> or hostname)
		  price: 'Gratis', // Price of the app
		  appStoreLanguage: 'us', // Language code for App Store
		  inAppStore: 'En App Store', // Text of price for iOS
		  inGooglePlay: 'En Google Play', // Text of price for Android
		  inAmazonAppStore: 'In the Amazon Appstore',
		  inWindowsStore: null, // Text of price for Windows
		  GooglePlayParams: null, // Aditional parameters for the market
		  icon: "http://www.futbolecuador.com/imagenes/app/app-futbolecuador.png", // The URL of the icon (defaults to <meta name="apple-touch-icon">)
		  iconGloss: null, // Force gloss effect for iOS even for precomposed
		  url: null, // The URL for the button. Keep null if you want the button to link to the app store.
		  button: 'Instalar', // Text for the install button
		  scale: 'auto', // Scale based on viewport size (set to 1 to disable)
		  speedIn: 300, // Show animation speed of the banner
		  speedOut: 400, // Close animation speed of the banner
		  daysHidden: 4, // Duration to hide the banner after being closed (0 = always show banner)
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
<?php }else{ ?>
	<script>
	setTimeout(function () {
		    cargarSplash();
	}, 4000);
	setTimeout(function(){    	
		verificarInstlacion();
	    }, 3000);



    // Pushwoosh.com Safari push notifications.
    // Ensure that the user can receive Safari Push Notifications.
    var APP_CODE = '0E44F-5F59B';          // Your Pushwoosh application code from the Control Panel
    var WEB_SITE_PUSH_ID = 'web.futbolecuador.pushwoosh.2015';        // Your unique reverse-domain Website Push ID from the Developer Center, starts with "web."
    var pushwooshUrl = 'https://cp.pushwoosh.com/json/1.3/';
    var checkRemotePermission = function (permissionData) {
        console.log(permissionData);
        if (permissionData.permission === 'default') {
            console.log('This is a new web service URL and its validity is unknown.');
            window.safari.pushNotification.requestPermission(
                pushwooshUrl + 'safari',
                WEB_SITE_PUSH_ID,
                { application: APP_CODE },
                checkRemotePermission    // The callback function.
            );
        } else if (permissionData.permission === 'denied') {
            console.log('The user said no.');
        } else if (permissionData.permission === 'granted') {
            console.log('The web service URL is a valid push provider, and the user said yes.');
            console.log('You deviceToken is ' + permissionData.deviceToken);
            // setTags call
            //var tags = {"Alias": "SafariValue", "FavNumber": "98"};
            //pushwooshSetTags(permissionData.deviceToken, tags);
        }
    };

    window.onload = function(){
        if ('safari' in window && 'pushNotification' in window.safari) {
            var permissionData = window.safari.pushNotification.permission(WEB_SITE_PUSH_ID);
            checkRemotePermission(permissionData);
        } else {
            console.log('Push Notifications are available for Safari browser only');
        }

        try {
            if (navigator.userAgent.indexOf('Safari') > -1) {
                var hashReg = /#P(.*)/,
                    hash = decodeURIComponent(document.location.hash);

                if ('safari' in window && 'pushNotification' in window.safari) {
                    var permissionData = window.safari.pushNotification.permission(WEB_SITE_PUSH_ID);
                }

                if (hashReg.test(hash) && permissionData) {
                    var xhr = new XMLHttpRequest(),
                        url = pushwooshUrl + 'pushStat',
                        params = {
                            "request":{
                                "application": APP_CODE,
                                "hwid": permissionData.deviceToken,
                                "hash": hashReg.exec(hash)[1]
                            }
                        };

                    xhr.open('POST', url, true);
                    xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
                    xhr.send(JSON.stringify(params));
                }
            }
        } catch(e) { }
    };

    function pushwooshSetTags(hwid, tags) {
        console.log('Sending setTags call to Pushwoosh');
        try {
            var xhr = new XMLHttpRequest(),
                url = pushwooshUrl + 'setTags',
                params = {
                    request:{
                        application: APP_CODE,
                        hwid: hwid,
                        tags: tags
                    }
                };

            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
            xhr.send(JSON.stringify(params));
            xhr.onload = function() {
                if(this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    if (response.status_code == 200) { console.log('Set tags method were successfully sent to Pushwoosh'); }
                    else { console.log('Error occurred while sending setTags to Pushwoosh: ' + response.status_message); }
                } else {
                    console.log('Error occurred, status code::' + this.status);
                }
            };
            xhr.onerror = function(){ console.log('Pushwoosh response status code to pushStat call in not 200'); };
        } catch(e) {
            console.log('Exception while sending setTags to Pushwoosh: ' + e);
            return;
        }
    }



	</script>
<?php } ?>


</body>
</html>




