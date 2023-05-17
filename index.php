<?php
$request = $_SERVER['REQUEST_URI'];
switch ($request) {
    case '/':
        require __DIR__ . '/Views/main.html';
        break;
    case '/add-product':
        require __DIR__ . '/Views/add.html';
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
        break;
}
?>