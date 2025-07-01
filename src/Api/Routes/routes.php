<?php
use Api\Controllers\ClienteController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/clientes' && $method === 'POST') {
    (new ClienteController())->store();
    exit;
}