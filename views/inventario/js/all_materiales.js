$(function () {
    ClassManager.ActiveMenuItem('inventario', 'inv_material');
    GetCatgModels();
    lista_material('%');
});

function GetCatgModels(){
    $.ajax({
        type: "POST",
        url: $("#url").val() + 'inventario/get_inventario_catg',
        dataType: "json",
        success: (response)=>{
            $('.list-categorias').empty();
            $(".list-categorias").append(`<div class="col-10 text-left pt-2">
            <a href="javascript: lista_material('%')">
                <span>TODOS</span>
            </a>  
        </div>`)
            if(response.data.length > 0){
                for(let x of response.data){
                    $('.list-categorias').append(`
                    <div class="col-10 text-left pt-2">
                        <a href="javascript: lista_material('${x.id_categoria}')">
                            <span>${x.nombre}</span>
                        </a>  
                    </div>
                   
                    `); 
                }
            }else{
               $(".list-categorias").append( Component.EmptyMessage('No hay ninguna categoría registrada, favor de registrar una.'))
            }
        }
    });
}
function edita_categoria(id, nombre){
    console.log('a')
}
function edita_material(id_material){

}
function lista_material(id_c){
    function filterGlobal () {
        $('#table').DataTable().search( $('.global_filter').val()).draw();
    }
    let id = id_c;
    var table = $('#table').DataTable( {
        dom: 'Bfrtip',
        "ajax":{
            "url": $("#url").val() +  "inventario/get_inventario",
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
                      return `<b>${data.nombre}</b>`;
                    
                }},
                {"data": "fecha_agregado", "render": function (data, type, row) {
                      
                    return '<i class="mdi mdi-calendar"></i> ' + moment(data).format('DD-MM-Y')
                        + '<br><span class="font-12"><i class="mdi mdi-clock-time-eleven-outline"></i> ' + moment(data).format('h:mm A') + '</span>';
                        
                }},
                {"data":null,"render": function ( data, type, row ) {
                    if(data.estado == 'a'){
                        return '<button class="btn btn-success  btn-rounded" disabled>Activo</button>'
                    }else{
                        return '<button class="btn btn-danger btn-rounded" disabled>Inactivo</button>'
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
                  <li><a class="dropdown-item" href="javascript:delete_(${data.id_insumo});"><i class="mdi mdi-trash-can"></i>  Eliminar</a></li>
                    <li><a class="dropdown-item" href="javascript:edita_material(${data.id_insumo}, '${data.nombre}','${data.id_categoria}','${data.estado}');"><i class="mdi mdi-pencil"></i>  Editar</a></li>
                  </ul>
                </div>`
                }},
            ],
    } );
    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
        
     });
}

const delete_ = (id)=> { 
    Delete : {
        $.ajax({
            type: "POST",
            url: $("#url").val() + 'inventario/delete/' + id,
            dataType: "json",
            success: function (response) {
                if(response.code == 1){
                    Swal.fire({
                        title:'Correcto',
                        html: response.msj,
                        icon: 'success',
                        backdrop: '#2bff5d',
                    }).then(()=>{
                        lista_material('%');
                    })
                }else{
                    Swal.fire({
                        title: 'Error',
                        html: response.msj,
                        icon:'error'
                    }).then(()=>{
                        lista_material('%');
                    })
                }
            }
        });
    }
}

$("#btn_ctn").on("click", function(e){
    show_form();
    reset_values();
   
})
function reset_values(){
    $("#nombre_mat").val('')
    $('#catg_mat').val(1);
    $('#est_mat').val(1);
    $("#id_material").val('');
    select_option("#catg_mat", '');
    select_option('#est_mat', '');  
    return null;
}
function edita_material(id, nombre, id_categoria, estado){
    reset_values();
    show_form();
    $("#id_material").val(id);
    $("#nombre_mat").val(`${nombre}`);
    select_option("#catg_mat", id_categoria);
    select_option('#est_mat', estado);  
}
$(".cancel_save").on('click', function(){
   show_card_catg();
   reset_values();
})

$(".save").on('click', function(){
    let data = {
        nombre : $("#nombre_mat").val(),
        id_categoria : $("#catg_mat").selectpicker('val'),
        estado : $("#est_mat").selectpicker('val'),
        id_insumo : $("#id_material").val()
    }
    if(data.estado != "" && data.id_categoria != "" && data.nombre != ""){
        $.ajax({
            type: "POST",
            url: $("#url").val() + "inventario/crud_inventario",
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
                        lista_material(data.id_categoria);
                        reset_values();
                        show_card_catg();
                    })
                }else{
                    Swal.fire({
                        title: 'Error',
                        html: response.msj,
                        icon:'error'
                    }).then(()=>{
                        lista_material(data.id_categoria);
                        reset_values();
                        show_card_catg();

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
function show_form(){
    $(".card_ctg").hide('0', function(){
        $(".card_data").show('0');
    });
}
function show_card_catg(){
    $(".card_data").hide('0', function(){
        $(".card_ctg").show('0');
    });
}
