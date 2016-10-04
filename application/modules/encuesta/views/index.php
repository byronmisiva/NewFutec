<!DOCTYPE html>
<html><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://appss.misiva.com.ec/noticia/css/coke/css/bootstrap.css">
  <script src="https://appss.misiva.com.ec/noticia/css/coke/js/jquery.min.js"></script>
  <style>
  body, html{
  margin: 0;
  padding: 0;
  }
.container{
	width:980px ;
}

.cancha{
	background-image: url('<?php echo base_url()?>formacion/cancha.jpg');
	width:550px;
	height:780px;
	background-position: center;
	margin: 0 auto;
}

.opcion{
padding: 5px;
}

.opcion > img{

	text-align: center;
	cursor:pointer;
}

/*.opcion > img:hover{
	border:2px solid red;
	border-radius:30px;
}*/

.arquero{
padding-top: 25px;
margin-bottom: 80px;
}

.defensa, .medio, .delantero{
margin-top: 110px;
margin-bottom: 110px;
margin-left: 15px;
margin-right: 15px;
}

.jugador {
	list-style:none;
	color:#000;
	text-align: center;
	cursor:pointer;
	margin-top: 5px;
	margin-bottom: 5px;
	height: 35px;
	line-height: 25px;
	font-size: 18px;
	padding-top:10px;
}

.jugador:hover{
	font-weight: bold;
}

.btn-carga-lista{
display: none;
}

.btn-success{
	display:none;
}

</style>

	
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="cancha">
					<div class="row arquero">
						<div class="col-lg-12 text-center opcion" id="0" ref="ARQ" sel="0">
							<img src="<?php echo base_url()?>formacion/jugadores/normal.png" />
						</div>
					</div>
					<div class="row defensa">
						<div class="col-lg-3 text-center opcion" id="1" ref="DEF" sel="0">
							<img src="<?php echo base_url()?>formacion/jugadores/normal.png" />
						</div>
						<div class="col-lg-3 text-center opcion" id="2" ref="DEF" sel="0">
							<img src="<?php echo base_url()?>formacion/jugadores/normal.png" />
						</div>
						<div class="col-lg-3 text-center opcion" id="3" ref="DEF" sel="0">
							<img src="<?php echo base_url()?>formacion/jugadores/normal.png" />
						</div>
						<div class="col-lg-3 text-center opcion" id="4" ref="DEF" sel="0">
							<img src="<?php echo base_url()?>formacion/jugadores/normal.png" />
						</div>
					</div>
					<div class="row medio">
						<div class="col-lg-3 text-center opcion" id="5" ref="VOL" sel="0">
							<img src="<?php echo base_url()?>formacion/jugadores/normal.png" />
						</div>
						<div class="col-lg-3 text-center opcion" id="6" ref="VOL" sel="0">
						<img src="<?php echo base_url()?>formacion/jugadores/normal.png" />
						</div>
						<div class="col-lg-3 text-center opcion" id="7" ref="VOL" sel="0">
						<img src="<?php echo base_url()?>formacion/jugadores/normal.png" />
						</div>
						<div class="col-lg-3 text-center opcion" id="8" ref="VOL" sel="0">
						<img src="<?php echo base_url()?>formacion/jugadores/normal.png" />
						</div>
					</div>
					<div class="row delantero">
						<div class="col-lg-6 text-center opcion" id="9" ref="DEL" sel="0">
						<img src="<?php echo base_url()?>formacion/jugadores/normal.png" />
						</div>
						<div class="col-lg-6 text-center opcion" id="10" ref="DEL" sel="0">
						<img src="<?php echo base_url()?>formacion/jugadores/normal.png" />
						</div>						
					</div>
					<div class="row">
						<div class="col-lg-12 text-center " >
							<button type="button" class="btn btn-success">Enviar</button>
						</div>
					</div>>
				</div>
			<!-- Button trigger modal -->
					<button type="button" class="btn btn-carga-lista" data-toggle="modal" data-target="#myModal" ></button>
					
					<!-- Modal -->
					<div class="modal" id="myModal" tabindex="-1" role="dialog"
					     aria-labelledby="myModalLabel1" aria-hidden="true">
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
			</diV>
			</div>
		</div>        
  <script type="text/javascript" >	
	var formacion;
	$.getJSON( "http://www.futbolecuador.com/encuesta/consulta", function( data ) {
		formacion = data;				 
	}); 
	var elementos = [];

	function verificarJugador(elem){
		var pos ;
		if ($("#"+posicionFormacion).attr("sel") == "0" ){
			elementos.push (elem.attr("ref"));
			for(var l=0; l<formacion.length; l++){
				if ( formacion[l].id == elem.attr("ref")){
					pos = l;
					formacion[l].checked ="TRUE";
					l = formacion.length;
					
				}
			}	
			$("#"+posicionFormacion).html("<img src='"+formacion[pos].imagen+"' />");
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
			$("#"+posicionFormacion).html("<img src='"+formacion[pos].imagen+"' />");	
			$("#"+posicionFormacion).attr("sel",elem.attr("ref"));		
		}
		
		console.debug("Lista jugadores:"+elementos);
		if (elementos.length == 11){
			$(".btn-success").show();
		}else{
			$(".btn-success").hide();
		}
	};
	var posicionFormacion;
	$(document).ready(function () {
		$(".btn-success").click(function(){
			$.ajax({  
				  type: "POST",  
				  url: "http://www.futbolecuador.com/encuesta/pushVotos",  
				  data: {datos:JSON.stringify(elementos)},
				  success: function( result ) {
					  formacion = JSON.parse(result);
					  console.debug(formacion);
		    		} 
				});
		});		
		
		$(".opcion").click(function(){			
			var posicion = $(this).attr("ref");
			posicionFormacion = $(this).attr("id");
			var htmlLista;
			htmlLista ="<ul>";
			for(var x=0; x<formacion.length; x++){
				if ( formacion[x].posicion == posicion){
					 if (formacion[x].checked == "FALSE"){
						 htmlLista = htmlLista+
							"<li class='jugador ' data-dismiss='modal' ref='"+formacion[x].id+"' fil='"+formacion[x].posicion+"' pos='"+x+"' ver='"+formacion[x].checked+"' onclick='verificarJugador($(this))'>"+
								formacion[x].first_name+" "+formacion[x].last_name+
							"</li>";	 
					 }			 
				}				 
			}
			htmlLista = htmlLista+"<ul>";
			//alert(JSON.stringify(elementos));
			$(".modal-body").html("");
			$(".modal-body").html(htmlLista);
			$(".btn-carga-lista").click();
		});
	});

	
  </script>
  <script src="https://appss.misiva.com.ec/noticia/css/coke/js/bootstrap.min.js"></script>
</body></html>