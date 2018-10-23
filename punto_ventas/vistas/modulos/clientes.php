<div class="content-wrapper">
 
  <section class="content-header">
    
    <h1>
      
     Administrar cliente
    </h1>
  
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar clientes</li>
    
    </ol>

  </section>


  <section class="content">


    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddCliente">
          Agregar cliente
        </button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas">
          
          <thead>
            <th style="width: 10px">#</th>
            <th>Nombre</th>
            <th>ID Cleinte</th> 
            <th>RFC</th> 
            <th>Email</th>
            <th>Teléfono</th>
            <th>Acciones</th>
          </thead>
          <tbody>
            <?php 
            $item = null;
            $valor = null;

            $mostrarCliente = ControladorCliente::ctrMostrarCliente($item,$valor);
            foreach ($mostrarCliente as $key => $out) {
              echo '<tr>
                      <td>'.($key+1).'</td>
                      <td>'.$out["nombre_cliente"].'</td>
                      <td>'.$out["numero_cliente"].'</td>
                      <td>'.$out["rfc"].'</td>
                      <td>'.$out["email"].'</td>
                      <td>'.$out["telefono"].'</td>
                      <td>
                        <div class="btn-group">
                         <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modaleditCliente" idCliente="'.$out['id'].'"><i class="fa fa-pencil"></i></button>
                         <button class="btn btn-danger btnEliminarCliente" idCliente="'.$out['id'].'"><i class="fa fa-times"></i></button>
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
=            Modal add user            =
======================================-->

<div id="modalAddCliente" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post">
          <div class="modal-header" style="background: #3c8bdc; color:white;">
            <button type="button" class="close" data-dismiss="modal" >&times;</button>
            <h4 class="modal-title">Agregar Cliente</h4>
          </div>

          <div class="modal-body">
            <div class="box-body">

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresa el nombre del cliente" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input type="number" min="0" class="form-control input-lg" id="nuevoNumeroCliente" name="nuevoNumeroCliente" required readonly>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input type="text" min="0" class="form-control input-lg" name="nuevoRFC" placeholder="Ingresa el RFC" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresa el Correo electrónico" required>
                </div>
              </div>

              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>
              </div>
            </div>
            
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary">Guardar cliente</button>
          </div>

        </form>
      
        <?php 
          $crearCliente = new ControladorCliente();
          $crearCliente -> ctrAgregarCliente();
         ?>

    </div>
      
  </div>
</div>

<!--=====================================
=            Modal edit user            =
======================================-->

<div id="modaleditCliente" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post">
          <div class="modal-header" style="background: #3c8bdc; color:white;">
            <button type="button" class="close" data-dismiss="modal" >&times;</button>
            <h4 class="modal-title">Editar Cliente</h4>
          </div>

          <div class="modal-body">
            <div class="box-body">

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="editarCliente" name="editarCliente" required>
                  <input type="hidden" id="IdCliente" name="IdCliente">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input type="number" min="0" class="form-control input-lg" id="editarNumeroCliente" name="editarNumeroCliente" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input type="text" min="0" class="form-control input-lg" id="editarRFC" name="editarRFC" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="email" class="form-control input-lg" id="editarEmail" name="editarEmail" required>
                </div>
              </div>

              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                <input type="text" class="form-control input-lg" id="editarTelefono" name="editarTelefono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>
              </div>
            </div>
            
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary">Guardar cambios</button>
          </div>
          
        

        </form>
        <?php 
          $editarCliente = new ControladorCliente();
          $editarCliente -> ctrEditarCliente();
         ?>
    </div>
      
  </div>
</div>

<?php 
  $eliminarCliente = new ControladorCliente();
  $eliminarCliente -> ctrEliminarCliente();
?>         


 