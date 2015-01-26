<div id='story_open'>
	<div style="position: absolute; top: 0px; left: 0px;">
		<img src='<?=base_url();?>imagenes/protect2.png' width='500' height='1500'>
	</div>
	<div id='title'><?=$profile->title;?></div>
	<div id='fecha'><?=$profile->created;?></div>
	<hr />
	<div><?=img($profile->picture1)?></div>
	<div id='share2' style='width: 118px; text-align: left;'><a
		id="ck_email2" class="stbar chicklet" href="javascript:void(0);"><img
		src="http://w.sharethis.com/chicklets/email.gif" /></a> <a
		id="ck_facebook2" class="stbar chicklet" href="javascript:void(0);"><img
		src="http://w.sharethis.com/chicklets/facebook.gif" /></a> <a
		id="ck_twitter2" class="stbar chicklet" href="javascript:void(0);"><img
		src="http://w.sharethis.com/chicklets/twitter.gif" /></a> <a
		id="ck_sharethis2" class="stbar chicklet" href="javascript:void(0);"><img
		src="http://w.sharethis.com/chicklets/sharethis.gif" /></a>
	</div>
	<br />
	<br />
	<div id='fecha'><?if($this->session->userdata('role')>=3) echo 'Lecturas: '.$profile->reads;?>
	</div>
	<div id='body'>
		<?=$profile->text?><br/><br/>
	</div>
	<div id='photos'>
		<a href='<?=base_url().$profile->picture1;?>' rel="lightbox[entrevista]"><img src='<?=base_url().$profile->picture1;?>' width='150px' border='1'></a>
		<a href='<?=base_url().$profile->picture2;?>' rel="lightbox[entrevista]"><img src='<?=base_url().$profile->picture2;?>' width='150px' border='1'></a>
		<a href='<?=base_url().$profile->picture3;?>' rel="lightbox[entrevista]"><img src='<?=base_url().$profile->picture3;?>' width='150px' border='1'></a>
	</div>
	
	
	<div id='comments' style='margin-top:10px;' >
		<div id='title'>Comentarios - Términos de Uso</div>
		<div style='text-align:justify; color:#4F4F4F; font-size:12px;'>
			<div style='font-size:8px; list-style-type:square; padding: 8px;'>	
				<p>
				futbolecuador.com recibe sus comentarios y les da la bienvenida a este foro publico.
				El objetivo de este sitio es el presentar información objetiva e inmediata sobre el fútbol ecuatoriano e internacional y agradecemos mucho los comentarios de nuestros visitantes y usuarios.
				</p>
				<p>
				Los comentarios de nuestros usuarios provienen de su perfil publico de Facebook, y no representan las opiniones o creencias de los integrantes de futbolecuador.com, y nos reservamos el derecho de eliminar comentarios que contengan spam, insultos, publicidad no solicitada, enlaces a otras paginas, o que agredan de cualquier manera a la moral de cualquier otro usuario, futbolista, dirigente, o persona natural.
				</p>
				<p>
				Los comentarios que no cumplan con el objetivo común de futbolecuador.com , de informar al mundo sobre el fútbol ecuatoriano, serán eliminados, y en caso de reincidencias de parte de los usuarios, estos serán bloqueados.
				</p>
			</div>
		</div>
		<div style='margin-top:10px;'>
			<fb:comments xid="futec_profile_<?=$profile->id;?>" width="500"></fb:comments>
		</div>
	</div>
</div>