<div class="crud_variables">
    <input type="hidden" id="process" value="<?php echo $this->process; ?>">
    <input type="hidden" id="id_modelo" value="<?php echo $this->id_modelo; ?>">
    <input type="hidden" id="id_tmp" value="">
</div>
<div class="row">
    <div class="col-lg-3 pb-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Datos Principales</h4>
                <p class="card-text text-center">Rellena todos los campos, con su respectiva información</p>
                <div class="row no-gutters">


                    <div class="form-group mt-2 pt-2 col-6">
                        <select id="cuero_1" class="form-control selectpicker border" data-live-search="true">
                            <option value="">Seleccione una opción</option>

                            <?php
                            foreach ($this->insumos as $k => $d) {
                                if ($d->nombre_catg == CATG_CUEROS) {
                            ?>
                                    <option value="<?php echo $d->nombre; ?>"><?php echo $d->nombre; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <small class="text-muted pt-2">Cuero 1</small>
                    </div>

                    <div class="form-group mt-2 pt-2 col-6">
                        <select id="cuero_2" class="form-control selectpicker border" data-live-search="true">
                            <option value="">Seleccione una opción</option>

                            <?php
                            foreach ($this->insumos as $k => $d) {
                                if ($d->nombre_catg == CATG_CUEROS) {
                            ?>
                                    <option value="<?php echo $d->nombre; ?>"><?php echo $d->nombre; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <small class="text-muted pt-2">Cuero 2</small>
                    </div>

                    <div class="form-group mt-2 pt-2 col-12">
                        <input type="text" class="form-control" id="capellado">
                        <small class="text-muted pt-2">Capellado</small>
                    </div>

                    <div class="form-group mt-2 pt-2 col-12">
                        <select id="tela" class="form-control selectpicker border" data-live-search="true">
                            <option value="">Seleccione una opción</option>

                            <?php
                            foreach ($this->insumos as $k => $d) {
                                if ($d->nombre_catg == CATG_TELAS) {
                            ?>
                                    <option value="<?php echo $d->nombre; ?>"><?php echo $d->nombre; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <small class="text-muted pt-2">Tela</small>
                    </div>

                    <div class="form-group mt-2 pt-2 col-6">
                        <select id="forro_1" class="form-control selectpicker border" data-live-search="true">
                            <option value="">Seleccione una opción</option>

                            <?php
                            foreach ($this->insumos as $k => $d) {
                                if ($d->nombre_catg == CATG_FORROS) {
                            ?>
                                    <option value="<?php echo $d->nombre; ?>"><?php echo $d->nombre; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <small class="text-muted pt-2">Forro 1</small>
                    </div>

                    <div class="form-group mt-2 pt-2 col-6">
                        <select id="forro_2" class="form-control selectpicker border" data-live-search="true">
                            <option value="">Seleccione una opción</option>

                            <?php
                            foreach ($this->insumos as $k => $d) {
                                if ($d->nombre_catg == CATG_FORROS) {
                            ?>
                                    <option value="<?php echo $d->nombre; ?>"><?php echo $d->nombre; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <small class="text-muted pt-2">Forro 2</small>
                    </div>
                    <div class="form-group mt-2 pt-2 col-6">
                        <input type="text" class="form-control " name="" id="empalme" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text">Marcar empalme</small>
                    </div>
                    <div class="form-group mt-2 pt-2 col-6">
                        <input type="text" class="form-control " name="" id="grabado" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text">Grabado</small>
                    </div>
                    <div class="form-group mt-2 pt-2 col-6">
                        <input type="text" class="form-control " name="" id="desuaste_1" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text">Desuaste 1</small>
                    </div>
                    <div class="form-group mt-2 pt-2 col-6">
                        <input type="text" class="form-control " name="" id="desuaste_2" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text">Desuaste 2</small>
                    </div>
                    <div class="form-group mt-2 pt-2 col-12">
                        <input type="text" class="form-control " name="" id="pin_bordes" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text">Pintado de bordes</small>
                    </div>
                    <div class="form-group mt-2 pt-2 col-6">
                        <select id="aguja_1" class="form-control selectpicker border" data-live-search="true">
                            <option value="">Seleccione una opción</option>

                            <?php
                            foreach ($this->insumos as $k => $d) {
                                if ($d->nombre_catg == CATG_AGUJAS) {
                            ?>
                                    <option value="<?php echo $d->nombre; ?>"><?php echo $d->nombre; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <small class="text-muted pt-2">Aguja 1</small>
                    </div>
                    <div class="form-group mt-2 pt-2 col-6">
                        <select id="aguja_2" class="form-control selectpicker border" data-live-search="true">
                            <option value="">Seleccione una opción</option>
                            <?php
                            foreach ($this->insumos as $k => $d) {
                                if ($d->nombre_catg == CATG_AGUJAS) {
                            ?>
                                    <option value="<?php echo $d->nombre; ?>"><?php echo $d->nombre; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <small class="text-muted pt-2">Aguja 2</small>
                    </div>
                    <div class="form-group mt-2 pt-2 col-6">
                        <select id="hilo_1" class="form-control selectpicker border" data-live-search="true">
                            <option value="">Seleccione una opción</option>

                            <?php
                            foreach ($this->insumos as $k => $d) {
                                if ($d->nombre_catg == CATG_HILOS) {
                            ?>
                                    <option value="<?php echo $d->nombre; ?>"><?php echo $d->nombre; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <small class="text-muted pt-2">Hilo 1</small>
                    </div>
                    <div class="form-group mt-2 pt-2 col-6">
                        <select id="hilo_2" class="form-control selectpicker border" data-live-search="true">
                            <option value="">Seleccione una opción</option>

                            <?php
                            foreach ($this->insumos as $k => $d) {
                                if ($d->nombre_catg == CATG_HILOS) {
                            ?>
                                    <option value="<?php echo $d->nombre; ?>"><?php echo $d->nombre; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <small class="text-muted pt-2">Hilo 2</small>
                    </div>
                    <div class="form-group mt-2 pt-2 col-12">
                        <select id="hilo_drama" class="form-control selectpicker border" data-live-search="true">
                            <option value="">Seleccione una opción</option>
                            <?php
                            foreach ($this->insumos as $k => $d) {
                                if ($d->nombre_catg == CATG_DRAMAS) {
                            ?>
                                    <option value="<?php echo $d->nombre; ?>"><?php echo $d->nombre; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <small class="text-muted pt-2">Hilo Drama</small>
                    </div>
                    <div class="form-group mt-2 pt-2 col-12">
                        <select id="esponja" class="form-control selectpicker border" data-live-search="true">
                            <option value="">Seleccione una opción</option>
                            <?php
                            foreach ($this->insumos as $k => $d) {
                                if ($d->nombre_catg == CATG_ESPONJAS) {
                            ?>
                                    <option value="<?php echo $d->nombre; ?>"><?php echo $d->nombre; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <small class="text-muted pt-2">Esponja</small>
                    </div>
                    <div class="form-group mt-2 pt-2 col-12">
                        <select id="chapita" class="form-control selectpicker border" data-live-search="true">
                            <option value="">Seleccione una opción</option>
                            <?php
                            foreach ($this->insumos as $k => $d) {
                                if ($d->nombre_catg == CATG_CHAPITA) {
                            ?>
                                    <option value="<?php echo $d->nombre; ?>"><?php echo $d->nombre;?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <small class="text-muted pt-2">Chapita</small>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 pb-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Ficha Técnica del Modelo</h4>
                <div class="row">
                    <div class="form-group mt-2 pt-2 col-6 offset-3 pb-3">
                        <input type="text" class="form-control form-control-lg" name="" id="modelo_codigo" style="font-size: 30px; text-align: center;  text-transform: uppercase;" aria-describedby="helpId" placeholder="">
                        <small class="form-text text-muted">Código de Diseño</small>
                    </div>
                    <div class="form-group mt-2 pt-2 col-12">
                        <select id="id_catg" class="form-control selectpicker border" data-live-search="true">
                            <option value="">Seleccione una opción</option>
                            <?php
                            foreach ($this->categoria as $k => $d) {
                               
                            ?>
                                    <option value="<?php echo $d->id_categoria; ?>"><?php echo $d->nombre; ?></option>
                            <?php
                                
                            }
                            ?>
                        </select>
                        <small class="text-muted pt-2">Categoria del diseño</small>
                    </div>
                    <div class="form-group mt-2 pt-2 col-4 offset-2">
                        <input type="text" class="form-control form-control" name="" id="total_consumo_cuero" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text">Total Consumo de cuero x Docena</small>
                    </div>
                    <div class="form-group mt-2 pt-2 col-4">
                        <input type="text" class="form-control form-control" name="" id="precio" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text">Precio Unitario</small>
                    </div>
                    <div class="card text-white bg-white mt-4 col-lg-12 col-sm-12" style="color: #000000 !important">
                        <div class="card-body">
                            <h4 class="card-title">Sellar marco</h4>
                            <div class="form-group mt-2 pt-2 pt-3 row">
                                <div class="form-check col-6 justify-center">
                                    <input class="form-check-input border" type="checkbox" id="lateral" name="marco">
                                    <label class="form-check-label" for="lateral"> Lateral</label>
                                </div>
                                <div class="form-check col-6">
                                    <input class="form-check-input border" type="checkbox" id="lengua"  name="marco">
                                    <label class="form-check-label" for="lengua"> Lengua</label>
                                </div>
                                <div class="form-check col-12 pt-2  justify-center">
                                    <label>Otros</label>&nbsp;&nbsp;
                                    <select multiple class="" data-role="tagsinput" id="otros">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-2 pt-2 col-6 offset-3 mt-4">
                        <input type="text" class="form-control form-control" name="" id="consumo_cierre_docena" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text">Consumo Cierre x Docena</small>
                    </div>
                    <div class="form-group mt-2 pt-2 mt-4">
                        <label>Imagen</label>&nbsp;&nbsp;
                        <form action="<?php echo URL ?>service/upload_image" class="dropzone" id="my-dropzone"></form>
                        <button class="btn btn-outline-primary col-12 mt-4 save">Guardar todo</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 pb-3">
        <div class="card">
            <img class="card-img-top" src="<?php echo URL; ?>ghis.png" style="width: 100%;">
            <div class="card-body">
                <div class="row">
                    <div class="form-group">
                        <input type="text" name="" id="no_patron" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted">No. Patrón</small>
                    </div>
                    <div class="form-group">
                        <input type="text" name="" id="horma" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted">Horma</small>
                    </div>
                    <div class="form-group mt-2 pt-2 col-12">
                        <select id="planta" class="form-control selectpicker border" data-live-search="true">
                            <option value="">Seleccione una opción</option>
                            <?php
                            foreach ($this->insumos as $k => $d) {
                                if ($d->nombre_catg == CATG_PLANTA) {
                            ?>
                                    <option value="<?php echo $d->nombre; ?>"><?php echo $d->nombre; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <small class="text-muted pt-2">Planta</small>
                    </div>
                    <div class="form-group">
                        <input type="text" name="" id="falso" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted">Falso</small>
                    </div>
                    <div class="form-group mt-2 pt-2 col-12">
                        <select id="plantillo" class="form-control selectpicker border" data-live-search="true">
                            <option value="">Seleccione una opción</option>
                            <?php
                            foreach ($this->insumos as $k => $d) {
                                if ($d->nombre_catg == CATG_PANTILLOS) {
                            ?>
                                    <option value="<?php echo $d->nombre; ?>"><?php echo $d->nombre; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <small class="text-muted pt-2">Plantillos</small>
                    </div>
                    <div class="form-group">
                        <input type="text" name="" id="latex" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted">Latex</small>
                    </div>
                    <div class="form-group">
                        <input type="text" name="" id="preimer" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted">Preimer</small>
                    </div>
                    <div class="form-group">
                        <input type="text" name="" id="sombreado" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted">Sombreado</small>
                    </div>

                    <div class="form-group mt-2 pt-2 col-12">
                        <select id="taco" class="form-control selectpicker border" data-live-search="true">
                            <option value="">Seleccione una opción</option>
                            <?php
                            foreach ($this->insumos as $k => $d) {
                                if ($d->nombre_catg == CATG_TACOS) {
                            ?>
                                    <option value="<?php echo $d->nombre; ?>"><?php echo $d->nombre; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <small class="text-muted pt-2">Taco</small>
                    </div>
                    <div class="form-group">
                        <input type="text" name="" id="serie" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted">Serie</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>