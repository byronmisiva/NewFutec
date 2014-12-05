<div class="panel-heading backcuadros separador20 margen0">
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
                    <td ><?php echo $key + 1 ?></td>
                    <td><?php echo $jugador->last_name . " " . $jugador->first_name ?></td>
                    <td class="text-center"><?php echo $jugador->goals ?> Goles</td>
                </tr>
            <?php
            }
        } ?>
        </tbody>
    </table>
</div>
