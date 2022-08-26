$(function () {
    let response = getting_apertura();
    if (response.status === 200) {
        if (response.responseJSON) {
            if ($("#rol").val() == '1' || $("#rol").val() == '2') {
                if (response.responseJSON.code == -10) {
                    Swal.fire({
                        title: 'El sistema aún no se ha abierto',
                        html: `${response.responseJSON.msj} <br> En caso de que ya haya aperturado, da click aquí <br><br> <a class="btn btn-primary btn-block text-white" href="javascript: window.location.reload();"><i class='bx bx-loader-alt'></i> Recargar</a>`,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        icon: 'error'
                    })
                }
            } else {
                if ($("#in_aper").val() != '0') {
                    if (response.responseJSON.code == -10) {
                        Swal.fire({
                            title: 'El sistema aún no se ha abierto',
                            html: `No has aperturado el sistema, favor de aperturar dando click aquí <br><br><a class="btn btn-primary btn-block text-white" href="${$("#url").val()}apertura"><i class="mdi mdi-shield-key"></i> Aperturar</a>`,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            icon: 'error'
                        })
                    }
                }

            }
        }
    }
});

function getting_apertura() {
    return $.ajax({
        type: "POST",
        url: $("#url").val() + 'control/get_status_sistema',
        cache: false,
        dataType: "json",
        async: !1
    });
}