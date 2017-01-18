<?php 
$idtipo = $this->uri->segment(2);
$tipo = array("noticia", "nuestrosembajadores", "lavoz", "zonafe", "equipo", "masleido");
if (in_array($idtipo, $tipo)) { ?>
<style>  .cerrar{display:none;float:right;z-index:100;height:auto;width:100%;text-align:right;padding-right:15px;cursor:pointer}</style>
 <!-- /1022247/NEW_FE_Video_VAST -->
<div id="div-gpt-ad-1457102356654-0" style="height: 0px; width: 670px; min-height: 10px; float: left; display: block;overflow:hidden;">
	<div class="cerrar" onclick="cerrarVideo()">CERRAR</div>
	<script type="text/javascript">googletag.cmd.push(function(){googletag.display('div-gpt-ad-1457102356654-0');});</script>
</div>
<script type="text/javascript">
function cerrarVideo(){
    $(".cerrar").hide();
    $("#div-gpt-ad-1457102356654-0").animate({height:'0px'},1000);
    $("#div-gpt-ad-1457102356654-0").html("");
};

setTimeout(function(){
    $(".cerrar").hide();
    $("#div-gpt-ad-1457102356654-0").html("");
    $("#div-gpt-ad-1457102356654-0").animate({height:'0px'},1000);
},101000);
var sw=0;
function activarVideo(){
    if(sw==0){
            if(screen.width>600){
                setTimeout(function(){ 
                    $("#div-gpt-ad-1457102356654-0").animate({height:'370px'},1000);
                    $(".cerrar").show();
                    
                }, 2100);
                return 1;
                
            }else{
                $("#div-gpt-ad-1457102356654-0").hide();
                $("#div-gpt-ad-1457102356654-0").html("");
                return 0;
            }
        sw=sw+1;
    }
};
</script>

<?php } ?>
