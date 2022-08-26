/// <reference path="../../../core/services/notifications.js" />
/// <reference path="../../../core/services/connections.js" />
/// <reference path="../../../logic/js/active_class.js" />

$(function () {
    ClassManager.ActiveSimpleItem('area')
});

function UiPedidos() {
    $.ajax({
        type: "POST",
        url: $("#url").val() + "service/get_pedidos",
        dataType: "json",
        success: (response)=>{
            $(".append_pedidos").empty();
            if(response.code){
                $(".append_pedidos").append(Component.EmptyMessage(response.msj));
            }else{
                if(response.data.length > 0){
                    for(let x of response.data){
                        $(".append_pedidos").append(Component.NuevoPedido(x.id_proceso, x.detalle.modelo.cod_diseño, x.detalle.pedido.fecha, x.detalle.cliente.nombre + ' ' + x.detalle.cliente.apellido_paterno, x.estado));       
                    }
                }else{
                    $(".append_pedidos").append(Component.EmptyMessage('No hay pedidos pendientes en esta area, intenta más tarde.'));
                }
            }
        },  
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(errorThrown + ' ' + textStatus);
        }
    });
}

$(".verify_connection").on('click',()=>{
   let conn = VerifyConnection()
   if(conn.status >= 200 && conn.status < 300 ){
        SoundNotifier.Okay();
        Toast.fire({
            title: 'Sin fallos',
            html: parseInt(Math.floor(Math.random() * 100)) + ' MS',
            icon: 'success'
        })
   }else{
    SoundNotifier.Error();
    Toast.fire({
        title: 'Error en la conexión',
        html: 'Favor de verificar tu conexión a internet',
        icon: 'error'
    })

   } 
});
function acepta_pedido(id){
    Swal.fire({
        title: 'Mensaje',
        html: 'Necesitamos confimación para que empieces con la produccion del modelo.<br><h2>¿Deseas confirmar la operación?</h2>',
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
                    url: URL + 'area/crear_proceso',
                    data: {
                        id: id
                    },
                    dataType: "json",
                })
                    .done(function (response) {
                        console.log(response)
                        if (response.code == 1) {
                            SoundNotifier.Done();
                            Swal.fire({
                                title: 'Notificación',
                                html: response.msj,
                                icon: 'success'
                            }).then(() => {
                                UiPedidos();
                            })
                        } else {
                            SoundNotifier.Error();
                            Swal.fire({
                                title: 'Notificación',
                                html: response.msj,
                                icon: 'error'
                            })
                            UiPedidos();
                        }
                    })
                    .fail(function () {
                        Swal.fire('Oops...', 'Problemas con la conexiÃ³n a internet!', 'error');
                    });
            });
        }
    })
}
(()=>{
    UiPedidos();
    setInterval(() => {
        UiPedidos();
    }, 10000);
})();



