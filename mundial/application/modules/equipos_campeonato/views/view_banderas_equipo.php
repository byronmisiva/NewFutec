<?php $this->load->module("partidos"); ?>
<div class="row bandera40">
    <div class="col-md-12">
        <?
        foreach ($equipos as $equipo) {
            // echo $equipo->name;
            ?>
            <a href="<?php echo base_url();?>site/equipo/<?php echo $equipo->id; ?>/<?php echo strtolower($this->partidos->_clearStringGion($equipo->name)) ?>"
               alt="<?php echo $equipo->name ?>" title="<?php echo $equipo->name ?>">
                                <span
                                    class="iconos sprite-bandera-<?php echo strtolower($this->partidos->_clearStringGion($equipo->name)) ?>"></span>
            </a>

        <?php

        }
        ?>
    </div>
</div>
<div class="col-md-12 separador"> </div>
