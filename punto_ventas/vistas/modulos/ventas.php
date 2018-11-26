<div class="content-wrapper">
 
  <section class="content-header">
    
    <h1>
      
     Administrar Ventas
    </h1>
  
    <ol class="breadcrumb"> 
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Ventas</li>
    
    </ol>

  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
          <a href="crear-venta">
            <button class="btn btn-primary">
              Agregar venta
            </button>
          </a>

          <button type="button" class="btn btn-default pull-right" id="daterange-btn">
            <span><i class="fa fa-calendar"></i>Rango de fecha</span>

            <i class="fa fa-caret-down"></i>
          </button>
 
      </div>
    

      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas">
          
          <thead>
            <th>Código</th>
            <th>Vendedor</th>
            <th>Cliente</th>
            <th>Forma de pago</th>
            <th>Neto</th>
            <th>Total</th>
            <th>Fecha</th>
            <th>Acciones</th>
          </thead>
          <tbody>
            <?php

            if (isset($_GET["fechaInicial"])) {
              $fechaInicial = $_GET["fechaInicial"];
              $fechaFinal = $_GET["fechaFinal"];
            }else{
              $fechaInicial = null;
              $fechaFinal = null;
            }

            $obtener = ControladorVentas::ctrRangoFechaVentas($fechaInicial,$fechaFinal);

            foreach ($obtener as $key => $value) {
            echo '<tr>
                    <td>'.$value["codigo_venta"].'</td>';

            $itemUsuario = "id";
            $valorUsuario = $value["id_vendedor"];

            $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuario($itemUsuario,$valorUsuario);
            echo '<td>'.$respuestaUsuario["nombre"].'</td>';

            $itemCliente = "id";
            $valorCliente = $value["id_cliente"];

            $respuestaCliente = ControladorCliente::ctrMostrarCliente($itemCliente,$valorCliente);
             echo '<td>'.$respuestaCliente["nombre_cliente"].'</td>';
              echo '<td>'.$value["metodo_pago"].'</td>
                   <td>$'.number_format($value["subtotal"],2).'</td>
                    <td>$'.number_format($value["total"],2).'</td>
                    <td>'.$value["fecha"].'</td>
                    <td>
                      <div class="btn-group">
                       <button class="btn btn-success btnImprimirFactura" codigoVenta="'.$value["codigo_venta"].'"><i class="fa fa-print"></i></button>

                      <button class="btn btn-warning btnEditarVenta" idVenta='.$value["id"].'><i class="fa fa-pencil"></i></button>
                      
                       <button class="btn btn-danger btnEliminarVenta" idVenta='.$value["id"].'><i class="fa fa-times"></i></button>
                     </div>
                    </td>
                   
                  </tr>';

            }
             ?>
          </tbody>

        </table>

        <?php 
          $eliminar = new ControladorVentas();
          $eliminar -> ctrEliminarVenta();
        ?>
      </div>

    </div>

  </section>

</div>

