<div class="row justify-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Impresoras</h4>
                <p class="card-text">Agrega o edita impresoras</p>
                <div class="row">

                    <div class="col-auto p-3 m-2">
                        <button class="btn btn-outline-primary col-auto plus"><i class="mdi mdi-plus"></i></button>
                    </div>
                    <div class="col-lg-12 p-3 m-2">
                        <input type="text" class="form-control global_filter" placeholder="Ingresa palabras clave">
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-inverse table-responsive" width="100%">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Nombre</th>
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



<div class="modal fade" id="modal_impresora" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Impresora</h5>
                <button type="button" class="btn btn-white close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="mdi mdi-window-close"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="" value="" id="id_impresora">
                    <div class="col-lg-12">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <button class="btn btn-white" disabled> <span><i class="mdi mdi-printer"></i></span></button>
                            </div>
                            <input type="text" class="form-control" id="nombre_imp" placeholder="Nombre impresora" aria-label="Ruc" aria-describedby="basic-addon2">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <button class="btn btn-white" disabled> <span><i class="mdi mdi-content-cut"></i></span></button>
                            </div>
                            <select class="form-control selectpicker border" data-live-search="true" id="corte_imp">
                                <option value="">Seleccione una opción</option>
                                <option value="0">Parcial</option>
                                <option value="1">Total</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <button type="button" class="btn btn-outline-dark col-12 save" btn-lg btn-block>Guardar Cambios</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger close col-12" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>