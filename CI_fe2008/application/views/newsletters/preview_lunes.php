<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Boletin futbolecuador.com</title>
<link rel="stylesheet" type="text/css" media="all" href="<?=base_url()?>/css/newsletter.css" />
</head>

<body>
<table width="700" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1579" ><table width="700" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="504"><img src="<?=base_url()?>imagenes/newsletter/boletin_02.jpg" width="497" height="64" /></td>
        <td width="196"  style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #00426f; font-weight: bold;"><?=ucfirst(strftime('%A, %d %B %Y'));?></td>
      </tr>
    </table>
    <div align="left"></div></td>
  </tr>
  <tr>
    <td height="266">
    	<table width="691" border="0" cellspacing="0" cellpadding="0">
    		<tr>
    			<td width="333">
    				<table width="691" border="0" cellspacing="0" cellpadding="0">
      					<tr>
        					<td colspan="4"><img src="<?=base_url()?>imagenes/newsletter/boletin_04.jpg" width="700" height="15" /></td>
      					</tr>
     					<tr>
        					<td width="30">
        						<img src="<?=base_url()?>imagenes/newsletter/boletin_05.jpg" width="29" height="170" />
        					</td>
        					<td width=180 align="center" valign="middle">
        						<div style='width:160px; height:160px; border:1px solid #05398C;'>
        							<a href="<?=base_url().$first->id;?>"><img src="<?=base_url().$first->thumbh160;?>" /></a>
								</div>
        					</td>
					        <td valign=top width="460" height="0">
					        	<span style="font-family: Arial, Helvetica, sans-serif; font-size: 15pt; color: #000000; font-weight: bold;"><a href="<?=base_url().$first->id;?>"><?=$first->title;?></a></span><br />
					            <span style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; font-style: italic;"><?=$first->subtitle;?></span><br />
					          	<span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #000000; text-align: justify;"><?=$first->lead;?></span>
					        </td>
					        <td width="32">
					        	<img src="<?=base_url()?>imagenes/newsletter/boletin_09.jpg" width="32" height="170" />
					        </td>
      					</tr>
      					<tr>
					        <td height="33" colspan="4">
					        	<img src="<?=base_url()?>imagenes/newsletter/boletin_12.jpg" width="700" height="33" />
					        </td>
						</tr>
    				</table>
    			</td>
			</tr>
    	</table>
	</td>
  </tr>
  <tr>
    <td>
    
    <table width="700px" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td valign='top'>
    <p style="font-size: 14pt; color: #00426f; font-family: Arial, Helvetica, sans-serif; font-weight: bold;">Resultados</p>
    <?php foreach($partidos as $row):?>
	    <table width="330px" border="0" cellspacing="0" cellpadding="0">
	    <tr>
	    	<td width="25px"><img src="<?=base_url().$row->hshield;?>" /></td>
	        <td width="90px" align='left' style='font-family: Arial, Helvetica, sans-serif; font-size: 12px;'><?=$row->hname;?></td>
	        <td width="50px" align='center' style='font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold;'><?=$row->result;?></td>
	        <td width="90px" align='right' style='font-family: Arial, Helvetica, sans-serif; font-size: 12px;'><?=$row->aname;?></td>
	        <td width="25px" align='right'><img src="<?=base_url().$row->ashield;?>" /></td>
	    </tr>
		<tr>
		<td colspan="5" align="center">
		<img src="<?=base_url()?>imagenes/newsletter/boletin_18.jpg" width="383" height="16" /></td>
	    </tr>
	    </table>
    <?php endforeach;?>
    </td>
    <td>
    <!-- BANNER 1 - 290 x 290 -->
    <div style='width:290px; height:290px;'>
    <a href='http://d1.openx.org/ck.php?zoneid=250741' target='_blank'><img src='http://d1.openx.org/avw.php?zoneid=250741&amp;cb=<?=rand();?>' border='0' alt='' /></a>
    </div>
    </td>
    </tr>
    </table>
    <br />
    <br />
    </td>
  </tr>
  <tr>
    <td><table width="700" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign=top height="27" style="font-size: 14pt; color: #00426f; font-family: Arial, Helvetica, sans-serif; font-weight: bold;">Noticias</td>
      </tr>
      <?php 
      foreach($query as $row):
      ?>  
  	<tr>
        <td><table width="700" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="97" height="81" valign=top>
            	<div align="left">
            		<a href="<?=base_url().$row->id;?>"><img src="<?=base_url().$row->thumbh80?>" width="80" height="80" /></a>
            	</div>
            </td>
            <td width="603" valign=top>
            	<span style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold;"><a href="<?=base_url().$row->id;?>"><?=$row->title;?></a></span><br />
              	<span style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-style: italic;"><?=$row->lead;?></span>
            </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="<?=base_url()?>imagenes/newsletter/boletin_37.jpg" width="679" height="19" /></td>
      </tr>
      <?php endforeach;?>
    </table></td>
  </tr>

  <tr>
    <td height="77">
    <div align="center">
    <!-- BANNER 2 -->
    </div></td>
  </tr>
  <tr>
    <td><p align="center" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #00426f; font-weight: bold;">Ley de Comercio Electrónico del Ecuador: Este mensaje no puede ser considerado SPAM.</p>
    <p align="center" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #00426f; font-weight: bold;">De acuerdo a la Ley de Comercio Electrónico del Ecuador y su Reglamento publicado en el Registro Oficial 735 del 31 de diciembre de 2002 decreto No.3496 Artículo 22.- Si usted recibe este mensaje por error o desea ser removido de nuestra lista, por favor <a href="<?=base_url()?>newsletters/unregister">HAGA CLICK AQUI</a> para remover su dirección de la lista.</p></td>
  </tr>
</table>
</body>
</html>