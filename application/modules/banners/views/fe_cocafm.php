<div style="width: 240px; margin:auto;" class="hidden-xs hidden-sm">
	<!--<script type="text/javascript" src="http://www.imusicaradios.com.br/go_ccfm/ccfm_embed.js" onload="CocaColaEmbed('ec','true',2,'red','Futbolecuador')"></script>
    <iframe id="ccfmPlayer" style="width: 240px; height:90px;"></iframe>-->
	<iframe id="player-container"></iframe> 
	<script type="text/javascript"> 
	var script = document.createElement("script"); 
	    script.src = "https://www.imusicaradios.com.br/ccfm_player/js/ccfm_player.min_public.js"; 
	    script.onload = script.onreadystatechange = function(){ Player.initEmbed( { 
		embed:"true", 
		url:"futebolecuador", 
		width:240, 
		height:90, 
		country:"ec", 
		autoplay:true, 
		volume:1, 
		bg_color:"#f40009", 
		usecookies:true, 
		container:"player-container", } );
		 }; 
		document.getElementsByTagName("head")[0].appendChild(script); 
</script>


</div>
