<div class="col-md-12 col-xs-12 separador10-xs-bot margen0r ">
    <div class="panel-heading backcuadros">
        <h4 class="panel-title">
            Tabla de Posiciones
        </h4>
    </div>

    <div id="collapseOne" class="panel-collapse collapse in tablaposiciones">
        <div class="panel-body panel-body-clear-margin margen0">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active half  text-center">
                    <a href="#posiciones" role="tab"
                       data-toggle="tab">Posiciones</a></li>
                <li class="half  text-center">
                    <a href="#acumulada" role="tab"
                       data-toggle="tab">Acumulada</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active panel-no-border" id="posiciones">
                    <? echo $scroreBoardSingle; ?>
                </div>
                <div class="tab-pane" id="acumulada">
                    <? echo $scroreBoardAcumulative; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xs-12 text-right fondoazul separador10 tablacompleta">

            <a href="<?= base_url('site/tabladeposiciones/' . $champ ) ?>">Tabla Completa</a>

    </div>
</div>