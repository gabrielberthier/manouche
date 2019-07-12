<?php

use Zend\Diactoros\Response;
use Twig\Environment;
use App\Core\Utilities\Dumper;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use App\Core\ViewComponents\AuthStaticCaller;
use Twig\TwigFunction;

return [
    'request' => Zend\Diactoros\ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES),
    'response' => new Response(),
    Environment::class => function () {
        $loader = new Twig_Loader_Filesystem('app/views');
        $twig = new Environment($loader, [
            'debug' => true,
        ]);
        $twig->addExtension(new AuthStaticCaller());
        $twig->addFunction(new TwigFunction('asset', function ($asset) {
            // implement whatever logic you need to determine the asset path
            return sprintf('/assets/%s', ltrim($asset, '/'));
        }));
        return $twig;
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
/**
 * Another option to use instead of EntityManager is
 * Doctrine's DBAL, which provides a really cool and useful 
 * environment to database queries. To use it, just switch EntityManager 
 * to the class below :D
 * QueryBuilder::class => function(){
 *  $options = env("database");
 *  $connection = DriveManager::getConnection($options);
 *  return $connection->createQueryBuilder()
 * }
 */
