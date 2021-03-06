<!DOCTYPE html>
<html lang="es-EC">
<head>
<?php 
  header("Cache-Control: max-age=2592000"); 
?>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="content-language" content="es"/>
    <meta name="robots" content="follow,index,nocache"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <?php $tags = "";
    if (isset($noticia)) {
        foreach ($noticia->tags as $tag) {
            $tags .= $tag->name . ", ";
        }
    }
    ?>

    <meta name="description"
          content="<?php echo (isset($description)) ? strip_tags($description) . "," . $tags : 'Fútbol Ecuador: Lo mejor del fútbol ecuatoriano. Noticias e información sobre campeonato ecuatoriano de fútbol, clubes, jugadores, eliminatorias mundial 2018, copa libertadores.'; ?>"/>
    <meta name="author" content="Misiva Corp"/>
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="<?php echo base_url('assets/img/apple-touch-icon-144-precomposed.png') ?>"/>
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="<?php echo base_url('assets/img/apple-touch-icon-114-precomposed.png') ?>"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="<?php echo base_url('assets/img/apple-touch-icon-72-precomposed.png') ?>"/>
    <link rel="apple-touch-icon-precomposed" href="<?= base_url('assets/img/apple-touch-icon-57-precomposed.png') ?>"/>
   
    <meta name="twitter:widgets:csp" content="on">

    <!--twitter TAGS-->
    <meta name="twitter:card" content="app">

    <meta name="twitter:app:id:iphone" content="1008177383">
    <meta name="twitter:app:id:ipad" content="1008177383">
    <meta name="twitter:app:id:googleplay" content="com.misiva.futbolecuadorpush">
    

    <meta name="twitter:widgets:csp" content="on">
    <meta name="twitter:app:country" content="US">

    <meta name="twitter:description" content="<?php echo (isset($description)) ? $description : 'Fútbol Ecuador: Lo mejor del fútbol ecuatoriano. Noticias e información sobre campeonato ecuatoriano de fútbol, clubes, jugadores, eliminatorias mundial 2018, copa libertadores.'; ?>" />

<!--	<meta name="apple-itunes-app" content="app-id=1131081518, app-argument=//www.futbolecuador.com">-->
	<meta name="apple-itunes-app" content="app-id=1008177383, app-argument=//www.futbolecuador.com">
	<meta name="google-play-app" content="app-id=com.misiva.futbolecuadorpush">

    <!--TAGS com.misiva.futbolecuadorpush 1008177383-->
    <!--TAGS com.futbolecuador.femagazine 622931242-->
    <?php if (isset($noticia))  { ?>
    <?php if ($this->uri->segment('2') != 'noticia')   { ?>
    <?php if ($this->uri->segment('2') != 'equipo')   { ?>
    <link rel=”canonical” href=”<?php  echo base_url('site/noticia') . '/'.$this->story->_urlFriendly( $noticia->subtitle) . '/'. $noticia->id  ; ?>”>

    <?php } ?>
    <?php } ?>
    <?php } ?>

    <script src="//platform.twitter.com/oct.js" type="text/javascript"></script>
    <script type="text/javascript">
        twttr.conversion.trackPid('l4vk1');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none;" alt=""
             src="https://analytics.twitter.com/i/adsct?txn_id=l4vk1&p_id=Twitter"/>
        <img height="1" width="1" style="display:none;" alt="" src="//t.co/i/adsct?txn_id=l4vk1&p_id=Twitter"/>
    </noscript>

    <link rel="apple-touch-icon" sizes="144x144"
          href="<?php echo base_url('assets/img/apple-touch-icon-144-precomposed.png') ?>"/>
    <link rel="apple-touch-icon" sizes="114x114"
          href="<?php echo base_url('assets/img/apple-touch-icon-114-precomposed.png') ?>"/>
    <link rel="apple-touch-icon" sizes="72x72"
          href="<?php echo base_url('assets/img/apple-touch-icon-72-precomposed.png') ?>"/>
    <link rel="apple-touch-icon" href="<?= base_url('assets/img/apple-touch-icon-57-precomposed.png') ?>"/>
    <link rel="icon" href="<?= base_url('assets/img/favicon.ico') ?>">
    <!--Facebook TAGS-->
    
    <meta property='og:title' content="<?php echo $pageTitle ?>"/>
    <meta property="og:description"
          content="<?php echo (isset($description)) ? $description . "," . $tags : 'Futbol Ecuador'; ?>"/>
    <?php if (!isset($og_image)) $og_image = ''; ?>
    <meta property="og:image"
          content="<?php
          if ((isset($image))) {
              echo base_url($image);
          } else {
              if ($og_image=='') {
                  echo base_url('imagenes/coverappalertas.jpg');
              } else {
                  echo $og_image;
              }
          }
          ?>"/>
 
