<?php 
$turno=rand (0 , 1 );
$url= array("http://push.futbolecuador.com","http://www.futbolecuador.com/fe-magazin");
?>
<style>
.contenedor-anuncio{
	background-color:#f8f8f9;
	border-color:#e6e7e8;
	border-radius:10px;
	margin-top: 10px;
}
</style>
<a href="<?php echo $url[$turno]?>" target="_blank">
<div class="col-md-12 contenedor-anuncio">
<?php if ($turno == 0){?>
	<div class="col-md-4" style="text-align: center;padding-top: 10px; ">
		<img src="<?php echo base_url()?>imagenes/anuncio/alertas.png" >
	</div>
	<div class="col-md-8 ">
			<p><h2>#AlertasFutbolecuador</h2></p>
			<p>Ahora futbolecuador te envía las alertas del fútbol ecuatoriano</p>
			<p>Disponible para IOS y Android. Descárgala aquí.</p>
	</div>
	<?php }else{?>
	<div class="col-md-4" style="text-align: center; padding-top: 10px;">
		<img src="<?php echo base_url()?>imagenes/anuncio/fe-magazine.png" >
	</div>
	<div class="col-md-8">	
			<p><h2>#FEMagazine</h2></p>
			<p>La revista digital de futbolecuador.com</p>
			<p>Disponible para IOS y Android. Descárgala aquí.</p>
	</div>
	<?php }?>
</div>
</a>