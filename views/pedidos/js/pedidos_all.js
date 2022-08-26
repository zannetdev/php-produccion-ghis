/// <reference path="../../../logic/js/components.js" />
/// <reference path="../../../core/services/notifications.js" />

$(function () {
    ClassManager.ActiveSimpleItem('crear_pedido');
});

$("#btn-sec").on("click", ()=>{
    let data = {
        color: $("#color").selectpicker('val'),
        cliente1 : $("#cliente_1").selectpicker('val'),
        observaciones: $("#observacion").val()
    }
    if(data.cliente1 != '' && data.color !=  ""){
        window.location.replace(URL + "pedidos/pedido_create/"+encodeURIComponent(JSON.stringify(data)));
    }else{
        SoundNotifier.Error();
        Toast.fire({
            title: "Error",
            html: 'Rellena todos los campos',
            icon: 'error'
        })
    }
})

