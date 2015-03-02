<!--Pagina desarrollada por Misiva
Contacto: info@misiva.com.ec
Web:	http://www.misiva.com.ec
-->
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Cache-Control" content="public" />
	<title><?=$title?></title><!-- futbolecuador movil -->
	<meta name="viewport" content="width = device-width, user_scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.6">
	<meta property="fb:app_id" content="95479719010" />
	<meta property="fb:page_id" content="203874640067" />
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>css/movil.css?refresh=2345678" />
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>css/add2home.css" />
	<link href='http://fonts.googleapis.com/css?family=Cabin+Condensed' rel='stylesheet' type='text/css'>
	<link href="//fonts.googleapis.com/css?family=Aldrich:400" rel="stylesheet" type="text/css">
	<LINK REL="SHORTCUT ICON" href="<?=base_url().'imagenes/template/movil/apple-touch-icon.png'?>">
	<link rel="apple-touch-icon" href="<?=base_url().'imagenes/template/movil/apple-touch-icon.png'?>"/>

    <link type="text/css" rel="stylesheet" href="<?=base_url()?>css/fueradejuego/fueradejuego.css" />
    
	<script type="text/javascript" src="http://w.sharethis.com/button/sharethis.js#publisher=5b09f5b3-4082-4d3d-8cc2-5718f48eaf1b&amp;type=website&amp;popup=true&amp;buttonText=Compartir%20Noticia&amp;button=false&onmouseover=false"></script>
	<style type="text/css">
	body {font-family:helvetica,sans-serif;font-size:12px;}
	a.stbar.chicklet img {border:0;height:16px;width:16px;margin-right:3px;vertical-align:middle;}
	a.stbar.chicklet {height:16px;line-height:16px;}
	th, td { padding: 0px; }

.introFE{
		background-image: url('<?php echo base_url().'imagenes/introFEmagazine/fondo.jpg'?>');
		background-size:100% 100%;
		width: 100%;
		height: 100%;
		position: absolute;
		left: 0;
		top:0;
	}

	.redireccionFE{
		 background-color: rgba(0, 0, 0, 0.7);
	    float: right;
	    height: auto;
	    margin-top: 35px;
	    padding-left: 10px;
	    padding-right: 10px;
	    padding-top: 5px;
	    width: 55%;
	}
	.redireccionFE p{
		  font-size: 13px;	   	  font-family:helvetica,sans-serif;
	      color:	      cursor: pointer;
	}
