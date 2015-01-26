<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link type="text/css" rel="stylesheet" href="<?=base_url()?>css/fe_magazine_secundario.css" />
<script>
	var nice2 = j("html").niceScroll();  // The document page (body)
	j("#comentario_en_vivo").niceScroll({touchbehavior:true});	  
</script>

<style>

.contenedorPrincipal{
		position: absolute; 
		top:25px; left: 0; 
		width: 99%; height: 600px;		
		overflow: hidden;	
	}

	.cabecera-gol-local{
		  float: inherit; 
		  width: 98%;
		  height: 17px;		   
		  margin-top: 2px;
		  background-repeat:no-repeat; 
		  padding-left: 2px; 
		  background-size:100%; line-height: 20px;"
		  font-size: 14px;		
		  background-image: url('<?=base_url()?>imagenes/match_center/barra_blanca_titulos.png');
		}
		
		.cabeceraTitular{
			float: left; 
			width: 98%;
			font-size: 14px; 
			margin-top: 2px; 
			background-image: url('<?=base_url()?>imagenes/match_center/barra_blanca_titulos.png'); 
			height: 17px; 
			padding-left: 2px; 
			background-size: 100% 100%; line-height: 20px;
		}
		
		.titulo-suplente-local{
			 float:inherit; 
			 width: 100%;height: 17px; 
			 font-size: 14px; 
			 margin-top: 2px; 
			 background-image: url('<?=base_url()?>imagenes/match_center/barra_blanca_titulos.png'); 
			 padding-left: 2px; background-size: 100% 100%; line-height: 20px;"
		}
		
		.titulo-suplente-visita{
			float:inherit;
			width:97%;
			font-size: 14px; 
			margin-top: 2px;
			background-image: url('<?=base_url()?>imagenes/match_center/barra_blanca_titulos.png'); 
			height: 17px; 
			padding-right: 10px; 
			background-size: 100% 100%; 
			line-height: 20px;
			text-align: right;		
		}
		
		
		.tituloVisita{
			float: inherit; 
			width: 100%;
			height: 17px; 
			font-size: 14px; 
			margin-top: 0 px; 
			background-image: url('<?=base_url()?>imagenes/match_center/barra_blanca_titulos.png'); 
			 padding-right: 2px; 
			background-size: 100% 100%; 
			line-height: 20px; text-align: right;			
		}
		
		.titulo-visita{
			float:inherit; 
			width: 95%;height: 17px; 
			font-size: 14px; 
			margin-top: 2px; 
			background-image: url('<?=base_url()?>imagenes/match_center/barra_blanca_titulos.png');
			padding-right: 2px; 
			background-size: 100% 100%; 
			line-height: 20px; text-align: right;"
		}
		
		.titulo-comentario{
			float: inherit; 
			width: 100%; height: 17px; 
			font-size: 12px; 
			background-image: url('<?=base_url()?>imagenes/match_center/barra_blanca_titulos.png');
			background-size: 100% 100%; margin-top: 3px; margin-bottom: 2px; line-height: 20px;"
		}
</style>
	<div id="matches_back"class="contenedor-volver" onclick="ajax_update_script('scoreboards_live','<?=base_url()?>scoreboards/list_matches_magazine/ExMpLKey123/magazine','<?=base_url()?>');j('#matches_back').show();clearInterval(intervalDetails);BorrarIntervalos();">
				Volver a partidos							
	</div>
