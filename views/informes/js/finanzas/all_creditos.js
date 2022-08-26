$(document).ready(function () {
    lista_datos();
});
function lista_datos() {
    function filterGlobal () {
        $('#table').DataTable().search( $('.global_filter').val()).draw();
     }
    var table = $('#table').DataTable({
        dom: 'Bfrtip',
        "ajax": {
            "url": URL + "informes/get_creditos",
            "method": "POST"
        },
        "destroy": true,
        "responsive": true,
        "dom": "tip",
        "bSort": true,
        "order": [[0, "asc"]],
        "columns": [
            {
                "data": "fecha_inicio", "render": function (data, type, row) {
                    return '<i class="mdi mdi-calendar"></i> ' + moment(data).format('DD-MM-Y')
                        + '<br><span class="font-12"><i class="mdi mdi-clock-time-eleven-outline"></i> ' + moment(data).format('h:mm A') + '</span>';

                }
            },
            {
                "data": "fecha_fin", "render": function (data, type, row) {
                  if(data == null){
                        return `<b>-</b>`
                  }else{
                    return '<i class="mdi mdi-calendar"></i> ' + moment(data).format('DD-MM-Y')
                    + '<br><span class="font-12"><i class="mdi mdi-clock-time-eleven-outline"></i> ' + moment(data).format('h:mm A') + '</span>';
                  }
                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `<b>${data.cliente.nombre}</b>`;

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `<b>${data.encargado.nombre}</b>`;

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `<b>S/. ${data.pago.total}</b>`;

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `<b>S/. ${data.pago.monto}</b>`;

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    let restante = data.pago.total - data.pago.monto;
                    if(data.historial.length > 0) {
                        for(let x of data.historial){
                            restante = restante - x.monto;
                        }
                    }
                    if(restante > 0){
                        return `<b>S/. ${restante}</b>`;
                    }else{
                        return `<b>S/. 0.00</b>`;
                    }
                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    let restante = data.pago.total - data.pago.monto;
                    if(data.historial.length > 0) {
                        for(let x of data.historial){
                            restante = restante - x.monto;
                        }
                    }
                    if(restante > 0){
                        return `<button class="btn btn-outline-warning btn-rounded">Faltante</button>`
                    }else{
                        return `<button class="btn btn-outline-success btn-rounded">Completado</button>`
                    }
                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `<div class="row">
                    <div class="btn-group">
                    <button
                      type="button"
                      class="btn btn-outline-dark col-12 dropdown-toggle dropdown-toggle-split"
                      data-bs-toggle="dropdown"
                      aria-expanded="false">
                      <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" target="_blank"  href="${URL}informes/imprime_pedido/${data.pago.id_pedido}"><i class="mdi mdi-printer"></i>  Imprimir</a></li>
                    <li><a class="dropdown-item" target="_blank" href="${URL}detalle/pedido/${data.pago.id_pedido}"><i class="mdi mdi-eye-outline"></i>  Detalle pedido</a></li>
                    </ul>
                  </div>
                  </div>`
                }
            },

        ],
    });
    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
        
     });

}
