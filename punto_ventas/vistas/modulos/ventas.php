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
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas">
          
          <thead>
            <th style="width: 10px">#</th>
            <th>Código</th>
            <th>Vendedor</th>
            <th>Forma de pago</th>
            <th>Neto</th>
            <th>Total</th>
            <th>Fecha</th>
             <th>Acciones</th>
          </thead>
          <tbody>
            <?php 

            $item = null;
            $valor = null;
            $obtener = ControladorVentas::ctrMostrarVentas($item,$valor);

            foreach ($obtener as $key => $value) {
            echo '<tr>
                    <td>'.($key+1).'</td>
                    <td>'.$value["codigo_venta"].'</td>';

            $itemUsuario = "id";
            $valorUsuario = $value["id_vendedor"];

            $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuario($itemUsuario,$valorUsuario);
            echo '<td>'.$respuestaUsuario["nombre"].'</td>';

            echo '<td>'.$value["metodo_pago"].'</td>
                    <td>$'.number_format($value["subtotal"],2).'</td>
                    <td>$'.number_format($value["total"],2).'</td>
                    <td>'.$value["fecha"].'</td>
                    <td>
                      <div class="btn-goup">
                       <button class="btn btn-success"><i class="fa fa-print"></i></button>

                      <a href="index.php?ruta=editar-venta&idVenta='.$value["id"].'"><button class="btn btn-warning btnEditarVenta"><i class="fa fa-pencil"></i></button></a>
                      
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

