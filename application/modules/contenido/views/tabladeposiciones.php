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
<div class="container">
<? echo $partidos; ?>

<? echo $tablaposiciones; ?>
</div>
</body>
</html>
