<?php if (is_array($tabla)) { ?>
    <div class="table-responsive">
    <table class="table table-striped font12  tablemargin4">
        <thead>
        <tr>
            <th ></th>
            <th></th>
            <th class="azul"><?php if (isset($tipoCampeonato)) if ($tipoCampeonato == "simple") {
                    echo $tabla[0]['group_name'];
                } ?></th>
            <th class="azul text-center">PJ</th>
            <th class="azul text-center">PG</th>
            <th class="azul text-center">PE</th>
            <th class="azul text-center">PP</th>
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
                    <td width="20px"><?php echo $key + 1 ?></td>
                    <td width="40px"><?php if (isset($tipoCampeonato)) {
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

                    <td ><?php echo $row['name'] ?></td>
                    <td width="40px" class="text-center"><?php echo $row['pj'] ?></td>
                    <td width="40px" class="text-center"><?php echo $row['pg'] ?></td>
                    <td width="40px" class="text-center"><?php echo $row['pe'] ?></td>
                    <td width="40px" class="text-center"><?php echo $row['pp'] ?></td>
                    <td width="40px" class="text-center"><?php echo $row['points'] ?></td>
                    <td width="40px" class="text-center"><?php echo $sign . $row['gd'] ?></td>
                </tr>

            <?php

        } ?>
        </tbody>
    </table>
</div>
<?php
} else {
    ?>Tabla vacía
<?php
} ?>
