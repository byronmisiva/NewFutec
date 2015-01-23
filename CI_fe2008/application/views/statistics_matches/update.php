<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li><?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Inicio')?></li>
        <li><?=img(array('src'=>'imagenes/icons/statistics.png','border'=>'0')) ?> <?=anchor('statistics_match','Estadisticas de Partido')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?=form_open($this->model->name.'/update/'.$this->uri->segment(3));?>
	<?=form_hidden('id',$query->id);?>
	<?=form_hidden('match_id',$query->match_id);?>
	<table>
	<tr><td><?=form_textarea('text',$query->text);?></td></tr>
	<tr><td align="right"><?=form_submit('submit', 'Actualizar');?></td>
	</table>
	<?=form_close();?>
</div>