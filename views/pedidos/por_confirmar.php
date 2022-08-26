<?php navigation_renderer('pedidos', 'Pedidos/Ver todos') ?>

<div class="row">
  <div class="col-lg-8 pb-3 scroll">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Todos los pedidos por confirmar</h4>
        <p class="card-text">Lista de todos los pedidos recientes hechos por el cliente</p>

        <div id="pedidos_container" class="accordion mt-3" id="pedidos">

        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 pb-3 scroll">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Detalles del pedido</h4>
        <p class="card-text"></p>

        <div id="pedido_detalle" class="accordion mt-3" id="pedidos">
            <?php echo mdi_messaje('mdi mdi-alert', 'Selecciona un pedido') ?>
        </div>
      </div>
    </div>
  </div>
</div>