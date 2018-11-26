<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
     Administrar proveedores
    </h1>
  
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar proveedores</li>
    
    </ol>

  </section>


  <section class="content">


    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddProveedor">
          Agregar proveedor
        </button>
        <button class="btn btn-danger pull-right" onclick="location.href='ordenes'">
          Ver Ordenes de compra
        </button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas">
          
          <thead>
            <th style="width: 10px">#</th>
            <th>Nombre de la empresa o proveedor</th>
            <th>Artículos que maneja</th> 
            <th>Descripción</th>
            <th>teléfono fijo/móvil</th>
            <th>Email</th>
            <th>Acciones</th>
          </thead>
          <tbody>
            <?php 

            $item = null;
            $valor = null;
            $verProveedor = ControladorProveedor::ctrMostrarProveedor($item,$valor);

            foreach ($verProveedor as $key => $out) {

              echo '<tr>
                <td>'.($key+1).'</td>
                <td>'.$out["nombre_proveedor"].'</td>
                <td>'.$out["producto"].'</td>
                <td>'.$out["descripcion"].'</td>
                <td>'.$out["telefono"].'</td>
                <td>'.$out["correo"].'</td>
                <td>
                  <div class="btn-group">
                  <button class="btn btn-success btnOrden"  idProveedor="'.$out["id"].'"><i class="fa fa-cube"></i></button><button class="btn btn-warning btnEditarProveedor" data-toggle="modal" data-target="#modalEditProveedor" idProveedor="'.$out["id"].'"><i class="fa fa-pencil"></i></button>
                   <button class="btn btn-danger btnEliminarProveedor" idProveedor="'.$out["id"].'"><i class="fa fa-times"></i></button>
                 </div>
                </td>
              </tr>';
               
             } 
              
            ?>
          </tbody>


        </table>
      </div>

    </div>


  </section>

</div>

<!--=====================================
=            Modal add proveedor           =
======================================-->

<div id="modalAddProveedor" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post">
          <div class="modal-header" style="background: #3c8bdc; color:white;">
            <button type="button" class="close" data-dismiss="modal" >&times;</button>
            <h4 class="modal-title">Agregar Proveedor</h4>
          </div>

          <div class="modal-body">
            <div class="box-body">

              <label>Nombre del proveedor:</label>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoProveedor" placeholder="Ingresa de la empresa o proveedor" required>
                </div>
              </div>
              <label>Productos que maneja:</label>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa  fa-tag"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoArticulo" placeholder="Ingresa el nombre de articulos" required>
                </div>
              </div>
              <label>Descripción del proveedor:</label>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa  fa-comment"></i></span>
                   <textarea class="textarea form-control input-lg" name="nuevaDescripcion" placeholder="Descripción del proveedor" style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </div>
              
              <label>Teléfono del proveedor:</label>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono"  data-inputmask="'mask':'(999) 999-9999'" data-mask required>
                </div>
              </div>
              
              <label>Email:</label>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresa el Correo electrónico" required>
                </div>
              </div>

            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary">Guardar proveedor</button>
          </div>
        </form>

        <?php 
          $agregarProveedor = new ControladorProveedor();
          $agregarProveedor -> ctrAgregarProveedor();
         ?>

    </div>
      
  </div>
</div>

<!--=====================================
=            Modal edit user            =
======================================-->

<div id="modalEditProveedor" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post">

          <div class="modal-header" style="background: #3c8bdc; color:white;">
            <button type="button" class="close" data-dismiss="modal" >&times;</button>
            <h4 class="modal-title">Editar Proveedor</h4>
          </div>

          <div class="modal-body">
            <div class="box-body">

              <label>Nombre del proveedor:</label>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="editarProveedor" name="editarProveedor"  required>
                  <input type="hidden" id="IdProv" name="IdProv">
                </div>
              </div>
              <label>Productos que maneja:</label>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa  fa-tag"></i></span>
                  <input type="text"class="form-control input-lg" id="editarArticulo" name="editarArticulo" required>
                </div>
              </div>

              <label>Descripción del proveedor:</label>
               <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa  fa-comment"></i></span>
                   <textarea class="textarea form-control input-lg" id="editarDescripcion" name="editarDescripcion" style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </div>
              <label>Teléfono del proveedor:</label>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control input-lg" id="editarTelefono" name="editarTelefono"  data-inputmask="'mask':'(999) 999-9999'" data-mask required>
                </div>
              </div>

              <label>Email:</label>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="email" class="form-control input-lg" id="editarEmail" name="editarEmail" required>
                </div>
              </div>

            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary">Guardar proveedor</button>
          </div>
        </form>

        <?php 
        $editarProv = new ControladorProveedor();
        $editarProv -> ctrEditarProveedor();
         ?>

    </div>
      
  </div>
</div>
 <?php 
  $eliminarProveedor = new ControladorProveedor();
  $eliminarProveedor -> ctrEliminarProveedor();

  ?>