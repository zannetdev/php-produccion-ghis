<div class="row justify-center">
    <div class="col-lg-8">
        <div class="card bg-dark">
            <div class="card-img-overlay">
                <h4 class="card-title">Network Testing</h4>
                <p class="card-text">Selecciona la impresora y da click en imprimir, para verificar que funcione correctamente.</p>
                <div class="row">
                    <div class="col-12">
                        <label for="impresora">Seleccione una impresora</label>
                        <div class="input-group">
                            <select name="" id="impresora" data-live-search="true" class="form-control selectpicker border">
                                <option value="">Seleccione una impresora</option>
                                <?php foreach ($this->impresoras as $k => $d) : if ($d->estado == 'a') : ?>
                                        <option value="<?php echo $d->nombre_impresora ?>"><?php echo $d->nombre_impresora; ?></option>
                                <?php
                                    endif;
                                endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <button type="button" class="btn btn-outline-dark col-12 process" btn-lg btn-block>Probar Conectividad</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>