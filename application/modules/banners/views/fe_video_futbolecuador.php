<?php 
$idtipo = $this->uri->segment(2);
$tipo = array("noticia", "nuestrosembajadores", "lavoz", "zonafe", "equipo", "masleido");
if (in_array($idtipo, $tipo)) { ?>
<style>
.cerrar{position:absolute;right: 0;top:0;width:100px;height: 35px;cursor: pointer;z-index:100;}
</style>
 <!-- /1022247/NEW_FE_Video_VAST -->
<div id='div-gpt-ad-1457102356654-0' style='height:auto; width:670px;min-height: 10px;float: left;'>
	<script type='text/javascript'>
		googletag.cmd.push(function() { googletag.display('div-gpt-ad-1457102356654-0'); });
	</script>
	<div class="cerrar">CERRAR</div>
</div>

<script>
$(document).ready(function(){
	$(".cerrar").click(function(){
		$("#div-gpt-ad-1457102356654-0").toggle();
	});
	
	setTimeout(function(){ 
		$("#div-gpt-ad-1457102356654-0").toggle();;
	}, 400000);
});
	
</script>
<?php }?>