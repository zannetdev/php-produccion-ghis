/// <reference path="../../../logic/js/active_class.js" />
$(function () {
    ClassManager.ActiveMenuItem('ajustes','aj_ajustes')
});

$('.list_option').hover(function (e) {
    // over
    let id = e.currentTarget.id;
    console.log('id => ' + id)
    $("#" + id).addClass('active')

}, function (e) {
    let id = e.currentTarget.id;
    console.log('id => ' + id)
    // out
    $("#" + id).removeClass('active')
}
);

