<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-44225428-2', 'movistar.com.ec');
    ga('send', 'pageview');
</script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-hover-dropdown.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/fitdivs.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/scripts.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.lightbox.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/slider.min.js') ?>"></script>

<!-- FlexSlider -->
<script defer src="<?php echo base_url('assets/js/jquery.flexslider.js') ?>"></script>

<!-- Optional FlexSlider Additions -->
<script src="<?php echo base_url('assets/js/jquery.easing.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.mousewheel.js') ?>"></script>


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

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&appId=595644553876654&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
</body>
</html>