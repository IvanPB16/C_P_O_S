<div class="content-wrapper">
 
  <section class="content-header">
    
    <h1>
      
     Promociones
      <small>Panel de Control</small>
    
    </h1>
  
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
      
      <li class="active">crear promociones</li>
    
    </ol>

  </section>

  <section class="content">
    <div class="box">
       <div class="box-header with-border">
         <h1 class="box-title">Crear promociones</h1>
       </div>
    </div>
    
  <form role="form" action="post" id="ayuda">
      <div class="box box-success">
       <div class="box-header with-border">
          <h1 class="box-title"></h1>
           <button type="submit" class="btn btn-primary">Guardar promoción</button>
        </div>
       <div class="box-body">
          <div class="row">
            <div class="col-xs-6">
              <label>Nombre de promoción</label>
                <input type="text" class="form-control" name="nombre_promo" placeholder="Ej. Lista escolar">   
            </div>
            <div class="col-xs-4">
              <label>Precio de promoción</label>
                <input type="number" class="form-control" name="precio_descuento" step="any" placeholder="$20.00">
            </div>
            <div class="col-xs-2">
              <div class="form-group">
                  <label>Fecha:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                   <input type="text" class="form-control pull-right" id="reservation" name="daterange"/>
                  <!--  <input type="text" class="form-control pull-right" id="reservation"> -->
                  </div>
                </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-lg-5 hidden-md hidden-sm hidden-xs">
        <div class="box">        
          <div class="box-header with-border">
           <div class="Productos"></div>
         </div>
       </div>
      </div>
  </form>
    <div class="row">
      <div class="col-lg-7 hidden-md hidden-sm hidden-xs center">
            <div class="box box-warning ">
              <div class="box-header">
                <div class="box-body">
                  <table class="table table-bordered table-striped dt-responsive dtPromocion">
                      <thead>
                        <tr>
                          <th style="width: 10px">Código</th>
                          <th>Descripción</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody style="cursor: pointer;" id="dtpp">
                        
                      </tbody >
                  </table>
                </div>
              </div> 
          </div>
        </div>

    </div>

  </section>
</div>
