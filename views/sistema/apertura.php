<?php navigation_renderer('apertura', 'Apertura') ?>
<input type="hidden" id="in_aper" value="0">
<div class="row">
    <div class="col-lg-8 col-sm-12 offset-lg-2">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Apertura o Cierre del Sistema</h4>
                <p class="card-text">Las aperturas del sistema son necesarias para recolectar los datos, para que los reportes queden perfectamente documentados.</p>
                <?php if(!$this->apertura):?>
                <div class="row">
                    <div class="col-lg-4">
                        <?php mdi_messaje('mdi-lock-outline', 'Cerrado'); ?>
                    </div>
                    <div class="col-lg-8">
                        <form>
                            <div class="row justify-center pt-5">
                                <div class="col-12">
                                    <label class="sr-only" for="monto_inicial">Monto inicial</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">S/.</div>
                                        </div>
                                        <input type="text"class="form-control" id="monto_inicial" placeholder="Monto Inicial">
                                    </div>
                                </div>
                                <div class="col-12 justify-center pt-2">
                                    <button class="btn btn-primary btn-block btn-lg" type="button" id="btn_ap">Aperturar Sistema</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php endif; ?>
                <?php if($this->apertura != null):?>
                <div class="row">
                    <div class="col-lg-4">
                        <?php mdi_messaje('mdi-lock-open-variant-outline', 'Abierto'); ?>
                    </div>
                    <div class="col-lg-8">
                        <form>
                            <div class="row justify-center pt-5">
                                <div class="col-12">
                                    <label class="sr-only" for="monto_cierre">Monto De Cierre</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">S/.</div>
                                        </div>
                                        <input type="text" class="form-control" id="monto_cierre" placeholder="Monto Cierre">
                                    </div>
                                </div>
                                <div class="col-12 justify-center pt-2">
                                    <button class="btn btn-primary btn-block btn-lg" type="button"type="button" id="btn_ce">Cerrar Sistema</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>