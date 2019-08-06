<?php
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Phalcon\Tag;
class RegistroController extends Controller
{

    public function indexAction()
    {
    $this->assets->addCss('Boutique/public/css/estilos.css');

    $this->view->pick('Registro/index');
    }

    public function registroAction()
    {
    	$nombre=$this->request->getPost('nombre');
    	$apelli=$this->request->getPost('apellido');
    	$emal=$this->request->getPost('correo');
    	$direcion=$this->request->getPost('direcion');
    	$telfono=$this->request->getPost('tel');
    	
    	
        $conn=$this->request->getPost('Passwor');
    	 
    	    	
    	if ($this->request->getPost('nombre') == null) {
    		echo "<script> alert('El campo del nombre esta basio');</script>";
    	}
    	if ($this->request->getPost('apellido') == null) {
    		echo "<script> alert('El campo del Apellido esta basio');</script>";
    	}
    	if ($this->request->getPost('correo') == null) {

    		echo "<script> alert('El campo del Email esta basio');</script>";
    	}
    	if ($this->request->getPost('Passwor') == null) {
    		echo "<script> alert('El campo de la Contraseña esta basio');</script>";
    	}
    	if ($this->request->getPost('Passwor1') == null) {
    		echo "<script> alert('El campo de la direccion esta basio');</script>";
    	}
    	if ($this->request->getPost('direcion') == null) {
    		echo "<script> alert('El campo del TeleFono esta basio');</script>";
    	}

    	if ($this->request->getPost('Passwor') == $this->request->getPost('Passwor1')) {
  
                $selec = new Clientes();
                $rest = $selec->Seccion($emal);
            
            if ($rest != null) {
                 echo "<script> alert('El Correo ya se encuentra registrado');</script>";
                 echo "<script> location.href='http://localhost/Boutique/Registro'</script>";

                 } 
    else
    {

    $cont=$this->security->hash($conn);

$phql="INSERT INTO clientes(Nombre, Apellido, Email, Contracena, Direccion, Tel) VALUES (:Nombre:, :Apellido:, :Email:, :Contracena:, :Direccion:, :Tel:)";
		

		
		$registro = $this->modelsManager->executeQuery($phql,
            [
				'Nombre'    => $nombre,
				'Apellido'  => $apelli,
				'Email'     => $emal,
				'Contracena'=> $cont,
				'Direccion' => $direcion,
				'Tel'       => $telfono
			]
		);

            if ($registro === false) {
                echo "<script> alert('no se pudo registrar intenta mas tarde');</script>";
                echo "<script> location.href='http://localhost/Boutique/Registro'</script>";

            }else{
                echo "<script> alert('su registro fue un exito');</script>";
                echo "<script> location.href='http://localhost/Boutique'</script>";

            }
            
    }
        ////////////////////////////
        
    	}else
        {		
    	echo "<script> alert('la Contraseña no considen');</script>";
    	}
        //$this->response->redirect('Boutique');
    }

}

