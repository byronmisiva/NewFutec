<!DOCTYPE>
<html> 
	<head>
		<title>Marcador en Vivo - futbolecuador.com</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
		<style type="text/css">
		body {					
			padding: 0px;
			width: 760px;
			font-family: Helvetica, sans-serif;
			color: white;			
			margin-left: auto;
			margin-right: auto;
			margin-top: 0px;
			/*background-color: #006B95;*/
		}
		</style>
		<!-- Load Prototype & Scriptaculous -->	
		<script src="//www.google.com/jsapi"></script>
		<script>
			google.load("prototype", "1.7.0.0");
	  		google.load("scriptaculous", "1.9.0");
		</script>
		
		<script type="text/javascript" src="<?=base_url();?>js/public_ajax.js?refresh=99999"></script>
		
		<!-- GOOGLE AD SERVER TAGS -->
	<script type='text/javascript'>
		var googletag = googletag || {};
		googletag.cmd = googletag.cmd || [];
		(function() {
		var gads = document.createElement('script');
		gads.async = true;
		gads.type = 'text/javascript';
		var useSSL = 'https:' == document.location.protocol;
		gads.src = (useSSL ? 'https:' : 'http:') +
		'//www.googletagservices.com/tag/js/gpt.js';
		var node = document.getElementsByTagName('script')[0];
		node.parentNode.insertBefore(gads, node);
		})();
		</script>
		
		<script type='text/javascript'>
		googletag.cmd.push(function() {
		googletag.defineSlot('/1022247/FE_VIVO_BOTTOM', [728, 90], 'div-gpt-ad-1366056348535-0').addService(googletag.pubads());
		googletag.defineSlot('/1022247/FE_VIVO_TOP', [180, 150], 'div-gpt-ad-1366056348535-1').addService(googletag.pubads());
		googletag.pubads().enableSingleRequest();
		googletag.enableServices();
		});
	</script>
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
	</head>
	<body>
		<div style="position: absolute; top: 0px; left: 0px; width: 760px; height: 850px; background-image: url('<?=base_url()?>imagenes/match_center/fondo_marcador.png'); background-repeat: no-repeat;">
			
			<div style="position: absolute; top: 0px; left: 0px; width: 760px; height: 150px; overflow: hidden;">
				<div style='position: absolute; width: 381px; height: 64px; left: 20px; top: 50px; background-image: url("<?=base_url()?>imagenes/match_center/logotipo_fe.png");'></div>							
				<!-- FE_VIVO_TOP -->
				<div id='div-gpt-ad-1366056348535-1' style='position: absolute; width:180px; height:150px; left: 545px;'>
					<script type='text/javascript'>
						googletag.cmd.push(function() { googletag.display('div-gpt-ad-1366056348535-1'); });
					</script>
				</div>
			</div>
			
			<div id="scoreboards_live" style="position: absolute; top: 150px; left: 0px; width: 755px; height: 600px; overflow-y: auto; overflow-x: hidden;"></div>
			
			<div style="position: absolute; top: 755px; left: 0px; width: 760px; height: 95px; background-image: url(<?=base_url()?>imagenes/match_center/barra.png); background-repeat: repeat-y;">				
				<!-- FE_VIVO_BOTTOM -->
				<div id='div-gpt-ad-1366056348535-0' style='position: absolute; top: 0px; left: 16px; width:728px; height:90px;'>
					<script type='text/javascript'>
						googletag.cmd.push(function() { googletag.display('div-gpt-ad-1366056348535-0'); });
					</script>
				</div>
				<div id="matches_back" style="position: absolute; top: 0px; right: 20px; width: 200px; height: 90px; cursor: pointer; color: black; line-height: 90px; text-align: right; padding-right: 10px; display: none; font-size: 18px;" onclick="ajax_update_script('scoreboards_live','<?=base_url()?>scoreboards/list_matches/ExMpLKey123','<?=base_url()?>');Effect.toggle('matches_back', 'appear');clearInterval(intervalDetails);BorrarIntervalos();">
					Volver a partidos
				</div>			
			</div>
		</div>
	</body>
	<script type="text/javascript">
		ajax_update_script('scoreboards_live','<?=base_url()?>scoreboards/list_matches/ExMpLKey123','<?=base_url()?>');		
	</script>
</html>