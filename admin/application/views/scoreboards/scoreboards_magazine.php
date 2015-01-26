<!DOCTYPE>
<html> 
	<head>
		<title>Marcador en Vivo - futbolecuador.com</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">		
		<link type="text/css" rel="stylesheet" href="<?=base_url()?>css/fe_magazine_principal.css" />		
		<!-- Load Prototype & Scriptaculous -->	
		<script src="//www.google.com/jsapi"></script>
		<script>
			google.load("prototype", "1.7.0.0");
	  		google.load("scriptaculous", "1.9.0");
		</script>
		
		<script type="text/javascript" src="<?=base_url();?>js/public_ajax.js?refresh=99999"></script>		
		
		<!-- GOOGLE ANALYTICS -->
		<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-2423727-1']);
		  _gaq.push(['_setDomainName', 'futbolecuador.com']);
		  _gaq.push(['_trackPageview']);
		
		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		  var intervalDetails = null;				  
		</script>
		 <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/nicescroll/jquery.nicescroll.min.js" ></script>
		<script>
		  j = jQuery.noConflict();
		  j(document).ready(function() {
				var nice = j("html").niceScroll();  // The document page (body)
			    j("#scoreboards_live").niceScroll({touchbehavior:true}); // First scrollable DIV
			  });
		</script> 
		<style>
		.contenedor-volver{
			position:absolute; 
			top: 0;left: 0; 
			width: 100%; height:auto;			
			text-align:center;
		}		
		
			.btn_volver{
				position: absolute; 
				top:0; left: 20px;
				width: 200px;height: auto; 
				cursor: pointer; 
				color: white; 
				line-height: 45px; 
				text-align: left; 
				padding-left: 10px; 
				display: none; 
				font-size: 22px;"
			}
			
		</style>
	</head>
	<body>
		<div id="div1" style="position: absolute; top: 0px; left: 0px; width:100%; height:650px;overflow: hidden;">
			<div id="scoreboards_live" style="position: relative; top: auto; left: 2px; width:97%; height:650px;overflow: hidden; "></div>
		</div>
	</body>
	<script type="text/javascript">
		ajax_update_script('scoreboards_live','<?=base_url()?>scoreboards/list_matches_magazine/ExMpLKey123/magazine','<?=base_url()?>');				
	</script>
</html>
