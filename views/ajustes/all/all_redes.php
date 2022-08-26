<div class="row justify-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Configuración de Red</h4>
                <p class="card-text">Rellena todos los campos requeridos</p>
                <div class="row justify-center">
                    <div class="col-12">
                        <label for="ip">IP Address</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text form-control-lg" style="font-size: 20px !important"><i class="mdi mdi-wifi-lock"></i></div>
                            </div>
                            <input type="text" class="form-control form-control-lg" id="ip" style="font-size: 20px !important" placeholder="IP Xampp o Wampp" title="Dirección Ip del Server">
                            <small><span data-tooltip="Ejecuta el siguiente comando: &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;>$ ipconfig. Copias el IPV4 y listo." data-tooltip-position="bottom"> <i class="mdi mdi-information-outline md-24"></i> </span></small>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="impresora">Impresora de compras</label>
                        <div class="input-group">
                            <select name="" id="impresora" data-live-search="true" class="form-control selectpicker border">
                                <option value="">Seleccione una impresora</option>
                                <?php foreach ($this->impresoras as $k => $d) : if ($d->estado == 'a') : ?>
                                        <option value="<?php echo $d->id_impresora ?>"><?php echo $d->nombre_impresora; ?></option>
                                <?php
                                    endif;
                                endforeach; ?>
                            </select>
                            <small><span data-tooltip="Impresora que el sistema llamará para imprimir tickets termicos." data-tooltip-position="bottom"> <i class="mdi mdi-information-outline md-24"></i> </span></small>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <button type="button" class="btn btn-outline-dark col-12 save" btn-lg btn-block>Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>