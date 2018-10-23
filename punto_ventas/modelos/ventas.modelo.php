<?php  
require_once "conexion.php";
    
Class ModeloVentas{

	static public function mdlMostrarVentas($tabla,$item,$valor){

		if($item != null){
			$statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");
			$statement -> bindParam(":".$item,$valor,PDO::PARAM_STR);
			$statement -> execute();
			return $statement ->fetch();
		}else{
			$statement = Conexion::Conectar()->prepare("SELECT * FROM $tabla  ORDER BY id ASC");
			$statement -> execute();
			return $statement ->fetchAll();
		}

		$statement -> close();
		$statement = null;
	}

	static public function mdlAgregarVentas($tabla,$data){
		$statement = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo_venta,producto,impuesto, subtotal,total,metodo_pago,id_vendedor)VALUES(:codigo_venta,:producto, :impuesto,:subtotal,:total,:metodo_pago, :id_vendedor)");

		$statement -> bindParam(":codigo_venta",$data["codigo"],PDO::PARAM_INT);
		$statement -> bindParam(":producto",$data["productos"],PDO::PARAM_STR);
		$statement -> bindParam(":impuesto",$data["impuesto"],PDO::PARAM_STR);
		$statement -> bindParam(":subtotal",$data["neto"],PDO::PARAM_STR);
		$statement -> bindParam(":total",$data["total"],PDO::PARAM_STR);
		$statement -> bindParam(":metodo_pago",$data["metodo_pago"],PDO::PARAM_STR);
		$statement -> bindParam(":id_vendedor",$data["idVendedor"],PDO::PARAM_INT);
		if ($statement->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$statement->close();
		$statement=null;
	}

	static public function mdlEditarVentas($tabla,$data){
		$statement = Conexion::conectar()->prepare("UPDATE $tabla SET codigo_venta = :codigo_venta,producto = :producto,impuesto = :impuesto, subtotal = :subtotal,total = :total,metodo_pago = :metodo_pago,id_vendedor = :id_vendedor WHERE codigo_venta = :codigo_venta");

		$statement -> bindParam(":codigo_venta",$data["codigo"],PDO::PARAM_INT);
		$statement -> bindParam(":producto",$data["productos"],PDO::PARAM_STR);
		$statement -> bindParam(":impuesto",$data["impuesto"],PDO::PARAM_STR);
		$statement -> bindParam(":subtotal",$data["neto"],PDO::PARAM_STR);
		$statement -> bindParam(":total",$data["total"],PDO::PARAM_STR);
		$statement -> bindParam(":metodo_pago",$data["metodo_pago"],PDO::PARAM_STR);
		$statement -> bindParam(":id_vendedor",$data["idVendedor"],PDO::PARAM_INT);
		if ($statement->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$statement->close();
		$statement=null;
	}

	static public function mdlEliminarVenta($tabla,$data){
		$statement = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$statement -> bindParam(":id",$data,PDO::PARAM_INT);
		if($statement -> execute()){
			return "ok";
		}else{
			return "error";
		}
		$statement ->close();
		$statement = null;
	}

	static public function mdlRangoFechaVenta($tabla,$fechaInicial,$fechaFinal){
		if ($fechaInicial == null) {
		$statement = Conexion::conectar()->prepare("SELECT * FROM $tabla  ORDER BY id ASC");
			$statement -> execute();
			return $statement ->fetchAll();
		}else if ($fechaInicial == $fechaFinal) {
			$statement = Conexion::Conectar()->prepare("SELECT * FROM $tabla  WHERE fecha like '%$fechaFinal%'");
			$statement -> bindParam(":fecha",$fechaFinal,PDO::PARAM_STR);
			$statement -> execute();
			return $statement ->fetchAll();
		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if ($fechaFinalMasUno == $fechaActualMasUno) {
				$statement = Conexion::Conectar()->prepare("SELECT * FROM $tabla  WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");
			}else{
				$statement = Conexion::Conectar()->prepare("SELECT * FROM $tabla  WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");
			}

			
			$statement -> execute();
			return $statement ->fetchAll();
		}

		$statement -> close();
		$statement = null;
	}

	static public function mdlSumaTotalVentas($tabla){

		$statement = Conexion::Conectar()->prepare("SELECT SUM(subtotal) as total FROM $tabla");
		$statement -> execute();

		return $statement -> fetch();

		$statement -> close();
		$statement = null;
	}

}




