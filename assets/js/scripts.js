var masnoticas = "";

//inicio funciones splash
function cargarSplashFE() {
    if ((verMobile == 1 ) && (uri == "movil")) {
        $('#darkLayerFE').show();
        $('#FE_LOADINGFE').show();
        //funcion spalsh movil
            $(".redireccionFE, .deviceFE, #closeBanner").click(function () {
                $('#darkLayerFE').hide();
                $('#FE_LOADINGFE').hide();
            })
        //cleanBlackLayer;
    }
};

function cargarSplash() {
        $('#darkLayer').show();
        $('#FE_LOADING').show();
        //funcion enviar encuesta
        $("#closeBanner").click(function () {
            $('#darkLayer').hide();
            $('#FE_LOADING').hide();
        })
        setTimeout(cleanBlackLayer, 70000);

};


var cleanBlackLayer = function () {
    $('#darkLayer').hide();
    $('#FE_LOADING').hide();
    //si no existe cargar splash de fe
};

var mostrarBlackLayer = function () {
    $('#darkLayer').show();
    $('#FE_LOADING').show();
    //si no existe cargar splash de fe
};

jQuery(document).ready(function () {
    //funcion enviar encuesta
    if ($(".enviar-encuesta").length) {
        $("#enviar-encuesta-boton").click(function () {
            $(".enviar-encuesta").hide();
            $(".resultados-encuesta").show();
            // $(".resultados-encuesta").html('Enviando...');
            $.post(
                baseUrl + "surveys/envioencuesta/" + $("[name='option']:checked").val() + "/" + Math.floor((Math.random() * 1000000) + 1),
                {vote: $("[name='option']:checked").val()},
                function (data) {
                    //       $(".resultados-encuesta").html('Ver Resultados' );
                    $.post(baseUrl + "surveys/encuesta_resultado/" + Math.floor((Math.random() * 1000000) + 1), function (data) {
                        $(".encuesta-contenedor").html(data);
                        $(".resultados-encuesta").remove();
                    });
                });
        })
    }
//    clickVerResultados()

    //funcion anclar menu
    if ($("#fechascalendario").length) {
        $(" .fechalista").click(function (event) {
            result = $(this).find(".valor").html();
            $('#scrollto' + result).ScrollTo();
        });
    }

    if ($("#fechascalendario").length) {
        $(window).scroll(function (event) {
            if ($(window).scrollTop() > 190) {
                $("#fechascalendario").addClass('menu-fijo');
            } else {
                $("#fechascalendario").removeClass('menu-fijo');
            }
        });
    }

    //manejo de flecha arriba
    if ($(".flechaariba").length) {
        ancho = $("body").width();
        if (ancho > 800) {
            $(window).scroll(function (event) {
                if ($(window).scrollTop() > 500) {
                    $(".flechaariba").fadeIn();
                } else {
                    $(".flechaariba").fadeOut();
                }
            });
        }
    }

    $(".flechaariba").click(function (event) {
        $('.arriba').ScrollTo();
    });

    //ocultar el menu al dar click
    $(".clickmenu").click(function () {
        $(".navbar-collapse").addClass("collapsing");
    })

    //ocultar el splash
    $("#closeBanner").click(function () {
        cleanBlackLayer()
    })

    // si el ancho es menor a 600 cambiamos cambiamos los videos
    ancho = $("body").width();
    if (ancho < 600) {
        $("iframe").each(function () {
            src = $(this).attr('src');
            //para el caso de youtube

            if (typeof src != 'undefined') {

                var n = src.search("youtube");
                if (n > 0) $(this).attr('width', "100%");
                var n = src.search("vine");
                if (n > 0) $(this).attr('width', "100%").attr('height', "290");
            }
        })
        $(".noticia-body img").each(function () {
            $(this).addClass("img-responsive")
        })
    }
    if (ancho > 600) {
        //ajuste rotativas
        setTimeout(function () {
            ajustesRotativas();
            altoshome();
        }, 2000);
        setTimeout(function () {
            ajustesRotativas();
            altoshome();
        }, 4000)
        setTimeout(function () {
            ajustesRotativas();
            altoshome();
        }, 6000)
    }

    // pone en el mismo alto a los contenedores
    setTimeout(function () {
        igualarancho();
    }, 3000);
    setTimeout(function () {
        igualarancho();
    }, 5000);
    setTimeout(function () {
        igualarancho();
        console.log ("altos")
    }, 7000);

    $("#enviarcontacto").click(function () {
        cargaSendMail("#correocontacto", "#nombrecontacto", "#mensajecontacto", "#enviarcontacto", "#errorcontacto", "contacto")
    })
    $("#enviarpublicidad").click(function () {
        cargaSendMail("#correopublicidad", "#nombrepublicidad", "#mensajepublicidad", "#enviarpublicidad", "#errorpublicidad", "publicidad")
    })
    clickMasNoticias();
    $("img.lazy").lazyload();
    //centrado menu
    $("a.panel-link").click(function () {
        link = $(".result-link").attr("href");
        var res = link.split("/");
        //reemplazar el penultimo
        res1 = res[res.length - 1];
        link = link.replace(res1, $(this).attr("data-info"));
        res2 = res[res.length - 0];

        link = link.replace(res2, $(this).attr("data-name"));
        $(".result-link").attr("href", link);
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


//recargar marcador en vivo REFRESH_VIVO
machDetailCarrousel = $('#carousel-marcadorenvivo');

if (machDetailCarrousel.length > 0) {
    setInterval(function () {
        $.post(baseUrl + "site/masMarcadorVivo", function (data) {
            $("#carousel-marcadorenvivo").html(data);

        });
    }, REFRESH_VIVO * 1000)
}

//cronometro
var cronometro = $('.cronometro');
if (cronometro.length > 0) {
    setInterval(function () {
        $('.cronometro').each(function () {
            partes = $(this).html().split("-");
            hora = partes[0].split(':');
            segundo = parseInt(hora[1]) + 1;
            minuto = parseInt(hora[0]);

            if (segundo >= 60) {
                segundo = 0;
                minuto = minuto + 1;
            }
            if (segundo < 10) {
                segundo = "0" + segundo;
            }
            if (minuto < 10) {
                minuto = "0" + minuto;
            }
            nuevahora = minuto + ":" + segundo + ' - ' + partes[1];
            $(this).html(nuevahora)
        })
    }, 1000)
}

//matchdetailestado
var resultadoteporal = "";
var resultadotemporalOld = "";

var localscore = 0;
var localscoreOld = 0;
var visitantescore = 0;
var visitantescoreOld = 0;


machDetail = $('.matchdetail');
if (machDetail.length > 0) {
    estado = $('.matchdetailestado').html();

    if (estado.replace(/\s/g, '') != 'FindelPartido') {
        //recargar marcador en vivo REFRESH_VIVO
        resultadotemporalOld = $.trim($('.resultado-equipo').text());

        setInterval(function () {
            $.post(baseUrl + "site/MarcadorVivoDetail/" + idEquipo + "/" + Math.floor((Math.random() * 1000000) + 1), function (data) {
                $(".matchdetail").html(data);
                $(".matchdetail .comentariosC").remove();
                $(".matchdetail .comentariosB").remove();

                //evento de cambio de marcador
                resultadoteporal = $.trim($('.resultado-equipo').text());
                if (resultadoteporal != "vs" ) {
                    if (resultadoteporal != resultadotemporalOld){
                        resultadotemporalOld = resultadoteporal;

                        //ver si es local o visitante
                        marcador = resultadoteporal.split(" ");
                        localscore = marcador [0];
                        visitantescore = marcador [2];

                        if (localscore != localscoreOld){
                            console.log ("gol local")
                        }
                        if (localscore != localscoreOld){
                            console.log ("gol vistante ")
                        }

                    }
                }
            });
        }, REFRESH_VIVO * 1000)
    }
}

$(window).resize(function () {
    alto = $('.flexslider  .flex-viewport').height();
    $('.flexslider').height(alto);
    ancho = $('.clone').first().width();

    $('.flexslider  .slides li').height(ancho * 0.61566);
});

// rotativas
$(window).load(function () {
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
            $(sectionID).collapse('toggle');
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
jQuery(function () {

// funcion movile marcador en vivo
    jQuery("#carousel-marcadorenvivo").swipe( {
        tap:function(event, target) {
             // click al partido
        },

        swipeLeft:function(event, direction, distance, duration, fingerCount) {
            $("a.right").click()
        },
        swipeRight: function() {
            $("a.left").click()
        },

        //Default is 75px, set to 0 for demo so any distance triggers swipe
        threshold:0
    });

    jQuery(".contenidoexclusivo").show();


    jQuery('#main-slider1, #main-slider2, #main-slider3, #main-slider4,#main-slider5, #main-slider6,#main-slider7,#main-slider8,#main-slider9,#main-slider10,#main-slider11,#main-slider12,#main-slider13,#main-slider14,#main-slider15,#main-slider16,#main-slider17,#main-slider18').liquidSlider({
        //  jQuery('#main-slider15,#main-slider16').liquidSlider({
        includeTitle: false,
        mobileNavigation: false,
        slideEaseFunction: "easeInOutCubic",
        // preloader: true,
        tabPosition: 'bottom',
        dynamicTabsPosition: "bottom",
        onload: function () {
            this.alignNavigation();
        }
    });


    //jQuery('#main-slider1, #main-slider2, #main-slider3, #main-slider4,#main-slider5, #main-slider6,#main-slider7,#main-slider8,#main-slider9,#main-slider10,#main-slider11,#main-slider12,#main-slider13,#main-slider14,#main-slider15,#main-slider16').adjustHeightNoAnimation();
    ancho = $("body").width();
    if (ancho < 600) {
        if (ancho < 380) {
            visibles = 2
        } else {
            visibles = 3
        }
    } else {
        visibles = 5
    }
    jQuery(".otrasmodelos").jCarouselLite({
        btnNext: ".next",
        btnPrev: ".prev",
        visible: visibles,
        mouseWheel: true,
        scroll: 2
    });
    jQuery(".containerfueradejuego").hide();
    jQuery(".galeria18content").show();


    // funcion swipe menu inferior
    jQuery(".otrasmodelos").swipe( {
        tap:function(event, target) {
            for (var i = 1; i <= 18; i++)
                jQuery(".galeria" + i + "content").hide();
            thisLocal = target;
            jQuery("." + jQuery(thisLocal).attr('id') + "content").show();
            idclic = jQuery(thisLocal).attr('id');
            idclic = idclic.replace("galeria", "");

            $(".galeria" + idclic + "content img.lazo").each(function () {
                $(this).attr("src", $(this).attr("data-original"))
                setTimeout(function () {
                    jQuery("#main-slider" + idclic + "-nav-ul li.tab2 a ").click();
                    jQuery("#main-slider" + idclic + "-nav-ul li.tab1 a ").click();
                }, 1000);
            });
        },
        swipeLeft:function(event, direction, distance, duration, fingerCount) {
            $("img.next").click()
        },
        swipeRight: function() {
            $("img.prev").click()
        },
        //Default is 75px, set to 0 for demo so any distance triggers swipe
        threshold:0
    });
    //menuchicas
    jQuery(".otrasmodelos div.galeria1, .otrasmodelos div.galeria2,.otrasmodelos .galeria3,.otrasmodelos .galeria4,.otrasmodelos .galeria5,.otrasmodelos .galeria6,.otrasmodelos .galeria7,.otrasmodelos .galeria8,.otrasmodelos .galeria9,.otrasmodelos .galeria10,.otrasmodelos .galeria11,.otrasmodelos .galeria12,.otrasmodelos .galeria13,.otrasmodelos .galeria14,.otrasmodelos .galeria15,.otrasmodelos .galeria16,.otrasmodelos .galeria17,.otrasmodelos .galeria18").click(function () {
        for (var i = 1; i <= 18; i++)
            jQuery(".galeria" + i + "content").hide();
        jQuery("." + jQuery(this).attr('class') + "content").show();
        idclic = jQuery(this).attr('class');
        idclic = idclic.replace("galeria", "");
        $(".galeria" + idclic + "content img.lazo").each(function () {
            $(this).attr("src", $(this).attr("data-original"))
            setTimeout(function () {
                jQuery("#main-slider" + idclic + "-nav-ul li.tab2 a ").click();
                jQuery("#main-slider" + idclic + "-nav-ul li.tab1 a ").click();
            }, 1000);
        });
    })



});

function cargaSendMail(mail, nombre, mensaje, botEnvio, errorCaja, urlMensaje) {
    $(botEnvio).attr("disabled", true);
    var filter = /^[A-Za-z][A-Za-z0-9_]*@[A-Za-z0-9_]+.[A-Za-z0-9_.]+[A-za-z]$/;
    var s_email = $(mail).val();
    var s_name = $(nombre).val();
    var s_msg = $(mensaje).val();
    var error = "Falta: ";
    if (filter.test(s_email)) {
        sendMail = "true";
    } else {
        error = error + "email, ";
        sendMail = "false";
    }
    if (s_name.length == 0) {
        error = error + "nombre, ";
        var sendMail = "false";
    }
    if (s_msg.length == 0) {
        error = error + "mensaje ";
        var sendMail = "false";
    }
    if (sendMail == "true") {
        var datos = {
            "nombre": $(nombre).val(),
            "email": $(mail).val(),
            "mensaje": $(mensaje).val()
        };
        $.ajax({
            data: datos,
            // hacemos referencia al archivo contacto.php
            url: baseUrl + 'site/' + urlMensaje,
            type: 'post',
            beforeSend: function () {
                //aplicamos color de borde si el envio es exitoso
                $(botEnvio).val("Enviando...");
            },
            success: function (response) {
                $(mail).val("");
                $(nombre).val("");
                $(mensaje).val("");

                $(botEnvio).val("Enviar");
                $(errorCaja).html(response);
                $(errorCaja).fadeIn('slow');
                $(botEnvio).removeAttr("disabled");
            }
        });
    } else {
        $(errorCaja).html(error);
    }
}

jQuery(document).ready(function () {
    $('.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails",
        slideshow: true,
        start: function (slider) {

            $('.preloader').removeClass('preloader');
            $(".slides").css('transform', 'translate3d(-598px, 0px, 0px)');
            $(".flex-viewport ul.slides li").each(function () {
                $(this).height(384);

            });
            $(".flex-viewport ul.slides li .img").each(function () {
                $(this).height(384);

            })
            ajustesRotativas();
        }
    });

    $('.flexslidermobile').flexslider({
        animation: "slide",
        slideshow: true,
        itemWidth: "100%",
        start: function (slider) {
            $('.preloader').removeClass('preloader');
            ancho = $("body").width();
            ancho = -ancho;
            $(".flexslidermobile .slides").css('transform', 'translate3d(ancho, 0px, 0px)');
            $(".flexslidermobile .text-rotativas").show();
        }
    });
})


function clickMasNoticias() {
    $(".masnoticias").click(function () {
        // evento analitycs mas noticias
        ga('send', 'event', 'masnoticias', 'click', 'masnoticias');

        var offset = $(this).attr('offset');
        var section = $(this).attr('section');
        var pos = $(this).attr('pos');
        var urlSeccion = $(this).attr('urlSeccion');
        $(this).html("Cargando...");
        masnoticas = this;
        $.post(baseUrl + "site/masnoticias/" + offset + "/" + section + "/" + pos + "/"+ urlSeccion + "/", function (data) {
            $(masnoticas).remove();
            noticiasExtras = $(".noticiasextras").html();

            $(".noticiasextras").html(noticiasExtras + data);
            $("img.lazy").lazyload();
            clickMasNoticias();
            setTimeout(igualarancho(), 2500);
        });
    })
}
function clickVerResultados() {
    $("#ver-resultados").click(function () {
        $(this).html("Cargando...");
        $.post(baseUrl + "surveys/encuesta_resultado/" + Math.floor((Math.random() * 1000000) + 1), function (data) {
            $(".encuesta-contenedor").html(data);
            $(".resultados-encuesta").remove();
        });
    })
}

function ajustesRotativas() {
    alto = $('.flexslider .flex-control-thumbs').height();
    $('.flexslider').height(alto);
    ancho = $('.flexslider  .clone').first().width();
    $(".flexslider .slides li img").each(function (index) {
        $(this).height('auto')
        if ($(this).height() < alto) {
            $(this).height(alto)
        }
        ;
    });
}

function igualarancho() {

    if ($("body").width() > 600) {
        zonacontenido = $(".zonacontenido").height()
        zonasidebar = $(".zonasidebar").height();

        if (zonacontenido >= zonasidebar) {
           //  $(".zonasidebar").height(zonacontenido);
             $(".zonasidebar").css("min-height: ", zonacontenido);

        } else {
            //  $(".zonacontenido").height(zonasidebar);

            $(".zonacontenido").css("min-height: ", zonasidebar);
        }
    }
}

if ((verMobile == 1 ) && (uri == "movil")) {
//add2home
    var addToHomeConfig = {
        animationIn: 'bubble',
        animationOut: 'drop',
        lifespan: 3000,
        expire: 2,
        touchIcon: true,
        message: 'Guarda esta aplicación en tu móvil. Da click en la fecha y selecciona `Añadir a la pantalla de inicio`.'
    };
}
