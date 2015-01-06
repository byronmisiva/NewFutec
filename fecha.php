<?php
/**
 * Created by PhpStorm.
 * User: bherrera
 * Date: 6/1/15
 * Time: 11:47
 */
setlocale(LC_ALL, "es_ES");

echo date("l d F Y", strtotime("2014-12-30 10:57:23")) . "<br>";

echo strftime("%A, %d %B %Y", strtotime("2014-12-30 10:57:23"));

/* probar diferentes nombres posibles de configuración regional para el alemán a partir de PHP 4.3.0 */
$loc_de = setlocale(LC_ALL, 'de_DE@euro', 'de_DE', 'deu_deu');
echo "Preferred locale for german on this system is '$loc_de'";
?>