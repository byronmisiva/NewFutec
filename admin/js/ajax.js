function AJX_updater(contenedor,fuente){
	new Ajax.Updater(contenedor, fuente,{
										evalscripts:true,
										onLoading: function(response) {
										    if (200 == response.status)
										      $(contenedor).innerHTML='<img src="http://www.futbolecuador.com/imagenes/cargando2.gif" />';
										  }
										});	
}



function nuevoAjax()
{ 
	/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
	lo que se puede copiar tal como esta aqui */
	var xmlhttp=false; 
	try 
	{ 
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
	}
	catch(e)
	{ 
		try
		{ 
			// Creacion del objet AJAX para IE 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		} 
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); } 

	return xmlhttp; 
}

function eventTrigger (e) {
    if (! e)
        e = event;
    return e.target || e.srcElement;
}

function imageFromSelect(origen_id,destino_id,fuente){


	var valor=origen_id.value;
	
	if(valor!=0){
		ajax=nuevoAjax();
		ajax.open("GET", fuente+"images/get_path/"+valor, true);
		
		ajax.onreadystatechange=function(){	
			
			if (ajax.readyState==1){
				document.getElementById(destino_id).innerHTML = "Cargando Imagen ..."
			}
			
			if (ajax.readyState==4){
				document.getElementById(destino_id).innerHTML="<img src='"+ "../../"+ajax.responseText+"' border='0'/>";
			} 
		}
		ajax.send(null);
	}
}

function open_form(fuente,destino,team_id,tab,au1,au2){
	document.getElementById("tab1").className = "";
	document.getElementById("tab2").className = "";
	document.getElementById("tab3").className = "";
	document.getElementById("tab"+tab).className = "active";
	var valor=document.getElementById(team_id).options[document.getElementById(team_id).selectedIndex].value;
	ajax1=nuevoAjax();
	ajax1.open("GET", fuente+valor+au1+au2, true);
	ajax1.onreadystatechange=function(){	
		if (ajax1.readyState==1){
			document.getElementById(destino).innerHTML = "Cargando Formulario ..."
		}
		if (ajax1.readyState==4){
			document.getElementById(destino).innerHTML=ajax1.responseText;
		} 
	}
	ajax1.send(null);
}

function group_rules(fuente,destino,tipo,d1,d2,d3){
	var valor=document.getElementById(tipo).options[document.getElementById(tipo).selectedIndex].value;
	ajax=nuevoAjax();
	ajax.open("GET", fuente+valor+'/'+d1+d2+d3, true);
	ajax.onreadystatechange=function(){	
		if (ajax.readyState==1){
			document.getElementById(destino).innerHTML = "Cargando Formulario ..."
		}
		if (ajax.readyState==4){
			document.getElementById(destino).innerHTML=ajax.responseText;
		} 
	}
	ajax.send(null);
}

function radio_check(fuente,destino,tipo,num){
	var valor=0;
	if(document.getElementById(tipo).checked)
		valor=1;
		
	ajax=nuevoAjax();
	ajax.open("GET", fuente+valor+'/'+num, true);
	ajax.onreadystatechange=function(){	
		if (ajax.readyState==1){
			document.getElementById(destino).innerHTML = "Cargando Formulario ..."
		}
		if (ajax.readyState==4){
			document.getElementById(destino).innerHTML=ajax.responseText;
		} 
	}
	ajax.send(null);
}

function radio_check2(fuente,destino,tipo,num){
	var valor=0;
	if(document.getElementById(tipo).checked)
		valor=1;
		
	ajax2=nuevoAjax();
	ajax2.open("GET", fuente+valor+'/'+num, true);
	ajax2.onreadystatechange=function(){	
		if (ajax2.readyState==1){
			document.getElementById(destino).innerHTML = "Cargando Formulario ..."
		}
		if (ajax2.readyState==4){
			document.getElementById(destino).innerHTML=ajax2.responseText;
		} 
	}
	ajax2.send(null);
}

function select_load(fuente,destino,carga,group,lovi,rule){
	
	ajax3=nuevoAjax();
	
	if(carga==1){
		ajax3.open("GET",fuente+'select_games/'+group+'/'+lovi+'/'+rule, true);
	}
	
	if(carga==2){
		ajax3.open("GET",fuente+'select_teams/'+group+'/'+lovi, true);
	}
	
	if(carga==3){
		ajax3.open("GET",fuente+'select_qualified/'+group+'/'+lovi+'/'+rule, true);
	}
		
		
		
	ajax3.onreadystatechange=function(){	
		if (ajax3.readyState==1){
			document.getElementById(destino).innerHTML = "Cargando Formulario ..."
		}
		if (ajax3.readyState==4){
			document.getElementById(destino).innerHTML=ajax3.responseText;
		} 
	}
	ajax3.send(null);
}

