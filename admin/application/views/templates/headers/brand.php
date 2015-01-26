
<div id='fondo_brand' style='position:fixed; _position:absolute; top:0px; left:50%; width:1050px; height:800px; margin-left: -900px;'>
	<!-- FE_SKIN_BRAND -->
	<script type='text/javascript'>
	GA_googleFillSlot("FE_SKIN_BRAND");
	</script>
</div>

<div id='container_sky' style="position:relative; margin-left:auto; margin-right:auto;width:970px; height:90px;">
	<div style="position:absolute;top:0px;left:0px">
		<!-- FE_SKY_BRAND -->
		<script type='text/javascript'>
		GA_googleFillSlot("FE_SKY_BRAND");
		</script>
	</div>
	<div id='Scoreboards' style="position:absolute;top:0px;right:0px"></div>
	<script type="text/javascript">    	
		new Ajax.PeriodicalUpdater('Scoreboards', '<?=base_url()?>scoreboards/matches_today/ExMpLKey123', {
			evalScripts : true,	
			frequency: 60,
			decay: 2
		});	
    </script>
</div>

<div  id='container_header' style='position:relative; margin-left:auto; margin-right:auto;width:1000px;'>
	<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
	  <tr>
	    <td><table width="970" border="0" align="center" cellpadding="0" cellspacing="0">
	      <tr>
	        <td width="970"><table width="400" border="0" cellspacing="0" cellpadding="0">
	            <tr>
	              	<td>
	              		<table width="200" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td><a href='<?=base_url()?>'><img src="<?=base_url()?>imagenes/template/public/titulo_logo_aniversario_azul.png" border="0" alt="futbolecuador.com" /></a></td>
								<td valign='bottom'>
									<table width="200" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td>
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="250" align='right'>
														<div style="width:250px; height:25px; position:relative;text-align:center;">
															<div style='position:absolute;top:3px;left:15px;'>
																<g:plusone size="medium" href="http://www.futbolecuador.com"></g:plusone>
															</div>
															<div style='position:absolute;top:3px;left:110px;'>
																<div class="fb-follow" data-href="https://www.facebook.com/futbolecuador" data-layout="button_count" data-show-faces="true" data-width="160"></div>
															</div>
														</div>
														</td>
														<td valign='top'><img src="<?=base_url()?>imagenes/template/public/publicidad.png" border="0" id="Image4" onmouseover="MM_swapImage('Image4','','<?=base_url()?>imagenes/template/public/publicidad_gris.png',1)" onmouseout="MM_swapImgRestore()"  onclick='Modalbox.show("<?=base_url()?>popups/pauta", {title: " ", width: 305 ,overlayClose: false}); return false;' alt="Publicidad" /></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td><img src="<?=base_url()?>imagenes/template/public/titulo_piso_publicidad.png" alt="" /></td>
										</tr>
									</table>
				              </td>
				            </tr>
						</table>
	            	</td>
	            </tr>
	            <tr>
	              <td style="background-image: url(<?=base_url()?>imagenes/template/public/titulo_2.jpg);"><table width="960" border="0" cellspacing="0" cellpadding="0">
	                  <tr>
	                    <td width="12"></td>
	                    <td width="617" height="282" valign='top'>  
	                    <div id="rotativas">              
	                    	<script type="text/javascript">
			                	cargar_rotativa('<?=base_url()?>welcome/rotativas','rotativas',inicio,'<?=$this->session->userdata('role')?>');
			        		</script>		        			
		        		</div>
	                    </td>
	                    <td width="331" valign='top'><table width="324" border="0" cellspacing="0" cellpadding="0">
	                        <tr>
	                          <td>
	                          	<div id='FE_HP_1' style='margin-top: 5px; width: 300px; height: 250px;'>
		                          	<!-- FE_HP_BRAND -->
									<script type='text/javascript'>
									GA_googleFillSlot("FE_HP_BRAND");
									</script>
								</div>
							</td>
	                        </tr>
	                    </table></td>
	                  </tr>
	              </table></td>
	            </tr>
	            <tr>
	              <td></td>
	            </tr>
	        </table></td>
	      </tr>
	      <tr>
	        <td>
	        <div id='menu' style='position:relative;height:41px;'>
	        	<script type="text/javascript">
	        		ajax_update_script('menu','<?=base_url()?>welcome/publicMenu', '<?=base_url()?>');
	        	</script>
	    	</div>
                <object
                    classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                    codebase="http://download.macromedia.com /pub/shockwave/cabs/flash/swflash.cab#version" width="970" height="300" id="movie" align="">
                    <embed  src="<?php echo base_url()?>archivos/bannerbrasil/banner.swf" quality="high" width="970"
                            height="75" name="movie" align=""
                            type="application/x-shockwave-flash"
                            plug inspage="http://www.macromedia.com/go/getflashplayer">
                </object>
	        </td>
	      </tr>
	    </table></td>
	  </tr>
	</table>
	</div>
	
<script>
    // color personalizado fondo, (retirado Byron Herrera
    ///document.body.style.background = '#000000';
</script>