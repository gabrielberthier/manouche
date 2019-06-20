<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

// Diretório aonde vou guardar as entidades
$paths = array("./app/Models");
$isDevMode = false;

// Dados da conexão
$dbParams = require_once 'config/config.php';

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams['database'], $config);