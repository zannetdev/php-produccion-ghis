
  <div class="col-lg-6 offset-lg-3" style="display: block;">
    <div class="card">
        <div class=" card-body">
      <h4 class="card-title">Creación de pedido</h4>
      <p class="card-text">Rellena la siguiente información para crear un pedido</p>
      <div class="row">
        <div class="col-12">
          <div class="form-group">
            <label for="">Color del modelo</label>
            <select id="color" class="form-control selectpicker border">
              <option value="">Seleccione una opción</option>
              <?php foreach ($this->colores as $k => $d) : ?>
                <option value="<?php echo $d->nombre; ?>"><?php echo $d->nombre; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="col-12">
          <div class="form-group">
            <label for="">Cliente</label>
            <select id="cliente_1" class="form-control selectpicker border cliente" data-cliente=''>
              <option value="">Seleccione una opción</option>
              <?php foreach ($this->clientes as $k => $d) : ?>
                <option value="<?php echo $d->id_cliente; ?>"><?php echo $d->nombre . ' ' . substr($d->apellido_paterno, 0, 5) . '.'; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="col-12 pt-2">
          <div class="form-group">
            <label for="">Observaciones</label>
            <textarea class="form-control" name="" id="observacion" rows="3"></textarea>
          </div>
        </div>

        <div class="col-12 pt-4">
          <button class="btn btn-outline-primary btn-block col-12" id="btn-sec"><i class="mdi mdi-arrow-right"></i> Empezar a crear pedido</button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-4" style="display: none;">
  <div class="card">
        <div class=" card-body">
    <h4 class="card-title">Creación de pedido</h4>
    <p class="card-text">Rellena la siguiente información para crear un pedido</p>
  </div>
</div>
</div>

</div>