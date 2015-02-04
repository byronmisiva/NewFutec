<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>{title}</title>

<script src="http://www.google.com/jsapi"></script>
<script>
  google.load("prototype", "1.7.0.0");
  google.load("scriptaculous", "1.8.3");
</script>
<script type="text/javascript" src="<?=base_url()?>js/effects.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/tiny_mce/tiny_mce.js"></script>		
<script type="text/javascript" src="<?=base_url()?>js/scripts.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/ajax.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/modalbox.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/tiny_conf.js"></script>
<link type="text/css" rel="stylesheet" href="<?=base_url()?>css/modalbox_admin.css" />
<link type="text/css" rel="stylesheet" href="<?=base_url()?>css/main.css" />


</head>
<body>
<table style='width:1100; border:0px; margin:0 auto; border-spacing:0; border-collapse:collapse;' >
  <tr>
    <td width="100%"><div align="right"><a href='http://www.futbolecuador.com/site/home/<?php echo rand(5, 15);?>'><img src="<?=base_url()?>imagenes/titulo.jpg" width="525" height="76" border='0' alt='' /></a></div></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><table style='width:100%; border:0px;  border-spacing:0; border-collapse:collapse;'>
      <tr>
      	<td>
			<div id="header" style='width:100%;height:20px;'></div>
	    </td>
      </tr>
      <tr>
        <td>
        	<table style='width:100%; border:0px;  border-spacing:0; border-collapse:collapse;'>
		      	<tr>
			        <td width="800" valign="top">
				        <div class="content">
				      		{content}
				   		</div>
			        </td>
	        		<td width="200" class="menu" valign="top">
		        		<div id="user_data">
		        			<div id="user" style='text-align:center; width:180px;'>
		        				<?=$this->session->userdata('username');?>
		        			</div>
		        			<div id='logout'>
		        			<a href='<?=base_url();?>/users/logout'>Salir</a>
		        			</div>
		        		</div>
		        		<div id="menu">
				      		{menu}
				   		</div>
				   		<div id="alertas">
				   			<script type="text/javascript">
				   				new Ajax.Updater('alertas','<?=base_url()?>alerts');
				   			</script>
				   		</div>
	        		</td>
	        	</tr>
	      	</table>
	        
        </td>
      </tr>
      <tr>
      	<td>
			<div id="footer" style='width:100%;height:20px;'></div>
      	</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>