<table class="news" cellpadding="2" cellspacing="0">
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
		<th width="123" rowspan=4>
			<img src="<?=base_url().$row->picture_box?>" border="0" width="120px"/>
		</th>
		<th width="260">
			<?if(mdate('%Y-%m-%d',time())==(mdate('%Y-%m-%d',$row->datem))){?>
				<span class="date"><?=ucfirst(strftime('%B %d %H:%M',$row->datem))?></span>
				<?}else{?>
				<span class="date"><?=ucfirst(strftime('%B %d',$row->datem))?></span>
				<?}?>
		</th>
	</tr>
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td><a id="ck_email2" class="stbar chicklet" href="javascript:void(0);"><img src="http://w.sharethis.com/chicklets/email.gif" /></a>
			<a id="ck_facebook2" class="stbar chicklet" href="javascript:void(0);"><img src="http://w.sharethis.com/chicklets/facebook.gif" /></a>
			<a id="ck_twitter2" class="stbar chicklet" href="javascript:void(0);"><img src="http://w.sharethis.com/chicklets/twitter.gif" /></a>
			<a id="ck_sharethis2" class="stbar chicklet" href="javascript:void(0);"><img src="http://w.sharethis.com/chicklets/sharethis.gif" />ShareThis</a></td>
				</tr>
			</table>
			
		</td>
	</tr>
	<tr>
		<th width="183">
			<span class="title"><?=$row->title?></span>
		</th>
	</tr>
	<tr>
		<th width="183">
			<span class="subtitle"><?=''?></span>
		</th>	
	</tr>
	<tr>
		<td colspan=2>
			<span class="body"><?=$row->text?></span>
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
		Comentarios:<br />
		<fb:comments xid="futec_profile_<?=$row->id;?>" width="320"  migrated="1"></fb:comments>
		</td>
	</tr>
</table>
