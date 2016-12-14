<div class="publicidadFlotante">
    <!-- <div id="Stage" class="EDGE-3751729"></div>--->
</div>
<!--   script para banner solo caso home movil-->
<?php
$idtipo = $this->uri->segment(2);
$tipo = array("movil");
if (in_array($idtipo, $tipo)) {?>
   <!-- <script type="text/javascript" src="<?= base_url() ?>assets/js/banner/banner_edgePreload.js"></script>-->
<?php
}?>
