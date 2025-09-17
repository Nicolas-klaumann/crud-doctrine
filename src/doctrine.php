<?php
// src/doctrine.php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;

require_once __DIR__ . '/../vendor/autoload.php';

// Caminho das entidades
$paths = [__DIR__ . "/Model"];
$isDevMode = true;

// Configuração via Attributes (PHP 8+)
$config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);

// Configuração do banco (variáveis de ambiente ou defaults)
$dbParams = [
    'driver'   => 'pdo_mysql',
    'host'     => getenv('DATABASE_HOST') ?: '127.0.0.1',
    'port'     => getenv('DATABASE_PORT') ?: '3306',
    'user'     => getenv('DATABASE_USER') ?: 'admin',
    'password' => getenv('DATABASE_PASSWORD') ?: 'admin',
    'dbname'   => getenv('DATABASE_NAME') ?: 'contacts_db',
    'charset'  => 'utf8mb4'
];

// Cria a conexão
$connection = DriverManager::getConnection($dbParams, $config);

// Cria o EntityManager
$entityManager = new EntityManager($connection, $config);
