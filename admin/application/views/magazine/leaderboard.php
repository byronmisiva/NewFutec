<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=560, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	
	<style>
		body{
			padding:0px;
			margin:0px;
			width: 560px;				
			font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;			
		}
		#contenido{
			width: 560px;			
		}
	</style>
</head>

<body>

<div id="contenido">	
		<div style="float: left; width: 560px; overflow: hidden;">			
			<?foreach ( $tabla as  $key => $row ){?>				
				<div style="float: left; width: 560px; font-size: 18pt; height: 43px; margin-bottom: 5px; font-weight: bold; background-image: url('<?=base_url()?>imagenes/magazine/BARRA_MARCADOR2.png');">										
					<div style="float: left; width: 40px; height: 43px; color: white; line-height: 43px; padding-left: 10px;"><?=( $key + 1 )?></div>				
					<div style="float: left; width: 320px; height: 43px; color: white; line-height: 43px;"><?=$row['name']?></div>
					<div style="float: left; width: 60px; height: 43px; color: white; line-height: 43px;"><?=$row['pj']?></div>
					<div style="float: left; width: 60px; height: 43px; color: white; line-height: 43px;"><?=$row['points']?></div>
					<div style="float: left; width: 60px; height: 43px; color: white; line-height: 43px;"><?=$row['gd']?></div>										
				</div>				
			<?}?>				
		</div>
</div>

</body>

</html>