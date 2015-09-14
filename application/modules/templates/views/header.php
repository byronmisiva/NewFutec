<!DOCTYPE html>
<html lang="es">
<head>
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
          content="<?php echo (isset($description)) ? strip_tags($description) . "," . $tags : 'Fútbol Ecuador: Lo mejor del ftbol ecuatoriano. Noticias e información sobre campeonato ecuatoriano de fútbol, clubes, jugadores, eliminatorias, copa libertadores.'; ?>"/>
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

    <meta name="apple-itunes-app" content="app-id=1008177383, app-argument=//www.futbolecuador.com">

    <meta name="google-play-app" content="app-id=com.misiva.futbolecuadorpush">

    <!--TAGS com.misiva.futbolecuadorpush 1008177383-->
    <!--TAGS com.futbolecuador.femagazine 622931242-->

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
    <meta property="og:image"
          content="<?php echo (isset($image)) ? base_url($image) : base_url('imagenes/coverappalertas.jpg'); ?>"/>
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
    <link href="<?php echo base_url() ?>assets/css/style.css?a=1" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/sprites.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/js/smartbanner/jquery.smartbanner.css') ?>" type="text/css" media="screen">


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

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <?php
    if ($verMobile == "1") {
        ?>

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <script type="text/javascript" async defer
                src="https://apis.google.com/js/platform.js?publisherid=109198533032839133083">
        </script>
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
    <script>
        var baseUrl = "<?php echo base_url(); ?>";
        var REFRESH_VIVO = "<?php echo REFRESH_VIVO; ?>";
    </script>
    <!--   script teads  se muestra cuando es noticia abierta-->


    <!-- Tapstream tracking-->
    <script type="text/javascript">

        var _tsq = _tsq || [];
        _tsq.push(["setAccountName", "futbolecuador"]);
        _tsq.push(["trackPage"]);

        (function() {
            function z(){
                var s = document.createElement("script");
                s.type = "text/javascript";
                s.async = "async";
                s.src = window.location.protocol + "//cdn.tapstream.com/static/js/tapstream.js";
                var x = document.getElementsByTagName("script")[0];
                x.parentNode.insertBefore(s, x);
            }
            if (window.attachEvent)
                window.attachEvent("onload", z);
            else
                window.addEventListener("load", z, false);
        })();

    </script>
    <!-- End Tapstream tracking-->
</head>
<body>
<input type="hidden" name="OBKey" value="uTBPZWgHc7ufQoVDUh9ZDA=="/>
<script LANGUAGE="JavaScript">var OBCTm = '1426714580701'; </script>
<script LANGUAGE="JavaScript" src="http://widgets.outbrain.com/claim.js"></script>
<script type='text/javascript'>
    var googletag = googletag || {};
    googletag.cmd = googletag.cmd || [];
    (function () {
        var gads = document.createElement('script');
        gads.async = true;
        gads.type = 'text/javascript';
        var useSSL = 'https:' == document.location.protocol;
        gads.src = (useSSL ? 'https:' : 'http:') +
        '//www.googletagservices.com/tag/js/gpt.js';
        var node = document.getElementsByTagName('script')[0];
        node.parentNode.insertBefore(gads, node);
    })();
</script>

<script type='text/javascript'>
    var verMobile = <?php echo $verMobile ?>;
    var secondskin;
    var uri = "<?php  echo ($this->uri->segment(2) != "" ) ? $this->uri->segment(2) :"false"; ?>";
    googletag.cmd.push(function () {
        googletag.defineSlot('/1022247/FE_NEW_HALF', [260, 90], 'div-gpt-ad-1422631305437-0').addService(googletag.pubads());

        googletag.defineSlot('/1022247/FE_NEW_HYPERBANNER', [980, 50], 'div-gpt-ad-1424964392222-0').addService(googletag.pubads());

        googletag.defineSlot('/1022247/FE_NEW', [728, 90], 'div-gpt-ad-1413318555463-2').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_NEW_RECTANGLE', [300, 250], 'div-gpt-ad-1413318555463-3').addService(googletag.pubads());

        googletag.defineSlot('/1022247/FE_NEW_LATERAL_1', [300, 250], 'div-gpt-ad-1413414586192-0').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_NEW_LATERAL_2', [300, 250], 'div-gpt-ad-1413414586192-1').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_NEW_LATERAL_3', [300, 250], 'div-gpt-ad-1413414586192-2').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_NEW_LATERAL_4', [300, 250], 'div-gpt-ad-1413414586192-3').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_NEW_RECTANGLE_1', [300, 250], 'div-gpt-ad-1413414586192-4').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_NEW_RECTANGLE_2', [300, 250], 'div-gpt-ad-1413414586192-5').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_NEW_RECTANGLE_3', [300, 250], 'div-gpt-ad-1413414586192-6').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_NEW_RECTANGLE_4', [300, 250], 'div-gpt-ad-1413414586192-7').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_NEW_RECTANGLE_5', [300, 250], 'div-gpt-ad-1413414586192-8').addService(googletag.pubads());

        //new 2015
        googletag.defineSlot('/1022247/FE_NEW_FILMSTRIP_BANNER', [300, 600], 'div-gpt-ad-1439997438966-0').addService(googletag.pubads());

        // publicidades en mobil
        googletag.defineSlot('/1022247/FE_HEADER', [320, 80], 'div-gpt-ad-1383593619381-0').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_SMART_TOP', [320, 50], 'div-gpt-ad-1383593619381-4').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_SMART_BOTTOM', [320, 50], 'div-gpt-ad-1383593619381-2').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_SMART_MIDDLE', [320, 50], 'div-gpt-ad-1383593619381-3').addService(googletag.pubads());

        googletag.defineSlot('/1022247/FE_LOADING', [800, 600], 'div-gpt-ad-1425424774921-0').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_LOADING_MOVIL', [320, 350], 'div-gpt-ad-1383593884981-1').addService(googletag.pubads());
        //googletag.defineSlot('/1022247/FE_SKIN_BRAND', [1800, 800], 'div-gpt-ad-1434137569309-1').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_SKIN', [1800, 800], 'div-gpt-ad-1434137569309-0').addService(googletag.pubads());

        //netsonic
        googletag.defineSlot('/25992948/EC_futbolecuador.com_1x1', [1, 1], 'div-gpt-ad-1438988612575-0').addService(googletag.pubads());





        googletag.pubads().enableSingleRequest();
        // si no existe contenido no muestra para el caso del header y splas
        //document.getElementById("div-gpt-ad-1383593619381-0").style.display = 'none';
        googletag.enableServices();
        //para el caso que no existe publicicad --MISIVA--
        googletag.pubads().collapseEmptyDivs(true);
        //console.log ("xx");
        googletag.pubads().addEventListener('slotRenderEnded', function (event) {

            if (event.slot.i == '/1022247/FE_LOADING_MOVIL') {
                if ((typeof event.isEmpty) == 'boolean') {
                    if (event.isEmpty) {


                        //para el caso de splash movil
                        <?php
                            if (isset($mostrarSplash)) {
                                if ($mostrarSplash == "1")
                                    echo "cargarSplashFE();";
                            } else {
                                echo "mostrarBlackLayer;";
                            }
                        ?>
                        //cleanBlackLayer;
                    } else {
                        //console.log ( event.isEmpty)
                        cargarSplash();
                    }
                }

            }
            //para el caso de splash desktop
            //para el caso de splash movil
            if (event.slot.i == '/1022247/FE_LOADING') {
                console.log ("carga1 ");
                if (event.isEmpty) {
                    console.log ("carga2 ");
                    cleanBlackLayer ();

                } else {
                    console.log ("carga3 ");
                    <?php if ($verMobile != "1"){ ?>
                    cargarSplash();

                    <?php } ?>
                }
            }

            if (event.slot.i == '/1022247/FE_SKIN') {
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
    //espacios copa america
    googletag.cmd.push(function() {
        googletag.defineSlot('/1022247/FE_BRAND_HEADER', [980, 50], 'div-gpt-ad-1432051647687-0').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_BRAND_HALF', [260, 90], 'div-gpt-ad-1432051647687-1').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_BRAND_SKY2', [728, 90], 'div-gpt-ad-1432051647687-2').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_BRAND_SMART_BOTTOM', [320, 50], 'div-gpt-ad-1432051647687-3').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_BRAND_SMART_HEADER', [320, 80], 'div-gpt-ad-1432051647687-4').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_BRAND_SMART_MIDDLE', [320, 50], 'div-gpt-ad-1432051647687-5').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_BRAND_SMART_TOP', [320, 50], 'div-gpt-ad-1432051647687-6').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_HP_BRAND', [300, 250], 'div-gpt-ad-1432051647687-7').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_HP_BRAND2', [300, 250], 'div-gpt-ad-1432051647687-8').addService(googletag.pubads());
        googletag.pubads().enableSingleRequest();
        googletag.enableServices();
    });
    // fin espacios copa america

