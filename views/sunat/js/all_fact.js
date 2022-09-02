$(function () {
    lista_ven_();
    lista_send_();
});
const lista_ven_ = () => {
    var table = $('#vent_table').DataTable({
        dom: 'Bfrtip',
        "ajax": {
            "url": URL + "fact/get_ven/",
            "method": "POST"
        },
        "destroy": true,
        "responsive": true,
        "dom": "tip",
        "pageLength" : 5,
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
                    return `<b>${data.total}</b>`;

                }
            },
            {
                "data": null, "render": function (data, type, row) {

                    return `<div class="row">
                    <div class="btn-group">
                    <button
                      type="button"
                      class="btn btn-outline-dark col-12 dropdown-toggle dropdown-toggle-split"
                      data-bs-toggle="dropdown"
                      aria-expanded="false">
                      <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="javascript: send(${data.id_pedido})"><i class="mdi mdi-printer"></i>  Envíar a sunat</a></li>
                    </ul>
                  </div>
                  </div>`
                }
            },
        ],
    });
}
const send = (id_pago) => {
    console.log(id_pago)
    $("#modal_fact").modal("show")
    $("#id_pago").val(id_pago)
}
$("#modal_fact").on("hidden.bs.modal", ()=>{
    $("#id_pago").val('')
    select_option("#type", '')
})
$(".send").on("click", ()=>{
    let data = {
        id_pago: $("#id_pago").val(),
    }
    let urlx =  $("#type").val() == '2' ? 'facturaAll' : 'boletaAll' 
    if(data.id_pago != ''){
        $.ajax({
            type: "POST",
            url: URL + 'fact/' +  urlx,
            data: data,
            dataType: 'json',
            success: function (response) {
                $("#modal_fact").modal("hide")
                console.log(response)
                if (response.code == 1) {
                    SoundNotifier.Done();
                    Swal.fire({ 
                        title: 'Notificación',
                        html: response.msj,
                        icon: 'success'
                    }).then(() => {
                        lista_ven_();
                        lista_send_();
                    })
                } else {
                    SoundNotifier.Error();
                    Swal.fire({
                        title: 'Notificación',
                        html: response.msj,
                        icon: 'error'
                    })
                }
            }
        });
    }else{
        toastr.error("Selecciona un documento")
    }
})

const lista_send_ = () => {
    var table = $('#tbl_sun').DataTable({
        dom: 'Bfrtip',
        "ajax": {
            "url": URL + "fact/get_sunat/",
            "method": "POST"
        },
        "destroy": true,
        "responsive": true,
        "dom": "tip",
        "pageLength" : 5,
        "bSort": true,
        "order": [[0, "desc"]],
        "columns": [
            {
                "data": "fecha_envio", "render": function (data, type, row) {
                    return '<i class="mdi mdi-calendar"></i> ' + moment(data).format('DD-MM-Y')
                        + '<br><span class="font-12"><i class="mdi mdi-clock-time-eleven-outline"></i> ' + moment(data).format('h:mm A') + '</span>';

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `
                        <a target="_blank" class="btn btn-success" href="${data.xml_response}"><i class="mdi mdi-xml"></i></a>
                        `;

                }
            },
            
            {
                "data": null, "render": function (data, type, row) {
                   if(data.type_fact == 2){
                    return `
                    <a  target="_blank" class="btn btn-danger" href="${data.cdr_response}"><i class="mdi mdi-file-sign"></i></a>
                    `;

                   }else{ 
                    return ''
                   }
                }
            },
            {
                "data": null, "render": function (data, type, row) {
                 
                    return `
                    <a  target="_blank" class="btn btn-danger" href="${URL + 'informes/imprime_pedido/' + data.id_pago}"><i class="mdi mdi-file-pdf-box"></i></a>
                    `
                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `<b>${data.type_fact == '2' ? 'Factura' : 'Boleta'}</b>`;
                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    $bg = ``;
                    if(data.status_sunat == 0){
                        return `<button disabled class="btn btn-success">Enviado</button>`
                    }
                    if(data.status_sunat >= 4000){
                        return `<button disabled class="btn btn-warning">Enviado con errores</button>`
                    }
                    if(data.status_sunat >= 2000 && data.status_sunat <= 3999){
                        return `<button disabled class="btn btn-warning">Rechazada</button>`
                    }
                }
            },
            {
                "data": null, "render": function (data, type, row) {

                    return `<div class="row">
                    <div class="btn-group">
                    <button
                      type="button"
                      class="btn btn-outline-dark col-12 dropdown-toggle dropdown-toggle-split"
                      data-bs-toggle="dropdown"
                      aria-expanded="false">
                      <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="javascript: send(${data.id_pago})"><i class="mdi mdi-printer"></i>  Envíar de nuevo</a></li>
                    </ul>
                  </div>
                  </div>`
                }
            },
        ],
    });
}