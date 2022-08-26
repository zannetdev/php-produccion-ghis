class Auth {
    static Logout = () => {
        Swal.fire({
            title: 'Cerrar Sesión',
            html: '¿Estás seguro de cerrar la sesión actual?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Cerrar Sesión',
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return new Promise(function (resolve) {
                    $.ajax({
                        type: "POST",
                        url: $("#url").val() + 'auth/AuthLogout',
                    })
                        .done(function (response) {
                           window.location.replace( $("#url").val());
                        })
                        .fail(function (e) {
                            console.log(e)
                            Swal.fire('Oops...', 'Problemas con la conexión a internet!', 'error');
                        });
                });
            }
        })
    }
}
$(function () {
    $('.logout').on('click', function () {
        console.log('logged out')
        Auth.Logout();
    })
});