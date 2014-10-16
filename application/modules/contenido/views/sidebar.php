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
            src="//www.facebook.com/plugins/follow.php?href=https%3A%2F%2Fwww.facebook.com%2Fzuck&amp;width=60&amp;height=35&amp;colorscheme=light&amp;layout=button&amp;show_faces=false&amp;appId=1396413573964675"
            scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:60px; height:35px;"
            allowTransparency="true"></iframe>

    </span>
</div>
<div class="col-md-6 separador10 pull-right margen0">

    <input class="search" type="text" name="firstname" placeholder="Buscar...">
</div>

<!-- social y buscar -->
<div class="col-md-12 separador20  margen0r lateral">

    <div id="collapseTwo" class="panel-collapse collapse in">
        <div class="panel-body panel-body-clear-margin">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs headernavtabs" role="tablist">
                <li class="active">
                    <a href="#resultados" role="tab"
                       data-toggle="tab">Resultados</a></li>
                <li class="">
                    <a href="#proximafecha" role="tab"
                       data-toggle="tab">Próxima fecha</a></li>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active panel-no-border" id="resultados">
                    <div class="well well-sm">
                        <!--contenido colapsable-->
                        <div class="panel-group" id="accordion2">
                            <?php
                            $active = "in";
                            foreach ($campeonatosResultados as $campeonato) {
                                ?>

                                <div class="panel panel-default panel-no-border">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion2"
                                               href="#<?php echo $campeonato->shortname; ?>">
                                                <?php echo $campeonato->name; ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="<?php echo $campeonato->shortname; ?>"
                                         class="panel-collapse collapse <?php echo $active;
                                         $active = ""; ?>">
                                        <div class="panel-body panel-body-clear-margin">
                                            <?php
                                            foreach ($campeonato->partidos as $partido) {
                                                $resultado = explode("-", $partido->result);
                                                ?>
                                                <div class="panel panel-default">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <div class="col-md-1 text-center">
                                                                <?php if (count($resultado) >= 2) echo $resultado[0]; ?>
                                                            </div>
                                                            <div class="col-md-2 text-right ">
                                                                <img
                                                                    src="http://www.futbolecuador.com/<?php echo $partido->hshield; ?>">
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
                                                                    src="http://www.futbolecuador.com/<?php echo $partido->ashield; ?>">
                                                            </div>
                                                            <div class="col-md-9  ">
                                                                <?php echo $partido->aname; ?>
                                                            </div>
                                                        </li>
                                                    </ul>
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
                            $active = "in";
                            foreach ($campeonatos as $campeonato) {
                                ?>

                                <div class="panel panel-default panel-no-border">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion1"
                                               href="#<?php echo $campeonato->shortname; ?>1">
                                                <?php echo $campeonato->name; ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="<?php echo $campeonato->shortname; ?>1"
                                         class="panel-collapse collapse <?php echo $active;
                                         $active = ""; ?>">
                                        <div class="panel-body panel-body-clear-margin">
                                            <?php
                                            foreach ($campeonato->partidos as $partido) {
                                                $resultado = explode("-", $partido->result);
                                                ?>
                                                <div class="panel panel-default">
                                                    <ul class="list-group">


                                                        <li class="list-group-item">
                                                            <div class="col-md-1 text-center">

                                                            </div>
                                                            <div class="col-md-2 text-right">
                                                                <img
                                                                    src="http://www.futbolecuador.com/<?php echo $partido->hshield; ?>">
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
                                                                    src="http://www.futbolecuador.com/<?php echo $partido->ashield; ?>">
                                                            </div>
                                                            <div class="col-md-9  ">
                                                                <?php echo $partido->aname; ?>
                                                            </div>
                                                        </li>

                                                    </ul>
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
</div>
<!--banner lateral 1 -->
<div class="col-md-12 separador20">
     <? echo $bannersSidebar[0]; ?>
</div>
<!--Tabla de posiciones-->

<div class="col-md-12 separador20 margen0r">
    <div class="panel-heading backcuadros">
        <h4 class="panel-title">
            Tabla de posiciones
        </h4>
    </div>

    <div id="collapseTwo" class="panel-collapse collapse in tablaposiciones">
        <div class="panel-body panel-body-clear-margin margen0">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active">
                    <a href="#posiciones" role="tab"
                       data-toggle="tab">Posiciones</a></li>
                <li class="">
                    <a href="#acumulada" role="tab"
                       data-toggle="tab">Acumulada</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active panel-no-border" id="posiciones">
                    <? echo $scroreBoardSingle; ?>
                </div>
                <div class="tab-pane" id="acumulada">
                    <? echo $scroreBoardAcumulative; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 text-right fondoazul separador10">
        Ver tabla completa
    </div>
</div>
<!--Fin Tabla de posiciones-->

<!--banner lateral 2 -->
<div class="col-md-12 separador20">
    <? echo $bannersSidebar[1]; ?>
</div>

<!--Goleadores-->

<div class="col-md-12 separador20 margen0r">
    <div class="panel-heading backcuadros">
        <h4 class="panel-title">
            Goleadores
        </h4>
    </div>
    <? echo $strikes; ?>

    <div class="col-md-12 text-right fondoazul separador10">
        Ver tabla completa
    </div>
</div>
<!--Fin Tabla de posiciones-->

<!--banner lateral 3 -->
<div class="col-md-12 separador20">
    <? echo $bannersSidebar[2]; ?>
</div>


<!--banner lateral 4 -->
<div class="col-md-12 separador20">
    <? echo $bannersSidebar[3]; ?>
</div>