function select_load2(fuente,destino,carga,group,lovi,rule){
	
	ajax4=nuevoAjax();
	
	if(carga==1){
		ajax4.open("GET",fuente+'select_games/'+group+'/'+lovi+'/'+rule, true);
	}
	
	if(carga==2){
		ajax4.open("GET",fuente+'select_teams/'+group+'/'+lovi, true);
	}
	
	if(carga==3){
		ajax4.open("GET",fuente+'select_qualified/'+group+'/'+lovi+'/'+rule, true);
	}
		
		
		
	ajax4.onreadystatechange=function(){	
		if (ajax4.readyState==1){
			document.getElementById(destino).innerHTML = "Cargando Formulario ..."
		}
		if (ajax4.readyState==4){
			document.getElementById(destino).innerHTML=ajax4.responseText;
		} 
	}
	ajax4.send(null);
}

function changes_insert(fuente,fuente2,fuente3,match_id,team_id,destinos,tid1,tid2){
	var ini=document.getElementById('in').options[document.getElementById('in').selectedIndex].value;
	var out=document.getElementById('out').options[document.getElementById('out').selectedIndex].value;
	var minute=document.getElementById('minute').options[document.getElementById('minute').selectedIndex].value;
	ajax=nuevoAjax();
	ajax.open("GET",fuente+'/'+match_id+'/'+team_id+'/'+ini+'/'+out+'/'+minute+'/ingreso', true);
	ajax.onreadystatechange=function(){	
		if (ajax.readyState==4){
			//carga acciones
			open_form(fuente3+match_id+'/','contenido','team_id','2','/'+tid1,'/'+tid2);
			table_view(fuente2,'lista',match_id,tid1,tid2);
		} 
	}
	ajax.send(null);
}

function goals_insert(fuente,fuente2,match_id,team_id,destinos,tid1,tid2,fuente3){
	var player=document.getElementById('player_id').options[document.getElementById('player_id').selectedIndex].value;
	var minute=document.getElementById('minute').options[document.getElementById('minute').selectedIndex].value;
	var type=document.getElementById('type').options[document.getElementById('type').selectedIndex].value;
	ajax=nuevoAjax();
	ajax.open("GET",fuente+'/'+match_id+'/'+team_id+'/'+player+'/'+minute+'/'+type+'/ingreso', true);
	ajax.onreadystatechange=function(){	
		if (ajax.readyState==4){
			table_view(fuente2,'lista',match_id,tid1,tid2);
			score_view(fuente3,match_id,tid1,tid2);
		} 
	}
	ajax.send(null);
}

function cards_insert(fuente,fuente2,fuente3,match_id,team_id,destinos,tid1,tid2){
	var player=document.getElementById('player_id').options[document.getElementById('player_id').selectedIndex].value;
	var minute=document.getElementById('minute').options[document.getElementById('minute').selectedIndex].value;
	var type=document.getElementById('type').options[document.getElementById('type').selectedIndex].value;
	ajax=nuevoAjax();
	ajax.open("GET",fuente+'/'+match_id+'/'+team_id+'/'+player+'/'+minute+'/'+type+'/ingreso', true);	
	ajax.onreadystatechange=function(){	
		if (ajax.readyState==4){
			open_form(fuente3+match_id+'/','contenido','team_id','3','/'+tid1,'/'+tid2);
			table_view(fuente2,'lista',match_id,tid1,tid2);
		} 
	}
	ajax.send(null);
}

function actions_insert(fuente2,fuente3,match_id,tid1,tid2){
	var text=document.getElementById('text').value; 
	
	if(text=='')
		alert('El area de texto de la acci\xf3n no puede estar vacio');
	else{
		$('add_accion').request( {
		  onComplete: function(){ 
			action_view(fuente3,'accion',match_id,'/'+tid1,'/'+tid2);
			table_view(fuente2,'lista',match_id,tid1,tid2);
			}
		});
	}
}

function table_view(fuente,destino,match_id,tid1,tid2){
	ajax2=nuevoAjax();
	ajax2.open("GET", fuente+'/'+match_id+'/'+tid1+'/'+tid2, true);
	ajax2.onreadystatechange=function(){	
		if (ajax2.readyState==1){
			document.getElementById(destino).innerHTML = "Cargando Formulario ...";
		}
		if (ajax2.readyState==4){
			document.getElementById(destino).innerHTML=ajax2.responseText;
		} 
	}
	ajax2.send(null);
}

function action_view(fuente,destino,match_id,au1,au2){
	ajax1=nuevoAjax();
	ajax1.open("GET", fuente+'/'+match_id+au1+au2);
	ajax1.onreadystatechange=function(){	
		if (ajax1.readyState==1){
			document.getElementById(destino).innerHTML = "Cargando Formulario ...";
		}
		if (ajax1.readyState==4){
			document.getElementById(destino).innerHTML=ajax1.responseText;
		} 
	}
	ajax1.send(null);
}

function timer_view(fuente,destino,match_id){

	new Ajax.Updater(destino,fuente+'matches_actions/timer_view/'+match_id,{asynchronous:true,evalScripts:true});

}

