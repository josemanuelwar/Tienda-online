<?php  
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Manager;
class Vestido extends Model
{


	private $db;

	public function getVestidos()
	{
		$this->db   = $this->getDI()->get('db');

		$phql="SELECT *FROM vestido";

		$usu= $this->db->query($phql);
		return $usu->fetchAll();
	}


	public function SeleciondeVestido($id)
	{
		$this->db   = $this->getDI()->get('db');

		$phql="SELECT *FROM vestido WHERE id_PRO = :id";


		$usu= $this->db->query($phql,[
										'id'=> $id,
									]
	);
		return $usu->fetchAll();
		
	}




}
?>