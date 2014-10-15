jQuery(document).ready(function () {
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

    //centrado menu
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
$(function () {
    setTimeout(function () {
        alto = $('.flex-control-thumbs').height();
        $('.flexslider').height(alto);
        ancho = $('.clone').first().width();
        $('.slides li').height(alto);
        altoshome();
    }, 1000);

    setTimeout(function () {
        alto = $('.flex-control-thumbs').height();
          $('.flexslider').height(alto);
        ancho = $('.clone').first().width();
          $('.slides li').height(alto);
        altoshome();
    }, 2000)

    setTimeout(function () {
        alto = $('.flex-control-thumbs').height();
          $('.flexslider').height(alto);
        ancho = $('.clone').first().width();
          $('.slides li').height(alto);
        altoshome();
    }, 3000)

});

$(window).resize(function () {
    alto = $('.flex-viewport').height();
    $('.flexslider').height(alto);
    ancho = $('.clone').first().width();

    $('.slides li').height(ancho * 0.61566);
});

// rotativas
$(window).load(function () {
    $('.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails",
        slideshow: false,
        start: function (slider) {
            $('body').removeClass('loading');
            $(".slides").css('transform', 'translate3d(-600px, 0px, 0px)')
        }
    });


    $('#accordion1').on('shown.bs.collapse', function () {
        var openAnchor = $(this).find('a[data-toggle=collapse]:not(.collapsed)');
        var sectionID = openAnchor.attr('href');
       // console.log(sectionID);
    })

    $('#accordion2').on('shown.bs.collapse', function () {
        var openAnchor = $(this).find('a[data-toggle=collapse]:not(.collapsed)');
        var sectionID = openAnchor.attr('href');
        $(sectionID+"1").collapse('toggle');
    })

});

//escala noticias home
function altoshome() {
    $('.noticia-content').each(function(){
        $(this).each(function(){
            noticias = $(this).children("div.noticia");
            noticia1 =  $(noticias).children("div.news-detail");
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