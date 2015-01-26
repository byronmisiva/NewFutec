<div id="admin">
<h1><?php echo $title.' '.$heading?></h1>
	<br><div class="actions">
    <ul>
        <li><?=img(array('src'=>'imagenes/icons/user_add.png','border'=>'0')) ?> <?=anchor('users','Usuarios')?></li>
    </ul>
	</div>
	<br>
	<?$tot=$total->row();?>
	<table>
	<tr>
	<td>Usuarios Activados:</td>
	<td style='text-align:right;'><?=$tot->s;?></td>
	</tr>
	<tr>
	<td>Usuarios No Activados:</td>
	<td style='text-align:right;'><?=$tot->n;?></td>
	</tr>
	<tr>
	<td>Total de Usuarios Registrados:</td>
	<td style='text-align:right;'><?=$tot->s+$tot->n;?></td>
	</tr>
	</table>
	<br/>
	<?php echo form_open('users/statistics');?>
	<table>
	<tr>
	<td>Desde:</td><td><input type="text" name="fechaa" value="<?=$fechaa?>" readonly/>*</td>
	<td><input type="button" value="Cal" onclick="displayCalendar(document.forms[0].fechaa,'yyyy-mm-dd',this,true)"></td>
	</tr><tr>
	<td>Hasta:</td><td><input type="text" name="fechah" value="<?=$fechah?>" readonly/>*</td>
	<td><input type="button" value="Cal" onclick="displayCalendar(document.forms[0].fechah,'yyyy-mm-dd',this,true)"></td>
	</tr>
	</table>
	<table>
	<tr><td><input type="submit" name="submit" value="Generar" /></td></tr>
	<?php echo "</form>"?>
	</table>
	<br>
	<?=$graph ;?>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>FECHA</th>
	<th>INGRESOS</th>
	<th>INGRESOS %</th>
	</tr>
	 <?php foreach($stat as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row['date'];?></td>
	 <td><?php echo $row['view'];?></td>
	 <td><?php echo $row['percent'];?></td>
	 </tr>
	 <?php endforeach;?>
	 </table>
	<br>
	
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/encuesta.png','border'=>'0')) ?> <?=anchor('statistics','Estadisticas')?></li>
    </ul>
    </div>
</div>