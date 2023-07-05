<?php
include_once '../Controllers/product_controller.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header('Content-Type: application/json');
$db = new DatabaseConnection('localhost', 'root', 'root', 'scandiweb');
$db->connect();

$restAPI = new ProductController($db);


$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $response = $restAPI->ShowAll();
        if ($response != true) {
            http_response_code(500); // Internal Server Error
        }
        echo json_encode($response);
        break;

    case 'POST':
        $recievedJSon = file_get_contents("php://input");
        $decode = json_decode($recievedJSon, true);
        if ($decode['operation'] === 'delete') {

            $response = $restAPI->Delete($decode['items']);
            if ($response != true) {
                http_response_code(500); // Internal Server Error
            }

        } else {

            $product = new Product($decode['sku'], $decode['name'], $decode['price'], $decode['type'], $decode['attribute']);

            $response = $restAPI->saveProduct($product);
            if ($response != true) {
                http_response_code(500); // Internal Server Error
            }
        }
        break;


    default:
        http_response_code(405); // Method Not Allowed
        break;


}