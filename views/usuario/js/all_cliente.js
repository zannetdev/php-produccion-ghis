$(function () {
    ClassManager.ActiveMenuItem('empleados', 'emp_clientes')
    lista_datos();
});

function lista_datos(){
    function filterGlobal () {
        $('#table').DataTable().search( $('.global_filter').val()).draw();
    }
    var table = $('#table').DataTable( {
        dom: 'Bfrtip',
        "ajax":{
            "url": $("#url").val() +  "usuario/get_clientes",
            "method": "POST"
        },
        "destroy": true,
        "responsive": true,
        "dom": "tip",
        "bSort": true,
        "order": [[0,"desc"]],
         "columns":[
                {"data":null,"render": function ( data, type, row ) {
                      return `<b>${data.doc}</b>`;
                    
                }},
                {"data":null,"render": function ( data, type, row ) {
                      return `<b>${data.nombre_completo}</b>`;
                    
                }},
                {"data":null,"render": function ( data, type, row ) {
                    if(data.genero == 'M'){
                        return '<i class="mdi mdi-account" style="color: blue;"></i>'
                    }else{
                        return '<i class="mdi mdi-account" style="color: pink;"></i>'
                    }
                }},  
                {"data":null,"render": function ( data, type, row ) {
                      return `<b>${data.email}</b>`;
                    
                }},
                {"data":null,"render": function ( data, type, row ) {
                      return `<b>${data.telefono}</b>`;
                    
                }},
                {"data":null,"render": function ( data, type, row ) {
                      return `<b>${data.direccion}</b>`;
                    
                }},
                {"data":null,"render": function ( data, type, row ) {
                      return `<b>${data.fecha_registro}</b>`;
                    
                }},
                {"data":null,"render": function ( data, type, row ) {
                      return `<b>${data.fecha_actividad}</b>`;
                    
                }},
                {"data":null,"render": function ( data, type, row ) {
                    if(data.estado == 'a'){
                        return `<button class="btn btn-success btn-rounded" onclick="update_status(${data.id_cliente})">Activo</button>`
                    }else{
                        return `<button class="btn btn-danger btn-rounded"  onclick="update_status(${data.id_cliente})">Inactivo</button>`
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
                      <li><a class="dropdown-item" href="${$("#url").val() + "usuario/usuario_process/edita/cliente/"}${data.id_cliente}"><i class="mdi mdi-pencil"></i>  Editar</a></li>
                    </ul>
                  </div>`
                  }},

            ],
    } );
    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal(); 
     });
}

var update_status = (id_usu, tbl_name = 'tm_cliente') => {
    $.ajax({
        type: "POST",
        url: $("#url").val() + "usuario/update_status",
        data: {
            id_usu: id_usu,
            tbl_name: tbl_name
        },
        success: ()=>{
            lista_datos();
        }
    });
}