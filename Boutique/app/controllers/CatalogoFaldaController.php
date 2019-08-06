<?php 
use Phalcon\Mvc\Controller;
use Phalcon\Assets\Manager;
use Phalcon\Http\Request;
use Phalcon\Http\Response;
class CatalogoFaldaController extends Controller
{
	public function indexAction(){
	$this->assets->addCss('Boutique/public/css/estilos.css');
	$this->assets->addJs('Boutique/public/js/com.js');
	$this->assets->addJs('Boutique/public/js/add.js');

	$falda = new Falda();

	$faldass=$falda->getFalda();

	$this->view->fal=$faldass;

	$this->view->pick('CatalogoFalda/CatalogoFalda');
	}


	public function addfaldaAjaxAction($id,$precio){

		$response = new Response();

		if ($id == null || $precio == null)
        {
            $response->setcontent(json_encode([
                    'status'  => 'error',
                    'mensaje' => 'Faltaron parametros',
                ]));
        }

        $falda = new Falda();
        $ventas = new Venta();
        $confalda=$falda->SelecteFalda($id);
        $fecha=date('H:i:s');

        if($confalda != null){

        	foreach ($confalda as $value) {
        		
        	$Decripcion=$value['Descripcion'];
            $precio=$value['Precio'];
            $Id=$value['id_fal'];
            $tipo="Falda";

        	}
        $Usuar = $this->session->get('Login');

        $selec=$ventas->SelectVentas($Usuar,$tipo,$Id);

            if($selec != null){

            foreach ($selec as $sel) {
                $pagado=$sel['pagado'];
                $cantidad=$sel['cantidad'];
            }

            if($pagado == 1){
            $ventas->InsertarVenta($Id,$precio,$Usuar,$fecha,$tipo,$Decripcion);
            $response->setcontent(json_encode([
                    'status'  => '!ok',
                    'mensaje' => 'Sea agragado correctamente a tu lista de compras',
                ]));
            

            }else{

                $sum=$cantidad+1;

            $rest=$ventas->UpdateVenta($Usuar,$tipo,$Id,$sum);

            $response->setcontent(json_encode([
                    'status'  => '!ok',
                    'mensaje' => 'Sea agragado correctamente a tu lista de compras',
                ]));
            
            
            }//actulizando
         
          }else{
         $ventas->InsertarVenta($Id,$precio,$Usuar,$fecha,$tipo,$Decripcion);

         $response->setcontent(json_encode([
                    'status'  => '!ok',
                    'mensaje' => 'Sea agragado correctamente a tu lista de compras',
                ]));
         }//fin del comparacion si existe

        }//fin del if principal

        return $response;

	}

}

 ?>