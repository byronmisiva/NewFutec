<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/prototype/1.6.1/prototype.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/scriptaculous/1.8.2/scriptaculous.js"></script>
	</head>
	<style>
		div#combo ul li:hover{
			background-color: #0267AF;
		}
		
		div#combo ul li{
			font-size: small;
			list-style-type:none;
			display:block;
			margin:0;
			padding:2px;
			padding-left:3px;
			cursor:pointer;
		}
		
		div#opciones{
			overflow-y:auto;
			overflow-x:hidden;
		}
		
		div.equipo_fondo_default{
			background-image:url('<?=base_url()?>/imagenes/newsletter/fondos/default.jpg');
		}
		
		div.equipo_fondo_default div.texto{
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_default input{
			font-family:Arial; 
			font-size:16px;
			color:white;
			background:transparent; 
			border:none;
		}
		
		div.equipo_fondo_default td.titulo{
			text-align:right; 
			font-family:Arial; 
			font-size:12px; 
			color:#99A5AD;
		}
		
		div.equipo_fondo_default div#combo_titulo{
			width:256px; 
			font-family:Arial; 
			font-size:16px; 
			color:white; 
		}
		
		div.equipo_fondo_default div#opciones{
			height:105px; 
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_default div#combo ul{
			width:270px; 
			list-style:none!important; 
			list-style-image:none!important; 
			margin:0px; 
			padding:0px; 
			border-bottom:1px solid white; 
			border-left:1px solid white; 
			border-right:1px solid white;
			font-family:Verdana; 
			font-size:12px; 
			color:white;
			padding:2px;
		}
		
		div.equipo_fondo_default div#contenedor_combo{
			height:20px; 
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_default div#flecha_combo{
			float:left;
			height:16px;
			width:20px;
			background-image:url('<?=base_url()?>imagenes/newsletter/varios/flecha1.png');
		}
		
		div.equipo_fondo_33{
			background-image:url('<?=base_url()?>/imagenes/newsletter/fondos/33.jpg');
		}
		
		div.equipo_fondo_33 div.texto{
			border-bottom:1px solid black;
		}
		
		div.equipo_fondo_33 input{
			font-family:Arial; 
			font-size:16px;
			color:black;
			background:transparent; 
			border:none;
		}
		
		div.equipo_fondo_33 td.titulo{
			text-align:right; 
			font-family:Arial; 
			font-size:12px; 
			color:#654800;
		}
		
		div.equipo_fondo_33 div#combo_titulo{
			width:256px; 
			font-family:Arial; 
			font-size:16px; 
			color:black; 
		}
		
		div.equipo_fondo_33 div#opciones{
			height:105px; 
			border-bottom:1px solid black;
		}
		
		div.equipo_fondo_33 div#combo ul{
			width:270px; 
			list-style:none!important; 
			list-style-image:none!important; 
			margin:0px; 
			padding:0px; 
			border-bottom:1px solid black; 
			border-left:1px solid black; 
			border-right:1px solid black;
			font-family:Verdana; 
			font-size:12px; 
			color:black;
			padding:2px;
		}
		
		div.equipo_fondo_33 div#contenedor_combo{
			height:20px; 
			border-bottom:1px solid black;
		}
		
		div.equipo_fondo_33 div#flecha_combo{
			float:left;
			height:16px;
			width:20px;
			background-image:url('<?=base_url()?>imagenes/newsletter/varios/flecha2.png');
		}
		
		div.equipo_fondo_39{
			background-image:url('<?=base_url()?>/imagenes/newsletter/fondos/39.jpg');
		}
		
		div.equipo_fondo_39 div.texto{
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_39 input{
			font-family:Arial; 
			font-size:16px;
			color:white;
			background:transparent; 
			border:none;
		}
		
		div.equipo_fondo_39 td.titulo{
			text-align:right; 
			font-family:Arial; 
			font-size:12px; 
			color:#BABBBB;
		}
		
		div.equipo_fondo_39 div#combo_titulo{
			width:256px; 
			font-family:Arial; 
			font-size:16px; 
			color:white; 
		}
		
		div.equipo_fondo_39 div#opciones{
			height:105px; 
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_39 div#combo ul{
			width:270px; 
			list-style:none!important; 
			list-style-image:none!important; 
			margin:0px; 
			padding:0px; 
			border-bottom:1px solid white; 
			border-left:1px solid white; 
			border-right:1px solid white;
			font-family:Verdana; 
			font-size:12px; 
			color:white;
			padding:2px;
		}
		
		div.equipo_fondo_39 div#contenedor_combo{
			height:20px; 
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_39 div#flecha_combo{
			float:left;
			height:16px;
			width:20px;
			background-image:url('<?=base_url()?>imagenes/newsletter/varios/flecha1.png');
		}
		
		div.equipo_fondo_38{
			background-image:url('<?=base_url()?>/imagenes/newsletter/fondos/38.jpg');
		}
		
		div.equipo_fondo_38 div.texto{
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_38 input{
			font-family:Arial; 
			font-size:16px;
			color:white;
			background:transparent; 
			border:none;
		}
		
		div.equipo_fondo_38 td.titulo{
			text-align:right; 
			font-family:Arial; 
			font-size:12px; 
			color:#A1A5B1;
		}
		
		div.equipo_fondo_38 div#combo_titulo{
			width:256px; 
			font-family:Arial; 
			font-size:16px; 
			color:white; 
		}
		
		div.equipo_fondo_38 div#opciones{
			height:105px; 
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_38 div#combo ul{
			width:270px; 
			list-style:none!important; 
			list-style-image:none!important; 
			margin:0px; 
			padding:0px; 
			border-bottom:1px solid white; 
			border-left:1px solid white; 
			border-right:1px solid white;
			font-family:Verdana; 
			font-size:12px; 
			color:white;
			padding:2px;
		}
		
		div.equipo_fondo_38 div#contenedor_combo{
			height:20px; 
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_38 div#flecha_combo{
			float:left;
			height:16px;
			width:20px;
			background-image:url('<?=base_url()?>imagenes/newsletter/varios/flecha1.png');
		}
		
		div.equipo_fondo_36{
			background-image:url('<?=base_url()?>/imagenes/newsletter/fondos/36.jpg');
		}
		
		div.equipo_fondo_36 div.texto{
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_36 input{
			font-family:Arial; 
			font-size:16px;
			color:white;
			background:transparent; 
			border:none;
		}
		
		div.equipo_fondo_36 td.titulo{
			text-align:right; 
			font-family:Arial; 
			font-size:12px; 
			color:#9D9FA6;
		}
		
		div.equipo_fondo_36 div#combo_titulo{
			width:256px; 
			font-family:Arial; 
			font-size:16px; 
			color:white; 
		}
		
		div.equipo_fondo_36 div#opciones{
			height:105px; 
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_36 div#combo ul{
			width:270px; 
			list-style:none!important; 
			list-style-image:none!important; 
			margin:0px; 
			padding:0px; 
			border-bottom:1px solid white; 
			border-left:1px solid white; 
			border-right:1px solid white;
			font-family:Verdana; 
			font-size:12px; 
			color:white;
			padding:2px;
		}
		
		div.equipo_fondo_36 div#contenedor_combo{
			height:20px; 
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_36 div#flecha_combo{
			float:left;
			height:16px;
			width:20px;
			background-image:url('<?=base_url()?>imagenes/newsletter/varios/flecha1.png');
		}
		
		div.equipo_fondo_34{
			background-image:url('<?=base_url()?>/imagenes/newsletter/fondos/34.jpg');
		}
		
		div.equipo_fondo_34 div.texto{
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_34 input{
			font-family:Arial; 
			font-size:16px;
			color:white;
			background:transparent; 
			border:none;
		}
		
		div.equipo_fondo_34 td.titulo{
			text-align:right; 
			font-family:Arial; 
			font-size:12px; 
			color:#DCC899;
		}
		
		div.equipo_fondo_34 div#combo_titulo{
			width:256px; 
			font-family:Arial; 
			font-size:16px; 
			color:white; 
		}
		
		div.equipo_fondo_34 div#opciones{
			height:105px; 
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_34 div#combo ul{
			width:270px; 
			list-style:none!important; 
			list-style-image:none!important; 
			margin:0px; 
			padding:0px; 
			border-bottom:1px solid white; 
			border-left:1px solid white; 
			border-right:1px solid white;
			font-family:Verdana; 
			font-size:12px; 
			color:white;
			padding:2px;
		}
		
		div.equipo_fondo_34 div#contenedor_combo{
			height:20px; 
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_34 div#flecha_combo{
			float:left;
			height:16px;
			width:20px;
			background-image:url('<?=base_url()?>imagenes/newsletter/varios/flecha1.png');
		}
		
		div.equipo_fondo_35{
			background-image:url('<?=base_url()?>/imagenes/newsletter/fondos/35.jpg');
		}
		
		div.equipo_fondo_35 div.texto{
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_35 input{
			font-family:Arial; 
			font-size:16px;
			color:white;
			background:transparent; 
			border:none;
		}
		
		div.equipo_fondo_35 td.titulo{
			text-align:right; 
			font-family:Arial; 
			font-size:12px; 
			color:#CBA7A4;
		}
		
		div.equipo_fondo_35 div#combo_titulo{
			width:256px; 
			font-family:Arial; 
			font-size:16px; 
			color:white; 
		}
		
		div.equipo_fondo_35 div#opciones{
			height:105px; 
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_35 div#combo ul{
			width:270px; 
			list-style:none!important; 
			list-style-image:none!important; 
			margin:0px; 
			padding:0px; 
			border-bottom:1px solid white; 
			border-left:1px solid white; 
			border-right:1px solid white;
			font-family:Verdana; 
			font-size:12px; 
			color:white;
			padding:2px;
		}
		
		div.equipo_fondo_35 div#contenedor_combo{
			height:20px; 
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_35 div#flecha_combo{
			float:left;
			height:16px;
			width:20px;
			background-image:url('<?=base_url()?>imagenes/newsletter/varios/flecha1.png');
		}
		
		div.equipo_fondo_37{
			background-image:url('<?=base_url()?>/imagenes/newsletter/fondos/37.jpg');
		}
		
		div.equipo_fondo_37 div.texto{
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_37 input{
			font-family:Arial; 
			font-size:16px;
			color:white;
			background:transparent; 
			border:none;
		}
		
		div.equipo_fondo_37 td.titulo{
			text-align:right; 
			font-family:Arial; 
			font-size:12px; 
			color:#DDA3A3;
		}
		
		div.equipo_fondo_37 div#combo_titulo{
			width:256px; 
			font-family:Arial; 
			font-size:16px; 
			color:white; 
		}
		
		div.equipo_fondo_37 div#opciones{
			height:105px; 
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_37 div#combo ul{
			width:270px; 
			list-style:none!important; 
			list-style-image:none!important; 
			margin:0px; 
			padding:0px; 
			border-bottom:1px solid white; 
			border-left:1px solid white; 
			border-right:1px solid white;
			font-family:Verdana; 
			font-size:12px; 
			color:white;
			padding:2px;
		}
		
		div.equipo_fondo_37 div#contenedor_combo{
			height:20px; 
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_37 div#flecha_combo{
			float:left;
			height:16px;
			width:20px;
			background-image:url('<?=base_url()?>imagenes/newsletter/varios/flecha1.png');
		}
		
		div.equipo_fondo_79{
			background-image:url('<?=base_url()?>/imagenes/newsletter/fondos/79.jpg');
		}
		
		div.equipo_fondo_79 div.texto{
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_79 input{
			font-family:Arial; 
			font-size:16px;
			color:white;
			background:transparent; 
			border:none;
		}
		
		div.equipo_fondo_79 td.titulo{
			text-align:right; 
			font-family:Arial; 
			font-size:12px; 
			color:#B5CDE8;
		}
		
		div.equipo_fondo_79 div#combo_titulo{
			width:256px; 
			font-family:Arial; 
			font-size:16px; 
			color:white; 
		}
		
		div.equipo_fondo_79 div#opciones{
			height:105px; 
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_79 div#combo ul{
			width:270px; 
			list-style:none!important; 
			list-style-image:none!important; 
			margin:0px; 
			padding:0px; 
			border-bottom:1px solid white; 
			border-left:1px solid white; 
			border-right:1px solid white;
			font-family:Verdana; 
			font-size:12px; 
			color:white;
			padding:2px;
		}
		
		div.equipo_fondo_79 div#contenedor_combo{
			height:20px; 
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_79 div#flecha_combo{
			float:left;
			height:16px;
			width:20px;
			background-image:url('<?=base_url()?>imagenes/newsletter/varios/flecha1.png');
		}
		
		div.equipo_fondo_77{
			background-image:url('<?=base_url()?>/imagenes/newsletter/fondos/77.jpg');
		}
		
		div.equipo_fondo_77 div.texto{
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_77 input{
			font-family:Arial; 
			font-size:16px;
			color:white;
			background:transparent; 
			border:none;
		}
		
		div.equipo_fondo_77 td.titulo{
			text-align:right; 
			font-family:Arial; 
			font-size:12px; 
			color:#FDA8A8;
		}
		
		div.equipo_fondo_77 div#combo_titulo{
			width:256px; 
			font-family:Arial; 
			font-size:16px; 
			color:white; 
		}
		
		div.equipo_fondo_77 div#opciones{
			height:105px; 
			border-bottom:1px solid white;
			
		}
		
		div.equipo_fondo_77 div#combo ul{
			width:270px; 
			list-style:none!important; 
			list-style-image:none!important; 
			margin:0px; 
			padding:0px; 
			border-bottom:1px solid white; 
			border-left:1px solid white; 
			border-right:1px solid white;
			font-family:Verdana; 
			font-size:12px; 
			color:white;
			padding:2px;
		}
		
		div.equipo_fondo_77 div#contenedor_combo{
			height:20px; 
			border-bottom:1px solid white;
		}
		
		div.equipo_fondo_77 div#flecha_combo{
			float:left;
			height:16px;
			width:20px;
			background-image:url('<?=base_url()?>imagenes/newsletter/varios/flecha1.png');
		}
		
	</style>
	<body style="background-color:black;">
		<center>
			<div id="general" class="equipo_fondo_<?=$equipo?>" style="position:relative; width:700px; height:700px;">
				<a href="http://www.futbolecuador.com" target="_blank">
					<div style="position:absolute; top:0px; right:0px; width:430px; height:130px; cursor:pointer;">
					</div>
				</a>
				<div style="position:absolute; top:600px; left:233px; cursor:pointer;" onClick="enviarFormulario();">
					<img border="0" src="<?=base_url().'imagenes/newsletter/varios/boton.png'?>"/>
				</div>
				<div id="error" style="position:absolute; top:612px; left:12px; font-family:Arial; font-size:16px; color:#9a9999;">
				</div>
				<div style="position:absolute; top:480px; left:12px;">
					<form id="suscripcion" action="<?=base_url().'newsletters/newsletterSuscription'?>" method="post"/>
						<input type="hidden" name="enviar" value="enviar"/>
						<?if($equipo!="default"){?>
							<input type="hidden" id="equipo" name="equipo" value="<?=$equipos[$equipo]->nombre?>"/>
							<input type="hidden" id="equipo_id" name="equipo_id" value="<?=$equipo?>"/>
						<?}else{?>
							<input type="hidden" id="equipo" name="equipo" value=""/>
							<input type="hidden" id="equipo_id" name="equipo_id" value=""/>
						<?}?>
						<table cellpadding="1" cellspacing="1">
							<tr>
								<td>
									<div class="texto">
										<input id="nombre" type="text" size="28" onClick="this.value=''" name="nombre" value="Nombre"/>
									</div>
								</td>
								<td class="titulo">
									Nombre
								</td>
							</tr>
							<tr>
								<td>
									<div class="texto">
										<input id="apellido" type="text" size="28" onClick="this.value=''" name="apellido" value="Apellido"/>
									</div>
								</td>
								<td class="titulo">
									Apellido
								</td>
							</tr>
							<tr>
								<td>
									<div class="texto">
										<input id="email" type="text" size="28" onClick="this.value=''" name="email" value="Email"/>
									</div>
								</td>
								<td class="titulo">
									Email
								</td>
							</tr>
							<tr>
								<td>
									<div style="position:relative; cursor:pointer;">
										<div id="contenedor_combo" onClick="abrirCombo();">
											<div id="combo_titulo" style="float:left;">
											<?if($equipo!="default"){
												echo $equipos[$equipo]->nombre;
											  }else{?>	
												Seleccion un equipo
											<?}?>
											</div>
											<div id="flecha_combo">
											</div>
										</div>
										<div id="combo" style="position:absolute; display:none; background-color:#9f9c9c;" onBlur="abrirCombo();">
											<div id="opciones">
												<ul>
													<?foreach($equipos as $row){
														if($row->id!=''){?>
															<li id="equipo_<?=$row->id?>" onClick="cambiarDominio(<?=$row->id?>,'<?=$row->nombre?>','combo_titulo');";">
																<?=$row->nombre?>
															</li>
													<?	}
													  }?>
												</ul>
											</div>
										</div>
									</div>
								</td>
								<td class="titulo">
									Equipo
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</center>
		<script>
			var cmb=0;
	
			function cambiarDominio(id,nombre,titular){
				$(titular).innerHTML=nombre;
				$('equipo').value=nombre;
				$('equipo_id').value=id;
				$('combo').hide();
				$('general').className="equipo_fondo_"+id;
				cmb=0;
			}
	
			function abrirCombo(){
				if(cmb)
					$('combo').hide();
				else
					$('combo').show();
				cmb=(cmb*-1)+1;
			}

			function enviarFormulario(){
				var check=0;
				if($('nombre').value!="" && $('nombre').value!="Nombre"){
					check++;
				}
				if($('apellido').value!="" && $('apellido').value!="Apellido"){
					check++;
				}
				if(($('email').value!="" && $('email').value!="Email") && $('email').value.indexOf('@')!=-1 && $('email').value.indexOf('.')!=-1 ){
					check++;
				}
				if($('equipo_id').value!=""){
					check++;
				}
				if(check==4)
					document.forms['suscripcion'].submit();
				else
					$('error').innerHTML="Datos incorrectos";
			}
		</script>
	</body>
</html>