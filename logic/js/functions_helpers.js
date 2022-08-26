function select_option(selector, value){
    $(selector).selectpicker('val', value)
}
function UrlExists(url)
{
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http;
}
function agrega_usuario(tipo, id_usuario = "-"){
    if(id_usuario == "-"){
        window.location.replace($("#url").val() + 'usuario/usuario_process/agrega/'+ tipo);
    }else{
        window.location.replace($("#url").val() + 'usuario/usuario_process/edita/'+ tipo+'/'+ id_usuario);
    }
}
function multiple(valor, multiple)
{
    resto = valor % multiple;
    if(resto==0)
        return true;
    else
        return false;
}
Array.prototype.diff = function (arr) {

    // Merge the arrays
    var mergedArr = this.concat(arr);

    // Get the elements which are unique in the array
    // Return the diff array
    return mergedArr.filter(function (e) {
        // Check if the element is appearing only once
        return mergedArr.indexOf(e) === mergedArr.lastIndexOf(e);
    });
};