<meta property="fb:admins" content="100000125463918"/>
<meta property="fb:admins" content="1394074937285849"/>
<meta property="fb:pages" content="10154913937591728" />
    <!--SEO TAGS-->
    <meta name="keywords"
          content="<?= $tags ?> futbolecuador, www.futbolecuador.com, futbol ecuador, futbol ecuador lo mejor del futbol ecuatoriano, ecuagol, emelec, futbolecuador, futbol, liga de quito,fef,campeonato ecuatoriano de futbol 2014, futbol ecuatoriano,tabla de posiciones, ldu,Barcelona,radio la red,aucas,campeonato ecuatoriano de futbol,deportivo quito,jefferson montero,la red,club deportivo el nacional,deportes ecuador,deportivo cuenca,antonio valencia,ecuador futbol,futbol de ecuador,futbolecuador.com, campeonato ecuatoriano de futbol 2014 serie b,futbol ecuador en vivo,joao rojas,fut,seleccion de ecuador , ecuatorianos en el exterior"/>
    <meta name="news_keywords" content="futbol, ecuador,  <?= $tags ?> ecuatoriano,  noticias">

    <title><?php echo $pageTitle ?></title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/fhmm.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
    <!-- Lightbox stylesheet -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery.lightbox.min.css') ?>"/>
    <!-- Input slider -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/slider.css') ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/flexslider.css'); ?>" type="text/css" media="screen"/>
    
    <!-- habilitar para desarrollar -->
     <!-- <link href="<?php echo base_url() ?>assets/css/style.css?a=3" rel="stylesheet">--> 
    <!-- habilitar para produccion--> 
    <link href="<?php echo base_url() ?>assets/css/style.min.css?a=9" rel="stylesheet">
    
    <link href="<?php echo base_url()?>assets/css/sprites.css?version=9" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/js/smartbanner/jquery.smartbanner.css') ?>" type="text/css"
          media="screen">


    <link href="<?php echo base_url('assets/css/add2home.css') ?>" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Rationale' rel='stylesheet' type='text/css'>
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url('assets/js/ie8-responsive-file-warning.js') ?>"></script><![endif]-->
    <script src="<?php echo base_url('assets/js/ie-emulation-modes-warning.js') ?>"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url('assets/js/ie10-viewport-bug-workaround.js') ?>"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Modernizr -->
    <script src="<?php echo base_url('assets/js/modernizr.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <?php
    if ($verMobile == "1") {
        ?>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <script type="text/javascript" async defer src="https://apis.google.com/js/platform.js?publisherid=109198533032839133083">
        </script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery.smartbanner.css') ?>"/>
    <style>
    #smartbanner {
	    background-image: -moz-linear-gradient(center top , #f4f4f4 0%, #cdcdcd 100%);
	    border-bottom: none;
	    box-shadow: none;
	    font-family: 'Helvetica Neue',sans-serif;
	    height: 85px;
	    left: 0;
	    overflow: hidden;
	    position: relative !important;
	    top: 0;
	    width: 100%;
	}
	
	#smartbanner.android {
		border-top: 5px solid #133751 !important;
	}
	
	#smartbanner.android {
		border-color: #212228;
		background: #ffffff !important;
	}
	
	#smartbanner.android .sb-info strong {
		color: #000;
		font-weight: normal;
	}
	
	#smartbanner.android .sb-info {
		color: #000;
		text-shadow: none;
		}
		
		#smartbanner.android .sb-button span {
		text-align: center;
		display: block;
		padding: 0 10px;
		background-color: #1F344E;
		background-image: -webkit-gradient(linear,0 0,0 100%,from(#1F344E),to(#1F344E));
		background-image: -moz-linear-gradient(top,#1F344E,#1F344E);
		text-transform: none;
		text-shadow: none;
		box-shadow: none;
		}
	
	
    </style>    
    <?php
    } else {
    if ($verMobile == "2") {
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <!--        <meta name="viewport" content="width=990, initial-scale=1, maximum-scale=1"/>-->
        <?php
    } else {
        ?>
    <link rel="chrome-webstore-item"
          href="https://chrome.google.com/webstore/detail/cjkoikfgconobaeikllfnkpnjihcfnil">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <!--        <meta name="viewport" content="width=990, initial-scale=1, maximum-scale=1"/>-->
        <?php
    }
    }
    ?>
    <!-- edge -->
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    
    <script>
        var baseUrl = "<?php echo base_url(); ?>";
        var REFRESH_VIVO = "<?php echo REFRESH_VIVO; ?>";
    </script>
    <!--   script teads  se muestra cuando es noticia abierta-->
	<!-- script sharethis -->
	<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "636c7935-082e-4d18-ac85-13cafa7345da", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
	<!-- fin share this -->
	    <?php 

    //echo $this->uri->segment(1);
    
 	//carga de css auspicion
    if ($this->uri->segment(3) == 63){?>
    	<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/auspicio.min.css') ?>"/>-->
    <?php }elseif(($this->uri->segment(1) == "copa-america") || ($this->uri->segment(2) =="partido")){?>
    	<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/auspicio.min.css') ?>"/>-->
    <?php }?>

<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window,document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '344183585977098');
fbq('track', 'PageView');
</script>
<noscript>
<img height="1" width="1"
src="https://www.facebook.com/tr?id=344183585977098&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->
</head>
<body onload="verificarInstlacion();cargarSplash();">


