<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/mediosecciones_add.png','border'=>'0')) ?> <?=anchor('media_sections/insert/'.$this->uri->segment(3),'Agregar Medios de Secci&oacute;n')?></li>
    </ul>
	</div>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>MEDIA</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->mname;?></td>
	 <td class="actions">
	 <?=anchor('media_sections/update/'.$row->msid.'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('media_sections/confirm_delete/'.$row->msid.'/'.$this->uri->segment(3).'/'.$row->name.'/'.$row->mname, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	 </td>
	 </tr>
	 <?php endforeach;?>
	 </table>
	<br>
    <?php echo $this->pagination->create_links();?>
	<br>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/seccion.png','border'=>'0')) ?> <?=anchor('sections','Secciones')?></li>
    </ul>
	</div>
</div>