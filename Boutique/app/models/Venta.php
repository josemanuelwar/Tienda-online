<?php 
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Manager;
/**
 *  
 */
class Venta extends Model
{
	
	private $db;
/*insertamos si el producto no existe*/
	public function InsertarVenta($dato,$idp,$Usuario,$fecha,$tabla,$Decripcion)
	{
		
		$this->db = $this->getDI()->get('db');

		$phql ="INSERT INTO venta (id_cliente, 	id_producto, Decripcion, cantidad, 	precio, fecha,Tipo,pagado) VALUES (:id_cliente, :id_producto, :Decripcion, :cantidad, :precio, :fecha, :Tipo, :pagado)";

		
		
		$vestidos = $this->db->query($phql,[
									'id_cliente' =>	$Usuario,
									'id_producto' => $dato,
									'Decripcion' => $Decripcion,
									'cantidad' => 1,
									'precio' => $idp,
									'fecha' => $fecha,
									'Tipo' => $tabla,
									'pagado'=>0
									]
									);

		
	}
	/*verificamos si el producto ya existe*/
	public function SelectVentas($id_usuario,$tipo,$id)
	{
		$this->db = $this->getDI()->get('db');

		$phql="SELECT *FROM venta WHERE  id_cliente = :id_cliente AND Tipo = :Tipo AND id_producto = :id_producto ";


		$verificando= $this->db->query($phql,[
										'id_cliente'=> $id_usuario,
										'Tipo' => $tipo,
										'id_producto' => $id
									]
								);

		return $verificando->fetchAll();

	}
   /*Actualizamos el producto y sumamos la cnatidad*/
	public function UpdateVenta($id_usuario,$tipo,$id,$suma)
	{
		try{
			
			$this->db = $this->getDI()->get('db');
			$phql="UPDATE venta SET cantidad = :cantidad WHERE  id_cliente = :id_cliente AND Tipo = :Tipo AND id_producto = :id_producto AND pagado = :pagado";

				$Actulizar = $this->db->query($phql, [
					'id_cliente'=> $id_usuario,
					'Tipo' => $tipo,
					'id_producto' => $id,
					'pagado'=> 0,
					'cantidad' => $suma]);
        $res = true;

		}catch(\Exception $e)
		{
			$res = false;
		}

		return $res;
	}

	public function TablasVentas($id_usuario)
	{
		$this->db = $this->getDI()->get('db');

		$phql="SELECT *FROM venta WHERE  id_cliente = :id_cliente AND pagado = :pagado";



		$verificando= $this->db->query($phql,[
										'id_cliente'=> $id_usuario,
										'pagado'=> 0,
									]
								);

		return $verificando->fetchAll();

		



	}
}
?>