<script type='text/javascript'>
    var verMobile = <?php echo $verMobile ?>;
    var secondskin;
    var uri = "<?php  echo ($this->uri->segment(2) != "" ) ? $this->uri->segment(2) :"false"; ?>";
</script>

<script type='text/javascript'>
    var googletag = googletag || {};
    googletag.cmd = googletag.cmd || [];
    (function() {
        var gads = document.createElement('script');
        gads.async = true;
        gads.type = 'text/javascript';
        var useSSL = 'https:' == document.location.protocol;
        gads.src = (useSSL ? 'https:' : 'http:') + '//www.googletagservices.com/tag/js/gpt.js';
        var node = document.getElementsByTagName('script')[0];
        node.parentNode.insertBefore(gads, node);
    })();
</script>

<script type='text/javascript'>
    googletag.cmd.push(function () {
	googletag.defineSlot('/1022247/FE_NEW_HYPERBANNER', [980, 50], 'div-gpt-ad-1424964392222-0').addService(googletag.pubads()).setCollapseEmptyDiv(true);
        googletag.defineSlot('/1022247/FE_NEW', [728, 90], 'div-gpt-ad-1413318555463-2').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_NEW_RECTANGLE', [300, 250], 'div-gpt-ad-1413318555463-3').addService(googletag.pubads());
	    googletag.defineSlot('/1022247/FE_NEW_LATERAL_1', [300, 250], 'div-gpt-ad-1413414586192-0').addService(googletag.pubads()).setCollapseEmptyDiv(true);
		googletag.defineSlot('/1022247/FE_NEW_LATERAL_2', [300, 250], 'div-gpt-ad-1413414586192-1').addService(googletag.pubads()).setCollapseEmptyDiv(true);
		googletag.defineSlot('/1022247/FE_NEW_LATERAL_3', [300, 250], 'div-gpt-ad-1413414586192-2').addService(googletag.pubads()).setCollapseEmptyDiv(true);
		googletag.defineSlot('/1022247/FE_NEW_LATERAL_4', [300, 250], 'div-gpt-ad-1413414586192-3').addService(googletag.pubads()).setCollapseEmptyDiv(true);
        googletag.defineSlot('/1022247/FE_NEW_RECTANGLE_1', [300, 250], 'div-gpt-ad-1413414586192-4').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_NEW_RECTANGLE_2', [300, 250], 'div-gpt-ad-1413414586192-5').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_NEW_RECTANGLE_3', [300, 250], 'div-gpt-ad-1413414586192-6').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_NEW_RECTANGLE_4', [300, 250], 'div-gpt-ad-1413414586192-7').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_NEW_RECTANGLE_5', [300, 250], 'div-gpt-ad-1413414586192-8').addService(googletag.pubads());
        //new 2015
        googletag.defineSlot('/1022247/NEW_FE_Video_VAST', [670, 370], 'div-gpt-ad-1457102356654-0').addService(googletag.pubads());
	googletag.defineSlot('/1022247/FE_NEW_FILMSTRIP_BANNER', [300, 600], 'div-gpt-ad-1439997438966-0').addService(googletag.pubads()).setCollapseEmptyDiv(true);
        googletag.defineSlot('/1022247/FE_NEW_UNIONLAYER', [800, 600], 'div-gpt-ad-1464046739579-0').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_NOTICIA_PATROCINADA', [300, 250], 'div-gpt-ad-1465241512633-0').addService(googletag.pubads());
