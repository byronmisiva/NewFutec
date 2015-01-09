<!-- social y buscar -->
<div class="col-md-3 separador10">
    <span class="social-pos">

        <script>!function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                if (!d.getElementById(id)) {
                    js = d.createElement(s);
                    js.id = id;
                    js.src = p + '://platform.twitter.com/widgets.js';
                    fjs.parentNode.insertBefore(js, fjs);
                }
            }(document, 'script', 'twitter-wjs');</script>
        <a href="https://twitter.com/futbolecuador" class="twitter-follow-button" data-show-count="false"
           data-lang="es"
           data-show-screen-name="false">Seguir a @futbolecuador</a>
    </span>
</div>
<div class="col-md-3 separador10">
    <span class="social-pos">
        <iframe
            src="//www.facebook.com/plugins/follow.php?href=https%3A%2F%2Fwww.facebook.com%2Ffutbolecuador&amp;width&amp;height=80&amp;colorscheme=light&amp;layout=button&amp;show_faces=true&amp;appId=1396413573964675"
            style="border:none; overflow:hidden; width:60px; height:35px; border:0"></iframe>
    </span>
</div>

<div class="col-md-6 separador10 pull-right margen0">
    <form action="<?= base_url('site/search') ?>" id="searchbox_003647730963788853882:cfsv-n7w47w">
        <input type="hidden" name="cx" value="003647730963788853882:cfsv-n7w47w">
            <input type="hidden" name="cof" value="FORID:11">
            <input class="search" type="text" name="q" placeholder="Buscar...">
            <input  class="hide" type="submit" name="sa" value="Search" />
    </form>
    <script type="text/javascript" src="'/cse'/brand'?form='cref_iframe" ></script>
</div>

