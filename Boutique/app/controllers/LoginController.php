<?php
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Phalcon\Tag;
class LoginController extends Controller
{
    

    

    public function indexAction()
    {
    	$this->assets->addCss('Boutique/public/css/estilos.css');

    }

    public function loginAction()
    {
    	$Nombr=$this->request->getPost('Correo');
    	$password=$this->request->getPost('Passwor');

    	if ($this->request->getPost('Correo') == null ){
            echo "<script> alert('El campo del Correo esta Vasio');</script>";
        }elseif($this->request->getPost('Passwor') == null) {
            echo "<script> alert('El campo de la contraseña esta vacia');</script>";
        }else
        {
            //queri
            $selec = new Clientes();
            $rest = $selec->Seccion($Nombr);
            if ($rest>0)
             {
            
              foreach ($rest as $ret)
               {
                  $cont =$ret['Contracena'];
                  $no  = $ret['Email'];
                }
                //echo $cont;

                if ($this->security->checkHash($password,$cont)) {
                    echo "<script> alert('Bienvenido a la Biotique ');</script>";

                    $this->session->set('Login',$no);
                
                      echo "<script> location.href='http://localhost/Boutique'</script>";

                }
                else
                {
                    echo "<script> alert('Contraseña o usuario equivocado');</script>";
                    echo "<script> location.href='http://localhost/Boutique/Login'</script>";
              }

            } 
            else
            {
             echo "<script> alert('El nombre que intento usar no se encuentra registrado');</script>";
             echo "<script> location.href='http://localhost/Boutique/Login'</script>";   
            }
        }

    }
}
