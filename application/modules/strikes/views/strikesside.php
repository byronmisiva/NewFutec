<div class="panel-heading backcuadros auspicio side-goleadores">
    <h4 class="panel-title">
        Goleadores
    </h4>
</div>

<div class="table-responsive">
    <table class="table table-striped font12  tablemargin4">
        <tbody>
        <?php if (is_array($jugadores)) {
            foreach ($jugadores as $key => $jugador) {
                ?>
                <tr>
                    <?php if ($key + 1 == 1) { ?>
                        <td colspan="3">
                            <div class="col-md-4 col-xs-4 margen0 img-goleadores">
                                <?php if ((isset($jugador->thumb220)) and ($jugador->thumb220 != "")) { ?>
                                    <img class="img-responsive"
                                         src="http://www.futbolecuador.com/<?php echo $jugador->thumb220; ?>" alt="<?php echo $jugador->last_name . " " . $jugador->first_name; ?>"
                                        title="<?php echo $jugador->last_name . " " . $jugador->first_name . " jugador de " .$jugador->name  ; ?>">
                                <?php } else { ?>
                                    <img class="img-responsive"
                                         src="http://www.futbolecuador.com/imagenes/players/striker.jpg">
                                <?php } ?>

                            </div>
                            <div class="col-md-2 col-xs-2 margen0 text-center">
                                <img src="http://www.futbolecuador.com/<?php echo $jugador->thumb_shield; ?>" alt="<?php echo $jugador->name; ?>" title="Escudo de <?php echo $jugador->name; ?>">
                            </div>
                            <div class="col-md-6 col-xs-4 margen0">

                                <h2><?php echo $jugador->last_name . " " . $jugador->first_name; ?></h2>
                                <?php echo $jugador->name ?><br>

                                <div class="col-md-12 margen0">
                                    <h2><?php echo $jugador->goals ?> Goles</h2>
                                </div>
                                <div class="col-md-12 margen0">
                                    <?php echo $jugador->jugadas ?> jugada, <?php echo $jugador->penals ?> penales
                                </div>
                            </div>
                        </td>
                    <?php
                    } else {
                        ?>
                        <td><?php echo $key + 1 ?></td>
                        <?php if ((isset($jugador->mini_shield)) and ($jugador->mini_shield != "")) {

                        } else {
                            $jugador->mini_shield = "imagenes/teams/mini_shields/default.png";
                        } ?>

                        <td><img src="http://www.futbolecuador.com/<?php echo $jugador->mini_shield; ?>"
                                 alt="<?php echo $jugador->name ?>"> <?php
                            echo $jugador->last_name . " " . $jugador->first_name;
                            ?></td>
                        <td class="text-center"><?php echo $jugador->goals ?> Goles</td>
                    <?php } ?>
                </tr>
            <?php
            }
        } ?>
        </tbody>
    </table>
</div>
<div class="col-md-12 text-right fondoazul separador10">
        <a href="<?= base_url('site/goleadores/' . $champ) ?>">Tabla Completa</a>
</div>


