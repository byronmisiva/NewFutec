<div id='story_open'>
	<div style="position: absolute; top: 70px; left: 200px;"><img src='<?=base_url();?>imagenes/protect2.png' width='300' height='382'></div>
	<div id='title'><?=$noticia->title?></div>
	<div id='subtitle'><?=$noticia->subtitle?></div>
	<div><?=img(array('src'=>$noticia->thumb300,'alt'=>$noticia->image_name,'title'=>$noticia->subtitle));?></div>
	<div id='fecha'><?if($this->session->userdata('role')>=3) echo 'Lecturas: '.$noticia->reads.' | ';?><?=$noticia->created?></div>
	<div id='origen'><?=$noticia->origen?></div>
	<div id="compartir" style="width:180px; height:70px;">
		<div id='compartir_twitter' style='float:left;margin-top:5px;margin-bottom:5px; width:90px;'>
		<a href="http://twitter.com/share" class="twitter-share-button" data-url="http://en.fut.ec/?l=<?=$noticia->id;?>" data-text="<?=$noticia->twitter;?>" data-count="vertical" data-via="futbolecuador" data-lang="es" data-counturl="http://www.futbolecuador.com/stories/publica/<?=$noticia->id;?>">Tweet</a>
		<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		</div>
		
		<div id='compartir_facebook' style='float:right;margin-top:5px;margin-bottom:5px; width:90px;'>
		<div class="fb-like" data-href="<?='http://www.futbolecuador.com/stories/publica/'.$noticia->id;?>" data-send="false" data-layout="box_count" data-width="90" data-show-faces="false" data-font="arial"></div>
		</div>
		
	</div>
	<div id='body'>
		<?=$noticia->lead?> <?=html_entity_decode($noticia->body,ENT_QUOTES,'UTF-8' );?> 
	</div>
	
	<div id='twitter' style='text-align:left;'>
	<img style="float:none;margin-left:0px;margin-bottom:5px;" src="<?=base_url()?>imagenes/icons/twitter_completo.png" />
		<br />
		<a href="http://www.twitter.com/<?=$author->twitter;?>" style='color:#5599BB;' target='_blank'>@<?=$author->twitter;?></a>
	</div>
	<div id='blog'>
		<?='<br/><b>La voz de las tribunas:</b> <a href="'.base_url().'stories/publica/'.$blog[0]->id.'">'.$blog[0]->title.'</a><br/><br/>'?>
	</div>

    <div id='blog'>
        <?='<br/><b><a href="'.base_url().'fuera-de-juego">¡Quédate fuera de juego con las hinchas más guapas del fútbol ecuatoriano!</a></b><br/><br/>'?>
    </div>

	
	<div id='extras'>
	<div id='tags'>Etiquetas:<br>
	<?php
	foreach($noticia->tags as $tag){
		$link=str_replace(' ','_',$tag->name);
		if($tag->name!="")
		echo anchor('stories/tags/'.$link,$tag->name)." ";
	}
	?></div>
</div>