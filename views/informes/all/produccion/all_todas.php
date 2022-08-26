<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <img class="card-img-top" src="<?php echo ASSETS ?>img/headers/pedidos.jpg" alt="" style="height: 300px !important; object-fit: cover;">
            <div class="card-body">
                <h4 class="card-title">Informes de Producción</h4>
                <p class="card-text">Lista los procesos que están activos y terminados.</p>
                <div class="col-12 pt-2 pb-2 mb-3">
                    <input type="text" class="form-control form-block global_filter" placeholder="Ingrese una palabra clave ">
                </div>
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-inverse table-responsive" width="100%">
                        <thead class="thead-inverse">
                            <tr>
                                <th style="border-color: blue;"># Modelo</th>
                                <th style="border-color: green;">Fecha Inicio</th>
                                <th style="border-color: green;">Fecha Fin</th>
                                <th style="border-color: green;">Cliente</th>
                                <th style="border-color: green;">Total</th>
                                <th style="border-color: green;">Tipo pago</th>
                                <th style="border-color: green;">Estado</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>