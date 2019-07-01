<?php

use Zend\Diactoros\Response;
use Twig\Environment;
use App\Core\Utilities\Dumper;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

return [
    'request' => Zend\Diactoros\ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES),
    'response' => new Response(),
    Environment::class => function () {
        $loader = new Twig_Loader_Filesystem('app/views');
        return new Environment($loader, [
            'debug' => true,
        ]);
    },
    Dumper::class => new Dumper(),
    EntityManager::class => function () {
        $paths = array("./app/Models");
        $isDevMode = false;

        // Dados da conexão
        $dbParams = env("database");

        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        return EntityManager::create($dbParams, $config);
    }
];
