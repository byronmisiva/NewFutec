<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/equipo.png','border'=>'0')) ?> <?=anchor('teams','Equipos')?></li>
    </ul>
	</div>
	<br>
	<div id="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open_multipart('teams/update/'.$this->uri->segment(3)); 
	$row=current($query->result());
	echo form_hidden('id',$row->id);?>
	<table class='formulario'>
	<tr><td width='60%'>
		<table>
		<tr>
			<td><div id='required'>*</div></td>
			<td class='label'>Nombre:</td>
			<td><input type="text" name="name" value="<?=$row->name?>" /></td>
		</tr>
		<tr>
			<td><div id='required'>*</div></td>
			<td class='label'>Pa&iacute;s:</td>
			<td><?php echo form_dropdown('country', $countries, $row->country);?></td>
		</tr>
		<tr>
			<td><div id='required'>*</div></td>
			<td class='label'>Continente:</td>
			<td><?php echo form_dropdown('continent', $continents, $row->continent);?></td>
		</tr>
		<tr>
			<td><div id='required'>*</div></td>
			<td class='label'>Nombre Corto:</td>
			<td><input type="text" name="short_name" value="<?=$row->short_name?>"/></td>
		</tr>
		
		<tr>
			<td><div id='required'>*</div></td>
			<td class='label'>Fundaci&oacute;n:</td>
			<td>
				<input type="text" name="foundation" value="<?=$row->foundation?>" readonly>
				<input type="button" value="Cal" onclick="displayCalendar(document.forms[0].foundation,'yyyy/mm/dd',this,true)">
				<input type="button" value="Reset" onclick="document.forms[0].foundation.value='';">
			</td>
		</tr>
		
		<tr>
			<td><div id='required'>*</div></td>
			<td class='label'>Presidente:</td>
			<td><input type="text" name="president"  value="<?=$row->president?>"/></td>
		</tr>
		<tr>
			<td><div id='required'>*</div></td>
			<td class='label'>Web Oficial:</td>
			<td><input type="text" name="site"  value="<?=$row->site?>"/></td>
		</tr>
		<tr>
			<td><div id='required'>*</div></td>
			<td class='label'>Web No Oficial:</td>
			<td><input type="text" name="non_site"  value="<?=$row->non_site?>"/></td>
		</tr>
		
		<tr>
			<td><div id='required'>*</div></td>
			<td class='label'>Entrenador:</td>
			<td><input type="text" name="couch" value="<?=$row->couch?>" /></td>
		</tr>
		<tr>
			<td><div id='required'>*</div></td>
			<td class='label'>Estadio:</td>
			<td>
			<select name="stadia_id">
				<option value=''>ninguno</option>
			<?php foreach($query2->result() as $row2): ?> 
				<option value="<?=$row2->id;?>" 
				<?if($row2->id==$row->stadia_id)
					echo "SELECTED";?>			
				><?=$row2->name;?></option>
			<?php endforeach;?>
			</select></td>
		</tr>
		<tr>
			<td><div id='required'></div></td>
			<td class='label'>Twitter:</td>
			<td><input type="text" name="twitter" value="<?=$row->twitter?>"/></td>
		</tr>
		<tr>
			<td><div id='required'></div></td>
			<td class='label'>Foto de Equipo:</td>
			<td><input type="file" name="team_pic" /></td>
		</tr>
		<tr>
			<td><div id='required'></div></td>
			<td class='label'>Escudo:</td>
			<td><input type="file" name="shield" /></td>
		</tr>
		<tr>
			<td><div id='required'></div></td>
			<td class='label'>Thumb Escudo:</td>
			<td><input type="file" name="thumb_shield" /></td>
		</tr>
		<tr>
			<td><div id='required'></div></td>
			<td class='label'>Escudo Inverso:</td>
			<td><input type="file" name="shield2" /></td>
		</tr>
		<tr>
			<td><div id='required'></div></td>
			<td class='label'>Thumb Escudo Inverso:</td>
			<td><input type="file" name="thumb_shield2" /></td>
		</tr>
		<tr>
			<td><div id='required'></div></td>
			<td class='label'>Mini Escudo:</td>
			<td><input type="file" name="mini_shield" /></td>
		</tr>
		<tr>
			<td><div id='required'></div></td>
			<td class='label'>Uniforme:</td>
			<td><input type="file" name="shirt" /></td>
		</tr>
		<tr>
			<td><div id='required'></div></td>
			<td class='label'>Uniforme Alterno:</td>
			<td><input type="file" name="shirt2" /></td>
		</tr>
		<tr>
			<td><div id='required'></div></td>
			<td class='label'>Mini Uniforme:</td>
			<td><input type="file" name="mini_shirt" /></td>
		</tr>
	</table>
	<br>
		<table>
		<tr><td><input type="submit" name="submit" value="Actualizar" value=/></td>
		<?php echo "</form>"?>
		<?php echo form_open('teams');?>
		<td><input type="submit" value="Cancelar"></td></tr>
		<?php echo "</form>"?>
		</table>
	</td>
	<td width='50%' valign='top' align='center'>
		<table cellpadding="0" cellspacing="3">
			<tr>
				<td colspan="2" valign="top" style="border: 1px solid black;">
					<div id='imagen'>
					<center>
						Equipo:<br>
						<?=img(array('src'=>$row->team_pic,'border'=>'0','width'=>'200'));?>
					</center>
					</div>
				</td>
			</tr>
			<tr>
				<td width='50%' valign="top" style="border: 1px solid black;">
					<div id='imagen'>
					Escudo:<br>
					<?=img(array('src'=>$row->shield,'border'=>'0','width'=>'100'));?>
					</div>
				</td>
				<td width='50%' valign="top" style="border: 1px solid black;">
					<div id='imagen'>
					Escudo Inverso:<br>
					<?=img(array('src'=>$row->shield2,'border'=>'0','width'=>'100'));?>
					</div>
				</td>
				
			</tr>
			<tr>
				<td width='50%' valign="top" style="border: 1px solid black;">
					<div id='imagen'>
					<?=img(array('src'=>$row->thumb_shield,'border'=>'0','width'=>'50'));?>
					</div>
				</td>
				<td width='50%' valign="top" style="border: 1px solid black;">
					<div id='imagen'>
					<?=img(array('src'=>$row->thumb_shield2,'border'=>'0','width'=>'50'));?>
					</div>
				</td>
			</tr>
			<tr>
				<td width='50%' valign="top" style="border: 1px solid black;">
					<div id='imagen'>
					Mini-Escudo:<br>
					<?=img(array('src'=>$row->mini_shield,'border'=>'0','width'=>'50'));?>
					</div>
				</td>
				<td width='50%' valign="top" style="border: 1px solid black;">
					<div id='imagen'>
					Mini-Uniforme:<br>
					<?=img(array('src'=>$row->mini_shirt,'border'=>'0','width'=>'20'));?>
					</div>
					
				</td>
			</tr>
			<tr>
				<td width='50%' valign="top" style="border: 1px solid black;">
					<div id='imagen'>
					<center>
						Uniforme:<br>
						<?=img(array('src'=>$row->shirt,'border'=>'0','width'=>'150'));?>
					</center>
					</div>
				</td>
				<td width='50%' valign="top" style="border: 1px solid black;">
					<div id='imagen'>
					<center>
						Uniforme Alterno:<br>
						<?=img(array('src'=>$row->shirt2,'border'=>'0','width'=>'150'));?>
					</center>
					</div>
				</td>
			</tr>
		</table>
	</td>
	</tr>
	</table>
</div>