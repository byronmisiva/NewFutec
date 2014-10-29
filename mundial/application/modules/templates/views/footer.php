<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-44225428-2', 'movistar.com.ec');
    ga('send', 'pageview');
</script>




<!-- echo.js -->
<script src="<?php echo base_url('assets/js/echo.min.js') ?>"></script>
<script>
    echo.init({
        offset: 100,
        throttle: 250,
        unload: false,
        callback: function (element, op) {
            //console.log(element, 'has been', op + 'ed')
        }
    });
</script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url('assets/js/jquery.plugin.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.countdown.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.countdown-es.js') ?>"></script>
<script src="<?php echo base_url('/assets/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript"
        src="<?php echo base_url('assets/js/carouFredSel/jquery.carouFredSel-6.2.1-packed.js') ?>"></script>
<!-- optionally include helper plugins -->

<script type="text/javascript"
        src="<?php echo base_url('/assets/js/colorbox/jquery.colorbox.min.js') ?>"></script>
<script type="text/javascript"
        src="<?php echo base_url('/assets/js/scrool/animatescroll.min.js') ?>"></script>
<script type="text/javascript"
        src="<?php echo base_url('/assets/js/brasil2014.js') ?>"></script>
<!-- fire plugin onDocumentReady -->
<script type="text/javascript">
    adroll_adv_id = "7IEKX4QU7NGODM7RAJE7NN";
    adroll_pix_id = "3ZEKOXB4VRE57G7GJ2DCC5";
    (function () {
        var oldonload = window.onload;
        window.onload = function(){
            __adroll_loaded=true;
            var scr = document.createElement("script");
            var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
            scr.setAttribute('async', 'true');
            scr.type = "text/javascript";
            scr.src = host + "/j/roundtrip.js";
            ((document.getElementsByTagName('head') || [null])[0] ||
                document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
            if(oldonload){oldonload()}};
    }());
</script>
</body>
</html>