<?php
$idtipo = $this->uri->segment(2);
$tipo = array("noticia", "nuestrosembajadores", "lavoz", "zonafe", "equipo", "masleido");
if (in_array($idtipo, $tipo)) { ?>
    <!--   script teads  se muestra cuando es noticia abierta-->
    <!-- <script type="text/javascript">
        window._ttf = window._ttf || [];
        _ttf.push({
            pid          : 39281
            ,lang        : "es"
            ,slot        : '.noticia-body > p'
            ,format      : "inread"
            ,minSlot     : 1
            ,components  : { mute: {delay :3}, skip: {delay :3} }
            ,css         : "margin: 0px 0px 10px;"
        });

        (function (d) {
            var js, s = d.getElementsByTagName('script')[0];
            js = d.createElement('script');
            js.async = true;
            js.src = '//cdn.teads.tv/media/format.js';
            s.parentNode.insertBefore(js, s);
        })(window.document);
    </script>-->
    <!-- /1022247/teads_Secciones -->
	<div id='div-gpt-ad-1493409196824-0' style='height:1px; width:1px;'>
		<script>
		googletag.cmd.push(function() { googletag.display('div-gpt-ad-1493409196824-0'); });
		</script>
	</div>
<?php } else { ?>
	<div id='div-gpt-ad-1493409384189-0' style='height:1px; width:1px;'>
	<script>
		googletag.cmd.push(function() { googletag.display('div-gpt-ad-1493409384189-0'); });
	</script>
	</div>

    <!--   script teads  home, zona fe, otras -->
    <script type="text/javascript">
        /*window._ttf = window._ttf || [];
        _ttf.push({
            pid          : 48650
            ,lang        : "es"
            ,slot        : '.row .navbar .navbar-collapse'
            ,format      : "inboard"
            ,components  : { mute: {delay :0}, skip: {delay :3} }
            ,css         : "padding: 0px 10px;"
        });

        (function (d) {
            var js, s = d.getElementsByTagName('script')[0];
            js = d.createElement('script');
            js.async = true;
            js.src = '//cdn.teads.tv/media/format.js';
            s.parentNode.insertBefore(js, s);
        })(window.document);*/
    </script>
<?php }?>