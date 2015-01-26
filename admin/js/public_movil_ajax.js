document.observe("dom:loaded", function() {
	if($('div-gpt-ad-1383593884981-1').getStyle('display') !== "none"){
		$('darkLayer').show();
		$('FE_LOADING').show();
		setTimeout(cleanBlackLayer,15000);
	}
});

function cargarSplash(){
	if($('div-gpt-ad-1383593884981-1').getStyle('display') !== "none"){
		$('darkLayer').show();
		$('FE_LOADING').show();
		setTimeout(cleanBlackLayer,15000);
	}	
};

var cleanBlackLayer = function(){
	  $('FE_LOADING').hide(); 
	  $('darkLayer').hide();
};
