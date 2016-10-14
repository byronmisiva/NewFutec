
<div class="row">
	<div class="col-lg-6">
		<div class="row">
			<div class="col-lg-12" style="background-color:#fff; ">
				<img src="<?php echo "http://www.futbolecuador.com/".$principal[0]->thumb300?>" />
			</div>
			<div class="col-lg-12" style="background-color:#fff; ">
				<h2><?php echo $principal[0]->title?>"</h2>
			</div>
			<div class="col-lg-12" style="background-color:#fff; ">
				<p><?php echo $principal[0]->lead?>"</p>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="row">
			<div class="col-lg-12 text-center">
				<img src="<?php echo base_url()?>imagenes/cronometro/cronometro_grande.png" />
			</div>
		</div>	
		<div class="row">
			<div class="col-lg-12" style="background-color:#fff; ">
				<?php echo $loMasLeido;?>
			</div>
		</div>
	</div>
</div>

