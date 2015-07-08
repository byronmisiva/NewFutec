<?php
require_once '../../../../server/os.php';

$os = new os();
if (!$os->session_exists()) {
    die('No existe sesión!');
}

function selectPrograma()
{
    global $os;
    $os->db->conn->query("SET NAMES 'utf8'");
    $sql = "SELECT * FROM xmltv_programa ORDER BY id";
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

function insertPrograma()
{
    global $os;
    $os->db->conn->query("SET NAMES 'utf8'");
    $data = json_decode(stripslashes($_POST["data"]));

    $sql = "INSERT INTO xmltv_programa(titulo, imagen, subtitulos, categoria, inicio, audio, descripcion, subtititulo, id_canal, episodio, fecha)
	values('$data->titulo', '$data->imagen', '$data->subtitulos', '$data->categoria', '$data->inicio', '$data->audio', '$data->descripcion', '$data->subtititulo', '$data->id_canal', '$data->episodio', '$data->fecha');";
    $sql = $os->db->conn->prepare($sql);
    $sql->execute();
    echo json_encode(array(
        "success" => $sql->errorCode() == 0,
        "msg" => $sql->errorCode() == 0 ? "insertado exitosamente" : $sql->errorCode(),
        "data" => array(
            array(
                "id" => $os->db->conn->lastInsertId(),
                "titulo" => $data->titulo,
                "imagen" => $data->imagen,
                "subtitulos" => $data->subtitulos,
                "categoria" => $data->categoria,
                "inicio" => $data->inicio,
                "audio" => $data->audio,
                "descripcion" => $data->descripcion,
                "subtititulo" => $data->subtititulo,
                "id_canal" => $data->id_canal,
                "episodio" => $data->episodio,
                "fecha" => $data->fecha
            )
        )
    ));
}

function updatePrograma()
{
    global $os;
    $result = $os->db->conn->query("SET NAMES 'utf8'");
    $data = json_decode(stripslashes($_POST["data"]));


    $sql = "UPDATE xmltv_programa SET
        id='$data->id',
        titulo=>$data->titulo,
        imagen=>$data->imagen,
        subtitulos=>$data->subtitulos,
        categoria=>$data->categoria,
        inicio=>$data->inicio,
        audio=>$data->audio,
        descripcion=>$data->descripcion,
        subtititulo=>$data->subtititulo,
        id_canal=>$data->id_canal,
        episodio=>$data->episodio,
        fecha=>$data->fecha
	  WHERE xmltv_programa.id = '$data->id' ";
    $sql = $os->db->conn->prepare($sql);
    $sql->execute();
    echo json_encode(array(
        "success" => $sql->errorCode() == 0,
        "msg" => $sql->errorCode() == 0 ? "Ubicación en programa actualizado exitosamente" : $sql->errorCode()
    ));
}

function deletePrograma()
{
    global $os;
    $id = json_decode(stripslashes($_POST["data"]));
    $sql = "DELETE FROM xmltv_programa WHERE id=$id";
    $sql = $os->db->conn->prepare($sql);
    $sql->execute();
    echo json_encode(array(
        "success" => $sql->errorCode() == 0,
        "msg" => $sql->errorCode() == 0 ? "Ubicación en programa, eliminado exitosamente" : $sql->errorCode()
    ));
}

switch ($_GET['operation']) {
    case 'select' :
        selectPrograma();
        break;
    case 'insert' :
        insertPrograma();
        break;
    case 'update' :
        updatePrograma();
        break;
    case 'delete' :
        deletePrograma();
        break;
}
/*
{  xtype: 'textfield', fieldLabel: 'Id', name: 'id', anchor: '95%', readOnly: true },
{  xtype: 'textfield', fieldLabel: 'titulo', name: 'titulo', anchor: '95%', readOnly: false },
{  xtype: 'textfield', fieldLabel: 'imagen', name: 'imagen', anchor: '95%', readOnly: false },
{  xtype: 'textfield', fieldLabel: 'subtitulos', name: 'subtitulos', anchor: '95%', readOnly: false },
{  xtype: 'textfield', fieldLabel: 'categoria', name: 'categoria', anchor: '95%', readOnly: false },
{  xtype: 'textfield', fieldLabel: 'inicio', name: 'inicio', anchor: '95%', readOnly: false },
{  xtype: 'textfield', fieldLabel: 'audio', name: 'audio', anchor: '95%', readOnly: false },
{  xtype: 'textfield', fieldLabel: 'descripcion', name: 'descripcion', anchor: '95%', readOnly: false },
{  xtype: 'textfield', fieldLabel: 'subtititulo', name: 'subtititulo', anchor: '95%', readOnly: false },
{  xtype: 'textfield', fieldLabel: 'id_canal', name: 'id_canal', anchor: '95%', readOnly: false },
{  xtype: 'textfield', fieldLabel: 'episodio', name: 'episodio', anchor: '95%', readOnly: false },
{  xtype: 'textfield', fieldLabel: 'fecha', name: 'fecha', anchor: '95%', readOnly: false }

*/