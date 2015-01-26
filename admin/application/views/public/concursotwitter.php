<div class="containerfueradejuego galeria11content">
    <div class="liquid-slider" id="main-slider11">
        <div><h2 class="title"><img src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria11/1b.jpg" alt=" "/>
            </h2> <img src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria11/1a.jpg" alt="Paulina"/></div>
        <div><h2 class="title"><img src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria11/2b.jpg" alt=" "/>
            </h2> <img src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria11/2a.jpg" alt="Paulina"/></div>
        <div><h2 class="title"><img src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria11/3b.jpg" alt=" "/>
            </h2> <img src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria11/3a.jpg" alt="Paulina"/>
        </div>
        <div><h2 class="title"><img src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria11/4b.jpg" alt=" "/>
            </h2> <img src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria11/4a.jpg" alt="Paulina"/>
        </div>
        <div><h2 class="title"><img src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria11/5b.jpg" alt=" "/>
            </h2> <img src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria11/5a.jpg" alt="Pualina"/>
        </div>
        <div><h2 class="title"><img src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria11/1b.jpg" alt=" "/>
            </h2> <img src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria11/1a.jpg" alt="Paulina"/></div>
        <div><h2 class="title"><img src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria11/2b.jpg" alt=" "/>
            </h2> <img src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria11/2a.jpg" alt="Paulina"/></div>
        <div><h2 class="title"><img src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria11/3b.jpg" alt=" "/>
            </h2> <img src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria11/3a.jpg" alt="Paulina"/>
        </div>
        <div><h2 class="title"><img src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria11/4b.jpg" alt=" "/>
            </h2> <img src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria11/4a.jpg" alt="Paulina"/>
        </div>
        <div><h2 class="title"><img src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria11/5b.jpg" alt=" "/>
            </h2> <img src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria11/5a.jpg" alt="Pualina"/>
        </div>
    </div>
</div>

<link rel="stylesheet" href="<?= base_url() ?>css/fueradejuego/liquid-slider.css">
<link type="text/css" rel="stylesheet" href="<?= base_url() ?>css/fueradejuego/fueradejuego.css"/>

<script src="<?= base_url() ?>js/jquery.easing.1.3.js"></script>
<script src="<?= base_url() ?>js/jquery.touchSwipe.min.js"></script>
<script src="<?= base_url() ?>js/jquery.liquid-slider.min.js"></script>

<!-- Third, add the GalleryView Javascript and CSS files -->
<script type="text/javascript" src="<?= base_url() ?>js/jcarousellite_1.0.1.js"></script>

<script>
    jQ(function () {
        jQ('#main-slider1, #main-slider2, #main-slider3, #main-slider4,#main-slider5, #main-slider6,#main-slider7,#main-slider8,#main-slider9,#main-slider10,#main-slider11').liquidSlider({
            includeTitle: false,
            mobileNavigation: false,
            slideEaseFunction: "easeInOutCubic",
            preloader: true,
            tabPosition: 'bottom',
            dynamicTabsPosition: "bottom",

            onload: function () {
                this.alignNavigation();

            }
        });

        jQ(".otrasmodelos").jCarouselLite({
            btnNext: ".next",
            btnPrev: ".prev"
        });

        jQ(".containerfueradejuego").hide();
        jQ(".galeria11content").show();

        //menuchicas
        jQ(".galeria1, .galeria2,.galeria3,.galeria4,.galeria5,.galeria6,.galeria7,.galeria8,.galeria9,.galeria10,.galeria11").click(function () {
            for (var i = 1; i <= 11; i++)
                jQ(".galeria" + i + "content").hide();


            jQ("." + jQ(this).attr('class') + "content").show()
            ;
        })


    });

</script>