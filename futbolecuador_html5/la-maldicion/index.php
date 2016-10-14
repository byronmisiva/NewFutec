<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="content-language" content="es"/>
    <meta name="robots" content="follow,index,nocache"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="author" content="Misiva Corp"/>

</head>
<body style="margin: 0; padding: 0">

<script type="text/javascript" src="http://www.futbolecuador.com/assets/js/jquery.min.js"></script>
<div class="peque"
     style="width: 300px; height: 250px; background-image: url(http://futbolecuador.com/futbolecuador_html5/the-other-side-of-the-door/images/pay-the-ghost-300x250.jpg); ">
</div>
<div class="grande"
     style="display: inline-block; width: 900px; height: 250px; margin-left:0px; background-image: url(http://futbolecuador.com/futbolecuador_html5/the-other-side-of-the-door/images/fondo.jpg);">
    <video id="Stage_trailer2" loop="loop" src="http://www.futbolecuador.com/futbolecuador_html5/the-other-side-of-the-door/media/trailer.mp4"></video>
</div>
<div class="js--over"
     style="width: 300px; height: 250px; position: absolute; top: 0;  z-index: 10; cursor: pointer;"></div>
<div class="js--click"
     style="width: 900px; height: 0px; position: absolute; top: 0;  z-index: 10; cursor: pointer;"></div>

<script type="text/javascript">
    var link = 'http://www.foxmovies.com/movies/the-other-side-of-the-door';
    $(document).ready(function () {
        $('.js--click').click(function () {
            window.open('%%CLICK_URL_ESC%%' + link, '_blank');
        })
        $(".js--over").on("mouseenter", function () {
            $(".peque").hide();
            $(".js--over").hide();
            $(".grande").css("display", "block");
            $(".js--click").css("height", "250px");
            $('.grande iframe').contents().find("#Stage_play").click();
        })
        $("div.js--click")
            .on("mouseleave", function () {
                $(".peque").show();
                $(".js--over").show();
                $(".grande").css("display", "none");
                $(".js--click").css("height", "0");
                $('.grande iframe').contents().find("#Stage_stop").click()
            });
    });
</script>
</body>
</html> 