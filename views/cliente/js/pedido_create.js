/// <reference path="../../../core/services/notifications.js" />
/// <reference path="../../../core/services/operations.js" />
$(function () {
    ClassManager.ActiveSimpleItem('clientepedido')
});

$(".modelo_item").on("click", function (e) {
    let id = e.currentTarget.id;
    let el = document.getElementById(id);
    if ($("#modelo_seleccionado").val() == el.dataset.id_modelo) {
        $("#" + id).removeClass("s");
        actualiza_vuelto();
        $("#modelo_seleccionado").val('');
        lista_tallas();


    } else {
        $("#total_compra").val();
        $("#precio_modelo").val(el.dataset.precio);

        $(".modelo_item").removeClass("s");
        $("#" + id).addClass("s")
        $("#modelo_seleccionado").val(el.dataset.id_modelo);
        actualiza_vuelto();
        lista_tallas();

    }

})

let tallas = []
let valid_values = [];

$(function () {
    for (let x = 1; x <= 240; x++) {
        if (multiple(x, 6)) {
            valid_values.push(x);
        }
        if (multiple(x, 7)) {
            valid_values.push(x);
        }
        if (multiple(x, 14)) {
            valid_values.push(x);
        }
    }
    valid_values = new Set(valid_values);
    valid_values = [...valid_values];
    $("#pago_monto").inputmask('decimal', {});
    $("#cantidad").mask('00000');
    $.ajax({
        type: "POST",
        url: URL + 'service/get_nombre_cliente',
        data: {
            id_cliente1: $("#id_cliente_1").val(),
        },
        dataType: "json",
        success: function (response) {
            $("#nombre_cliente_1").val(response.data.cliente1.nombre)
        }
    });

});
$(".money-shortcut").on("click", function (e) {
    let id = e.currentTarget.id;
    let el = document.getElementById(id);
    $("#pago_monto").val(el.dataset.monto);
    actualiza_vuelto();
})
$("#pago_monto").on("keyup", function (e) {
    actualiza_vuelto();
})
$("#pago_monto").on("blur", function (e) {
    actualiza_vuelto();
})
function actualiza_vuelto() {
    if (tallas.length > 0 && $("#modelo_seleccionado").val() != "") {
        let monto_cliente = $("#pago_monto").val();
        let monto_total = $("#total_compra").val();
        if (monto_cliente != '' && monto_total != '') {
            monto_cliente = parseFloat($("#pago_monto").val());
            monto_total = parseFloat($("#total_compra").val());
            let resp = parseFloat(monto_total - monto_cliente);
            let respuesta = resp > 0 ? 'Faltan ' + Math.abs(resp).toFixed(2) + ' Soles' : resp == 0 ? 'No sobra nada' : 'Sobran ' + Math.abs(resp).toFixed(2) + ' Soles'
            $("#vuelto").val(respuesta)
        } else {
            $("#vuelto").val('Ingresa una cantidad')
        }
    }
}

