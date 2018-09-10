<?php  
	require_once "../controladores/categorias.controlador.php"; 
	require_once "../modelos/categorias.modelo.php";
 
class AjaxCategoria{

	public $idCategoria;
	public $validarCategoria;

	public function ajaxEditarCategoria(){
		
		$item = "id";
		$valor = $this->idCategoria;

		$respuesta = ControladorCategorias::ctrMostrarCategorias($item,$valor);

		echo json_encode($respuesta);
	}

	public function ajaxValidarCategoria(){

		$item = "categoria";
		$valor = $this->validarCategoria;

		$respuesta = ControladorCategorias::ctrMostrarCategorias($item,$valor);

		echo json_encode($respuesta);
	}

}


/* Editar categoria */

if (isset($_POST["idCategoria"])) {
	$categoria = new AjaxCategoria();
	$categoria -> idCategoria = $_POST["idCategoria"];
	$categoria -> ajaxEditarCategoria();
} 


/* validar categoria */
if (isset($_POST["validarCategoria"])) {
	$valCategoria = new AjaxCategoria();
	$valCategoria -> validarCategoria = $_POST["validarCategoria"];
	$valCategoria -> ajaxValidarCategoria();
}