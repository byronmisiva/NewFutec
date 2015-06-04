<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="content-language" content="es"/>
    <meta name="robots" content="follow,index,nocache"/>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css?ran=' . rand(1, 1000)) ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style.css?ran=' . rand(1, 1000)) ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/revista.css?ran=' . rand(1, 1000)) ?>" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js' . rand(1, 1000)) ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js' . rand(1, 1000)) ?>assets/js/bootstrap.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

    <?php
    if ($verMobile == "1") {
        ?>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <?php
    } else {
        if ($verMobile == "2") {
            ?>
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <?php
        }
    }
    ?>
    <script>
        var baseUrl = "<?php echo base_url(); ?>";
        var REFRESH_VIVO = "<?php echo REFRESH_VIVO; ?>";
    </script>


</head>
<body>


<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Marcador En Vivo
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body zona-partidos">
                <? echo $partidos; ?>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingTwo">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Grupos
                </a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
                <? echo $tablaposiciones; ?>
            </div>
        </div>
    </div>

</div>


</body>
</html>
