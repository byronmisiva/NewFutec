<?php 
foreach($stories as $row):
?>
<div id='story' onClick='window.location="<?=base_url();?>stories/publica/"+<?=$row->id;?>;'> 
	<table id='data'>
		<tr>
			<td rowspan='3' class='image' valign='top'>
			<?=img(array('src'=>$row->thumb2,'border'=>'1','alt'=>$row->image_name));?>
			</td>
			<td class='title'><h2>
			<a href='<?=base_url();?>stories/publica/<?=$row->id;?>'>
			<span class='hour'>
			<?
			if(date('d.M.Y')==date('d.M.Y',$row->time))
				echo mdate('%H:%i',$row->time);
			else
				echo ucfirst(strftime('%B %d',$row->time))
			?>
			</span> | <?=strip_tags($row->title);?><?if($this->session->userdata('role')>=3) echo ' | Lecturas: '.$row->reads;?></a></h2></td>
		</tr>
		<tr>
			<td class='subtitle'><?=strip_tags($row->subtitle);?></td>
		</tr>
		<tr>
			<td class='lead'><?=strip_tags($row->lead);?></td>
		</tr>
	</table>
</div>
<?php endforeach;?>