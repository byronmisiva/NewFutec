<div id='modulo'>
<table class='titulo' cellpadding="0" cellspacing="0" width="100%">
<tr>
<th><?=$title?></th>
</tr>
</table>
</div>

<div id='mas_noticias'>
<?php foreach($noticias as $row):?>
	<div id='noticia'>
		<table class='titulo' cellpadding="0" cellspacing="0" width="100%">
		<tr><td rowspan='4' width='55px' valign='middle'>
		<?=img($row->thumb)?>
		</td>
		<td class='titulo'valign='top'><?=anchor('stories/publica/'.$row->id,$row->title);?></td>
		</tr>
		<tr><td class='subtitulo'><?=$row->subtitle;?></td><tr>
		<tr><td align='right' class='fecha' valign='bottom'><?if($this->session->userdata('role')>=3) echo 'Lecturas: '.$row->reads.' | ';?><?=$row->modified;?></td><tr>
		</table>
	
	</div>
<?php endforeach;?>
</div>
<div id='pagination'>
<?php echo $this->pagination->create_links();?>
</div>