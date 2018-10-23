<div class="content-wrapper">
 <section class="content-header">
    
    <h1>
      
     Administrar empleados
    </h1>
  
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar empleados</li>
    
    </ol>

  </section>


  <section class="content">


    <div class="box">

      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddUser">
          Agregar empleado
        </button>
      </div>

      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
          
          <thead>
            <th style="width: 10px">#</th>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Foto</th>
            <th>Cargo</th>
            <th>Estado</th>
            <th>Último</th>
            <th>Acciones</th>
          </thead>

          <tbody>

            <?php 
              $item = null;
              $valor = null;

              $usuarios = ControladorUsuarios::ctrMostrarUsuario($item,$valor);

              foreach ($usuarios as $key => $value) {
                echo '<tr>
                        <td>'.($key+1).'</td>
                        <td>'.$value["nombre"].'</td>
                        <td>'.$value["usuario"].'</td>';

                        if ($value["foto"] != "") {
                          echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px alt=""></td>';
                        }else{
                           echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px alt=""></td>';
                        }
                        
                      echo'<td>'.$value["perfil"].'</td>';
                        
                        if ($value["estado"] != 0) {
                          echo ' <td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="0">Activado</button></td>';
                        }else {
                          echo ' <td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="1">Desactivado</button></td>';
                        }
                       

                       echo  '<td>'.$value["ultimo_login"].'</td>
                        <td>
                         <div class="btn-group">
                           <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["id"].'" data-toggle="modal" data-target="#modalEditUser"><i class="fa fa-pencil"></i></button>
                           <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["id"].'" fotoUsuario="'.$value["foto"].'" Usuario="'.$value["usuario"].'" ><i class="fa fa-times"></i></button>
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

<div id="modalAddUser" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post" enctype="multipart/form-data">
          <div class="modal-header" style="background: #3c8bdc; color:white;">
            <button type="button" class="close" data-dismiss="modal" >&times;</button>
            <h4 class="modal-title">Agregar empleados</h4>
          </div>

          <div class="modal-body">
            <div class="box-body">

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresa el nombre" required>
                </div>
              </div>

               <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoUsuario" id="nuevoUsuario" placeholder="Ingresa el usuario" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                  <input type="password" class="form-control input-lg" id="nuevoPassword" name="nuevoPassword" placeholder="Ingresa la contraseña" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                  <input type="password" class="form-control input-lg" id="validarNuevoPassword"  name="validarPassword" placeholder="Repite la contraseña" required>
                </div>
                <span id="error" class="alert"></span>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <select class="form-control input-lg" name="nuevoPerfil">
                    <option value="">Seleccionar perfil</option>
                    <option value="Administrador">Adminstrador</option>
                    <option value="Agente">Agente de ventas</option>
                    <option value="Contador">Contador</option>
                    <option value="Inventario">Inventario</option>
                    <option value="Vendedor">Vendedor</option>
                    
                  </select>
                </div>
              </div>


              <div class="form-group">
                <div class="panel">Subir Foto</div>

                <input type="file" class="nuevaFoto" name="nuevaFoto">
                <p class="help-block">Peso máximo de la foto 2MB</p>
                
                <img src="vistas/img/usuarios/default/anonymous.png" alt="" class="img-thumbnail previsualizar" width="100px">

              </div> 


            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left btn-salir" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary btn-val">Guardar usuario</button>
          </div>

          <?php 
          $crearUsuario = new ControladorUsuarios();
          $crearUsuario -> ctrCrearUsuario(); 
          ?>
        </form>
        

    </div>
  </div>
</div>

<!--=====================================
=            Modal edit user            =
======================================-->

<div id="modalEditUser" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post" enctype="multipart/form-data">

          <div class="modal-header" style="background: #3c8bdc; color:white;">

            <button type="button" class="close" data-dismiss="modal" >&times;</button>

            <h4 class="modal-title">Editar empleado</h4>
          </div>

          <div class="modal-body">
            <div class="box-body">

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" required>
                </div>
              </div>

               <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" readonly>
                </div>
              </div>

               <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                  <input type="password" class="form-control input-lg" id="editarPassword" name="editarPassword" placeholder="Escriba una nueva contraseña">
                  <input type="hidden" id="passwordActual" name="passwordActual" >
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                  <input type="password" class="form-control input-lg" id="validarNuevoPassword2" name="validarPassworddos" placeholder="Repite la contraseña">
                </div>
                <span id="error2" class="alert"></span>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <select class="form-control input-lg" name="editarPerfil">
                    <option value="" id="editarPerfil"></option>

                    <option value="Administrador">Adminstrador</option>
                    <option value="Agente">Agente de ventas</option>
                    <option value="Contador">Contador</option>
                    <option value="Inventario">Inventario</option>
                    <option value="Vendedor">Vendedor</option>
              
                  </select>
                </div>
              </div>


              <div class="form-group">
                <div class="panel">Subir Foto</div>

                <input type="file" class="nuevaFoto" id="editarFoto" name="editarFoto">
                <p class="help-block">Peso máximo de la foto 2MB</p>
                
                <img src="vistas/img/usuarios/default/anonymous.png" alt="" class="img-thumbnail previsualizar" width="100px">

                 <input type="hidden" name="fotoActual" id="fotoActual">

              </div> 


            </div>
          </div>

          <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left btn-salir" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary btn-validar">Modificar empleado</button>

        </div>
         <?php 

          $crearEmpleado = new ControladorUsuarios();
          $crearEmpleado -> ctrEditarUsuario();

           ?>
        </form>
    </div>
  </div>
</div>


 <?php 
 $borrarEmpleado = new ControladorUsuarios();
 $borrarEmpleado -> ctrBorrarUsuario();

 ?>