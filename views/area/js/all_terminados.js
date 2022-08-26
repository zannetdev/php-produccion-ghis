/// <reference path="../../../logic/js/functions_helpers.js" />

$(function () {
    ClassManager.ActiveSimpleItem('terminados')
    lista_datos();
  });

  function lista_datos() {
    function filterGlobal () {
        $('#table').DataTable().search( $('.global_filter').val()).draw();
     }
    var table = $('#table').DataTable({
        dom: 'Bfrtip',
        "ajax": {
            "url": URL + "area/all_terminados",
            "method": "POST"
        },
        "destroy": true,
        "responsive": true,
        "dom": "tip",
        "bSort": true,
        "order": [[0, "desc"]],
        "columns": [
            {
                "data": null, "render": function (data, type, row) {
                    return `<b># ${data.proceso.id_pedido}</b>`;

                }
            },
            {
                "data": "fecha_inicio", "render": function (data, type, row) {
                    return '<i class="mdi mdi-calendar"></i> ' + moment(data).format('DD-MM-Y')
                        + '<br><span class="font-12"><i class="mdi mdi-clock-time-eleven-outline"></i> ' + moment(data).format('h:mm A') + '</span>';

                }
            },
            {
                "data": "fecha_fin", "render": function (data, type, row) {
                 
                    return '<i class="mdi mdi-calendar"></i> ' + moment(data).format('DD-MM-Y')
                    + '<br><span class="font-12"><i class="mdi mdi-clock-time-eleven-outline"></i> ' + moment(data).format('h:mm A') + '</span>';
                  
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
                      <li><a class="dropdown-item" href="javascript:imprimir(${data.id_detalle})" ><i class="mdi mdi-printer"></i>  Imprimir</a></li>
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
function imprimir(id_detalle){
    $("#modal_imprimir").modal("show")
    limpia_datos();
    $("#id_detalle_proceso").val(id_detalle);
}
function limpia_datos(){
    $("#id_detalle_proceso").val();
    select_option("#name_imp", '');
}
$("#modal_imprimir").on("hidden.bs.modal", function(){
    limpia_datos();
})
$(".close").on("click", function(){
    $("#modal_imprimir").modal("close")
    limpia_datos();
})
function close(){
    $("#modal_imprimir").modal("close")
    limpia_datos();
}
$(".print").on("click", function(){
    let data = {
        id_detalle : $("#id_detalle_proceso").val(),
        name_imp : $("#name_imp").selectpicker('val')
    }
    if(data.id_detalle != '' && data.name_imp != ''){
        $.ajax({
            type: "POST",
            url: URL + "area/get_detalle",
            data: {
                id_detalle : data.id_detalle,
            },
            dataType: "json",
            success: function (response) {
                if(response.code == -10){
                    Swal.fire({
                        title: 'Error',
                        html: response.msj,
                        icon: 'error'
                    })
                }else{
                    // SI HAY UN RESPONSE DE DATOS
                    window.open(`http://${$("#pc_ip").val()}/imprimir/comprobante_proceso.php?data=${encodeURIComponent(JSON.stringify(response.data))}&impresora=${data.name_imp}`)
                    $("#modal_imprimir").modal("hide")
                    limpia_datos();
                }
            }
        });            
    }else{
        Toast.fire({
            title: 'Error',
            html: 'Favor de seleccionar una impresora',
            icon: 'error'
        })
    }
})