<!DOCTYPE html>
<html lang="en-us" xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <?php header('Content-type: text/html; charset=utf-8'); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Facebook TAGS-->
    <meta property="og:title" content="Movistar Mundialista"/>
    <meta property="og:url" content="http://www4.movistar.com.ec/FIFAWorldCup/"/>
    <meta property="og:site_name" content="JefeQuieroVerElFútbol"/>
    <meta property="og:type" content="site"/>
    <meta property="og:image" content="http://www4.movistar.com.ec/FIFAWorldCup/assets/images/logo-movistar.png"/>

    <!--SEO TAGS-->
    <meta name="Title" content="Movistar Mundialista">
    <meta name="description"
          content="Movistar, Compartida, la vida es más, y ahora puedes disfrutar del Mundial Brasil 2014 con partidos en vivo, noticias, goles, resultados. Vive la experiencia Mundialista">
    <meta name="keywords"
          content="Movistar, Movistar Ecuador,Mundial, Brasil, Mundial Brasil, Partidos, Partidos Ecuador, Football Ecuador, Partidos en Vivo, Futbol, Mundialista, Movistar Mundialista, Jefe, Ver futbol, futbol online">

    <title><?php echo $pageTitle ?></title>
    <link rel="apple-touch-icon" href="<?=base_url('assets/images/touch-icon-iphone.png')?>" /><!--imaegn de 57 x 57  -->
    <link rel="apple-touch-icon" sizes="72x72" href="<?=base_url('assets/images/touch-icon-ipad.png')?>" />
    <link rel="apple-touch-icon" sizes="114x114" href="<?=base_url('assets/images/touch-icon-iphone4.png')?>" />
    <link rel="apple-touch-icon" sizes="144x144" href="<?=base_url('assets/images/touch-icon-ipad2.png')?>" />

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/brasil.css') ?>?rand=<?php echo time(); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/jquery.countdown.css') ?>" rel="stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script
        src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <!-- ColorBox -->
    <link rel="stylesheet" href="<?php echo base_url('assets/js/colorbox/colorbox.css') ?>"/>
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico') ?>">

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
<?php base_url('site/historias/'); ?>
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