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

                    <td ><?php echo $key + 1 ?></td>
                    <td><?php if ($key + 1 == 1 ) {
                            echo '<img class="img-responsive" src="http://www.futbolecuador.com/'. $jugador->thumb220.'"><br>';
                            echo '<img src="http://www.futbolecuador.com/' .$jugador->shield.'">';

                            echo $jugador->last_name . " " . $jugador->first_name;}
                        else {
                            echo $jugador->last_name . " " . $jugador->first_name;
                        }?></td>
                    <td class="text-center"><?php echo $jugador->goals ?> Goles</td>
                </tr>
            <?php
            }
        } ?>
        </tbody>
    </table>
</div>
<div class="col-md-12 text-right fondoazul separador10">
    <a  href="<?= base_url('goleadores') ?>">Ver más</a>
</div>


