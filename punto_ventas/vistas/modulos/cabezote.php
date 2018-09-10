<header class="main-header">
	
	<a href="inicio" class="logo">
		
		<!-- logo mini -->
			<span class="logo-mini" >

				<img src="vistas/img/plantilla/logo.jpg" class="img-responsive" style="padding: 10px" alt="">

			</span>
		<!-- logo normal -->
			<span class="logo-lg" >
				<img src="vistas/img/plantilla/logo.jpg" class="img-responsive" style="padding: 5  px 0px" alt="">   
			</span>
	</a>

	<!--=====================================
	=            Barra de navegacion           =
	======================================-->
	<nav class="navbar navbar-static-top" role="navigation">

		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>

		<!-- perfil de usuario -->
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					 <li class="dropdown user user-menu">

					 	<a href="#" class="dropdown-toggle" data-toggle = "dropdown">

					 		<?php 
					 			if ($_SESSION["foto"] != "") {
					 				echo '<img src="'.$_SESSION["foto"].'" class="user-image" alt="">';
					 			}else {
					 				echo '<img src="vistas/img/usuarios/default/anonymous.png" class="user-image"  alt="">';
					 			}

					 		 ?>

					 		
					 		<span class="hidden-xs"><?php echo $_SESSION["nombre"]; ?></span>

					 	</a>

					<ul class="dropdown-menu">
						
						<li class="user-body">
							
							<div class="pull-right">
								
								<a href="salir" class="btn btn-default btn-flat">Salir</a>

							</div>

						</li>

					</ul>
					 </li>

				</ul>
			</div>
	</nav>
</header>