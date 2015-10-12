<?php if (is_array($tabla)) { ?>
    <div class="table-responsive fondocopa">
        <table class="table table-striped font12  tablemargin4">
            <thead>
            <tr>
                <th></th>
                <th></th>
                <th class="azul"><?php if (isset($tipoCampeonato)) if ($tipoCampeonato == "simple") {
                        echo $tabla[0]['group_name'];
                    } ?></th>

                <th class="azul text-center">PJ</th>
                <th class="azul text-center">Pts</th>
                <th class="azul text-center">GD</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($tabla as $key => $row) {
                $sign = ($row['gd'] > 0) ? '+' : '';
                ?>
                <tr>
                    <td width="10px"><?php echo $key + 1 ?></td>
                    <td width="25px"><?php if (isset($tipoCampeonato)) {
                            if ($tipoCampeonato == "simple") {
                                if ($row['mini_shield'] == "") {
                                    $row['mini_shield'] = "imagenes/teams/mini_shields/default.png";
                                } ?>
                                <img src="http://www.futbolecuador.com/<?php echo $row['mini_shield']; ?>"
                                     alt="<?php echo $row['name']; ?>">

                            <?php } else { ?>
                                <div
                                    class="equipos sprite-<?php echo strtolower(htmlentities($this->contenido->_clearStringGion($row['name']))) ?>-icon zoom06 "></div>
                            <?php }
                            }
                            else { ?>
                            <div
                                class="equipos sprite-<?php echo strtolower(htmlentities($this->contenido->_clearStringGion($row['name']))) ?>-icon zoom06 "></div>
                        <?php } ?>

                    </td>

                    <td ><?php echo $row['name'] ?></td>
                    <td width="15px" class="azul text-center"><?php echo $row['pj'] ?></td>
                    <td width="15px" class="azul text-center"><?php echo $row['points'] ?></td>
                    <td width="15px" class="azul text-center"><?php echo $sign . $row['gd'] ?></td>
                </tr>

            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
<?php } else { ?>
    Tabla vacía
<?php } ?>