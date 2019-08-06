<?php 
use Phalcon\Mvc\Controller;
use Phalcon\Assets\Manager;
class comprarController extends Controller
{
	public function indexAction()
	{
		$this->assets->addCss('Boutique/public/css/estilos.css');
		$this->assets->addJs('Boutique/public/js/add.js');
		$this->assets->addJs('Boutique/public/js/com.js');

		$Usuar = $this->session->get('Login');
		$lista= new Venta();
		$mostrar=$lista->TablasVentas($Usuar);

		
		$SumaTotal=0;
		foreach ($mostrar as $key) {
			$SumaTotal += $key['cantidad']*$key['precio'];
		}
		
		$this->view->Total=$SumaTotal;
		$this->view->list=$mostrar;
		$this->view->pick('comprar/comprar');	
	}
	/*Eliminamos la compra del carro*/
	public function EliminarcompraAction($id,$tipo)
	{
		$Usuar = $this->session->get('Login');
		$venta=new Venta();//modelo Ventas


		
		if($id == null)
		{
			echo "falta el parametro del id";
		}

		if($tipo == null)
		{
			echo "falta el parametro del tipo";
		}
		/*eliminamos los vestidos*/
		if ($tipo == 'Vestido') {
			
			$elmivestido=$venta->SelectVentas($Usuar,$tipo,$id);
			
			if($elmivestido != null)
			{
				if ($elmivestido[0]['pagado'] == 0 ) {

					$resta=$elmivestido[0]['cantidad']-1;

					$rest=$venta->UpdateVenta($Usuar,$tipo,$id,$resta);
					if ($rest) {
						echo "<script> location.href='http://localhost/Boutique/comprar'</script>";
					}else{
						echo "no se pudo eliminar";
						echo "<script> location.href='http://localhost/Boutique/comprar'</script>";
					}

				}
			}


		}
		/* eliminamos las blusas*/
		if($tipo == 'Blusa'){

			$elmivestido=$venta->SelectVentas($Usuar,$tipo,$id);
			
			if($elmivestido != null)
			{
				if ($elmivestido[0]['pagado'] == 0 ) {

					$resta=$elmivestido[0]['cantidad']-1;

					$rest=$venta->UpdateVenta($Usuar,$tipo,$id,$resta);
					if ($rest) {
						echo "eliminado";
						echo "<script> location.href='http://localhost/Boutique/comprar'</script>";
					}else{
						echo "no se pudo eliminar";
						echo "<script> location.href='http://localhost/Boutique/comprar'</script>";
					}

				}
			}
			
		}
			/*eliminamos las Faldas*/
		if ($tipo == 'Falda') {

			$elmivestido=$venta->SelectVentas($Usuar,$tipo,$id);
			
			if($elmivestido != null)
			{
				if ($elmivestido[0]['pagado'] == 0 ) {

					$resta=$elmivestido[0]['cantidad']-1;

					$rest=$venta->UpdateVenta($Usuar,$tipo,$id,$resta);
					if ($rest) {
						echo "eliminado";
						echo "<script> location.href='http://localhost/Boutique/comprar'</script>";
					}else{
						echo "no se pudo eliminar";
						echo "<script> location.href='http://localhost/Boutique/comprar'</script>";
					}

				}
			}
		}

		
	}
}