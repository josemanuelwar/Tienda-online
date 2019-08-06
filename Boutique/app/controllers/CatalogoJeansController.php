<?php 
use Phalcon\Mvc\Controller;
use Phalcon\Assets\Manager;
class CatalogoJeansController extends Controller
{
	public function indexAction(){
	$this->assets->addCss('Boutique/public/css/estilos.css');
		$this->assets->addJs('Boutique/public/js/com.js');
		$vestido= new Vestido();
		$ur=$vestido->getVestidos();
		$this->view->ves =$ur;
	$this->view->pick('CatalogoJeans/CatalogoJaens');
	}


}

 ?>