<div class="col-md-12 separador20  margen0r lateral">

    <div id="collapseTwo" class="panel-collapse collapse in">
        <div class="panel-body panel-body-clear-margin">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs headernavtabs" role="tablist">
                <li class="active half  text-center backcuadros">
                    <a href="#resultados" role="tab"
                       data-toggle="tab"><h4 class="panel-title">Resultados</h4></a></li>
                <li class=" half  text-center backcuadros">
                    <a href="#proximafecha" role="tab"
                       data-toggle="tab"><h4 class="panel-title">Próxima fecha</h4></a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active panel-no-border" id="resultados">
                    <div class="well well-sm">
                        <!--contenido colapsable-->
                        <div class="panel-group" id="accordion2">
                            <?php
                            foreach ($campeonatosResultados as $campeonato) {
                                if (CHAMP_DEFAULT == $campeonato->champ) {
                                    $active = "in";
                                } else {
                                    $active = "";
                                }
                                ?>

                                <div class="panel panel-default panel-no-border">
                                    <div class="panel-heading">
                                        <h4 class="panel-title acordion-close font12">
                                            <a data-toggle="collapse" data-parent="#accordion2"
                                               data-info="<?php echo $campeonato->champ; ?>" data-name ="<?php echo $campeonato->shortname; ?>"  class="panel-link"
                                               href="#<?php echo $campeonato->shortname; ?>">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <?php echo $campeonato->name; ?>
                                                    </div>
                                                </div>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="<?php echo $campeonato->shortname; ?>"
                                         class="panel-collapse collapse <?php echo $active; ?>">
                                        <div class="panel-body panel-body-clear-margin">
                                            <?php
                                            foreach ($campeonato->partidos as $partido) {
                                                $resultado = explode("-", $partido->result);
                                                ?>
                                                <div class="panel panel-default">
                                                    <a class="sidebarlink" href="<?= base_url('site/partido/' . $this->contenido->_urlFriendly($partido->hname) . '-' . $this->contenido->_urlFriendly($partido->aname) . '/' . $partido->id) ?>">
                                                        <ul class="list-group">
                                                            <li class="list-group-item">
                                                                <div class="col-md-1 text-center">
                                                                    <?php if (count($resultado) >= 2) echo $resultado[0]; ?>
                                                                </div>
                                                                <div class="col-md-2 text-right ">
                                                                    <img
                                                                        src="http://www.futbolecuador.com/<?php echo $partido->hshield; ?>"
                                                                        alt="<?php echo $partido->hname; ?>">
                                                                </div>
                                                                <div class="col-md-9  ">
                                                                    <?php echo $partido->hname; ?>
                                                                </div>

                                                            </li>
                                                            <li class="list-group-item">
                                                                <div class="col-md-1  text-center">
                                                                    <?php if (count($resultado) >= 2) echo $resultado[1]; ?>
                                                                </div>
                                                                <div class="col-md-2  text-right">
                                                                    <img
                                                                        src="http://www.futbolecuador.com/<?php echo $partido->ashield; ?>"
                                                                        alt="<?php echo $partido->aname; ?>">
                                                                </div>
                                                                <div class="col-md-9  ">
                                                                    <?php echo $partido->aname; ?>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </a>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="tab-pane  panel-no-border" id="proximafecha">
                    <div class="well well-sm">
                        <!--contenido colapsable-->
                        <div class="panel-group" id="accordion1">
                            <?php

                            foreach ($campeonatos as $campeonato) {
                                if (CHAMP_DEFAULT == $campeonato->champ) {
                                    $name_champ_default = $campeonato->shortname;
                                    $active = "in";
                                } else {
                                    $active = "";
                                }
                                ?>

                                <div class="panel panel-default panel-no-border">
                                    <div class="panel-heading">
                                        <h4 class="panel-title acordion-close font12">
                                            <a data-toggle="collapse" data-parent="#accordion1"
                                               data-info="<?php echo $campeonato->champ; ?>" data-name ="<?php echo $campeonato->shortname; ?>"  class=" panel-link"
                                            href="#<?php echo $campeonato->shortname; ?>1">
                                            <?php echo $campeonato->name; ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="<?php echo $campeonato->shortname; ?>1"
                                         class="panel-collapse collapse <?php echo $active;
                                         ?>">
                                        <div class="panel-body panel-body-clear-margin">
                                            <?php
                                            foreach ($campeonato->partidos as $partido) {
                                                $resultado = explode("-", $partido->result);
                                                ?>
                                                <div class="panel panel-default">
                                                    <a class="sidebarlink" href="<?= base_url('site/partido/' . $this->contenido->_urlFriendly($partido->hname) . '-' . $this->contenido->_urlFriendly($partido->aname) . '/' . $partido->id) ?>">
                                                        <ul class="list-group">
                                                            <li class="list-group-item">
                                                                <div class="col-md-1 text-center">

                                                                </div>
                                                                <div class="col-md-2 text-right">
                                                                    <img
                                                                        src="http://www.futbolecuador.com/<?php echo $partido->hshield; ?>"
                                                                        alt="<?php echo $partido->hname; ?>">
                                                                </div>
                                                                <div class="col-md-9  ">
                                                                    <?php echo $partido->hname; ?>

                                                                </div>

                                                            </li>
                                                            <li class="list-group-item">
                                                                <div class="col-md-1  text-center">

                                                                </div>
                                                                <div class="col-md-2  text-right">
                                                                    <img
                                                                        src="http://www.futbolecuador.com/<?php echo $partido->ashield; ?>"
                                                                        alt="<?php echo $partido->aname; ?>">
                                                                </div>
                                                                <div class="col-md-9  ">
                                                                    <?php echo $partido->aname; ?>
                                                                </div>
                                                            </li>

                                                        </ul>
                                                    </a>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="col-md-12 text-right fondoazul separador10">
        <a class="result-link" href="<?= base_url('site/resultados/' . CHAMP_DEFAULT. '/' . $name_champ_default) ?>">Calendario Completo</a>

    </div>
</div>


<!--la entrevista -->
<div class="col-md-12 separador20 margen0r">
    <? echo $laentrevista; ?>
</div>

<!--Tabla de posiciones-->
<? echo $tablaposiciones; ?>

<div class="col-md-12 separador20 margen0r">
    <? echo $bannersSidebar[0]; ?>
</div>


<!--Goleadores-->

<div class="col-md-12 separador20 margen0r">
    <? echo $strikes; ?>
</div>

<!--Fin Goleadores -->

<!--banner lateral 2 -->
<div class="col-md-12 separador20 margen0r">
    <? echo $bannersSidebar[1]; ?>
</div>
<!--Lo más leido-->
<div class="col-md-12 separador20 margen0r">

    <? echo $loMasLeido; ?>
</div>

<!--fuera de juego -->
<div class="col-md-12 separador20 margen0r">
    <? echo $fueradejuego; ?>
</div>
<!--Zona Fe-->
<div class="col-md-12 separador20 margen0r">
    <? echo $zonaFe; ?>
</div>
<!--banner lateral 3 -->
<div class="col-md-12 separador20 margen0r">
    <? echo $bannersSidebar[2]; ?>
</div>

<!--La voz de las tribunas-->
<div class="col-md-12 separador20 margen0r">
    <? echo $laVozDeLasTribunas; ?>
</div>
<!--banner lateral 4 -->
<div class="col-md-12 separador20 margen0r">
    <? echo $bannersSidebar[3]; ?>
</div>



