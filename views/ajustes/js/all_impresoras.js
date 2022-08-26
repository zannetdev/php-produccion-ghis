/// <reference path="../../../logic/js/functions_helpers.js" />

$(function () {
    ClassManager.ActiveMenuItem('ajustes','aj_ajustes')
});
$(function () {
    lista_datos();
});
function lista_datos(){
    function filterGlobal () {
        $('#table').DataTable().search( $('.global_filter').val()).draw();
    }
    var table = $('#table').DataTable( {
        dom: 'Bfrtip',
        "ajax":{
            "url": URL +   "ajustes/imp_get",
            "method": "POST"
        },
        "destroy": true,
        "responsive": true,
        "dom": "tip",
        "bSort": true,
        "order": [[0,"asc"]],
         "columns":[
                {"data":null,"render": function ( data, type, row ) {
                      return `<b>${data.nombre_impresora}</b>`;
                    
                }},
                {"data":null,"render": function ( data, type, row ) {
                    if(data.estado == 'a'){
                        return `<button class="btn btn-success btn-rounded" onclick="update_status(${data.id_impresora})">Activo</button>`
                    }else{
                        return `<button class="btn btn-danger btn-rounded"  onclick="update_status(${data.id_impresora})">Inactivo</button>`
                    }
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
                      <li><a class="dropdown-item" href="javascript: edita(${data.id_impresora}, '${data.nombre_impresora}', '${data.corte_impresora}')"><i class="mdi mdi-pencil"></i>  Editar</a></li>
                    </ul>
                  </div>`
                  }},

            ],
    } );
    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal(); 
     });
}
var edita = (id, nombre, corte) => {
    rellena_datos(id, nombre, corte)
    visualiza_modal();
}
var update_status = (id_imp) => {
    $.ajax({
        type: "POST",
        url: $("#url").val() + "ajustes/update_status",
        data: {
            filter: id_imp,
        },
        success: ()=>{
            lista_datos();
        }
    });
}
$(".plus").on('click', ()=>{
    visualiza_modal();
    borra_datos();
})
$(".close").on('click', ()=>{
    borra_datos();
    esconde_modal();

})
$("#modal_impresora").on('hidden.bs.modal', ()=>{
    borra_datos();
})
var rellena_datos = (id, nombre, corte) =>{
    $("#id_impresora").val(id)
    $("#nombre_imp").val(nombre)
    select_option("#corte_imp", corte);
}
var borra_datos = ()=>{
    $("#id_impresora").val('')
    $("#nombre_imp").val('')
    select_option("#corte_imp", '');
}
var visualiza_modal = ()=>{
    
    $("#modal_impresora").modal("show")

}
var esconde_modal = ()=>{
    
    $("#modal_impresora").modal("hide")

}
$(".save").on('click', ()=>{
    let data = {
        id_imp : $("#id_impresora").val(),
        nombre_impresora : $("#nombre_imp").val(),
        corte: $("#corte_imp").selectpicker('val')
    }
    if(data.nombre_impresora != '' && data.corte != ''){
        $.ajax({
            type: "POST",
            url: URL + "ajustes/crud_impresora",
            data: data,
            dataType: "json",
            success: function (response) {
                if(response.code == 1){
                    SoundNotifier.Okay();
                    esconde_modal();

                    Swal.fire({
                        title: 'Notificación',
                        html: response.msj,
                        icon:'success',
                    }).then(function(){
                       lista_datos();
                    })

                }else{
                    SoundNotifier.Error();
                    esconde_modal();

                    Swal.fire({
                        title: 'Notificación',
                        html: response.msj,
                        icon:'error',
                    }).then(()=>{
                        lista_datos();
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
})
