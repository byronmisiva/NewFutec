<div class="col-md-12 col-xs-12 separador10-xs-bot margen0r ">
    <div class="panel-heading backcuadros auspicio side-tabla">
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

            <a href="<?= base_url('site/tabladeposiciones/' . $champ . "/" . $tipoCampeonato ) ?>">Tabla Completa</a>
 
    </div>
</div>