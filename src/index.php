<?php

use Phalcon\Mvc\Micro;

use Phalcon\Loader;




$loader =new Loader();

$loader->registerNamespaces(
[
    'Api\Handlers'=> './handlers'
    ]
);
$loader->register();


$prod = new Api\Handlers\Products();
$app = new Micro();
$app->get (
'/invoices/view/{id}/{where}/{limit}/{page}',
[$prod,'get']);


$app->handle(
$SERVER[ "REQUEST_URI"]
);





$app = new Micro();

$app->get(
    '/api/robots',
    function () {
        return "hola";
    }
);

$app->get(
    '/api/robots/search/{name}',
    function ($name) {
    }
);

$app->get(
    '/api/robots/{id:[0-9]+}',
    function ($id) {
    }
);

$app->post(
    '/api/robots',
    function () {
    }
);

$app->put(
    '/api/robots/{id:[0-9]+}',
    function ($id) {
    }
);

$app->delete(
    '/api/robots/{id:[0-9]+}',
    function ($id) {
    }
);

$app->handle(
    $_SERVER["REQUEST_URI"]
);