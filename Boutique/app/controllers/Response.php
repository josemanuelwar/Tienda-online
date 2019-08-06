<?php
use Phalcon\Http\Response;

$response= new response();

$response->setStatusCode(404,'no Found');

$response->setContent('sorry la pagina no existe');
$response->send();
?>