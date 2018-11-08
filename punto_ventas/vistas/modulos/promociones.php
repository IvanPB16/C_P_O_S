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
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Categoria</th>
            <th>Precio de venta</th>
            <th>Acciones</th>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px" alt=""></td>
              <td>ipsum</td>
              <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga ratione optio natus placeat quibusdam asperiores veniam, ex cupiditate reprehenderit neque laudantium sint? Magnam voluptatem obcaecati omnis, illum eum. Vel, aperiam.</td>
              <td>Lorem ipsum</td>
              <td>10.00</td>           
              <td>
                <div class="btn-goup">
                 <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                 <button class="btn btn-danger"><i class="fa fa-times"></i></button>
               </div>
              </td>
            </tr>
          </tbody>


        </table>
      </div>

    </div>

  </section>

</div>

<!--=====================================
=            Modal add user            =
======================================-->

<div id="modalAddProducto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" action="post" enctype="multipart/form-data">
          <div class="modal-header" style="background: #3c8bdc; color:white;">
            <button type="button" class="close" data-dismiss="modal" >&times;</button>
            <h4 class="modal-title">Agregar promoción</h4>
          </div>

          <div class="modal-body">
            <div class="box-body">

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-code"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoNombrePromocion" placeholder="Ingresa nombre" required>
                </div>
              </div>

               <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripción" required>
                </div>
              </div>


              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-th"></i></span>
                  <select class="form-control input-lg" name="nuevoCategoria" id="">
                    <option value="">Seleccionar categoría</option>
                    <option value="Equipo de computo">Equipo de computo</option>
                    <option value="Papeleria">Papeleria</option>
                     <option value="Jugueteria">Jugueteria</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">

               <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                    <input type="number" class="form-control input-lg" name="nuevoPrecioVenta" min="0" placeholder="Precio de venta" required>
                  </div>
                </div>
                
              <div class="form-group">
                <div class="panel">Subir imagen</div>

                <input type="file" id="nuevaFoto" name="nuevaFoto">
                <p class="help-block">Peso máximo de la imagen 2MB</p>
                
                <img src="vistas/img/productos/default/anonymous.png" alt="" class="img-thumbnail" width="100px">

              </div> 


            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary">Guardar productos</button>
          </div>
        </form>

    </div>
      
  </div>
</div>


 