<?php header('Content-type: text/xml'); ?>
<?= '<?xml version="1.0" encoding="UTF-8" ?>' ?>
<urlset xmlns:news="http://www.google.com/schemas/sitemap-news/0.9" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <!-- seccions -->
    <?php foreach($seccions  as $url) { ?>
        <url>
            <loc><?= $url['url'] ?></loc>
            <priority>0.8</priority>
            <changefreq>daily</changefreq>
            <language>es</language>


        </url>
    <?php } ?>

    <!-- tags -->
    <?php //foreach($tags as $url) { ?>
        <url>
            <loc><?php //base_url(). "stories/tags/". str_replace(" ","_",$url->name) ?></loc>
            <priority>0.8</priority>
            <changefreq>daily</changefreq>
            <language>es</language>
        </url>
    <?php //} ?>

    <!-- stories -->
    <?php foreach($stories as $url) { ?>
    <url>
            <loc><?= base_url(). "site/noticia/". $this->seo->_urlFriendly($url->title). "/". $url->id ?></loc>
            <priority>0.5</priority>
            <lastmod><?= $url->created ?></lastmod>
            <language>es</language>
    </url>
    <?php } ?>


</urlset>