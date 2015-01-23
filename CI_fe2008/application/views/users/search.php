<div id=admin>	
	<h1><?php echo $title.$heading;?></h1>
	<br>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/user.png','border'=>'0')) ?> <?=anchor('users','Usuarios')?></li>
    </ul>
    </div>
    <br>
		<?=form_open('users/search/1')?>
		<center>
			Usuario: <input type="text" name="search" value="<?=set_value('search');?>"  size=60/>
			<input type="submit" name="submit" value="Buscar"/>
		</center>
		<?=form_close()?>
	<br>
	<?if($users!=''){
		if($users->num_rows()!=0){?>
	<table class="listing" cellpadding="0" cellspacing="0">
		<tr>
			<th>Apellido</th>
			<th>Nombre</th>
			<th>Nick</th>
			<th class="actions"></th>
		</tr>
	<?foreach($users->result() as $row):?>
		<tr class="altrow">
			<td><?=$row->last_name?></td>
			<td><?=$row->first_name?></td>
			<td><?=$row->nick?></td>
			<td><?=$row->mail?></td>
			<td class="actions">
				 <?=anchor('users/update/'.$row->id, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
				 <?=anchor('users/confirm_delete/'.$row->id,img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 300}); return false;'));?>
				 <?=anchor('users/reset_pass/'.$row->id, img(array('src'=>'imagenes/icons/key.png','border'=>'0')), array('title' => 'Cambiar Clave'));?>
	 		</td>
		</tr>
	<?endforeach;?>
	</table>
	<?	}
		else{
			echo '<center>No existen usuarios</center>';
		}
      }?>
</div>