<?php $this->load->module("partidos"); ?>
<div class="panel panel-default panel-calendario">
    <div class="panel-body  ">
        <div class="row">
            <!--Calendarios y Grupos-->
            <div class="col-md-12 llavesfondo">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs movi-headline-regular tab-calendario">
                    <li class="active"><a href="#calendario" data-toggle="tab">
                            Segunda fase</a></li>

                </ul>
                <div class="clearfix"></div>

                <?php
                //grupo a y b
                $value1 = 0;
                $value2 = 0;
                $value3 = 1;
                if ($ranking[$value1]->tabla[$value2]->n_partidos == 3) {
                    ?>
                    <span
                        class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($ranking[$value1]->tabla[$value2]->name)) ?>"></span>
                    <div
                        class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $ranking[$value1]->tabla[$value2]->short_name; ?></div>
                <?php
                }


                $value1 = 1;
                $value2 = 1;
                $value3 = 2;
                if ($ranking[$value1]->tabla[$value2]->n_partidos == 3) {
                    ?>
                    <span
                        class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($ranking[$value1]->tabla[$value2]->name)) ?>"></span>
                    <div
                        class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $ranking[$value1]->tabla[$value2]->short_name; ?></div>
                <?php
                }


                $value1 = 0;
                $value2 = 1;
                $value3 = 3;
                if ($ranking[$value1]->tabla[$value2]->n_partidos == 3) {
                    ?>
                    <span
                        class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($ranking[$value1]->tabla[$value2]->name)) ?>"></span>
                    <div
                        class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $ranking[$value1]->tabla[$value2]->short_name; ?></div>
                <?php
                }

                $value1 = 1;
                $value2 = 0;
                $value3 = 4;
                if ($ranking[$value1]->tabla[$value2]->n_partidos == 3) {
                    ?>
                    <span
                        class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($ranking[$value1]->tabla[$value2]->name)) ?>"></span>
                    <div
                        class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $ranking[$value1]->tabla[$value2]->short_name; ?></div>
                <?php
                }

                //grupo c y d
                $value1 = 2;
                $value2 = 0;
                $value3 = 5;
                if ($ranking[$value1]->tabla[$value2]->n_partidos == 3) {
                    ?>
                    <span
                        class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($ranking[$value1]->tabla[$value2]->name)) ?>"></span>
                    <div
                        class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $ranking[$value1]->tabla[$value2]->short_name; ?></div>
                <?php
                }

                $value1 = 3;
                $value2 = 1;
                $value3 = 6;
                if ($ranking[$value1]->tabla[$value2]->n_partidos == 3) {
                    ?>
                    <span
                        class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($ranking[$value1]->tabla[$value2]->name)) ?>"></span>
                    <div
                        class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $ranking[$value1]->tabla[$value2]->short_name; ?></div>
                <?php
                }
                $value1 = 2;
                $value2 = 1;
                $value3 = 7;
                if ($ranking[$value1]->tabla[$value2]->n_partidos == 3) {
                    ?>
                    <span
                        class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($ranking[$value1]->tabla[$value2]->name)) ?>"></span>
                    <div
                        class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $ranking[$value1]->tabla[$value2]->short_name; ?></div>
                <?php
                }
                $value1 = 3;
                $value2 = 0;
                $value3 = 8;
                if ($ranking[$value1]->tabla[$value2]->n_partidos == 3) {
                    ?>
                    <span
                        class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($ranking[$value1]->tabla[$value2]->name)) ?>"></span>
                    <div
                        class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $ranking[$value1]->tabla[$value2]->short_name; ?></div>
                <?php
                }

                /////////////////////
                //grupo a y b
                $value1 = 4;
                $value2 = 0;
                $value3 = 9;
                if ($ranking[$value1]->tabla[$value2]->n_partidos == 3) {
                    ?>
                    <span
                        class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($ranking[$value1]->tabla[$value2]->name)) ?>"></span>
                    <div
                        class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $ranking[$value1]->tabla[$value2]->short_name; ?></div>
                <?php
                }


                $value1 = 5;
                $value2 = 1;
                $value3 = 10;
                if ($ranking[$value1]->tabla[$value2]->n_partidos == 3) {
                    ?>
                    <span
                        class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($ranking[$value1]->tabla[$value2]->name)) ?>"></span>
                    <div
                        class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $ranking[$value1]->tabla[$value2]->short_name; ?></div>
                <?php
                }


                $value1 = 4;
                $value2 = 1;
                $value3 = 11;
                if ($ranking[$value1]->tabla[$value2]->n_partidos == 3) {
                    ?>
                    <span
                        class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($ranking[$value1]->tabla[$value2]->name)) ?>"></span>
                    <div
                        class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $ranking[$value1]->tabla[$value2]->short_name; ?></div>
                <?php
                }

                $value1 = 5;
                $value2 = 0;
                $value3 = 12;
                if ($ranking[$value1]->tabla[$value2]->n_partidos == 3) {
                    ?>
                    <span
                        class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($ranking[$value1]->tabla[$value2]->name)) ?>"></span>
                    <div
                        class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $ranking[$value1]->tabla[$value2]->short_name; ?></div>
                <?php
                }

                //grupo c y d
                $value1 = 6;
                $value2 = 0;
                $value3 = 13;
                if ($ranking[$value1]->tabla[$value2]->n_partidos == 3) {
                    ?>
                    <span
                        class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($ranking[$value1]->tabla[$value2]->name)) ?>"></span>
                    <div
                        class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $ranking[$value1]->tabla[$value2]->short_name; ?></div>
                <?php
                }

                $value1 = 7;
                $value2 = 1;
                $value3 = 14;
                if ($ranking[$value1]->tabla[$value2]->n_partidos == 3) {
                    ?>
                    <span
                        class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($ranking[$value1]->tabla[$value2]->name)) ?>"></span>
                    <div
                        class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $ranking[$value1]->tabla[$value2]->short_name; ?></div>
                <?php
                }
                $value1 = 6;
                $value2 = 1;
                $value3 = 15;
                if ($ranking[$value1]->tabla[$value2]->n_partidos == 3) {
                    ?>
                    <span
                        class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($ranking[$value1]->tabla[$value2]->name)) ?>"></span>
                    <div
                        class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $ranking[$value1]->tabla[$value2]->short_name; ?></div>
                <?php
                }
                $value1 = 7;
                $value2 = 0;
                $value3 = 16;
                if ($ranking[$value1]->tabla[$value2]->n_partidos == 3) {
                    ?>
                    <span
                        class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($ranking[$value1]->tabla[$value2]->name)) ?>"></span>
                    <div
                        class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $ranking[$value1]->tabla[$value2]->short_name; ?></div>
                <?php
                }
                foreach ($partidos as $partido) {
                    if (($partido->fecha == "2014-7-4") and ($partido->hora == "15:00")){
                        $value3 = 17; ?>
                        <span
                            class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($partido->nombre_local)) ?>"></span>
                        <div
                            class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $partido->local_corto; ?></div>
                        <?php $value3 = 18; ?>
                        <span
                            class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($partido->nombre_visitante)) ?>"></span>
                        <div
                            class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $partido->visitante_corto; ?></div>
                    <?php
                    }

                    if (($partido->fecha == "2014-7-4") and ($partido->hora == "11:00")){
                        $value3 = 19; ?>
                        <span
                            class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($partido->nombre_local)) ?>"></span>
                        <div
                            class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $partido->local_corto; ?></div>
                        <?php $value3 = 20; ?>
                        <span
                            class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($partido->nombre_visitante)) ?>"></span>
                        <div
                            class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $partido->visitante_corto; ?></div>
                    <?php
                    }

                    if (($partido->fecha == "2014-7-5") and ($partido->hora == "15:00")){
                        $value3 = 21; ?>
                        <span
                            class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($partido->nombre_local)) ?>"></span>
                        <div
                            class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $partido->local_corto; ?></div>
                        <?php $value3 = 22; ?>
                        <span
                            class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($partido->nombre_visitante)) ?>"></span>
                        <div
                            class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $partido->visitante_corto; ?></div>
                    <?php
                    }

                    if (($partido->fecha == "2014-7-5") and ($partido->hora == "11:00")){
                        $value3 = 23; ?>
                        <span
                            class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($partido->nombre_local)) ?>"></span>
                        <div
                            class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $partido->local_corto; ?></div>
                        <?php $value3 = 24; ?>
                        <span
                            class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($partido->nombre_visitante)) ?>"></span>
                        <div
                            class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $partido->visitante_corto; ?></div>
                    <?php
                    }
                     ////////////////////////////////////////

                    if (($partido->fecha == "2014-7-8") and ($partido->hora == "15:00")){
                        $value3 = 25; ?>
                        <span
                            class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($partido->nombre_local)) ?>"></span>
                        <div
                            class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $partido->local_corto; ?></div>
                        <?php $value3 = 26; ?>
                        <span
                            class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($partido->nombre_visitante)) ?>"></span>
                        <div
                            class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $partido->visitante_corto; ?></div>
                    <?php
                    }

                    if (($partido->fecha == "2014-7-9") and ($partido->hora == "15:00")){
                        $value3 = 27; ?>
                        <span
                            class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($partido->nombre_local)) ?>"></span>
                        <div
                            class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $partido->local_corto; ?></div>
                        <?php $value3 = 28; ?>
                        <span
                            class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($partido->nombre_visitante)) ?>"></span>
                        <div
                            class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $partido->visitante_corto; ?></div>
                    <?php
                    }

                    if (($partido->fecha == "2014-7-12") and ($partido->hora == "15:00")){
                        $value3 = 29; ?>
                        <span
                            class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($partido->nombre_local)) ?>"></span>
                        <div
                            class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $partido->local_corto; ?></div>
                        <?php $value3 = 30; ?>
                        <span
                            class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($partido->nombre_visitante)) ?>"></span>
                        <div
                            class="pos<?php echo $value3; ?>b movi-headline-regular textofases"><?php echo $partido->visitante_corto; ?></div>
                    <?php
                    }

                    if (($partido->fecha == "2014-7-13") and ($partido->hora == "14:00")){
                        $value3 = 31; ?>
                        <span
                            class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($partido->nombre_local)) ?>"></span>
                        <div
                            class="pos<?php echo $value3; ?>b movi-headline-regular  letrablanca"><?php echo $partido->local_corto; ?></div>
                        <?php $value3 = 32; ?>
                        <span
                            class="pos<?php echo $value3; ?>a iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($partido->nombre_visitante)) ?>"></span>
                        <div
                            class="pos<?php echo $value3; ?>b movi-headline-regular  letrablanca"><?php echo $partido->visitante_corto; ?></div>
                    <?php
                    }



                }

                ?>


            </div>
            <!--Fin Calendarios y Grupos-->
        </div>
    </div>
</div>

<div class="col-md-12 boton-more-fondo">
    <a href="<?php echo base_url("site/grupos"); ?>" class="boton-more">Ver detalles ></a>
</div>
<div class="clearfix"></div>
