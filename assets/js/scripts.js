jQuery(document).ready(function () {
    //sidebar
    $(function() {
        $("img.lazy").lazyload();
    });

    //centrado menu

    $("a.panel-link").click(function(){
        link = $(".result-link").attr("href");
        var res = link.split("/");
        //reemplazar el penultimo
        res1 = res[res.length-2];
        link = link.replace(res1, $(this).attr("data-info") );

        res2 = res[res.length-1];
        link = link.replace(res2, $(this).attr("data-name") );
        $(".result-link").attr("href", link );

    })


    var original = jQuery(".et_lb_module_content_inner").html();
    jQuery.each(jQuery(".cargo select option"), function (index, value) {
        mensaje = jQuery(value).html();
        ciudadClass = mensaje.substring(mensaje.lastIndexOf('(') + 1, mensaje.lastIndexOf(')'))
        jQuery(value).addClass(ciudadClass);
    });
    jQuery(".ciudad select").change(function () {
        var ciudadCambia = "";
        jQuery(".ciudad  select option:selected").each(function () {
            ciudadCambia = jQuery(this).text() + " ";
        });
        if (ciudadCambia == "--- ") {
            jQuery(".cargo select option").show();
            jQuery(".et_lb_module_content_inner").html(original);
        } else {
            jQuery(".cargo select option").hide();
            jQuery(".cargo select option." + ciudadCambia).show();
            jQuery(".et_lb_module_content_inner").each(function (index, listItem) {
                jQuery(".et_lb_module_content_inner").html(original);
                jQuery(".et_lb_module_content_inner .et_lb_simple_slide").each(function (index, listItem) {
                    encontro = jQuery(listItem).find("." + ciudadCambia);
                    if (encontro.length == 0) {
                        jQuery(this).remove();
                    }
                });
                jQuery(".et_lb_module_content_inner .et_lb_simple_slide").each(function (index, listItem) {
                    jQuery(listItem).css('display', 'none').css('opacity', '0')
                    if (index == 0)
                        jQuery(listItem).css('display', 'block').css('opacity', '1');
                });
            });
        }
    });
    centradoMenu();
    $(window).resize(function () {
        centradoMenu();
    });



});

function centradoMenu() {
    ancho = $("body").width();
    anchocuerpo = $(".header1 .container").width() + 18;
    posleft = (ancho - anchocuerpo) / 2;
    $(".fhmm .dropdown.fhmm-fw .dropdown-menu").attr('style', 'left: -' + posleft + 'px; width: ' + ancho + 'px');
    $(".fhmm-content").attr('style', 'margin-left: auto; margin-right: auto;').width(anchocuerpo);
}

//ajuste rotativas

    setTimeout(function () {
        alto = $('.flexslider .flex-control-thumbs').height();
        $('.flexslider').height(alto);
        ancho = $('.flexslider  .clone').first().width();
        $( ".flexslider .slides li img" ).each(function( index ) {
            if ($( this ).height() < alto ){
                $( this ).height(alto)
            };
        });
        altoshome();
    }, 3000);

    setTimeout(function () {
        console.log (alto);
        alto = $('.flexslider  .flex-control-thumbs').height();
        $('.flexslider').height(alto);
        ancho = $('.flexslider  .clone').first().width();
        $( ".flexslider  .slides li img" ).each(function( index ) {
            if ($( this ).height() < alto ){
                $( this ).height(alto)
            };
        });
        altoshome();
    }, 5000)

    setTimeout(function () {
        alto = $('.flexslider  .flex-control-thumbs').height();
        $(' .flexslider').height(alto);
        ancho = $('.flexslider  .clone').first().width();
        $( ".flexslider  .slides li img" ).each(function( index ) {
            if ($( this ).height() < alto ){
                $( this ).height(alto)
            };
        });
        altoshome();
    }, 10000)



$(window).resize(function () {
    alto = $('.flexslider  .flex-viewport').height();
    $('.flexslider').height(alto);
    ancho = $('.clone').first().width();

    $('.flexslider  .slides li').height(ancho * 0.61566);
});

// rotativas
$(window).load(function () {
    $('.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails",
        slideshow: true,
        start: function (slider) {
            $('.preloader').removeClass('preloader');
            $(".slides").css('transform', 'translate3d(-600px, 0px, 0px)')
        }
    });
    $('.flexslidermobile').flexslider({
        animation: "slide",
       // controlNav: "thumbnails",
      slideshow: true,
        itemWidth: "100%",
        start: function (slider) {
            $('.preloader').removeClass('preloader');
            $(".flexslidermobile .slides").css('transform', 'translate3d(-320px, 0px, 0px)');
            $(".flexslidermobile .text-rotativas").show();
        }
    });

//ajustes resultados

    var bloqueAcordio = true;
  /*  $('#accordion1').on('shown.bs.collapse', function () {
        if (bloqueAcordio) {
            bloqueAcordio = false;
            $("#accordion2 .in").removeClass("in");
            var openAnchor = $(this).find('a[data-toggle=collapse]:not(.collapsed)');
            var sectionID = openAnchor.attr('href');
            var sectionID = sectionID.substring(0, sectionID.length - 1);
            $(sectionID).collapse('toggle');
            setInterval(function () {
                bloqueAcordio = true;
            }, 3000);
        }

    })
*/

    $('#accordion2').on('shown.bs.collapse', function () {
        if (bloqueAcordio) {
            bloqueAcordio = false;
            $("#accordion1 .in").removeClass("in");
            var openAnchor = $(this).find('a[data-toggle=collapse]:not(.collapsed)');
            var sectionID = openAnchor.attr('href') + "1";
            $(sectionID ).collapse('toggle');
            setInterval(function () {
                bloqueAcordio = true;
            }, 3000);
        }
    })
});

//escala noticias home
function altoshome() {
    $('.noticia-content').each(function () {
        $(this).each(function () {
            noticias = $(this).children("div.noti");
            noticia1 = $(noticias).children("div.news-detail");
            alto1 = $(noticia1[0]).height();
            alto2 = $(noticia1[1]).height();

            if (alto1 > alto2) {
                $(noticia1[1]).height(alto1);
            } else {
                $(noticia1[0]).height(alto2);
            }

        });
    });

}

// fuera de juego

jQuery(function() {
    jQuery('#main-slider1, #main-slider2, #main-slider3, #main-slider4,#main-slider5, #main-slider6,#main-slider7,#main-slider8,#main-slider9,#main-slider10,#main-slider11,#main-slider12,#main-slider13,#main-slider14,#main-slider15,#main-slider16').liquidSlider({
        includeTitle:false,
        mobileNavigation:false,
        slideEaseFunction: "easeInOutCubic",
        preloader: true,
        tabPosition: 'bottom',
        dynamicTabsPosition: "bottom",

        onload: function() {
            this.alignNavigation();

        }
    });

    jQuery(".otrasmodelos").jCarouselLite({
        btnNext: ".next",
        btnPrev: ".prev"
    });

    jQuery(".containerfueradejuego").hide();
    jQuery(".galeria16content").show();

    //menuchicas
    jQuery(".galeria1, .galeria2,.galeria3,.galeria4,.galeria5,.galeria6,.galeria7,.galeria8,.galeria9,.galeria10,.galeria11,.galeria12,.galeria13,.galeria14,.galeria15,.galeria16").click(function() {
        for (var i = 1; i<= 16; i++)
            jQuery(".galeria" + i + "content").hide();


        jQuery("." + jQuery(this).attr('class') + "content").show()
        ;
    })

  /*  jQuery('#carousel-marcadorenvivo').carousel({
        interval: 1200000
    })*/


});