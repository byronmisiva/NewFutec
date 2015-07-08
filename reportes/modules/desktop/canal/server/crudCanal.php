<?php
require_once '../../../../server/os.php';

$os = new os();
if (!$os->session_exists()) {
    die('No existe sesión!');
}

function selectCanal()
{
    global $os;

    $os->db->conn->query("SET NAMES 'utf8'");
    $sql = "SELECT * FROM xmltv_canal ORDER BY id";
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

function insertCanal()
{
    global $os;
    $os->db->conn->query("SET NAMES 'utf8'");
    $data = json_decode(stripslashes($_POST["data"]));


    $sql = "INSERT INTO xmltv_canal(nombre , descripcion , icono)
	values('$data->nombre', '$data->descripcion', '$data->icono');";
    $sql = $os->db->conn->prepare($sql);
    $sql->execute();
    echo json_encode(array(
        "success" => $sql->errorCode() == 0,
        "msg" => $sql->errorCode() == 0 ? "insertado exitosamente" : $sql->errorCode(),
        "data" => array(
            array(
                "id" => $os->db->conn->lastInsertId(),
                "nombre" => $data->nombre,
                "descripcion" => $data->descripcion,
                "icono" => $data->icono
            )
        )
    ));
}

function updateCanal()
{
    global $os;
    $os->db->conn->query("SET NAMES 'utf8'");
    $pruebas = json_decode($_POST["data"]);
    $data = json_decode($_POST["data"]);


    if (is_null($data))
     $data = json_decode(stripslashes($_POST["data"]));



    $sql = "UPDATE xmltv_canal SET
      id='$data->id',
         nombre='$data->nombre',
         descripcion='$data->descripcion',
         icono='$data->icono'
	  WHERE xmltv_canal.id = '$data->id' ";
    $sql = $os->db->conn->prepare($sql);
    $sql->execute();
    echo json_encode(array(
        "success" => $sql->errorCode() == 0,
        "msg" => $sql->errorCode() == 0 ? "Ubicación en xmltv_canal actualizado exitosamente" : $sql->errorCode()
    ));
}


function selectCanalForm()
{
    global $os;
    $id = (int)$_POST ['id'];
    $os->db->conn->query("SET NAMES 'utf8'");
    $sql = "SELECT * FROM xmltv_canal WHERE id = $id";
    $result = $os->db->conn->query($sql);
    $data = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $data = $row;
    }
    echo json_encode(array(
            "success" => true,
            "data" => $data)
    );
}

function updateCanalForm()
{
    global $os;
    $os->db->conn->query("SET NAMES 'utf8'");

    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $icono = $_POST["icono"];

    $sql = "UPDATE xmltv_canal SET nombre='$nombre',
          descripcion='$descripcion',
          icono='$icono'
          WHERE id = '$id' ";
    $sql = $os->db->conn->prepare($sql);
    $sql->execute();
    echo json_encode(array(
        "success" => $sql->errorCode() == 0,
        "msg" => $sql->errorCode() == 0 ? "Contenido actualizado exitosamente" : $sql->errorCode()
    ));
}

function deleteCanal()
{
    global $os;
    $id = json_decode(stripslashes($_POST["data"]));
    $sql = "DELETE FROM xmltv_canal WHERE id=$id";
    $sql = $os->db->conn->prepare($sql);
    $sql->execute();
    echo json_encode(array(
        "success" => $sql->errorCode() == 0,
        "msg" => $sql->errorCode() == 0 ? "Ubicación en xmltv_canal, eliminado exitosamente" : $sql->errorCode()
    ));
}

switch ($_GET['operation']) {
    case 'select' :
        selectCanal();
        break;
    case 'insert' :
        insertCanal();
        break;
    case 'update' :
        updateCanal();
        break;
    case 'selectForm' :
        selectCanalForm();
        break;
    case 'updateForm' :
        updateCanalForm();
        break;
    case 'delete' :
        deleteCanal();
        break;
}
