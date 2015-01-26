

<div id='fondo_brand' style='position:fixed; _position:absolute; top:98px; left:50%; width:1050px; height:800px; margin-left: -900px;'>
	<!-- FE_SKIN -->
	<script type='text/javascript'>
	GA_googleFillSlot("FE_SKIN");
	</script>
</div>

<div id='container_sky' style="position:relative; margin-left:auto; margin-right:auto;width:970px; height:90px;">
	<div style="position:absolute;top:0px;left:0px">
		<!-- FE_SKY -->
		<script type='text/javascript'>
		GA_googleFillSlot("FE_SKY");
		</script>
	</div>
	<div id='Scoreboards' style="position:absolute;top:0px;right:0px">
		<!-- <script type="text/javascript">
			AC_FL_RunContent('codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','240','height','90','src','<?=base_url()?>archivos/varios/marcador_vivo','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','wmode','transparent','movie','<?=base_url()?>archivos/varios/marcador_vivo','flashvars','base=<?=base_url()?>');
    	</script> -->
	</div>
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
								<td><a href='<?=base_url()?>'><img src="<?=base_url()?>imagenes/template/public/fe-logo-desktop.png" border="0" alt="futbolecuador.com" /></a></td>
								<td valign='bottom'>
									<table width="200" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td>
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
                                                        <td width="250" align='right'>
                                                            <div
                                                                style="width: 250px; height: 25px; position: relative; text-align: center;">
                                                                <div
                                                                    style='position: absolute; top: 3px; left: 0px;'>
                                                                    <a href="https://twitter.com/futbolecuador" class="twitter-follow-button" data-show-count="false" data-lang="es">Seguir a @futbolecuador</a>
                                                                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                                                                </div>
                                                                <div
                                                                    style='position: absolute; top: 3px; left: 160px;'>
                                                                    <div class="fb-follow"
                                                                         data-href="https://www.facebook.com/futbolecuador"
                                                                         data-layout="button_count"
                                                                         data-show-faces="true"
                                                                         data-width="160"></div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td valign='top'><img
                                                                src="<?=base_url()?>imagenes/template/public/publicidad.png"
                                                                border="0" id="Image4"
                                                                onmouseover="MM_swapImage('Image4','','<?=base_url()?>imagenes/template/public/publicidad_gris.png',1)"
                                                                onmouseout="MM_swapImgRestore()"
                                                                onclick='Modalbox.show("<?=base_url()?>popups/pauta", {title: " ", width: 305 ,overlayClose: false}); return false;'
                                                                alt="Publicidad"/>
                                                        </td>												</tr>
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
		                          	<!-- FE_HP_1 -->
									<script type='text/javascript'>
									GA_googleFillSlot("FE_HP_1");
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

                <!-- FE_BARRA_MENU -->
                <div id='div-gpt-ad-1404162556749-0' style='width:970px; height:inherit;'>
                    <script type='text/javascript'>
                  //      googletag.cmd.push(function() { googletag.display('div-gpt-ad-1404162556749-0'); });
                    </script>
                </div>

	        </td>
	      </tr>
	    </table></td>
	  </tr>
	</table>
	</div>
