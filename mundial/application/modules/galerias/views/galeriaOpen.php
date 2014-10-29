<!--    Galerias -->
<div class="panel panel-default">
    <div class="panel-body">

        <div class="row">
            <div class="col-md-12">
                <h2>
                    <div class="iconos sprite-noticias"></div>
                    Galerías
                </h2>
            </div>
        </div>

        <div class="row">
            <?php
            for ($i = 0; $i < 9; $i++) {
                ?>
                <div class="col-lg-4 col-sm-4 col-xs-6">
                    <a title="<?php echo $i; ?>Lorem ipsun dolor" href="../imagenes/temp/banner3-high.png"
                       class="thumbnail thgaleria" href="../imagenes/temp/banner3-high.png">
                        <img src="http://placehold.it/200x168" class="img-responsive">
                    </a>
                </div>
            <?php
            }
            ?>

        </div>
    </div>
</div>
<!--    Fin Galerias  -->