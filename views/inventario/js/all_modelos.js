$(function () {
    ClassManager.ActiveMenuItem('inventario', 'inv_modelos');
    GetCatgModels();
    lista_modelos('%');
});

function GetCatgModels(){
    $.ajax({
        type: "POST",
        url: $("#url").val() + 'inventario/get_catg_modelos',
        dataType: "json",
        success: (response)=>{
            $('.list-categorias').empty();
            $(".list-categorias").append(`<div class="col-10 text-left pt-2">
            <a href="javascript: lista_modelos('%')">
                <span>TODOS</span>
            </a>  
        </div>`)
            if(response.data.length > 0){
                for(let x of response.data){
                   if(x.estado == 'a'){
                    $('.list-categorias').append(`
                    <div class="col-10 text-left pt-2">
                        <a  href="javascript: lista_modelos('${x.id_categoria}')">
                            <span>${x.nombre.toUpperCase()}</span>
                        </a>  
                    </div>
                    <div class="col-1 text-left" style="cursor:hand; pt-2">
                        <a href="javascript: edita_categoria(${x.id_categoria}, '${x.nombre}', '${x.estado}')"><i class="mdi mdi-pencil"></i></a>
                    </div>
                    `); 
                   }else{
                    $('.list-categorias').append(`
                    <div class="col-10 text-left pt-2">
                        <a href="javascript: lista_modelos('${x.id_categoria}')">
                            <span>${x.nombre.toUpperCase()}</span>
                        </a>  
                    </div>
                    <div class="col-1 text-left" style="cursor:hand; pt-2">
                        <a href="javascript: edita_categoria(${x.id_categoria}, '${x.nombre}', '${x.estado}')"><i class="mdi mdi-pencil"></i></a>
                    </div>
                    `); 
                   }
                }
            }else{
               $(".list-categorias").append( Component.EmptyMessage('No hay ninguna categoría registrada, favor de registrar una.'))
            }
        }
    });
}
function lista_modelos(id_c){
    let id = id_c;
    function filterGlobal () {
       $('#table').DataTable().search( $('.global_filter').val()).draw();
    }
    var table = $('#table').DataTable( {
        dom: 'Bfrtip',
        "ajax":{
            "url": $("#url").val() +  "inventario/get_modelos",
             "data": {
                catg_id : id,
            },
            "method": "POST"
        },
        "destroy": true,
        "responsive": true,
        "dom": "tip",
        "bSort": true,
        "order": [[0,"desc"]],
         "columns":[
                {"data":null,"render": function ( data, type, row ) {
                    if(data.imagen != 'default.png'){
                          return `<img class="img-fluid" src="${data.imagen}" height="20%" width="20%">`;
                    }else{
                          return `<img class="img-fluid" src="${$("#url").val()}public/assets/img/default.png" height="20%" width="20%">`;
                    }
                }},
                {"data": "fecha", "render": function (data, type, row) {
                      
                    return '<i class="mdi mdi-calendar"></i> ' + moment(data).format('DD-MM-Y')
                        + '<br><span class="font-12"><i class="mdi mdi-clock-time-eleven-outline"></i> ' + moment(data).format('h:mm A') + '</span>';
                        
                }},
                {"data":null,"render": function ( data, type, row ) {
                      return `<b>S/. ${data.precio}</b>`;
                    
                }},
                {"data":null,"render": function ( data, type, row ) {
                      return ` <b> # ${data.cod_diseño}</b>`;
                }},
                {"data":null,"render": function ( data, type, row ) {
                    if(data.estado == 'a'){
                        return '<button class="btn btn-success btn-rounded" onclick="update_status('+data.id_modelo+')">Activo</button>'
                    }else{
                        return '<button class="btn btn-danger btn-rounded" onclick="update_status('+data.id_modelo+')">Inactivo</button>'
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
                      <li><a class="dropdown-item"  href="${$("#url").val() + 'inventario/crud_modelo/edita/' + data.id_modelo}"><i class="mdi mdi-pencil"></i>  Editar</a></li>
                      <li><a class="dropdown-item"  target="_blank" href="${$("#url").val() + 'inventario/imprimir/' + data.id_modelo}"><i class="mdi mdi-printer"></i>  Imprimir</a></li>
                    </ul>
                  </div>`
                }},
              
            ],
    } );
    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
     });
}
function show_form(){
    $(".card_catg").hide('0', function(){
        $(".card_data").show('0');
    });
}
function show_card_catg(){
    $(".card_data").hide('0', function(){
        $(".card_catg").show('0');
    });
}
$("#btn_ctn").on("click", function(e){
    show_form();
    reset_values();
   
})
function reset_values(){
    $("#nombre_catg").val('')
    $('#est_mat').val(1);
    $("#id_categoria").val('');
    return null;
}
function edita_categoria(id, nombre, estado){
    reset_values();
    show_form();
    $("#id_categoria").val(id);
    $("#nombre_catg").val(`${nombre}`);
    select_option('#est_mat', estado);  
}
$(".cancel_save").on('click', function(){
   show_card_catg();
   reset_values();
   
})


$(".save").on('click', function(){
    let data = {
        nombre : $("#nombre_catg").val(),
        estado : $("#est_mat").selectpicker('val'),
        id_categoria : $("#id_categoria").val()
    }
    if(data.estado != "" && data.nombre != ""){
        $.ajax({
            type: "POST",
            url: $("#url").val() + "inventario/catg_crud",
            data: data,
            dataType: "json",
            success: function (response) {
                if(response.code == 1){
                    Swal.fire({
                        title:'Correcto',
                        html: response.msj,
                        icon: 'success',
                        backdrop: '#2bff5d',
                    }).then(()=>{
                        reset_values();
                        show_card_catg();
                        GetCatgModels();
                        lista_modelos(data.id_categoria);
                    })
                }else{
                    Swal.fire({
                        title: 'Error',
                        html: response.msj,
                        icon:'error'
                    }).then(()=>{
                        reset_values();
                        show_card_catg();
                        lista_modelos(data.id_categoria);

                    })
                }
            }
        });
    }else{
        Toast.fire({
            title: 'Campos incompletos', 
            html: 'Favor de rellenar todos los campos', 
            icon: 'error'
        })
    }
})
$(".add_model").on('click', ()=>{
    window.location.replace(URL + 'inventario/crud_modelo/agrega')
})

var update_status = (filter, tbl_name = 'tm_modelo') => {
    $.ajax({
        type: "POST",
        url: URL + "service/update_status",
        data: {
            filter: filter,
            tbl_name: tbl_name
        },
        success: () => {
            lista_modelos('%');
        }
    });
}

