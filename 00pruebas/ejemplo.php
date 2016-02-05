<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<script type="text/javascript" src="http://www.futbolecuador.com/assets/js/jquery.min.js"></script>
<div class="js--click" style="width:800px; height: 600px; position: absolute; top: 0; left: 0;  z-index: 9; cursor: pointer; border: 1px solid blue;">

</div>
<iframe src="http://www.futbolecuador.com/futbolecuador_html5/pinguino/pinguino-empastado/" width="800" height="600" frameborder="0"></iframe>
<div class="js-cerrar" style="width: 100px; height: 100px; position: absolute; top: 500px; left: 700px;  z-index: 10; cursor: pointer; border: 1px solid blue;"></div>

<script type="text/javascript">
    var link = 'http://www.movistarbarca4g.com/';
    $(document).ready(function () {
        $('.js--click').click (function (){
            window.open('%%CLICK_URL_ESC%%' + link, '_blank');
        });
        $('.js-cerrar').click (function (){
            alert ("cerrar banner")
        });
    });
</script>

</body>
</html>