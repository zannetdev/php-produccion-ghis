<?php
$data = $this->data;
$data =  ($data);
?>
<input type="hidden" id="modelo_seleccionado">
<input type="hidden" id="color" value="<?php echo $data->color; ?>">
<input type="hidden" id="observaciones" value="<?php echo $data->observaciones; ?>">
<input type="hidden" id="precio_modelo" value="">

<input type="hidden" id="nombre_cliente_1" value="">
<input type="hidden" id="id_cliente_1" value="<?php echo $data->cliente1; ?>">
<input type="hidden" id="igv" value="<?php echo $_SESSION['empresa']->igv ?>">
<div class="row">
    <div class="col-lg-7 scroll">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">1) Selecciona un modelo</h4>
                <p class="card-text">Selecciona un modelo para finalizar el pedido. </p>
                <div class="row">
                    <?php foreach ($this->modelos as $k => $d) : ?>
                        <div class="col-md-3 col-lg-3 col-sm-3 col-xs-4 mb-3">
                            <div class="card h-100 modelo_item" id="modelo_item_<?php echo $d->id_modelo; ?>" data-id_modelo="<?php echo $d->id_modelo; ?>" data-precio="<?php echo number_format($d->precio, 2); ?>">
                                <img class="card-img-top" src="<?php echo $d->imagen ?>" alt="Modelo #<?php echo $d->cod_diseño ?>">
                                <div class="card-body">
                                    <h5 class="card-title">S/. <?php echo number_format($d->precio, 2); ?></h5>
                                    <p class="card-text">
                                        <?php echo $d->cod_diseño; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5 pt-4">
        <div class="card" style="background-color: #f5f5f5">
            <div class="card-body">
                <h4 class="card-title">Detalles del pedido</h4>
                <p class="card-text">Ingrese al menos una talla para poder crear el pedido</p>
                <div class="alert alert-success" role="alert">
                    <strong>Rellena todoss los campos necesarios</strong>
                </div>
                <div class="row">


                    <div class="col-12 row">

                        <button class="btn btn-outline-secondary col-12 m-3 offset-1 tallas" style="height: fit-content;"> <i class="mdi mdi-arrow-right"></i> Tallas</button>
                    </div>
                    <div class="">
                        <label class="text-muted">Método de pago</label>
                        <div class="alert alert-info" role="alert">
                            <strong> Ingrese los datos del método de pago, para poder completar el pedido y ponerlo en cola de producción.
                            </strong>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pago_metodo" id="metodo_pago_efectivo" value="1">
                            <label class="form-check-label" for="metodo_pago_efectivo">
                                Efectivo
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pago_metodo" id="metodo_pago_credito" value="2">
                            <label class="form-check-label" for="metodo_pago_credito">
                                Tarjeta de crédito
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pago_metodo" id="metodo_pago_debito" value="3">
                            <label class="form-check-label" for="metodo_pago_debito">
                                Tarjeta de débito
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pago_metodo" id="metodo_credito" value="5">
                            <label class="form-check-label" for="metodo_pago_debito">
                                A crédito
                            </label>
                        </div>
                    </div>

                    <div class="dropdown-divider mt-2 mb-2"></div>
                    <label class="text-muted text-center">Enviar a la Sunat?</label>
                    <div class="alert alert-dark" role="alert">
                        <strong>¿Deseas enviar este pedido a la sunat?</strong>
                    </div>
                    <div class="col-12">
                       
                        <select id="send_sun" class="form-control selectpicker border" data-live-search="true">
                            <option value="1">Si</option>
                            <option value="0">No</option>

                        </select>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="">
                        <label class="text-muted">Sin pago</label>
                        <div class="alert alert-warning" role="alert">
                            <strong> Seleccione la siguiente opción en caso de que no sea necesario crear un pago.
                            </strong>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pago_metodo" id="sin_pago" value="4">
                            <label class="form-check-label" for="sin_pago">
                                Creación de pedido sin pago.
                            </label>
                            <small><br>*(Usa esta opción en caso de que el pedido solo sea sin pago.)</small>
                        </div>
                    </div>
                    <div class="form-group pt-1 total_compra">
                        <small for="pago_monto">IGV Total</small>
                        <div class="input-group mb-1">
                            <span class="input-group-text" id="basic-addon1">S/.</span>
                            <input type="text" class="form-control" placeholder="Monto IGV" aria-label="Pago" aria-describedby="basic-addon1" id="igv_total" readonly>
                        </div>
                    </div>
                    <div class="form-group pt-1 total_compra">
                        <small for="pago_monto">Subtotal</small>
                        <div class="input-group mb-1">
                            <span class="input-group-text" id="basic-addon1">S/.</span>
                            <input type="text" class="form-control" placeholder="Subtotal Sin IGV" aria-label="Pago" aria-describedby="basic-addon1" id="subtotal" readonly>
                        </div>
                    </div>

                    <div class="form-group pt-1 total_compra">
                        <small for="pago_monto">Total Compra</small>
                        <div class="input-group mb-1">
                            <span class="input-group-text" id="basic-addon1">S/.</span>
                            <input type="text" class="form-control" placeholder="Total Compra" aria-label="Pago" aria-describedby="basic-addon1" id="total_compra" readonly>
                        </div>
                    </div>

                    <div class="form-group pt-2 efe_frm" style="display: none;">
                        <small for="pago_monto">Ingrese el monto que fue recibido</small>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">S/.</span>
                            <input type="text" class="form-control" placeholder="Monto recibido" aria-label="Pago" aria-describedby="basic-addon1" id="pago_monto">
                        </div>
                    </div>
                    <div class="row efe_frm" style="display: none;">
                        <div class="col-auto pt-2"><button class="btn btn-outline-primary col-12 money-shortcut" data-monto='0.00' id="btn1">0.00</button></div>
                        <div class="col-auto pt-2"><button class="btn btn-outline-primary col-12 money-shortcut" data-monto='10.00' id="btn2">10.00</button></div>
                        <div class="col-auto pt-2"><button class="btn btn-outline-primary col-12 money-shortcut" data-monto='20.00' id="btn3">20.00</button></div>
                        <div class="col-auto pt-2"><button class="btn btn-outline-primary col-12 money-shortcut" data-monto='50.00' id="btn4">50.00</button></div>
                        <div class="col-auto pt-2"><button class="btn btn-outline-primary col-12 money-shortcut" data-monto='100.00' id="btn5">100.00</button></div>
                        <div class="col-auto pt-2"><button class="btn btn-outline-primary col-12 money-shortcut" data-monto='200.00' id="btn6">200.00</button></div>
                    </div>
                    <div class="form-group pt-2 efe_frm" style="display: none;">
                        <small for="pago_monto">Devuelto</small>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">S/.</span>
                            <input type="text" class="form-control" placeholder="Devuelto" aria-label="Devuelto" aria-describedby="basic-addon1" id="vuelto" readonly>
                        </div>
                    </div>
                    <div class="form-group pt-2 efe_tar" style="display: none;">
                        <small for="pago_monto">Número de baucher</small>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-credit-card-outline"></i></span>
                            <input type="text" class="form-control" placeholder="**** ****" aria-label="Pago" aria-describedby="basic-addon1" id="baucher">
                        </div>
                    </div>
                    <div class="col-lg-12 pt-4">
                        <button class="btn btn-outline-dark col-12 rounded make_process">
                            Hacer pedido
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="tabla_tallas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tabla de tallas</h5>
                <button type="button" class="btn btn-white close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="mdi mdi-close-box md-24"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="">
                    <div class="row">
                        <div class="col-auto">
                            <button class="btn btn-outline-primary col-12 more_talla"><i class="mdi mdi-plus"></i></button>
                        </div>
                    </div>
                    <table class="table table-striped table-inverse">
                        <thead class="thead-inverse" style="width: 100%;">
                            <tr>
                                <th>Talla</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody id="tallas">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_nueva" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Nueva talla</h5>
                <button type="button" class="btn btn-white second_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="mdi mdi-close-box md-24"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="">Talla</label>
                        <input type="text" class="form-control" name="" id="talla" maxlength="5" aria-describedby="helpId" placeholder="Ingrese la talla">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="">Cantidad</label>
                        <input type="text" class="form-control" name="" id="cantidad" maxlength="5" aria-describedby="helpId" placeholder="Ingrese la talla">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary second_close" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary save_talla">Guardar</button>
            </div>
        </div>
    </div>
</div>