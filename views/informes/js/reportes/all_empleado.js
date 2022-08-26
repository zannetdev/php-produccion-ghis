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
            "url": URL + "informes/get_empleados",
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
                    return `<b>${data.nombre}</b>`;

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                   if(data.id_area == null){
                    return `<b>-</b>`;
                   }else{
                       var area = '';
                       switch(data.id_area){
                            case "1": 
                                area = 'CORTE';
                            break;
                            case "2": 
                            area = 'DEBASTADO';
                            break;
                            case "3": 
                            area = 'APARADO';

                            break;
                            case "4": 
                            area = 'ARMADO';

                            break;
                            case "5": 
                            area = 'PEGADO';

                            break;
                            case '6': 
                            area = 'ACABADO';
                            break;
                            

                       }
                       return `<b>${area}</b>`;

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
                      <li><a  href="javascript: gen_reporte_empleado(${data.id_usuario}) "  class="dropdown-item"><i class="mdi mdi-printer"></i>  Imprimir</a></li>
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

var gen_reporte_empleado = (id) => {
    if($("#start").val() != '' && $("#end").val() != ''){
        $.ajax({
            type: "POST",
            url: `${URL}informes/check_report/empleado`,
            data: {
                id: id,
                ifecha: $('#start').val(),
                ffecha : $('#end').val(),
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
                let start = $("#start").val();
                let end = $("#end").val();
                if(response.code == 1){
                    window.open(`${URL}informes/empleado_reporte/${id}?ifecha=${start}&ffecha=${end}`, '_blank');
                }else{
                    Swal.fire({
                        title: 'Error',
                        html: 'El empleado no tiene registro de procesos en el lapso de tiempo ingresado',
                        icon: 'error'
                    })
                }
            }
        });
    }else{
        Swal.fire({
            title: 'Selecciona una fecha',
            html: 'Debes seleccionar una fecha para continuar',
            icon: 'error'
        })
    }
}


$('#start').bootstrapMaterialDatePicker({
    format: 'DD-MM-YYYY',
    time: false,
    lang: 'es-do',
    cancelText: 'Cancelar',
    okText: 'Aceptar'
});

$('#end').bootstrapMaterialDatePicker({
    useCurrent: false,
    format: 'DD-MM-YYYY',
    time: false,
    lang: 'es-do',
    cancelText: 'Cancelar',
    okText: 'Aceptar'
});
