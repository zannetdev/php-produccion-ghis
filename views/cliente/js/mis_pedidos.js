$(function () {
    ClassManager.ActiveSimpleItem('mispedidos')
});
$(document).ready(function () {
    lista_datos();
});
function lista_datos() {
    function filterGlobal() {
        $('#table').DataTable().search($('.global_filter').val()).draw();
    }
    var table = $('#table').DataTable({

        dom: 'Bfrtip',
        "ajax": {
            "url": URL + "cliente/mispedidos",
            "method": "POST"
        },
        "destroy": true,
        "responsive": true,
        "dom": "tip",
        "bSort": true,
        "order": [[0, "desc"]],
        "columns": [
            {
                "data": "fecha", "render": function (data, type, row) {
                    return '<i class="mdi mdi-calendar"></i> ' + moment(data).format('DD-MM-Y')
                        + '<br><span class="font-12"><i class="mdi mdi-clock-time-eleven-outline"></i> ' + moment(data).format('h:mm A') + '</span>';

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    if(data.pago.metodo_pago == '5'){                        let restante = data.pago.total - data.pago.monto;
                        if(data.pago.credito.historial) {
                            for(let x of data.pago.credito.historial){
                                restante = restante - x.monto;
                            }
                        }
                        if(restante > 0){
                            return `<b>S/. ${parseFloat(restante).toFixed(2)}</b>`;
                        }else{
                            return `<b>S/. 0.00</b>`;
                        }
                    }else{
                        return `<b>S/. 0.00</b>`;

                    }
                   
                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `<b>S/. ${(data.pago.total)}</b>`;

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    if (data.pago.estado == 'pc') {
                        return `<button class="btn btn-outline-dark btn-rounded">Por Confirmar</button>`
                    } else {
                        if (data.estado == 'r') {
                            return `<button class="btn btn-outline-danger btn-rounded">Cancelado</button>`
                        } else {
                            return `<button class="btn btn-outline-dark btn-rounded">Pagado</button>`
                        }
                    }
                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    if (data.estado == 'pc') {
                        return `<button class="btn btn-outline-dark btn-rounded">Por Confirmar</button>`
                    } else {
                        if (data.estado == 'r') {
                            return `<button class="btn btn-outline-danger btn-rounded">Cancelado  por error de pago</button>`
                        } else {
                            return `<button class="btn btn-outline-dark btn-rounded">Confirmado</button>`
                        }
                    }
                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    if (data.pago.foto == 'ps' || data.pago.foto == '' || data.pago.foto == null){
                        return `<button class="btn btn-outline-info btn-rounded"onclick="subir_foto(${data.id_pedido}, ${data.pago.id_pago});"><i class="mdi mdi-cloud-upload-outline">  Subir Foto</i></button>`
                    }else{
                        if (data.pago.estado == 'pc') {
                            return `<button class="btn btn-outline-dark btn-rounded">Por Confirmar</button>`
                        } else {
                            if (data.estado == 'r') {
                                return ``
                            } else {
                                return `<a href="${URL}cliente/imprime_pedido/${data.id_pedido}" target="_blank" class="btn btn-outline-dark btn-rounded"><i class="mdi mdi-printer">  Imprimir</i></a>
                                <a href="${URL}detalle/pedido/${data.id_pedido}" target="_blank" class="btn btn-outline-dark btn-rounded"><i class="mdi mdi-eye">  Detalle</i></a>
                                `
                            }
                        }
                    } 
                }
            },

        ],

    });
    $('input.global_filter').on('keyup click', function () {
        filterGlobal();

    });

}

function subir_foto(id_pedido, id_pago) {
    $("#modal_imagen").modal("show");
    $("#id_pedido").val(id_pago);
}
$("#modal_imagen").on("hidden.bs.modal", function () {
    $("#id_pedido").val('');
    if ($("#id_temp").val() != '') {
        $.ajax({
            type: "POST",
            url: URL + 'service/delete_image',
            data: {
                id: $("#id_tmp").val(),
            },
            dataType: 'json',
            success: function (response) {
                console.log(response)
            }
        });
    }
    $("#id_temp").val('');
})
$(".close").on("click", function () {
    $("#modal_imagen").modal("hide");
})
$(".save").on("click", function () {
    if ($("#id_temp").val() != '') {
        $.ajax({
            type: "POST",
            url: URL + 'service/cambia_imagen_pago',
            data: {
                id_tmp: $("#id_tmp").val(),
                id_pago: $("#id_pedido").val()
            },
            dataType: "json",
            success: function (response) {
                console.log(response)
                $("#modal_imagen").modal("hide");
                if (response.code == 1) {
                    SoundNotifier.Done()
                    $("#id_tmp").val('')
                    window.location.reload();
                    Toast.fire({
                        title: 'Notificación',
                        html: response.msj,
                        icon: 'success'
                    }).then(() => {
                    })
                } else {
                    Toast.fire({
                        title: 'Error',
                        html: response.msj,
                        icon: 'error'
                    })
                }
            }
        });
    } else {
        SoundNotifier.Done();
        Toast.fire({
            title: 'Sube una foto por favor',
            icon: 'error'
        })
    }
})
let myDropzone = new Dropzone("form#my-dropzone", {
    url: URL + "service/sube_comprobante",
    paramName: 'file',
    addRemoveLinks: true,
    dictRemoveFileConfirmation: 'Estás seguro de quitar el archivo de la lista?',
    maxFiles: 1,
    acceptedFiles: "image/jpeg,image/png,image/jpg",
    maxFilesize: 2,
    complete: (e) => {
        $("#id_tmp").val('')
        let json_response = JSON.parse(e.xhr.response);
        if (json_response.code == -10) {
            $("#modal_imagen").modal("hide");
            Swal.fire({
                title: 'Error al subir',
                html: json_response.msj,
                icon: 'error'
            })
        } else {
            if (json_response.data) {
                $("#id_tmp").val(json_response.data)
            }
        }
    },
    removedfile: function (file) {
        $.ajax({
            type: "POST",
            url: URL + 'service/delete_image',
            data: {
                id: $("#id_tmp").val(),
            },
            dataType: 'json',
            success: function (response) {
                console.log(response)
                if (response.code == 1) {
                    SoundNotifier.Done()
                    file.previewElement.remove();
                    $("#id_tmp").val('')
                    Toast.fire({
                        title: 'Notificación',
                        html: response.msj,
                        icon: 'success'
                    }).then(() => {
                    })
                } else {
                    Toast.fire({
                        title: 'Error al eliminar',
                        html: response.msj,
                        icon: 'error'
                    })
                }
            }
        });

    },

});

