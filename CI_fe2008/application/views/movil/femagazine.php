<? echo $m; ?>

<!--<div id='mod_femagazine' style='position:relative;width:100%; height:793px;' >-->
<!--    -->
<!--    <iframe src="--><?//=base_url()?><!--portada/animacion.html?refresh=12465468554" scrolling="no" style="width: 100%;height:100%;"></iframe>-->
<!--</div>-->
<? if ($url!="") { ?>
    <script LANGUAGE="JavaScript">

        //en caso que sea movil IOS o movil Android
        var pagina="<? echo $url; ?>";

        function myTimer()
        {
            window.clearInterval(myVar);
            location.href=pagina;
        }
        var myVar=setInterval(function(){myTimer()},10);
    </script>
<? } ?>