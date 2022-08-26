$(function () {
    ClassManager.ActiveMenuItem('empleados', 'emp_empleado')
    lista_datos();
});

function lista_datos() {
    function filterGlobal() {
        $('#table').DataTable().search($('.global_filter').val()).draw();
    }

    var table = $('#table').DataTable({
        dom: 'Bfrtip',
        "ajax": {
            "url": $("#url").val() + "usuario/get_empleados",
            "method": "POST"
        },
        "destroy": true,
        "responsive": true,
        "dom": "tip",
        "bSort": true,
        "order": [[0, "desc"]],
        "columns": [
            {
                "data": null, "render": function (data, type, row) {
                    return `<b>${data.doc}</b>`;

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `<b>${data.nombre_completo}</b>`;

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    if (data.genero == 'M') {
                        return '<i class="mdi mdi-account" style="color: blue;"></i>'
                    } else {
                        return '<i class="mdi mdi-account" style="color: pink;"></i>'
                    }
                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `<b>${data.rol}</b>`;

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `<b>${data.email}</b>`;

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `<b>${data.telefono}</b>`;

                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    return `<b>${data.direccion}</b>`;

                }
            },
            {
                "data": "fecha_registro", "render": function (data, type, row) {
                    return '<i class="mdi mdi-calendar"></i> ' + moment(data).format('DD-MM-Y')
                        + '<br><span class="font-12"><i class="mdi mdi-clock-time-eleven-outline"></i> ' + moment(data).format('h:mm A') + '</span>';

                }
            },
            {
                "data": "fecha_actividad", "render": function (data, type, row) {
                    if (data == 'SIN ACTIVIDAD RECIENTE') {
                        return `<b>${data}</b>`
                    } else {
                        return '<i class="mdi mdi-calendar"></i> ' + moment(data).format('DD-MM-Y')
                            + '<br><span class="font-12"><i class="mdi mdi-clock-time-eleven-outline"></i> ' + moment(data).format('h:mm A') + '</span>';
                    }
                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    if (data.estado == 'a') {
                        return `<button class="btn btn-success btn-rounded" onclick="update_status(${data.id_usuario})">Activo</button>`
                    } else {
                        return `<button class="btn btn-danger btn-rounded"  onclick="update_status(${data.id_usuario})">Inactivo</button>`
                    }
                }
            },
            {
                "data": null, "render": function (data, type, row) {
                    if (data.rol == "EMPLEADO") {
                        return ` <div class="btn-group">
                        <button
                          type="button"
                          class="btn btn-info dropdown-toggle dropdown-toggle-split"
                          data-bs-toggle="dropdown"
                          aria-expanded="false">
                          <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="javascript: mostrar_modal(${data.id_usuario}, '${data.id_area}')"><i class="mdi mdi-pencil"></i>  Area de producción</a></li>
                          <li><a class="dropdown-item" href="${$("#url").val() + "usuario/usuario_process/edita/empleado/"}${data.id_usuario}"><i class="mdi mdi-pencil"></i>  Editar</a></li>
                        </ul>
                      </div>`
                    } else {
                        return ` <div class="btn-group">
                        <button
                          type="button"
                          class="btn btn-info dropdown-toggle dropdown-toggle-split"
                          data-bs-toggle="dropdown"
                          aria-expanded="false">
                          <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="${$("#url").val() + "usuario/usuario_process/edita/empleado/"}${data.id_usuario}"><i class="mdi mdi-pencil"></i>  Editar</a></li>
                        </ul>
                      </div>`
                    }
                }
            },

        ],
    });
    $('input.global_filter').on('keyup click', function () {
        filterGlobal();
    });
}
var mostrar_modal = (id, id_area = '') => {
    if (id_area == '-') {
        //CAMBIA EL VALOR DEL ID EMPLEADO
        select_option("#i_area", '');
        $("#id_empleado").val(id);
        $("#modal_area").modal("show");
        $("#modal_area").on("hidden.bs.modal", () => {
            $("#id_empleado").val('');
            select_option("#i_area", '');
        })
    } else {
        //CAMBIA EL VALOR DEL ID EMPLEADO
        select_option("#i_area", id_area);
        $("#id_empleado").val(id);
        $("#modal_area").modal("show");
        $("#modal_area").on("hidden.bs.modal", () => {
            $("#id_empleado").val('');
            select_option("#i_area", '');
        })
    }
    $(".save").on("click", function(){
        $.ajax({
            type: "POST",
            url: $("#url").val() + "usuario/set_area",
            data: {
                id_area: $("#i_area").selectpicker("val"),
                usuid: id,
            },
            dataType: "json",
            success: function (response) {
                if(response.code == 1){
                    $("#modal_area").modal("hide");
                    lista_datos();
                    Toast.fire({
                        title: 'Correcto',
                        html: 'Has cambiado exitosamente el área de producción',
                        icon: 'success'
                    }).then(()=>{
                       
                    })
                }
            }
        });
    })

}

var update_status = (id_usu, tbl_name = 'tm_usuario') => {
    $.ajax({
        type: "POST",
        url: $("#url").val() + "usuario/update_status",
        data: {
            id_usu: id_usu,
            tbl_name: tbl_name
        },
        success: () => {
            lista_datos();
        }
    });
}

