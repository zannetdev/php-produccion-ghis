/// <reference path="../../../logic/js/components.js" />

$(function () {
    ClassManager.ActiveSimpleItem('pedidospc');
});
let temp = -1;
class InterfazPedidos {
    static getPedidos() {
        $.ajax({
            type: "POST",
            url: URL + 'service/get_pc',
            dataType: "json",
            success: function (response) {
                console.log(response)
                $("#pedidos_container").empty();
                if (response.data.length > 0) {
                    temp = response.data.length;
                    let cont_sin = 0;
                    let cont_con = 0;
                    for (let x of response.data) {
                        let nombre = x.cliente;
                        $("#pedidos_container").append(`${Component.PedidoAccordion(x.id_pedido, x.diseño, x.fecha, x.cliente, x.estado)}`)
                    }

                } else {
                    $("#pedidos_container").append(Component.EmptyMessage('Pedidos no existentes'))
                }
            }
        });
    }
}
$(".actualiza").on("click", () => {
    InterfazPedidos.getPedidos();
})
$(function () {
    InterfazPedidos.getPedidos();
    $(".pedido_detalle").append(Component.EmptyMessage('Selecciona un pedido de la cola para poder ver sus datos'))
});
function ver(id_area, area, nombre) {
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

function detalle(id) {
    $.ajax({
        type: "POST",
        url: URL + 'service/get_info_pedido/' + id,
        dataType: "json",
        success: function (response) {
            let html;
            if (response.data.pago.foto == 'ps') {
                let html = `
                <div class="row justify-center">
                    <h4>No ha subido ninguna imagen</h4>
                    <button class="btn btn-outline-primary col-12 mb-2" onclick="aceptar(${response.data.id_pedido})">Mandar a pedidos</button>
                    <button class="btn btn-outline-warning col-12 mb-2" onclick="denegar(${response.data.id_pedido})">Denegar</button>
                </div>
                `
                $("#pedido_detalle").empty();
                $("#pedido_detalle").append(html);
            } else {
                let html = `
                <div class="row justify-center">
                    <img class="img-fluid pb-2" src="${response.data.pago.foto}">
                    <button class="btn btn-outline-primary col-12 mb-2" onclick="aceptar(${response.data.id_pedido})">Mandar a pedidos</button>
                    <button class="btn btn-outline-warning col-12 mb-2" onclick="denegar(${response.data.id_pedido})">Denegar</button>
                </div>
                </div>
                `
                $("#pedido_detalle").empty();
                $("#pedido_detalle").append(html);
            }
        }
    });
}
function aceptar(id) {
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
                    url: URL + 'pedidos/cambia_estado_pedido/' + id + '/c',
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
                               window.location.reload();
                            })
                        } else {
                            SoundNotifier.Error();
                            Swal.fire({
                                title: 'Notificación',
                                html: response.msj,
                                icon: 'error'
                            })
                            window.location.reload();
                        }
                    })
                    .fail(function () {
                        Swal.fire('Oops...', 'Problemas con la conexiÃ³n a internet!', 'error');
                    });
            });
        }
    })

}
function denegar(id) {
    Swal.fire({
        title: 'Mensaje',
        html: 'Necesitamos confimación para denegar este pedido.<br><h2>¿Deseas confirmar la operación?</h2>',
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
                    url: URL + 'pedidos/cambia_estado_pedido/' + id + '/r',
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
                                window.location.reload();
                            })
                        } else {
                            SoundNotifier.Error();
                            Swal.fire({
                                title: 'Notificación',
                                html: response.msj,
                                icon: 'error'
                            })
                            window.location.reload();
                        }
                    })
                    .fail(function () {
                        Swal.fire('Oops...', 'Problemas con la conexiÃ³n a internet!', 'error');
                    });
            });
        }
    })

}