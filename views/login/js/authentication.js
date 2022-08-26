/// <reference path="../../../core/services/notifications.js" />

$(function () {
        $("#formAuthentication").on("submit", function(e){
            e.preventDefault();
            let data = data_form();
            if(data != null){
                $.ajax({
                    type: "POST",
                    url: $("#url").val() + "login/run_login",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        if(response.code == 1){
                            SoundNotifier.LoginAccess();
                            Swal.fire({
                                title: 'Bienvenido',
                                html: response.msj,
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 2000,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                timerProgressBar: true,
                            }).then(()=>{
                                window.location.reload();
                            })
                        }else{
                            SoundNotifier.Error();
                            Toast.fire({
                                title: 'Error',
                                html: response.msj,
                                icon: 'error'
                            })
                        }
                    }
                });
            }
        })
});
var data_form = () => {
    let data = {
        username: $("#email").val(),
        password: $("#password").val(),
    }
    if(data.password == "" || data.username == ""){
        Swal.fire({
            title: 'Error',
            html: 'Favor de rellenar todos los campos que se piden',
            icon: 'error'
        }).then(() => {
            return null;
        })
    }else{
        return data;
    }
}