: point
	.deviceFE{
iceFE{
		background-image: url('<?php echo base_url().'imagenes/introFEmagazine/dispositivos.png'?>');
		background-repeat: no-repeat;
	   	background-size: 100% auto;
	    float: left;
	    height: 280px;
	    margin-left: 20%;
	    margin-top: 18%;
	    width: 60%;

}

	.mensajeFE{
		 float: left;
	    height: 50px;
	    margin-left: 10%;
	    margin-top: 10px;
	    text-align: center;
	    width: 80%;
	}

	.mensajeFE p{
		 color: #fff;
	    font-family: "Aldrich";
	    font-size: 18px;
	    font-style: normal;
	    font-weight: 400;
	    height: auto;
	    left: 10%;
	    width: 100%;
	    margin-top: 5px;
	}

	.contenedor-btn-FE{
		 float: left;
		    height: 65px;
		    margin-left: 5%;
		    margin-top: 5px;
		    width: 90%;
	}
	.itunesFE{
		float:left;
		background-image: url('<?php echo base_url().'imagenes/introFEmagazine/appstore.png'?>');
		background-size:100% auto;
		background-repeat: no-repeat;
		width: 156px;
		height: 56px;
		margin-left:;
		margin-right: 2%;
		cursor: pointer;

	}
	.googleFE{
		background-image: url('<?php echo base_url().'imagenes/introFEmagazine/google-play.png'?>');
		background-size:100% auto;
		background-repeat: no-repeat;
		width: 156px;
		height: 56px;
		float:left;
		cursor: pointer;
	}

	@media screen and (max-device-width: 320px) {
		.redireccionFE {
	    	 background-color: rgba(0, 0, 0, 0.7);
		    float: right;
		    height: auto;
		    margin-top: 10px;
		    padding-left: 10px;
		    padding-right: 10px;
		    padding-top: 0;
		    width: 67%;
		}

		.deviceFE {
			float: left;
		    height: 200px;
		    margin-left: 26%;
		    margin-top: 45px;
		    width: 48%;
		}

		.mensajeFE {
		    float: left;
		    height: auto;
		    margin-left: 5%;
		    margin-top: 0;
		    text-align: center;
		    width: 90%;
		}

		.mensajeFE p {
		      color: #fff;
			    font-family: "Aldrich";
			    font-size: 16px;
			    font-style: normal;
			    font-weight: 400;
			    height: auto;
			    left: 10%;
			    margin-bottom: 5px;
			    margin-top: 5px;
			    width: 100%;
		}

		.contenedor-btn-FE {
		  margin-top: 10px;
		    width: 100%;
		}


		.itunesFE {
		     height: 55px;
		    margin-left: 20px;
		    margin-right: 2%;
		    width: 130px;
		}

		.googleFE {
		     height: 50px;
    			width: 130px;
		}
	}

	@media screen and (max-device-width: 300px) {
		.redireccionFE {
	    	background-color: rgba(0, 0, 0, 0.7);
		    float: right;
		    height: auto;
		    margin-top: 10px;
		    padding-left: 10px;
		    padding-right: 10px;
		    padding-top: 0;
		    width: 67%;
		}

		.deviceFE {
		     float: left;
		    height: 190px;
		    margin-left: 25%;
		    margin-top: 25px;
		    width: 50%;
		}

		.mensajeFE {
		    float: left;
    			height: auto;
		    margin-left: 5%;
		    margin-top: 0;
		    text-align: center;
		    width: 90%;
		}

		.mensajeFE p {
		    color: #fff;
		    font-family: "Aldrich";
		    font-size: 16px;
		    font-style: normal;
		    font-weight: 400;
		    height: auto;
		    left: 10%;
		    margin-bottom: 5px;
		    margin-top: 5px;
		    width: 100%;
		}

		.contenedor-btn-FE {
	 		margin-left: 2%;
		    	margin-top: 10px;
		    	width: 100%;
		}


		.itunesFE {
		     height: 55px;
		    margin-left: 1%;
		    margin-right: 2%;
		    width: 130px;
		}

		.googleFE {
		    height: 50px;
    		width: 130px;
		}
	}
	
	.fondo-directv{
		background-image: url('imagenes/moviles/directv-back-izq.gif'), url('imagenes/moviles/directv-back-der.gif');
		background-repeat: repeat-x;
		background-position: top left, top right;
		width: 100%;
		height:50px;
	}
	</style>
	<script type="text/javascript">
		var addToHomeConfig = {
			animationIn: 'bubble',
			animationOut: 'drop',
			lifespan:10000,
			expire:2,
			touchIcon:true,
			message:'Guarda esta aplicación en tu móvil. Da click en la fecha y selecciona `Añadir a la pantalla de inicio`.'
		};
	</script>
	<script type="application/javascript" src="<?=base_url()?>js/add2home.js?v1"></script>
	<script src="http://www.google.com/jsapi"></script>
	<script>
	  // Load Prototype
	  google.load("prototype", "1.7.0.0");
	</script>
	
	<script>
		function cambioIntro(){	
			$('introFE').hide();
			$('movil').show();	
			cargarSplash();					
		}
	</script>

	<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-52540767-1', 'auto');
		  ga('send', 'pageview');
	</script>
	<script type='text/javascript'>
		(function() {
		var useSSL = 'https:' == document.location.protocol;
		var src = (useSSL ? 'https:' : 'http:') +
		'//www.googletagservices.com/tag/js/gpt.js';
		document.write('<scr' + 'ipt src="' + src + '"></scr' + 'ipt>');
		})();
	</script>
	
	<script type='text/javascript'>
		googletag.defineSlot('/1022247/FE_HEADER', [320, 80], 'div-gpt-ad-1383593619381-0').addService(googletag.pubads());
		googletag.defineSlot('/1022247/FE_LOADING_MOVIL', [320, 350], 'div-gpt-ad-1383593884981-1').addService(googletag.pubads())
		googletag.defineSlot('/1022247/FE_SMART_BOTTOM', [320, 50], 'div-gpt-ad-1383593619381-2').addService(googletag.pubads());
		googletag.defineSlot('/1022247/FE_SMART_MIDDLE', [320, 50], 'div-gpt-ad-1383593619381-3').addService(googletag.pubads());
		googletag.defineSlot('/1022247/FE_SMART_TOP', [320, 50], 'div-gpt-ad-1383593619381-4').addService(googletag.pubads());
		googletag.pubads().enableSingleRequest();
		googletag.pubads().enableSyncRendering();
		googletag.pubads().collapseEmptyDivs(true);
		googletag.enableServices();
	</script>

	<script type="text/javascript" src="<?=base_url();?>js/public_movil_ajax.js?refresh=98765"></script>
	
	<script src='http://Q1MediaHydraPlatform.com/ads/video/unit_desktop_slider.php?eid=47905'></script>
</head>
<body>
<!-- Google Tag Manager -->
<noscript>
	<iframe src="//www.googletagmanager.com/ns.html?id=GTM-53XBQP"
		          height="0" width="0" style="display:none;visibility:hidden">
	</iframe>
</noscript>
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	    })(window,document,'script','dataLayer','GTM-53XBQP');
	</script>
<!-- End Google Tag Manager -->
<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=95479719010";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	</script>

<!-- Start Alexa Certify Javascript -->
<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script><script type="text/javascript">_atrk_opts = { atrk_acct: "A9Dnf1aUOO00Gi", domain:"futbolecuador.com"}; atrk ();</script><noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=A9Dnf1aUOO00Gi" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->

