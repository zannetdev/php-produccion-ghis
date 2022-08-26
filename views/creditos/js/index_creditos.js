$(function () {
    ClassManager.ActiveSimpleItem('credito')
    lista_datos();
    $("#monto_abono").inputmask('decimal', {});

});

function lista_datos() {
    function filterGlobal() {
        $('#table').DataTable().search($('.global_filter').val()).draw();
    }
    var table = $('#table').DataTable({

        dom: 'Bfrtip',
        "ajax": {
            "url": URL + "creditos/all",
            "method": "POST"
        },
        "destroy": true,
        "responsive": true,
        "dom": "tip",
        "bSort": true,
        "order": [[0, "asc"]],
        "columns": [
            {
                "data": null, "render": function (data, type, row) {
                    return '<i class="mdi mdi-calendar"></i> ' + moment(data.credito.fecha_inicio).format('DD-MM-Y')
                        + '<br><span class="font-12"><i class="mdi mdi-clock-time-eleven-outline"></i> ' + moment(data.credito.fecha_inicio).format('h:mm A') + '</span>';

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    let restante = data.total - data.monto;
                   
                    if(restante > 0){
                        return `<b>S/. ${parseFloat(restante).toFixed(2)}</b>`;
                    }else{
                        return `<b>S/. 0.00</b>`;
                    }
                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `<b>S/. ${data.total}</b>`;
                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `<a class="btn btn-outline-dark" target="_blank" href="${URL}detalle/pedido/${data.pedido.id_pedido}"><i class="mdi mdi-eye-outline"></i>  Detalle pedido</a>`;
                }
            },
            {
                "data": null, "render": function (data, type, row) {
                   
                    let restante = data.total - data.monto;
                    
                    if(restante > 0){
                        return `<button class="btn btn-outline-primary" onclick="agrega_abono(${data.credito.id_credito}, ${restante})"><i class="mdi mdi-cash-plus"></i> Agregar pago</button>`;
                    }else{
                        return `<b></b>`;
                    }
                }
            },

        ],

    });
    $('input.global_filter').on('keyup click', function () {
        filterGlobal();

    });

}


function agrega_abono(id, total){
    $("#modal_abono").modal("show");
    $("#id_credito").val(id);
    $("#max").val(total);
}
$("#monto_abono").on("keyup", function () {
    let value = parseFloat(this.value);
    let max = parseFloat($("#max").val());
    if(value > max){
        this.value = max;
    }
})
$("#modal_abono").on("hidden.bs.modal", function(){
    $("#id_credito").val('');    
    $("#monto_abono").val('');
})
$(".close").on("click", function(){
    $("#modal_abono").modal("hide")
})
$(".save").on("click", function(){
    let value = parseFloat($("#monto_abono").val());
    let max = parseFloat($("#max").val());
    if(value <= max){
        let html = `
        <div class="table-responsive">
        <table class="table">
            <thead>
                <th>Ingreso</th>
                <th>Faltante</th>
            </thead>
            <tbody>
                <td>S/. ${value}</td>
                <td>S/. ${max - value}</td>
            </tbody>
        </table>
        </div>
    `;
    let data = {
        monto_abono :   $("#monto_abono").val(),
        id_credito : $("#id_credito").val()
    }
      if(data.monto_abono != ''){
        $("#modal_abono").modal("hide")

        Swal.fire({
            title: 'Mensaje',
            html: 'Se creará un ingreso de crédito con los siguientes datos: <br><br>'+html+'<br><br><h2>¿Deseas confirmar la operación?</h2>',
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
                        url: URL + 'creditos/crea_historial',
                        data: data,
                        dataType: "json",
                    })
                        .done(function (response) {
                            
                            console.log(response)
                            $("#modal_abono").modal("hide")
                            if (response.code == 1) {
                                SoundNotifier.Done();
                                Swal.fire({
                                    title: 'Notificación',
                                    html: response.msj,
                                    icon: 'success'
                                }).then(() => {
                                    Operations.SumApc(data.monto_abono)
                                    lista_datos();
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
      }else{
        SoundNotifier.Error();
        Toast.fire({
            title: 'Error',
            html: 'Rellena todos los campos',
            icon: 'error'
        })
      }
    }else{
        SoundNotifier.Error();
        Toast.fire({
            title: 'Error',
            html: 'Agrega un monto menor al total',
            icon: 'error'
        })
    }
})