<input type="hidden" id="tipo_proceso" value="<?php echo $this->proceso; ?>">
<input type="hidden" id="tipo_usuario" value="<?php echo $this->tipo_usuario; ?>">
<?php
if ($this->usuid) :
  echo '<input type="hidden" id="id_usuario" value="' . $this->usuid . '">';
endif;
?>
<div class="row no-gutters">
  <div class="col-12 mb-4 pb-4">
    <div class="card">
      <div class="text-center">
        <?php title(ucwords($this->title)); ?>
      </div>
    </div>
  </div>
  <div class="col-lg-5 offset-lg-2 pb-4">
    <div class="card text-left">
      <div class="card-body">
        <h4 class="card-title">Datos del usuario</h4>
        <p class="card-text">Rellena todos los campos</p>
        <div class="row">
          <div class="form-group col-12">
            <input type="text" name="" id="nombre" class="form-control" placeholder="Nombre" maxlength="40" minlength="2" aria-describedby="helpId">
            <small id="helpId" class="text-muted">Nombre</small>
          </div>

          <div class="form-group col-6">
            <input type="text" name="" id="ape_pat" class="form-control" placeholder="Apellido Paterno" maxlength="40" minlength="2" aria-describedby="helpId">
            <small id="helpId" class="text-muted">Ape. Paterno</small>
          </div>
          <div class="form-group col-6">
            <input type="text" name="" id="ape_mat" class="form-control" placeholder="Apellido Materno" maxlength="40" minlength="2" aria-describedby="helpId">
            <small id="helpId" class="text-muted">Ape. Materno</small>
          </div>
          <?php
          if ($this->tipo_usuario != 'cliente') {
          ?>
            <div class="form-group col-12">
              <select name="" id="tp_usu" class="form-control selectpicker border" data-live-search="true">
                <option value="">Seleccione el tipo de usuario</option>
                <?php
                foreach ($this->roles as $k => $d) {
                ?>
                  <option value="<?php echo $d->id_rol ?>"><?php echo $d->nombre_rol ?></option>
                <?php
                }
                ?>
              </select>
              <small id="helpId" class="text-muted">Rol en sistema</small>
            </div>
          <?php
          }
          ?>
          <div class="form-group col-6">
            <select id="gen" class="form-control selectpicker border" data-live-search="true">
              <option value="">Seleccione el Género</option>
              <option value="F">Femenino</option>
              <option value="M">Masculino</option>
            </select>
            <small id="helpId" class="text-muted">Sexo</small>
          </div>
          <div class="form-group col-6">
            <input type="text" name="" id="tel" class="form-control" placeholder="Teléfono" aria-describedby="helpId">
            <small id="helpId" class="text-muted">Teléfono</small>
          </div>
          <div class="form-group col-12">
            <input type="email" id="email" class="form-control" placeholder="Email" aria-describedby="helpId">
            <small id="helpId" class="text-muted">Email</small>
          </div>
          <div class="form-group col-12">
            <input type="text" name="" id="direccion" class="form-control" placeholder="Dirección" minlength="4" aria-describedby="helpId" maxlength="100">
            <small id="helpId" class="text-muted">Dirección</small>
          </div>
          <div class="form-group col-6">
            <input type="text" name="" autocomplete="off" id="usuario" class="form-control" ismxfilled="0" placeholder="Usuario" minlength="4" aria-describedby="helpId" maxlength="30">
            <small id="helpId" class="text-muted">Usuario</small>
          </div>
          <div class="form-group col-6">
            <input type="password" name="" autocomplete="off" id="password" class="form-control" ismxfilled="0" autocomplete="new-password" minlength="4" maxlength="40" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="helpId">
            <small id="helpId" class="text-muted">Contraseña</small>
          </div>
          <div class="col-12 pt-4">
            <button type="button" class="btn btn-outline-primary btn-block btn-save" style="width: 100%">Guardar <i class="mdi mdi-save"></i></button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="card text-left">
      <div class="card-body">
        <h4 class="card-title">Datos Fiscales</h4>
        <p class="card-text">Rellena todos los campos</p>
        <div class="row">
          <div class="form-group col-12">
            <input type="text" name="" id="num_doc" class="form-control" placeholder="" aria-describedby="helpId">
            <small id="helpId" class="text-muted">Número DNI</small>
          </div>
          <div class="form-group col-12">
            <input type="text" name="" id="num_doc_ruc" class="form-control" placeholder="" aria-describedby="helpId">
            <small id="helpId" class="text-muted">Número RUC</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>