<?php
// public/index.php

require_once __DIR__ . '/../src/doctrine.php';

use App\Controller\ControllerPessoa;
use App\Controller\ControllerContato;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$uri = str_replace('/index.php', '', $uri);

// Router simples
switch (true) {
    // Pessoas
    case $uri === '/' || $uri === '/pessoas':
        (new ControllerPessoa($entityManager))->index();
        break;

    case $uri === '/pessoas/create' && $method === 'GET':
        (new ControllerPessoa($entityManager))->create();
        break;

    case $uri === '/pessoas/store' && $method === 'POST':
        (new ControllerPessoa($entityManager))->store($_POST);
        break;

    case preg_match('#^/pessoas/edit/(\d+)$#', $uri, $matches) && $method === 'GET':
        (new ControllerPessoa($entityManager))->edit((int)$matches[1]);
        break;

    case $uri === '/pessoas/update' && $method === 'POST':
        (new ControllerPessoa($entityManager))->update($_POST);
        break;

    case preg_match('#^/pessoas/delete/(\d+)$#', $uri, $matches) && $method === 'GET':
        (new ControllerPessoa($entityManager))->delete((int)$matches[1]);
        break;

    // Contatos
    case $uri === '/contatos':
        (new ControllerContato($entityManager))->index();
        break;

    case $uri === '/contatos/create' && $method === 'GET':
        (new ControllerContato($entityManager))->create();
        break;

    case $uri === '/contatos/store' && $method === 'POST':
        (new ControllerContato($entityManager))->store($_POST);
        break;

    case preg_match('#^/contatos/edit/(\d+)$#', $uri, $matches) && $method === 'GET':
        (new ControllerContato($entityManager))->edit((int)$matches[1]);
        break;

    case $uri === '/contatos/update' && $method === 'POST':
        (new ControllerContato($entityManager))->update($_POST);
        break;

    case preg_match('#^/contatos/delete/(\d+)$#', $uri, $matches) && $method === 'GET':
        (new ControllerContato($entityManager))->delete((int)$matches[1]);
        break;

    default:
        http_response_code(404);
        echo "<h1>404 - Página não encontrada</h1>";
        break;
}
