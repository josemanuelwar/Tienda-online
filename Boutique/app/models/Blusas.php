<?php  
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Manager;
class Blusas extends Model
{

	private $db;

	public function getBlusas(){

		$this->db   = $this->getDI()->get('db');

		$phql="SELECT *FROM blusa";

		$usu= $this->db->query($phql);
		return $usu->fetchAll();
	}

	public function SelecteBlusas($id){

		$this->db   = $this->getDI()->get('db');

		$phql="SELECT *FROM blusa WHERE id_blus = :id";


		$usu= $this->db->query($phql,[
										'id'=> $id,
									]
	);
		return $usu->fetchAll();
	
	}

}
?>