class Component {
  static EmptyMessage(text) {
    return `
        <div class="col-12 ">
        <center><br><br><br><i class='mdi mdi-alert-circle display-3' style='color: #d3d3d3; font-size: 100px'></i><br><br><span class='font-18' style='color: #d3d3d3;'>${text}</span><br></center>
        </div>
        `;
  }

  static PedidoAccordion(id_pedido, diseño, fecha, cliente, estado) {
    let html = ``
    if (estado == 'c') {
      html = `
      <div class="card accordion-item mt-2">
                 <h2 class="accordion-header" id="heading${id_pedido}">
                   <button
                     type="button"
                     class="accordion-button collapsed"
                     data-bs-toggle="collapse"
                     data-bs-target="#accordion${id_pedido}"
                     aria-expanded="false"
                     aria-controls="accordion${id_pedido}"
                   >
                     <i class="mdi mdi-alert"></i>&nbsp;&nbsp;&nbsp;Nuevo pedido en cola
                   </button>
                 </h2>
                 <div
                   id="accordion${id_pedido}"
                   class="accordion-collapse collapse"
                   aria-labelledby="heading${id_pedido}"
                   data-bs-parent="#pedidos"
                 >
                   <div class="accordion-body">
                     El cliente ${cliente} ha hecho un pedido del modelo <b>#${diseño}</b> <br>El día <i class="mdi mdi-calendar"></i>${moment(fecha).format('DD-MM-Y')} a las <span class="font-12"><i class="mdi mdi-clock-time-eleven-outline"></i>${moment(fecha).format('h:mm A')}</span>
                     <div class="dropdown-divider"></div>
                     <div class="col-12 justify-center">
                       <button class="btn btn-outline-dark col-auto p-2 m-3" title="Detalles del pedido" onclick="crear_proceso(${id_pedido})"><i class="mdi mdi-shape-circle-plus"> Mandar a producción</i></button>
                     </div>
                     </div>
                 </div>
     </div>
 `;
    } else {
      html = `
      <div class="card accordion-item mt-2">
                 <h2 class="accordion-header" id="heading${id_pedido}">
                   <button
                     type="button"
                     class="accordion-button collapsed"
                     data-bs-toggle="collapse"
                     data-bs-target="#accordion${id_pedido}"
                     aria-expanded="false"
                     aria-controls="accordion${id_pedido}"
                   >
                     <i class="mdi mdi-alert"></i>&nbsp;&nbsp;&nbsp;Pedido pendiente
                   </button>
                 </h2>
                 <div
                   id="accordion${id_pedido}"
                   class="accordion-collapse collapse"
                   aria-labelledby="heading${id_pedido}"
                   data-bs-parent="#pedidos"
                 >
                   <div class="accordion-body">
                     El cliente ${cliente} ha hecho un pedido del modelo <b>#${diseño}</b> <br>El día <i class="mdi mdi-calendar"></i>${moment(fecha).format('DD-MM-Y')} a las <span class="font-12"><i class="mdi mdi-clock-time-eleven-outline"></i>${moment(fecha).format('h:mm A')}</span>
                     <div class="dropdown-divider"></div>
                     <div class="col-12 justify-center">
                       <button class="btn btn-outline-dark col-auto p-2 m-3" title="Detalles del pedido" onclick="detalle(${id_pedido})"><i class="mdi mdi-monitor-eye"> Detalles</i></button>
                     </div>
                     </div>
                 </div>
     </div>
 `;
    }
    return html;
  }
  static ProcesoAccordion(id_proceso, modelo, id_area, area, nombre) {
    let html = `<div class="card accordion-item mt-2">
    <h2 class="accordion-header" id="heading${id_proceso}">
      <button
        type="button"
        class="accordion-button collapsed"
        data-bs-toggle="collapse"
        data-bs-target="#accordion${id_proceso}"
        aria-expanded="false"
        aria-controls="accordion${id_proceso}"
      >
        <i class="mdi mdi-alert"></i>&nbsp;&nbsp;&nbsp;Proceso de producción del modelo&nbsp;&nbsp;&nbsp;&nbsp;<strong> #${modelo}</strong>
      </button>
    </h2>
    <div
      id="accordion${id_proceso}"
      class="accordion-collapse collapse"
      aria-labelledby="heading${id_proceso}"
      data-bs-parent="#pedidos"
    >
      <div class="accordion-body">
        <div class="dropdown-divider"></div>
        <div class="col-12 justify-center">
          <button class="btn btn-outline-dark col-auto p-2 m-3" title="Detalles del pedido" onclick="ver('${id_area}','${area}','${nombre}' )"><i class="mdi mdi-shape-circle-plus"> Ver proceso</i></button>
        </div>
        </div>
    </div>
</div>`
    return html;
  }
  static NuevoPedido(id_proceso, diseño, fecha, cliente, estado) {
    let html = ` <div class="card accordion-item mt-2">
    <h2 class="accordion-header" id="heading${id_proceso}">
      <button
        type="button"
        class="accordion-button collapsed"
        data-bs-toggle="collapse"
        data-bs-target="#accordion${id_proceso}"
        aria-expanded="false"
        aria-controls="accordion${id_proceso}"
      >
        <i class="mdi mdi-alert"></i>&nbsp;&nbsp;&nbsp; Nuevo pedido! 
      </button>
    </h2>
    <div
      id="accordion${id_proceso}"
      class="accordion-collapse collapse"
      aria-labelledby="heading${id_proceso}"
      data-bs-parent="#pedidos"
    >
      <div class="accordion-body">
        El cliente ${cliente} ha hecho un pedido del modelo <b>#${diseño}</b> <br>El día <i class="mdi mdi-calendar"></i>${moment(fecha).format('DD-MM-Y')} a las <span class="font-12"><i class="mdi mdi-clock-time-eleven-outline"></i>${moment(fecha).format('h:mm A')}</span>
        ¡Aceptalo antes que alguien lo acepte!
        <div class="dropdown-divider"></div>
        <div class="col-12 justify-center">
          <button class="btn btn-outline-dark col-auto p-2 m-3" title="Detalles del pedido" onclick="acepta_pedido(${id_proceso})"><i class="mdi mdi-shape-circle-plus"> Aceptar pedido</i></button>
        </div>
        </div>
    </div>
</div>`
return html;
  }
  static ProcesoUsuario(id_detalle, fecha, modelo) {
    let html = `<div class="card accordion-item mt-4 shadow-lg col-lg-10" style="margin-top: 30px !important">
    <h2 class="accordion-header" id="heading${id_detalle}">
      <button
        type="button"
        class="accordion-button collapsed"
        data-bs-toggle="collapse"
        data-bs-target="#accordion${id_detalle}"
        aria-expanded="false"
        aria-controls="accordion${id_detalle}"
      >
        <i class="mdi mdi-spin"></i>&nbsp;&nbsp;&nbsp;Producción del modelo ;&nbsp;&nbsp;&nbsp;<strong> #${modelo.toUpperCase()}</strong>
      </button>
    </h2>
    <div
      id="accordion${id_detalle}"
      class="accordion-collapse collapse"
      aria-labelledby="heading${id_detalle}"
      data-bs-parent="#pedidos"
    >
      <div class="accordion-body">
      <p><strong>Aceptaste el pedido</strong> el día <i class="mdi mdi-calendar"></i>${moment(fecha).format('DD-MM-Y')} a las <span class="font-12"><i class="mdi mdi-clock-time-eleven-outline"></i>${moment(fecha).format('h:mm A')}</span></p>
        <div class="dropdown-divider"></div>
        <div class="col-12 justify-center">
          <a href="${URL}area/produccion/${id_detalle}"class="btn btn-outline-dark col-auto p-2 m-3" title="Detalles del pedido"><i class="mdi mdi-shape-circle-plus"> Acceder a producción</i></a>
        </div>
        </div>
    </div>
</div>`
    return html;
  }
}
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 2000,
  position: 'bottom-end',
  timerProgressBar: true,
})