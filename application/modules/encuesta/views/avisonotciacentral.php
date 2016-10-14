<?php 
$link = base_url.'site/noticia/'.$this->contenido->_urlFriendly ($principal[0]->title).'/'.$principal[0]->id;
?>
<div class="row">
	<div class="col-lg-6">
		<div class="row">
		<a href="<?php echo $link?>">
			<div class="col-lg-12 text-center" style="background-color:#fff; padding-top: 10px">
				<img src="<?php echo "http://www.futbolecuador.com/".$principal[0]->thumb300?>" width="100%" />
			</div>
			<div class="col-lg-12" style="background-color:#fff; ">
				<h2 style="font-size: 18px;color:#000;"><?php echo $principal[0]->title?>"</h2>
			</div>
			<div class="col-lg-12" style="background-color:#fff;color:#000; ">
				<p style="color:#000;"><?php echo $principal[0]->subtitle?>"</p>
			</div>
			</a>
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

