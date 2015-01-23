<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li><?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Inicio')?></li>
        <li><?=img(array('src'=>'imagenes/icons/images.png','border'=>'0')) ?> <?=anchor('galleries','Galerias')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?=form_open('galleries/update/'.$this->uri->segment(3));	  
	echo form_hidden('id',$query->id);?>
	<table>
	<tr><td>Nombre:</td><td><?=form_input('name',$query->name);?>*</td></tr>
	<tr><td>Id de Flickr:</td><td><?=form_input('flickr',$query->flickr);?>*</td></tr>
	<tr><td colspan='2'><?=form_submit('submit', 'Actualizar');?></td>
	</table>
	<?=form_close();?>
</div>