<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . "/TALAASH/media/connection/config.php";
require_once BASE_FILE_PATH . "model/class.updateMissingDataOperations.php";

// Handle different operations
$operation = isset($_POST['operation']) ? $_POST['operation'] : '';

switch ($operation) {
    case 'add_data_through_form':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $obj = new UpdateMissingPersonDatabse();
            $response = $obj->addDataThroughForm($_POST, $_FILES);
            http_response_code($response['success'] ? 200 : 400);
            echo json_encode($response);
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method not allowed']);
        }
        break;

    case 'import_data_through_json':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $obj = new UpdateMissingPersonDatabse();
            $response = $obj->importDataFromJson($_FILES['file']);
            http_response_code($response['success'] ? 200 : 400);
            echo json_encode($response);
        } else {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid file or request']);
        }
        break;

    case 'mark_as_found':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $obj = new UpdateMissingPersonDatabse();
            $firId = $_POST['firId'];
            $response = $obj->markAsFound($firId);
            http_response_code($response['success'] ? 200 : 400);
            echo json_encode($response);
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method not allowed']);
        }
        break;

    case 'mark_as_delete':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $obj = new UpdateMissingPersonDatabse();
            $firId = $_POST['firId'];
            $response = $obj->markAsDelete($firId);
            http_response_code($response['success'] ? 200 : 400);
            echo json_encode($response);
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method not allowed']);
        }
        break;

    // Add more cases for different operations here

    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid operation']);
        break;
}


