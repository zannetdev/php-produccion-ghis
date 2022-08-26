<?php navigation_renderer('pedidos', 'Procesos/Ver todos') ?>

<div class="row">
  <div class="col-lg-4 pb-3 scroll">
    <div class="card">
      <div class="card-body">
        <div class="col-2 p-3">
          <button class="btn btn-outline-dark col-auto actualiza"><i class="mdi mdi-sync"></i></button>
        </div>
        <h4 class="card-title">Procesos sin encargado</h4>
        <p class="card-text">Lista todos los procesos que no tienen encargado.</p>

        <div id="pedidos_container_sin" class="accordion mt-3" id="pedidos">

        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 pb-3 scroll">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Procesos con encargado</h4>
        <p class="card-text">Lista todos los procesos que están en producción</p>

        <div id="pedidos_container_con" class="accordion mt-3" id="pedidos">

        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 pb-3">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Detalle del pedido</h4>
        <p class="card-text"></p>
        <div class="pedido_detalle">
          
        </div>
      </div>
    </div>
  </div>
</div>