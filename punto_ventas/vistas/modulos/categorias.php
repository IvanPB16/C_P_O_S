<div class="content-wrapper">
 
  <section class="content-header">
    
    <h1>
      
     Administrar Categorias
    </h1>
  
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Categorias</li>
    
    </ol>

  </section>


  <section class="content">


    <div class="box">
      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddCategorias">
          Agregar categorias
        </button>

           <button class="btn btn-danger pull-right" onclick="location.href='subcategorias'">
          Ver Subcategorias
        </button>
      </div>


      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
          
          <thead>
            <th style="width: 10px">#</th>
            <th>Categoria</th>
            <th>Acciones</th>  
          </thead>
          <tbody>
            <?php  
              $item = null;
              $valor = null;
            $categorias = ControladorCategorias::ctrMostrarCategorias($item,$valor);
            foreach ($categorias as $key => $value) {
              echo '<tr>
                    <td>'.($key+1).'</td>
                    <td class="text-uppercase">'.$value["nombre"].'</td>
                    <td>
                      <div class="btn-group">
                      <button class="btn btn-warning btnEditarCategoria" idCategoria="'.$value['id'].'" data-toggle="modal" data-target="#modalEditCategorias"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnBorrarCategoria" idCategoria="'.$value['id'].'"><i class="fa fa-times"></i></button>
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
=            Modal add categorias           =
======================================-->

<div id="modalAddCategorias" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post">
          <div class="modal-header" style="background: #3c8bdc; color:white;">
            <button type="button" class="close" data-dismiss="modal" >&times;</button>
            <h4 class="modal-title">Agregar Categoría</h4>
          </div>

          <div class="modal-body">
            <div class="box-body">

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-th"></i></span>

                  <input type="text" class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" placeholder="Ingresa el Categoria" required>

                </div>
              </div>


            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary">Guardar categorias</button>
          </div>

          <?php 
          $agregarCategoria = new ControladorCategorias();
          $agregarCategoria -> ctrAgregarCategoria();

           ?>
        </form>

    </div>
      
  </div>
</div>

<!--=====================================
=            Modal edit categorias       =
======================================-->

<div id="modalEditCategorias" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post">
          <div class="modal-header" style="background: #3c8bdc; color:white;">
            <button type="button" class="close" data-dismiss="modal" >&times;</button>
            <h4 class="modal-title">Editar Categoría</h4>
          </div>

          <div class="modal-body">
            <div class="box-body">

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-th"></i></span>

                  <input type="text" class="form-control input-lg" name="editarCategoria" id="editarCategoria" placeholder="Ingresa la Categoria" required>

                  <input type="hidden" name="idCategoria" id="idCategoria" required>

                </div>
              </div>


            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary">Guardar cambios</button>
          </div>

          <?php 
          $editarCategoria = new ControladorCategorias();
          $editarCategoria -> ctrEditarCategoria();
           ?>
        </form>

    </div>
      
  </div>
</div>

 <?php 
   $borrarCategoria = new ControladorCategorias();
   $borrarCategoria -> ctrBorrarCategoria();
 ?>
 