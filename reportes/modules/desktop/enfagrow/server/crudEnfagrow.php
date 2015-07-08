<?php
require_once '../../../../server/os.php';

$os = new os();
if (!$os->session_exists()) {
    die('No existe sesión!');
}

function selectGanadores()
{
    global $os;

    $os->db->conn->query("SET NAMES 'utf8'");
    $sql = "SELECT doky_registro.id,
                doky_registro.nombre,
                doky_registro.cedula,
                doky_registro.telefono,
                doky_registro.direccion,
                doky_premios.nombre AS nombrepremio,
                doky_registro.creado,
                doky_registro.mail,
                doky_registro.ciudad,
                doky_registro.consumidor,
                doky_registro.`consumidor-donde`,
                doky_registro.donde
            FROM doky_registro INNER JOIN doky_premios ON doky_registro.id_premio = doky_premios.id ORDER BY creado desc";

    $result = $os->db->conn->query($sql);
    $data = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode(array(
            "success" => true,
            "data" => $data)
    );
}

function selectSorteo()
{
    global $os;

    $os->db->conn->query("SET NAMES 'utf8'");
    $sql = "SELECT doky_registro.id,
	doky_registro.nombre,
	doky_registro.cedula,
	doky_registro.telefono,
	doky_registro.direccion,

	doky_registro.creado,
	doky_registro.mail,
	doky_registro.ciudad,
	doky_registro.consumidor,
	doky_registro.`consumidor-donde`,
	doky_registro.donde
FROM doky_registro
where doky_registro.id_ganador = 1001 ORDER BY creado desc";

    $result = $os->db->conn->query($sql);
    $data = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode(array(
            "success" => true,
            "data" => $data)
    );
}

function selectComentarios()
{
    global $os;

    $os->db->conn->query("SET NAMES 'utf8'");
    $sql = "SELECT doky_contactanos.id,
	doky_contactanos.nombre,
	doky_contactanos.telefono,
	doky_contactanos.creado,
	doky_contactanos.correo,
	doky_contactanos.mensaje
FROM doky_contactanos ORDER BY creado desc";

    $result = $os->db->conn->query($sql);
    $data = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode(array(
            "success" => true,
            "data" => $data)
    );
}


switch ($_GET['operation']) {
    case 'selectganadores' :
        selectGanadores();
        break;
    case 'selectSorteo' :
        selectSorteo();
        break;
    case 'selectComentarios' :
        selectComentarios();
        break;
}