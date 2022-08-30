/// <reference path="../../../core/services/notifications.js" />
$(function () {
    ClassManager.ActiveMenuItem('ajustes','aj_ajustes')
    $("#igv").mask('00.00%')
});

$("#frm_emp").on('submit', function(e){
    e.preventDefault()
    console.log('a')
    if($("#validation").val() == '1'){
        var xhrdata = new FormData(this);
        $.ajax({
            type: "POST",
            url: URL + "ajustes/cambia_empresa",
            data: xhrdata,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                if(response.code == 1){
                    SoundNotifier.Okay();
                    Swal.fire({
                        title: 'Notificación',
                        html: response.msj,
                        icon:'success',
                    }).then(function(){
                       window.location.replace(URL)
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