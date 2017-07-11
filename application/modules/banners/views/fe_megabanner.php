<!--
FE_NEW_HYPERBANNER -->
<div id='FE_NEW_HYPERBANNER' style="width:980px; height:auto;" class="hidden-xs hidden-sm banner-cinta">
    <script type='text/javascript'>GA_googleFillSlot("FE_NEW_HYPERBANNER");</script>
</div>

<!--<div id="div-gpt-ad-1464883876542-0" 
     style='height:50px; width:980px;' style="width:980px;  height:auto;" class="hidden-xs hidden-sm banner-cinta">
	<script type='text/javascript'>
		googletag.cmd.push(function() { googletag.display('div-gpt-ad-1464883876542-0'); });
	</script>
</div>-->

<script type="text/javascript">
     function see_fold2(estado) {
        if (estado == 'on') {
            //agrandamos a 200 el banner
            $('#div-gpt-ad-1464883876542-0').css("height", "200px");
           var contenedorCinta= $("#div-gpt-ad-1464883876542-0");    
           var iframeCinta= contenedorCinta[0].lastChild["childNodes"][0];
           $(iframeCinta).attr("height","200px");
            
        } else {
            //disminuimos a 50
            $('#div-gpt-ad-1464883876542-0').css("height", "50px");
            var contenedorCinta = $("#div-gpt-ad-1464883876542-0");    
            var iframeCinta = contenedorCinta[0].lastChild["childNodes"][0];
            $(iframeCinta).attr("height","50px");
        }
    }
</script>

<script type="text/javascript">
    /*function see_fold2(estado) {	
        if (estado == 'on') {
		$(".banner-cinta").css("height", "200px");
        } else {
		$(".banner-cinta").css("height", "50px");
        }
    }*/
</script>
