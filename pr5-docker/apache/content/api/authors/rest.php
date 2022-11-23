<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PATCH, POST, DELETE, GET");
header("Access-Control-Max-time: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, musization, X-Requested-With");


include_once "../config/database.php";
include_once "../objects/Mus.php";

$database = new Database();
$db = $database->getConnection();
$mus = new Mus($db);

$data = json_decode(file_get_contents("php://input"));

$request = $_GET["request"];

if ($request == "create") {
    if (
        !empty($data->name) &&
        !empty($data->autors) &&
        !empty($data->time)
        
    ) {
        $mus->name = $data->name;
        $mus->autors = $data->autors;
        $mus->time = $data->time;
    
        if ($mus->create()) {
            http_response_code(201);
            echo json_encode(array("messtime" => "Музыка была записана"), JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(503);
            echo json_encode(array("messtime" => "Невозможно записать музыку"), JSON_UNESCAPED_UNICODE);
        }
    } else {
        http_response_code(400);
        echo json_encode(array("messtime" => "Невозможно записать музыку. Данные неполные."), JSON_UNESCAPED_UNICODE);
    }
} elseif ($request == "read") {
    $stmt = $mus->read();
    $num = $stmt->rowCount();

    if ($num > 0) {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        http_response_code(200);
        echo json_encode($result);
    } else {
        http_response_code(404);
        echo json_encode(array("messtime" => "Музыка не найдены."), JSON_UNESCAPED_UNICODE);
    }
} elseif ($request == "update") {
    $mus->id = $_GET["id"];
    if (!empty($data->name)) {
        $mus->name = $data->name;
    }
    if (!empty($data->autors)) {
        $mus->autors = $data->autors;
    }
    if (!empty($data->time)) {
        $mus->time = $data->time;
    }
    if ($mus->update()) {
        http_response_code(200);
    
        echo json_encode(array("messtime" => "Музыка была обновлена"), JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(503);
    
        echo json_encode(array("messtime" => "Невозможно обновить музыку"), JSON_UNESCAPED_UNICODE);
    }

} elseif ($request == "delete") {
    $mus->id = $_GET["id"];

    if ($mus->delete()) {
        http_response_code(200);
        echo json_encode(array("messtime" => "Музыка удалена"), JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(503);
        echo json_encode(array("messtime" => "Не удалось удалить музыку"));
    }
} else {
    http_response_code(500);
    echo json_encode(array("messtime" => "Неопределённый запрос"), JSON_UNESCAPED_UNICODE);
}
