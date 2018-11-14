<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
     Administrar Promociones
    </h1>
  
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Promociones</li>
    
    </ol>

  </section>


  <section class="content">


    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary promo" onclick="location.href='crear-promocion'">
          Agregar promociones
        </button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas">
          
          <thead>
            <th style="width: 10px">#</th>
            <th>Nombre de la Promocion</th>
            <th>Precio de promoción</th>
            <th>Fecha</th>
            <th>Acciones</th>
          </thead>
          <tbody>
            <?php 
            $item = null;
            $valor = null;

            $mostarPromo = ControladorPromocion::ctrMostrarPromocion($item,$valor);
            foreach ($mostarPromo as $key => $out) {
           
            
              echo '<tr>
                    <td>'.($key+1).'</td>
                    <td>'.$out["nombre_promocion"].'</td>
                    <td>'.$out["precio_promocion"].'</td>
                    <td>'.$out["fecha_inicio"].' al '.$out["fecha_fin"].' </td>
                    <td>
                    <div class="btn-group">
                      <button class="btn btn-warning btnEditPromo" idPromo='.$out["id_promocion"].'><i class="fa fa-pencil"></i></button>
                      
                       <button class="btn btn-danger btnDeletePromo" idPromo='.$out["id_promocion"].'><i class="fa fa-times"></i></button>
                     </div></td>
                  </tr>';
            }

             ?>
          </tbody>


        </table>

         <?php 
          $eliminar = new ControladorPromocion();
          $eliminar -> ctrEliminarPromo();
         ?>

       
      </div>

    </div>

  </section>

</div>




 