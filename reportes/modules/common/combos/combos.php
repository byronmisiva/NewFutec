<?php
require_once '../../../server/os.php';
$os = new os();
if (!$os->session_exists()) {
    die('No existe sesión!');
}

function comboCampo()
{
    global $os;
    $os->db->conn->query("SET NAMES 'utf8'");
    $sql = "SELECT * FROM campo";
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

function comboSexo()
{
    $data[] = array("id" => "I", "nombre"=>"Indistino");
    $data[] = array("id" => "H", "nombre"=>"Hombre");
    $data[] = array("id" => "M", "nombre"=>"Mujer");

    echo json_encode(array(
            "success" => true,
            "data" => $data)
    );

}



function comboTipoMapa()
{
    $data[] = array("id" => "100", "nombre"=>"Gasolinera");
    $data[] = array("id" => "101", "nombre"=>"Gasolinera, Lubricadora");
    $data[] = array("id" => "110", "nombre"=>"Gasolinera, Tienda");
    $data[] = array("id" => "111", "nombre"=>"Gasolinera, Tienda, Lubricadora");

    echo json_encode(array(
            "success" => true,
            "data" => $data)
    );

}


function comboActivo()
{
    $data[] = array("id" => "1", "nombre"=>"Si");
    $data[] = array("id" => "0", "nombre"=>"No");

    echo json_encode(array(
            "success" => true,
            "data" => $data)
    );

}

function comboCargo()
{
    global $os;
    $os->db->conn->query("SET NAMES 'utf8'");
    $sql = "SELECT * FROM cargo";
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

switch ($_GET['tipo']) {
    case 'campo' :
        comboCampo();
        break;
    case 'cargo' :
        comboCargo();
        break;
    case 'sexo' :
        comboSexo();
        break;
    case 'tipomapa' :
        comboTipoMapa();
        break;
    case 'activo' :
        comboActivo();
        break;
}
?>