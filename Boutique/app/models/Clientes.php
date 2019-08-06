<?php  
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Manager;
class Clientes extends Model
{


	private $db;

	public function Seccion($dato)
	{
		$this->db   = $this->getDI()->get('db');

		$phql="SELECT *FROM clientes WHERE Email = :dato";

		$usu= $this->db->query($phql,[
										'dato'=> $dato,
									]
	);
		return $usu->fetchAll();
	}

}
?>