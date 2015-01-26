<div id='modulo'>
<table class='noticias_plus' cellpadding="0" cellspacing="0" width="100%">
<tr>
<th>Encuesta</th>
</tr>
</table>

<div id='encuesta'>
<?=$survey->title;?>
<?=form_open('',array('id'=>'survey','name'=>'survey'));?>
<table class='opciones' cellpadding="0" cellspacing="0" width="100%">
<?php

if(count($options)>0){
	foreach($options as $row){
		echo "<tr>\n";
		echo "<td>".form_radio(array('name'=>'option','id'=>'option', 'value'=>$row->id))." $row->title</td>\n";
		echo "</tr>\n";
	}
}
else{
	echo "<tr><td align='center' class='blank'>Aun no existen opciones.</td></tr>";	
}

?>
<tr>
<td class='boton'>
<?=form_button(array('name'=>'vote','content'=>'Votar !!!','class'=>'boton','onClick'=>"vote_survey('option','encuesta','".base_url()."surveys/vote/$survey->id','".base_url()."')"));?>
</td>
</tr>
</table>
<?=form_close();?>
</div>
</div>