$(function () {
    ClassManager.ActiveMenuItem('ajustes', 'aj_ajustes')
});
$(".process").on('click', function (e) {
    let data = {
        impresora: $("#impresora").selectpicker('val')
    }
    if (data.impresora != '') {
        window.open('http://' + $("#pc_ip").val()  + '/imprimir/test.php?data=' + encodeURIComponent(JSON.stringify(data)));
    }else{
        SoundNotifier.Error();
        Toast.fire({
            title: 'Error',
            html: 'Selecciona una impresora',
            icon: 'error',
        })
    }
})