<style type="text/css">
	.degradado{
		background: #134C68; /* Old browsers */
		background: -moz-linear-gradient(top,  #134C68,  #2c2c2c); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#134C68), color-stop(99%,#2c2c2c)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  #134C68 0%,#2c2c2c 99%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  #134C68 0%,#2c2c2c 99%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  #134C68 0%,#2c2c2c 99%); /* IE10+ */
		background: linear-gradient(to bottom,  #134C68 0%,#2c2c2c 99%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#134C68', endColorstr='#2c2c2c',GradientType=0 ); /* IE6-9 */	
	}
</style>

<div style="float: left; width: 240px; height: 90px; font-family: Helvetica, sans-serif; color: white;">
	<div class="degradado" style="float: left; width: 240px; height: 20px; cursor: pointer;" onclick="window.open('<?=base_url()?>marcador-en-vivo','targetWindow','titlebar=no;toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=760,height=850') ">
		<div style="float: left; height: 20px; font-family: 'Michroma', sans-serif; line-height: 20px; font-size: 11px; padding-left: 2px;">Marcador en Vivo</div>
		<div style="float: right; height: 20px; font-size: 11px; line-height: 23px; padding-right: 2px;">Final del Partido</div>	 
	</div>
	<div class="degradado" style="float: left; width: 240px; height: 70px; overflow: hidden;">
		<div id="ventana" style="float: left; top: 0px; position: relative;">		
			<?foreach ( $scores as $score ){?>
				<div id="score_<?=$score->id?>" class="scorebords" style="cursor: pointer; float: left; width: 240px; height: 70px;" onclick="window.open('<?=base_url()?>marcador-en-vivo','targetWindow','titlebar=no;toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=760,height=850') ">
					<div style="float: left; width: 240px; height: 20px;">
						<div style="float: left; height: 20px; font-size: 11px; line-height: 20px; padding-left: 2px;"><?=$score->championship?></div>
						<div style="float: right; height: 20px; font-size: 10px; line-height: 20px; padding-right: 2px;"><?=utf8_encode( ucwords( strftime( "%B %d - %H:%M", strtotime( $score->date_match ) ) ) );?></div>						
					</div>
					<div style="float: left; width: 220px; height: 30px; margin-left: 10px;">					
						<div style="float: left; height: 30px; width: 110px; text-align: center;"><img alt="" src="<?=base_url().$score->hthumb?>"></div>					
						<div style="float: left; height: 30px; width: 110px; text-align: center;"><img alt="" src="<?=base_url().$score->athumb?>"></div>
						<div style="position: relative; top: -20px; left: 95px; font-size: 16px; font-weight: bold;"><?=($score->result != '') ? $score->result :  "0&nbsp;-&nbsp;0" ?></div>					
					</div>		
					<div style="float: left; width: 220px; height: 20px; margin-left: 10px; font-size: 12px;">
						<div style="float: left; height: 20px; width: 110px; line-height: 20px; text-align: center;"><?=$score->hsname?></div>					
						<div style="float: left; height: 20px; width: 110px; line-height: 20px; text-align: center;"><?=$score->asname?></div>						
					</div>	
				</div>
			<?}?>				
		</div>
	</div>
	<div id="SlideScoreboards_pagePrev" style="position: absolute; top: 55px; left: 5px; width: 15px; height: 12px; background-image: url('<?=base_url()?>/imagenes/match_center/flecha-izq.png'); cursor: pointer;"></div>
	<div id="SlideScoreboards_pageNext" style="position: absolute; top: 55px; left: 220px; width: 15px; height: 12px; background-image: url('<?=base_url()?>/imagenes/match_center/flecha-der.png'); cursor: pointer;"></div>
</div>
<script type="text/javascript">	
	SlideScoreboards.init( { heightVentana : parseInt( $('ventana').getStyle('height') ), pageHeight : 70, delayTime : 5000, slideName : 'ventana' } );
	SlideScoreboards.preloadImages( <?=$imagenes?> );			
</script>