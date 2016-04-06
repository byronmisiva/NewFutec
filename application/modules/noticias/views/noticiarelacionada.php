<?php if (isset($tipoLink)) {
    if ($tipoLink == "secction") {
        $link = base_url() . 'site/' . $urlsecction . '/' . $this->noticias->_urlFriendly($story->title) . '/' . $story->id;
    } else {  }
} else {
    $link = base_url() . 'site/noticia/' . $this->noticias->_urlFriendly($story->title) . '/' . $story->id;
}
?>

	<a  href="<?php echo $link ?>" onclick="ga('send', 'event', 'Relacionadas', 'click', 'noticia');">
		<div class="col-xs-4 col-md-12 img-relacionada" >
			<img src="http://www.futbolecuador.com/<?php echo $story->thumbh120; ?>"
			     alt="<?php echo str_replace('"', '', "$story->title"); ?>"
			     title="<?php echo str_replace('"', '', "$story->title"); ?>"			     
			 	/>
		 </div>
		 <div class="col-xs-8 col-md-12 titular-reciente">
				 <?php echo $story->title ?>
		 </div>
		 </a>


 

