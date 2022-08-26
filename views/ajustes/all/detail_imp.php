<?php
$area_id = $this->area;

switch ($area_id) {
    case 1:
        $area = 'Corte';
        break;
    case 2:
        $area = 'Devastado';
        break;
    case 3:
        $area = 'Aparado';
        break;
    case 4:
        $area = 'Armado';
        break;
    case 5:
        $area = 'Pegado';
        break;
    case 6:
        $area = 'Acabado';
        break;
}
?>

<input type="hidden" value="<?php echo $area_id; ?>" id="area_id">

<div class="row justify-center">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Impresoras para el area <?php echo strtolower($area) ?></h4>
                <p class="card-text">Puedes agregar, eliminar impresoras registradas para imprimir comprobantes.</p>
                <div class="row">

                    <div class="col-auto p-3 m-2">
                        <button class="btn btn-outline-primary col-auto plus"><i class="mdi mdi-plus"></i></button>
                    </div>
                    <div class="col-lg-12 p-3 m-2">
                        <input type="text" class="form-control global_filter" placeholder="Ingresa palabras clave">
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-inverse table-responsive" width="100%">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Nombre</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_impresora" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Selecciona una impresora</h5>
                <button type="button" class="btn btn-white close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="mdi mdi-window-close"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <button class="btn btn-white" disabled> <span><i class="mdi mdi-content-cut"></i></span></button>
                            </div>
                            <select class="form-control selectpicker border" data-live-search="true" id="id_impresora">
                                <option value="">Seleccione una opción</option>
                                <?php
                                $print = false;
                                $y = 1;
                                $count_imp = $this->impresoras_reg != false ? count($this->impresoras_reg) : 0;

                                if ($count_imp > 0) {
                                    foreach ($this->impresoras as $a => $b) {
                                        $id_c = $b->id_impresora;
                                        $id_t = 0;
                                        foreach ($this->impresoras_reg as $k => $d) {
                                            $id_t = $d->id_impresora;
                                           
                                            if ($id_t == $id_c) {
                                                $print = false;
                                                break;
                                            } else {
                                                if ($y == $count_imp) {
                                                    $print = true;
                                                }else{
                                                    $y = $y + 1;
                                                }
                                            }
                                        }
                                        if ($print == true && $y == $count_imp) {
                                            ?><option value="<?php echo $b->id_impresora; ?>"><?php echo $b->nombre_impresora ?> </option><?php
                                        }
                                    }
                                } else {
                                    foreach ($this->impresoras as $k => $d) {
                                        ?><option value="<?php echo $d->id_impresora; ?>"><?php echo $d->nombre_impresora ?> </option><?php
                                    }
                                }

                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <button type="button" class="btn btn-outline-dark col-12 save" btn-lg btn-block>Guardar</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger close col-12" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>