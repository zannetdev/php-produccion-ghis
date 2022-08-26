$(function () {
    ClassManager.ActiveSimpleItem('clientepedido')
});
$("#btn-sec").on("click", ()=>{
    let data = {
        color: $("#color").selectpicker('val'),
        cliente1 : $("#id_usu").val(),
        observaciones: $("#observacion").val()
    }
    if(data.cliente1 != '' && data.color !=  ""){
        window.location.replace(URL + "cliente/pedido_create/"+encodeURIComponent(JSON.stringify(data)));
    }else{
        SoundNotifier.Error();
        Toast.fire({
            title: "Error",
            html: 'Rellena todos los campos',
            icon: 'error'
        })
    }
})



