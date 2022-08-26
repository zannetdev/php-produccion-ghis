<div class="row">
  <div class="col-lg-3 card_catg animated flipInX">
    <div class="card ">
      <img class="card-img-top" src="<?php echo ASSETS; ?>img/headers/etiqueta-categoria.jpg" alt="">
      <div class="card-body">
        <div class="col-12 align-left">
          <h2>
            <button class="btn btn-primary" title="Agregar nuevo modelo" style="border-radius: 100px" id="btn_ctn"><i class="mdi mdi-plus"></i></button>
          </h2>
        </div>
        <h4 class="card-title">Categorias de modelos</h4>
        <p class="card-text">Modifica o desactiva categorias de modelos</p>
        <div class="list-categorias row no-gutters">

        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 card_data animated flipInX" style="display: none;">

    <div class="card text-left">

      <img class="card-img-top" src="<?php echo ASSETS; ?>img/inventario.webp">
      <div class="card-body">

        <h4 class="card-title" id="form_title"></h4>
        <p class="card-text" id="form_body"></p>
        <form>
          <input type="hidden" value="" id="id_categoria">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <input type="text" style="text-transform: uppercase;" maxlength="30" id="nombre_catg" class="form-control" placeholder="Nombre del Material" aria-describedby="help_nombre">
                <small id="help_nombre" class="text-muted">Nombre de la categoría</small>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <select id="est_mat" class="form-control selectpicker border">
                  <option value="">Seleccione una opción</option>
                  <option value="a">ACTIVO</option>
                  <option value="b">DESACTIVADO</option>
                </select>
                <small id="" class="text-muted">Estado de la categoría</small>
              </div>
            </div>
            <div class="col-12 pt-2">
              <button class="btn btn-primary col-12 save" type="button">Guardar</button>
            </div>
            <div class="col-12 pt-2">
              <button class="btn btn-danger col-12 cancel_save" type="button">Cancelar</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-9">
    <div class="card text-left">
      <div class="card-body">
      <h4 class="card-title">Modelos Registrados</h4>

        <div class="row">
          <div class="col-1 offset-10 align-left">
            <h2>
              <button class="btn btn-primary add_model" title="Agregar nueva categoría" style="border-radius: 100px"><i class="mdi mdi-plus"></i></button>
            </h2>
          </div>
          <div class="col-12 pt-2 pb-2 mb-3">
            <input type="text" class="form-control form-block global_filter" placeholder="Ingrese una palabra clave ">
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-hover table-striped" id="table" width="100%">
            <thead>
              <th style="text-align: left; width: 40%;">Imagen</th>
              <th>Fecha Creación</th>
              <th>Costo</th>
              <th>No. Modelo</th>
              <th>Estado</th>
              <th style="text-align: left; width: 5%;">Opciones</th>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>