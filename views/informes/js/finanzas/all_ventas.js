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
            "url": URL + "informes/get_ventas",
            "method": "POST"
        },
        "destroy": true,
        "responsive": true,
        "dom": "tip",
        "bSort": true,
        "order": [[0, "asc"]],
        "columns": [
            {
                "data": "fecha", "render": function (data, type, row) {
                    return '<i class="mdi mdi-calendar"></i> ' + moment(data).format('DD-MM-Y')
                        + '<br><span class="font-12"><i class="mdi mdi-clock-time-eleven-outline"></i> ' + moment(data).format('h:mm A') + '</span>';

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `<b>${data.tipo_pago}</b>`;

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `<b>${data.encargado}</b>`;

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `<b>S/. ${data.total}</b>`;

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `<b>S/. ${data.monto_pagado}</b>`;

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `<b><i class="mdi mdi-trending-neutral"></i> ${data.transaccion_id}</b>`;
                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    if (data.estado_pago == 'c') {
                        return `<button class="btn btn-outline-dark btn-rounded">Pagado</button>`
                    } else {
                        return `<button class="btn btn-danger btn-rounded"  disabled>Por pagar</button>`
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
                    <li><a class="dropdown-item" target="_blank"  href="${URL}informes/imprime_pedido/${data.id_pedido}"><i class="mdi mdi-printer"></i>  Imprimir</a></li>
                    <li><a class="dropdown-item" target="_blank" href="${URL}detalle/pedido/${data.id_pedido}"><i class="mdi mdi-eye-outline"></i>  Detalle pedido</a></li>

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