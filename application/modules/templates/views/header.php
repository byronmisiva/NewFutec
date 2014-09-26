<!DOCTYPE html>
<html lang="en-us" xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <?php header('Content-type: text/html; charset=utf-8'); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=base_url('img/apple-touch-icon-144-precomposed.png')?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=base_url('img/apple-touch-icon-114-precomposed.png')?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=base_url('img/apple-touch-icon-72-precomposed.png')?>">
    <link rel="apple-touch-icon-precomposed" href="<?=base_url('img/apple-touch-icon-57-precomposed.png')?>">

    <link rel="apple-touch-icon" sizes="144x144" href="<?=base_url('img/apple-touch-icon-144-precomposed.png')?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?=base_url('img/apple-touch-icon-114-precomposed.png')?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?=base_url('img/apple-touch-icon-72-precomposed.png')?>">
    <link rel="apple-touch-icon" href="<?=base_url('img/apple-touch-icon-57-precomposed.png')?>">


    <link rel="icon" href="assets/images/favicon.ico">

    <!--Facebook TAGS-->
    <meta property="og:title" content="<?php echo $pageTitle ?>"/>
    <meta property="og:url" content="http://www.futbolecuador.com"/>
    <meta property="og:site_name" content="Futbool Ecuador"/>
    <meta property="og:type" content="site"/>
    <meta property="og:image" content="<?=base_url('img/apple-touch-icon-144-precomposed.png')?>"/>

    <!--SEO TAGS-->
     <meta name="description" content="Futbolecuador.com, Todas las noticias actualizadas.">
     <meta name="keywords" content="futbolecuador, www.futbolecuador.com, futbol ecuador, futbol ecuador lo mejor del futbol ecuatoriano, ecuagol, emelec, futbolecuador, futbol, liga de quito,fef,campeonato ecuatoriano de futbol 2014,cristian penilla,futbol ecuatoriano,tabla de posiciones,ecuador vs holanda,el nacional,ldu,Barcelona,radio la red,aucas,campeonato ecuatoriano de futbol,deportivo quito,jefferson montero,la red,club deportivo el nacional,deportes ecuador,deportivo cuenca,antonio valencia,ecuador futbol,futbol de ecuador,futbolecuador.com,ulises de la cruz,campeonato ecuatoriano de futbol 2014 serie b,futbol ecuador en vivo,joao rojas,martin mandra,michael arroyo,alex colon,armando wila,carlos gruezo,fut,seleccion de ecuador,www.futbolecuador.com,claudio bieler,ecuatorianos en el exterior,felipe caicedo,frickson erazo"/>

    <title><?php echo $pageTitle ?></title>


    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/fhmm.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
    <!-- Lightbox stylesheet -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery.lightbox.min.css') ?>"/>
    <!-- Input slider -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/slider.css') ?>"/>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/flexslider.css');?>" type="text/css" media="screen" />
    <link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/sprites.css') ?>" rel="stylesheet">


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
    <script src="assets/js/modernizr.js"></script>


<!-- Bootstrap core JavaScript
================================================== -->
    <?php
    $this->load->library('user_agent');

    $mobiles=array('Apple iPhone','Generic Mobile');
    $isMobile = false   ;
    if ($this->agent->is_mobile()){
        $m=$this->agent->mobile();
        if ( in_array($m,$mobiles))
            $isMobile = true ;

    }
    if ($isMobile){
        ?>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php
    }else {
        ?>
        <meta name="viewport" content="width=995, initial-scale=1, maximum-scale=1">
        <style>
            .container{
                max-width: none !important;
                width: 995px;
            }
        </style>
    <?php
    }
    ?>

    <script>
        var baseUrl = "<?php echo base_url(); ?>";
    </script>

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
        googletag.cmd.push(function () {
            googletag.defineSlot('/1022247/300X250_MOVISTAR_MUNDIAL', [300, 250], 'div-gpt-ad-1402940790495-0').addService(googletag.pubads());
            googletag.defineSlot('/1022247/650x90_MOVISTAR_MUDIAL2', [650, 90], 'div-gpt-ad-1402940357233-0').addService(googletag.pubads());
            googletag.defineSlot('/1022247/650X90_MOVISTAR_MUNDIAL', [650, 90], 'div-gpt-ad-1402940357233-1').addService(googletag.pubads());
            googletag.defineSlot('/1022247/320X50_MOVISTAR_MUNDIAL_BOTTOM', [320, 50], 'div-gpt-ad-1401400694784-0').addService(googletag.pubads());
            googletag.defineSlot('/1022247/320x50_MOVISTAR_MUNDIAL_TOP', [320, 50], 'div-gpt-ad-1401400694784-1').addService(googletag.pubads());

            googletag.pubads().enableSingleRequest();
            googletag.enableServices();
        });
    </script>

</head>

<body>

<!-- Google Tag Manager -->
<noscript>
    <iframe src="//www.googletagmanager.com/ns.html?id=GTM-ND3RBS"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<script>(function (w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({'gtm.start': new Date().getTime(), event: 'gtm.js'});
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
            '//www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-ND3RBS');</script>
<!-- End Google Tag Manager -->