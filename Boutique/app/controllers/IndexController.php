<?php
use Phalcon\Mvc\Controller;
use Phalcon\Assets\Manager;
use Phalcon\Http\Request;
use Phalcon\Http\Response;
class IndexController extends Controller
{
	
    public function indexAction()
    {
    $this->assets->addCss('Boutique/public/css/estilos.css');
	
    }

    public function TimerAction(){
    	$hora=date('H:i:s');
    }

    public function SalirAction(){
        $this->session->remove('Login');
        echo "<script> location.href='http://localhost/Boutique'</script>";

    }

    public function addAjaxAction($date,$precio)
    {  
        $response = new Response();

       if ($date == null || $precio == null)
        {
            $response->setcontent(json_encode([
                    'status'  => 'error',
                    'mensaje' => 'Faltaron parametros',
                ]));
        }
         $vestido=new Vestido();//modelo Vestidos
         $venta=new Venta();//modelo Ventas
         $consulta=$vestido->SeleciondeVestido($date);//metdo de modelo vetido
         $fecha=date('H:i:s');//obtener Fecha del Sistema
        


         if($consulta != null){
            
          foreach ($consulta as $con ) { 
             $Decripcion=$con['Descripcion'];
             $precio=$con['Precio'];
             $Id=$con['id_PRO'];
             $tipo="Vestido";
                }//fin del foreach

         $Usuar = $this->session->get('Login');

         $selec=$venta->SelectVentas($Usuar,$tipo,$Id);

         if($selec != null){

            foreach ($selec as $sel) {
                $pagado=$sel['pagado'];
                $cantidad=$sel['cantidad'];
            }

            if($pagado == 1){
            $venta->InsertarVenta($Id,$precio,$Usuar,$fecha,$tipo,$Decripcion);
            $response->setcontent(json_encode([
                    'status'  => '!ok',
                    'mensaje' => 'Sea agragado correctamente a tu lista de compras',
                ]));
            

            }else{

                $sum=$cantidad+1;

            $rest=$venta->UpdateVenta($Usuar,$tipo,$Id,$sum);

            $response->setcontent(json_encode([
                    'status'  => '!ok',
                    'mensaje' => 'Sea agragado correctamente a tu lista de compras',
                ]));
            
            
            }//actulizando
         
          }else{
         $venta->InsertarVenta($Id,$precio,$Usuar,$fecha,$tipo,$Decripcion);

         $response->setcontent(json_encode([
                    'status'  => '!ok',
                    'mensaje' => 'Sea agragado correctamente a tu lista de compras',
                ]));
         }//fin del comparacion si existe
         
        }//fin del if
        
        
            return $response;
        
    }    
        


}

