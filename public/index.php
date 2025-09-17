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
    // Pessoa
    case $uri === '/' || $uri === '/pessoa':
        (new ControllerPessoa($entityManager))->index();
        break;

    case $uri === '/pessoa/create' && $method === 'GET':
        (new ControllerPessoa($entityManager))->create();
        break;

    case $uri === '/pessoa/store' && $method === 'POST':
        (new ControllerPessoa($entityManager))->store($_POST);
        break;

    case preg_match('#^/pessoa/(\d+)$#', $uri, $matches) && $method === 'GET':
        (new ControllerPessoa($entityManager))->show((int)$matches[1]);
        break;
        
    case preg_match('#^/pessoa/(\d+)/edit$#', $uri, $matches) && $method === 'GET':
        (new ControllerPessoa($entityManager))->edit((int)$matches[1]);
        break;    
 
    case preg_match('#^/pessoa/(\d+)/update$#', $uri, $matches) && $method === 'POST':
        (new ControllerPessoa($entityManager))->update((int)$matches[1], $_POST);
        break;

    case preg_match('#^/pessoa/(\d+)/delete$#', $uri, $matches) && $method === 'GET':
        (new ControllerPessoa($entityManager))->delete((int)$matches[1]);
        break;
        
    // Contatos
    case $uri === '/contato':
        (new ControllerContato($entityManager))->index();
        break;

    case $uri === '/contato/create' && $method === 'GET':
        (new ControllerContato($entityManager))->create();
        break;

    case $uri === '/contato/store' && $method === 'POST':
        (new ControllerContato($entityManager))->store($_POST);
        break;
    
    case preg_match('#^/contato/(\d+)$#', $uri, $matches) && $method === 'GET':
        (new ControllerContato($entityManager))->show((int)$matches[1]);
        break;

    case preg_match('#^/contato/(\d+)/edit$#', $uri, $matches) && $method === 'GET':
        (new ControllerContato($entityManager))->edit((int)$matches[1]);
        break;

    case preg_match('#^/contato/(\d+)/update$#', $uri, $matches) && $method === 'POST':
        (new ControllerContato($entityManager))->update((int)$matches[1], $_POST);
        break;

    case preg_match('#^/contato/(\d+)/delete$#', $uri, $matches) && $method === 'GET':
        (new ControllerContato($entityManager))->delete((int)$matches[1]);
        break;

    default:
        http_response_code(404);
        echo "<h1>404 - Página não encontrada</h1>";
        break;
}
