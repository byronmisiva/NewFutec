<?php
//Archivo de Configuraci—n de puntos para el Fantasy

/*
|--------------------------------------------------------------------------
| Reglas del Fantasy
|--------------------------------------------------------------------------
|
| Se determinan las configuraciones b‡sicas
| 
*/

//Jugadores del mismo equipo que puede seleccionar un usuario
$fantasy['same_team']=2;

//Cambios que puede hacer un usuario a su equipo por fecha
$fantasy['change_players']=1;


/*
|--------------------------------------------------------------------------
| Puntos para el Fantasy
|--------------------------------------------------------------------------
|
| Puntos asignados
| 
*/

//Por jugar
$fantasy['play']=1;

//Jugar m‡s de 60 minutos
$fantasy['play_more']=1;

//Gol de Arquero o Defensa
$fantasy['gol_ad']=6;

//Gol de Volante
$fantasy['gol_v']=5;

//Gol de Delantero
$fantasy['gol_d']=4;

//0 Goles recividos
$fantasy['gol_no']=4;

//Penal a Favor
$fantasy['penal_s']=1;

//Penal en Contra
$fantasy['penal_n']=-2;

//Por cada Gol Recibido
$fantasy['receive']=1;

//Por cada tarjeta Amarilla 
$fantasy['yellow']=-1;

//Por cada Tarjeta Roja
$fantasy['red']=-3;

//Por cada Cambio Extra
$fantasy['change_extra']=-2
?>