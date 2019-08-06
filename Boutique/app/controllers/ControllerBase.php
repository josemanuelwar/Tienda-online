<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

public function indexAction()
    {
    $this->assets->addCss('css/bootstrap/css/bootstrap.css');
	$this->assets->addJs('js/jquery-3.3.1.min.js');
	//$this->assets->addJs('js/npm.js',true);
	$this->assets->addJs('js/popper.js');
	$this->assets->addJs('css/bootstrap/js/bootstrap.bundle.js');

    }


}
