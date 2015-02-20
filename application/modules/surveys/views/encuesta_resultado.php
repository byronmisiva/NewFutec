<div class="panel-heading backcuadros">
    <h4 class="panel-title">
        Encuesta
    </h4>
</div>
<div class="col-md-12 col-xs-12 separador10">
    <?php echo $survey->title; ?>

</div>
<div class="col-md-12 col-xs-12 separador10">
    <?php foreach ($options as $option) {
        ?>

        <div class="col-md-12 col-xs-12  margen0">
            <div class="col-md-6 col-xs-6 margen0">
                 <?php echo $option->title; ?>
            </div>
            <div class="col-md-6 col-xs-6 margen0">
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar"
                         aria-valuenow="<?php echo  ($option->porcentaje> 3)? $option->porcentaje : 3?>" aria-valuemin="0" aria-valuemax="100"
                         style="width:<?php echo $option->porcentaje; ?>%"><?php echo ($option->porcentaje > 80)? $option->porcentaje . '%' : ''; ?>
                    </div><span class= "encuesta-porcentaje"><?php  echo ($option->porcentaje <= 80)? $option->porcentaje . '%' : ''; ?></span>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<div class="col-md-12 col-xs-12 text-right fondoazul separador10 hidden">
    <a id="ver-resultados" href="">Ver siguiente encuesta</a>
</div>