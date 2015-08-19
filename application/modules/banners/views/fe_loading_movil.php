<!-- banner se muestra sobre todo -->
<div id="darkLayer" style="display:none;"  ></div>

<div id="FE_LOADING" style="display:none;"  >
    <!-- FE_LOADING_MOVIL -->
    <div id='div-gpt-ad-1383593884981-1' style='width:320px;height:auto;margin: 0 auto'>
        <div id='closeBanner'>
            <img style="height: 100%;" src='<?=base_url()?>imagenes/public/close_banner.png' />
        </div>
        
    </div>
</div>


<script type="text/javascript">
    setTimeout(function(){ cargarSplash(); }, 2000);
    var myVar =setInterval(function(){ limpiar_fe_loading  () }, 1000);
    function limpiar_fe_loading  (){
        if ($('#div-gpt-ad-1383593884981-1 iframe').length == 0 ) cleanBlackLayer ()
    }
</script>
