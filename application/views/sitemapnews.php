<?php header('Content-type: text/xml'); ?>
<?= '<?xml version="1.0" encoding="UTF-8" ?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
    <!-- stories -->
    <?php foreach ($stories as $url) { ?>
        <url>
            <loc><?= base_url() . "stories/publica/" . $url->id ?></loc>
            <news:news>
                <news:publication>
                    <news:name><?= $url->title ?></news:name>
                    <news:language>es</news:language>
                </news:publication>
                <news:title>
                    <?= $url->subtitle ?>
                </news:title>
                <news:publication_date><?= $url->created ?></news:publication_date>
                <news:keywords><?= $url->keywords ?>
                </news:keywords>
            </news:news>

        </url>
    <?php } ?>
 
</urlset>