$(".tallas").on('click', () => {
    $("#tabla_tallas").modal('show');
    lista_tallas();
})
function lista_tallas() {
    if (tallas.length > 0) {
        if ($("#modelo_seleccionado").val() != "") {
            let precio_unitario = parseFloat($("#precio_modelo").val());
            let cantidad_total = 0;
            tallas.forEach((element, index, array) => {
                cantidad_total = +cantidad_total + +element.cantidad;
            })
            let total = parseFloat(cantidad_total * precio_unitario).toFixed(2);
            $("#total_compra").val(total)
            $("#btn1").html(parseFloat(total).toFixed(2));
            let btn = document.getElementById("btn1");
            btn.dataset.monto = total;
        } else {
            $("#total_compra").val('0.00')

        }
        $("#tallas").empty();
        for (let i of tallas) {
            $("#tallas").append(`
        <tr>
            <td>${i.talla}</td>
            <td>${i.cantidad}</td>
        </tr>
        `)
        }
    } else {
        $("#total_compra").val('0.00')
    }
}
$(".make_process").on("click", function (e) {
    if (tallas.length > 0) {
        if ($("#modelo_seleccionado").val() != "") {
            let sum = 0;
            tallas.forEach((element, index, array) => {
                sum = +parseInt(element.cantidad) + +sum;
            })
            if (sum <= 240) {

                let doc_verification = false;
                valid_values.forEach((element, index, array) => {
                    if (element == sum) {
                        doc_verification = true;
                    }
                })
                if (doc_verification == true || sum == 7) {
                    let data = {
                        tallas: tallas,
                        total_compra: $("#total_compra").val(),
                        observaciones: $("#observaciones").val(),
                        id_modelo: $("#modelo_seleccionado").val(),
                        color: $("#color").val(),
                        id_cliente: $("#id_usu").val()
                    }
                    Swal.fire({
                        title: 'Mensaje',
                        html: 'Necesitamos confimación para crear el pedido, verifica que todos los datos estén correctos, una vez hecho el pedido, no se podrá editar.<br><h2>¿Deseas confirmar la operación?</h2>',
                        icon: 'question',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        backdrop: '#4bb0e3',
                        showCancelButton: true,
                        cancelButtonText: 'Cancelar operación',
                        confirmButtonText: 'Confirmar operación',
                        showLoaderOnConfirm: true,
                        preConfirm: function () {
                            return new Promise(function (resolve) {
                                $.ajax({
                                    type: "POST",
                                    url: URL + 'cliente/crea_pedido',
                                    data: data,
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
                                                window.location.replace(URL + "cliente/mis_pedidos");
                                            })
                                        } else {
                                            SoundNotifier.Error();
                                            Swal.fire({
                                                title: 'Notificación',
                                                html: response.msj,
                                                icon: 'error'
                                            })
                                        }
                                    })
                                    .fail(function () {
                                        Swal.fire('Oops...', 'Problemas con la conexiÃ³n a internet!', 'error');
                                    });
                            });
                        }
                    })
                } else {
                    SoundNotifier.Error();
                    Toast.fire({
                        title: 'Error',
                        html: 'La suma de las cantidades tiene que ser multiplo de 6',
                        icon: 'error'
                    })
                }
            } else {
                SoundNotifier.Error();
                Toast.fire({
                    title: 'Error',
                    html: 'Máximo 240 unidades',
                    icon: 'error'
                })
            }
        } else {
            SoundNotifier.Error();
            Toast.fire({
                title: 'Error',
                html: 'Selecciona un modelo para poder proseguir',
                icon: 'error'
            })
        }
    } else {
        SoundNotifier.Error();
        Toast.fire({
            title: 'Error',
            html: 'Tienes que agregar al menos un conjunto de tallas.',
            icon: 'error'
        })
    }
})
$(".close").on('click', () => {
    $("#tabla_tallas").modal('hide');
})
$(".second_close").on('click', () => {
    $("#modal_nueva").modal('hide');
})
$("#modal_nueva").on('hidden.bs.modal', () => {
    $("#tabla_tallas").modal('show');
})
$(".more_talla").on('click', () => {
    $("#tabla_tallas").modal('hide');
    $("#modal_nueva").modal('show');
})
$(".save_talla").on('click', () => {
    let data = {
        talla: $("#talla").val(),
        cantidad: parseInt($("#cantidad").val())
    }
    if (data.talla != '' && !Number.isNaN(data.cantidad)) {
        inserta_tallas(data)
    } else {
        SoundNotifier.Error();
        Toast.fire({
            title: 'Error',
            html: 'Rellena todos los campos',
            icon: 'error'
        })
    }
})
function inserta_tallas(data) {
    let isInsert = false
    if (tallas.length > 0) {
        tallas.forEach((element, index, array) => {
            if (element.talla == data.talla) {
                tallas[index].cantidad = +tallas[index].cantidad + +parseInt(data.cantidad);
                isInsert = true;
            } else {
                if (isInsert == false) {
                    tallas.push(data);
                }
            }
        })
    } else {
        tallas.push(data);
    }
    SoundNotifier.Okay();
    Toast.fire({
        title: 'Talla agregada',
        html: 'Has agregado la talla correctamente',
        icon: 'success'
    })
    $("#tabla_tallas").modal('show');
    $("#modal_nueva").modal('hide');
    lista_tallas();
    $("#talla").val('')
    $("#cantidad").val('')
}