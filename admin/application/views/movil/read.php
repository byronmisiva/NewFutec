<table style='width: 98%;margin:0 auto; text-align:left;'>
	<?if($this->uri->segment(5)!=FALSE){?>
	<tr>
		<td colspan="2" style="align=center;">
			<div style='background-color: #FFEAEB; padding: 3px; text-align: center; font-size: 12px; color: #843558; margin: 10px;'>
				Noticia Enviada Exitosamente
			</div>
		</td>
	</tr>
	<?}?>	

	<tr>
		<?$row=$stories?>
		<td width="130" rowspan=3  valign="top">
			<img src="<?=base_url().$row->thumbh120?>" width="120" height="120" border="0"/>
		</td>
		<td style='border'>
			<?if(mdate('%Y-%m-%d',time())==(mdate('%Y-%m-%d',$row->datem))){?>
				<span class="date"><?=ucfirst(strftime('%B %d %H:%M',$row->datem))?></span>
				<?}else{?>
				<span class="date"><?=ucfirst(strftime('%B %d',$row->datem))?></span>
				<?}?>
		</td>
	</tr>
	<tr>
		<td>
			<div style='margin-bottom:5px;'><?=$row->origen;?></div>
			<div id='compartir'>
				<div id='twitter' style='margin-top:5px;margin-bottom:5px;'>
					<a href="http://twitter.com/share" class="twitter-share-button" data-url="http://en.fut.ec/?l=<?=$row->id;?>" data-text="<?=$row->twitter;?>" data-count="horizontal" data-via="futbolecuador" data-lang="es" data-counturl="http://www.futbolecuador.com/stories/publica/<?=$row->id;?>">Tweet</a>
					<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
				</div>
				<div id='facebook' style='margin-top:5px;margin-bottom:5px;'>
					<iframe src="http://www.facebook.com/plugins/like.php?href=<?=urlencode('http://www.futbolecuador.com/stories/publica/'.$row->id);?>&amp;layout=button_count&amp;show_faces=false&amp;width=90&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=20" style="border:none; overflow:hidden; width:90px; height:20px;"></iframe>
				</div>
				<div style='margin-top:5px;margin-bottom:5px;' onclick="ga('send', 'event', 'whatsApp','click','CompNoticia');">

<!--<a href="whatsapp://send" data-text="<?php echo $row->subtitle?>" 
			  data-href="" 
                          class="wa_btn wa_btn_s" ><img src="<?php echo base_url()?>imagenes/moviles/boton-whatapp2.png" /></a>-->

		</div>
    <div style='margin-top:5px;margin-bottom:5px;'>
    <a class='ssba'
       data-action='share/whatsapp/share'
       href='whatsapp://send?text= <?=$row->title?> <?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$this->uri->segment(4)?>'>
       <img border='0' src='<?php echo base_url()?>imagenes/moviles/boton-whatapp2.png' /></a>
    </div>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<span class="title"><?=$row->title?></span>
		</td>
	</tr>
	<tr>
		<td colspan=2>
			<span class="subtitle"><?=$row->subtitle?></span>
		</td>	
	</tr>
	<tr>
		<td colspan=2>
			<div class="body">
			<?
			$row->body=str_replace(' width="500" height="281" ',' width="320" height="180" ',$row->body);
			
			echo $row->lead.html_entity_decode($row->body,ENT_QUOTES,'UTF-8' );
			
			?>
			</div>
			<div id='twitter' style='text-align:left;margin-bottom:10px'>
			<img style="float:none;margin-left:0px;margin-bottom:5px;" src="<?=base_url()?>imagenes/icons/twitter_completo.png" />
				<br />
				<a href="http://www.twitter.com/<?=$author->twitter;?>" style='color:#5599BB;' target='_blank'>@<?=$author->twitter;?></a>
			</div>
		<!-- <tr>
			<td colspan=2 style="height:auto ;">
			<?php if($this->uri->segment(2)=="read"){?>
				<!-- FE_SMART_MIDDLE 
					<div id='div-gpt-ad-1383593619381-3' style='width:320px; height:50px;margin:0 auto;'>
					<script type='text/javascript'>
					googletag.cmd.push(function() { googletag.display('div-gpt-ad-1383593619381-3'); });
					</script>
					</div >
					<?php }?>
			</td>
		</tr> -->
		
		<tr>
			<td>			
				<a id="ck_email" class="stbar chicklet" href="javascript:void(0);"><img src="http://w.sharethis.com/chicklets/email.gif" /></a>
				<a id="ck_facebook" class="stbar chicklet" href="javascript:void(0);"><img src="http://w.sharethis.com/chicklets/facebook.gif" /></a>
				<a id="ck_twitter" class="stbar chicklet" href="javascript:void(0);"><img src="http://w.sharethis.com/chicklets/twitter.gif" /></a>
				<a id="ck_sharethis" class="stbar chicklet" href="javascript:void(0);"><img src="http://w.sharethis.com/chicklets/sharethis.gif" />ShareThis</a>
				<script type="text/javascript">
					var shared_object = SHARETHIS.addEntry({
					title: document.title,
					url: document.location.href
				},{offsetLeft: -50, offsetTop: -10});
				
				shared_object.attachButton(document.getElementById("ck_sharethis"));
				shared_object.attachChicklet("email", document.getElementById("ck_email"));
				shared_object.attachChicklet("facebook", document.getElementById("ck_facebook"));
				shared_object.attachChicklet("twitter", document.getElementById("ck_twitter"));
	
				shared_object.attachButton(document.getElementById("ck_sharethis2"));
				shared_object.attachChicklet("email", document.getElementById("ck_email2"));
				shared_object.attachChicklet("facebook", document.getElementById("ck_facebook2"));
				shared_object.attachChicklet("twitter", document.getElementById("ck_twitter2"));
				</script>
		</td>
	</tr>
	<tr>
		<td colspan="2">
		<div class="fb-comments" style='margin-top:5px;' data-href="<?=base_url().'stories/publica/'.$row->id;?>" data-width="320" data-num-posts="5"></div>
		</td>
	</tr>
</table>
