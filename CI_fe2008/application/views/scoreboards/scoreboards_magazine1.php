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
		<div style="position: absolute; top: 0px; left: 0px; width: 760px; height: 650px;">
					
			<div id="scoreboards_live" style="position: absolute; top: 5px; left: 0px; width: 755px; height: 600px; overflow-y: auto; overflow-x: hidden;"></div>
			
			<div style="position: absolute; top: 605px; left: 0px; width: 760px; height: 45px;">
				<div id="matches_back" style="position: absolute; top: 0px; left: 20px; width: 200px; height: 45px; cursor: pointer; color: white; line-height: 45px; text-align: left; padding-left: 10px; display: none; font-size: 22px;" onclick="ajax_update_script('scoreboards_live','<?=base_url()?>scoreboards/list_matches/ExMpLKey123/magazine','<?=base_url()?>');Effect.toggle('matches_back', 'appear');clearInterval(intervalDetails);BorrarIntervalos();">
					Volver a partidos
				</div>			
			</div>
		</div>
	</body>
	<script type="text/javascript">
		ajax_update_script('scoreboards_live','<?=base_url()?>scoreboards/list_matches/ExMpLKey123/magazine','<?=base_url()?>');		
	</script>
</html>