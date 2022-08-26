/// <reference path="../../../logic/js/components.js" />

$(function () {
    ClassManager.ActiveSimpleItem('proceso');
});
let temp = -1;
class InterfazPedidos{
    static getPedidos(){
        $.ajax({
            type: "POST",
            url: URL + 'service/get_procesos',
            dataType: "json",
            success: function (response) {
                console.log(response)
                $("#pedidos_container_con").empty();
                $("#pedidos_container_sin").empty();
                if(response.data.length > 0){
                    temp = response.data.length;
                    let cont_sin = 0;
                    let cont_con = 0;
                    for(let x of response.data){

                        let nombre = x.detalle.usuario != undefined ? x.detalle.usuario.nombre + ' ' + x.detalle.usuario.apellido_paterno + ' ' + x.detalle.usuario.apellido_materno : 'Sin encargado aún';
                        if(x.estado == 'p'){
                            cont_con = +cont_con + 1;
                            $("#pedidos_container_con").append(`${Component.ProcesoAccordion(x.id_proceso, x.detalle.modelo.cod_diseño.toUpperCase(),x.area.id_area, x.area.nombre_area, nombre )}`)
                        }else{
                            cont_sin = +cont_sin + 1;
                            $("#pedidos_container_sin").append(`${Component.ProcesoAccordion(x.id_proceso, x.detalle.modelo.cod_diseño.toUpperCase(),x.area.id_area, x.area.nombre_area, nombre )}`)
                        }
                    }
                    if(cont_sin == 0){
                        $("#pedidos_container_sin").append(Component.EmptyMessage('No hay ningun pedido por ahora, favor de checar más tarde!'))
                    }
                    if(cont_con == 0){
                        $("#pedidos_container_con").append(Component.EmptyMessage('No hay ningun pedido por ahora, favor de checar más tarde!'))
                    }
                }else{
                }
            }
        });
    }
}
$(".actualiza").on("click",()=>{
    InterfazPedidos.getPedidos();
})
$(function () {
    InterfazPedidos.getPedidos();
    $(".pedido_detalle").append(Component.EmptyMessage('Selecciona un pedido de la cola para poder ver sus datos'))
});
function ver(id_area, area, nombre){
    $(".pedido_detalle").empty();
    let percent = id_area * 100 / 6;
    let html = `<img class="img-fluid" alt="" src="${URL}public/assets/img/work.gif">
    <div class="progress">
      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: ${Math.round(percent)}%"></div>
    </div>
    <h5 class="text-center pt-2">Estamos trabajando en tu pedido</h5>
    <p>Detalles</p>
    Area de producción actual: ${area} <br>
    Encargado: ${nombre} <br></br>`

    $(".pedido_detalle").append(`
        ${html}
    `);
}

