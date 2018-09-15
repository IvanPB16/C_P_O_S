<?php  
   
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxProductos{

	public $idCategoria;
	public $idProducto;

	
	/* generar codigo */
	 public function ajaxGenerarCodigo(){
	 	$item = "id_categoria";
	 	$valor = $this->idCategoria;
	 	
	$respuesta = ControladorProducto::ctrMostrarProducto($item,$valor);
	 	echo json_encode($respuesta);
	 } 

	 public function ajaxEditarProducto(){

	 	$item = "id";
	 	$valor = $this->idProducto;
	 	
		$respuesta = ControladorProducto::ctrMostrarProducto($item,$valor);
		
	 	echo json_encode($respuesta);


	 }
 
}  

/* generar codigo */

if (isset($_POST["idCategoria"])) {
	$generar = new AjaxProductos();
	$generar -> idCategoria = $_POST["idCategoria"];
	$generar ->ajaxGenerarCodigo();
}

/*editar producto*/
if (isset($_POST["idProducto"])) {
	$editarProducto = new AjaxProductos();
	$editarProducto -> idProducto = $_POST["idProducto"];
	$editarProducto -> ajaxEditarProducto();
}
