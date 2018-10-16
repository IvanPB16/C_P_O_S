<div class="content-wrapper">
 
  <section class="content-header">
    
    <h1>
      
     Página de inicio
      <small>Panel de Control</small>
    
    </h1>
  
    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Tablero</li>
    
    </ol>

  </section>


  <section class="content">

    <div class="row">
      <?php 
      if ($_SESSION["perfil"] == "Administrador") {
        include "inicio/cajas_superiores.php";
      }
      ?>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <?php 
        if ($_SESSION["perfil"] == "Administrador") {
          include "reportes/grafico-ventas.php";
          }
        ?>
      </div>
      <div class="col-lg-12">
        <?php 
        if ($_SESSION["perfil"] !== "Administrador") {
          echo '<h1>Bienvenido al sistema de CompuActual '.$_SESSION["nombre"].'</h1>';
        }

        ?>
      </div>
    </div>

  </section>
</div>
