<!--Genera la tabla de posiciones-->
<div class="rowmargen">
    <?

    foreach ($grupos as $row) {
        echo ' <div class="col-md-3 col-lg-3 col-sm-3 col-xs-6 grupo">';
        echo '<div class="col-md-12 movi-headline-regular cabecera-grupos1">' . $row->nombre . '</div>';
        ?>
        <div class="col-md-12 movi-headline-regular cabecera-grupos2">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">Equipo</div>
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 pull-right"
                     style="text-align:right">Puntos
                </div>
            </div>
        </div>
        <?php
        if (count($row->tabla) > 0) {
            //           foreach ($row->tabla as $equipo) {
            for ($i = 0; $i < 4; $i++) {
                if (isset($row->tabla[$i]))
                    $equipo = $row->tabla[$i];
                ?>






                <div class="col-md-12 cuerpo">
                    <div class="row">
                        <div class="col-md-10 col-lg-10 col-sm-10 col-xs-10  margen5">
                            <?php if (isset($row->tabla[$i])) {
                                ?>
                                <span
                                    class="iconos sprite-<?php echo str_replace(array(' ', 'ñ','á', 'é', 'ó', 'ú') , array('-', 'n','a', 'e', 'o','u'), strtolower($equipo->informacion->nombre)) ?>"></span>
                                <?php echo $equipo->informacion->nombre; ?>
                            <?php
                            } else echo "-";
                            ?>
                        </div>
                        <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2 pull-right margen5"
                             style="text-align:right"><?php if (isset($row->tabla[$i])) echo $equipo->p; ?>
                        </div>
                    </div>
                </div>
            <?php
            }
        } else {
            //generamos el contenido pero vacio
            for ($i = 0; $i < 4; $i++) {
                ?>
                <div class="col-md-12 cuerpo">
                    <div class="row">
                        <div class="col-md-11 col-lg-11 col-sm-11 col-xs-11  margen2">
                            -
                        </div>
                        <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 pull-right margen2"
                             style="text-align:right">
                        </div>
                    </div>
                </div>
            <?php
            }
        }
        echo '</div>';
    }
    ?>
</div>



