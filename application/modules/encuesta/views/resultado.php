 <style>
		.cancha{background-image:url('<?php echo base_url()?>formacion/cancha.jpg?refresh=654321');width:550px;height:780px;background-position:center;margin:0 auto}.opcion{padding:5px;color:#fff;font-size:12px;line-height:10px;font-weight:700}.opcion>img{text-align:center;cursor:pointer}.arquero{padding-top:25px;margin-bottom:80px}.defensa,.delantero,.medio{margin:80px 15px 80px}.jugador{list-style:none;color:#666;text-align:left;cursor:pointer;margin-top:0;margin-bottom:0;height:35px;line-height:15px;font-size:15px;padding-top:10px}.jugador:hover{color:#000}.btn-carga-lista,.btn-success{display:none; margin:0 auto;}.modal-dialog{width:260px}ul{padding-left:10px}@media (max-width:600px){.modal-dialog{margin:25% auto}.cancha{background-position:center top;background-repeat:no-repeat;background-size:100% auto;height:560px;margin:0 auto;width:100%}.arquero{margin-bottom:10px;padding-top:10px}.opcion>img{width:40px;margin:0 auto}.defensa,.delantero,.medio{margin:50px 15px}}@media (max-width:321px){.opcion>img{width:35px}.cancha{height:480px}.defensa,.delantero,.medio{margin:40px 15px}}
	</style>  

	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-12">
			<div class="cancha"></div>
		</diV>
	</div>
  <script type="text/javascript" >
    var setFormacion = "<?php echo $configuracion->formacion?>";
	var setTeam = "<?php echo $configuracion->id_team?>";
	var setEncuesta = "<?php echo $configuracion->id?>";  
	var formacion;
	
	var lista;	
	setTimeout(function(){
	  $(".cancha").load("<?php echo base_url()?>encuesta/getSistemaFormacionResultado/"+setFormacion);
	  $(".espera").hide();
	}, 2000);
  </script>  


