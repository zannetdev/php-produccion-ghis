$(function () {
    ClassManager.ActiveSimpleItem('pedidos');
});
let temp = -1;
class InterfazPedidos{
    static getPedidos(){
        $.ajax({
            type: "POST",
            url: URL + 'service/get_pedidos',
            dataType: "json",
            success: function (response) {
                if(temp != response.data.length){
                    $("#pedidos_container").empty();
                    temp = response.data.length;
                    if(response.data.length > 0){
                        temp = response.data.length;
                        for(let x of response.data){
                            $("#pedidos_container").append(`${Component.PedidoAccordion(x.id_pedido, x.diseño, x.fecha, x.cliente, x.estado)}`)
                        }
                    }else{
                        $("#pedidos_container").append(Component.EmptyMessage('No hay ningun pedido por ahora, favor de checar más tarde!'))
                    }
                }
            }
        });
    }
}

//FUNCION AUTOEJECUTABLE
(()=>{
    InterfazPedidos.getPedidos();
    setInterval(() => { 
        InterfazPedidos.getPedidos();
    }, 10000);
})();

var crear_proceso = (id) =>{
    Swal.fire({
        title: 'Mensaje',
        html: 'Necesitamos confimación para mandar a producción este pedido.<br><h2>¿Deseas confirmar la operación?</h2>',
        icon: 'question',
        allowOutsideClick: false,
        allowEscapeKey: false,
        backdrop: '#282829',
        showCancelButton: true,
        cancelButtonText: 'Cancelar operación',
        confirmButtonText: 'Confirmar operación',
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return new Promise(function (resolve) {
                $.ajax({
                    type: "POST",
                    url: URL + 'pedidos/crear_proceso',
                    data: {
                        id: id
                    },
                    dataType: "json",
                })
                    .done(function (response) {
                        if (response.code == 1) {
                            SoundNotifier.Done();
                            Swal.fire({
                                title: 'Notificación',
                                html: response.msj,
                                icon: 'success'
                            }).then(() => {
                                InterfazPedidos.getPedidos();
                            })
                        } else {
                            SoundNotifier.Error();
                            Swal.fire({
                                title: 'Notificación',
                                html: response.msj,
                                icon: 'error'
                            })
                            InterfazPedidos.getPedidos();
                        }
                    })
                    .fail(function () {
                        Swal.fire('Oops...', 'Problemas con la conexiÃ³n a internet!', 'error');
                    });
            });
        }
    })
}
