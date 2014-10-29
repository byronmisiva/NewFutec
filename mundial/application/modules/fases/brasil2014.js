$(function () {
    $('#foo2').carouFredSel({
        auto: false,
        prev: '#prev2',
        next: '#next2',
        mousewheel: true,
        swipe: {
            onMouse: true,
            onTouch: true
        }, items: 6
    });
    $('#foo4').carouFredSel({
        auto: false,
        prev: '#prev4',
        next: '#next4',
        mousewheel: true,
        swipe: {
            onMouse: true,
            onTouch: true
        }, items: 6
    });
    $('#foo6').carouFredSel({
        auto: false,
        prev: '#prev6',
        next: '#next6',
        mousewheel: true,
        swipe: {
            onMouse: true,
            onTouch: true
        }, items: 6
    });
    $('#foo5').carouFredSel({
        auto: false,
        prev: '#prev5',
        next: '#next5',
        mousewheel: true,
        swipe: {
            onMouse: true,
            onTouch: true
        }, items: 6
    });

    $('#foo-noticai-rotativa').carouFredSel({
        auto: false,
        prev: '#prev3',
        next: '#next3',
        mousewheel: true,
        swipe: {
            onMouse: true,
            onTouch: true
        },
        items: 1,
        auto: {
            pauseOnHover: 'resume'
        },
        scroll: {
            fx: "fade",
            event: "click"
        }
    });

    $(".minigaleria").colorbox({rel: '.minigaleria' });
    $(".thgaleria").colorbox({rel: '.thgaleria' });

    $(".thvideo").colorbox({rel: '.thgaleria', iframe: true, innerWidth: 640, innerHeight: 390});

    $('#header-tabs a').click(function (e) {
        $('.list_carousel_header').hide();
        $($(this).attr("href") + '-carrousel').show();
    })

    //se inicializan el carrousel para solo mostrar el primero
    $('.list_carousel_header').hide();
    $('.list_carousel_header:first').show();

    Brasil2014(baseUrl); 
0})




var Brasil2014 = (function( baseUrl ) {

	var loadView = function( content, method, data ) {
		$.ajax({
			cache :true,
    		type: "POST",
    		url: baseUrl+method,
    		data: { 'data' :  data },
    		success: function( response ) {
    			$( content ).html( response );
    		}
		});
	};

    loadView( '#proximo-partido',   'partidos/viewProximoPartido/TRUE', { } ); 

	var setEvent = function( content, method ) {

		/*if( $('#modul_ranking_goleadores').length ){
			$('#modul_ranking_goleadores').click( function() {
				setInterval(
						function() {
							loadView( '#' + this.id, baseUrl + 'jugadores/viewRankingGoleadores/TRUE', { 'id' : 8, 'name' : 'luis' } );
						}, 5000 );
			} );
		}*/
        
   $('#proximo-partido').click( function() {
                            loadView( '#proximo-partido',   'partidos/viewProximoPartido/TRUE', { } );        
            } );
          
       
	};

	setEvent();


	module = {
		loadView         	: loadView,
		/*newInstance     : newInstance,
		setSignedRequest: setSignedRequest,
		getUserFbData   : getUserFbData,
		getSignedRequest: getSignedRequest*/
	};
	return module;
});

