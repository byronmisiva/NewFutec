<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=651, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="<?= base_url() ?>css/section_news.css">
</head>
<body>
<div id="contenidoid">
    <div class="content-news-id" >
        <div class="news-title">
            <?= $news->title ?>
        </div>
        <div class="news-title-date">
            <?= $news->created ?>
        </div>
        <div class="news-title-subtitle">
            <?= $news->subtitle ?>
        </div>
    </div>
    <div class="news-photo">
        <img alt="" src="<?= base_url() . $news->image_id ?>">
    </div>

    <div class="clear"></div>

    <div class="news-text news-text-id" style="height: 424px;overflow: auto;">
        <div class="news-lead">
            <?= $news->lead ?>
        </div>
        <div class="news-lead">
            <?= $news->body ?>
        </div>
    </div>
</div>
</body>
</html>