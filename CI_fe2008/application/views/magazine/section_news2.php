<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=651, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="<?=base_url()?>css/section_news.css">
   <!-- fancybox-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/js//fancybox/jquery.fancybox-1.3.4.css" media="screen" />
    <script type="text/javascript">
        $(document).ready(function() {
            $("#contenido").show()
            $("#contenidoSel, #contenidoA").hide();
            $(".opcion1").addClass("negrilla");

            $(".opcion1").click (function(){
                $("#contenido").show("fast")
                $("#contenidoSel, #contenidoA").hide("fast");
                $(".opcion1").addClass("negrilla");
                $(".opcion2, .opcion3").removeClass("negrilla");

            })
            $(".opcion2").click (function(){
                $("#contenidoSel").show("fast")
                $("#contenido, #contenidoA").hide("fast");
                $(".opcion2").addClass("negrilla");
                $(".opcion1, .opcion3").removeClass("negrilla");
            })
            $(".opcion3").click (function(){
                $("#contenidoA").show("fast")
                $("#contenidoSel, #contenido").hide("fast");
                $(".opcion3").addClass("negrilla");
                $(".opcion1, .opcion2").removeClass("negrilla");
            })

            $(".news").fancybox({
                'width'				: '100%',
                'height'			: '100%',
                'autoScale'			: false,
                'transitionIn'		: 'none',
                'transitionOut'		: 'none',
                'type'				: 'iframe'
            });
        });
    </script>
    <!-- fin fancybox-->
</head>

<body id="principal">
<div class="menuSectionNews">
    <div class="opcion1">Últimas Noticias</div>
    <div class="opcion2">Serie A</div>
    <div class="opcion3">Selección</div>
</div>
<div id="contenido">
	<?$indexnews=0;?>
	<?foreach ( $news as $new){?>
		<a class="news" href="<?=base_url()?>histories/getNewsBySecctionId/<?=$new->id?>">
			<div class="content-news-img content-news newsid<?=$indexnews;?> ">
                <?$indexnews++;?>
                <div class="news-title">
                    <?=$new->title?>
                </div>
                <div class="news-title-date">
                    <?= $new->created ?>
                </div>
				<div class="news-text">

					<div class="news-lead">
						<?=$new->lead?>
					</div>
                    <div class="news-photo">
                        <img alt="" src="<?=base_url().$new->image_id?>">
                    </div>

                </div>
			</div>
		</a>
	<?}?>
</div>
<div id="contenidoSel">
	<?$indexnews=0;?>
	<?foreach ( $newsSel as $newSel){?>
		<a class="news" href="<?=base_url()?>histories/getNewsBySecctionId/<?=$newSel->id?>">
			<div class="content-news-img content-news newsid<?=$indexnews;?> ">
                <?$indexnews++;?>
                <div class="news-title">
                    <?=$newSel->title?>
                </div>
                <div class="news-title-date">
                    <?= $newSel->created ?>
                </div>
				<div class="news-text">

					<div class="news-lead">
						<?=$newSel->lead?>
					</div>
                    <div class="news-photo">
                        <img alt="" src="<?=base_url().$newSel->image_id?>">
                    </div>
                </div>
			</div>
		</a>
	<?}?>
</div>
<div id="contenidoA">
	<?$indexnews=0;?>
	<?foreach ( $newsA as $newA){?>
		<a class="news" href="<?=base_url()?>histories/getNewsBySecctionId/<?=$newA->id?>">
			<div class="content-news-img content-news newsid<?=$indexnews;?> ">
                <?$indexnews++;?>
                <div class="news-title">
                    <?=$newA->title?>
                </div>
                <div class="news-title-date">
                    <?= $newA->created ?>
                </div>
				<div class="news-text">

					<div class="news-lead">
						<?=$newA->lead?>
					</div>
                    <div class="news-photo">
                        <img alt="" src="<?=base_url().$newA->image_id?>">
                    </div>
                </div>
			</div>
		</a>
	<?}?>
</div>
</body>
</html>