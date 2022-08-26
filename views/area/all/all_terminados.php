<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <img class="card-img-top" src="<?php echo ASSETS ?>img/headers/header-bg.png" style="max-height: 200px; object-fit: cover;" alt="">
            <div class="card-body">
                <h4 class="card-title">Procesos terminados</h4>
                <p class="card-text">Listamos procesos que has terminado.</p>
                <div class="col-12 pt-2 pb-2 mb-3">
                    <input type="text" class="form-control form-block global_filter" placeholder="Ingrese una palabra clave ">
                </div>
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-inverse table-responsive" width="100%">
                        <thead class="thead-inverse">
                            <tr>
                                <th># Pedido</th>
                                <th>Fecha Solicitud</th>
                                <th>Fecha Fin</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_imprimir" tabindex="-1" role="document">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Selecciona una impresora</h5>
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">
                    <span aria-hidden="true"><i class="mdi mdi-window-close"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" id="id_detalle_proceso">
                <div class="row">
                    <div class="col-lg-12">
                        <select name="" id="name_imp" class="form-control selectpicker border" data-live-search="true">
                            <option value="">Seleccione una impresora</option>
                            <?php
                            foreach ($this->impresoras as $k => $d) {
                            ?>
                                <option value="<?php echo $d->nombre_impresora; ?>"><?php echo $d->nombre_impresora; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer row">
                <button type="button" class="btn btn-outline-dark col-12 pt-2 print"><i class="mdi mdi-printer"> Imprimir</i></button>
                <button type="button" class="btn btn-outline-danger pb-2 col-12" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>