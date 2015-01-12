<div class="panel-heading backcuadros separador10-xs margen0">
    <h4 class="panel-title">
        Goleadores
    </h4>
</div>

<div class="table-responsive table-responsive-overflowhidden">
    <table class="table table-striped font12  tablemargin4">
        <tbody>

        <?php if (is_array($jugadores)) {
            foreach ($jugadores as $key => $jugador) {
                if ($key == 0 ) {
                    ?>
                    <div class="row clearfix  separador10 cabeceragoleador">
                        <div class="col-md-2 col-xs-3 margen0-xs ">
                            <img class="img-responsive" src="http://www.futbolecuador.com/<?php echo $jugador->thumb220; ?>">
                        </div>
                        <div class="col-md-1 col-xs-2 column ">
                             <img src="http://www.futbolecuador.com/<?php echo $jugador->shield; ?>">
                        </div>

                        <div class="col-md-9 col-xs-7 column lineseparador">
                            <div class="col-md-8 column ">
                                <h1><?php echo $jugador->last_name . " " . $jugador->first_name ?></h1>
                                <?php echo $jugador->name; ?>
                            </div>
                            <div class="col-md-4 ">
                                <h2 class="gigante"><?php echo $jugador->goals ?> Goles</h2>
                                <?php echo $jugador->jugadas . " jugada, " ?> <?php if ($jugador->penals != "" )echo $jugador->penals . " penales," ?>
                            </div>
                        </div>
                    </div>
                    <div class="separador10 row" >
                    </div>
                    <thead >
                    <tr>
                        <th class="fondoazul text-center"></th>
                        <th class="fondoazul text-center "></th>
                        <th class="fondoazul text-left hidden-xs">Equipo</th>
                        <th class="fondoazul text-center">Nombre</th>
                        <th class="fondoazul text-center hidden-xs">Jugada</th>
                        <th class="fondoazul text-center hidden-xs">Penales</th>
                        <th class="fondoazul text-center">Total</th>
                    </tr>
                    </thead>
                <?php

                } else {
                    ?>
                    <tr>
                        <td ><?php echo $key + 1 ?></td>
                        <td><img src="http://www.futbolecuador.com/<?php echo $jugador->thumb_shield; ?>"></td>
                        <td class="hidden-xs"><?php echo $jugador->name; ?></td>
                        <td><?php echo $jugador->last_name . " " . $jugador->first_name ?></td>
                        <td class="text-center hidden-xs"><?php echo $jugador->jugadas ?> </td>
                        <td class="text-center hidden-xs"><?php echo $jugador->penals ?> </td>
                        <td class="text-center"><?php echo $jugador->goals ?> </td>
                    </tr>
                <?php

                }
            }
        } ?>
        </tbody>
    </table>
</div>
