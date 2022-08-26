<div class="row">
    <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
             <div class="row">
                 <div class="col-12">
                 <h2>
                  <button class="btn btn-primary btn-rounded" onclick="agrega_usuario('cliente')"><i class="mdi mdi-plus"></i></button>
              </h2>
                 </dv>
             </div>
            <h4 class="card-title">Clientes Registrados</h4>
            <p class="card-text">Listamos todos los clientes que están activos en el sistema, podrás activar o desactivar el usuario</p>
            <div class="row">
                <div class="col-lg-12 p-3 m-2">
                    <input type="text" class="form-control global_filter" placeholder="Ingresa palabras clave">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-responsive table-bordered table-hover table-striped" id="table" border="0" width="100%">
                    <thead>
                        <th>DOCUMENTO</th>
                        <th>NOMBRE COMPLETO</th>
                        <th>GÉNERO</th>
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