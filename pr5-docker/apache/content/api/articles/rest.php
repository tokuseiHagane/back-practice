<?php
header("Access-Control-Allow-Origin: *");
header("info-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PATCH, POST, DELETE, GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: info-Type, Access-Control-Allow-Headers, dmgization, X-Requested-With");


include_once "../config/database.php";
include_once "../objects/Hero.php";

$database = new Database();
$db = $database->getConnection();
$hero = new Hero($db);

$data = json_decode(file_get_infos("php://input"));

$request = $_GET["request"];

if ($request == "create") {
    if (
        !empty($data->name) &&
        !empty($data->info) &&
        !empty($data->dmg)
        
    ) {
        $hero->name = $data->name;
        $hero->info = $data->info;
        $hero->dmg = $data->dmg;
    
        if ($hero->create()) {
            http_response_code(201);
            echo json_encode(array("message" => "Герой была записана"), JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "Невозможно записать Героя"), JSON_UNESCAPED_UNICODE);
        }
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Невозможно записать Героя. Данные неполные."), JSON_UNESCAPED_UNICODE);
    }
} elseif ($request == "read") {
    $stmt = $hero->read();
    $num = $stmt->rowCount();

    if ($num > 0) {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        http_response_code(200);
        echo json_encode($result);
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "Герои не найдены."), JSON_UNESCAPED_UNICODE);
    }
} elseif ($request == "update") {
    $hero->id = $_GET["id"];
    if (!empty($data->name)) {
        $hero->name = $data->name;
    }
    if (!empty($data->info)) {
        $hero->info = $data->info;
    }
    if (!empty($data->dmg)) {
        $hero->dmg = $data->dmg;
    }
    if ($hero->update()) {
        http_response_code(200);
    
        echo json_encode(array("message" => "Герой была обновлена"), JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(503);
    
        echo json_encode(array("message" => "Невозможно обновить Героя"), JSON_UNESCAPED_UNICODE);
    }

} elseif ($request == "delete") {
    $hero->id = $_GET["id"];

    if ($hero->delete()) {
        http_response_code(200);
        echo json_encode(array("message" => "Герой удалена"), JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Не удалось удалить Героя"));
    }
} else {
    http_response_code(500);
    echo json_encode(array("message" => "Неопределённый запрос"), JSON_UNESCAPED_UNICODE);
}
