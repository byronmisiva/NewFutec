<!DOCTYPE html>
<html>	
	<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
	<style type="text/css">
		body{
			margin:0;
			padding:0;	
		}	
	</style>
	<script>
	window.fbAsyncInit = function() {	    
	    FB.init({		     
			 appId   : '593917927336074',		      
		      channelUrl : '<?=base_url()?>', 
		      status  : true, // check login status
		      cookie  : true, // enable cookies to allow the server to access the session
		      xfbml   : true // parse XFBML
		    });
	};
	</script>		
	</head>
	<body style="background:#000000;" >		
    	<div id="fb-root"></div>
    	<div style="position:relative; width:50%;height:600px;margin:2% auto;" >
			  <iframe src="<?=base_url()?>simbiosis/animacion.html" scrolling="no" style="width:100%;height:600px;border:none;"></iframe>
    	</div>
    	<div style="position:relative; width:10%;height:45px;margin:2% auto;" >
    	
		    	<a target="_blank" href="http://www.facebook.com/sharer.php?u=http://www.futbolecuador.com/magazine/simbiosis" > 
		    	<img src="<?=base_url().'imagenes/magazine/share.png'?>" style="text-decoration: none;border:none;margin-top:10px;" />
		    	</a>
			
		
		   	<a target="_blank" href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.futbolecuador.com/magazine/simbiosis">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		
    	</div>
    	
    	 
    	
  </body>
</html>
