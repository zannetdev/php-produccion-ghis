<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h2>
                            <button class="btn btn-primary btn-rounded" onclick="agrega_usuario('empleado')"><i class="mdi mdi-plus"></i></button>
                        </h2>
                        </dv>
                    </div>
                    <h4 class="card-title">Empleados Registrados</h4>
                    <p class="card-text">Listamos todos los clientes que están activos en el sistema, podrás activar, agregar o editar datos del empleado</p>
                    <div class="table-responsive">
                        <table class="table table-responsive table-bordered table-hover table-striped" id="table" border="0" width="100%">
                            <thead>
                                <th>TIPO DOCUMENTO</th>
                                <th>NOMBRE COMPLETO</th>
                                <th>GÉNERO</th>
                                <th>ROL</th>
                                <th>EMAIL</th>
                                <th>TÉLEFONO</th>
                                <th>DIRECCION</th>
                                <th>FECHA REGISTRO</th>
                                <th>ULTIMA ACTIVIDAD</th>
                                <th>ESTADO</th>
                                <th>OPCIONES</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="modal_area" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Selecciona el área de producción</h5>
      
      </div>
      <div class="modal-body">
        <form>
            <div class="row">
                <input type="hidden" id="id_empleado" value="">
                <div class="col-lg-12">
                    <select class="form-control selectpicker border" data-live-search="true" id="i_area">
                        <?php 
                            foreach($this->areas as $k => $d){
                                echo '<option value="'.$d->id_area.'">'.$d->nombre_area.'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btn-rounded save">Guardar</button>
      </div>
    </div>
  </div>
</div>