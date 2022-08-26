$(function () {
    $("#monto_inicial").inputmask('decimal', {});
    $("#monto_cierre").inputmask('decimal', {});

    ClassManager.ActiveSimpleItem('apertura')   
});
$(function () {
    $("#btn_ap").on("click", function(e){
        let data = {
            monto_inicial : $("#monto_inicial").val()
        }
        if(data.monto_inicial != ""){
            let html = `
                <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>Ingreso inicial</th>
                        <th>Total</th>
                    </thead>
                    <tbody>
                        <td>S/. ${data.monto_inicial}</td>
                        <td>S/. ${data.monto_inicial}</td>
                    </tbody>
                </table>
                </div>
            `;
            Swal.fire({ 
                title: 'Notificación de apertura',
                html: 'Estás apunto de aperturar el sistema con los siguientes datos<br><br><br><br>' + html + '<br><h3>¿Desea continuar?</h3>',
                icon: 'question',
                showCancelButton: true,
                backdrop: '#6682ff',
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result)=>{
                if(result.value){
                    $.ajax({
                        type: "POST",
                        url: $("#url").val() + 'apertura/ap_nueva',
                        data: data,
                        dataType: "json",
                        success: function (response) {
                            if(response.code == 1){
                                Swal.fire({
                                    title: 'Notificación',
                                    html: response.msj,
                                    icon: 'success',
                                    
                                }).then(()=>{
                                    window.location.reload();
                                })
                            }else{
                                Swal.fire({
                                    title: 'Notificación',
                                    html: response.msj,
                                    icon: 'error',
                                    
                                }).then(()=>{
                                })
                            }
                        }
                    });
                }else{
                    Toast.fire({
                        title: 'Operación cancelada',
                        icon: 'info'
                    })
                }
            })
        }else{
           Toast.fire({
               title: 'Error, favor de rellenar todos los campos',
               icon: 'error'
           })
        }
    })
    $("#btn_ce").on("click", function(e){
        let data = {
            monto_cierre : $("#monto_cierre").val()
        }
        if(data.monto_cierre != ""){
            let html = `
                <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>Ingreso Final</th>
                        <th>Total</th>
                    </thead>
                    <tbody>
                        <td>S/. ${data.monto_cierre}</td>
                        <td>S/. ${data.monto_cierre}</td>
                    </tbody>
                </table>
                </div>
            `;
            Swal.fire({ 
                title: 'Notificación de cierre',
                html: 'Estás apunto de cerrar el sistema con los siguientes datos<br><br><br><br>' + html + '<br><h3>¿Desea continuar?</h3>',
                icon: 'question',
                showCancelButton: true,
                backdrop: '#6682ff',
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result)=>{
                if(result.value){
                    $.ajax({
                        type: "POST",
                        url: $("#url").val() + 'apertura/cierra_sistema',
                        data: data,
                        dataType: "json",
                        success: function (response) {
                            if(response.code == 1){
                                Swal.fire({
                                    title: 'Notificación',
                                    html: response.msj,
                                    icon: 'success',
                                    
                                }).then(()=>{
                                    window.location.reload();
                                })
                            }else{
                                Swal.fire({
                                    title: 'Notificación',
                                    html: response.msj,
                                    icon: 'error',
                                    
                                }).then(()=>{

                                })
                            }
                        }
                    });
                }else{
                    Toast.fire({
                        title: 'Operación cancelada',
                        icon: 'info'
                    })
                }
            })
        }else{
           Toast.fire({
               title: 'Error, favor de rellenar todos los campos',
               icon: 'error'
           })
        }
    })
});