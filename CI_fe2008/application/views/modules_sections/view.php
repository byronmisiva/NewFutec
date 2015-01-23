<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/modulossecciones_add.png','border'=>'0')) ?> <?=anchor('modules_sections/insert/'.$this->uri->segment(3),'Agregar Modulos de Secci&oacute;n')?></li>
    </ul>
	</div>
	<br>
	Sección: <?=$section->name;?>
	<br>
	
	<?php 
	
	$tables[1]="<!-- Central --!>\n <table class='listing' border=1>\n<tr><th colspan='3' style='text-aling:center;'> Modulo Central</th></tr>";
	$tables[2]="<!-- Izquierdo --!>\n  <table class='listing' border=1>\n<tr><th colspan='3' style='text-aling:center;'> Modulo Izquierdo</th></tr>";
	$tables[3]="<!-- Derecho --!>\n  <table class='listing' border=1>\n<tr><th colspan='3' style='text-aling:center;'> Modulo Derecho</th></tr>";
	foreach($query->result() as $row){
		$tables[$row->block].="<tr>\n<td class='actions'>\n";
	    $tables[$row->block].=anchor('modules_sections/position_down/'.$row->msid.'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/arrow_down.png','border'=>'0')), array('title' => 'Abajo'));
	 	$tables[$row->block].=anchor('modules_sections/position_up/'.$row->msid.'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/arrow_up.png','border'=>'0')), array('title' => 'Arriba'));
		$tables[$row->block].="\n</td>\n";
		$tables[$row->block].="<td>$row->mtitle</td>\n";
		$tables[$row->block].="\n<td class='actions'>\n";
		$tables[$row->block].=anchor('modules_sections/update/'.$row->msid.'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));
	 	$tables[$row->block].=anchor('modules_sections/confirm_delete/'.$row->msid.'/'.$this->uri->segment(3).'/'.$row->msposition.'/'.$row->name.'/'.$row->mtitle, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));
		$tables[$row->block].="\n</td>\n";
	 	$tables[$row->block].="</tr>\n";
	 
	 
	}
	$tables[1].="</table>\n";
	$tables[2].="</table>\n";
	$tables[3].="</table>\n";
	 
	 ?>
	 <table border=0>
	 <tr class='altrow'>
	 <td valign='top'><?=$tables[2];?></td>
	 <td valign='top'><?=$tables[1];?></td>
	 <td valign='top'><?=$tables[3];?></td>
	 </tr>
	 </table>

	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/seccion.png','border'=>'0')) ?> <?=anchor('sections','Secciones')?></li>
    </ul>
	</div>
</div>