<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-hover-dropdown.js') ?>"></script>
<!-- FlexSlider -->
<script defer src="<?php echo base_url('assets/js/jquery.flexslider-min.js') ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/fitdivs.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/scripts.js?refresh=1234567') ?>"></script>
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
<script type="text/javascript" src="<?= base_url()?>assets/js/add2home.js?v1"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.hidden-menu').css('display', 'none');
    });
</script>

<!-- Google Fonts embed code -->
<script type="text/javascript">
    (function () {
        var link_element = document.createElement("link"),
            s = document.getElementsByTagName("script")[0];
        if (window.location.protocol !== "http:" && window.location.protocol !== "https:") {
            link_element.href = "http:";
        }
        link_element.href += "//fonts.googleapis.com/css?family=Oxygen:300,400,700";
        link_element.rel = "stylesheet";
        link_element.type = "text/css";
        s.parentNode.insertBefore(link_element, s);
    })();
</script>


<script>
    $(document).ready(function () {
        // Target your .container, .wrapper, .post, etc.

        $(document).on('click', '.fhmm .dropdown-menu', function (e) {
            e.stopPropagation()
        })
        // Menu drop down effect
        $('.dropdown-toggle').dropdownHover().dropdown();
        $(".fhmm").fitVids();
    });
</script>
<script>
    // Initiate Lightbox
    $(function () {
        $('.image-item > a').lightbox();
    });
</script>

<script type="text/javascript">
    adroll_adv_id = "7IEKX4QU7NGODM7RAJE7NN";
    adroll_pix_id = "3ZEKOXB4VRE57G7GJ2DCC5";
    (function () {
        var oldonload = window.onload;
        window.onload = function () {
            __adroll_loaded = true;
            var scr = document.createElement("script");
            var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
            scr.setAttribute('async', 'true');
            scr.type = "text/javascript";
            scr.src = host + "/j/roundtrip.js";
            ((document.getElementsByTagName('head') || [null])[0] ||
            document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
            if (oldonload) {
                oldonload()
            }
        };
    }());
</script>

<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&appId=595644553876654&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<!-- Alexa.com -->
<div style='display: none;'>
    <a href="http://www.alexa.com/siteinfo/www.futbolecuador.com">
        <script type='text/javascript' src='http://xslt.alexa.com/site_stats/js/t/a?url=www.futbolecuador.com'></script>
    </a> <a href="http://www.alexa.com/siteinfo/www.futbolecuador.com?p=rwidget#reviews"><img src='http://www.alexa.com/images/widgets/blue/light/v1-125x60.png' alt='Review www.futbolecuador.com on alexa.com'/> </a>
</div>
<!-- FIN Alexa.com -->

<!-- Push Notifications -->
<script type="text/javascript">
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
<!-- Push Notifications -->
<?php

       if ($this->uri->segment(1) == "home22222")
       {
           ?>
           <script>
               var gnEbMinZIndex = 10000;
               var gfEbInIframe = false;
               var gEbAd = new Object();
               gEbAd.nFlightID = 12416657;
               var gfEbUseCompression = true;
           </script>
           <script src="http://ds.serving-sys.com/BurstingScript/ebServing_12416657.js"></script>
       <?php
       };

?>
<?php
    echo $fe_splash;
?>
</body>
</html>