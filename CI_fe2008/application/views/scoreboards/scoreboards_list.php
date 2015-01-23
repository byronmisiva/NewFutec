<?foreach ( $scores as $key => $value ){?>
	<div style="position: relative; top: 0px; left: 0px; width: 731px; height: 60px; cursor: pointer; background-image: url('<?=base_url().$fondo_partido?>'); " onclick="BorrarIntervalos();ajax_update_script('scoreboards_live','<?=base_url()?>scoreboards/game_all/<?=$value->id?>/ExMpLKey123/<?=$this->uri->segment(4);?>','<?=base_url()?>');Effect.toggle('matches_back', 'appear');" >
		
		<div style="position: absolute; top: 0px; left: 5px; width: 60px; height: 60px;">
			<img src="<?=base_url().$value->hshield?>" alt="<?=$value->hsname?>" />
		</div>
		
		<div style="position: absolute; top: 0px; left: 70px; width: 600px; height: 60px;">
			<div style="position: absolute; top: 0px; left: 0px; width: 600px; height: 30px;">
				<div style="position: absolute; top: 0px; left: 0px; width: 250px; height: 30px; line-height: 40px; text-align: center;"><?=$value->hsname?></div>	
				<div style="position: absolute; top: 0px; left: 250px; height: 30px; width: 93px; line-height: 39px; text-align: center; color: #00144F; font-size: 24px;"><?=($value->result != '') ? $value->result : "0&nbsp;-&nbsp;0"?></div>
				<div style="position: absolute; top: 0px; right: 0px; height: 30px; width: 250px; line-height: 40px; text-align: center;" ><?=$value->asname?></div>
			</div>
			<div style="position: absolute; top: 30px; left: 0px; width: 600px; height: 30px; font-size: 13px; color: #C3C3C3; text-shadow: black 0.1em 0.1em 0.2em">
				<div style="position: absolute; top: 0px; left: 0px; width: 240px; height: 20px; text-align: left; padding-left: 5px; padding-top: 10px;"><?=$value->championship?></div>	
				<div id="cronos_<?=$key?>" style="position: absolute; top: 0px; left: 247px; height: 30px; width: 100px; line-height: 30px; text-align: center;"><?=$states[$value->state]?></div>
				<div style="position: absolute; top: 0px; right: 2px; height: 20px; width: 235px; text-align: right; padding-right: 10px; padding-top: 10px;" ><?=utf8_encode( ucwords( strftime( "%B %d - %H:%M", strtotime( $value->date_match ) ) ) );?></div>
			</div>
		</div>
		
		<div style="position: absolute; top: 0px; left: 670px; width: 60px; height: 60px;">
			<img src="<?=base_url().$value->ashield?>" alt="<?=$value->asname?>" />
		</div>														
	</div>
	<script type="text/javascript">	 
	clearInterval(intervalDetails);  	
	intervalDetails = setTimeout( function(){
		new Ajax.Updater('scoreboards_live', '<?=base_url()?>scoreboards/list_matches/ExMpLKey123/<?=$this->uri->segment(4);?>', { evalScripts : true} );
		}, 60000 );		
	</script>
	
	<?if( $value->state == "1" || $value->state == "3" || $value->state == "5" || $value->state == "6" ){?>
		<script type='text/javascript'>
			inicia_cronos(<?=$hora_cache?>, '<?=$value->minute_match?>', '<?=$key?>' );
		</script>	
	<?}
}?>
