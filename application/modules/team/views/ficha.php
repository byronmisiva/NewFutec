<div class="col-md-12 separador20 margen0">
    <div class="panel-heading backcuadros">
        <h4 class="panel-title"><?php echo $infoEquipo->name; ?></h4>
    </div>
</div>

<div class="row noticia-content">'>
    <div class="col-md-6 separador10     ">
        <table class="table table-striped font12  tablemargin4">
            <tbody>
            <tr>
                <td><strong>Nombre Oficial:</strong></td>
                <td><?php echo $infoEquipo->name; ?></td>
            </tr>
            <tr>
                <td><strong>Fundación:</strong></td>
                <td><?php echo $infoEquipo->foundation; ?></td>
            </tr>
            <tr>
                <td><strong>Presidente del Club:</strong></td>
                <td><?php echo $infoEquipo->president; ?></td>
            </tr>
            <tr>
                <td><strong>Director Técnico:</strong></td>
                <td><?php echo $infoEquipo->couch; ?></td>
            </tr>
            <tr>
                <td><strong>Estadio:</strong></td>
                <td><?php echo $infoEquipo->stadia[0]->name; ?></td>
            </tr>
            <tr>
                <td><strong>Página web oficial</strong></td>
                <td><a href="<?php echo $infoEquipo->site; ?>" target="_blank"><?php echo $infoEquipo->site; ?></a></td>
            </tr>
            <tr>
                <td><strong>Palmarés</strong></td>
                <td><?php if (isset($infoEquipo->histories[0]->palmares)) { ?>
                        <?php echo $infoEquipo->histories[0]->palmares; ?>
                    <?php } ?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-6 separador10     ">
        <div class="col-md-4 separador10    ">
            <?php if (isset($infoEquipo->shield)) { ?>
                <img src="http://www.futbolecuador.com/<?php echo $infoEquipo->shield; ?>">
            <?php } ?>
        </div>
        <div class="col-md-4 separador10    ">
            <?php if (isset($infoEquipo->shirt) and (strlen($infoEquipo->shirt) > 0) ) { ?>
                <img src="http://www.futbolecuador.com/<?php echo $infoEquipo->shirt; ?>">
            <?php } ?>
        </div>
        <div class="col-md-4 separador10    ">
            <?php if ((isset($infoEquipo->shirt2)) and (strlen($infoEquipo->shirt2) > 0) ) { ?>
                <img src="http://www.futbolecuador.com/<?php echo $infoEquipo->shirt2; ?>">
            <?php } ?>
        </div>
        <div class="col-md-12 separador10    ">
            <?php if (isset($infoEquipo->team_pic)) { ?>
                <img src="http://www.futbolecuador.com/<?php echo $infoEquipo->team_pic; ?>">
            <?php } ?>
        </div>
    </div>
</div>




