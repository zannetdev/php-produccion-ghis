<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <img class="card-img-top" src="<?php echo ASSETS ?>img/headers/creditos.jpg" style="max-height: 400px; object-fit: cover;" alt="">
            <div class="card-body">
                <h4 class="card-title">Créditos</h4>
                <p class="card-text">Listamos todos los créditos y si requieres registrar un pago al pedido</p>
                <div class="col-12 pt-2 pb-2 mb-3">
                    <input type="text" class="form-control form-block global_filter" placeholder="Ingrese una palabra clave ">
                </div>
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-inverse table-responsive" width="100%">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Fecha Solicitud</th>
                                <th>Pendiente</th>
                                <th>Total</th>
                                <th>Detalle Pedido</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_abono" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Abonar a crédito</h5>
                <button type="button" class="close btn btn-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="mdi mdi-window-close"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_credito" value="">
                <input type="hidden" id="max" value="">

                <div class="form-group">
                    <label for="monto_abono" class="col-form-label">Monto a abonar:</label>
                    <input type="text" class="form-control" id="monto_abono" placeholder="Monto a abonar">
                </div>
                <div class="col-12 pt-3">
                    <button type="button" class="btn btn-outline-success col-12 save" data-dismiss="modal">Aceptar</button>
                </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger col-12 close" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>