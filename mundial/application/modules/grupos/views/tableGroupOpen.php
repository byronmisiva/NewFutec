<!--Genera la tabla de posiciones-->
<div class="row">
    <?
    foreach ($grupos as $row) {
        echo ' <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 grupo">';
        echo '<div class="col-md-12 movi-headline-regular cabecera-grupos1">' . $row->nombre . '</div>';
        ?>
        <div class="col-md-12 movi-headline-regular cabecera-grupos2">
            <div class="row">
                <div class="col-md-5 col-lg-5 col-sm-5 col-xs-5">Equipo</div>
                <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 text-center">PJ</div>
                <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 text-center">PG</div>
                <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 text-center">PE</div>
                <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 text-center">PP</div>
                <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 text-center">GF</div>
                <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 text-center">GC</div>
                <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 text-center">P</div>
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
                        <div class="col-md-5 col-lg-5 col-sm-5 col-xs-3 margen2">
                            <?php if (isset($row->tabla[$i])) {
                                ?>
                                <span
                                    class="iconos sprite-<?php echo str_replace(array(' ', 'ñ','á', 'é', 'ó', 'ú') , array('-', 'n','a', 'e', 'o','u'), strtolower($equipo->informacion->nombre)) ?>"></span>
                                <?php echo $equipo->informacion->nombre; ?>
                            <?php
                            } else echo "-";
                            ?>
                        </div>
                        <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 text-center margen2"
                             style="text-align:right"><?php if (isset($row->tabla[$i])) echo  $equipo->pj ; ?>
                        </div>
                        <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 pull-right margen2"
                             style="text-align:right"><?php if (isset($row->tabla[$i])) echo  $equipo->pg ; ?>
                        </div>
                        <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 pull-right margen2"
                             style="text-align:right"><?php if (isset($row->tabla[$i])) echo  $equipo->pp ; ?>
                        </div>
                        <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 pull-right margen2"
                             style="text-align:right"><?php if (isset($row->tabla[$i])) echo  $equipo->gf ; ?>
                        </div>
                        <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 pull-right margen2"
                             style="text-align:right"><?php if (isset($row->tabla[$i])) echo  $equipo->gc ; ?>
                        </div>
                        <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 pull-right margen2"
                             style="text-align:right"><?php if (isset($row->tabla[$i])) echo  $equipo->gd; ?>
                        </div>
                        <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 pull-right margen2"
                             style="text-align:right"><?php if (isset($row->tabla[$i])) echo $equipo->p  ; ?>
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



