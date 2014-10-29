//carga de twiter

!function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
    if (!d.getElementById(id)) {
        js = d.createElement(s);
        js.id = id;
        js.src = p + "://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);
    }
}(document, "script", "twitter-wjs");


//declaracion variables video
var streamId = "2000";
var useHLS = false;
var embedPath = "http://origin.elcanaldelfutbol.com/embed";
var turnOnDVR = true;
if (useHLS == true) {
    turnOnDVR = false;
}


$(function () {
    if ($('#foo2').length > 0) {
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
    }

    if ($('#foo4').length > 0) {
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
    }

    if ($('#foo5').length > 0) {
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
    }
    if ($('#foo6').length > 0) {
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
    }


    //muestra el player en el caso que se tenga vieo
    if ($("#player").length > 0) {
        $.getScript(embedPath + "/embed.js");
        $("video_wrapper").width('633');
        $("video_wrapper").height('390');
    }
    if ($('#foo-noticai-rotativa').length > 0) {
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
    }

    $(".minigaleria").colorbox({rel: '.minigaleria' });
    $(".thgaleria").colorbox({rel: '.thgaleria' });

    $(".thvideo").colorbox({rel: '.thgaleria', iframe: true, innerWidth: 640, innerHeight: 390});


    $('#header-tabs a').click(function (e) {
        $('.list_carousel_header').hide();
        $($(this).attr("href") + '-carrousel').show();
    })
    if ($("#claqueta").length > 0) {
        $('#claqueta').click(function (e) {
            $('#claqueta').hide();
            ga('send', 'event', 'claqueta', 'click', 'nav-buttons');

        })
    }
    if ($(".pantallacompleta").length > 0) {
        $('.pantallacompleta').click(function (e) {
            ga('send', 'event', 'pantallacompleta', 'click', 'nav-buttons');

        })
    }

    if ($(".videomovil").length > 0) {
        $('.videomovil').click(function (e) {
            ga('send', 'event', 'videomovil', 'click', 'nav-buttons');

        })
    }
    //se inicializan el carrousel para solo mostrar el primero
    $('.list_carousel_header').hide();
    $('.list_carousel_header:first').show();

    //
    $('.carousel').carousel({interval: false});

    Brasil2014(baseUrl);


})


var Brasil2014 = (function (baseUrl) {

    var loadView = function (content, method, data) {
        $.ajax({
            cache: true,
            type: "POST",
            url: baseUrl + method,
            data: { 'data': data },
            success: function (response) {
                $(content).html(response);
            }
        });
    };

    loadView('#proximo-partido', 'partidos/viewProximoPartido/TRUE', { });

    var setEvent = function (content, method) {

        /*if( $('#modul_ranking_goleadores').length ){
         $('#modul_ranking_goleadores').click( function() {
         setInterval(
         function() {
         loadView( '#' + this.id, baseUrl + 'jugadores/viewRankingGoleadores/TRUE', { 'id' : 8, 'name' : 'luis' } );
         }, 5000 );
         } );
         }*/

        $('#proximo-partido').click(function () {
            loadView('#proximo-partido', 'partidos/viewProximoPartido/TRUE', { });
        });


    };

    setEvent();


    module = {
        loadView: loadView
        /*newInstance     : newInstance,
         setSignedRequest: setSignedRequest,
         getUserFbData   : getUserFbData,
         getSignedRequest: getSignedRequest*/
    };
    return module;
});


//quitar pajarito

jQuery(function ($) {
//Colocamos el contenido de nuestro iframe en el div content
    $('#iframe').load(function () {
        $('#content').text($('#iframe').contents().find('html').html());
        $(this).contents().find('.ic-twitter-badge').css({'display': 'none'});
    });


    $(".menu-partidos").click(function () {
        $("#partidos-carrousel").show();
        $("#goles-carrousel").hide();
        //  $(".especiales-carrousel").hide();
    })
    $(".menu-goles").click(function () {
        $("#partidos-carrousel").hide();
        $("#goles-carrousel").show();

//        $(".especiales-carrousel").hide();
    })

});