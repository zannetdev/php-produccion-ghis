/// <reference path="../../../logic/js/components.js" />
/// <reference path="../../../logic/js/active_class.js" />

$(function () {
    ClassManager.ActiveSimpleItem('trabajos')
});

var listar = () => {
    $.ajax({
        type: "POST",
        url: URL + 'area/mis_pedidos',
        dataType: "json",
        success: function (response) {
            console.log(response)
            $("#pedidos").empty();
            if(!response.code){
                if(response.data.length > 0){
                    for(let x of response.data){
                        $("#pedidos").append(Component.ProcesoUsuario(x.id_detalle, x.fecha_inicio, x.modelo.cod_diseño));
                    }
                    $("#pedidos").append(`<br><br>`);
                    $("#pedidos").append(`<br><br>`);
                }else{
                    $("#pedidos").append(Component.EmptyMessage('Sin trabajos aún, acepta uno en area de producción'))
                }
            }else{
                $("#pedidos").append(Component.EmptyMessage(response.msj))
            }
        }
    });
}
$(function () {
    listar()
});
