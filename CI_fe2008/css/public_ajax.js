document.observe("dom:loaded", function () {
    var loadingBanner = document.getElementById('div-gpt-ad-1381268721058-0_ad_container');

    if (loadingBanner !== null && window.location.pathname === '/') {
        $('darkLayer').show();
        $('overlaypromo').hide();
        $('FE_LOADING').show();
        setTimeout(cleanBlackLayer, 15000);
    }
    else
        cleanBlackLayer();
});
var live = 5;
var intervalos_cronometros = new Array();

var cleanBlackLayer = function () {
    $('FE_LOADING').hide();
    $('darkLayer').hide();
    $('overlaypromo').show();
};

function nuevoAjax() {
    /* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
     lo que se puede copiar tal como esta aqui */
    var xmlhttp = false;
    try {
        // Creacion del objeto AJAX para navegadores no IE
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch (e) {
        try {
            // Creacion del objet AJAX para IE
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }

    return xmlhttp;
}

function eventTrigger(e) {
    if (!e)
        e = event;
    return e.target || e.srcElement;
}

function get_plus(container, url, base) {
    $(container).innerHTML = '<div  style="background-color:#00426F"><center><img src="' + base + 'imagenes/cargando.gif"/></center></div>';
    new Ajax.Updater(container, url);
}


function get_tabla_posiciones(container, url) {
    new Ajax.Updater(container, url);
}

function ajax_update(container, url, base) {
    $(container).innerHTML = '<div  style="background-color:#00426F;height:60px;"><center><img src="' + base + 'imagenes/cargando.gif"/></center></div>';
    new Ajax.Updater(container, url);
}

function ajax_update_script(container, url, base) {
    if (typeof base === "undefined")
        base = "http://www.futbolecuador.com/";
    $(container).innerHTML = '<div><center><img src="' + base + 'imagenes/cargando3.gif"/></center></div>';
    new Ajax.Updater(container, url, {evalScripts: true});
}

function vote_survey(option, container, url, base) {
    for (var i = 0; i < eval("document.survey." + option + ".length"); i++) {
        if (eval("document.survey." + option + "[i].checked")) {
            var rad_val = eval("document.survey." + option + "[i].value");
        }
    }
    $(container).innerHTML = '<div  style="background-color:#FFFFFF"><br/><center><img src="' + base + 'imagenes/cargando2.gif"/></center><br/></div>';
    if (rad_val != undefined) {
        url = url + "/" + rad_val;
        new Ajax.Updater(container, url);
    }
}

function submit_comment(container) {
    $('comentario').request({
        onComplete: function (request) {
            document.getElementById(container).innerHTML = request.responseText;
        }
    });
}

function cargaSelect(origen_id, destino_id, fuente) {
    var valor = document.getElementById(origen_id).options[document.getElementById(origen_id).selectedIndex].value;
    var elemento;

    if (valor != 0) {
        ajax = nuevoAjax();
        // Envio al servidor el valor seleccionado y el combo al cual se le deben poner los datos
        ajax.open("GET", fuente + valor + "/" + destino_id, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {
                // Mientras carga elimino la opcion "Elige" y pongo una que dice "Cargando"
                elemento = document.getElementById(destino_id);
                elemento.length = 0;
                var opcionCargando = document.createElement("option");
                opcionCargando.value = 0;
                opcionCargando.innerHTML = "Cargando...";
                elemento.appendChild(opcionCargando);
                elemento.disabled = true;
            }
            if (ajax.readyState == 4) {
                // Coloco en la fila contenedora los datos que recivo del servidor
                document.getElementById("cmb_" + destino_id).innerHTML = ajax.responseText;
            }
        }
        ajax.send(null);
    }
}

function cambiarVivo(val, i) {
    new Effect.Appear(val);
    $(i).hide();
}

function live_title(title) {
    $('titulo_live').innerHTML = title;
}

function live_more(limit) {
    old = live - 5;
    live++;
    $('live_' + old).hide();
    $('live_' + (live - 1)).show();
    if (live > 5)
        $('flecha_iz').show();

    if (live == limit)
        $('flecha_de').hide();
}

function live_less(limit) {
    old = live;
    live--;

    $('live_' + (old - 1)).hide();
    $('live_' + (live - 5)).show();
    if (live <= 5)
        $('flecha_iz').hide();

    if (live < limit)
        $('flecha_de').show();
}

function inicia_cronos(hrs_cache, min, id) {
    intervalos_cronometros = new Array();
    /*BorrarIntervalos();*/
    fechaHora = new Date();
    fecha_actual = parseInt(fechaHora.getTime() / 1000);
    fecha_cache = parseInt(hrs_cache);
    segundos_totales = Math.abs(fecha_actual - fecha_cache);
    minutos = parseInt(min) + parseInt(segundos_totales / 60);
    segundos = parseInt(segundos_totales - ( ( minutos - min ) * 60 ));
    segundos = ( parseInt(segundos) < 10 ) ? String("0" + segundos) : segundos;
    minutos = ( parseInt(minutos) < 10 ) ? String("0" + minutos) : minutos;
    $('cronos_' + id).update(minutos + ' : ' + segundos);
    setTimeout("correr_cronometro( " + minutos + ", " + id + ", " + segundos + " )", 1000);
}

function correr_cronometro(min, id, seg) {
    var variable = null;
    /*BorrarIntervalos();*/
    seg = ( parseInt(seg) >= 59 ) ? 0 : seg + 1;
    seg = ( parseInt(seg) < 10 ) ? String("0" + seg) : seg;
    min = ( parseInt(seg) >= 59 ) ? min + 1 : min;
    min = ( parseInt(min) < 10 ) ? String("0" + min) : min;
    $('cronos_' + id).update(min + ' : ' + seg);
    variable = setTimeout("correr_cronometro( " + min + ", " + id + ", " + seg + " )", 1000);
    intervalos_cronometros[id] = variable;
}

function BorrarIntervalos() {
    for (var key = 0; key < intervalos_cronometros.length; key++) {
        clearTimeout(intervalos_cronometros[key]);
    }
    ;
}

