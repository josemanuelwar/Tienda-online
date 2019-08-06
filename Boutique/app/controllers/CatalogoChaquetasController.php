<?php 
use Phalcon\Mvc\Controller;
use Phalcon\Assets\Manager;
class CatalogoChaquetasController extends Controller
{
	public function indexAction(){

		$vestido= new Vestido();
		$ur=$vestido->getVestidos();
		$this->view->ves =$ur;
		$this->view->pick('CatalogoChaquetas/CatalogoChaquetas');
	}



}	