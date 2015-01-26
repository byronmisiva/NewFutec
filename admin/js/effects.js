var menu = new Array();
var cal = new Array();

var next=0;
var espera=10;
var rotativo;

function menu_open(name,family){
	menu=$$('div.'+family);
	new Effect.BlindDown(name,{ duration:0.4, beforeStart: close(menu)});
};

function close(menu){
	menu.each(function(s) {
	  $(s).hide();
	});
};

function menu_open2(name){
	if(menu[name]==true){
		new Effect.BlindUp(name, { duration: 0.3 });
		menu[name]=false;
	}
	else{
		new Effect.BlindDown(name, { duration: 0.3 });
		menu[name]=true;
	}
};

function calendar_open(name){
	new Effect.toggle(name, 'blind', { duration: 0.3 });
	return false;
};

function rotativa_appear(name){
	clearInterval(rotativo);
	new Effect.Appear(name);
	for(var i=0;i<6;i++){
		if(name != 'content_'+i){
			new Effect.Fade('content_'+i);
			var el = document.getElementById('mn_'+i);
			el.className= "";
		}
		else{
			var el = document.getElementById('mn_'+i);
			el.className= "selected";
			next=i;
			rotativo=setInterval("cambiar()",espera*1000);
		}
	}
};

function twit_change(name){
	clearInterval(rotativo);
	new Effect.Appear(name);
	for(var i=0;i<5;i++){
		if(name != i){
			new Effect.Fade('content_'+i);
			var el = document.getElementById('mn_'+i);
			el.className= "";
		}
		else{
			var el = document.getElementById('mn_'+i);
			el.className= "selected";
			next=i;
			rotativo=setInterval("cambiar()",espera*1000);
		}
	}
};

function transfers_appear(name,num){
	for(var i=0;i<num;i++){
		if(name != 't_'+i){
			new Effect.BlindUp('t_'+i);
		}
	}
	new Effect.BlindDown(name);
};


function inicio(){	
	rotativo=setInterval("cambiar()",espera*1000);
}

function banner_appear(name){
    new Effect.Appear(name);
}

function banner_hide(name){
    $(name).hide();
}



function cargar_rotativa(accion,contenedor,callback,parametro){
	new Ajax.Updater(contenedor, accion,
					{
						evalScripts:true,
						parameters: {  
						    differentiator: parametro  
						},
						onComplete: function(request){							
							callback();
						}
					});
}

function cambiar(){
	if(next==5)
		next=0;
	else
		next=next+1;
	rotativa_appear('content_'+next);
}
/////
var SlideScoreboards = (function () {	

	var preloadImages, starSlide, bindEvents, $pagePrev,$pageNext, $heightVentana, $pageHeight, $delayTime, $slideName, intervalSlideScoreboards, topVentana;		

	preloadImages = function( imgs ){
		imageObj = new Image();		    
	    for( var i = 0; i < imgs.length; i++ ){
		    imageObj.src = window.base_url + imgs[i];
	    }
	};


	init = function(options) {

		// Default settings
		settings = {				
			pagePrevSelector         : 'SlideScoreboards_pagePrev',
			pageNextSelector         : 'SlideScoreboards_pageNext',
			heightVentana			 : 0,
			pageHeight				 : 0,
			delayTime                : 0,
			slideName                : ''		
		};

		// Override defaults with arguments
		Object.extend(settings, options);			
					
		$pagePrev         = $(settings.pagePrevSelector);
		$pageNext         = $(settings.pageNextSelector);	
		$heightVentana    = settings.heightVentana;	
		$pageHeight       = settings.pageHeight;	
		$delayTime        = settings.delayTime;	
		$slideName        = $(settings.slideName);		
		bindEvents();
		stopInterval();
		starInterval();		
	};

	starSlide = function(){		
		topVentana = Math.abs( parseInt( $slideName.getStyle('top') ) );			
		topVentana = ( topVentana + $pageHeight ) %  $heightVentana;		
		draw();		
	};

	bindEvents = function() {
		$pagePrev.observe('click', function(e) {
			stopInterval();				
			topVentana = Math.abs( parseInt( $slideName.getStyle('top') ) );
			topVentana = ( ( topVentana - $pageHeight ) < 0 ) ?  $heightVentana - $pageHeight : ( topVentana - $pageHeight ) % $heightVentana;			
			draw();
			starInterval();		
		});

		$pageNext.observe('click', function(e) {
			stopInterval();
			topVentana = Math.abs( parseInt( $slideName.getStyle('top') ) );
			topVentana = ( topVentana + $pageHeight ) %  $heightVentana;
			draw();
			starInterval();				
		});
	};

	draw =  function () {		
		$slideName.setStyle( { 'top' : ( topVentana * -1 )+"px", 'position' : 'relative' } );
	};

	starInterval = function(){
		intervalSlideScoreboards = setInterval( starSlide, $delayTime );
	};

	stopInterval = function(){
		clearInterval( intervalSlideScoreboards );
	};				
	
	module = {
		init		  : init,
		preloadImages : preloadImages,
		starSlide     : starSlide
	};	
	return module;				
}());




///