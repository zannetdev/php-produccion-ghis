<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Mis pedidos</h4>
        <p class="card-text">Listamos los pedidos que has hecho.</p>
        <p>

        </p>
        <div class="col-12 pt-2 pb-2 mb-3">
          <input type="text" class="form-control form-block global_filter" placeholder="Ingrese una palabra clave ">
        </div>
        <div class="table-responsive">
          <table id="table" class="table table-striped table-inverse table-responsive" width="100%">
            <thead class="thead-inverse">
              <tr>
                <th>Fecha Solicitud</th>
                <th>Faltante</th>
                <th>Total</th>
                <th>Estado Pago</th>
                <th>Estado Solicitud</th>
                <th>Opciones</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="modal_imagen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Subir Fotografía de pago</h5>
        <button type="button" class="close btn btn-white" data-dismiss="modal" aria-label="Close">
          <i class="mdi mdi-window-close"></i>
        </button>
      </div>
      <input type="hidden" id="id_pedido" value="">
      <input type="hidden" id="id_tmp" value="">
      <div class="modal-body">
        <div class="form-group mt-2 pt-2 mt-4">
          <label>Comprobante de pago</label>&nbsp;&nbsp;
          <form action="<?php echo URL ?>service/sube_comprobante" class="dropzone" id="my-dropzone"></form>
          <button class="btn btn-outline-primary col-12 mt-4 save">Subir imagen</button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger col-12 close" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>