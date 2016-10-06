  <style>
.cancha{
		background-image: url('<?php echo base_url()?>formacion/cancha.jpg?refresh=654321');
		width:550px;
		height:780px;
		background-position: center;
		margin: 0 auto;
	}
	.opcion{
		padding: 5px;
	    color: #fff;
	    font-size: 12px;
	    line-height:10px;
	    font-weight: bold;
	}
	
	.opcion > img{
		text-align: center;
		cursor:pointer;
	}
	
	.arquero{
	padding-top: 25px;
	margin-bottom: 80px;
	}
	
	.defensa, .medio, .delantero{
	margin-top: 90px;
	margin-bottom: 110px;
	margin-left: 15px;
	margin-right: 15px;
	}
	
	.jugador {
		list-style:none;
		color:#666;
		text-align: left;
		cursor:pointer;
		margin-top: 0;
		margin-bottom: 0;
		height: 35px;
		line-height: 15px;
		font-size: 15px;
		padding-top:10px;
	}
	
	.jugador:hover{
		color:#000;
	}
	
	.btn-carga-lista{
	display: none;
	}
	
	.btn-success{
		display:none;
	}
	
	.modal-dialog { 
	    width: 260px;
	}
	
	ul{ 
	  padding-left: 10px;
	}
	
	@media (max-width: 600px){	

	.modal-dialog {
	    margin: 25% auto;
	}
		
		.cancha {
		    background-position: center top;
		    background-repeat: no-repeat;
		    background-size: 100% auto;
		    height: 560px;
		    margin: 0 auto;
		    width: 100%;
		}
		
		.arquero {
		    margin-bottom: 10px;
		    padding-top: 10px;
		}
		
		.opcion > img {
		    width: 40px;
		    margin: 0 auto;
		}
		
		.defensa, .medio, .delantero {
		    margin: 65px 15px;
		}
	}
	
	@media (max-width: 321px){
	.opcion > img {
		    width: 35px;
		}
		
		.cancha {		    
		    height: 480px;
		    }
	
	.defensa, .medio, .delantero {
		    margin: 45px 15px;
		}
	}


</style>
		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">
				<div class="cancha">
					<div class="row arquero">
						<div class="col-xs-12 col-md-12 col-lg-12 text-center opcion" id="0" ref="ARQ" sel="0">
							<img src="<?php echo base_url()?>formacion/jugadores/normal.png" />
						</div>
					</div>
					<div class="row defensa">
						<div class="col-xs-3 col-md-3 col-lg-3 text-center opcion" id="1" ref="DEF" sel="0">
							<img src="<?php echo base_url()?>formacion/jugadores/normal.png" />
						</div>
						<div class="col-xs-3 col-md-3 col-lg-3 text-center opcion" id="2" ref="DEF" sel="0">
							<img src="<?php echo base_url()?>formacion/jugadores/normal.png" />
						</div>
						<div class="col-xs-3 col-md-3 col-lg-3 text-center opcion" id="3" ref="DEF" sel="0">
							<img src="<?php echo base_url()?>formacion/jugadores/normal.png" />
						</div>
						<div class="col-xs-3 col-md-3 col-lg-3 text-center opcion" id="4" ref="DEF" sel="0">
							<img src="<?php echo base_url()?>formacion/jugadores/normal.png" />
						</div>
					</div>
					<div class="row medio">
						<div class="col-xs-3 col-md-3 col-lg-3 text-center opcion" id="5" ref="VOL" sel="0">
							<img src="<?php echo base_url()?>formacion/jugadores/normal.png" />
						</div>
						<div class="col-xs-3 col-md-3 col-lg-3 text-center opcion" id="6" ref="VOL" sel="0">
						<img src="<?php echo base_url()?>formacion/jugadores/normal.png" />
						</div>
						<div class="col-xs-3 col-md-3 col-lg-3 text-center opcion" id="7" ref="VOL" sel="0">
						<img src="<?php echo base_url()?>formacion/jugadores/normal.png" />
						</div>
						<div class="col-xs-3 col-md-3 col-lg-3 text-center opcion" id="8" ref="VOL" sel="0">
						<img src="<?php echo base_url()?>formacion/jugadores/normal.png" />
						</div>
					</div>
					<div class="row delantero">
						<div class="col-xs-6 col-md-6 col-lg-6 text-center opcion" id="9" ref="DEL" sel="0">
						<img src="<?php echo base_url()?>formacion/jugadores/normal.png" />
						</div>
						<div class="col-xs-6 col-md-6 col-lg-6 text-center opcion" id="10" ref="DEL" sel="0">
						<img src="<?php echo base_url()?>formacion/jugadores/normal.png" />
						</div>						
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-12 col-lg-12 text-center btn-enviar" >
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
  <script type="text/javascript" >	
	var formacion;
	var elementos = [];
	var posicionFormacion;
	var lista;
	setTimeout(function(){ 
		  $.getJSON( "http://www.futbolecuador.com/encuesta/resultados", function( data ) {
				formacion = data;	  
				  var contador = 0;
				  var imagen = "<img src='"+formacion["arquero"][0].imagen+"' /> <br> "+formacion["arquero"][0].first_name+" "+formacion["arquero"][0].last_name+" <br>"+formacion["arquero"][0].voto;
				  	$("#"+contador).html(imagen);
				  contador = contador + 1;
				  for (var i=0 ; i<4; i++){
					var imagen = "<img src='"+formacion["defensa"][i].imagen+"' /> <br> "+formacion["defensa"][i].first_name+" "+formacion["defensa"][i].last_name+" <br>"+formacion["defensa"][i].voto;						
					$("#"+contador).html(imagen);
					contador = contador + 1;
				 }

				 for (var i=0 ; i<4; i++){
					var imagen = "<img src='"+formacion["volante"][i].imagen+"' /> <br> "+formacion["volante"][i].first_name+" "+formacion["volante"][i].last_name+" <br>"+formacion["volante"][i].voto;
					$("#"+contador).html(imagen);
					contador++;
				 }

				 for (var i=0 ; i<2; i++){
				    var imagen = "<img src='"+formacion["delantero"][i].imagen+"' /> <br> "+formacion["delantero"][i].first_name+" "+formacion["delantero"][i].last_name+" <br>"+formacion["delantero"][i].voto;
					$("#"+contador).html(imagen);
					contador++;
				 }
							 
			}); 
	}, 2000);
		
  </script>