<div class="contenedorPrincipal">	
	<!-- BLOQUE DE CABECERA	 -->	
	<div style="background-image: url('<?=base_url().$fondo_partido?>');" class="fondoMarcador">		
		<div class="logoLocal" >
			<img src="<?=$Equipo1['escudo']?>" alt="<?=$Equipo1['nombre']?>" title="<?=$Equipo1['nombre']?>" class="logoL" />
		</div>
		<div class="contenedorResultados" >
			<div  class="resultados1" >
				<div class="nombreLocal" ><?=$Equipo1['corto']?></div>	
				<div class="marcador"><?=$Equipo1['resultado']." - ".$Equipo2['resultado']?></div>
				<div class="nombreVisita"><?=$Equipo2['corto']?></div>
			</div>
			<div class="resultados2" >
				<div class="parteLocal" ><?=$Equipo1['posicion']?></div>	
				<div id="cronos_0" class="parteCentro" ><?=$states[$state]?></div>
				<div class="parteVisita" ><?=$Equipo2['posicion']?></div>
			</div>
		</div>
		
		<div class="logoVisita" >
			<img src="<?=$Equipo2['escudo']?>" alt="<?=$Equipo2['nombre']?>" title="<?=$Equipo2['nombre']?>" class="logoV" />
		</div>														
	</div>	
	<!-- FIN BLOQUE -->
	<div class="contenedorDatos">
	<!-- columna izq (goles, titulares, suplentes) -->	
		<div class="columnaLocal">
			<div class="titulo-Gol-Local">
				<div class="cabecera-gol-local" >
				 	Goles
				</div>
				<div class="golesLocal">
				 	<?php
				 	foreach ( $Equipo1['Alineacion'] as $row_alineacion ){
				 		if( count( $row_alineacion['jugador']['acciones'] ) > 0 ) {
				 			foreach ( $row_alineacion['jugador']['acciones'] as $row_acciones ){				 				
				 				if( $row_acciones['tipo'] == 'gol' ){?>
				 					<div style="float: left; width: 80%; height: 15px; line-height: 15px;">				 					
					 					<div style="float: left;">
					 						<?=$row_alineacion['jugador']['nombre']?>
					 					</div>	
					 					<div style="float: right;">
					 						<?=$row_acciones['minuto']?>'
					 					</div>
				 					</div>	 									 					
				 				<?}				 				
				 			}	
				 		}
				 	}?>
				</div>				
			</div>		
			<div class="titularesLocal">
				<div class="cabeceraTitular">
				 	Titulares
				</div>
				<div class="nombre-Titulares-Local">
				 	<?php
				 	foreach ( $Equipo1['Alineacion'] as $row_alineacion ){				 		
					 	if( $row_alineacion['jugador']['titular'] ) {?>
					 		<div style="float:inherit; ; width: 100%; height: 15px; line-height: 15px;">
					 			<div style="float: left;">
					 				<?=$row_alineacion['jugador']['nombre']?>					 				
					 			</div>				 			
					 			<?foreach ( $row_alineacion['jugador']['acciones'] as $row_acciones ){?>
					 				<div style="float: right;padding-right: 5px;">
						 				<?if( $row_acciones['tipo'] != 'gol' ){?>			 						
						 					<div style="float: left;">
						 						<img style="border: none; padding: 0px; margin: 0px;" alt="<?=$row_acciones['img_title']?>" src="<?=$row_acciones['imagen']?>" title="<?=$row_acciones['img_title']?>">
						 					</div>		 									 					
						 				<?
						 				}?>
						 			</div>				 				
					 			<?}?>
					 		</div>
					 	<?}?>					 	
				 	<?}?>
				</div>
			</div>	
			<div class="suplentesLocal">
				<div class="titulo-suplente-local">
				 	Suplentes
				</div>
				<div class="nombreSuplentesLocal">
				 	<?php
				 	foreach ( $Equipo1['Alineacion'] as $row_alineacion ){				 		
					 	if( !$row_alineacion['jugador']['titular'] ) {?>
					 		<div style="float:inherit; width: 100%; height: 15px; line-height: 15px;">
					 			<div style="float: left;">
					 				<?=$row_alineacion['jugador']['nombre']?>
					 			</div>				 			
					 			<?foreach ( $row_alineacion['jugador']['acciones'] as $row_acciones ){?>
					 				<div style="float: right;">
						 				<?if( $row_acciones['tipo'] != 'gol' ){?>			 						
						 					<div style="float: left;">
						 						<img title="<?=$row_acciones['img_title']?>" style="border: none; padding: 0px; margin: 0px;" alt="<?=$row_acciones['img_title']?>" src="<?=$row_acciones['imagen']?>">
						 					</div>		 									 					
						 			<?}?>
						 			</div>				 				
					 			<?}?>
					 		</div>	
					 	<?}?>					 	
				<?}?>
				</div>
			</div>
		</div>
		<!-- fin bloque -->
		<!-- bloque central -->
		<div class="contenedorCentral">
		 	<div class="texto-Centro">
				<div style="float: left; width: 100%; padding-top: 5px;">
					<?=$copa?>			
				</div>	
				<div style="float: left; width: 170px; font-size: 10px; padding-top: 2px;">
					<?=$fecha?>&nbsp;&nbsp;&nbsp;<?=$hora?>			
				</div>
				<div style="float: left; width: 170px; font-size: 10px; text-align: right; padding-top: 5px;height: auto;">					
					<?php 
					if(isset($arbitros[0]->first_name))
						echo $arbitros[0]->first_name.' '.$arbitros[0]->last_name;
					?>
				</div>		
			</div>
			<div class="datos-centro-partido" >
				<div class="ficha-Local">
					<div style="float:inherit; width: 100%; font-size: 12px; margin-top: 5px; padding-left: 10px;">
						Director t&eacute;cnico
					</div>
					<div style="float: inherit; width: 100%; font-size: 10px; margin-bottom: 15px; padding-left: 10px; color: #AEBFC6;">
						<?=$Equipo1['dt']?>
					</div>
					<div style="float: inherit; width: 100%; font-size: 12px; padding-left: 10px;">
						Estrategia
					</div>
					<div style="float: inherit; width: 100%; font-size: 10px; padding-left: 10px; color: #AEBFC6;">
						<?=$Equipo1['estrategia']?>
					</div>					
				</div>
				<div class="ficha-Visita">
					<div style="float: inherit; width: 100%; font-size: 12px; margin-top: 5px; padding-right : 0px;">
						Director t&eacute;cnico
					</div>
					<div style="float: inherit; width: 100%; font-size: 10px; margin-bottom: 15px; padding-right: 0px; color: #AEBFC6;">
						<?=$Equipo2['dt']?>
					</div>
					<div style="float: inherit; width: 100%; font-size: 12px; padding-right: 0px;">
						Estrategia
					</div>
					<div style="float: inherit; width: 100%; font-size: 10px; padding-right: 0px; color: #AEBFC6;">
						<?=$Equipo2['estrategia']?>
					</div>						
				</div>
			</div>		
		
				
			<div class="ficha-uniformes">	
				<div class="uniforme-local" >
					<div class="itulo-uniforme-local">
						Uniformes
					</div>
					<div class="imagen-local">
						<img alt="<?=$Equipo1['nombre']?>" title="<?=$Equipo1['nombre']?>" src="<?=$Equipo1['uniforme']?>" />
					</div>
				</div>
				
				<div class="uniforme-Visita">
					<div class="titulo-uniforme-visita">
						Uniformes
					</div>
					<div class="uni-visita">
						<img alt="<?=$Equipo2['nombre']?>" title="<?=$Equipo2['nombre']?>" src="<?=$Equipo2['uniforme']?>" />
					</div>
				</div>							
			</div>		
						
			<div class="contenedor-comentario">				
				<div class="titulo-comentario">
					Comentarios
				</div>
				<div class="contenido-comentario" id="comentario_en_vivo" >					
					<?foreach ( $AccionesPtd as $row ){?>
						<div  style="float:inherit; width: 99%; border-bottom: dashed 1px #A0B9E1; display:inline-block; vertical-align:top; padding: 5px;">
							<div style="float: left; width: 30px; text-align: center;">
								<img style="vertical-align: middle;" alt="" src="<?=$row['accion']['tipo']?> ">									
							</div>									
							<div style="float: left; width: 30px; text-align: center; color: red;">
								<?=$row['accion']['minuto']?>'									
							</div>
							<div style="float: left; font-size: 10px; width: 95%;">
								<?=$row['accion']['texto']?>									
							</div>
						</div><br>
					<?}?>				
				</div>			 	
			</div>
		</div>				
		<!--columna visita  -->
		 <div class="columnaVisita">
			<div class="golesVisita">
				<div class="titulovisita">
				 	Goles
				</div>
				<div class="goleadorVisita">
				 	<?php
				 	foreach ( $Equipo2['Alineacion'] as $row_alineacion ){
				 		if( count( $row_alineacion['jugador']['acciones'] ) > 0 ) {
				 			foreach ( $row_alineacion['jugador']['acciones'] as $row_acciones ){
				 				if( $row_acciones['tipo'] == 'gol' ){?>
				 					<div style="float: left; width: 178px; padding-right: 2px; height: 15px; line-height: 15px;">
					 					<div style="float: left;">
					 					<?=$row_acciones['minuto']?>'
					 					</div>					 					
					 					<div style="float: right;">
					 					<?=$row_alineacion['jugador']['nombre']?>
					 					</div>
				 					</div>		 							 									 					
				 				<?
				 				}				 				
				 			}			 			
				 			
				 		}
				 	}					
				 	?>
				</div>				
			</div>	
			<div class="contenedor-titularesVisita">
				<div class="titulo-visita">
				 	Titulares
				</div>
				<div class="titularesVisita">
				 	<?php
				 	foreach ( $Equipo2['Alineacion'] as $row_alineacion ){				 		
					 	if( $row_alineacion['jugador']['titular'] ) {?>
				<div
					style="float:inherit;; width: 95%; color: #AEBFC6; font-weight: bold; padding-right: 2px; height: 15px; line-height: 15px;">
					<div style="float: right;">
						<?=$row_alineacion['jugador']['nombre']?>
					</div>
					<?foreach ( $row_alineacion['jugador']['acciones'] as $row_acciones ){?>
					<div style="float:left;">
						<?if( $row_acciones['tipo'] != 'gol' ){?>
						<div style="float: left;">
							<img title="<?=$row_acciones['img_title']?>"
								alt="<?=$row_acciones['img_title']?>"
								src="<?=$row_acciones['imagen']?>">
						</div>
						<?}?>
					</div>
					<?}?>
				</div>
				<?}?>					 	
				 	<?	}?>
				</div>
			</div>	
			<div class="supletesVisita">
				<div class="titulo-suplente-visita" >
				 	Suplentes
				</div>
				<div class="nombresVisita">
				 	<?php
				 	foreach ( $Equipo2['Alineacion'] as $row_alineacion ){				 		
					 	if( !$row_alineacion['jugador']['titular'] ) {?>
					 		<div style="float: inherit; width: 97%; padding-right:2px; height:15px;line-height:15px;">
					 			<div style="float: right;">
					 				<?=$row_alineacion['jugador']['nombre']?>
					 			</div>				 			
					 			<?foreach ( $row_alineacion['jugador']['acciones'] as $row_acciones ){?>
					 				<div style="float: left;">
						 				<?if( $row_acciones['tipo'] != 'gol' ){?>			 						
						 					<div style="float: left;">
						 						<img title="<?=$row_acciones['img_title']?>" alt="<?=$row_acciones['img_title']?>" src="<?=$row_acciones['imagen']?>">
						 					</div>		 									 					
						 				<?}?>
						 			</div>				 				
					 			<?}?>
					 		</div>
					 	<?}?>					 	
				 	<?	}?>
				</div>
			</div>			
		</div>		
	</div>	
</div>

<script type="text/javascript">
	clearInterval(intervalDetails);
	intervalDetails = setTimeout( function(){
		new Ajax.Updater('scoreboards_live', '<?=base_url()?>scoreboards/game_all_magazine/<?=$id?>/ExMpLKey123/<?=$this->uri->segment(5);?>', { evalScripts : true} );
		}, 60000 );
	
	</script>
<?if( $state == "1" || $state == "3" || $state == "5" || $state == "6" ){?>
	<script type='text/javascript'>
		inicia_cronos('<?=$hora_cache?>', '<?=$minute_match?>', 0 );
	</script>	
<?}?>

<script>

</script>