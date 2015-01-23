<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/prototype/1.6.1/prototype.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/scriptaculous/1.8.2/scriptaculous.js"></script>
	</head>
	<style>
		<?if($equipo==33){?>
			
			div#texto_superior{
				font-family:Arial;
				font-weight:bold;
				font-size:28px;
				color:black;
				text-align:left;
			}
			
			div#texto_inferior{
				font-family:Arial;
				font-size:22px;
				color:black;
				text-align:left;
			}
		
		<?}else{?>
		
			div#texto_superior{
				font-family:Arial;
				font-weight:bold;
				font-size:28px;
				color:white;
				text-align:left;
			}
			
			div#texto_inferior{
				font-family:Arial;
				font-size:22px;
				color:white;
				text-align:left;
			}
		
		<?}?>
	</style>
	<body style="background-color:black;">
	
		
		<!-- Google Code for SIGN UP FUTBOLECUADOR Conversion Page -->
		<script type="text/javascript">
		/* <![CDATA[ */
		var google_conversion_id = 989987323;
		var google_conversion_language = "es";
		var google_conversion_format = "2";
		var google_conversion_color = "ffffff";
		var google_conversion_label = "vWdRCL31wAIQ-4OI2AM";
		var google_conversion_value = 0;
		/* ]]> */
		</script>
		<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
		</script>
		<noscript>
		<div style="display:inline;">
		<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/989987323/?label=vWdRCL31wAIQ-4OI2AM&amp;guid=ON&amp;script=0"/>
		</div>
		</noscript>
		
	
		<center>
			<div style="position:relative; width:700px; height:700px; background-image:url('<?=base_url().'imagenes/newsletter/fondos_confirmation/'.$equipo.'.jpg'?>');">
				<a href="http://www.futbolecuador.com" target="_blank">
					<div style="position:absolute; top:0px; right:0px; width:430px; height:130px; cursor:pointer;">
					</div>
				</a>
				<div id="texto_superior" style="position:absolute; top:140px; left:20px;">
					<?=$nombre?>, gracias por suscribirte<br/>
					al bolet&iacute;n de noticias de<br/>
					futbolecuador.com
				</div>
				
				<div id="texto_inferior" style="position:absolute; top:282px; left:20px;">
					Ya est&aacute;s participando por la camiseta<br/>
					de tu equipo
				</div>
			</div>
		</center>
	</body>
</html>

