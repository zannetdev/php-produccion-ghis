<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <img class="card-img-top" src="<?php echo ASSETS ?>img/headers/modelo.jpg" alt="" style="height: 300px !important; object-fit: cover;">
            <div class="card-body">
                <h4 class="card-title">Reportes de empleado por mes</h4>
                <p class="card-text">Selecciona un empleado.</p>
                <div class="row">
                    <div class="col-12 pt-2 pb-2 mb-3">
                        <input type="text" class="form-control form-block global_filter" placeholder="Ingrese una palabra clave ">
                    </div>
                    <div class="form-group col-lg-12 m-b-40 focused">
                            <div class="input-group">
                                <input type="text" class="form-control font-14 text-center" name="start" id="start" value="01-06-2022" autocomplete="off" data-dtp="dtp_tNIu9">
                                <span class="input-group-text bg-gris">al</span>
                                <input type="text" class="form-control font-14 text-center" name="end" id="end" value="17-06-2022" autocomplete="off" data-dtp="dtp_qhBFY">
                            </div>
                            <label>Rango de fechas</label>
                        </div>
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-inverse table-responsive" width="100%">
                            <thead class="thead-inverse">
                                <tr>
                                    <th style="border-color: blue;">Nombre Empleado</th>
                                    <th style="border-color: blue;">Area</th>
                                    <th style="border-color: green;">Opciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>