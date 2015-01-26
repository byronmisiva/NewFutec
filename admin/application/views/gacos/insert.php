<div id="admin">
	<h1><?=$title.$heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/campeonato.png','border'=>'0')) ?> <?=anchor('gacos/index/'.$this->uri->segment(3),'Gaco')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?=form_open('gacos/insert/'.$this->uri->segment(3))?>
	<?=form_hidden('id',$id=0);?>
	<?=form_hidden('championship_id',$this->uri->segment(3));?>
	<table>
	<tr><td>Desde Ronda:</td>
	<td><select name="start_round">
		<?foreach($query->result() as $row):?>
		<option value="<?=$row->id?>" <?if(set_value('start_round')==$row->id) echo " SELECTED "?>><?=$row->name?></option>
		<?endforeach;?>
	</select></td></tr>
	<tr><td>Hasta Ronda:</td>
	<td><select name="end_round">
		<?foreach($query->result() as $row):?>
		<option value="<?=$row->id?>" <?if(set_value('end_round')==$row->id) echo " SELECTED "?>><?=$row->name?></option>
		<?endforeach;?>
	</select></td></tr>
	<tr><td>Tipo:</td>
	<td><select id="tipo" name="type" onChange="group_rules('<?=base_url();?>gacos/rules/<?=$this->uri->segment(3).'/'?>','rules','tipo','_','_','');">
		<option value="1" <?if(set_value('type')==1) echo " SELECTED "?>>Llaves</option>
		<option value="2" <?if(set_value('type')==2) echo " SELECTED "?>>Grupos</option>
	</select></td></tr>
	<tr><td>Gol de Visitante:</td><td><input type="checkbox" name="away_gol" value="1" <?if(set_value('away_gol')==1) echo 'checked="checked"'?>/></td></tr>	
	<tr><td>Ganadores y Perdedores:</td><td><input type="checkbox" name="win_loser" value="1" <?if(set_value('win_loser')==1) echo 'checked="checked"'?>/></td></tr>	
	<tr><td>Ida y Vuelta:</td><td><input type="checkbox" name="home_away" value="1" <?if(set_value('home_away')==1) echo 'checked="checked"'?>/></td></tr>	
	</table>
	<div id="rules">
	</div>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /></td>
	<?="</form>"?>
	<?=form_open('gacos/index/'.$this->uri->segment(3));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?="</form>"?>
	</table>
</div>
<?if(set_value('type')==2){?>
	<script type="text/javascript">
		group_rules('<?=base_url();?>gacos/rules/<?=$this->uri->segment(3).'/'?>','rules','tipo','<?=set_value('num_pass').'_'?>','<?=set_value('num_best').'_'?>','<?=set_value('list')?>')
	</script>
<?}?>