<?php
// src/bootstrap.php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;

require_once __DIR__ . '/../vendor/autoload.php';

$paths = [__DIR__ . "/Model"];
$isDevMode = true;

$dbParams = [
    'driver'   => 'pdo_mysql',
    'host'     => getenv('DATABASE_HOST') ?: '127.0.0.1',
    'port'     => getenv('DATABASE_PORT') ?: '3306',
    'user'     => getenv('DATABASE_USER') ?: 'admin',
    'password' => getenv('DATABASE_PASSWORD') ?: '',
    'dbname'   => getenv('DATABASE_NAME') ?: 'contacts_db',
    'charset'  => 'utf8mb4'
];

$config = Setup::createAttributeMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);
