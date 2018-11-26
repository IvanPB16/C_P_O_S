<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
     Ordenes de compra
    </h1>
  
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar ordenes de compra</li>
    
    </ol>

  </section>


  <section class="content">


    <div class="box">
      <div class="box-header with-border">
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas">
          
          <thead>
            <th style="width: 10px">#</th>
            <th>Nombre del proveedor</th>
            <th>Fecha</th> 
            <th>Acciones</th>
          </thead>
          <tbody>
            <?php 

            $item = null;
            $valor = null;
            $verOrden = ControladorProveedor::ctrMostrarOrden($item,$valor);

            foreach ($verOrden as $key => $out) {
              $itemProve = "id";
              $valorProve = $out["id_proveedor"];
              $respuestaProveedor = ControladorProveedor::ctrMostrarProveedor($itemProve,$valorProve);

              echo '<tr>
                <td>'.($key+1).'</td>
                <td>'.$respuestaProveedor["nombre_proveedor"].'</td>
                <td>'.$out["fecha"].'</td>
                <td>
                  <div class="btn-group">
                  <button class="btn btn-success btnImprimirOrden"  idOrden="'.$out["id"].'"><i class="fa fa-print"></i></button>

                  <button class="btn btn-warning btnEditarOrden" idOrden="'.$out["id"].'"><i class="fa fa-pencil"></i></button>
                   
                   <button class="btn btn-danger btnEliminarOrden" idOrden="'.$out["id"].'"><i class="fa fa-times"></i></button>
                 </div>
                </td>
              </tr>';
               
             } 
              
            ?>
          </tbody>


        </table>

        <?php 
          $eliminar = new ControladorProveedor();
          $eliminar -> ctrEliminarOrden();

         ?>
      </div>

    </div>


  </section>

</div>
