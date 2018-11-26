<?php

class ControladorProveedor{

	static public function ctrAgregarProveedor(){
		if (isset($_POST["nuevoProveedor"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoProveedor"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ, ]+$/',$_POST["nuevoArticulo"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ, ]+$/', $_POST["nuevaDescripcion"]) &&
				preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) &&
				preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"])) {

				$tabla = "proveedor";

				$data = array("nombre"=>$_POST["nuevoProveedor"],
							  "producto"=>$_POST["nuevoArticulo"],
							  "descripcion"=>$_POST["nuevaDescripcion"],
							  "telefono"=>$_POST["nuevoTelefono"],
							  "correo"=>$_POST["nuevoEmail"]
							   );

				$enviar = ModeloProveedor::mdlAgregarProveedor($tabla,$data);
				if ($enviar == "ok") {
					echo '<script>
							swal({
								type:"success",
								title:"Proveedor agregado correctamente!",
								showConfirmButton: true,
								confirmButtonText:"Cerrar",
								closeOnConfirm: false
								}).then((res)=>{
									if(res.value){
										window.location = "proveedores";
									}
								});
					 		</script>';
				}
			}else{
				echo '<script>
							swal({
								type:"warning",
								title:"¡La información en algún campo es incorrecta!",
								showConfirmButton: true,
								confirmButtonText:"Cerrar",
								closeOnConfirm: false
								}).then((res)=>{
									if(res.value){
										window.location = "proveedores";
									}
								});
					 		</script>';
			}
		}
	}

	static public function ctrMostrarProveedor($item,$valor){

		$tabla = "proveedor";

		$enviar = ModeloProveedor::mdlMostrarProveedor($tabla,$item,$valor);

		return $enviar;

	}

	static public function ctrEditarProveedor(){
		if (isset($_POST["editarProveedor"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarProveedor"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ, ]+$/',$_POST["editarArticulo"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ, ]+$/', $_POST["editarDescripcion"]) &&
				preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) &&
				preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"])) {

				$tabla = "proveedor";

				$data = array("id"=>$_POST["IdProv"],
							  "nombre"=>$_POST["editarProveedor"],
							  "producto"=>$_POST["editarArticulo"],
							  "descripcion"=>$_POST["editarDescripcion"],
							  "telefono"=>$_POST["editarTelefono"],
							  "correo"=>$_POST["editarEmail"]
							   );


				$res = ModeloProveedor::mdlEditarProveedor($tabla,$data);

				if ($res == "ok") {
					echo '<script>
							swal({
								type:"success",
								title:"Proveedor editado correctamente!",
								showConfirmButton: true,
								confirmButtonText:"Cerrar",
								closeOnConfirm: false
								}).then((res)=>{
									if(res.value){
										window.location = "proveedores";
									}
								});
					 		</script>';
				}
			}else{
				echo '<script>
							swal({
								type:"warning",
								title:"¡La información en algún campo es incorrecta!",
								showConfirmButton: true,
								confirmButtonText:"Cerrar",
								closeOnConfirm: false
								}).then((res)=>{
									if(res.value){
										window.location = "proveedores";
									}
								});
					 		</script>';
			}
		}
	}

	static public function ctrEliminarProveedor(){

		if (isset($_GET["idProveedor"])) {
			
			$tabla = "proveedor";
			$data = $_GET["idProveedor"];

			$enviar = ModeloProveedor::mdlEliminarProveedor($tabla,$data);

			if ($enviar == "ok") {
				echo '<script>
						swal({
							type:"success",
							title:"Proveedor eliminado correctamente!",
							showConfirmButton: true,
							confirmButtonText:"Cerrar",
							closeOnConfirm: false
							}).then((res)=>{
								if(res.value){
									window.location = "proveedores";
								}
							});
					 </script>';
			}

		}
	}

		static public function crearOrden(){
			if (isset($_POST["idProveedor"])) {
				$tabla = "orden";

				$datos = array("idProveedor"=>$_POST["idProveedor"],
								"lista"=>$_POST["listaOrden"],
								"Total"=>$_POST["TotalOrden"]);
				$respuesta = ModeloProveedor::mdlCrearOrden($tabla,$datos);
				var_dump($respuesta);
				if ($respuesta == "ok") {
					echo '<script>
							swal({
								type:"success",
								title:"Orden creada correctamente!",
								showConfirmButton: true,
								confirmButtonText:"Cerrar",
								closeOnConfirm: false
								}).then((res)=>{
									if(res.value){
										window.location = "ordenes";
									}
								});
						 	</script>';
				}
			}
		}

		static public function ctrMostrarOrden($item,$valor){

			$tabla = "orden";

			$enviar = ModeloProveedor::mdlMostrarOrden($tabla,$item,$valor);

			return $enviar;

		}

		static public function ctrEditarOrden(){
			if (isset($_POST["editarid"])) {
				$tabla = "orden";

				$item = "id";
				$valor = $_POST["editarid"];

				$traerOrden = ModeloProveedor::mdlMostrarOrden($tabla,$item,$valor);

				if ($_POST["listaOrden"] == "") {
					$listaOrden = $traerOrden["productos"];
					$cambio = false;
				}else{
					$listaOrden = $_POST["listaOrden"];
					$cambio = true;
				}

				$datos = array("idOrden" => $_POST["editarid"],
							   "idProveedor"=>$_POST["idProveedor"],
							   "lista"=>$listaOrden,
							   "Total"=>$_POST["TotalOrden"]
							);
				$respuesta = ModeloProveedor::mdlEditarOrden($tabla,$datos);

				if ($respuesta == "ok") {
					echo '<script>
							swal({
								type:"success",
								title:"Orden actualizada correctamente!",
								showConfirmButton: true,
								confirmButtonText:"Cerrar",
								closeOnConfirm: false
								}).then((res)=>{
									if(res.value){
										window.location = "ordenes";
									}
								});
						 	</script>';
				}
			}
		}

		static public function ctrEliminarOrden(){
			if (isset($_GET["idOrden"])) {
				$tabla = "orden";

				$respuesta = ModeloProveedor::mdlEliminarOrde($tabla,$_GET["idOrden"]);
				if ($respuesta == "ok") {
					echo '<script>
						
							swal({
								type: "success",
								title:"Orden eliminada",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: true
								}).then((result)=>{
									if(result.value){
									window.location = "ordenes";
									}
								})
						  </script>';
				}



			}
		}



}

