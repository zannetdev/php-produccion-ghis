/// <reference path="../../../logic/js/active_class.js" />
$(function () {
    ClassManager.ActiveMenuItem('ajustes','aj_ajustes')
});
$(function () {
    lista_datos();
});
function lista_datos(id = $("#area_id").val()){
    function filterGlobal () {
        $('#table').DataTable().search( $('.global_filter').val()).draw();
    }
    var table = $('#table').DataTable( {
        dom: 'Bfrtip',
        "ajax":{
            "url": URL +   "ajustes/get_imp_reg/"+id,
            "method": "POST"
        },
        "destroy": true,
        "responsive": true,
        "dom": "tip",
        "bSort": true,
        "order": [[0,"asc"]],
         "columns":[
                {"data":null,"render": function ( data, type, row ) {
                      return `<b>${data.impresora.nombre_impresora}</b>`;
                    
                }},
                {"data":null,"render": function ( data, type, row ) {
                   
                    return ` <div class="btn-group">
                    <button
                      type="button"
                      class="btn btn-info dropdown-toggle dropdown-toggle-split"
                      data-bs-toggle="dropdown"
                      aria-expanded="false">
                      <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="javascript: elimina(${data.id_impresora})"><i class="mdi mdi-trash-can-outline"></i>  Eliminar</a></li>
                    </ul>
                  </div>`
                  }},

            ],
    } );
    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal(); 
     });
}
var elimina = (id) =>{
    Swal.fire({
        title: 'Mensaje',
        html: '¿Estás seguro de eliminar esta impresora?',
        icon: 'question',
        allowOutsideClick: false,
        allowEscapeKey: false,
        backdrop: '#4bb0e3',
        showCancelButton: true,
        cancelButtonText: 'Cancelar operación',
        confirmButtonText: 'Confirmar operación',
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return new Promise(function (resolve) {
                $.ajax({
                    type: "POST",
                    url: URL + "ajustes/elimina_impresora_area",
                    data: {
                        id: id,
                        area: $("#area_id").val()
                    },
                    dataType: "json",
                    success: function (response) {
                        
                    }
                })
                    .done(function (response) {
                        if (response.code == 1) {
                            SoundNotifier.Done();
                            Swal.fire({
                                
                                title: 'Notificación',
                                html: response.msj,
                                icon: 'success'
                            }).then(() => {
                                window.location.reload();
                            })
                        } else {
                            SoundNotifier.Error();
                            Swal.fire({
                                title: 'Notificación',
                                html: response.msj,
                                icon: 'error'
                            })
                        }
                    })
                    .fail(function () {
                        Swal.fire('Oops...', 'Problemas con la conexión a internet!', 'error');
                    });
            });
        }
    })
    
}
$('.plus').on('click', ()=>{
    show_modal();
})
$("#modal_impresora").on('hidden.bs.modal', ()=>{
    select_option("#id_impresora", '')
})
$(".close").on('click', ()=>{
    hide_modal();
})
var show_modal = ()=>{
    $("#modal_impresora").modal('show')
}
var hide_modal = ()=>{
    $("#modal_impresora").modal('hide')
}
$(".save").on('click', ()=>{
    let data = {
        impresora: $("#id_impresora").selectpicker('val'),
        area: $("#area_id").val()
    }
    if(data.impresora != ''){

        $.ajax({
            type: "POST",
            url: URL + "ajustes/agrega_impresora",
            data: data,
            dataType: "json",
            success: function (response) {
                if(response.code == 1){
                    SoundNotifier.Okay();
                    hide_modal();
                    Swal.fire({
                        title: 'Notificación',
                        html: response.msj,
                        icon:'success',
                    }).then(function(){
                    
                        window.location.reload();
                    })

                }else{
                    SoundNotifier.Error();
                    hide_modal();

                    Swal.fire({
                        title: 'Notificación',
                        html: response.msj,
                        icon:'error',
                    }).then(()=>{

                    })                    
                }
            }
        });
    }else{
        SoundNotifier.Error();
        Toast.fire({
            title: 'Error',
            html: 'Rellena todos los campos requeridos',
            icon: 'error',
        })
    }
});