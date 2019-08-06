<?php  
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Manager;
class Falda extends Model
{


	private $db;

	public function getFalda()
	{
		$this->db   = $this->getDI()->get('db');

		$phql="SELECT *FROM faldas";

		$usu= $this->db->query($phql);
		return $usu->fetchAll();
	}


	public function SelecteFalda($id){

		$this->db   = $this->getDI()->get('db');

		$phql="SELECT *FROM faldas WHERE id_fal = :id";


		$usu= $this->db->query($phql,[
										'id'=> $id,
									]
	);
		return $usu->fetchAll();
	
	}


	




}
?>