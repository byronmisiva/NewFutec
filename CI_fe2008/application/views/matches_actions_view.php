<div id="admin">
	<?=$from?>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/alineacion.png','border'=>'0'))?> <?=anchor('lineups/index/'.$this->uri->segment(3)  ,'Alineación ')?></li>
    </ul>
	</div>
	<table class='listing' border=1 width=99%>
	
	<tr>
		<td colspan=2>
			<div id="marcador">
			</div>
		</td>
	</tr>
	
	<tr>
		<td width='50%'>
			<div id="estado">
			</div>
		</td>
		<td width='50%' align='center'>
			<div id='cronometro' style='text-align: center;'>
				
				
				
			</div>
		</td>
	</tr>
	<tr>
		<td width=50%><center><b>Equipo:</b>
			<select id="team_id" name="team_id" onChange="open_form('<?=base_url();?>matches_actions/changes_insert/<?=$this->uri->segment(3).'/'?>','contenido','team_id','2','<?='/'.$this->uri->segment(4)?>','<?='/'.$this->uri->segment(5)?>');">
				<?php foreach($query6->result() as $row ):
					  	  echo '<option value='.$row->id.'>'.$row->name.'</option>';	
				    endforeach;?>
			</select></center>
		</td>
		<td rowspan=4 width=50%  valign=top>
			<div id="lista">
			</div>
		</td>
		
	</tr>
	
	<tr> 
		<td width=50% valign=top>
		<div  style="display: block;padding:10px;" id="div6" >
			<ul id="tabmenu" >
				<li><a id="tab2" class="" href="#" onClick="open_form('<?=base_url();?>matches_actions/changes_insert/<?=$this->uri->segment(3).'/'?>','contenido','team_id','2','<?='/'.$this->uri->segment(4)?>','<?='/'.$this->uri->segment(5)?>');">Cambios</a></li>
				<li><a id="tab1" class="" href="#" onClick="open_form('<?=base_url();?>matches_actions/goals_insert/<?=$this->uri->segment(3).'/'?>','contenido','team_id','1','<?='/'.$this->uri->segment(4)?>','<?='/'.$this->uri->segment(5)?>');">Goles</a></li>
				<li><a id="tab3" class="" href="#" onClick="open_form('<?=base_url();?>matches_actions/cards_insert/<?=$this->uri->segment(3).'/'?>','contenido','team_id','3','<?='/'.$this->uri->segment(4)?>','<?='/'.$this->uri->segment(5)?>');">Tarjetas</a></li>
			</ul>
		<div id="contenido">
		</div>
		</div>
	</td>
	</tr>
	
	<tr>
		<td width=50%  valign=top>
		
		<div id="accion">
		</div>
		
	</td></tr>
	<tr>
		<td><center>
			<?="<form action='".base_url()."matches/update_referees' id='update_referees' method='post'>";
			  echo form_hidden('match_id',$this->uri->segment(3));?>
			<table>
				<tr>
					<td><b>&Aacute;rbitro Central:</b></td>
					<td><?php echo form_dropdown('referee_id_central', $ref, $ar[0]->rc, "id='ridc' onChange='referee_update(\"update_referees\")'");?></td>
				</tr>
				<tr>
					<td><b>&Aacute;rbitro Linea 1:</b></td>
					<td><?php echo form_dropdown('referee_id_line1', $ref, $ar[0]->r1, "id='rid1' onChange='referee_update(\"update_referees\")'");?></td>
				</tr>
				<tr>
					<td><b>&Aacute;rbitro Linea 2:</b></td>
					<td><?php echo form_dropdown('referee_id_line2', $ref, $ar[0]->r2, "id='rid2' onChange='referee_update(\"update_referees\")'");?></td>
				</tr>
				<tr>
					<td><b>&Aacute;rbitro Suplente:</b></td>
					<td><?php echo form_dropdown('referee_id_sub', $ref, $ar[0]->rs, "id='rids' onChange='referee_update(\"update_referees\")'");?></td>
				</tr>
			</table>
			<?="</form>"?>
		</center></td>
	</tr></table>	
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/partido.png','border'=>'0')) ?> <?=anchor('matches/index/'.$mt[0]->group_id,'Partido')?></li>
    </ul>
	</div>
</div>
<script type="text/javascript">
		table_view('<?=base_url();?>matches_actions/matches_table_view','lista','<?=$this->uri->segment(3)?>','<?=$this->uri->segment(4)?>','<?=$this->uri->segment(5)?>');
	    action_view('<?=base_url();?>matches_actions/actions_insert','accion','<?=$this->uri->segment(3)?>','<?='/'.$this->uri->segment(4)?>','<?='/'.$this->uri->segment(5)?>');
		state_view('<?=base_url();?>matches_actions/matches_state_view','<?=$this->uri->segment(3)?>','lista','<?=$this->uri->segment(4)?>','<?=$this->uri->segment(5)?>');
		score_view('<?=base_url();?>matches_actions/score_view','<?=$this->uri->segment(3)?>','<?=$this->uri->segment(4)?>','<?=$this->uri->segment(5)?>');
		timer_view('<?=base_url();?>','cronometro','<?=$this->uri->segment(3)?>');
</script>