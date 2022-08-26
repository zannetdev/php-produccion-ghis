<style>
    ul {
        overflow: hidden;
    }

    li,
    h1 {
        display: inline;
    }

    li:nth-child(4):before {
        display: block;
        content: '';
    }
</style>
<?php
$modelo = $this->datos_proceso->modelo;
$detalle_pedido = $this->datos_proceso->detalle_pedido;
$json = json_decode($detalle_pedido->json_tallas);
?>
<input type="hidden" id="pwd" value="<?php echo '11' . date('dmy') . '9'; ?>">
<input type="hidden" id="proceso_id" value="<?php echo $this->datos_proceso->id_proceso ?>">
<input type="hidden" id="detalle_id" value="<?php echo $this->datos_proceso->id_detalle ?>">

<div class="col-lg-10 offset-lg-1">
    <div id="tabs">
        <div class="row">
            <div class="col-12 justify-center">
                <ul style="list-style: none;">
                    <li><a href="#tab_detalle" class="btn btn-outline-dark  btn-md col-auto b-t active">Pedido</a></li>
                    <li><a href="#tab_detalle_modelo" class="btn btn-outline-dark btn-md col-auto b-t ">Modelo</a></li>
                    <li><a href="#tab_finalizado" class="btn btn-outline-dark  btn-md col-auto  b-t">Proceso</a></li>
                </ul>
            </div>
        </div>

        <div class="row" id="tab_detalle">
            <div class="col-lg-3 mt-2">
                <div class="card">
                    <img class="card-img-top" src="<?php echo $this->datos_proceso->modelo->imagen; ?>" alt="">
                    <div class="card-body">
                        <h4 class="card-title">Modelo</h4>
                        <p class="card-text">#<?php echo strtoupper($this->datos_proceso->modelo->cod_diseño); ?></p>
                        <div class="row">
                            <a class="btn btn-outline-dark col-12" target="_blank" href="<?php echo URL; ?>area/imprime_pedido/<?php echo $this->datos_proceso->detalle->id_pedido;?>"><i class="mdi mdi-printer"> Imprimir ficha</i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card col-lg-7">

                <div class="card-body">
                    <h4 class="card-title">Detalle del pedido</h4>
                    <p class="card-text">Estas son las tallas</p>
                    <div class="row">
                        <div class="form-group col-lg-6 mt-2">
                            <label for="">Color de producción</label>
                            <input type="text" class="form-control" readonly value="<?php echo $detalle_pedido->color; ?>">
                        </div>
                        <div class="form-group col-lg-12 mt-2">
                            <label for="">Observaciones</label>
                            <?php if ($detalle_pedido->observacion == '') : ?>
                                <textarea class="form-control" readonly>Sin ninguna observación</textarea>
                            <?php else : ?>
                                <textarea class="form-control" readonly><?php echo $detalle_pedido->observacion; ?></textarea>
                            <?php endif; ?>
                            <div class="table-responsive mt-3">
                                <h4>Tallas</h4>
                                <table class="table table-striped table-inverse table-responsive">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>Talla</th>
                                            <th>Cantidad</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total = 0;
                                        foreach ($json as $k => $d) : $total = $total + intval($d->cantidad); ?>
                                            <tr>
                                                <td><?php echo $d->talla; ?></td>
                                                <td><?php echo $d->cantidad; ?></td>
                                                <td scope="row">-</td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td scope="row">-</td>
                                            <td>-</td>
                                            <td><?php echo $total . ' Unidades'; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group col-lg-12 mt-2">
                                <label for="">Taco</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->taco; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="tab_detalle_modelo" class="row">
            <div class="col-lg-12 mt-2">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detalles del modelo</h4>
                        <p class="card-text">
                        <div class="row container_details" style="display: none">
                            <div class="form-group col-lg-6 mt-2">
                                <label for="">Cuero #1</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->cuero_1; ?>">
                            </div>
                            <div class="form-group col-lg-6 mt-2">
                                <label for="">Cuero #2</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->cuero_2; ?>">
                            </div>
                            <div class="form-group col-lg-3 mt-2 col-sm-4">
                                <label for="">Capellado</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->capellado; ?>">
                            </div>
                            <div class="form-group col-lg-3 mt-2">
                                <label for="">Tela</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->tela; ?>">
                            </div>
                            <div class="form-group col-lg-3 mt-2">
                                <label for="">Grabado</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->grabado; ?>">
                            </div>
                            <div class="form-group col-lg-3 mt-2">
                                <label for="">Marcar empalme</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->marcar_empalme; ?>">
                            </div>
                            <div class="form-group col-lg-6 mt-2">
                                <label for="">Forro #1</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->forro_1; ?>">
                            </div>
                            <div class="form-group col-lg-6 mt-2">
                                <label for="">Forro #2</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->forro_2; ?>">
                            </div>

                            <div class="form-group col-lg-6 mt-2">
                                <label for="">Desuaste #1</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->desuaste_1; ?>">
                            </div>
                            <div class="form-group col-lg-6 mt-2">
                                <label for="">Desuaste #2</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->desuaste_2; ?>">
                            </div>
                            <div class="form-group col-lg-3 mt-2">
                                <label for="">Pintado bordes</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->pintado_bordes; ?>">
                            </div>
                            <div class="form-group col-lg-3 mt-2">
                                <label for="">Esponja</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->esponja; ?>">
                            </div>
                            <div class="form-group col-lg-3 mt-2">
                                <label for="">Chapita</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->chapita; ?>">
                            </div>
                            <div class="form-group col-lg-3 mt-2">
                                <label for="">Serie</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->serie; ?>">
                            </div>
                            <div class="form-group col-lg-6 mt-2">
                                <label for="">Aguja #1</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->aguja_1; ?>">
                            </div>
                            <div class="form-group col-lg-6 mt-2">
                                <label for="">Aguja #2</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->aguja_2; ?>">
                            </div>
                            <div class="form-group col-lg-6 mt-2">
                                <label for="">Hilo #1</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->hilo_1; ?>">
                            </div>
                            <div class="form-group col-lg-6 mt-2">
                                <label for="">Hilo #2</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->hilo_2; ?>">
                            </div>
                            <div class="form-group col-lg-3 mt-2">
                                <label for="">Hilo drama</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->hilo_drama; ?>">
                            </div>

                            <div class="form-group col-lg-3 mt-2">
                                <label for="">Consumo cierre p/docena</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->consumo_cierre_por_doc; ?>">
                            </div>
                            <div class="form-group col-lg-3 mt-2">
                                <label for="">Consumo cuero p/docena</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->consumo_cuero_por_doc; ?>">
                            </div>
                            <div class="form-group col-lg-3 mt-2">
                                <label for="">Patron No</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->n_patron; ?>">
                            </div>
                            <div class="form-group col-lg-3 mt-2">
                                <label for="">Horma</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->horma; ?>">
                            </div>
                            <div class="form-group col-lg-3 mt-2">
                                <label for="">Planta</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->planta; ?>">
                            </div>
                            <div class="form-group col-lg-3 mt-2">
                                <label for="">Falso</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->falso; ?>">
                            </div>
                            <div class="form-group col-lg-3 mt-2">
                                <label for="">Plantillos</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->plantillos; ?>">
                            </div>
                            <div class="form-group col-lg-3 mt-2">
                                <label for="">Latex</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->latex; ?>">
                            </div>
                            <div class="form-group col-lg-3 mt-2">
                                <label for="">Preimer</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->preimer; ?>">
                            </div>
                            <div class="form-group col-lg-3 mt-2">
                                <label for="">Sombreado</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->sombreado; ?>">
                            </div>

                            <div class="form-group col-lg-12 mt-2">
                                <label for="">Sellar marca</label>
                                <input type="text" class="form-control" readonly value="<?php echo $modelo->sellar_marca; ?>">
                            </div>
                        </div>
                        <div class="row container_pass">
                            <div class="form-group">
                                <label for="">Contraseña de bloqueo</label>
                                <input type="text" class="form-control" name="" id="pwd_bloqueo" placeholder="***********">
                                <small id="helpId" class="form-text text-muted">Ingrese la contraseña de bloqueo</small>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn btn-outline-primary col-12 verificar">Verificar</button>
                            </div>
                        </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div id="tab_finalizado" class="row justify-center">
            <div class="col-lg-4">
                <div class="card" style="height: 600px;">
                    <img class="card-img-top justify-center" style="object-fit: cover;" src="<?php echo ASSETS; ?>img/headers/giphy.gif" alt="Finalizar pedido">
                    <div class="card-body">

                        <div class="center-xy">
                            <h4>Desliza para terminar el pedido</h4>
                            <input type="range" value="0" class="pullee" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>