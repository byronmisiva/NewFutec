<?php 
$idtipo = $this->uri->segment(2);
$tipo = array("noticia", "nuestrosembajadores", "lavoz", "zonafe", "equipo", "masleido");
if (in_array($idtipo, $tipo)) { ?>
<style>
.cerrar{float:right;z-index:100;height:auto;width: 100%;text-align: right;padding-right: 15px;cursor:pointer;}
</style>
 <!-- /1022247/NEW_FE_Video_VAST -->
<div id='div-gpt-ad-1457102356654-0' style='height:auto; width:670px;min-height: 10px;float: left;'>
	<div class="cerrar" onclick="cerrarVideo()">CERRAR</div>
	<script type='text/javascript'>
		googletag.cmd.push(function() { googletag.display('div-gpt-ad-1457102356654-0'); });
	</script>
	
</div>

<script type='text/javascript'>
	function cerrarVideo(){
		$("#div-gpt-ad-1457102356654-0").toggle();
	};	

	setTimeout(function(){ 
		$("#div-gpt-ad-1457102356654-0").toggle();
	}, 45000);	
</script>
<?php }?>