</script>

<!-- Tag Netsonic-->
<!-- /25992948/EC_futbolecuador.com_1x1 -->
<div id='div-gpt-ad-1438988612575-0' style='height:1px; width:1px;'>
    <script type='text/javascript'>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1438988612575-0'); });
    </script>
</div>

<script type='text/javascript' src='http://partner.googleadservices.com/gampad/google_service.js'></script>
<script type='text/javascript'>
    GS_googleAddAdSenseService("ca-pub-2857298972794488");
    GS_googleEnableAllServices();
</script>
<script type='text/javascript'>
    GA_googleAddSlot("ca-pub-2857298972794488", "FE_HP_1");

    GA_googleAddSlot("ca-pub-2857298972794488", "FE_NEW_HYPERBANNER");
</script>


<script type='text/javascript'>GA_googleFetchAds();</script>
<!-- Google Tag Manager -->

<!-- Tapstream tracking-->
<script type="text/javascript">

    var _tsq = _tsq || [];
    _tsq.push(["setAccountName", "futbolecuador"]);
    _tsq.push(["trackPage"]);

    (function() {
        function z(){
            var s = document.createElement("script");
            s.type = "text/javascript";
            s.async = "async";
            s.src = window.location.protocol + "//cdn.tapstream.com/static/js/tapstream.js";
            var x = document.getElementsByTagName("script")[0];
            x.parentNode.insertBefore(s, x);
        }
        if (window.attachEvent)
            window.attachEvent("onload", z);
        else
            window.addEventListener("load", z, false);
    })();

