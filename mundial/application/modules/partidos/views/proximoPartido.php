<?php
$this->load->module("partidos");
setlocale(LC_ALL, "es_ES");
// para la fina se retira el resultado, al final del archivo se encuentra comentado
?>
  <div class="col-md-12">
                            <spam class="col-md-2 col-md-2 col-lg-2 col-sm-2 col-xs-2 movi-headline-regular en-vivo-prox">FINAL</spam>
                            <spam class="col-md-10 col-md-10 col-lg-10 col-sm-10 col-xs-10  movi-headline-regular text-center cor-partidos margen0">
                            	<?php 
                            	echo  "ARGENTIVA 0 - 0 ALEMANIA" ;
                            	//$mes = 13 - (int) strftime("%m", strtotime($partidos['fecha']));
                                //$fechaPartido=strftime("%Y,12-$mes,%d, %H, %M", strtotime($partidos['fecha']));
                                //$fecha=explode(',', $fechaPartido);
                          
                                ?>
                              </spam>

						

                           
 </div>

<!-- Listado de partidos del Día-->


<?php
/*$this->load->module("partidos");
setlocale(LC_ALL, "es_ES");
if( 	$ajax ){
    */?><!--
    <div class="col-md-12">
        <spam class="col-md-2 col-md-2 col-lg-2 col-sm-2 col-xs-2 movi-headline-regular en-vivo-prox">Próximo Partido</spam>
        <spam class="col-md-4 col-md-4 col-lg-4 col-sm-4 col-xs-4  movi-headline-regular text-center cor-partidos margen0">
            <?php
/*            echo $partidos['short_name_local']. " - " . $partidos['short_name_visitante'];
            */?>
        </spam>
        <script>
            $(function () {
                var austDay = new Date(<?php /*echo strtotime($partidos['fecha'])*1000;*/?>);
                $('#defaultCountdown').countdown({until: austDay, format: 'dHM'});
            });
        </script>

        <div id="defaultCountdown" class="col-md-6 col-md-6 col-lg-6 col-sm-6 col-xs-6  movi-headline-regular en-vivo-mini text-center margen0"></div>

    </div>
<?/* } */?>
<!-- Listado de partidos del Día-->-->