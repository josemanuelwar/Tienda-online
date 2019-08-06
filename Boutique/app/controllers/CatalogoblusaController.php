<?php 
use Phalcon\Mvc\Controller;
use Phalcon\Assets\Manager;
use Phalcon\Http\Request;
use Phalcon\Http\Response;
class CatalogoblusaController extends Controller
{
	public function indexAction(){
		$this->assets->addCss('Boutique/public/css/estilos.css');
		$this->assets->addJs('Boutique/public/js/add.js');
		$this->assets->addJs('Boutique/public/js/com.js');
		$blusa = new Blusas();
		$img =$blusa->getBlusas();
		$this->view->blus = $img;
		$this->view->pick('Catalogoblusa/Catalogoblusa');
	}

	public function addblusAjaxAction($id,$precio){

		$response = new Response();

		if ($id == null || $precio == null)
        {
            $response->setcontent(json_encode([
                    'status'  => 'error',
                    'mensaje' => 'Faltaron parametros',
                ]));
        }

        $blusa = new Blusas();
        $ventas = new Venta();
        $conBlusa=$blusa->SelecteBlusas($id);
        $fecha=date('H:i:s');

        if($conBlusa != null){

        	foreach ($conBlusa as $value) {
        		
        	$Decripcion=$value['Descripcion'];
            $precio=$value['Precio'];
            $Id=$value['id_blus'];
            $tipo="Blusa";

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