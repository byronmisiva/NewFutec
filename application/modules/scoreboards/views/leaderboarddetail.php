<div class="table-responsive">
    <table class="table table-striped font12  tablemargin4">
        <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th class="azul text-center">PJ</th>
            <th class="azul text-center">PG</th>
            <th class="azul text-center">PE</th>
            <th class="azul text-center">PP</th>
            <th class="azul text-center">Pts</th>
            <th class="azul">GD</th>
        </tr>
        </thead>
        <tbody>
        <?php if (is_array($tabla)) {
            foreach ($tabla as $key => $row) {
                $sign = ($row['gd'] > 0) ? '+' : '';
                ?>
                <tr>
                    <td ><?php echo $key + 1 ?></td>
                    <td ><div class="equipos sprite-<?php echo strtolower ($this->contenido->_clearStringGion ($row['name'] )) ?>-icon zoom06 "></div></td>

                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['pj'] ?></td>
                    <td><?php echo $row['pg'] ?></td>
                    <td><?php echo $row['pe'] ?></td>
                    <td><?php echo $row['pp'] ?></td>
                    <td><?php echo $row['points'] ?></td>
                    <td><?php echo $sign . $row['gd'] ?></td>
                </tr>

            <?php
            }
        } ?>
        </tbody>
    </table>
</div>