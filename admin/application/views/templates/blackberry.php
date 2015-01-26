<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title><?= $title ?></title><!-- futbolecuador movil -->
    <meta name="viewport"
          content="width=320, user_scalable=yes, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.6">
    <script language="JavaScript1.4" src="<?= base_url(); ?>js/certifica.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>js/certifica-js14.js"></script>
    <link type="text/css" rel="stylesheet" href="<?= base_url() ?>css/iphone.css"/>


    <script type='text/javascript' src='http://partner.googleadservices.com/gampad/google_service.js'>
    </script>
    <script type='text/javascript'>
        GS_googleAddAdSenseService("ca-pub-2857298972794488");
        GS_googleEnableAllServices();
    </script>
    <script type='text/javascript'>
        GA_googleAddSlot("ca-pub-2857298972794488", "FE_BB_BOT");
        GA_googleAddSlot("ca-pub-2857298972794488", "FE_BB_TOP");
    </script>
    <script type='text/javascript'>
        GA_googleFetchAds();
    </script>

</head>
<body>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-53XBQP"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-53XBQP');</script>
<!-- End Google Tag Manager -->
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
    _atrk_opts = { atrk_acct: "A9Dnf1aUOO00Gi", domain: "futbolecuador.com", dynamic: true};
    (function () {
        var as = document.createElement('script');
        as.type = 'text/javascript';
        as.async = true;
        as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js";
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(as, s);
    })();
</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=A9Dnf1aUOO00Gi" style="display:none"
               height="1" width="1" alt=""/></noscript>
<!-- End Alexa Certify Javascript -->


<div id="movil">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color:#FFFFFF">
        <tr>
            <td bgcolor="#01305C">
                <?= $logo ?>
            </td>
        </tr>
        <tr>
            <td>
                <script type='text/javascript'>
                    GA_googleFillSlot("FE_BB_TOP");
                </script>
            </td>
        </tr>
        <tr>
            <td>
                <?= $info1 ?>
            </td>
        </tr>
        <tr>
            <td>
                <?= $title2 ?>
            </td>
        <tr>
        <tr>
            <td>
                <?= $info2 ?>
            </td>
        </tr>
        <tr>
            <td>
                <?= $title3 ?>
            </td>
        </tr>
        <tr>
            <td>
                <?= $info3 ?>
            </td>
        </tr>
        <tr>
            <td>
                <script type='text/javascript'>
                    GA_googleFillSlot("FE_BB_BOT");
                </script>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
