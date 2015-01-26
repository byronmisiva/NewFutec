	<h1><?php echo $title.' '.$heading;?></h1>
	<br><br>
	<table border=1>
	<tr>
	<td>ID</td>
	<td>TIEMPO</td>
	<td>ACCI&Oacute;N</td>
	<td>TIEMPO DE JUEGO</td>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr>
	 <td><?php echo $row->id;?></td>
	 <td><?php echo $row->time;?></td>
	 <td><?php if($row->action==0) echo "Stop"; else echo "Play";?></td>
	 <td><?php if($row->play_time==1) echo "Primero";
	 		   if($row->play_time==2) echo "Segundo";
	 		   if($row->play_time==3) echo "Extra 1";
	 		   if($row->play_time==4) echo "Extra 2";?></td>
	 <td><?php echo anchor('timers/timers_delete/'.$row->id.'/'.$this->uri->segment(3), 'Borrar')?></td>
	 <td><?php echo anchor('timers/timers_vupdate/'.$row->id.'/'.$this->uri->segment(3), 'Actualizar')?></td>
	 </tr>
	 <?php endforeach;?>
	 </table>
	<br>
    <?php echo $this->pagination->create_links();?>
	<br>
	<?php echo anchor('timers/timers_vinsert'.'/'.$this->uri->segment(3),'Ingresar');?><br>
	<?php $row=$query2->result(0);
		  echo anchor('matches/index/'.$row[0]->group_id,'Partidos')?>