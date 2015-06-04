<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="content-language" content="es"/>
    <meta name="robots" content="follow,index,nocache"/>
    <link href='http://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
    <?php
    if ($verMobile == "1") {
        ?>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <script type="text/javascript" async defer
                src="https://apis.google.com/js/platform.js?publisherid=109198533032839133083">
        </script>
    <?php
    } else {
        if ($verMobile == "2") {
            ?>
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <?php
        } else {
            ?>
            <link rel="chrome-webstore-item"
                  href="https://chrome.google.com/webstore/detail/cjkoikfgconobaeikllfnkpnjihcfnil">
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <?php
        }
    }
    ?>
    <script>
        var baseUrl = "<?php echo base_url(); ?>";
        var REFRESH_VIVO = "<?php echo REFRESH_VIVO; ?>";
    </script>

    <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/sprites.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/revista.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
</head>
<body>


<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Marcador En Vivocc
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
