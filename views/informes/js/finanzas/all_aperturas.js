$(document).ready(function () {
    lista_datos();
});
function lista_datos() {
    var table = $('#table').DataTable({
        dom: 'Bfrtip',
        "ajax": {
            "url": URL + "informes/get_aperturas",
            "method": "POST"
        },
        "destroy": true,
        "responsive": true,
        "dom": "tip",
        "bSort": true,
        "order": [[0, "asc"]],
        "columns": [
            {
                "data": "fecha_apertura", "render": function (data, type, row) {
                    return '<i class="mdi mdi-calendar"></i> ' + moment(data).format('DD-MM-Y')
                        + '<br><span class="font-12"><i class="mdi mdi-clock-time-eleven-outline"></i> ' + moment(data).format('h:mm A') + '</span>';

                }
            },
            {
                "data": "fecha_cierre", "render": function (data, type, row) {
                    if (data == 'Aún está aperturado') {
                        return `<b>${data}</b>`;
                    } else {
                        return '<i class="mdi mdi-calendar"></i> ' + moment(data).format('DD-MM-Y')
                            + '<br><span class="font-12"><i class="mdi mdi-clock-time-eleven-outline"></i> ' + moment(data).format('h:mm A') + '</span>';
                    }
                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `<b>${data.nombre}</b>`;

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `<b>S/. ${data.monto_inicial}</b>`;

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `<b>S/. ${data.monto_sistema}</b>`;

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    if (data.monto_cierre == '-') {
                        return `<b>${data.monto_cierre}</b>`;

                    } else {
                        return `<b>S/. ${data.monto_cierre}</b>`;

                    }
                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    if (data.estado == 'a') {
                        return `<button class="btn btn-success btn-rounded" disabled>Aperturado</button>`
                    } else {
                        return `<button class="btn btn-danger btn-rounded"  disabled>Cerrado</button>`
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
                      <li><a class="dropdown-item" target="_blank" href="${URL}informes/reporte_apertura_individual/${data.id_apc}"><i class="mdi mdi-printer"></i>  Imprimir</a></li>
                    </ul>
                  </div>
                  </div>`
                }
            },

        ],
    });

}