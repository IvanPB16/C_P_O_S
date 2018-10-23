<?php 
require_once "../controladores/subcategorias.controlador.php";
require_once "../modelos/subcategorias.modelo.php";

Class AjaxSubCategoria(){
	public $nombre;

	public function ajaxEditarSubCategoria(){
		$item = null;
		$valor = null;

		$respuesta = ControladorSubCategorias::ctrEditarMostrar($item,$valor);
		echo json_encode($respuesta);
	}
}

// if (isset($_POST["nombre"])) {

	$editar = new AjaxSubCategoria();
	$editar -> nombre = $_POST["nombre"];
	$editar -> ajaxEditarSubCategoria();
// }