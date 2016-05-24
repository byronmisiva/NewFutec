<?php
foreach ($noticias as $noticia) {?>
	  <div class="col-xs-6 col-md-3 m-0 m-x-1 mg-n-10" onclick="ga('send', 'event', 'relacionadas', 'click', 'noticia');">
	        	<?php echo $noticia ?>
	  </div>
    <?php
}
?>