googletag.defineSlot('/1022247/FE_NEW_RECTANGLE_3', [300, 250], 'div-gpt-ad-1466776607930-0').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_SMART_TOP', [320, 50], 'div-gpt-ad-1383593619381-4').addService(googletag.pubads()).setCollapseEmptyDiv(true);        
        googletag.defineSlot('/1022247/FE_SMART_BOTTOM', [320, 50], 'div-gpt-ad-1383593619381-2').addService(googletag.pubads()).setCollapseEmptyDiv(true);
        googletag.defineSlot('/1022247/FE_LOADING', [800, 600], 'div-gpt-ad-1425424774921-0').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_LOADING_MOVIL', [320, 350], 'div-gpt-ad-1383593884981-1').addService(googletag.pubads());
	//2017
	googletag.defineSlot('/1022247/FE_SKYSCRAPER_DE', [160, 600], 'div-gpt-ad-1450734059657-0').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_SKYSCRAPER_IZ', [160, 600], 'div-gpt-ad-1450734059657-1').addService(googletag.pubads());
	googletag.defineSlot('/1022247/Interstitial_Fullscreen_FE-Mobile', [1, 1], 'div-gpt-ad-1489615543513-0').addService(googletag.pubads());
	googletag.defineSlot('/1022247/web_mobile_medio', [320, 50], 'div-gpt-ad-1490653855570-0').addService(googletag.pubads()).setCollapseEmptyDiv(true);
    //2017
    googletag.defineSlot('/1022247/20-Noticia_Expandible', [320, 340], 'div-gpt-ad-1503683104008-0').addService(googletag.pubads());
	googletag.defineSlot('/1022247/netsonic', [1, 1], 'div-gpt-ad-1490820753625-0').addService(googletag.pubads());
	googletag.defineSlot('/1022247/netsonic_Secciones_Solo_USA', [1, 1], 'div-gpt-ad-1490820846662-0').addService(googletag.pubads());
	googletag.defineSlot('/1022247/LatinOn_1x1_USA', [1, 1], 'div-gpt-ad-1499696905612-0').addService(googletag.pubads());
	//teads	
	googletag.defineSlot('/1022247/teads_Home', [1, 1], 'div-gpt-ad-1493409384189-0').addService(googletag.pubads());
	googletag.defineSlot('/1022247/teads_Secciones', [1, 1], 'div-gpt-ad-1493409196824-0').addService(googletag.pubads());    
        //netsonic
        googletag.defineSlot('/25992948/EC_futbolecuador.com_1x1', [1, 1], 'div-gpt-ad-1438988612575-0').addService(googletag.pubads());
        //amazon
        googletag.defineSlot('/1022247/Amazon_associates', [665, 370], 'div-gpt-ad-1445466832316-0').addService(googletag.pubads());
        googletag.pubads().enableSingleRequest();
        googletag.enableServices();
        //para el caso que no existe publicicad --MISIVA--
        googletag.pubads().collapseEmptyDivs(true);
        googletag.pubads().addEventListener('slotRenderEnded', function (event) {
        if (event.slot.i == '/1022247/FE_LOADING') {
            if (event.isEmpty) {
                 cleanBlackLayer();
            } 
            else 
            {
             <?php if ($verMobile != "1"){ ?>
                cargarSplash();
            <?php } ?>
            }
         }

        if (event.slot.i == '/1022247/FE_SKIN') 
        {
           if (event.isEmpty) {
               secondskin = 1;
             } else {
                 secondskin = 2;
              }
        }
        if (event.slot.i == '/1022247/FE_HEADER') {
           if (event.isEmpty) {
                    //ocultamos el div
              document.getElementById("div-gpt-ad-1383593619381-0").style.display = 'none';
              var cols = document.getElementsByClassName('separador10-xs');
              for (i = 0; i < cols.length; i++) {
                if (verMobile == 1)
                  cols[i].style.marginTop = '17px';
                  }
                } else {
                    document.getElementById("div-gpt-ad-1383593619381-0").style.display = 'block';
                }
            }
        });
    });
    </script>

