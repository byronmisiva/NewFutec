

<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/sweetalert.css">    
    <style>
		.cancha{background-image:url('<?php echo base_url()?>formacion/cancha.jpg?refresh=654321');width:550px;height:780px;background-position:center;margin:0 auto}.opcion{padding:5px;color:#fff;font-size:12px;line-height:10px;font-weight:700}.opcion>img{text-align:center;cursor:pointer}.arquero{padding-top:25px;margin-bottom:80px}.defensa,.delantero,.medio{margin:80px 15px 80px}.jugador{list-style:none;color:#666;text-align:left;cursor:pointer;margin-top:0;margin-bottom:0;height:35px;line-height:15px;font-size:15px;padding-top:10px}.jugador:hover{color:#000}.btn-carga-lista,.btn-success{display:none; margin:0 auto;}.modal-dialog{width:260px}ul{padding-left:10px}@media (max-width:600px){.modal-dialog{margin:25% auto}.cancha{background-position:center top;background-repeat:no-repeat;background-size:100% auto;height:560px;margin:0 auto;width:100%}.arquero{margin-bottom:10px;padding-top:10px}.opcion>img{width:40px;margin:0 auto}.defensa,.delantero,.medio{margin:50px 15px}}@media (max-width:321px){.opcion>img{width:35px}.cancha{height:480px}.defensa,.delantero,.medio{margin:40px 15px}}
				
		.formularioRegistro, .formularioLogin{		
			display:none;	
			width: 300px;
			margin: 15% auto;
			background-color: rgba(255,255,255,0.9);
			border-radius:10px;
			padding: 10px;
    		width: 300px;
    		z-index: 10000;		 
		}
		
		.espera{
			 background: none repeat scroll 0 0 rgba(0, 0, 0, 0.5);
		    height: 100%;
		    position: absolute;
		    width: 98%;
		    z-index: 10000;	
		    display: none;
		}
		
		.cargando{
			height: 45px;
		    margin: 30% auto;
		    width: 45px;
		}
		
		.formularioLogin {
		    height: 130px;
		    }
		    
		    .formularioRegistro {
		    height: 280px;
		    }
	</style>
</head>
<body>
	<!-- --------------- -->  
	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-12">
			<div class="espera">
				<div class="cargando">
					<img src="<?php echo base_url()?>formacion/carga.gif" />
				</div>
				<div class="formularioLogin">
					<div class="row">
					<div class="col-md-12">
						<form id="formVerificar" action="#">
							<div class="form-group">
							  <label >Email</label>
							  <input type="text" name="mailUser" id="mailUser" class="form-control" placeholder="Email"  required>
							</div>				
							<div class="form-group"> 
							   <div class="col-sm-offset-1 col-sm-5 col-xs-5 col-md-5">
							     <button type="button" class="btn btn-default btn-verificar">Verificar</button>
							   </div>
							   <div class="col-sm-offset-1 col-sm-5 col-xs-5 col-md-5">
							     <button type="button" class="btn btn-default btn-ir-registro">Regístrate</button>
							   </div>
							</div>
						</form>
						</div>
					</div>
			</div>	
			<div class="formularioRegistro">						
				<form id="formRegistro" action="#" onsubmit="return false;"> 
					<div class="form-group">
					  <label >Nombres</label>
					  <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombres" required>
					</div>
					<div class="form-group">
					  <label >Email</label>
					  <input type="email" name="mail" id="mail" class="form-control" placeholder="Email" required>
					</div>
					<div class="form-group">
					  <label >Teléfono</label>
					  <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Teléfono" required>
					</div>
					<div class="form-group"> 
					   <div class="col-sm-12 text-center">
					     <button type="button" class="btn btn-default btn-ejecutar-registro">Enviar</button>
					   </div>
					</div> 
				</form>
			</div>
			</div>
			
			<div class="cancha"></div>
		    <button type="button" class="btn btn-carga-lista" data-toggle="modal" data-target="#myModal" ></button>					
		
		</diV>
	</div>	
		<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
			<div class="modal-dialog" role="document">
			   <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			        <h4 class="modal-title" id="myModalLabel1">Seleccionar Jugador</h4>
			      </div>
			      <div class="modal-body"></div>
			    </div>
			  </div>
		</div>
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/sweetalert.min.js"></script>     
  <script type="text/javascript" >
    var setFormacion = "<?php echo $configuracion->formacion?>";
	var setTeam = "<?php echo $configuracion->id_team?>";
	var setEncuesta = "<?php echo $configuracion->id?>";  
	var formacion;
	var elementos = [];
	var posicionFormacion;
	var usuario;
	var lista;
		function verificarUser(){
			if(window.localStorage['userConcurso'] == null || window.localStorage['userConcurso'] == 0) {
				window.localStorage['userConcurso'] = 0;
				$(".cargando").hide();
				$(".formularioLogin").show();
			}else{
				usuario = JSON.parse(window.localStorage['userConcurso']);
				var texto = "Hola,"+usuario.nombre+" acabas de ingresar tu once ideal y automáticamente estás participando por el premio futbolecuador.com";
				swal("Registro Autentificado", texto, "success");
				$(".espera").hide();
			}
		}
	
	
	function verificarJugador(elem){
		var pos ;
		if ($("#"+posicionFormacion).attr("sel") == "0" ){
			for(var l=0; l<formacion.length; l++){
				if ( formacion[l].id == elem.attr("ref")){
					pos = l;
					formacion[l].checked ="TRUE";
					elementos.push (elem.attr("ref"));
					l = formacion.length;
				}
			}	
			
				formacion[pos].imagen ="http://www.futbolecuador.com/formacion/jugadores/generica.png";			
			
			$("#"+posicionFormacion).html("<img src='"+formacion[pos].imagen+"' /><br>"+formacion[pos].first_name+" "+formacion[pos].last_name);
			$("#"+posicionFormacion).attr("sel",elem.attr("ref"));
		}else{
			for(var e=0; e<elementos.length; e++){
				if(elementos[e] == $("#"+posicionFormacion).attr("sel") ){
					elementos.splice(e,1);
					e=elementos.length;
				}
			}

			for(var lim=0; lim<formacion.length; lim++){
				if( formacion[lim].id == $("#"+posicionFormacion).attr("sel") ){
					formacion[lim].checked = "FALSE";
					lim = formacion.length;
				}
			}
			
			elementos.push (elem.attr("ref"));
			for(var l=0; l<formacion.length; l++){
				if ( formacion[l].id == elem.attr("ref")){
					pos = l;
					formacion[l].checked = "TRUE";
					l = formacion.length;
				}
			}	
			formacion[pos].imagen ="http://www.futbolecuador.com/formacion/jugadores/generica.png";
			$("#"+posicionFormacion).html("<img src='"+formacion[pos].imagen+"' /><br>"+formacion[pos].first_name+" "+formacion[pos].last_name);	
			$("#"+posicionFormacion).attr("sel",elem.attr("ref"));		
		}
		
		$(".btn-success").show();
		
		if (elementos.length == 11){
			$(".btn-success").show();
		}else{
			$(".btn-success").hide();
		}
	};
	
	$(document).ready(function () {		
		$(".btn-ejecutar-registro").click(function(){
			$.post( "http://www.futbolecuador.com/encuesta/registro",{
			encuesta: setEncuesta,				
			nombre: $("#nombre").val(),
			mail: $("#mail").val(),
			telefono: $("#telefono").val()
			 },	function(respuesta){
				 $(".espera").hide();
				 window.localStorage['userConcurso'] = respuesta;
				 usuario = JSON.parse(respuesta);
				 var texto = "Hola,"+usuario.nombre+" acabas de ingresar tu once ideal y automáticamente estás participando por el premio futbolecuador.com";
				 swal("Registro Autentificado", texto, "success");
				 $(".espera").hide();
				 //swal({title: "<div class='fb-like' data-href='http://www.futbolecuador.com/site/noticia/gana-dos-entradas-para-el-ecuador-vs-venezuela/72696' data-send='false' data-action='like' data-layout='button' data-share='false' data-width='90' data-show-faces='true' data-font='arial'></div> ",   text: "No te olvides de Compartir",   html: true });
				 
				 envioRespuesta();		    			
		    });	
		});
		
		$(".btn-verificar").click(function(){
			$.post( "http://www.futbolecuador.com/encuesta/verificar",{
				mail: $("#mailUser").val() }, 
			    	function(respuesta){
			    	if (respuesta == "null"){
			    		$(".formularioLogin").hide();
						$(".formularioRegistro").show();
				    }else{
				    	$(".espera").hide();
				    	window.localStorage['userConcurso'] = respuesta;
				    	var texto = "Hola,"+usuario.nombre+" acabas de ingresar tu once ideal y automáticamente estás participando por el premio futbolecuador.com";
						swal("Registro Autentificado", texto, "success");
			    	}
		    	});
		});
		
		$(".btn-ir-registro").click(function(){
			$(".formularioLogin").hide();
			$(".formularioRegistro").show();
		});	 
		
	});	

	setTimeout(function(){ 
	  $.getJSON( "http://www.futbolecuador.com/encuesta/consulta/"+setEncuesta, function( data ) {
		  formacion = data;				 
		}); 
	  $(".cancha").load("<?php echo base_url()?>encuesta/getSistemaFormacion/"+setFormacion);
	  $(".espera").hide();
	}, 2000);
  </script>  


