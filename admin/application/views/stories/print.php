<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?=$noticia->title?></title>
<link type="text/css" rel="stylesheet" href="<?=base_url();?>css/print.css" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body onload="window.print();">
<div align='center' >
<?=img('imagenes/logo.jpg');?>
	<div id='print_story'>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr><td class='title'><?=$noticia->title?></td></tr>
			<tr><td class='subtitle'><?=$noticia->subtitle?></td></tr>
			<tr><td class='date'>Publicado el <?=$noticia->modified?></td></tr>
			<tr><td class='origen'><?=$noticia->origen?></td></tr>
			<tr><td class='lead'><?=$noticia->lead?></td></tr>
			<tr><td class='body'><?=$noticia->body?></td></tr>
		</table>
	</div>
	<div style='font-size: 13px; color: gray;'>
	<br />
	E-mail: webmaster@futbolecuador.com <br/>
	Copyright 1990 - 2009 futbolecuador.com
	</div>
</div>
</body>
</html>