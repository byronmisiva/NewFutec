<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	</head>	
	<body style="background-color:#ffffff;width:600px;">
		<div style="position:absolute;left:0px;top:0px;width:726px;height:410px;" >			
			<div style="margin-top:20px;color:#000000;">
				<table cellpadding="5" cellspacing="5"  style="font-family:Arial; font-size:15px;text-align:left;color:#000000;">				
					<tr>
						<td style="font-weight:bold;">Nombres :</td>
						<td><?=$informacion["nombre"]?></td>
					</tr>								
					<tr>
						<td style="font-weight:bold;">Correo:</td>
						<td><?=$informacion["email"]?></td>						
					</tr>
					<tr>
						<td style="font-weight:bold;">Mensaje:</td>
						<td><?=$informacion["mensaje"]?></td>
					</tr>					
				</table>
			</div>
						
		</div>
	</body>
</html>