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
            "url": URL + "informes/modelos_vendidos",
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
                    return `<b># ${data.cod_diseño}</b>`;

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `<b>S/. ${(data.cantidad * data.precio).toFixed(2)}</b>`;

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `<b>${(data.cantidad)}</b>`;

                }
            },
            
        ],
        
    });
    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
        
     });

}

