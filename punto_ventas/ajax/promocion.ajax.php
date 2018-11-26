<?php
require_once "../controladores/promocion.controlador.php";
require_once "../modelos/promocion.modelo.php";

class AjaxPromocion{
	public $fechaInicio;
	public $idProducto;

	public function mostrarPromocion(){

	$item = "fecha_inicio";
	$valor = $this->fechaInicio;

	$respuesta = ControladorPromocion::ctrMostrarPromocion2($item,$valor);
	echo json_encode($respuesta);

	}

	public function mostrarProductoPromocion(){
		$item = "id_producto";
		$valor = $this->idProducto;

		$respuesta = ControladorPromocion::ctrMostrarPromocion2($item,$valor);
		echo json_encode($respuesta);
		
	}
}

if (isset($_POST["fecha"])) {
	$variable = new AjaxPromocion();
	$variable -> fechaInicio = $_POST["fecha"];
	$variable ->mostrarPromocion();	
}
if (isset($_POST["idProducto"])) {
	$variableP = new AjaxPromocion();
	$variableP -> idProducto = $_POST["idProducto"];
	$variableP -> mostrarProductoPromocion();
} 