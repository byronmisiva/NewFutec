<?php $link = base_url() . 'site/noticia/' . $this->contenido->_urlFriendly($noticia->title) . '/' . $noticia->id; ?>
<div class="row clearfix news-open separador10respon noticiaabierta">
    <div class="col-md-12 separador10">
        <div class="col-md-7 margen10r">
            <div class="row">
                <img class="img-responsive margen10b margen10r margen0-sx"
                     src="http://www.futbolecuador.com/<?php echo $noticia->thumb400; ?>"
                     alt="<?php echo $noticia->image_name; ?>">
            </div>
        </div>
        <div class="margen10lados-sx">
            <?php setlocale(LC_ALL, "es_ES");
            echo $noticia->origen . ", " . strftime("%A, %d %B %Y", strtotime($noticia->created)); ?>
        </div>
        <h1><?php echo $noticia->title; ?></h1>

        <div class="margen10lados-sx">
            <h2 class="gris sub margen10lados-sx"><?php echo $noticia->subtitle; ?></h2>
        </div>
        <div class="col-md-5  col-xs-12">
            <div class="col-md-6 col-xs-4">
                <div class="fb-like" data-href="<?= 'http://www.futbolecuador.com/stories/publica/' . $noticia->id; ?>"
                     data-send="false" data-layout="box_count" data-width="90" data-show-faces="false" data-font="arial"></div>
            </div>
            <div class="col-md-6 col-xs-4">
                <a href="http://twitter.com/share" class="twitter-share-button"
                   data-url="http://en.fut.ec/?l=<?= $noticia->id; ?>" data-text="<?= $noticia->twitter; ?>"
                   data-count="vertical" data-via="futbolecuador" data-lang="es"
                   data-counturl="http://www.futbolecuador.com/stories/publica/<?= $noticia->id; ?>">Tweet</a>
                <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
            </div>
            <div class="col-md-0 col-xs-4  ">
                <!--        Tag para watsapp-->
                <?php if ($isMobile){
                    ?>

                    <a class='ssba'
                       data-action='share/whatsapp/share'
                       href='whatsapp://send?text= <?=$noticia->title?> <?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3)?>'>
                        <img border='0' src='<?php echo base_url()?>imagenes/moviles/boton-whatapp2.png' /></a>

                <?php
                } ?>
            </div>
        </div>

        <div class="margen10lados-sx  separador5">
            <?php echo html_entity_decode($noticia->lead, ENT_COMPAT, 'UTF-8'); ?>
        </div>
        <div class="margen10lados-sx">
            <?php echo html_entity_decode($noticia->body, ENT_COMPAT, 'UTF-8'); ?>
        </div>
    </div>
</div>

<div class="col-md-12 column content-gris hidden-xs">
    <div class="col-md-4 col-xs-4 column margen0">
        Lecturas <?php echo $noticia->lecturas; ?>
    </div>
    <div class="col-md-8 col-xs-8 column margen0 text-right text-news-zone">
        <?php echo $noticia->tags[0]->name; ?>
    </div>
</div>

<div class="col-xs-12 col-md-12 backcuadros block-title separador20">
    <h4 class="panel-title">Comentarios </h4>
</div>

<div class="separador20 col-xs-12 col-md-12 center-block" data-href="<?php //echo $url?>">
    <div class="fb-comments" data-href="<?php echo $link ?>" data-width="100%" data-numposts="5"
         data-colorscheme="light"></div>
</div>
