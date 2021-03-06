 <div class="content-wrapper">
 
  <section class="content-header">
    
    <h1>
      
     Administrar SubCategorias
    </h1>
  
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar SubCategorias</li>
    
    </ol>

  </section>


  <section class="content">


    <div class="box">
      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddSubCategorias">
          Agregar subcategorias
        </button>
      </div>
      <div class="box-body">
    
        <?php 
          $item = null;
          $valor = null;

          $categoria = ControladorCategorias::ctrMostrarCategorias($item,$valor);

          foreach ($categoria as $key => $value) {
             echo '<ul class="list-group list-group-flush">
                   <li class="list-group-item">'.$value["nombre"].'</li>';

                $item = null;
                $valor = $value["id"];
                $sub = ControladorSubCategorias::ctrMostrarSubCategorias($item,$valor);
                  foreach ($sub as $key => $out) {
                    echo '<ul class="todo-list">
                            <li><span class="handle">
                                <i class="fa fa-ellipsis-v"></i>
                                <i class="fa fa-ellipsis-v"></i>
                              </span><span class="text">'.$out["nombre"].'</span>
                              <input id="ayuda" type="hidden" value="'.$out["nombre"].'">
                             <div class="tools">

                                <div class="btn-group">
                                  <button class="btn btn-warning btnEditarSub" idsc="'.$out["id"].'" nombre="'.$out["nombre"].'"><i class="fa fa-edit"></i></button>
                                
                                  <button class="btn btn-warning btnEliminarSub" idSub="'.$out["id"].'"><i class="fa fa-trash-o"></i></button>
                                </div>
                              </div>
                            </li>
                          </ul>';
                  }
             echo '</ul>';
           } 
         ?>
      </div>

    </div>

  </section>

</div>

<!--=====================================
=            Modal add subcategorias           =
======================================-->

<div id="modalAddSubCategorias" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post">
          <div class="modal-header" style="background: #3c8bdc; color:white;">
            <button type="button" class="close" data-dismiss="modal" >&times;</button>
            <h4 class="modal-title">Agregar Subcategoría</h4>
          </div>

          <div class="modal-body">
            <div class="box-body">
              <label>Categoría:</label>
              <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                    <select class="form-control input-lg"  name="nuevoAgregarSubCategoria" id="nuevoAgregarSubCategoria">
                    <option value="">Seleccione una categoría</option>

                      <?php 

                      $item = null;
                      $valor = null;

                      $mostrarCategorias = ControladorCategorias::ctrMostrarCategorias($item,$valor);
                      foreach ($mostrarCategorias as $key => $value) {
                        echo '<option value="'.$value["id"].'" >'.$value["nombre"].'</option>';
                      }

                      ?>
                    </select>
                  </div>
              </div>
              <label>Nombre de la subcategoría:</label>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-th"></i></span>

                  <input type="text" class="form-control input-lg" id="nuevaSubCategoria" name="nuevaSubCategoria" placeholder="Ingresa el Categoria" required>

                </div>
              </div>

            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary">Guardar subcategorias</button>
          </div>

          <?php 
            $agregarsubcategoria = new ControladorSubCategorias();
            $agregarsubcategoria -> ctrSubAgregarCategoria();
          ?>
        </form>

    </div>
      
  </div>
</div>

<!--=====================================
=            Modal edit subcategorias       =
======================================-->

<div id="modalEditSubCategorias" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post">
          <div class="modal-header" style="background: #3c8bdc; color:white;">
            <button type="button" class="close" data-dismiss="modal" >&times;</button>
            <h4 class="modal-title">Editar Subcategoría</h4>
          </div>

          <div class="modal-body">
            <div class="box-body">
              <label>Nombre de la subcategoría:</label>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-th"></i></span>
              
                  <input type="text" class="form-control input-lg" id="editarSubCategoria" name="editarSubCategoria" required>
                  <input type="hidden" class="form-control input-lg" id="nuevoValor" name="nuevoValor" value="" required>
                  <input type="hidden" class="form-control input-lg" id="idsc" name="editarids" required>
                </div>
              </div>


            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary" id="enviar">Guardar cambios</button>
          </div>

           <?php 
          $editarCategoria = new ControladorSubCategorias();
          $editarCategoria -> ctrEditarSub();
           ?>
        </form>

    </div>
      
  </div>
</div>

<?php 
  $borrarsubCategoria = new ControladorSubCategorias();
  $borrarsubCategoria -> ctrBorrarSub();
?>
 