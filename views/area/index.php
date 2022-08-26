
<div class="row">
  <div class="col-lg-6">
    <div class="card text-left">
      <img class="card-img-top" style="max-height: 180px;" src="<?php echo ASSETS; ?>img/headers/img_prod.jpg" alt="Produccion">
      <div class="card-body">
        <h4 class="card-title">Tu Area De Producción</h4>
        <p class="card-text">Estás registrado en el area de producción: <b> <?php echo  strtolower($this->area->nombre); ?></b></p>
        <div class="row">
          <div class="col-12 text-center justify-center">
           Conexión de Socket  <i class='bx bx-signal-5' style="color: green;"></i>

          </div>
        </div>
        <div class="row mt-4 mb-4">
          <div class="col-12 justify-center text-center"> 
            <button class="btn btn-primary verify_connection"><i class='bx bx-sort-alt-2'></i>
              Verificar Conexión de Socket
            </button>
          </div>

        </div>
        <p class="card-text text-center">
          El socket ⬆️ es el lazo que hay entre tu usuario y el encargado de crear los pedidos.
        </p>
      </div>
    </div>
  </div>
  <div class="col-lg-6 pt-2">
    <div class="card bg-white">
      <div class="card-body">
        <h4 class="card-title">Pedidos</h4>
        <p class="card-text">Listamos los nuevos pedidos</p>
        <div class="row">
          <div class="col-12">
            <div class="accordion mt-3 append_pedidos" id="accordion" class="accordion mt-3" >
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>