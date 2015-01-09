<div class="panel-heading backcuadros">
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
                            <div class="col-md-4 margen0">
                                <img class="img-responsive"
                                     src="http://www.futbolecuador.com/<?php echo $jugador->thumb220; ?>">
                            </div>
                            <div class="col-md-2 margen0 text-center">
                                <img src="http://www.futbolecuador.com/<?php echo $jugador->thumb_shield; ?>">
                            </div>
                            <div class="col-md-6 margen0">

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
                        <td><img src="http://www.futbolecuador.com/<?php echo $jugador->mini_shield; ?>"> <?php
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
    <a href="<?= base_url('goleadores') ?>">Ver más</a>
</div>


