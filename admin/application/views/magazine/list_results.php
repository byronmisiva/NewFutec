<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=550, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	
	<style>
		body{
			padding:0px;
			margin:0px;
			width: 550px;				
			font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;			
		}
		#contenido{
			width: 550px;
			color: white;
		}
	</style>
</head>

<body>
	<div id="contenido">
			<div style="float: left; width: 550px;">			
				<?foreach ( $partidos as  $key => $row ){?>	
					<?if ( $row->result!= "" ){?>			
						<div style="float: left; width: 550px; font-size: 18pt; background-image: url('<?=base_url()?>imagenes/magazine/BARRA_MARCADOR2.png'); background-repeat: no-repeat;">										
							<div style="float: left; width: 550px; line-height: 43px; text-align: center; font-weight: bold; font-size: 14pt; "><?=utf8_encode( ucwords( strftime( "%A, %d de %B", strtotime( $row->date_match ) ) ) );?></div>				
							<div style="float: left; width: 550px; line-height: 43px; text-align: center; font-size: 15pt;"><?=$row->hname." <span style='font-weight: bold; font-size: 18pt;'>". $row->result." </span>".$row->aname?></div>														
						</div>	
					<?}?>			
				<?}?>				
			</div>
	</div>
</body>

</html>



