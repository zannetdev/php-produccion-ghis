$(function () {
    ClassManager.ActiveSimpleItem('informes')
});


$("#finanzas").on('click', function () {
    $(".opts").empty();
    $(".opts").append(`
    <div class="list-group">
    <a href="${URL}informes/aperturas" class="list-group-item list-group-item-action flex-column align-items-start list_option b" id="aper">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Aperturas y Cierres</h5>
        </div>
    </a>
    <a  href="${URL}informes/ventas_caja" class="list-group-item list-group-item-action flex-column align-items-start list_option b" id="venca">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Ventas de caja</h5>
        </div>
    </a>
    <a  href="${URL}informes/creditos_finanzas" class="list-group-item list-group-item-action flex-column align-items-start list_option b" id="cred">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Créditos</h5>
        </div>
    </a>
</div>
    `);
    $('.list_option').hover(function (e) {
        // over
        let id = e.currentTarget.id;
        $("#" + id).addClass('active')

    }, function (e) {
        let id = e.currentTarget.id;
        // out
        $("#" + id).removeClass('active')
    }
    );
})


$("#produccion").on('click', function () {
    $(".opts").empty();
    $(".opts").append(`
    <div class="list-group">
    <a href="${URL}informes/por_modelo" class="list-group-item list-group-item-action flex-column align-items-start list_option b" id="pmod">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Por modelo</h5>
        </div>
    </a>
    <a href="${URL}informes/todas_produccion" class="list-group-item list-group-item-action flex-column align-items-start list_option b" id="tprod">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Todas las producciones</h5>
        </div>
    </a>
</div>
    `);
    $('.list_option').hover(function (e) {
        // over
        let id = e.currentTarget.id;
        $("#" + id).addClass('active')

    }, function (e) {
        let id = e.currentTarget.id;
        // out
        $("#" + id).removeClass('active')
    }
    );
})
$("#reportes").on('click', function () {
    $(".opts").empty();
    $(".opts").append(`
    <div class="list-group">
    <a href="${URL}informes/por_empleado" class="list-group-item list-group-item-action flex-column align-items-start list_option b" id="pemp">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Por Empleado</h5>
        </div>
    </a>
    <a href="${URL}informes/por_area" class="list-group-item list-group-item-action flex-column align-items-start list_option b" id="cliente">
    <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">Por Cliente</h5>
    </div>
    <a href="${URL}informes/por_area" class="list-group-item list-group-item-action flex-column align-items-start list_option b" id="area">
    <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">Por Area</h5>
    </div>
    </a>
 
    </a>
    <a href="javascript:void(reporte_general())"class="list-group-item list-group-item-action flex-column align-items-start list_option b" id="general">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">General</h5>
        </div>
    </a>
</div>
    `);
    $('.list_option').hover(function (e) {
        // over
        let id = e.currentTarget.id;
        $("#" + id).addClass('active')

    }, function (e) {
        let id = e.currentTarget.id;
        // out
        $("#" + id).removeClass('active')
    }
    );
})

$(function () {
    $('.list_option').hover(function (e) {
        // over
        let id = e.currentTarget.id;
        $("#" + id).addClass('active')

    }, function (e) {
        let id = e.currentTarget.id;
        // out
        $("#" + id).removeClass('active')
    }
    );
});
function reporte_general() {
    let html = `<div class="abs-center">
    
       <div class="form-group">
         <label for="">Seleccione el reporte del ,es que desea generar</label>
         <input type="month" class="form-control" id="report_fecha"  min="2018-03" value="${$("#date").val()}">
       </div>
       <div class="form-group mt-3">
            <button type="button" onclick="genera_pdf()" class="btn btn-danger btn-block"><i class="fa fa-file-pdf-o" aria-hidden="true"></i><b> GENERAR</b></button>
       </div>
   
  </div>
  <script>
  </script>
  `
  Swal.fire({
      title: 'Reporte',
      html: html,
      icon: 'info',
      showConfirmButton: false
  })
}
function genera_pdf(fecha = $("#report_fecha").val()){
    if(fecha != ''){
        $.ajax({
            type: "POST",
            url: URL + 'informes/general_reporte',
            dataType: 'json',
            data: {
                fecha: fecha,
            },
            success: function (response) {
                if (response.code == 1) {
                    SoundNotifier.Done()
                    $("#id_tmp").val('')
                    Swal.fire({
                        title: 'Notificación',
                        html: response.msj,
                        icon: 'success',
                        confirmButtonText: '<i class="fa fa-file-pdf-o"></i> Imprimir',
                        confirmButtonColor: 'red'
                    }).then(() => {
                        window.open(URL + 'informes/reporte_general/'+encodeURIComponent(fecha))
                    })
                } else {
                    Swal.fire({
                        title: 'Notificación',
                        html: response.msj,
                        icon: 'error'
                    })
                }
            }
        });
    }else{
        Toast.fire({
            title: 'Error',
            html:'Selecciona una fecha',
            icon: 'error'
        })
    }
}
