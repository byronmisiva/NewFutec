<head>
    <title>Movistar - Partidos on Line</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link rel="shortcut icon" href="http://www4.movistar.com.ec/FIFAWorldCup/assets/images/favicon.ico">
    <script type='text/javascript'>
        var googletag = googletag || {};
        googletag.cmd = googletag.cmd || [];
        (function() {
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
        googletag.cmd.push(function() {
            googletag.defineSlot('/1022247/728x90_MOVISTAR_PLAYER', [728, 90], 'div-gpt-ad-1402598357923-0').addService(googletag.pubads());
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


<script type="text/javascript">
    var eventsPath = "http://static.elcanaldelfutbol.com";
    var embedWidth = "100%";
    var embedHeight = "80%";
    $(document).ready(function () {
        var eventsPath = "http://static.elcanaldelfutbol.com";
        $.getScript(eventsPath + "/events.js", function (data, textStatus, jqxhr) {

            jQuery.support.cors = true;
            jQuery.ajaxSetup({ cache: true });
            streamId = getURLParameter('id');
            isLiveEmbed = getURLParameter('vod') == null;
            $("#container").html("<div id='player'></div>");
            $("#container").show();
            loadPlayer();
        });


    });
</script>

<div class="contenedorfull">
    <a href="http://www4.movistar.com.ec/FIFAWorldCup/video/">

        <div class="cabeceravideo"><a href='javascript:history.go(-1)'><img
                    src="http://www4.movistar.com.ec/FIFAWorldCup/video/assets/images/botonhome.png"></a></div>
        <div id="player"></div>
        <div class="bloquea-video"></div>
        <div class="bloquea-video2"></div>

        <div id="brand">
            <div id="logo">
                <!-- 728x90_MOVISTAR_PLAYER -->
                <div id='div-gpt-ad-1402598357923-0' style='width:728px; height:90px;'>
                    <script type='text/javascript'>
                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1402598357923-0'); });
                    </script>
                </div>

            </div>
        </div>
</div>

</body>
<style TYPE="text/css">
    body {
        margin: 0;
        padding: 0
    }

    #brand {
        width: 100%;
        height: 100px;
        float: left;
        background: url("video-fullscreen.jpg") repeat-x scroll 0 0;
    }

    #logo {
        width: 728px;
        height: 100px;

        margin: 10px auto;
        /*background: url("logo-movistar.png");*/
    }

    .cabeceravideo {
        background-color: #03527f;
        height: 50px;
        width: 100%;
    }

    .cabeceravideo:hover {
        cursor: pointer;

    }

    .bloquea-video {
        background-color: rgba(0, 0, 0, 0);
        float: left;
        height: 35%;
        left: 0;
        position: absolute;
        top: 50px;
        width: 100%;
    }

    .bloquea-video2 {
        background-color: rgba(0, 0, 0, 0);
        float: left;
        height: 35%;
        left: 0;
        position: absolute;
        top: 50%;
        width: 100%;
    }
</style>