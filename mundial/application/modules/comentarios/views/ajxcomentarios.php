<?php foreach ($comentarios as $row){?>
	<div class="col-md-1"><?php echo $row->tiempo?></div>
	<div class="col-md-11"><?php echo $row->comentario?></div>
<?php }?>