/// <reference path="../../../logic/js/functions_helpers.js" />
$(function () {
    ClassManager.ActiveMenuItem('ajustes','aj_ajustes')
});

$(function () {
    $('#ip').mask('0ZZ.0ZZ.0ZZ.0ZZ', { translation: { 'Z': { pattern: /[0-9]/, optional: true } } });
    GetUsrCfg();
});

function GetUsrCfg (){
    $.ajax({
        type: "POST",
        url: URL + 'ajustes/get_empresa',
        dataType: "json",
        success: function (response) {
            console.log(response)
            $("#ip").val(response.data.ip_principal);
            select_option('#impresora', response.data.id_impresora);
        }
    });
}
$(".save").on("click",()=>{
    let data= {
        ip : $("#ip").val(),
        id_imp : $("#impresora").selectpicker('val'),
    }
    if(data.ip != '' && data.id_imp != ''){
        $.ajax({
            type: "POST",
            url: URL + 'ajustes/cambia_red',
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
        Toast.fire({
            title: 'Rellena todos los campos',
            icon: 'error'
        })
    }
})