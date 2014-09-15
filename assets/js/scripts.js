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
    centradoMenu ();
    $(window).resize(function() {
        centradoMenu();
    });
});

function  centradoMenu () {
    ancho = $("body").width();
    anchocuerpo = $(".header1 .container").width() + 18;
    posleft = (ancho - anchocuerpo)/2;
    $(".fhmm .dropdown.fhmm-fw .dropdown-menu").attr('style', 'left: -' + posleft +'px; width: ' + ancho +'px');
    $(".fhmm-content").attr('style', 'margin-left: auto; margin-right: auto;').width(anchocuerpo);
}

//ajuste rotativas
$(function(){
    setTimeout(function(){
        alto = $('.flex-viewport').height();
        $('.flexslider').height(alto);
        ancho = $('.clone').first().width();
        console.log (ancho);
   //     $ ('.slides li').height(ancho * 0.61566);
    },600)

});

$( window ).resize(function() {
    alto = $('.flex-viewport').height();
    $('.flexslider').height(alto);
    ancho = $('.clone').first().width();
    console.log (ancho);
 //   $ ('.slides li').height(ancho * 0.61566);
});

// rotativas
$(window).load(function(){
    $('.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails",
        start: function(slider){
            $('body').removeClass('loading');
        }
    });
});