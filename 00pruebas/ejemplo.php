<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<script type="text/javascript" src="http://www.futbolecuador.com/assets/js/jquery.min.js"></script>
<div class="peque" style="width: 800px; height:600px">
    <iframe src="http://www.futbolecuador.com/futbolecuador_html5/pinguino/pinguino2/" width="800" height="600" frameborder="0"></iframe>
</div>
<div class="js--click" style="width: 900px; height: 0px; position: absolute; top: 0;  z-index: 10; cursor: pointer; margin: 1px solid blue;"></div>

<script type="text/javascript">
    var link = 'http://www.movistarbarca4g.com/';
    $(document).ready(function () {
        $('.js--click').click (function (){
            window.open('%%CLICK_URL_ESC%%' + link, '_blank');
        })
        $(".js--over").on("mouseenter", function () {
            $(".peque").hide();
            $(".js--over").hide();
            $(".grande").css("display", "block");
            $(".js--click").css("height", "250px");
            $('.grande iframe').contents().find("#Stage_play").click();
            //window.parent.see_fold2('on');
        })
        $("div.js--click")
            .on("mouseleave", function () {
                $(".peque").show();
                $(".js--over").show();
                $(".grande").css("display", "none");
                $(".js--click").css("height", "0");
                $('.grande iframe').contents().find("#Stage_stop").click()
                //window.parent.see_fold3('off');
            });
    });
</script>

</body>
</html>