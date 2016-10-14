<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<title>Untitled</title>
<!--Adobe Edge Runtime-->
    <script type="text/javascript" charset="utf-8" src="http://animate.adobe.com/runtime/6.0.0/edge.6.0.0.min.js"></script>
    <style>
        .edgeLoad-EDGE-13310438 { visibility:hidden; }
        #Stage { background-color: transparent !important;}
        #Stage_panel_amarillo, #Stage_panel_promo, #Stage_panel_premios, #Stage_panel_spot1, 
        #Stage_panel_spot2, #Stage_panel_spot3, #Stage_panel_spot4 {cursor: pointer !important;}
    </style>
<script>
var cargado = 0;
setTimeout(function () {
     document.getElementById('Stage_banner_expand-btn').onclick=function(){
        window.parent.mostrarBoton ();       
    }
     document.getElementById('Stage_panel_colapse').onclick=function(){
        window.parent.mostrarBoton2 ();
    }
    document.getElementById('Stage_panel_amarillo').onclick=function(){
        window.parent.mostrarBoton3 ();
    }
    document.getElementById('Stage_panel_promo').onclick=function(){
        window.parent.mostrarBoton3 ();
    }
    document.getElementById('Stage_panel_premios').onclick=function(){
        window.parent.mostrarBoton3 ();   
    }
    document.getElementById('Stage_panel_spot1').onclick=function(){
        window.parent.mostrarBoton3 ();     
    }
    document.getElementById('Stage_panel_spot2').onclick=function(){
        window.parent.mostrarBoton3 ();
    }
    document.getElementById('Stage_panel_spot3').onclick=function(){
        window.parent.mostrarBoton3 ();
    }
    document.getElementById('Stage_panel_spot4').onclick=function(){
        window.parent.mostrarBoton3 ();
    }
    cargado = 1;
}, 6000);
setTimeout(function () {
    if (cargado == 0) {
        document.getElementById('Stage_banner_expand-btn').onclick=function(){
        window.parent.mostrarBoton ();       
    }
     document.getElementById('Stage_panel_colapse').onclick=function(){
        window.parent.mostrarBoton2 ();
    }
    document.getElementById('Stage_panel_amarillo').onclick=function(){
        window.parent.mostrarBoton3 ();
        
    }
    document.getElementById('Stage_panel_promo').onclick=function(){
        window.parent.mostrarBoton3 ();
       
    }
    document.getElementById('Stage_panel_premios').onclick=function(){
        window.parent.mostrarBoton3 ();
        
    }
    
    document.getElementById('Stage_panel_spot1').onclick=function(){
        window.parent.mostrarBoton3 ();
        
    }
    document.getElementById('Stage_panel_spot2').onclick=function(){
        window.parent.mostrarBoton3 ();
    }
    document.getElementById('Stage_panel_spot3').onclick=function(){
        window.parent.mostrarBoton3 ();
    }
    document.getElementById('Stage_panel_spot4').onclick=function(){
        window.parent.mostrarBoton3 ();
    }
        cargado = 1;       
    }
}, 10000);


AdobeEdge.loadComposition('300-250-980-richmedia', 'EDGE-13310438', {
    scaleToFit: "none",
    centerStage: "none",
    minW: "0px",
    maxW: "undefined",
    width: "980px",
    height: "250px"
}, {"dom":{}}, {"dom":{}});
</script>
<!--Adobe Edge Runtime End-->

</head>
<body style="margin:0;padding:0;">
    <div class="contenedor" style ="">
	<div id="Stage" class="EDGE-13310438">
	</div></div>
</body>
</html>