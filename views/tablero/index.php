<div class="row">
  <?php 
    if($this->data){
        ?>
          <div class="col-lg-8 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Bienvenido de nuevo <?php echo $_SESSION['usuario']->nombre;; ?>🎉</h5>
                        <p class="mb-4">
                            Nos alegramos de tenerte de nuevo aquí<br><span class="fw-bold">La frase del día de hoy </span>
                        <p id="frase"></p>
                        </p>

                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img src="<?php echo ASSETS; ?>img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
        <div class="row">
            <div class="col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="<?php echo ASSETS; ?>img/icons/unicons/account.png" alt="" class="rounded" />
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                    <a class="dropdown-item" href="<?php echo URL; ?>usuario/empleados">Ver más</a>
                                </div>
                            </div>
                        </div>
                        <span class="d-block mb-1">Usuarios</span>
                        <h3 class="card-title text-nowrap mb-2"><?php echo $this->data->usuarios_registrados->cantidad_usuarios; ?></h3>
                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> <?php random_percent() ?></small>
                    </div>
                </div>
            </div>
            <div class="col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="<?php echo ASSETS; ?>img/icons/unicons/client.gif" alt="" class="rounded" />
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                    <a class="dropdown-item" href="<?php echo URL; ?>usuario/empleados">Ver más</a>
                                </div>
                            </div>
                        </div>
                        <span class="d-block mb-1">Clientes</span>
                        <h3 class="card-title text-nowrap mb-2"><?php echo $this->data->clientes_registrados->cantidad_clientes; ?></h3>
                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> <?php random_percent() ?> </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
        <div class="row">
            <div class="col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="<?php echo ASSETS; ?>img/icons/unicons/paypal.png" alt="Credit Card" class="rounded" />
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                </div>
                            </div>
                        </div>
                        <span class="d-block mb-1">Efectivo</span>
                        <h3 class="card-title mb-2">S/. <?php echo $this->data->pagos->pago_efectivo; ?></h3>
                        <small class="text-success fw-semibold"><i class="bx bx-down-arrow-alt"></i> <?php random_percent() ?></small>
                    </div>
                </div>
            </div>
            <div class="col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="<?php echo ASSETS; ?>img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Página</span>
                        <h3 class="card-title mb-2">S/. <?php echo $this->data->pagos->pago_internet ?></h3>
                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i><?php random_percent() ?></small>
                    </div>
                </div>
            </div>
            <div class="col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="<?php echo ASSETS; ?>img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Débito</span>
                        <h3 class="card-title mb-2">S/. <?php echo $this->data->pagos->pago_debito ?></h3>
                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i><?php random_percent() ?></small>
                    </div>
                </div>
            </div>
            <div class="col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="<?php echo ASSETS; ?>img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Crédito</span>
                        <h3 class="card-title mb-2">S/. <?php echo $this->data->pagos->pago_credito ?></h3>
                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i><?php random_percent() ?></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 order-2 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2">Ganancias</h5>
            </div>
            <div class="card-body">
                <ul class="p-0 m-0">
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                            <img src="<?php echo  ASSETS ?>img/icons/unicons/wallet.png" alt="User" class="rounded" />
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <small class="text-muted d-block mb-1">Tarjeta</small>
                                <h6 class="mb-0">Pagos de pedidos en tarjeta</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                                <h6 class="mb-0"><?php echo $this->data->pagos->pago_credito; ?></h6>
                                <span class="text-muted">PE</span>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                            <img src="<?php echo  ASSETS ?>img/icons/unicons/wallet.png" alt="User" class="rounded" />
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <small class="text-muted d-block mb-1">Débito</small>
                                <h6 class="mb-0">Pagos de pedido con tarjetas de debito</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                                <h6 class="mb-0"><?php echo $this->data->pagos->pago_debito; ?></h6>
                                <span class="text-muted">PE</span>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                            <img src="<?php echo  ASSETS ?>img/icons/unicons/cc-success.png" alt="User" class="rounded" />
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <small class="text-muted d-block mb-1">Efectivo</small>
                                <h6 class="mb-0">Pagos de pedidos con efectivo</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                                <h6 class="mb-0"><?php echo $this->data->pagos->pago_efectivo; ?></h6>
                                <span class="text-muted">PE</span>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                            <img src="<?php echo  ASSETS ?>img/icons/unicons/cc-success.png" alt="User" class="rounded" />
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <small class="text-muted d-block mb-1">Parciales</small>
                                <h6 class="mb-0">Pagos de pedidos parciales</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                                <h6 class="mb-0"><?php echo $this->data->pagos->pago_parcial; ?></h6>
                                <span class="text-muted">PE</span>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                            <img src="<?php echo  ASSETS ?>img/icons/unicons/wallet.png" alt="User" class="rounded" />
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <small class="text-muted d-block mb-1">Pagos Totales</small>
                                <h6 class="mb-0">Todo lo ganado durante la apertura del sistema.</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                                <h6 class="mb-0"><?php echo number_format($this->data->pagos->pago_efectivo + $this->data->pagos->pago_debito + $this->data->pagos->pago_credito + $this->data->pagos->pago_parcial + $this->data->pagos->pago_internet, 2); ?></h6>
                                <span class="text-muted">PE</span>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex">
                        <div class="avatar flex-shrink-0 me-3">
                            <img src="<?php echo  ASSETS ?>img/icons/unicons/cc-warning.png" alt="User" class="rounded" />
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <small class="text-muted d-block mb-1">Pagos de terceros</small>
                                <h6 class="mb-0">Pagos hechos en la página, hechos por el cliente.</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                                <h6 class="mb-0"><?php echo $this->data->pagos->pago_internet; ?></h6>
                                <span class="text-muted">PE</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 order-2 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2">Ganancias</h5>
            </div>
            <div class="card-body">
                <ul class="p-0 m-0">
                    <?php 
                    if(count($this->data->ultimos_usuarios) > 0){
                        foreach($this->data->ultimos_usuarios as $k => $d){
                            ?>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="<?php echo  ASSETS ?>img/icons/unicons/client.gif" alt="User" class="rounded" />
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="text-muted d-block mb-1"> Registrado hace <?php echo tiempo_transcurrido($d->fecha_registro); ?> </small>
                                            <h6 class="mb-0"><?php echo $d->nombre .' ' . $d->apellido_paterno . ' ' . $d->apellido_materno?></h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">Ultima actividad</h6>
                                            <span class="text-muted"><?php 
                                                if($d->fecha_actividad != '' && $d->fecha_actividad != null){
                                                    echo tiempo_transcurrido($d->fecha_actividad);
                                                }else{
                                                    echo 'N/A';
                                                }
                                            ?></span>
                                        </div>
                                    </div>
                                </li>
                            <?php
                        }
                    }else{
                        mdi_messaje('mdi-alert', 'No hay ningun cliente registrado');
                    }  
                    ?>
                </ul>
            </div>
        </div>
    </div>
        <?php 
    }else{
        ?>

        <?php 
    }
  ?>
</div>