
<?php  
	require_once "../controladores/categorias.controlador.php"; 
	require_once "../modelos/categorias.modelo.php";

	require_once "../controladores/subcategorias.controlador.php";
	require_once "../modelos/subcategorias.modelo.php";

class AjaxSubCategoria{

	public $idCategoria;
	public $idSubCategoria;
	
	public function ajaxMostrarSubCategoria(){
		
		$item = "id_categoria";
		$valor = $this->idCategoria;

		$respuesta = ControladorSubCategorias::ctrMostrarSub($item,$valor);

		echo json_encode($respuesta);
	}

	public function ajaxMostrarSub(){

		$item = "id";
		$valor = $this->idSubCategoria;

		$respuesta = ControladorSubCategorias::ctrMostrarSubCategoriasDos($item,$valor);

		echo json_encode($respuesta);
	}
}



/*  categoria */
if (isset($_POST["idCategoria"])) {
	$categoria = new AjaxSubCategoria();
	$categoria -> idCategoria = $_POST["idCategoria"];
	$categoria -> ajaxMostrarSubCategoria();
} 


if (isset($_POST["idSubCategoria"])) {
	$subcategoria = new AjaxSubCategoria();
	$subcategoria -> idSubCategoria = $_POST["idSubCategoria"];
	$subcategoria -> ajaxMostrarSub();
} 


