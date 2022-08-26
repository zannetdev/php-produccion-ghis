/// <reference path="../../../core/services/notifications.js" />
$(function () {
    ClassManager.ActiveMenuItem('ajustes','aj_ajustes')
});

$(".save").on('click', ()=>{
    if($("#validation").val() == '1'){
        let data = {
            ruc: $("#ruc").val(),
            nombre: $("#empresa").val(),
            direccion: $("#direccion").val(),
            ubigeo: $("#ubigeo").val(),
            distrito: $("#distrito").val(),
            provincia: $("#provincia").val(),
            departamento: $("#departamento").val(),
        }
        $.ajax({
            type: "POST",
            url: URL + "ajustes/cambia_empresa",
            data: data,
            dataType: "json",	
            success: function (response) {
                if(response.code == 1){
                    SoundNotifier.Okay();

                    Swal.fire({
                        title: 'Notificación',
                        html: response.msj,
                        icon:'success',
                    }).then(function(){
                        window.location.replace(URL + 'ajustes');
                    })

                }else{
                    SoundNotifier.Error();

                    Swal.fire({
                        title: 'Notificación',
                        html: response.msj,
                        icon:'error',
                    }) 
                }
            }
        });
    }else{
        SoundNotifier.Error();

        Toast.fire({
            title: 'Error',
            html: 'La empresa no existe, intenta con otra',
            icon: 'error',
        })
    }
})
function RQData(id = $("#ruc").val()){
   $.ajax({
       type: "POST",
       url: URL + 'service/sunat_ruc/'+id,
       dataType: "json",
       success: function (response) {
            if(response.data.error){
                SoundNotifier.Error();
                Toast.fire({
                    title: response.data.error,
                    icon:'error'
                })
                $('#keyup').val('0')

                $('#validation').val('0')
            }else{
                $('#keyup').val('1')
                $('#validation').val('1')
                SoundNotifier.Okay();
                Toast.fire({
                    title: 'Empresa encontrada',
                    icon:'success'
                })
                $('#empresa').val(response.data.nombre);
                $('#direccion').val(response.data.direccion);
                $('#ubigeo').val(response.data.ubigeo);
                $('#distrito').val(response.data.distrito);
                $('#provincia').val(response.data.provincia);
                $('#departamento').val(response.data.departamento);
            }
       }
   });
}
$(document).ready(function () {
    RQData();
});