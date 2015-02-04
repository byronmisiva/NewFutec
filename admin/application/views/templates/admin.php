<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?=$title ?></title>
<?=$_scripts ?>
<script src="http://www.google.com/jsapi"></script>
<script>
  google.load("prototype", "1.7.0.0");
  google.load("scriptaculous", "1.8.3");
</script>
<script type="text/javascript" src="<?=base_url()?>js/effects.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/tiny_mce/tiny_mce.js"></script>		
<script type="text/javascript" src="<?=base_url()?>js/scripts.js?refresh=987654321065646556456"></script>
<script type="text/javascript" src="<?=base_url()?>js/modalbox.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/tiny_conf.js?refresh=999"></script>
<?=$_styles ?>
<link type="text/css" rel="stylesheet" href="<?=$path ?>css/modalbox_admin.css" />
<link type="text/css" rel="stylesheet" href="<?=$path ?>css/main.css" />


</head>
<body>
<table width="1100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%"><div align="right"><a href='http://www.futbolecuador.com/site/home/<?php echo rand(5, 15);?>'><img src="<?=$path?>imagenes/titulo.jpg" width="525" height="76" border='0' alt='' /></a></div></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
      	<td>
	      	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		      	<tr>
			        <td width="17" valign="top" align="left"><img src="<?=$path ?>imagenes/1.jpg" width="17" height="15" /></td>
			        <td width="966">&nbsp;</td>
			        <td width="17" valign="top" align="right"><img src="<?=$path ?>imagenes/2.jpg" width="17" height="15" /></td>
		      	</tr>
	      	</table>
	    </td>
      </tr>
      <tr>
        <td>
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		      	<tr>
			        <td width="800" valign="top">
				        <div id="content" class="content">
				      		<?=$content ?>
				   		</div>
			        </td>
	        		<td width="200" class="menu" valign="top">
		        		<div id="user_data">
		        			<div id="user" style='text-align:center; width:180px;'>
		        				<?=$this->session->userdata('username');?>
		        			</div>
		        			<div id='logout'>
		        			<a href='<?=base_url();?>users/logout'>Salir</a>
		        			</div>
		        		</div>
		        		<div id="menu">
				      		<?=$menu?>
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
	      	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		      	<tr>
			        <td width="17" valign="bottom" align="left"><img src="<?=$path ?>imagenes/3.jpg" width="17" height="15" /></td>
			        <td width="966">&nbsp;</td>
			        <td width="17" valign="bottom" align="right"><img src="<?=$path ?>imagenes/4.jpg" width="17" height="15" /></td>
	      		</tr>
	      	</table>
      	</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>