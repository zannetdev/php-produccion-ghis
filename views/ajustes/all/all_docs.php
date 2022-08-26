<div class="row justify-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Documentos de la fácturación electronica.</h4>
                <div class="alert alert-warning" role="alert">
                    <strong>Modifique los documentos, con los cuales trabaja la facturación electronica.</strong>
                </div>
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-inverse table-responsive" width="100%">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Nombre</th>
                                <th>Serie</th>
                                <th>Número</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal_doc" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Documento</h5>
                    <button type="button" class="btn" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-secondary" role="alert">
                    <strong>Ten en cuenta que si los datos no son correctos, va  a fallar el proceso de facturación.</strong>
                </div>
                <input type="hidden" id="id_doc">
                <div class="form-group">
                  <label for="nombre_doc">Nombre</label>
                  <input type="text" class="form-control" id="nombre_doc" aria-describedby="nombre_help" placeholder="Nombre del Documento">
                  <small id="nombre_help" class="form-text text-muted">Nombre del Documento el cual será visualizado en la compra.</small>
                </div>
                <div class="form-group">
                  <label for="serie_doc">Serie</label>
                  <input type="text" class="form-control" id="serie_doc" aria-describedby="serie_help" placeholder="Nombre del Documento">
                  <small id="serie_help" class="form-text text-muted">Serie del documento a emitir.</small>
                </div>
                <div class="form-group">
                  <label for="num_doc">Número</label>
                  <input type="text" class="form-control" id="num_doc" aria-describedby="num_help" placeholder="Nombre del Documento">
                  <small id="num_help" class="form-text text-muted">Número de documento a emitir.</small>
                </div>
                <div class="form-group">
                <label for="num_doc">Estado</label>
                  <select id="st_doc" class="selectpicker border form-control" data-live-search="true">
                    <option value="a">Activo</option>
                    <option value="b">Inactivo</option>
                  </select>
                  <small id="st_help" class="form-text text-muted">Estado del documento.</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary save">Guardar</button>
            </div>
        </div>
    </div>
</div>