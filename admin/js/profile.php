<div id='modulo' style="background-color:white; font-size:14px;">
<script type="text/javascript" src="http://www.futbolecuador.com/js/jquery.min.js"></script>
	<table class='noticias_plus' cellpadding="0" cellspacing="0" width="100%">
	<tr>
	<th>La Entrevista</th>
	</tr>
	</table>
	
	<div onclick="location.href='<?=base_url().'profiles/publica/'.$profile->id;?>'" style='width:226px; height:190px; position:relative; cursor:pointer; background-image:url("<?=base_url().$profile->picture_box;?>");'  >
		<div style='width:226px;height:112px;top:78px;left:0px;position:absolute;color:white;background-image:url("<?=base_url().'imagenes/template/public/sombra_modulo.png'?>");'>
			<div style="z-index:100;position:absolute; top:45px; left:0px; width: 220px; height:30px; color:#FFFFFF; padding: 5px; padding-top:0px; font-family: arial;font-size:20px; font-weight:bold;">	
				<?=$profile->first_name.' '.$profile->last_name;?>
			</div>
			<div style="z-index:100;position:absolute; top:70px; left:0px; width: 220px; height:40px; color:#FFFFFF; padding: 5px; font-family: arial;font-size:14px;">	
				<?=$profile->title;?>
			</div>
		</div>
	</div>

</div>