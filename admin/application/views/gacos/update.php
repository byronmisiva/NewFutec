<div id="admin">
	<h1><?=$title.$heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/campeonato.png','border'=>'0')) ?> <?=anchor('gacos/index/'.$this->uri->segment(4),'Gaco')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?$row2=$query2->row();?>
	<?=form_open('gacos/update/'.$this->uri->segment(3).'/'.$this->uri->segment(4))?>
	<?=form_hidden('id',$id=$this->uri->segment(3));?>
	<?=form_hidden('championship_id',$this->uri->segment(4));?>
	<table>
	<tr><td>Desde Ronda:</td>
	<td><select name="start_round">
		<?foreach($query->result() as $row):?>
		<option value="<?=$row->id?>" <?if($row->id==$row2->start_round) echo " SELECTED "?>><?=$row->name?></option>
		<?endforeach;?>
	</select></td></tr>
	<tr><td>Hasta Ronda:</td>
	<td><select name="end_round">
		<?foreach($query->result() as $row):?>
		<option value="<?=$row->id?>" <?if($row->id==$row2->end_round) echo " SELECTED "?>><?=$row->name?></option>
		<?endforeach;?>
	</select></td></tr>
	<tr><td>Tipo:</td>
	<td><select id="tipo" name="type" onChange="group_rules('<?=base_url();?>gacos/rules/<?=$this->uri->segment(3).'/'?>','rules','tipo','<?=$row2->num_pass.'_'?>','<?=$row2->num_best.'_'?>','<?=$row2->list?>');">
		<option value="1" <?if(1==$row2->type) echo " SELECTED "?>>Llaves</option>
		<option value="2" <?if(2==$row2->type) echo " SELECTED "?>>Grupos</option>
	</select></td></tr>
	<tr><td>Gol de Visitante:</td><td><input type="checkbox" name="away_gol" value="1" <?if(1==$row2->away_gol) echo 'checked="checked"'?>/></td></tr>	
	<tr><td>Ganadores y Perdedores:</td><td><input type="checkbox" name="win_loser" value="1" <?if(1==$row2->win_loser) echo 'checked="checked"'?>/></td></tr>	
	<tr><td>Ida y Vuelta:</td><td><input type="checkbox" name="home_away" value="1" <?if(1==$row2->home_away) echo 'checked="checked"'?>/></td></tr>	
	</table>
	<div id="rules">
	</div>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" /></td>
	<?="</form>"?>
	<?=form_open('gacos/index/'.$this->uri->segment(4));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?="</form>"?>
	</table>
</div>
<?if($row2->type==2){?>
	<script type="text/javascript">
		group_rules('<?=base_url();?>gacos/rules/<?=$this->uri->segment(3).'/'?>','rules','tipo','<?=$row2->num_pass.'_'?>','<?=$row2->num_best.'_'?>','<?=$row2->list?>')
	</script>
<?}?>