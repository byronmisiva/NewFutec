<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th></th>
            <th></th>
            <th>Pts</th>
            <th>GD</th>
        </tr>
        </thead>
        <tbody>
        <?php if (is_array($tabla)) {
            foreach ($tabla as $key => $row) {
                $sign = ($row['gd'] > 0) ? '+' : '';
                ?>
                <tr>
                    <td><?php echo $key + 1 ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['points'] ?></td>
                    <td><?php echo $sign . $row['gd'] ?></td>
                </tr>

            <?php
            }
        } ?>
        </tbody>
    </table>
</div>