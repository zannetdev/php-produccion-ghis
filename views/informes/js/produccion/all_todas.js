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
            "url": URL + "informes/get_todas",
            "method": "POST"
        },
        "destroy": true,
        "responsive": true,
        "dom": "tip",
        "bSort": true,
        "order": [[0, "asc"]],
        "columns": [
            {
                "data": null, "render": function (data, type, row) {
                    return `<b># ${data.modelo.cod_diseño}</b>`;
                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    if(data.proceso.length > 0) {
                        if(data.proceso.length > 0) {
                            return '<i class="mdi mdi-calendar"></i> ' + moment(data.proceso[0].detalle.fecha_inicio).format('DD-MM-Y')
                            + '<br><span class="font-12"><i class="mdi mdi-clock-time-eleven-outline"></i> ' + moment(data.proceso[0].detalle.fecha_inicio).format('h:mm A') + '</span>';
                        }else{
                            return `<b>-</b>`
                        }
                    }
                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    if(data.proceso.length > 0) {
                        if(data.proceso.length >= 6) {
                           if(data.proceso[6].detalle.fecha_fin != null){
                            return '<i class="mdi mdi-calendar"></i> ' + moment(data.proceso.detalle[6].fecha_fin).format('DD-MM-Y')
                            + '<br><span class="font-12"><i class="mdi mdi-clock-time-eleven-outline"></i> ' + moment(data.proceso.detalle[6].fecha_fin).format('h:mm A') + '</span>';
                           }else{
                            return `<b>-</b>`
                           }
                        }else{
                            return `<b>-</b>`
                        }
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
                    return `<b>S/. ${data.pago.total}</b>`;

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    if(data.pago == null) {
                        return `<b>SIN PAGO</b>`;

                    }else{
                        var metodo = data.pago.metodo_pago == 1 ? 'EFECTIVO'  : data.pago.metodo_pago == 2 ? 'DEBITO' : data.pago.metodo_pago == 3 ? 'CREDITO' : data.pago.metodo_pago == 5 ? 'A PAGOS' : ''
                    }
                    return `<b> ${metodo}</b>`;

                }
            },
            
            {
                "data": null, "render": function (data, type, row) {
                    if (data.estado == 'c') {
                        return `<button class="btn btn-outline-dark btn-rounded">En cola</button>`
                    } else {
                        if (data.estado == 'p') {
                            if(data.proceso.length >= 6){
                                if(data.proceso[6].detalle.fecha_fin != null){
                                    return `<button class="btn btn-outline-dark btn-rounded">Terminado</button>`
                                }else{
                                    return `<button class="btn btn-outline-dark btn-rounded">En producción</button>`
                                }
                            }else{
                                return `<button class="btn btn-outline-dark btn-rounded">En producción</button>`
                            }
                        }else{
                            return `<button class="btn btn-outline-dark btn-rounded">Terminado</button>`
                        }
                    }
                }
            }
        ],
    });
    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
        
     });

}
