<!--ficha Equipo-->
<div class="col-md-12 separador20 margen0">
    <div class="panel-heading backcuadros">
        <h4 class="panel-title"><?php echo $infoEquipo->name; ?></h4>
    </div>
</div>

<div class="row noticia-content">
    <div class="col-md-6 separador10     ">
        <table class="table table-striped font12  tablemargin4">
            <tbody>
            <tr>
                <td><strong>Nombre Oficial:</strong></td>
                <td><?php echo $infoEquipo->name; ?></td>
            </tr>
            <tr>
                <td><strong>Fundación:</strong></td>
                <td><?php echo $infoEquipo->foundation; ?></td>
            </tr>
            <tr>
                <td><strong>Presidente del Club:</strong></td>
                <td><?php echo $infoEquipo->president; ?></td>
            </tr>
            <tr>
                <td><strong>Director Técnico:</strong></td>
                <td><?php echo $infoEquipo->couch; ?></td>
            </tr>
            <tr>
                <td><strong>Estadio:</strong></td>
                <td><?php echo $infoEquipo->stadia[0]->name; ?></td>
            </tr>
            <tr>
                <td><strong>Página web oficial</strong></td>
                <td><a href="<?php echo $infoEquipo->site; ?>" target="_blank"><?php echo $infoEquipo->site; ?></a></td>
            </tr>
            <tr>
                <td><strong>Palmarés</strong></td>
                <td><?php if (isset($infoEquipo->histories[0]->palmares)) { ?>
                        <?php echo $infoEquipo->histories[0]->palmares; ?>
                    <?php } ?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-6 separador10     ">
        <div class="col-md-6 separador10    ">
            <?php if (isset($infoEquipo->shield)) { ?>
                <img src="http://www.futbolecuador.com/<?php echo $infoEquipo->shield; ?>">
            <?php } ?>
        </div>
        <div class="col-md-6 separador10    ">
            <?php if (isset($infoEquipo->shirt) and (strlen($infoEquipo->shirt) > 0) ) { ?>
                <img src="http://www.futbolecuador.com/<?php echo $infoEquipo->shirt; ?>">
            <?php } ?>
        </div>
         <div class="col-md-12 separador10">
            <?php if (isset($infoEquipo->team_pic)) { ?>
                <img  src="http://www.futbolecuador.com/<?php echo $infoEquipo->team_pic; ?>" class="img-responsive imagen-full" alt="Foto Equipo <?php echo $infoEquipo->name; ?>">
            <?php } ?>
        </div>
    </div>
</div>

<!--lsitado de jugadores -->
<div class="col-md-12 separador20 margen0">
    <div class="panel-heading backcuadros">
        <h4 class="panel-title">
            <h4 class="panel-title">Jugadores</h4>
        </h4>
    </div>

    <div id="collapseOne" class="panel-collapse collapse in tablaposiciones">
        <div class="panel-body panel-body-clear-margin margen0">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">

                <li class="active quarter  text-center">
                    <a href="#arqueros" role="tab" data-toggle="tab">Arqueros</a></li>
                <li class="quarter  text-center">
                    <a href="#defensas" role="tab" data-toggle="tab">Defensas</a></li>
                <li class="quarter  text-center">
                    <a href="#volantes" role="tab" data-toggle="tab">Volantes</a></li>
                <li class="quarter    text-center">
                    <a href="#delanteros" role="tab" data-toggle="tab">Delanteros</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active panel-no-border" id="arqueros">
                    <div class="table-responsive">
                        <table class="table table-striped font12  tablemargin4">
                            <thead>
                            <tr>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php     
                            foreach ($infoJugadoresEquipo['arqueros'] as $jugador) {
                                echo "<tr><td>".$jugador->last_name. ", " . $jugador->first_name."</td> </tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>                </div>
                <div class="tab-pane" id="defensas">
                    <div class="table-responsive">
                        <table class="table table-striped font12  tablemargin4">
                            <thead>
                            <tr>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($infoJugadoresEquipo['defensas'] as $jugador) {
                                echo "<tr><td>".$jugador->last_name. ", " . $jugador->first_name."</td> </tr>";
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane panel-no-border" id="volantes">
                    <div class="table-responsive">
                        <table class="table table-striped font12  tablemargin4">
                            <thead>
                            <tr>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($infoJugadoresEquipo['volantes'] as $jugador) {
                                echo "<tr><td>".$jugador->last_name. ", " . $jugador->first_name."</td> </tr>";
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>                </div>
                <div class="tab-pane" id="delanteros">
                    <div class="table-responsive">
                        <table class="table table-striped font12  tablemargin4">
                            <thead>
                            <tr>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($infoJugadoresEquipo['delanteros'] as $jugador) {
                                echo "<tr><td>".$jugador->last_name. ", " . $jugador->first_name ."</td> </tr>";
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>