<?php $sw_aviso=1;?>
<? $idParametro = $this->uri->segment(2);
	$sw_aviso_oculta = 0;
 	if($sw_aviso==1){ 
 		
		if ($idParametro == "movil") { 
			$sw_aviso_oculta = 1; ?>

		<div class="introFE" id="introFE">
			<div class="redireccionFE">
				<p id="cambioSitio" onclick="cambioIntro();">Entra a www.futbolecuador.com</p>
			</div>
			<div class="deviceFE"></div>
			<div class="mensajeFE">	
				<p>Descárgate la última edición de Futbolecuador Magazine</p>
			</div>
			<div class="contenedor-btn-FE">	
				<div  onclick="ga('send', 'event', 'btnItunes','click','smartphone');">
					<a href="http://goo.gl/76UWV" target='_blank' onclick="ga('send', 'event', 'btnItunes','click','smartphone');">
						<div class="itunesFE"></div>
					</a>
				</div>	
				<div onclick="ga('send', 'event', 'btnGooglep','click','smartphone');" onclick="ga('send', 'event', 'btnGooglep','click','smartphone');">
					<a href="http://goo.gl/jhlPq" target='_blank'> 
						<div class="googleFE"></div>
					</a>
				</div>
				
			</div>
		</div>
	<? }
	} 
 ?>
<div id="movil" style="<?php echo  ($sw_aviso_oculta == 1)?'display:none;':'';?>"_>
	<table style="background-color:#FFFFFF;width:100%;border-collapse:collapse; border-spacing: 0;">
	  	<tr>
			<td style='background-image: url("../../imagenes/moviles/corte-back.gif");background-repeat: repeat-x;text-align: center;'>
			<?php if($this->uri->segment(2)!="read"){?>
				<!-- FE_HEADER -->
				<div id='div-gpt-ad-1383593619381-0' style='width:320px; height:80px;margin:0 auto;'>
					<script type='text/javascript'>
						googletag.cmd.push(function() { googletag.display('div-gpt-ad-1383593619381-0'); });
					</script>
				</div>
				<?php }?>
			</td>
		</tr>
	  	
	  	<tr>
			<td style='background-color:#000;'>
				<?=$logo?>
			</td>
		</tr>
		<tr>
			<td>
				<?=$button1?>
			</td>
		</tr>
		<tr>
			<td style='background-color:#06618D;'>
				<?=$title1?>
			</td>
		</tr>

		<tr>
			<td>
				<?=$info1?>
			</td>
		</tr>

		<tr>
			<td>
				<?=$button2?>
			</td>
		</tr>
		<tr>
			<td >
				<!-- FE_SMART_MIDDLE -->
				<!-- <div id='div-gpt-ad-1383593619381-3' style='width:320px; height:50px;margin:0 auto;'>
				<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1383593619381-3'); });
				</script>
				</div -->
			</td>
		</tr>
		<tr>
			<td style='background-color:#06618D;'>
				<?=$title2?>
			</td>
		</tr>	
		<tr>
			<td>
				<?=$info2?>

			</td>
		</tr>
        <tr>
            <td style='background-color:#06618D;'>
                <?=$title3?>
            </td>
        </tr>
		<tr>
			<td>
				<?=$info3?>

			</td>
		</tr>
		<tr>
			<td >
				<!-- FE_SMART_BOTTOM -->
				<div id='div-gpt-ad-1383593619381-2' style='width:320px; height:auto;margin:0 auto;'>
					<script type='text/javascript'>
						googletag.cmd.push(function() { googletag.display('div-gpt-ad-1383593619381-2'); });
					</script>
				</div>	
			</td>
		</tr>
		<tr>
			<td style='background-color:#000000;'>
				<?=$button3?>
			</td>
		</tr>
	
	</table> 
</div>
	<div style='display:none;'>
		<a href="http://www.alexa.com/siteinfo/www.futbolecuador.com"><script type='text/javascript' src='http://xslt.alexa.com/site_stats/js/t/a?url=www.futbolecuador.com'></script></a>
		<a href="http://www.alexa.com/siteinfo/www.futbolecuador.com?p=rwidget#reviews" ><img src='http://www.alexa.com/images/widgets/blue/light/v1-125x60.png' alt='Review www.futbolecuador.com on alexa.com' /></a>
	</div>
<? $idParametro = $this->uri->segment(2);
if ($idParametro == "movil") {
    ?>
 
		<div id="darkLayer" style="display:none;"></div>
		<div id="FE_LOADING" style="display:none;">
			<!-- FE_LOADING_MOVIL -->
			<div id='div-gpt-ad-1383593884981-1' style='width:320px;height:350px;'>
				<script type='text/javascript'>
				googletag.display('div-gpt-ad-1383593884981-1');
				</script>
			</div>
	
			<div id='closeBanner' onclick='cleanBlackLayer();'>
				<img src='<?=base_url()?>imagenes/template/public/close_banner.png' width='81' height='15' />	
			</div>
		</div>
<? } ?>
</body>
</html>
