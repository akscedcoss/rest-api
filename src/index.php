<?php

use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;



require_once("vendor/autoload.php");
$loader = new Loader();

$loader->registerNamespaces(
    [
        'Api\Handlers' => './handlers'
    ]
);
$loader->register();


$prod = new Api\Handlers\Products();
use Phalcon\Mvc\Application;
$app = new Micro();


$container = new FactoryDefault();
$application = new Application($container);
$container->set(
    'mongo',
    function () {
        $mongo =  new MongoDB\Client('mongodb://mongo', array('username'=>'root',"password"=>'password123'));
        return $mongo->store;
    },
    true
);


$app->get(
    '/invoices/view/{id}/{where}/{limit}/{page}',
    [$prod, 'get']
);

$app->get(
    '/products/search/{keyword}',
    [$prod, 'search']
);


$app->handle(
    $_SERVER["REQUEST_URI"]
);
