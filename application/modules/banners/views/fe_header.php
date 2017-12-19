<!-- FE_HEADER -->
<!--azulmovistar-->
<div style="position: relative;height: 90px;width: 320PX;margin: 0 auto;">
<iframe src="http://www.futbolecuador.com/futbolecuador_html5/loteria/android/index.html" scrolling="no" frameborder="0" style="height: 90px;width: 320PX;"></iframe>
</div>

<div class="fe-header" style="position: absolute;height: 90px;width: 100%;top:0;left:0;"
	 data-ios="https://itunes.apple.com/ec/app/loter%C3%ADa-de-navidad-ecuador/id1320332765?mt=8"
	 data-android="https://play.google.com/store/apps/details?id=com.ec.loteria.loteriadenavidad">
	 </div>

<!--<div id='div-gpt-ad-1383593619381-0' class="respiframe" style="width:100%;height:90px,">
    <script type='text/javascript'>
      googletag.cmd.push(function() { googletag.display('div-gpt-ad-1383593619381-0'); });
    </script>
</div>-->

<script type="text/javascript">
/*function ampliarSeparador(){	
  if(screen.width < 600){
	//$(".separador10-xs").css("margin-top","66px");
	$("#div-gpt-ad-1383593619381-0").css({"height":"50px","overflow":"hidden"});
	var contenedorheader= $("#div-gpt-ad-1383593619381-0");    
      	var iframeHeader=contenedorheader[0].lastChild["childNodes"][0];
      	$(iframeHeader).attr("height","80px");		
  }else{
		$(".separador10-xs").css("margin-top","15px");
	}
}

$(document).ready(function () {
		var contenido = $("#div-gpt-ad-1383593619381-0");		
		if(contenido.length > 0){
		  ampliarSeparador();	
	}	
});

setTimeout(function(){ 
	var contenido = $("#div-gpt-ad-1383593619381-0");
	if(contenido.length > 0){
	  ampliarSeparador();	
	}

 }, 3000);*/

 function getMobileOperatingSystem() {
    var userAgent = navigator.userAgent || navigator.vendor || window.opera;
        if( userAgent.match( /iPad/i ) || userAgent.match( /iPhone/i ) ||               userAgent.match( /iPod/i ) ){
            setTimeout(function(){ 
			 	$(".row.separador10-xs").css("margin-top","105px");
			 }, 1500);
            return 'iOS';             
        }
        else if( userAgent.match( /Android/i ) ){
        	setTimeout(function(){ 
			 	$(".row.separador10-xs").css("margin-top","105px");
			 }, 1500);
            return 'Android';
             
        }else{
            return 'unknown';
        }
    };
    
    var $plat = getMobileOperatingSystem();
    $( document ).ready(function() {
	    $(".fe-header").click(function(){
	    if ($plat == "iOS")
	    {
	     var url = $(this).attr("data-ios");	    		
	     ga('create', 'UA-2423727-1');
		 ga('send', 'event', 'LoteriaNacional', 'iOS');
	     window.open(url,"blank");
	     
	
	    }
	    else
	    {
	     var url = $(this).attr("data-android");
	     ga('create', 'UA-2423727-1');
		 ga('send', 'event', 'LoteriaNacional', 'Android');
	     window.open(url,"blank");
	    }
	   });
	});

</script>
