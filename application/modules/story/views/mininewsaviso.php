<div class="row">
    <?php foreach ($noticias as $noticia) {
        $linkShort = base_url() . 'site/'.$nameSectionUrl;
        $link = $linkShort .'/' . $this->contenido->_urlFriendly ($noticia->title) . '/' . $noticia->id;
        // caso abre seccion
        if (isset($noticia->openseccion)) {
            if ($noticia->openseccion != '')
            $link = base_url() . $noticia->openseccion;
        }
        ?>
        <div class="col-md-12 lineseparador separador10">
            <div class="row">
                <div class="col-md-2 ">
                    <a href="<?php echo $link ?>"><img src="http://www.futbolecuador.com/<?php echo $noticia->thumb3; ?>" alt="<?php echo str_replace('"', '', "$noticia->title"); ?>" title="<?php echo str_replace('"', '', "$noticia->title"); ?>"></a>
                </div>
                <div class="col-md-10  ">
                    <h2 style="font-size: 16px;"> <a style="color:#000;" href="<?php echo $link ?>"><?php echo $noticia->title; ?></a></h2>
                    <?php
                    if (strlen(strip_tags($noticia->lead)) == 0) {
                        $num = 100;
                        $str = strip_tags($noticia->body);
                        $str = substr($str, 0, $num);
                        $bodyCortado = substr($str, 0, -(strlen($str) - strrpos($str, ' ')));
					?>
                      <a style="color:#000;" href="<?php echo $link ?>" class="sidebarlink"><?php echo $bodyCortado ?>... </a>
                      <?php 
                    } else {?>
                       <a style="color:#000;" href="<?php echo $link ?>" class="sidebarlink"><?php echo strip_tags($noticia->subtitle) ?></a>
                       <?php 
                    }?>
                </div>
            </div>
        </div>

    <?php } ?>
</div>
<div class="col-md-12 text-right fondoazul separador10">
    <a href="<?php echo $linkShort;?>"?>Más Noticias</a>
</div>