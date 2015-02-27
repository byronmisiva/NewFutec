<!DOCTYPE html>
<html>
<head>
	<title>Twitter Feed</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=625, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	
	<style>
		body{
			padding:0;
			margin:0;
		}
		
		.campo{
			
			position:relative;
			height:30px;
			font-family:Helvética,sans-serif;
			color:white;
			font-size:15px;
			
		}
		
		.campo #texto{
			position:absolute;
			top:12px;
			left:8px;
		}
		
		.campo #valor{
			position:absolute;
			top:5px;
			left:165px;
			padding:3px;
			padding-left:8px;
			width:410px;
			background-color:#BFBFBF;
			border-radius:5px;
			
		}
		
		.campo input{
			width:385px;
			font-size:14px;
			background-color:transparent;
			border:0px;
			height:15px;
		}
		
		.campo textarea{
			width:385px;
			font-size:14px;
			background-color:transparent;
			border:0px;
		}
		
		.mensaje{
		 width:625px;
		 font-family:Helvética,sans-serif;
		 font-size:35px;
		 padding:10px;
		 text-align:center;
		}
		
		.boton{
		 width:94%;
		 margin-top:15px;
		 text-align:right;
		}
		
	</style>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="<?=base_url();?>js/jquery.mobile-1.3.0.js"></script>

	<script>
	$.mobile.loadingMessage = false;
	
	function sendForm(){

		if($('#nombre').val() != "" && $('#correo').val() != "" && $('#comentario').val() != ""){

			$.ajax({
				  type: 'POST',	
				  url: '<?=base_url();?>magazine/send_form',
				  cache: true,
				  timeout: 100000,
				  data: $('#form_comentario').serialize()
				}).done(function( html ) {
				  $(".formulario").html(html);
				});
		}
	}
	</script>
</head>

<body style='background-color:transparent;'>

<div class="formulario" style='width:625px;'>
	<form id='form_comentario' name='form_comentario'>
		<div class="campo"> 
			<div id='texto'>Nombre:</div>
			<div id='valor'><input id='nombre' name='nombre'></div>
		</div>
		<div class="campo"> 
			<div id='texto'>Correo electrónico:</div>
			<div id='valor'><input id='correo' name='correo'></div>
		</div>
		<div class="campo" style='height:100px;'> 
			<div id='texto'>Comentario:</div>
			<div id='valor'><textarea id='comentario' name='comentario' rows="5" cols="50"></textarea></div>
		</div>
		<div class='boton' onclick='sendForm();'><img src='<?=base_url();?>imagenes/magazine/button_form.png' /></div>
	</form>
</div>

</body>

</html>