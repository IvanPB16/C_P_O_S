<aside class="main-sidebar">
	<section class="sidebar">
		 <ul class="sidebar-menu">
		 <?php 

		 	// if ($_SESSION["perfil"] == "Administrador") {

		 	echo '<li class="active">
		 		<a href="inicio">
		 			<i class="fa fa-home"></i>
		 			<span>Inicio</span>
		 		</a>
		 	</li>

		 	<li>
		 		<a href="usuarios">
		 			<i class="fa fa-user"></i>
		 			<span>Empleados</span>
		 		</a>
		 	</li>';
		 // }
		// if ($_SESSION["perfil"] == "Administrador" ||
		 	 // $_SESSION["perfil"] == "Inventario" ||
			 // $_SESSION["perfil"] == "Contador"){
		 	echo '<li>
		 		<a href="categorias">
		 			<i class="fa fa-th"></i>
		 			<span>Categorias</span>
		 		</a>
		 	</li>		 
		 	<li>
		 		<a href="productos">
		 			<i class="fa fa-product-hunt"></i>
		 			<span>Productos</span>
		 		</a>
		 	</li>';
		 // }
		// if ($_SESSION["perfil"] == "Administrador" ||
		 	 // $_SESSION["perfil"] == "Vendedor"){ 
		 echo '<li>
		 		<a href="clientes">
		 			<i class="fa fa-users"></i>
		 			<span>Clientes</span>
		 		</a>
		 	</li>';
		 // }
		 // if ($_SESSION["perfil"] == "Administrador" ||
		 	 // $_SESSION["perfil"] == "Inventario" ||
			 // $_SESSION["perfil"] == "Contador"){
		 echo '<li>
		 		<a href="proveedores">
		 			<i class="fa fa-handshake-o"></i>
		 			<span>Proveedores</span>
		 		</a>
		 	</li>';
		 // }

		 // if ($_SESSION["perfil"] == "Administrador" ||
		 	 // $_SESSION["perfil"] == "Vendedor" ||
			 // $_SESSION["perfil"] == "Contador" ||
			 // $_SESSION["perfil"] == "Agente"){
		 echo '<li class="treeview">
		 		<a href="#">
		 			<i class="fa fa-list-ul"></i>
		 			<span>Ventas</span>

		 			<span class="pull-right-container">
		 				<i class="fa fa-angle-left pull-right"></i>
		 			</span>
		 		</a>

		 		<ul class="treeview-menu">
		 		 	
		 		 	<li>
		 		 		<a href="ventas">
		 		 			<i class="fa fa-circle-o"></i>
		 		 			<span>Administrar ventas</span>
		 		 		</a>

		 		 	</li>
					
		 		 	<li>
		 		 		<a href="crear-venta">
		 		 			<i class="fa fa-circle-o"></i>
		 		 			<span>Crear ventas</span>
		 		 		</a>

		 		 	</li>';
		 		 // }

			// if ($_SESSION["perfil"] == "Administrador" ||
				// $_SESSION["perfil"] == "Contador"){
		 		 	echo'<li>
		 		 		<a href="reporte">
		 		 			<i class="fa fa-circle-o"></i>
		 		 			<span>Reportes de ventas</span>
		 		 		</a>

		 		 	</li>';
		 		 // }
		 echo' </ul>
		 	</li>';
		 // if ($_SESSION["perfil"] == "Administrador" ||
		 	 // $_SESSION["perfil"] == "Agente") {
		 	echo '<li>
		 		<a href="promociones">
		 			<i class="fa fa-star-o"></i>
		 			<span>Promociones</span>
		 		</a>
		 	</li>';
		 	// }
		 ?>
		 </ul>
	</section>
</aside>