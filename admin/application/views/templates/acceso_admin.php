<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta http-equiv="Cache-Control" content="public">
<title><?= $title ?></title>
<link href='http://fonts.googleapis.com/css?family=Michroma' rel='stylesheet' type='text/css' />
<link type="text/css" rel="stylesheet"
      href="<?= base_url(); ?>css/public.css?refresh=1234565465465465465465465465465456"/>
<link type="text/css" rel="stylesheet" href="<?= base_url(); ?>css/modalbox.css"/>
<link type="text/css" rel="stylesheet" href="<?= base_url(); ?>css/lightbox.css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?= base_url() ?>css/fueradejuego/fueradejuego.css"/>
<?= $_styles ?>
<script src="http://www.google.com/jsapi"></script>
<script>
    google.load("prototype", "1.7.0.0");
    google.load("scriptaculous", "1.9.0");
    window.base_url = '<?=base_url();?>';
</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>
    var jQ = jQuery.noConflict();
    var j = jQuery.noConflict();
</script>
<script type="text/javascript" src="<?= base_url(); ?>js/effects.js?refresh=123456"></script>
<script type="text/javascript" defer="defer" src="<?= base_url(); ?>js/lightbox.js?refresh=123456"></script>
<script type="text/javascript" src="<?= base_url(); ?>js/scripts.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>js/public_ajax.js?refresh=2345678"></script>
<script type="text/javascript" defer="defer" src="<?= base_url(); ?>js/modalbox.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>js/livepipe.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>js/tabs.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
<?= $_scripts ?>
<link rel="alternate" type="application/rss+xml" title="futbolecuador.com - Todas las noticias" href="http://feeds.feedburner.com/futbolecuador/3"/>
<script src='http://Q1MediaHydraPlatform.com/ads/video/unit_desktop_slider.php?eid=47905'></script>	
<style >
      #container_header{
	      position: relative; 
	      margin:50px auto; 
	      width: 100%;
	      height: auto;
      }
      
      #container_content{
      	position: relative; 
      	margin:0 auto; 
      	width: 900px;
      	overflow: hidden;
      }
      
      body {
      	overflow:auto;
      	background: #103149;
      }
      
      .navbar-header {
      text-align: center;
      width: 100%;
      }
      
      #container_content > table{
      width: 100%;
      }
      
      .validation {
		  color: red;
		  float: none;
    	  font-size: 14px;
		}
		
		
      </style>
</head>
<body onload="MM_preloadImages('<?= $path ?>imagenes/template/public/titulo4b.jpg','<?= $path ?>imagenes/template/public/titulo5b.jpg','<?= $path ?>imagenes/template/public/titulo6b.jpg','<?= $path ?>imagenes/template/public/titulo7b.jpg','<?= $path ?>imagenes/template/public/titulo8b.jpg');initLightbox(); <?= $onload ?>" >
<div id='container_header' >
<div class="navbar-header">
    <a href="http://www.futbolecuador.com/" class="" onclick="ga('send', 'event', 'menu', 'click', 'home');">
    	<img src="http://www.futbolecuador.com/assets/img/logotipo.png" alt="FutbolEcuador" title="Lo mejor del futbol ecuatoriano" />
    </a>
</div>
</div>
<div id='container_content'>
    <table  border="0" align="center" cellpadding="0" cellspacing="0">
        <tr style="background: #ffffff;">
            <td width="226" valign='top'>
                <div
                    id='block_left' style='width: 226px;'>
                    <?= $block_left ?>
                </div>
            </td>
            <td width="514" bgcolor="#FFFFFF" valign='top' align='left'>
                <div id='content' style='width: 514px;'>
                    <?= $content ?>
                </div>
            </td>
            <td width="226" valign='top' >
                <div id='block_right' style='width: 226px;'>
                    <?= $block_right ?>
                </div>
            </td>
        </tr>
    </table>
</div>

<script type="text/javascript">
    adroll_adv_id = "7IEKX4QU7NGODM7RAJE7NN";
    adroll_pix_id = "3ZEKOXB4VRE57G7GJ2DCC5";
    (function () {
        var oldonload = window.onload;
        window.onload = function () {
            __adroll_loaded = true;
            var scr = document.createElement("script");
            var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
            scr.setAttribute('async', 'true');
            scr.type = "text/javascript";
            scr.src = host + "/j/roundtrip.js";
            ((document.getElementsByTagName('head') || [null])[0] ||
                document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
            if (oldonload) {
                oldonload()
            }
        };
    }());
</script>

<script>
    document.getElementsByTagName("BODY")[0].onresize = function() {centrar()};
    document.getElementsByTagName("BODY")[0].onload = function() {centrar2()};    
   </script>
</body>
</html>
