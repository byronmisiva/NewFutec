<?php 
$idtipo = $this->uri->segment(2);
$tipo = array("noticia", "nuestrosembajadores", "lavoz", "zonafe", "equipo", "masleido");
if (in_array($idtipo, $tipo)) { ?>
<div class="col-md-12  col-xs-12">
	<div id="netsonic_divid_target"></div>
    <!-- NETSONIC.TV - ALL IN ONE (Intext) VIDEO 1.0 -->
    <script type="text/javascript">
        var NS_allinone_options = {
            formato: 'intext', // infirst | miniplayer | intext | interstitial
            pub: 'EC_futbolecuador.com',
            vpcategory: 'netsonic_futbolecuador.com_intext',
            vpcategorymob: 'netsonic_futbolecuador.com_mobile',
            divID: "netsonic_divid_target", // div destino
            position: 0, // 0: en la posicion | 1: antes | 2:despues | 3: dentro antes div hijo | 4: dentro despues contenido
            vptags: "",
            environment: "",
            vpcontentid: "",
            async: true,
            version_aio: "1.0",
            player: "flash-html5",
            width: "640",
            height: "360",
            volume: ".5",
            title: undefined,
            wait: false,
            forceshow: false,
            divClassName: "",
            divClassNameNumber: 1,
            miniplayer_click: false,
            miniplayer_autosize: false,
            rnd: Math.random().toString().substring(2, 11),
            enabled: true
        };
        if (NS_allinone_options.enabled) {
            document.write("<scr" + "ipt type='text\/javascript' src='http:\/\/cdn.netsonic.tv\/res\/allinone\/" + NS_allinone_options.version_aio + "\/aio.min.js?pub=" + NS_allinone_options.pub + "&vpcategory=" + NS_allinone_options.vpcategory + "&vpcategorymob=" + NS_allinone_options.vpcategorymob + "&formato=" + NS_allinone_options.formato + "&divID=" + NS_allinone_options.divID + "&player=" + NS_allinone_options.player + "&vptags=" + NS_allinone_options.vptags + "&async=" + NS_allinone_options.async + "&width=" + NS_allinone_options.width + "&height=" + NS_allinone_options.height + "&volume=" + NS_allinone_options.volume + "&position=" + NS_allinone_options.position + "&miniplayer_click=" + NS_allinone_options.miniplayer_click + "&miniplayer_autosize=" + NS_allinone_options.miniplayer_autosize + "&rnd=" + NS_allinone_options.rnd + "'><\/scr" + "ipt>");
        };
    </script>
    <!-- !NETSONIC.TV - ALL IN ONE (Intext) VIDEO 1.0 -->
</div>
<?php }else {?>
	<div id="netsonic"></div>
	<script type='text/javascript'>
	    var cuerpoRef = document.getElementsByTagName("body")[0].innerHTML;
	    $(document).ready(function () {
	        if (typeof secondskin != 'undefined') {
	            console.log (secondskin);
	            if (secondskin == 2) {
	                $("#netsonic").remove();
	                $("#eyeDiv").remove();
	                $("#ebDimmer").remove();
	            } else {
	                //document.write('<script src="http://bs.serving-sys.com/BurstingPipe/adServer.bs?cn=rsb&c=28&pli=14265700&PluID=0&w=1&h=1&ord=[random]&ucm=true"><\/script>');
	                //document.write(cuerpoRef);
	                //console.log ("publi");
	                var container = document.getElementById("netsonic");
	                container.innerHTML =  '<a href="http://bs.serving-sys.com/BurstingPipe/adServer.bs?cn=brd&FlightID=14265700&Page=&PluID=0&Pos=2101911275"'+
	                    'target="_blank"><img src="http://bs.serving-sys.com/BurstingPipe/adServer.bs?cn=bsr&FlightID=14265700&Page=&PluID=0&Pos=2101911275"' +
	                    'border=0 width=1 height=1><\/a>';
	            }
	        } else {
	            $("#netsonic").remove();
	            $("#eyeDiv").remove();
	            $("#ebDimmer").remove();
	        }
	    })
	</script>
<?php }?>
