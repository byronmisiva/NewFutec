<?
$x=0;
foreach ( $scores as $key => $value ){
	if($x<=9){
?>
	<div  class="fondo"  style="background-image:url('<?=base_url().$fondo_partido?>');background-repeat: no-repeat;background-position:center 0;background-size:80% 55px;   " 
	onclick="BorrarIntervalos();ajax_update_script('scoreboards_live','<?=base_url()?>scoreboards/game_all_magazine/<?=$value->id?>/ExMpLKey123/<?=$this->uri->segment(4);?>','<?=base_url()?>');Effect.toggle('matches_back', 'appear');" >		
		<div class="logoLocal">
			<img src="<?=base_url().$value->hshield?>" alt="<?=$value->hsname?>" class="logoL" />
		</div>
		
		<div class="contenedorResultados">
			<div class="resultados1" >
				<div class="nombreLocal"><?=$value->hsname?></div>	
				<div class="marcador"><?=($value->result != '') ? $value->result : "0&nbsp;-&nbsp;0"?></div>
				<div class="nombreVisita" ><?=$value->asname?></div>
				
			</div>
			<div class="resultados2">
				<div class="parteLocal"><?=$value->championship?></div>	
				<div id="cronos_<?=$key?>" class="parteCentro"><?=$states[$value->state]?></div>
				<div class="parteVisita" ><?=utf8_encode( ucwords( strftime( "%B %d - %H:%M", strtotime( $value->date_match ) ) ) );?></div>
			</div>
		</div>
		
		<div class="logoVisita">
			<img src="<?=base_url().$value->ashield?>" alt="<?=$value->asname?>" class="logoV" />
		</div>														
	</div>
	<script type="text/javascript">		 
		clearInterval(intervalDetails);  	
		intervalDetails = setTimeout( function(){
			new Ajax.Updater('scoreboards_live', '<?=base_url()?>scoreboards/list_matches_magazine/ExMpLKey123/<?=$this->uri->segment(4);?>', { evalScripts : true} );
			}, 60000 );		
	</script>	
	<?if( $value->state == "1" || $value->state == "3" || $value->state == "5" || $value->state == "6" ){?>
		<script type='text/javascript'>
			inicia_cronos(<?=$hora_cache?>, '<?=$value->minute_match?>', '<?=$key?>' );
		</script>	
	<?}
	}
	$x++;
}?>
