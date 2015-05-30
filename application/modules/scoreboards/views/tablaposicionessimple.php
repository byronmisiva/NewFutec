<div class="col-md-12 col-xs-12 separador10-xs-bot margen0r ">
    <div class="panel-heading backcuadros">
        <h4 class="panel-title">
            Tabla de Posiciones
        </h4>
    </div>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active panel-no-border" id="posiciones">
            <? echo $scroreBoardSingle; ?>
        </div>

    </div>


    <div class="col-md-12 col-xs-12 text-right fondoazul separador10 tablacompleta">
        <?php if ($champ == CHAMP_DEFAULT) { ?>
            <a href="<?= base_url('tabla-de-posiciones') ?>">Tabla Completa</a>
        <?php } else { ?>
            <a href="<?= base_url('site/tabladeposiciones/' . $champ . "/" . $tipoCampeonato ) ?>">Tabla Completa</a>
        <?php } ?>
    </div>
</div>