<script type='text/javascript'>
    <?php
    if (isset($mostrarSplash)) {
        if ($mostrarSplash == "1") {
            echo "mostrarSplash = 1;";
                }
        else {
            echo "mostrarSplash = 0;";
    }} else {
     echo "mostrarSplash = 0;";
    }
    ?>  
</script>
<!-- Tag Netsonic-->
<!-- /25992948/EC_futbolecuador.com_1x1 -->
<div id='div-gpt-ad-1438988612575-0' style='height:1px; width:1px;'>
    <script type='text/javascript'>
        googletag.cmd.push(function () {
            googletag.display('div-gpt-ad-1438988612575-0');
        });
    </script>
</div>
<script type='text/javascript' src='http://partner.googleadservices.com/gampad/google_service.js'></script>
<script type='text/javascript'>
    GS_googleAddAdSenseService("ca-pub-2857298972794488");
    GS_googleEnableAllServices();
</script>
<script type='text/javascript'>
    GA_googleAddSlot("ca-pub-2857298972794488", "FE_HP_1");   
    ////GA_googleAddSlot("ca-pub-2857298972794488", "FE_NEW_HYPERBANNER");
</script>
<script type='text/javascript'>
    GA_googleFetchAds();
</script>
<!-- Google Tag Manager -->
<noscript>
    <iframe src="//www.googletagmanager.com/ns.html?id=GTM-53XBQP"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<script>(function (w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            'gtm.start': new Date().getTime(), event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
            '//www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-53XBQP');

	function ejecucionEvento(){
		ga('create', 'UA-2423727-1', 'auto');
		ga('send', 'event', 'Celtra','impresion','yaesta');
	}
</script>
<!-- End Google Tag Manager -->


<div id="darkLayerFE" style="display:none;"></div>
<?php if ($verMobile == "1") {?>
	<div id="FE_LOADINGFE" style="display:none;">
    <!-- Gestion revistaFE -->
    <div class='closeBanner' onclick='cleanBlackLayer();'>
        <img src='<?= base_url() ?>assets/img/close_banner.png'
             width='81' height='20'/>
    </div>
    <div class="introFE" id="introFE">
        <div class="redireccionFE">
            <p id="cambioSitio">Entra a www.futbolecuador.com</p>
        </div>
        <div class="deviceFE"></div>
        <div class="mensajeFE">
            <p>Descárgate la última edición de Fútbolecuador Magazine</p>
        </div>
        <div class="contenedor-btn-FE">
            <a href="http://goo.gl/76UWV" target='_blank'>
                <div class="itunesFE" id="itunesFE"></div>
            </a>
            <a href="http://goo.gl/jhlPq" target='_blank' );>
                <div class="googleFE" id="googleFE"></div>
            </a>
        </div>
    </div>
</div>
<?php }?>