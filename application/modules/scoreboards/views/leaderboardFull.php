<!--Tabla de Posiciones-->
<div class="col-md-12 separador10-xs margen0r">
    <div class="panel-heading backcuadros auspicio">
        <h1 class="tabla">
            Tabla de Posiciones
        </h1>
    </div>
    <? echo $scroreBoardSingle; ?>
    <?php if ($tipoCampeonato != "simple" ) {
        ?>
        <div class="panel-heading backcuadros">
            <h2 class="tabla">
                Tabla de Posiciones Acumulada
            </h2>
        </div>
        <? echo $scroreBoardAcumulative; ?>

    <?php
    } ?>
</div>