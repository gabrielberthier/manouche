<?php
declare (strict_types = 1);

use DI\ContainerBuilder;
use App\Core\HTTP\RouterFactory\RouterFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Http\Exception\MethodNotAllowedException;
use League\Route\Http\Exception\NotFoundException;
use Doctrine\ORM\EntityManager;
use Manouche\Models\UserModel;

//use App\Core\App;

require_once('config/errors.php');

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions('config/di-config.php');
$containerBuilder->useAnnotations(true);
$container = $containerBuilder->build();

//deprecated
// $container->set(QueryBuilder::class, new QueryBuilder(
//     Connection::make($container->get('config')['database'])
// ));

// App::bind('config', require 'config.php');
// App::bind('database', new QueryBuilder(
//     Connection::make(App::get('config')['database'])
// ));

$router = RouterFactory::make($container);

try {
    $response = $router->dispatch($container->get('request'), $container->get('response'));

    // send the response to the browser
    (new SapiEmitter)->emit($response);
} catch (NotFoundException $ex) {
    echo $ex->getMessage();
    require 'public/error404.html';
    throw new RuntimeException($ex->getMessage());
} catch (MethodNotAllowedException $ex) {
    echo $ex->getMessage();
}
