<?php 
require_once "../controladores/subcategorias.controlador.php";
require_once "../modelos/subcategorias.modelo.php";

class AjaxSubcategoria{

	public $idSub;

	public function ajaxEditarSubCategoria(){

		$item = "id";
		$valor = $this->idSub;

		$regresa = ControladorSubCategorias::ctrMostrarSubCategorias($item,$valor);

		echo json_encode($regresa);

	}
}

/*editar */
if (isset($_POST["idSub"])){
	$editarSub = new AjaxSubcategoria();
	$editarSub -> idSub = $_POST["idSub"];
	$editarSub -> ajaxEditarSubCategoria();
}

