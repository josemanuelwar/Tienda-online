<?php
use Phalcon\Flash\Direct as FlashDirect;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Security;
error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

// Registramos un autoloader
$loader = new Loader();

$loader->registerDirs(
    [
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
    ]
);

$loader->register();

// Crear un DI
$di = new FactoryDefault();

// Configurar el componente vista
$di->set(
    'view',
    function () {
        $view = new View();
        $view->setViewsDir(APP_PATH . '/views/');
        return $view;
    }
);

// Configurar servicio de base de datos
$di->set(
    'db',
    function () {
        return new DbAdapter(
            [
                'host'     => '127.0.0.1',
                'username' => 'root',
                'password' => '',
                'dbname'   => 'boutique',
            ]
        );
    }
);
//mensajes fhlas
$di->set('flash',
    function(){
        return new FlashDirect();
    }
);
//sesion
$di->setShared(
            'session',
            function(){
                $session = new \Phalcon\Session\Adapter\Files();
                $session->start();
                return $session;
            }
);
//seguridada de constraseña
$di->set(
        'Security',
        function(){
        $Security = new Security();
        //seguridad de 12 raunds en has
        $Security->setworkFactor(12);
        return $Security;
    },
    true 
);

// Configurar el URI base
$di->set(
    'url',
    function () {
        $url = new UrlProvider();
        $url->setBaseUri('/');
        return $url;
    }
);

$application = new Application($di);

try {
    // Gestionar la consulta
    $response = $application->handle();

    $response->send();
} catch (\Exception $e) {
    echo 'Excepción: ', $e->getMessage();
}