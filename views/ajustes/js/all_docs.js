$(document).ready(function () {
        lista_datos();
});

function lista_datos(){
    var table = $('#table').DataTable( {
        dom: 'Bfrtip',
        "ajax":{
            "url": URL +   "ajustes/get_docs/",
            "method": "POST"
        },
        "destroy": true,
        "responsive": true,
        "dom": "tip",
        "bSort": true,
        "order": [[0,"asc"]],
         "columns":[
                {"data":null,"render": function ( data, type, row ) {
                      return `<b>${data.nombre}</b>`;
                    
                }},
                {"data":null,"render": function ( data, type, row ) {
                      return `<b>${data.serie}</b>`;
                    
                }},
                {"data":null,"render": function ( data, type, row ) {
                      return `<b>${data.numero}</b>`;
                    
                }},
                {"data":null,"render": function ( data, type, row ) {
                    let b = `
                        <button class="btn btn-${data.estado == 'a' ? 'success' : 'danger'}" disabled>${data.estado == 'a' ? 'Activo' : 'Ináctivo'}</button>
                    `                    
                    return b
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
                      <li><a class="dropdown-item" href="javascript: edita_handler(${data.id_documento})"><i class="mdi mdi-pen"></i>  Editar</a></li>
                    </ul>
                  </div>`
                  }},

            ],
    } );
}

const edita_handler = (id) => {
    $("#modal_doc").modal('show')
    $("#id_doc").val(id)
    $("#nombre_doc").val('')
    $("#serie_doc").val('')
    $("#num_doc").val('')
    $("#st_doc").selectpicker('val', '')
    $.ajax({
        type: "POST",
        url: URL + 'ajustes/get_info_doc',
        data: {
            id: id
        },
        dataType: "json",
        success: function (response) {
            let data = response.data
            $("#nombre_doc").val(data.nombre)
            $("#serie_doc").val(data.serie)
            $("#num_doc").val(data.numero)
            $("#st_doc").selectpicker('val', data.estado)
        }
    });
}

$(".save").on("click", ()=>{
    console.log('aaa')
    let data = {
        id_doc : $("#id_doc").val(),
        nombre: $("#nombre_doc").val().trim(),
        serie : $("#serie_doc").val().trim(),
        numero: $("#num_doc").val().trim(),
        estado: $("#st_doc").selectpicker('val')
    }
    console.log(data)
    if(data.id_doc != '' && data.nombre != '' && data.serie && data.numero != '' && data.estado != ''){
        $.ajax({
            type: "POST",
            url: URL + 'ajustes/save_doc_cfg',
            data: data,
            dataType: "json",
            success: function (response) {
                if(response.code == 1){
                    SoundNotifier.Okay();
                    $("#modal_doc").modal('hide')
                    Swal.fire({
                        title: 'Notificación',
                        html: response.msj,
                        icon:'success',
                    }).then(function(){
                    
                       lista_datos()
                    })

                }else{
                    SoundNotifier.Error();
                    $("#modal_doc").modal('hide')
                    Swal.fire({
                        title: 'Notificación',
                        html: response.msj,
                        icon:'error',
                    })                  
                }
            }
        });
    }else{
        toastr.error("Rellena todos los campos", "Error al validar")
    }
})