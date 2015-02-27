<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<!-- <meta name="viewport" content="width=560, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>css/fe_magazine_posiciones.css" />
	<style>
		body{
			padding:0;margin:0;							
			font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
			height:560px;
			overflow:hidden;			
		}
		
		.fondo{
			/*width:100%;
			height: 43px;
			background-image: url('<?=base_url()?>imagenes/magazine/BARRA_MARCADOR2.png');
			background-size:100% 100%;*/
			
			 background-attachment: scroll;
		     background-clip: border-box;
		     background-color: transparent;
		     background-image: none;
		     background-origin: padding-box;
		     background-position: 0 0;
		     background-repeat: repeat;
		     height: 43px;
		     width: 100%; 
		     color:#000;
		}
		
		
		
		#contenido{
			width:103%;
			height:650px;
			overflow:hidden;			
		}	
	</style>	
	 <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/nicescroll/jquery.nicescroll.min.js" ></script>
		<script>
		  j = jQuery.noConflict();
		  j(document).ready(function() {
				var nice = j("html").niceScroll();  // The document page (body)
			    j("#contenido").niceScroll({touchbehavior:true}); // First scrollable DIV
			  });
		</script> 
</head>

<body>
<div id="contenido">
	<table width="100%" >
		<tr class="fondo">
			<td style="color: white; line-height: 43px;text-align:center;width:10%;">#</td>
			<td class="info" style="width:50%;color:#A0A0A0;">Equipo</td>
			<td class="info" style="text-align:center;width:12%;color:#A0A0A0;">PJ</td>
			<td class="info" style="text-align:center;width:12%;color:#A0A0A0;">PTS</td>
			<td class="info" style="text-align:left;width:15%;padding-left:4%;color:#A0A0A0;">GD</td>			
		</tr>
	<?foreach ( $tabla as  $key => $row ){?>
		<tr class="fondo">
			<td style="color: #000; line-height: 43px;text-align:center;width:10%;"><?=( $key + 1 )?></td>
			<td class="info" style="width:50%;color: #000;"><?=$row['name']?></td>
			<td class="info" style="text-align:center;width:12%;color: #000;"><?=$row['pj']?></td>
			<td class="info" style="text-align:center;width:12%;color: #000;"><?=$row['points']?></td>
			<td class="info" style="text-align:left;width:15%;padding-left:4%;color: #000;"><?=$row['gd']?></td>			
		</tr>				
	<?}?>
	</table>
</div>
</body>
</html>