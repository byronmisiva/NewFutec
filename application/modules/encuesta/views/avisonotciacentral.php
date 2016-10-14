<?php 
echo "<pre>";
var_dump($principal[0]);?>

<?php var_dump($principal[0]["title"]);?>


<div class="row">
	<div class="col-lg-6">
		<div class="row">
			<div class="col-lg-12">
				<img src="<?php echo "http://www.futbolecuador.com/".$principal[0]->thumb300?>" />
			</div>
			<div class="col-lg-12">
				<?php $principal[0]["title"]?>"
			</div>
			<div class="col-lg-12">
				<?php $principal[0]["lead"]?>"
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<?php echo $loMasLeido;?>
	</div>
</div>

