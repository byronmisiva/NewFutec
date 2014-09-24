<?php
$indice = 0;
foreach ($noticias as $noticia)
{ if ($indice%2==0) echo '<div class="row ">'; ?>
<div class="col-md-6 separador10  noticia lineseparador">
    <?php echo $noticia ?>
</div>
<?php
    if ($indice%2==1) echo '</div>';
    $indice++;
    }
?>
