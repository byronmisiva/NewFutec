<?php 
/*echo "<pre>";
var_dump($comentarios);
echo "</pre>";
die;*/
?>
<div class="row separadorTop sin-padding-laterales">
	<div class="col-md-12 cabecera-minuto sin-padding-laterales">
		<div class="flotar_iz minutotitulo">Minuto a Minuto</div>
	</div>
</div>

<div class="row separadorTop sin-padding-laterales" id="partidoMinuto">
	<div class="col-md-12 sin-padding-laterales">
	<div class="row">		  
			<div class="col-md-12  minuto-a-minuto-fecha" id="<?php echo trim(ucfirst(strftime("%b%d",strtotime($registro->fecha))))?>">
		 		<?php echo ucfirst(strftime("%b %d", strtotime($registro->fecha)))?>
			</div>
	</div>	
	
	<div class="panel-heading panel-minute">
		<div class="row minuto-header">
				<div class="col-md-12">		
					<div class="sprite-bandera-<?php echo strtolower($this->partidos->_clearStringGion($registro->nombre_local))?> bandera-calendario">
					</div>
					<div class="nombre-calendario"><?php echo $registro->nombre_local ?></div>
					<div class="marcador-calendario">
						<?php echo $registro->resultado ?> 						
					</div>		
					<div class="right nombre-calendario"><?php echo $registro->nombre_visitante ?></div>
					<div class="right sprite-bandera-<?php echo strtolower($this->partidos->_clearStringGion($registro->nombre_visitante)) ?> bandera-calendario" >
					</div>
					<div class="col-md-12 minuto-horario detalle-calendario">
						<?php echo $registro->nombre_estadio; ?>						
					</div>					
				</div>
				</div>
	</div>	
	
	<div class="row sin-padding-laterales">	
		<div class="col-md-12 sin-padding-laterales ">
			<div class="row">
				<div class="col-md-12 sin-padding-laterales cabecera-minutoaminuto titulo-alinear-izq">
					Comentarios
				</div>
				<div class="col-md-12 sin-padding-laterales comentarios" id="comentarios">				
					<?php foreach ($comentarios as $row){?>
					<div class="row">
						<div class="col-md-1"><?php echo $row->tiempo?></div>
						<div class="col-md-11"><?php echo $row->comentario?></div>
					</div>	
					<?php }?>
					
				</div>
			</div>	
		
		</div>
		
	</div>
		
	<div class="row separadorTop sin-padding-laterales">	
		<div class="col-md-5 col-xs-5 sin-padding-laterales ">
			<div class="row sin-padding-laterales">
				<div class="col-md-12 col-xs-12 sin-padding-laterales cabecera-minutoaminuto">
					<span class="titulo-alinear-izq">Goles</span><span class="titulo-alinear-der"><?php echo $registro->nombre_local ?></span>
				</div>
				<div class="col-md-12 col-xs-12 sin-padding-laterales texto-minuto">
				<?php foreach ($goles_local as $row){?>
					<div class="col-md-10 col-xs-10"><?php echo $row->corto; ?> </div> 
					<div class="col-md-2 col-xs-2"> <?php echo $row->minuto?> </div>				
				<?php }?>					
				</div>
			</div>	
		
		</div>
		<div class="col-md-2 col-xs-2"></div>
		<div class="col-md-5 col-xs-5 sin-padding-laterales ">
			<div class="row">
				<div class="col-md-12 col-xs-12 sin-padding-laterales cabecera-minutoaminuto">
					<span class="titulo-alinear-izq">Goles</span><span class="titulo-alinear-der"><?php echo $registro->nombre_visitante ?></span>
				</div>
				<div class="col-md-12 col-xs-12 sin-padding-laterales texto-minuto">					
					<?php foreach ($goles_visitante as $row){?>
					<div class="col-md-10 col-xs-10"><?php echo $row->corto; ?> </div> 
					<div class="col-md-2 col-xs-2"> <?php echo $row->minuto?> </div>
					<?php }?>
				</div>
			</div>		
		</div>
	</div>
	
	<div class="row separadorTop sin-padding-laterales">	
		<div class="col-md-5 col-xs-5 sin-padding-laterales">
			<div class="row sin-padding-laterales">
				<div class="col-md-12 col-xs-12 sin-padding-laterales cabecera-minutoaminuto">
					<span class="titulo-alinear-izq">Tarjetas <?php echo $registro->nombre_local ?></span>
				</div>
				<div class="col-md-12 col-xs-12 sin-padding-laterales texto-minuto">
				<?php foreach ($tarjetas_local as $row){?>
					<div class="col-md-8 col-xs-8"><?php echo $row->corto; ?> </div> 
					<div class="col-md-2 col-xs-2"> <?php echo $row->minuto?> </div>
					<div class="col-md-2 col-xs-2"> <div class="tarjeta-<?php echo strtolower($row->tipo_tarjeta)?>"></div> </div>				
				<?php }?>
					
				</div>
			</div>
		</div>
		<div class="col-md-2 col-xs-2"></div>
		<div class="col-md-5 col-xs-5  sin-padding-laterales">
			<div class="row sin-padding-laterales">
				<div class="col-md-12 col-xs-12 sin-padding-laterales cabecera-minutoaminuto">
					<span class="titulo-alinear-izq">Tarjetas <?php echo $registro->nombre_visitante ?></span>
				</div>
				<div class="col-md-12 col-xs-12 sin-padding-laterales texto-minuto">					
					<?php foreach ($tarjetas_visitante as $row){?>
					<div class="col-md-8 col-xs-8"><?php echo $row->corto; ?> </div> 
					<div class="col-md-2 col-xs-2"> <?php echo $row->minuto?> </div>
					<div class="col-md-2 col-xs-2"> <div class="tarjeta-<?php echo strtolower($row->tipo_tarjeta)?>"></div> </div>
					<?php }?>
				</div>
			</div>		
		</div>
	</div>
	
	<div class="row separadorTop sin-padding-laterales">		
		<div class="col-md-5 col-xs-5 sin-padding-laterales ">
			<div class="row">
				<div class="col-md-12 col-xs-12 sin-padding-laterales cabecera-minutoaminuto titulo-alinear-izq">
					Alineación <?php echo $registro->nombre_local ?>
				</div>
				<div class="col-md-12 col-xs-12 sin-padding-laterales texto-minuto">
					<?php foreach ($alineacion_local as $row){
						if (strtolower($row->posicion)!="reserva" && strtolower($row->posicion)!="entrenador" ){?>
					<div class="col-md-2 col-xs-12" id="jugador-<?php echo $row->id?>"> </div> 
					<div class="col-md-8 col-xs-8"> <?php echo $row->corto?> </div>
					<div class="col-md-2 col-xs-2"> <?php echo  $row->numero?> </div>
					<?php 
						}
					}?>
				</div>
			</div>
		</div>
		<div class="col-md-2 col-xs-2"></div>
		<div class="col-md-5 col-xs-5 sin-padding-laterales ">
			<div class="row">
				<div class="col-md-12 col-xs-12 sin-padding-laterales cabecera-minutoaminuto titulo-alinear-izq">
					Alineación <?php echo $registro->nombre_visitante ?>
				</div>		
				<div class="col-md-12 col-xs-12 sin-padding-laterales texto-minuto">	
				<?php foreach ($alineacion_visitante as $row){
					if (strtolower($row->posicion)!="reserva" && strtolower($row->posicion)!="entrenador" ){?>
					<div class="col-md-8 col-xs-8"> <?php echo $row->corto?> </div>
					<div class="col-md-2 col-xs-2"> <?php echo  $row->numero?> </div>								
					<div class="col-md-2 col-xs-2" > </div> 					
					<?php }
				}?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row separadorTop sin-padding-laterales">		
		<div class="col-md-5 col-xs-5 sin-padding-laterales ">
			<div class="row">
				<div class="col-md-12 col-xs-12 sin-padding-laterales cabecera-minutoaminuto titulo-alinear-izq">
					Reservas <?php echo $registro->nombre_local ?>
				</div>
				<div class="col-md-12 col-xs-12 sin-padding-laterales texto-minuto">
					<?php foreach ($alineacion_local as $row){
						if (strtolower($row->posicion)=="reserva" && strtolower($row->posicion)!="entrenador" ){?>
					<div class="col-md-2 col-xs-12" id="jugador-<?php echo $row->id?>"> </div> 
					<div class="col-md-8 col-xs-8"> <?php echo $row->corto?> </div>
					<div class="col-md-2 col-xs-2"> <?php echo  $row->numero?> </div>
					<?php 
						}
					}?>
				</div>
			</div>
		</div>
		<div class="col-md-2 col-xs-2"></div>
		<div class="col-md-5 col-xs-5 sin-padding-laterales ">
			<div class="row">
				<div class="col-md-12 col-xs-12 sin-padding-laterales cabecera-minutoaminuto titulo-alinear-izq">
					Reservas <?php echo $registro->nombre_visitante ?>
				</div>		
				<div class="col-md-12 col-xs-12 sin-padding-laterales texto-minuto">	
				<?php foreach ($alineacion_visitante as $row){
					if (strtolower($row->posicion)=="reserva" && strtolower($row->posicion)!="entrenador" ){?>
					<div class="col-md-8 col-xs-8"> <?php echo $row->corto?> </div>
					<div class="col-md-2 col-xs-2"> <?php echo  $row->numero?> </div>								
					<div class="col-md-2 col-xs-2" > </div> 					
					<?php }
				}?>
				</div>
			</div>
		</div>
	</div>
	
</div>
</div>
<script type="text/javascript">
	var accion="<?php echo base_url('site/minutoAminuto-_movi/'.$registro->id)?>"
	var coment="<?php echo base_url('site/ajxcomentario/'.$registro->id)?>"			
	var myVar;
	var cargaContenedor;
	function inicio() {
    	myVar = setTimeout(reloadView, 3500000);
	};

	function comments() {
		cargaContenedor = setInterval(reloadComentario, 5000);
	};

	function limpiarSettime() {
	    clearTimeout(myVar);
	};

	function reloadView(){
		$("#partidoMinuto" ).load(accion);
	};

	function reloadComentario(){
		$("#comentarios" ).load(coment);
	}
	
	
	inicio();	
	comments();


</script>