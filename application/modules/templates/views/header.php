<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="content-language" content="es"/>
    <meta name="robots" content="follow,index,nocache"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
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
    <meta name="twitter:app:id:iphone" content="622931242">
    <meta name="twitter:app:id:ipad" content="622931242">
    <meta name="twitter:app:id:googleplay" content="com.futbolecuador.femagazine">
    <meta name="twitter:widgets:csp" content="on">
    <meta name="twitter:app:country" content="US">
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
    <meta property="og:description" content="<?php echo (isset($description)) ? $description : 'Futbol Ecuador'; ?>"/>
    <meta property="og:image"
          content="<?php echo (isset($image)) ? base_url($image) : base_url('img/apple-touch-icon-144-precomposed.png'); ?>"/>

    <!--SEO TAGS-->
    <meta name="description" content="Futbolecuador.com, Todas las noticias actualizadas.">
    <meta name="keywords"
          content="futbolecuador, www.futbolecuador.com, futbol ecuador, futbol ecuador lo mejor del futbol ecuatoriano, ecuagol, emelec, futbolecuador, futbol, liga de quito,fef,campeonato ecuatoriano de futbol 2014,cristian penilla,futbol ecuatoriano,tabla de posiciones,ecuador vs holanda,el nacional,ldu,Barcelona,radio la red,aucas,campeonato ecuatoriano de futbol,deportivo quito,jefferson montero,la red,club deportivo el nacional,deportes ecuador,deportivo cuenca,antonio valencia,ecuador futbol,futbol de ecuador,futbolecuador.com,ulises de la cruz,campeonato ecuatoriano de futbol 2014 serie b,futbol ecuador en vivo,joao rojas,martin mandra,michael arroyo,alex colon,armando wila,carlos gruezo,fut,seleccion de ecuador,www.futbolecuador.com,claudio bieler,ecuatorianos en el exterior,felipe caicedo,frickson erazo"/>

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
    <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/sprites.css') ?>" rel="stylesheet">

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
    <?php
    } else {
        ?>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <!--        <meta name="viewport" content="width=990, initial-scale=1, maximum-scale=1"/>-->
    <?php
    }
    ?>
    <script>
        var baseUrl = "<?php echo base_url(); ?>";
        var REFRESH_VIVO = "<?php echo REFRESH_VIVO; ?>";
    </script>
</head>
<body>
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
    <?php
    if($verMobile=="1"){?>
        var verMobile = 1;
        <?php
    }  else { ?>
        var verMobile = 0;
    <?php
    }
    ?>
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

        // publicidades en mobil
        googletag.defineSlot('/1022247/FE_HEADER', [320, 80], 'div-gpt-ad-1383593619381-0').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_SMART_TOP', [320, 50], 'div-gpt-ad-1383593619381-4').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_SMART_BOTTOM', [320, 50], 'div-gpt-ad-1383593619381-2').addService(googletag.pubads());
        googletag.defineSlot('/1022247/FE_SMART_MIDDLE', [320, 50], 'div-gpt-ad-1383593619381-3').addService(googletag.pubads());

        // splsh movil
        googletag.defineSlot('/1022247/FE_LOADING_MOVIL', [320, 350], 'div-gpt-ad-1383593884981-1').addService(googletag.pubads());

        // splsh movil
        googletag.defineSlot('/1022247/FE_LOADING_MOVIL', [320, 350], 'div-gpt-ad-1383593884981-1').addService(googletag.pubads());

        googletag.defineSlot('/1022247/FE_LOADING', [800, 600], 'div-gpt-ad-1425424774921-0').addService(googletag.pubads());

        googletag.pubads().enableSingleRequest();
        // si no existe contenido no muestra para el caso del header y splas
        //document.getElementById("div-gpt-ad-1383593619381-0").style.display = 'none';
        googletag.pubads().addEventListener('slotRenderEnded', function (event) {
            if (event.slot.i == '/1022247/FE_LOADING_MOVIL') {
                if (!event.isEmpty) {
                    cleanBlackLayer;
                } else {
                    cargarSplash();
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


        googletag.enableServices();

        //para el caso que no existe publicicad --MISIVA--
        googletag.pubads().collapseEmptyDivs(true);

    });

</script>
<script type='text/javascript' src='http://partner.googleadservices.com/gampad/google_service.js'></script>
<script type='text/javascript'>GS_googleAddAdSenseService("ca-pub-2857298972794488");
    GS_googleEnableAllServices();</script>
<script type='text/javascript'>
    GA_googleAddSlot("ca-pub-2857298972794488", "FE_HP_1");
</script>

<script type='text/javascript'>
    GA_googleAddSlot("ca-pub-2857298972794488", "FE_SKIN");
</script>
<script type='text/javascript'>GA_googleFetchAds();</script>

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
<div id="darkLayer" style="display:none;"></div>
<div id="FE_LOADING" style="display:none;">
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
