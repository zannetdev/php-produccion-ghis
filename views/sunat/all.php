<div class="row">
    <div class="col-lg-6">
        <div class="card shadow-xl">
            <img src="https://images.unsplash.com/photo-1649209979970-f01d950cc5ed?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1041&q=80" class="card-img-top" alt="Billing" style="filter: blur(5px); height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title">Ventas por facturar</h5>
                <h6 class="card-subtitle mb-2 text-muted ">Puedes facturar las ventas que has hecho.</h6>
                <div class="table-responsive">
                <table id="vent_table" class="table" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 50%;">Fecha Venta</th>
                            <th style="width: 45%;">Total Venta</th>
                            <th style="width: 5%;">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 pt-5">
        <div class="card shadow-xl">
            <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80" class="card-img-top" alt="Billing" style="filter: blur(5px); height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title">Ventas facturadas</h5>
                <h6 class="card-subtitle mb-2 text-muted ">Ventas facturadas</h6>
                <div class="table-responsive">
                    <table id="tbl_sun" class="table" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 20%;">Fecha Emisión</th>
                                <th style="width: 10%;">XML</th>
                                <th style="width: 10%;">CDR</th>
                                <th style="width: 10%;">PDF</th>
                                <th style="width: 20%;">Tipo</th>
                                <th style="width: 20%;">Estado</th>
                                <th style="width: 20%;">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal_fact" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Selecciona el tipo de documento que deseas generar</h5>
                <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="id_pago">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Tipo de Documento</label>
                            <select class="form-control selectpicker border" id="type" data-live-search="true">
                                <option value="">Seleccione el documento</option>
                                <?php
                                foreach ($this->docs as $k => $d) {
                                ?>
                                    <option value="<?php echo $d->id_documento ?>"><?php echo $d->nombre ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary send">Enviar</button>
            </div>
        </div>
    </div>
</div>