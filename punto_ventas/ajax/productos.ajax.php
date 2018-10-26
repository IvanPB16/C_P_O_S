<?php  
    
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxProductos{

	public $idCategoria;
	public $idProducto;
	public $traerProducto;
	public $nombreProducto;

	
	/* generar codigo */
	 public function ajaxGenerarCodigo(){
	 		$item = "id_categoria";
	 		$valor = $this->idCategoria;
	 	
			$respuesta = ControladorProducto::ctrMostrarProducto($item,$valor);
	 		echo json_encode($respuesta);
	 } 

	 public function ajaxEditarProducto(){

	 	if ($this->traerProducto =="ok") {
		 	$item = null;
		 	$valor = null;
		 	
			$respuesta = ControladorProducto::ctrMostrarProducto($item,$valor);

		 	echo json_encode($respuesta);

		 	}else if($this->nombreProducto !=""){
		 		$item = "descripcion";
	 			$valor = $this->nombreProducto;
	 	
				$respuesta = ControladorProducto::ctrMostrarProducto($item,$valor);
		
	 			echo json_encode($respuesta);
		 	}else{
	 		$item = "id";
	 		$valor = $this->idProducto;
	 	
			$respuesta = ControladorProducto::ctrMostrarProducto($item,$valor);
		
	 		echo json_encode($respuesta);
	 	}


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
/*traer producto*/
if (isset($_POST["traerProducto"])) {
	$traerProducto = new AjaxProductos();
	$traerProducto -> traerProducto = $_POST["traerProducto"];
	$traerProducto -> ajaxEditarProducto();
}

/*selecinar producto*/

if (isset($_POST["nombreProducto"])) {
	$nombreProducto = new AjaxProductos();
	$nombreProducto -> nombreProducto = $_POST["nombreProducto"];
	$nombreProducto -> ajaxEditarProducto();
}