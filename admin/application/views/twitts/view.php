<div id="admin">
	<h1><?=$title;?></h1>
	<div class="formulario">
    	<form id='form_in' action="<?=base_url();?>twitts/insert">
    		<fieldset style='margin-top:20px; width:90%'>
		    	<legend>Nuevo Ingreso</legend>
			    <table>
				    <tr>
				    	<td>*</td>
				    	<td>Tipo:</td>
				    	<td>
				    	<select id="element" name="element" onchange="AJX_updater('elementos_twitts','<?=base_url();?>twitts/get_elements/' + this.options[this.selectedIndex].value);">
							<?php foreach($types as $key=>$row): ?> 
								<option value="<?=$key;?>"<?php if(set_value('in')==$key) echo " SELECTED "?>><?=$row;?></option>
							<?php endforeach;?>
						</select>
				    	</td>
				    </tr>
				    <tr>
				    	<td>*</td>
				    	<td>Elemento:</td>
				    	<td>
				    	<div id='elementos_twitts'>
				    		<select id="element_id" name="element_id" disabled>
						
							</select>
						</div>
				    	</td>
				    </tr>
				    <tr>
				    	<td colspan=3>
				    	<input type="button" name='submit' id='submit' value="Ingreso" onClick="submit_form('listado','form_in')" disabled>
				    	</td>
				    </tr>
			    </table>
		  </fieldset>
    	</form>
	</div>
	<div id='listado'>
		<table class='listing' border=1>
		<tr>
		<th>TIPO</th>
		<th>ELEMENTO</th>
		<th></th>
		</tr>
		 <?php foreach($results as $row):?>
		 <tr class='altrow'>
		 <td><?php echo $row->name;?></td>
		  <td><?php echo $row->element_name;?></td>
		 <td class="actions">
		  <?=anchor('twitts/delete/'.$row->id, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'AJX_updater(\'listado\',\''.base_url().'twitts/delete/'.$row->id.'\'); return false;'));?>
		 </td>
		 </tr>
		 <?php endforeach;?>
		</table>
	</div>
	<br>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Inicio')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/news.png','border'=>'0')) ?> <?=anchor('stories','Noticias')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/image.png','border'=>'0')) ?> <?=anchor('images','Imagenes')?></li>
    </ul>
	</div>
</div>