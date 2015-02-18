<div class="encuesta-contenedor">
<div class="panel-heading backcuadros">
    <h4 class="panel-title">
        Encuesta
    </h4>
</div>
<div class="col-md-12 col-xs-12 separador10">
    <?php echo $survey->title; ?>

</div>
<?php foreach ($options as $option) {
    ?>
    <div class="col-md-12 col-xs-12 separador5">
        <input type="radio" name="option" value="<?php echo $option->id; ?>" id="option"><?php echo $option->title; ?>
    </div>
<?php
}
?>
</div>

<div class="col-md-12 col-xs-12 text-right fondoazul separador10 enviar-encuesta">
    <div id="enviar-encuesta-boton" >Enviar</div>
</div>

<div class="col-md-12 col-xs-12 text-right fondoazul separador10  resultados-encuesta" style="display: none">
    <div id="ver-resultados" >Ver Resultados</div>
</div>
