<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=290, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>Twitter Feed</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<body style="background-color:transparent;padding:0;margin:0;">



</body>
</html>


<script>
    delay(1500);
    cadena = '<div id="tweets">' +
        '<a class="twitter-timeline" href="<?=$tweets['href'];?>" data-widget-id="<?=$tweets['id'];?>" data-chrome="noheader nofooter noborders" width="280"><?=$tweets['name'];?></a>' +
        '</div>' +
         '<script>window.onload=function(){!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");};<\/script>';
      $( "body" ).append( cadena );
</script>
