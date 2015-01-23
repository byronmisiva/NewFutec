<table width=100% style="background-color:white">
	 <tr>
		 <td>
		 <?if($user['user']=="guest" || !$user['user']){?>
		 	<table width=100%>
		 			<tr>
		 				<td width=100% align="center">
		 					<span  style="color: black; font-size:12px; "><a style="color:black" href="<?=base_url().'blackberries/user_login'?>"><u>Ingreso</u></a></span><br/>
							<a href="http://m.facebook.com/tos.php?api_key=f6c729bd0207da3f727fd2c70a990eb0&amp;v=1.0&amp;next=http%3A%2F%2Fwww.futbolecuador.com/welcome/blackberry%2F&amp;cancel=http%3A%2F%2Fwww.futbolecuador.com/welcome/blackberry%2F"><img style="border-color:white" id="fb_login_image" src="http://static.ak.fbcdn.net/images/fbconnect/login-buttons/connect_light_medium_long.gif" alt="Connect"></a>
		 				</td>
		 			</tr>  	
		 		</table>
		 
		 <?}
		   else{?>
		 		<table width=100%>
		 			<tr>
		 				<td width=100% align="center">	
		 					<span style="color: black; font-size:12px">Bienvenido <?='<b>'.$user['user'].'</b>'?></span><br/>
		 					<span  style="color: black; font-size:12px"><a style="color:black;" href="<?=base_url().'blackberries/logout'?>"><u>Salir</u></a></span>
		 				</td>
		 			</tr>  	
		 		</table>
		 <?}?>
		 </td>
	 </tr>
</table>