function acg_delete(fuente,fuente2,id,match_id,tid1,tid2,check,fuente3){
	ajax=nuevoAjax();
	ajax.open("GET",fuente+id, true);
			ajax.onreadystatechange=function(){	
		if (ajax.readyState==4){
			table_view(fuente2,'lista',match_id,tid1,tid2);
			document.getElementById('contenido').innerHTML = "";
			document.getElementById("tab1").className = "";
			document.getElementById("tab2").className = "";
			document.getElementById("tab3").className = "";
			if(check==1)
				score_view(fuente3,match_id,tid1,tid2);
		} 
	}
	ajax.send(null);
}

function changes_delete(fuente,fuente2,id,match_id,tid1,tid2){
	ajax=nuevoAjax();
	ajax.open("GET",fuente+id+'/'+match_id, true);
			ajax.onreadystatechange=function(){	
		if (ajax.readyState==4){
			table_view(fuente2,'lista',match_id,tid1,tid2);
			document.getElementById('contenido').innerHTML = "";
			document.getElementById("tab1").className = "";
			document.getElementById("tab2").className = "";
			document.getElementById("tab3").className = "";
		} 
	}
	ajax.send(null);
}

function state_view(fuente,match_id,destino,tid1,tid2){
	ajax=nuevoAjax();
	ajax.open("GET", fuente+'/'+match_id+'/'+destino+'/'+tid1+'/'+tid2);
	ajax.onreadystatechange=function(){	
		if (ajax.readyState==1){
			document.getElementById('estado').innerHTML = "Cargando Formulario ...";
		}
		if (ajax.readyState==4){
			document.getElementById('estado').innerHTML=ajax.responseText;
		} 
	}
	ajax.send(null);
}

function state_insert(fuente,fuente2,match_id,fuente3,destino,tid1,tid2,fuente4){
	var state=document.getElementById('state').options[document.getElementById('state').selectedIndex].value;
	ajax=nuevoAjax();
	ajax.open("GET",fuente+'/'+state+'/'+match_id, true);
	
	ajax.onreadystatechange=function(){	
		if (ajax.readyState==4){
			state_view(fuente2,match_id,destino,tid1,tid2);
			table_view(fuente3,destino,match_id,tid1,tid2);
			timer_view(fuente4,'cronometro',match_id);
		} 
	}		
	ajax.send(null);
}

function score_view(fuente,match_id,tid1,tid2){
	ajax4=nuevoAjax();
	ajax4.open("GET",fuente+'/'+match_id+'/'+tid1+'/'+tid2, true);
	ajax4.onreadystatechange=function(){	
		if (ajax4.readyState==1){
			document.getElementById('marcador').innerHTML = "Cargando Formulario ...";
		}
		if (ajax4.readyState==4){
			document.getElementById('marcador').innerHTML=ajax4.responseText;
		} 
	}		
	ajax4.send(null);
}

function append_tag(tag){ // check last caracter
	var obj=document.getElementById('tags1');
	if(obj.value.substring(obj.value.length-1)!=';'){
		obj.value=obj.value+";";
	}
	obj.value=obj.value+tag+";";
}

function newsletters_stories_insert(fuente,contenedor,newsletter,story){
	new Ajax.Updater(contenedor, fuente + '/' + newsletter + '/' + story);
}

function newsletters_stories_view(fuente,contenedor){
	new Ajax.Updater(contenedor, fuente);
}

function newsletters_stories_delete(fuente,contenedor){
	new Ajax.Updater(contenedor, fuente);
}


function cargaSelect(origen_id,destino_id,fuente)
{
	var valor=document.getElementById(origen_id).options[document.getElementById(origen_id).selectedIndex].value;
	var elemento;
	
	if(valor!=0)
	{
		ajax=nuevoAjax();
		// Envio al servidor el valor seleccionado y el combo al cual se le deben poner los datos
		ajax.open("GET", fuente+valor+"/"+destino_id, true);
		ajax.onreadystatechange=function() 
		{	
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "Elige" y pongo una que dice "Cargando"
				elemento=document.getElementById(destino_id);
				elemento.length=0;
				var opcionCargando=document.createElement("option"); 
				opcionCargando.value=0; 
				opcionCargando.innerHTML="Cargando...";
				elemento.appendChild(opcionCargando); elemento.disabled=true;	
			}
			if (ajax.readyState==4)
			{
				// Coloco en la fila contenedora los datos que recivo del servidor
				document.getElementById("cmb_"+destino_id).innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
}

function submit_lineup(container,form){
	$(form).request({
		  onComplete: function(request){ 
			document.getElementById(container).innerHTML=request.responseText;
			}
		});
}

function submit_points(form){
	$(form).request();
}

function referee_update(form){
	$(form).request();
}

function get_update(origen_id,container,url){
	var valor=document.getElementById(origen_id).options[document.getElementById(origen_id).selectedIndex].value;
	new Ajax.Updater(container, url + valor);
}

function submit_form(container,form){
	$(form).request({
			onLoading: function(request){ 
				$(container).innerHTML='<div align="center" style="margin: 10px; color: red; font-size:18px;">Cargando...</div>';
			},
			onComplete: function(request){ 
				$(container).innerHTML=request.responseText;
			}
		});
}