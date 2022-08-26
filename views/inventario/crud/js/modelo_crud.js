
/// <reference path="../../../../core/services/notifications.js" />
/// <reference path="../../../../logic/js/functions_helpers.js" />



$(function () {
    ClassManager.ActiveMenuItem('inventario', 'inv_modelos');
    $("#precio").inputmask('decimal', {});
});
(() => {
    // TODAS LAS FUNCIONES QUE SE INICIALIZAN AL CARGAR LA PÁGINA USANDO (()=>{})();
    let process = $("#process").val()
    if (process == 'edita') {
        $.ajax({
            type: "POST",
            url: URL + 'inventario/get_data_model',
            data: {
                id: $("#id_modelo").val()
            },
            dataType: "json",
            success: function (response) {
                let data = response.data;
                console.log(data);
                select_option("#cuero_1", data.cuero_1);
                select_option("#cuero_2", data.cuero_2);
                $("#capellado").val(data.capellado);
                select_option("#tela", data.tela);
                select_option("#forro_1", data.forro_1);
                select_option("#forro_2", data.forro_2);
                $("#desuaste_1").val(data.desuaste_1);
                $("#desuaste_2").val(data.desuaste_2);
                $("#pin_bordes").val(data.pintado_bordes);
                $("#empalme").val(data.marcar_empalme);
                $("#grabado").val(data.grabado);

                select_option("#aguja_1", data.aguja_1);
                select_option("#aguja_2", data.aguja_2);
                select_option("#hilo_1", data.hilo_1);
                select_option("#hilo_2", data.hilo_2);
                select_option("#hilo_drama", data.hilo_drama);
                select_option("#esponja", data.esponja);
                select_option("#chapita", data.chapita);
                $("#modelo_codigo").val(data.cod_diseño);
                $("#total_consumo_cuero").val(data.consumo_cuero_por_doc);
                $("#precio").val(data.precio);
                $("#consumo_cierre_docena").val(data.consumo_cierre_por_doc);
                $("#no_patron").val(data.n_patron);
                $("#horma").val(data.horma);
                $("#falso").val(data.falso);
                select_option("#planta", data.planta);

                select_option('#plantillo', data.plantillos);
                $("#latex").val(data.latex);
                $("#latex").val(data.preimer);
                $("#sombreado").val(data.sombreado);
                select_option("#taco", data.taco);
                $("#serie").val(data.serie);
                select_option("#id_catg", data.id_categoria);

            }
        });
    } else {

    }
})();

$('#modelo_codigo').keypress(function (e) {
    var txt = String.fromCharCode(e.which);
    if (!txt.match(/[A-Za-z0-9]/)) {
        return false;
    }
});

let myDropzone = new Dropzone("form#my-dropzone", {
    url: URL + "service/upload_image",
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

$(".save").on("click", () => {
    let data = {
        cuero_1: $("#cuero_1").selectpicker('val'),
        cuero_2: $("#cuero_2").selectpicker('val'),
        capellado: $("#capellado").val(),
        tela: $("#tela").selectpicker('val'),
        forro_1: $("#forro_1").selectpicker('val'),
        forro_2: $("#forro_2").selectpicker('val'),
        desuaste_1: $("#desuaste_1").val(),
        desuaste_2: $("#desuaste_2").val(),
        pin_bordes: $("#pin_bordes").val(),
        aguja_1: $("#aguja_1").selectpicker('val'),
        aguja_2: $("#aguja_2").selectpicker('val'),
        hilo_1: $("#hilo_1").selectpicker('val'),
        hilo_2: $("#hilo_2").selectpicker('val'),
        hilo_drama: $("#hilo_drama").selectpicker('val'),
        esponja: $("#esponja").selectpicker('val'),
        chapita: $("#chapita").selectpicker('val'),
        cod_diseno: $("#modelo_codigo").val(),
        total_consumo_cuero: $("#total_consumo_cuero").val(),
        precio: $("#precio").val(),
        marco: {
            lateral: $("#lateral").prop('checked') == true ? 'si' : 'no',
            lengua: $("#lengua").prop('checked') == true ? 'si' : 'no',
            otros: $("#otros").tagsinput('items')
        },
        consumo_cierre_docena: $("#consumo_cierre_docena").val(),
        id_temporal: $("#id_tmp").val(),
        no_patron: $("#no_patron").val(),
        horma: $("#horma").val(),
        planta: $("#planta").selectpicker('val'),
        falso: $("#falso").val(),
        plantillo: $("#plantillo").selectpicker('val'),
        latex: $("#latex").val(),
        preimer: $("#preimer").val(),
        sombreado: $("#sombreado").val(),
        taco: $("#taco").selectpicker('val'),
        serie: $("#serie").val(),
        id_categoria: $("#id_catg").selectpicker('val'),
        marcar_empalme: $("#empalme").val(),
        grabado: $("#grabado").val()
    }
    if (data.cuero_1 != "" && data.cuero_2 != "" && data.capellado != "" && data.tela != "" && data.forro_1 != "" && data.forro_2 != "" && data.desuaste_1 != "" && data.desuaste_2 != "" && data.pin_bordes != "" && data.aguja_1 != ""
        && data.aguja_2 != "" && data.hilo_1 != "" && data.hilo_2 != "" && data.hilo_drama != "" && data.esponja != "" && data.chapita != "" && data.cod_diseno != "" && data.total_consumo_cuero != "" && data.precio != "" && data.consumo_cierre_docena != "" && data.no_patron != "" && data.horma != "" && data.planta != "" && data.falso != "" && data.plantillo != "" && data.latex != "" && data.preimer != "" && data.sombreado != "" && data.taco != "" && data.serie != "" && data.id_categoria != "" && data.marcar_empalme != "" && data.grabado != "") {
        if (data.id_temporal != "") {
            console.log(data)
            $.ajax({
                type: "POST",
                url: URL + "inventario/modelo_crud/" + $("#process").val() + "/" + $("#id_modelo").val(),
                data: data,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if (response.code == 1) {
                        Swal.fire({
                            title: 'Notificación',
                            html: response.msj,
                            icon: 'success'
                        }).then(() => {
                            window.location.replace($("#url").val() + 'inventario/modelos');
                        })
                    } else {
                        Swal.fire({
                            title: 'Notificación',
                            html: response.msj,
                            icon: 'error'
                        }).then(() => {

                        })
                    }
                }
            });
        } else {
            SoundNotifier.Error()
            Toast.fire({
                title: 'Alerta',
                html: 'Para que se complete la ficha necesitas una imagen, favor de subirla.',
                icon: 'error'
            })
        }
    } else {
        SoundNotifier.Error()
        Toast.fire({
            title: 'Alerta',
            html: 'No has llenado todos los campos',
            icon: 'error'
        })
    }

})



