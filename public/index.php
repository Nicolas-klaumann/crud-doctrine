<?php
// public/index.php

require_once __DIR__ . '/../src/doctrine.php';

use App\Controller\ControllerPessoa;
use App\Controller\ControllerContato;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Remove o /index.php da URI se ele estiver presente
$uri = str_replace('/index.php', '', $uri);

// Normaliza a URI: remove a barra final para que /recurso/ e /recurso sejam tratados da mesma forma
if ($uri !== '/') {
    $uri = rtrim($uri, '/');
}

// Defiição das rotas
$routes = [
    'pessoa' => [
        'GET'    => [
            ''  => [ControllerPessoa::class, 'index'],
            '/' => [ControllerPessoa::class, 'index'],
            '/create'  => [ControllerPessoa::class, 'create'],
            '/(?<id>\d+)' => [ControllerPessoa::class, 'show'],
            '/(?<id>\d+)/edit' => [ControllerPessoa::class, 'edit'],
            '/(?<id>\d+)/delete' => [ControllerPessoa::class, 'delete'],
        ],
        'POST' => [
            '/store'    => [ControllerPessoa::class, 'store'],
            '/(?<id>\d+)/update' => [ControllerPessoa::class, 'update'],
        ],
    ],
    'contato' => [
        'GET'    => [
            ''  => [ControllerContato::class, 'index'],
            '/' => [ControllerContato::class, 'index'],
            '/create'  => [ControllerContato::class, 'create'],
            '/(?<id>\d+)' => [ControllerContato::class, 'show'],
            '/(?<id>\d+)/edit' => [ControllerContato::class, 'edit'],
            '/(?<id>\d+)/delete' => [ControllerContato::class, 'delete'],
        ],
        'POST' => [
            '/store'    => [ControllerContato::class, 'store'],
            '/(?<id>\d+)/update' => [ControllerContato::class, 'update'],
        ],
    ]
];

// Lógica de roteamento
$pathParts = explode('/', trim($uri, '/'));
$resource = $pathParts[0] ?? '';

// Redireciona a raiz para a página de pessoas
if ($resource === '') {
    header('Location: /pessoa');
    exit;
}

if (isset($routes[$resource])) {
    $resourceRoutes = $routes[$resource];
    if (isset($resourceRoutes[$method])) {
        $methodRoutes = $resourceRoutes[$method];
        $matched = false;
        foreach ($methodRoutes as $pattern => $handler) {
            $regex = '#^/' . $resource . $pattern . '$#';
            if (preg_match($regex, $uri, $matches)) {
                $controllerClass = $handler[0];
                $actionMethod = $handler[1];

                $controller = new $controllerClass($entityManager);
                
                // Extrai parâmetros nomeados da URL (ex: id)
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                
                // Chama o método do controlador com os parâmetros
                call_user_func_array([$controller, $actionMethod], $params);
                $matched = true;
                break;
            }
        }
        if (!$matched) {
            http_response_code(404);
            echo "<h1>404 - Página não encontrada</h1>";
        }
    } else {
        http_response_code(405);
        echo "<h1>405 - Método não permitido</h1>";
    }
} else {
    http_response_code(404);
    echo "<h1>404 - Página não encontrada</h1>";
}
