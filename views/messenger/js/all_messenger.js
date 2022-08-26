/// <reference path="../../../core/info/info_app.js"/>
/// <reference path="../../../logic/js/active_class.js" />

$(function () {
    ClassManager.ActiveSimpleItem('emp_clientes')
});

(()=>{
    console.log("%cFUNCION EXPERIMENTAL, VERSIÓN DEL SISTEMA DE MENSAJERÍA: " + v_mensajeria + "\nPARA MEJOR EXPERIENCIA FAVOR DE NO TRATAR DE 'HACKEAR' EL SISTEMA. NO ME HAGO RESPONSABLE DEL MAL USO QUE SE LE HAGA A ESTE SISTEMA.","color: red; background-color:#000000; font-family:sans-serif; font-size: 28px");
})();
function info(){
    Toast.fire({
        title: 'Información',
        html: 'Versión de aplicación: ' + v_mensajeria + '<br>Fecha de actualización: ' + v_fecha,
        icon: 'info'
    })
}