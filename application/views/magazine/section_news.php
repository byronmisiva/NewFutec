<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=651, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	
	<style>
		body{
			padding:0px;
			margin:0px;
			width: 651px;		
			background-color: #363636;	
			font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; 
		}
		#contenido{
			width: 651px;			
		}
	</style>
</head>

<body style='background-color:transparent;'>
<div id='titulo' style='width:100%;height:80px;margin:5px;font-family:Helvetica;font-size:25px;color:white;'><?=$seccion;?></div>
<div id="contenido">

	<?foreach ( $news as $new){?>
		<a href="openwindow-http://www.futbolecuador.com/stories/publica/<?=$new->id?>">
			<div style="float: left; width: 651px; height: 119px; background-image: url('<?=base_url()?>imagenes/magazine/barra_noticias.png'); margin-bottom: 5px; overflow: hidden;">
				<div style="float: left; width: 120px; height: 95px;  background-image: url('<?=base_url().$new->image_id?>'); margin-left: 25px; margin-top: 13px; border-top-right-radius: 10px;	border-bottom-right-radius: 10px; border-bottom-left-radius: 10px; border-top-left-radius: 10px;" ></div>
				<div style="float: left; width: 467px; height: 95px; background-image: url('<?=base_url()?>imagenes/magazine/caja_de_texto.png'); margin-top: 13px; margin-left: 25px;" >
					<div style="float: left; width: 457px; height: 25px; color: white; line-height: 25px; padding-left: 10px;" >
						<?=$new->title?>
					</div>
					<div style="float: left; width: 447px; height: 70px; color: white; padding-left: 10px; font-size: 9pt; padding-right: 10px; padding-top: 0px; overflow: hidden;">
						<?=$new->lead?>
					</div>
				</div>		
			</div>
		</a>
	<?}?>
</div>

</body>

</html>