<div class="col-md-12 separador20 margen0r">
    <? echo $bannersSidebar[0]; ?>
</div>

<!-- social y buscar -->
<div class="col-md-3 separador10">
    <span class="social-pos">

        <script>!function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                if (!d.getElementById(id)) {
                    js = d.createElement(s);
                    js.id = id;
                    js.src = p + '://platform.twitter.com/widgets.js';
                    fjs.parentNode.insertBefore(js, fjs);
                }
            }(document, 'script', 'twitter-wjs');</script>
        <a href="https://twitter.com/futbolecuador" class="twitter-follow-button" data-show-count="false"
           data-lang="es"
           data-show-screen-name="false">Seguir a @futbolecuador</a>
    </span>
</div>
<div class="col-md-3 separador10">
    <span class="social-pos">
        <iframe
            src="//www.facebook.com/plugins/follow.php?href=https%3A%2F%2Fwww.facebook.com%2Ffutbolecuador&amp;width&amp;height=80&amp;colorscheme=light&amp;layout=button&amp;show_faces=true&amp;appId=1396413573964675"
            style="border:none; overflow:hidden; width:60px; height:35px; border:0"></iframe>
    </span>
</div>

<div class="col-md-6 separador10 pull-right margen0">
    <input class="search" type="text" name="firstname" placeholder="Buscar...">
</div>

<!--Lo más leido-->
<div class="col-md-12 separador20 margen0r">

    <? echo $loMasLeido; ?>
</div>



<!--La voz de las tribunas-->
<div class="col-md-12 separador20 margen0r">
    <? echo $laVozDeLasTribunas; ?>
</div>

<!--banner lateral 2 -->
<div class="col-md-12 separador20 margen0r">
    <? echo $bannersSidebar[1]; ?>
</div>

<!--Zona Fe-->
<div class="col-md-12 separador20 margen0r">
    <? echo $zonaFe; ?>
</div>
