<div class="row">
    <div class="col-lg-3 card_ctg animated flipInX">
        <div class="card ">
            <img class="card-img-top" src="<?php echo ASSETS; ?>img/headers/etiqueta-categoria.jpg">
            <div class="card-body">
                <h4 class="card-title">Categorias de materiales</h4>
                <p class="card-text">Agrega o modifica elementos de tu inventario</p>
                <div class="list-categorias row no-gutters">

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 card_data animated flipInX" style="display: none;">
        <div class="card text-left">
            <img class="card-img-top" src="<?php echo ASSETS; ?>img/inventario.webp">
            <div class="card-body">
                <h4 class="card-title" id="form_title"></h4>
                <p class="card-text" id="form_body"></p>
                <form>
                    <input type="hidden" value="" id="id_material">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="text" style="text-transform: uppercase;" maxlength="30" id="nombre_mat" class="form-control" placeholder="Nombre del Material" aria-describedby="help_nombre">
                                <small id="help_nombre" class="text-muted">Nombre del Material</small>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <select id="catg_mat" class="form-control selectpicker border">
                                    <option value="">Seleccione una opción</option>
                                    <?php foreach ($this->catg as $k => $d) : ?>
                                        <option value="<?php echo $d->id_categoria; ?>"><?php echo $d->nombre; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small id="" class="text-muted">Categoría del material</small>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <select id="est_mat" class="form-control selectpicker border">
                                    <option value="">Seleccione una opción</option>
                                    <option value="a">ACTIVO</option>
                                    <option value="b">DESACTIVADO</option>
                                </select>
                                <small id="" class="text-muted">Estado del material</small>
                            </div>
                        </div>
                        <div class="col-12 pt-2">
                            <button class="btn btn-primary col-12 save" type="button">Guardar</button>
                        </div>
                        <div class="col-12 pt-2">
                            <button class="btn btn-danger col-12 cancel_save" type="button">Cancelar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-9 pt-2">
        <div class="card text-left">
            <div class="card-body">
                <div class="row">
                    <div class="col-1 offset-10 align-left">
                        <h2>
                            <button class="btn btn-primary" title="Agregar nuevo material" style="border-radius: 100px" id="btn_ctn"><i class="mdi mdi-plus"></i></button>
                        </h2>
                    </div>
                    <div class="col-12 pt-2 pb-2 mb-3">
                        <input type="text" class="form-control form-block global_filter" placeholder="Ingrese una palabra clave ">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="table" border="0" width="100%">
                        <thead>
                            <th>Nombre</th>
                            <th>Fecha Agregado</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>