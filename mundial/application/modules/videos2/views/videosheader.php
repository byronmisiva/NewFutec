<!--        Contenidos principales-->
<!-- Tab panes -->
<?php $video =0;
$this->load->module("partidos");
?>
<div class="tab-content contenedor-videos">
    <div class="tab-pane fade in active" id="videos-contenedorc">
        <div class="row">
            <div class="col-md-12">
                <div class="video ">
                    <?php  if ($video==0) {
                        ?>
                        <div class="tab-content contenedor-videos">
                            <iframe width="100%" height="390" src="//www.youtube.com/embed/dVx_fE2e1aY" frameborder="0" allowfullscreen></iframe>
                        </div>
                        
                        <?php

                        } else {
                    ?>
    <script type="text/javascript">
        var eventsPath = "http://static.elcanaldelfutbol.com";
        var embedWidth = "100%";
        var embedHeight = "390";
        var allowfullscreen="false";
        var option = 0;
        $( document ).ready(function() {
            var eventsPath = "http://static.elcanaldelfutbol.com";
            $.getScript(eventsPath+"/events.js", function(data, textStatus, jqxhr) {

                jQuery.support.cors = true;
                jQuery.ajaxSetup({ cache: true });
                streamId = 252;
                isLiveEmbed = getURLParameter('vod') == null;
                $( "#container" ).html("<div id='player'></div>");
                $( "#container" ).show();
                loadPlayer();
            });
        });
    </script>
    <div id="container"></div>
    <div class="bloquea-video"></div>
                        <div class="video-text text-right botonpantalla movi-headline-regular"><a href="http://www4.movistar.com.ec/FIFAWorldCup/fs2/?id=252">Ver Pantalla Completa</a></div>

                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Nav tabs -->
<div class = "videos-gal-menu">
<div id="partidos-carrousel" class="list_carousel_header ">
    <a id="prev6" class="prev" href="#"><span class="glyphicon glyphicon-chevron-left"></span></a>
    <ul id="foo6" class="foo">
        <?php foreach ($listadovideos as $row) { ?>

        <li>
            <a href="<?php echo $row->url; ?>"><img class="media-object" src="<?php echo base_url('imagenes/partidos.jpg'); ?>" alt=""></a>
            <div class="video-mini-part1 text-center"><?php echo $row->local . "-" . $row->visitante; ?></div>

        </li>
        <?php } ?>

    </ul>
    <a id="next6" class="next" href="#"><span class="glyphicon glyphicon-chevron-right"></span></a>
    <div class="clearfix"></div>
</div>

<div id="goles-carrousel" class="list_carousel_header ">
    <a id="prev6" class="prev" href="#"><span class="glyphicon glyphicon-chevron-left"></span></a>
    <ul id="foo6" class="foo">

        <?php 
        $dia = 1;
        foreach ($listadogoles as $row) { ?>

        <li>
            <a href="<?php echo $row->url; ?>"><img class="media-object" src="<?php echo base_url('imagenes/partidos.jpg'); ?>" alt=""></a>
            <div class="video-mini-part1 text-center"><?php echo $this->partidos->_clearfecha((strftime('%d de %b', strtotime($row->inicia))))    ; ?></div>
        </li>
        <?php } ?>

    </ul>
    <a id="next6" class="next" href="#"><span class="glyphicon glyphicon-chevron-right"></span></a>
    <div class="clearfix"></div>
</div>
</div>

