<div style="position: absolute; top: 0px; left: 0px; width: 755px; height: 600px;">	
	<div style="position: relative; top: 0px; left: 15px; width: 731px; height: 60px; background-image: url('<?=base_url().$fondo_partido?>'); ">
		<div style="position: absolute; top: 0px; left: 0px; width: 60px; height: 60px;" >
			<img src="<?=$Equipo1['escudo']?>" alt="<?=$Equipo1['nombre']?>" title="<?=$Equipo1['nombre']?>" />
		</div>
		<div style="position: absolute; top: 0px; left: 70px; width: 600px; height: 60px;" >
			<div style="position: absolute; top: 0px; left: 0px; width: 600px; height: 30px;" >
				<div style="position: absolute; top: 0px; left: 0px; width: 250px; height: 30px; line-height: 35px; text-align: center;" ><?=$Equipo1['corto']?></div>	
				<div style="position: absolute; top: 0px; left: 250px; height: 30px; width: 93px; line-height: 37px; text-align: center; color: #00144F; font-size: 20px;"><?=$Equipo1['resultado']." - ".$Equipo2['resultado']?></div>
				<div style="position: absolute; top: 0px; right: 0px; height: 30px; width: 250px; line-height: 35px; text-align: center;" ><?=$Equipo2['corto']?></div>
			</div>
			<div style="position: absolute; top: 30px; left: 0px; width: 600px; height: 30px; font-size: 13px; color: #C3C3C3; text-shadow: black 0.1em 0.1em 0.2em" >
				<div style="position: absolute; top: 0px; left: 0px; width: 240px; height: 20px; text-align: left; padding-left: 5px; padding-top: 10px;" ><?=$Equipo1['posicion']?></div>	
				<div id="cronos_0" style="position: absolute; top: 0px; left: 247px; height: 30px; width: 100px; line-height: 30px; text-align: center;" ><?=$states[$state]?></div>
				<div style="position: absolute; top: 0px; right: 2px; height: 20px; width: 240px; text-align: right; padding-right: 10px; padding-top: 10px;" ><?=$Equipo2['posicion']?></div>
			</div>
		</div>
		
		<div style="position: absolute; top: 0px; left: 670px; width: 60px; height: 60px;" >
			<img src="<?=$Equipo2['escudo']?>" alt="<?=$Equipo2['nombre']?>" title="<?=$Equipo2['nombre']?>" />
		</div>														
	</div>	
	
	<div style="position: absolute; top: 60px; left: 0px; width: 755px; height: 540px;">	
		<div style="position: absolute; top: 0px; left: 0px; width: 200px; height: 540px; border-right: solid 1px #67A3BB; ">
			<div style="float: left; width: 190px; height: 110px; padding-left: 10px;">
				<div style="float: left; width: 178px; font-size: 14px; margin-top: 2px; background-image: url('<?=base_url()?>imagenes/match_center/barra_blanca_titulos.png'); height: 17px; padding-left: 2px; background-size: 100% 100%; line-height: 20px;">
				 	Goles
				</div>
				<div style="float: left; width: 178px; margin-top: 2px; color: #AEBFC6; font-weight: bold; font-size: 11px; padding-left: 2px; height: 80px;">
				 	<?php
				 	foreach ( $Equipo1['Alineacion'] as $row_alineacion ){
				 		if( count( $row_alineacion['jugador']['acciones'] ) > 0 ) {
				 			foreach ( $row_alineacion['jugador']['acciones'] as $row_acciones ){				 				
				 				if( $row_acciones['tipo'] == 'gol' ){?>
				 					<div style="float: left; width: 180px; height: 15px; line-height: 15px;">				 					
					 					<div style="float: left;">
					 						<?=$row_alineacion['jugador']['nombre']?>
					 					</div>	
					 					<div style="float: right;">
					 						<?=$row_acciones['minuto']?>'
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
			<div style="position: absolute; top: 110px; left: 0px; width: 190px; height: 215px; padding-left: 10px;">
				<div style="float: left; width: 178px; font-size: 14px; margin-top: 2px; background-image: url('<?=base_url()?>imagenes/match_center/barra_blanca_titulos.png'); height: 17px; padding-left: 2px; background-size: 100% 100%; line-height: 20px;">
				 	Titulares
				</div>
				<div style="float: left; width: 178px; margin-top: 2px; color: #AEBFC6; font-weight: bold; font-size: 11px; padding-left: 2px; height: 185px;">
				 	<?php
				 	foreach ( $Equipo1['Alineacion'] as $row_alineacion ){				 		
					 	if( $row_alineacion['jugador']['titular'] ) {?>
					 		<div style="float: left; width: 180px; height: 15px; line-height: 15px;">
					 			<div style="float: left;">
					 				<?=$row_alineacion['jugador']['nombre']?>					 				
					 			</div>				 			
					 			<?foreach ( $row_alineacion['jugador']['acciones'] as $row_acciones ){?>
					 				<div style="float: right;">
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
			<div style="position: absolute; top: 325px; left: 0px; width: 190px; height: 215px; padding-left: 10px;">
				<div style="float: left; width: 178px; font-size: 14px; margin-top: 2px; background-image: url('<?=base_url()?>imagenes/match_center/barra_blanca_titulos.png'); height: 17px; padding-left: 2px; background-size: 100% 100%; line-height: 20px;">
				 	Suplentes
				</div>
				<div style="float: left; width: 178px; font-size: 11px; margin-top: 2px; color: #AEBFC6; font-weight: bold; padding-left: 2px; height: 185px; overflow: hidden;">
				 	<?php
				 	foreach ( $Equipo1['Alineacion'] as $row_alineacion ){				 		
					 	if( !$row_alineacion['jugador']['titular'] ) {?>
					 		<div style="float: left; width: 180px; height: 15px; line-height: 15px;">
					 			<div style="float: left;">
					 				<?=$row_alineacion['jugador']['nombre']?>
					 			</div>				 			
					 			<?foreach ( $row_alineacion['jugador']['acciones'] as $row_acciones ){?>
					 				<div style="float: right;">
						 				<?if( $row_acciones['tipo'] != 'gol' ){?>			 						
						 					<div style="float: left;">
						 						<img title="<?=$row_acciones['img_title']?>" style="border: none; padding: 0px; margin: 0px;" alt="<?=$row_acciones['img_title']?>" src="<?=$row_acciones['imagen']?>">
						 					</div>		 									 					
						 				<?
						 				}?>
						 			</div>				 				
					 			<?}?>
					 		</div>	
					 	<?}?>					 	
				 	<?	
				 	}					
				 	?>
				</div>
			</div>
		</div>
		<div style="position: absolute; top: 0px; left: 200px; width: 360px; height: 540px;">
			<div style="position: absolute; top: 0px; left: 0px; width: 340px; height: 35px; border-bottom: solid 1px white; padding-bottom: 5px; margin-left: 10px;">
				<div style="float: left; width: 340px; padding-top: 5px;">
					<?=$copa?>			
				</div>	
				<div style="float: left; width: 170px; font-size: 10px; padding-top: 2px;">
					<?=$fecha?>&nbsp;&nbsp;&nbsp;<?=$hora?>			
				</div>
				<div style="float: left; width: 170px; font-size: 10px; text-align: right; padding-top: 5px;">					
					<?php 
					if(isset($arbitros[0]->first_name))
						echo $arbitros[0]->first_name.' '.$arbitros[0]->last_name;
					?>
				</div>		
			</div>
			<div style="position: absolute; top: 45px; left: 0px; width: 360px; height: 80px;">
				<div style="position: absolute; top: 0px; left: 0px; width: 180px; height: 110px; text-align: center; text-align: left; border-right: solid 1px white;">
					<div style="float: left; width: 170px; font-size: 12px; margin-top: 5px; padding-left: 10px;">
						Director t&eacute;cnico
					</div>
					<div style="float: left; width: 170px; font-size: 10px; margin-bottom: 15px; padding-left: 10px; color: #AEBFC6;">
						<?=$Equipo1['dt']?>
					</div>
					<div style="float: left; width: 170px; font-size: 12px; padding-left: 10px;">
						Estrategia
					</div>
					<div style="float: left; width: 170px; font-size: 10px; padding-left: 10px; color: #AEBFC6;">
						<?=$Equipo1['estrategia']?>
					</div>					
				</div>
				<div style="position: absolute; top: 0px; left: 180px; width: 180px; height: 110px; text-align: center; text-align: right;">
					<div style="float: left; width: 170px; font-size: 12px; margin-top: 5px; padding-right : 10px;">
						Director t&eacute;cnico
					</div>
					<div style="float: left; width: 170px; font-size: 10px; margin-bottom: 15px; padding-right: 10px; color: #AEBFC6;">
						<?=$Equipo2['dt']?>
					</div>
					<div style="float: left; width: 170px; font-size: 12px; padding-right: 10px;">
						Estrategia
					</div>
					<div style="float: left; width: 170px; font-size: 10px; padding-right: 10px; color: #AEBFC6;">
						<?=$Equipo2['estrategia']?>
					</div>						
				</div>
			</div>
			<div style="position: absolute; top: 120px; left: 0px; width: 330px; height: 170px; border-bottom: solid 1px white; padding-bottom: 10px; padding-left: 10px; margin-left: 10px;">		
					
				<div style="position: absolute; top: 0px; left: 0px; width: 170px; height: 175px; border-right: 1px solid white; " >
					<div style="float: left; width: 170px; text-align: left;  font-size: 14px; margin-bottom: 5px;">
						Uniformes
					</div>
					<div style="float: left; width: 160px; text-align: center; height: 140px; padding-top: 10px; background-color: white; border-radius: 10px; -ms-border-radius: 10px; -moz-border-radius: 10px; -webkit-border-radius: 10px; -khtml-border-radius: 10px;">
						<img alt="<?=$Equipo1['nombre']?>" title="<?=$Equipo1['nombre']?>" src="<?=$Equipo1['uniforme']?>">
					</div>
				</div>
				
				<div style="position: absolute; top: 0px; left: 180px; width: 170px;  font-size: 14px;">
					<div style="float: left; width: 160px; text-align: right; font-size: 14px; margin-bottom: 5px; padding-right: 10px;">
						Uniformes
					</div>
					<div style="float: left; width: 160px; text-align: center; height: 140px; padding-top: 10px; background-color: white; border-radius: 10px; -ms-border-radius: 10px; -moz-border-radius: 10px; -webkit-border-radius: 10px; -khtml-border-radius: 10px;">
						<img alt="<?=$Equipo2['nombre']?>" title="<?=$Equipo2['nombre']?>" src="<?=$Equipo2['uniforme']?>">
					</div>
				</div>
							
			</div>
			<div style="position: absolute; top: 300px; left: 0px; width: 350px; height: 235px; padding-left: 10px;">				
				<div style="float: left; width: 340px; height: 15px; font-size: 12px; background-image: url('<?=base_url()?>imagenes/match_center/barra_blanca_titulos.png'); height: 17px; background-size: 100% 100%; margin-top: 3px; margin-bottom: 2px; line-height: 20px;">
					Comentarios
				</div>
				<div style="float: left; width: 330px; height: 200px; padding: 5px; overflow-y: scroll; overflow-x: hidden; background-color: #FAFAFA; color: black;">					
					<?foreach ( $AccionesPtd as $row ){?>
						<div style="float: left; width: 320px; border-bottom: dashed 1px #A0B9E1; display:inline-block; vertical-align:top; padding: 5px;">
							<div style="float: left; width: 30px; text-align: center;">
								<img style="vertical-align: middle;" alt="" src="<?=$row['accion']['tipo']?> ">									
							</div>									
							<div style="float: left; width: 30px; text-align: center; color: red;">
								<?=$row['accion']['minuto']?>'									
							</div>
							<div style="float: left; font-size: 11px; width: 260px;">
								<?=$row['accion']['texto']?>									
							</div>
						</div><br>
					<?}?>				
				</div>			 	
			</div>
		</div>
		<div style="position: absolute; top: 0px; left: 560px; width: 200px; height: 540px; border-left : solid 1px #67A3BB;">
			<div style="float: left; width: 190px; height: 110px; padding-left: 10px;">
				<div style="float: left; width: 178px; font-size: 14px; margin-top: 2px; background-image: url('<?=base_url()?>imagenes/match_center/barra_blanca_titulos.png'); height: 17px; padding-right: 2px; background-size: 100% 100%; line-height: 20px; text-align: right;">
				 	Goles
				</div>
				<div style="float: left; width: 180px; margin-top: 2px; height: 80px; font-size: 11px; font-weight: bold; color: #AEBFC6;">
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
			<div style="position: absolute; top: 110px; left: 0px; width: 190px; height: 215px; padding-left: 10px;">
				<div style="float: left; width: 178px; font-size: 14px; margin-top: 2px; background-image: url('<?=base_url()?>imagenes/match_center/barra_blanca_titulos.png'); height: 17px; padding-right: 2px; background-size: 100% 100%; line-height: 20px; text-align: right;">
				 	Titulares
				</div>
				<div style="float: left; width: 180px; margin-top: 2px; font-size: 11px; height: 185px;">
				 	<?php
				 	foreach ( $Equipo2['Alineacion'] as $row_alineacion ){				 		
					 	if( $row_alineacion['jugador']['titular'] ) {?>
					 		<div style="float: left; width: 178px; color: #AEBFC6; font-weight: bold; padding-right: 2px; height: 15px; line-height: 15px;">
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
				 	<?	
				 	}					
				 	?>
				</div>
			</div>	
			<div style="position: absolute; top: 325px; left: 0px; width: 190px; height: 200px; padding-left: 10px;">
				<div style="float: left; width: 178px; font-size: 14px; margin-top: 2px; background-image: url('<?=base_url()?>imagenes/match_center/barra_blanca_titulos.png'); height: 17px; padding-right: 2px; background-size: 100% 100%; line-height: 20px; text-align: right;">
				 	Suplentes
				</div>
				<div style="float: left; width: 180px; margin-top: 2px; height: 185px; font-size: 11px; font-weight: bold; color: #AEBFC6;">
				 	<?php
				 	foreach ( $Equipo2['Alineacion'] as $row_alineacion ){				 		
					 	if( !$row_alineacion['jugador']['titular'] ) {?>
					 		<div style="float: left; width: 178px; padding-right: 2px; height: 15px; line-height: 15px;">
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
				 	<?	
				 	}					
				 	?>
				</div>
			</div>	
		</div>		
	</div>	
</div>
<script type="text/javascript">	   
	clearInterval(intervalDetails);
	intervalDetails = setTimeout( function(){
		new Ajax.Updater('scoreboards_live', '<?=base_url()?>scoreboards/game_all/<?=$id?>/ExMpLKey123/<?=$this->uri->segment(5);?>', { evalScripts : true} );
		}, 60000 );		
</script>
<?if( $state == "1" || $state == "3" || $state == "5" || $state == "6" ){?>
	<script type='text/javascript'>
		inicia_cronos('<?=$hora_cache?>', '<?=$minute_match?>', 0 );
	</script>	
<?}

