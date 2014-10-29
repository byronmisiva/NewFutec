<div class="col-md-12 sin-padding-laterales">
	<div class="row">
	<div class="col-md-12  minuto-a-minuto-fecha"
		id="<?php echo trim(ucfirst(strftime("%b%d",strtotime($registro->fecha))))?>">
	<?php echo ucfirst(strftime("%b %d", strtotime($registro->fecha)))?></div>
	</div>
	
	<div class="row minuto-header margen2">
		<div class="col-md-12 col-xs-12">
			<div class="row">
				<div class="col-md-5  col-xs-5">
					<div class="row">
						<div class="col-md-2 col-xs-4 text-right margen0"><span
							class="sprite-bandera-<?php echo strtolower($this->partidos->_clearStringGion($registro->nombre_local))?>"></span>
						</div>
						<div class="col-md-10 col-xs-8 text-center margen0 " style="color:#095A7C;"><span class="margen5l">
						<?php echo $registro->nombre_local ?></span></div>
						</div>
				</div>
			<div class="col-md-2  col-xs-2 text-center margen0"><?php  echo $registro->resultado ?>
			<?   //todo aumentar cuando el marcador cambia    ?></div>
			<div class="col-md-5  col-xs-5">
				<div class="row">
				<div class="col-md-10 col-xs-8 text-center margen0" style="color:#095A7C;"><span class="margen5l">
						<?php echo $registro->nombre_visitante ?></span></div>			
				<div class="col-md-2 col-xs-4 text-left margen0"><span
					class="right sprite-bandera-<?php echo strtolower($this->partidos->_clearStringGion($registro->nombre_visitante))?>"></span>
				</div>
			</div>
			</div>		
			<div class="col-md-12  col-xs-12 ">
			 <div class="col-md-12 col-xs-12 text-center minuto-horario"><?php echo '<b>' . date("H:m:s",strtotime($registro->fecha)) . '</b> - ' . $registro->nombre_estadio ?>
			</div>  
			</div>
			</div>
		</div>
	</div>
	
	<div class="row sin-padding-laterales">
	<div class="col-md-12 sin-padding-laterales ">
	<div class="row">
	<div class="col-md-12 sin-padding-laterales cabecera-minutoaminuto titulo-alinear-izq" style="color:#095A7C;">
	Comentarios</div>
	<div class="col-md-12 sin-padding-laterales comentarios"
		id="comentarios"><?php foreach ($comentarios as $row){?>
	<div class="row">
	<div class="col-md-1 col-xs-2"><?php echo $row->tiempo?></div>
	<div class="col-md-11 col-xs-10"><?php echo $row->comentario?></div>
	</div>
	<?php }?></div>
	</div>
	
	</div>
	
	</div>
	
	<div class="row separadorTop sin-padding-laterales">
	<div class="col-md-5 col-xs-5 sin-padding-laterales ">
	<div class="row sin-padding-laterales">
	<div class="col-md-12 col-xs-12 sin-padding-laterales cabecera-minutoaminuto">
	<span class="titulo-alinear-izq" style="color:#095A7C;">Goles <?php echo $registro->nombre_local?></span>
	</div>
	<div class="col-md-12 col-xs-12 sin-padding-laterales texto-minuto"><?php foreach ($goles_local as $row){?>
	<div class="col-md-8 col-xs-10"><?php echo $row->corto; ?></div>
	<div class="col-md-4 col-xs-2"><?php echo $row->minuto?></div>
	<?php }?></div>
	</div>
	
	</div>
	<div class="col-md-2 col-xs-2"></div>
	<div class="col-md-5 col-xs-5 sin-padding-laterales ">
	<div class="row">
	<div class="col-md-12 col-xs-12 sin-padding-laterales cabecera-minutoaminuto">
	<span class="titulo-alinear-izq" style="color:#095A7C;">Goles <?php echo $registro->nombre_visitante?></span>
	</div>
	<div class="col-md-12 col-xs-12 sin-padding-laterales texto-minuto"><?php foreach ($goles_visitante as $row){?>
	<div class="col-md-8 col-xs-10"><?php echo $row->corto; ?></div>
	<div class="col-md-4 col-xs-2"><?php echo $row->minuto?></div>
	<?php }?></div>
	</div>
	</div>
	</div>
	
	<div class="row separadorTop sin-padding-laterales">
	<div class="col-md-5 col-xs-5 sin-padding-laterales">
	<div class="row sin-padding-laterales">
	<div
		class="col-md-12 col-xs-12 sin-padding-laterales cabecera-minutoaminuto">
	<span class="titulo-alinear-izq" style="color:#095A7C;">Tarjetas</span></div>
	<div class="col-md-12 col-xs-12 sin-padding-laterales texto-minuto"><?php foreach ($tarjetas_local as $row){?>
	<div class="col-md-8 col-xs-8"><?php echo $row->corto; ?></div>
	<div class="col-md-2 col-xs-2"><?php echo $row->minuto?></div>
	<div class="col-md-2 col-xs-2">
	<div class="tarjeta-<?php echo strtolower($row->tipo_tarjeta)?>"></div>
	</div>
	<?php }?></div>
	</div>
	</div>
	<div class="col-md-2 col-xs-2"></div>
	<div class="col-md-5 col-xs-5  sin-padding-laterales">
	<div class="row sin-padding-laterales">
	<div
		class="col-md-12 col-xs-12 sin-padding-laterales cabecera-minutoaminuto">
	<span class="titulo-alinear-izq" style="color:#095A7C;">Tarjetas</span></div>
	<div class="col-md-12 col-xs-12 sin-padding-laterales texto-minuto"><?php foreach ($tarjetas_visitante as $row){?>
	<div class="col-md-8 col-xs-8"><?php echo $row->corto; ?></div>
	<div class="col-md-2 col-xs-2"><?php echo $row->minuto?></div>
	<div class="col-md-2 col-xs-2">
	<div class="tarjeta-<?php echo strtolower($row->tipo_tarjeta)?>"></div>
	</div>
	<?php }?></div>
	</div>
	</div>
	</div>
	
	<div class="row separadorTop sin-padding-laterales">
	<div class="col-md-5 col-xs-5 sin-padding-laterales ">
	<div class="row">
	<div
		class="col-md-12 col-xs-12 sin-padding-laterales cabecera-minutoaminuto titulo-alinear-izq" style="color:#095A7C;">
	Alineación <?php echo $registro->nombre_local?></div>
	<div class="col-md-12 col-xs-12 sin-padding-laterales texto-minuto"><?php foreach ($alineacion_local as $row){
		if (strtolower($row->posicion)!="reserva" && strtolower($row->posicion)!="entrenador" ){?>
	<div class="col-md-2 col-xs-2"><?php foreach ($cambios_local as $cambio){
		if($cambio->sale_id== $row->jugadores_id){?>
	<div class="sale"></div>
		<?php }
	}
	?></div>
	<div class="col-md-8 col-xs-8"><?php echo $row->corto?></div>
	<div class="col-md-2 col-xs-2"><?php echo  $row->numero?></div>
	<?php
		}
	
	}?></div>
	</div>
	</div>
	<div class="col-md-2 col-xs-2"></div>
	<div class="col-md-5 col-xs-5 sin-padding-laterales ">
	<div class="row">
	<div class="col-md-12 col-xs-12 sin-padding-laterales cabecera-minutoaminuto titulo-alinear-izq" style="color:#095A7C;">
	Alineación <?php echo $registro->nombre_visitante?></div>
	<div class="col-md-12 col-xs-12 sin-padding-laterales texto-minuto"><?php foreach ($alineacion_visitante as $row){
	
		if (strtolower($row->posicion)!="reserva" && strtolower($row->posicion)!="entrenador" ){?>
	<div class="col-md-8 col-xs-8"><?php echo $row->corto?></div>
	<div class="col-md-2 col-xs-2"><?php echo  $row->numero?></div>
	<div class="col-md-2 col-xs-2"><?php foreach ($cambios_visitante as $cambio){						
		if($cambio->sale_id== $row->jugadores_id){?>
	<div class="sale"></div>
		<?php }
	}?></div>
	<?php }
	}?></div>
	</div>
	</div>
	</div>
	
	<div class="row separadorTop sin-padding-laterales">
	<div class="col-md-5 col-xs-5 sin-padding-laterales ">
	<div class="row">
	<div class="col-md-12 col-xs-12 sin-padding-laterales cabecera-minutoaminuto titulo-alinear-izq" style="color:#095A7C;">
	Reservas <?php echo $registro->nombre_local?></div>
	<div class="col-md-12 col-xs-12 sin-padding-laterales texto-minuto"><?php foreach ($alineacion_local as $row){
		if (strtolower($row->posicion)=="reserva" && strtolower($row->posicion)!="entrenador" ){?>
	<div class="col-md-2 col-xs-2"><?php foreach ($cambios_local as $cambio){
		if($cambio->entra_id == $row->jugadores_id){?>
	<div class="entra"></div>
		<?php }
	}?></div>
	<div class="col-md-8 col-xs-8"><?php echo $row->corto?></div>
	<div class="col-md-2 col-xs-2"><?php echo  $row->numero?></div>
	<?php
		}
	}?></div>
	</div>
	</div>
	<div class="col-md-2 col-xs-2"></div>
	<div class="col-md-5 col-xs-5 sin-padding-laterales ">
	<div class="row">
	<div class="col-md-12 col-xs-12 sin-padding-laterales cabecera-minutoaminuto titulo-alinear-izq" style="color:#095A7C;">
	Reservas <?php echo $registro->nombre_visitante?></div>
	<div class="col-md-12 col-xs-12 sin-padding-laterales texto-minuto"><?php foreach ($alineacion_visitante as $row){
		if (strtolower($row->posicion)=="reserva" && strtolower($row->posicion)!="entrenador" ){?>
	<div class="col-md-8 col-xs-8"><?php echo $row->corto?></div>
	<div class="col-md-2 col-xs-2"><?php echo  $row->numero?></div>
	<div class="col-md-2 col-xs-2"" ><?php foreach ($cambios_visitante as $cambio)
	if($cambio->entra_id== $row->jugadores_id){?>
	<div class="entra"></div>
	<?php }?></div>
	<?php }
	}?></div>
	</div>
	</div>
	</div>
	<div class="row separadorTop sin-padding-laterales">
	<div class="col-md-5 col-xs-5 sin-padding-laterales ">
	<div class="row">
	<div
		class="col-md-12 col-xs-12 sin-padding-laterales cabecera-minutoaminuto titulo-alinear-izq" style="color:#095A7C;">
	Entrenador <?php echo $registro->nombre_local?></div>
	<div class="col-md-12 col-xs-12 sin-padding-laterales texto-minuto"><?php foreach ($alineacion_local as $row){
		if ( strtolower($row->posicion)=="entrenador" ){?>
	<div class="col-md-2 col-xs-12" id="jugador-<?php echo $row->id?>"></div>
	<div class="col-md-8 col-xs-8"><?php echo $row->corto?></div>
		<?php
		}
	}?></div>
	</div>
	</div>
	<div class="col-md-2 col-xs-2"></div>
	<div class="col-md-5 col-xs-5 sin-padding-laterales ">
	<div class="row">
	<div class="col-md-12 col-xs-12 sin-padding-laterales cabecera-minutoaminuto titulo-alinear-izq" style="color:#095A7C;">
	Entrenador <?php echo $registro->nombre_visitante?></div>
	<div class="col-md-12 col-xs-12 sin-padding-laterales texto-minuto"><?php foreach ($alineacion_visitante as $row){
		if (strtolower($row->posicion)=="entrenador" ){?>
	<div class="col-md-8 col-xs-8"><?php echo $row->corto?></div>
	
	<div class="col-md-2 col-xs-2"></div>
		<?php }
	}?></div>
	</div>
	</div>
	</div>
	</div>
