<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/jugador_add.png','border'=>'0')) ?> <?=anchor('players/insert','Agregar Jugadores')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/jugador_add.png','border'=>'0')) ?> <?=anchor('players/fusion_players','Fusionar Jugadores')?></li>
    </ul>
	</div>
	<div class="validation">
	<ul>
		<?= $this->session->flashdata('image_error'); ?>
		<?= $this->session->flashdata('delete_error'); ?>
	</ul>
	</div>
	
	
	<?//=form_open('newsletters/preview/'.$this->uri->segment(3))?>
		<center>Jugador:<input type="text" id="autocomplete" name="autocomplete" size=30/>
		<input type="button" value="Borrar" onclick="document.forms[0].autocomplete.value='';">
		<?php $atts = array(
              'width'      => '800',
              'height'     => '600',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );

		?></center>
		<div id="autocomplete_choices" class="autocomplete">
		</div>
	<script type="text/javascript">
	new Ajax.Autocompleter("autocomplete", "autocomplete_choices", "<?=base_url()?>players/get_player/",{afterUpdateElement : getSelectionId}); 
	function getSelectionId(text, li) {
		 link='<?=base_url().'players/update/'?>'+li.id;
		 window.location=link;
	}
	</script>
	<?//=form_close();?>
	
	<br/>
	
	<?php 
	 $letters['0']='ABC';
	 $letters['1']='A';
	 $letters['2']='B';
	 $letters['3']='C';
	 $letters['4']='D';
	 $letters['5']='E';
	 $letters['6']='F';
	 $letters['7']='G';
	 $letters['8']='H';
	 $letters['9']='I';
	 $letters['10']='J';
	 $letters['11']='K';
	 $letters['12']='L';
	 $letters['13']='M';
	 $letters['14']='N';
	 $letters['15']='O';
	 $letters['16']='P';
	 $letters['17']='Q';
	 $letters['18']='R';
	 $letters['19']='S';
	 $letters['20']='T';
	 $letters['21']='U';
	 $letters['22']='V';
	 $letters['23']='W';
	 $letters['24']='X';
	 $letters['25']='Y';
	 $letters['26']='Z';?>
	<table class='listing' border=1>
	<tr>
	 	<?php for($i=0; $i<27; $i+=1) {
			echo '<th>';
	 		if($this->uri->segment(3)!=$letters[$i]){
	 			if($letters[$i]!='ABC')
	 				echo anchor('players/index/'.$letters[$i], $letters[$i]);
	 			else
	 				echo anchor('players/index/'.$letters[$i], '#');
	 		}
	 		else{
	 			if($letters[$i]!='ABC')
	 				echo $letters[$i];
	 			else
	 				echo '#';
	 		}
	 		echo '</th>';
	 	}?>
	</tr>
	</table>
	<table class='listing' border=1>
	<tr>
	<th>NOMBRE</th>
	<th>APODO</th>
	<th>NACIMIENTO</th>
	<th>LUGAR</th>
	<th>ALTURA</th>
	<th>POSICI&Oacute;N</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->last_name.' '.$row->first_name;?></td>
	 <td><?php echo $row->nick;?></td>
	 <td><?php echo $row->birth;?></td>
	 <td><?php echo $row->born_place;?></td>
	 <td><?php echo $row->height;?></td>
	 <td><?php echo $row->position;?></td>
	 <td class="actions">
	 	 <?=anchor('players/update/'.$row->id.'/'.$this->uri->segment(3).'/'.$page, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('players/confirm_delete/'.$row->id.'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	 <?=anchor('profiles/index/'.$row->id, img(array('src'=>'imagenes/icons/perfiljugador.png','border'=>'0')), array('title' => 'Profiles'));?>
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
    </ul>
	</div>
</div>