</script>
<!-- End Tapstream tracking-->


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
    })(window, document, 'script', 'dataLayer', 'GTM-53XBQP');</script>
<!-- End Google Tag Manager -->

<!-- Facebook Conversion Code for FE_Visitas -->
<script>(function () {
        var _fbq = window._fbq || (window._fbq = []);
        if (!_fbq.loaded) {
            var fbds = document.createElement('script');
            fbds.async = true;
            fbds.src = '//connect.facebook.net/en_US/fbds.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(fbds, s);
            _fbq.loaded = true;
        }
    })();
    window._fbq = window._fbq || [];
    window._fbq.push(['track', '6017525548394', {'value': '0.00', 'currency': 'USD'}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none"
               src="https://www.facebook.com/tr?ev=6017525548394&amp;cd[value]=0.00&amp;cd[currency]=USD&amp;noscript=1"/>
</noscript>

<!-- Facebook Conversion Code for futbolecuador.com -->
<script>(function () {
        var _fbq = window._fbq || (window._fbq = []);
        if (!_fbq.loaded) {
            var fbds = document.createElement('script');
            fbds.async = true;
            fbds.src = '//connect.facebook.net/en_US/fbds.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(fbds, s);
            _fbq.loaded = true;
        }
    })();
    window._fbq = window._fbq || [];
    window._fbq.push(['track', '6015959317594', {'value': '0.00', 'currency': 'USD'}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none"
               src="https://www.facebook.com/tr?ev=6015959317594&amp;cd[value]=0.00&amp;cd[currency]=USD&amp;noscript=1"/>
</noscript>

<!-- Start Alexa Certify Javascript -->
<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script>
<script type="text/javascript">_atrk_opts = {atrk_acct: "A9Dnf1aUOO00Gi", domain: "futbolecuador.com"};
    atrk();</script>
<noscript>
    <img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=A9Dnf1aUOO00Gi" style="display: none" height="1"
         width="1" alt=""/>
</noscript>
<!-- End Alexa Certify Javascript -->




<div id="darkLayerFE" style="display:none;"></div>
<div id="FE_LOADINGFE" style="display:none;">
    <!-- Gestion revistaFE -->
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