<input type="hidden" id="date" value="<?php echo date('Y-m')?>">
<div class="row">
    <div class="col-lg-12">
        <div class="row justify-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Informes del sistema</h4>
                        <h6 class="card-subtitle text-muted">Imprime los informes del sistema, ya sea ventas, verifica que créditos están pendientes por pagar, verifica los procesos, cuales procesos tomaron los empleados, etc.</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row offset-lg-1 pt-4">
    <div class="col-lg-5 mt-3">
        <div class="card">
        <img class="card-img-top" src="<?php echo ASSETS?>img/headers/header.jpg" alt="">
            <div class="card-body">
                <div class="list-group">
                    <a href="javascript:void(0)" class="list-group-item list-group-item-action flex-column align-items-start list_option b" id="finanzas">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Finanzas</h5>
                        </div>
                    </a>
                    <a href="javascript:void(0)" class="list-group-item list-group-item-action flex-column align-items-start list_option b" id="produccion">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Producción</h5>
                        </div>
                    </a>
                    <a href="javascript:void(0)" class="list-group-item list-group-item-action flex-column align-items-start list_option b" id="reportes">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Reportes</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5 mt-3">
        <div class="card animated flipInX">

            <img class="card-img-top" src="<?php echo ASSETS?>img/headers/report-design-header.png" alt="">

            <div class="card-body">
                <div class="opts">
                    <?php echo mdi_messaje('mdi-alert', 'Selecciona una opción para poder desplegar las opciones disponibles'); ?>

                </div>
            </div>
        </div>
    </div>
</div>