$(function () {
  ClassManager.ActiveSimpleItem('trabajos')
});
$(function () {
  $("#tabs").tabs();
});
$(".b-t").on("click", function (e) {
  let id = e.currentTarget.id;
  $(".b-t").removeClass("active")
  $("#" + id).addClass("active");
})
$('textarea').each(function () {
  this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
}).on('input', function () {
  this.style.height = 'auto';
  this.style.height = (this.scrollHeight) + 'px';
});

var inputRange = document.getElementsByClassName('pullee')[0],
  maxValue = 150, // the higher the smoother when dragging
  speed = 12, // thanks to @pixelass for this
  currValue, rafID;

// set min/max value
inputRange.min = 0;
inputRange.max = maxValue;

// listen for unlock
function unlockStartHandler() {
  // clear raf if trying again
  window.cancelAnimationFrame(rafID);

  // set to desired value
  currValue = +this.value;
}

function unlockEndHandler() {

  // store current value
  currValue = +this.value;

  // determine if we have reached success or not
  if (currValue >= maxValue) {
    successHandler();
  }
  else {
    rafID = window.requestAnimationFrame(animateHandler);
  }
}

// handle range animation
function animateHandler() {

  // update input range
  inputRange.value = currValue;

  // determine if we need to continue
  if (currValue > -1) {
    window.requestAnimationFrame(animateHandler);
  }

  // decrement value
  currValue = currValue - speed;
}

// handle successful unlock
function successHandler() {
  Swal.fire({
    title: 'Mensaje',
    html: 'Necesitamos confimación tuya para que termines el pedido.<br><h2>¿Deseas confirmar la operación?</h2>',
    icon: 'question',
    allowOutsideClick: false,
    allowEscapeKey: false,
    backdrop: '#282829',
    showCancelButton: true,
    cancelButtonText: 'Cancelar operación',
    confirmButtonText: 'Confirmar operación',
    showLoaderOnConfirm: true,
    preConfirm: function () {
      return new Promise(function (resolve) {
        $.ajax({
          type: "POST",
          url: URL + 'area/terminar_pedido',
          dataType: 'json',
          data: {
            id_proceso: $("#proceso_id").val(),
            id_detalle: $("#detalle_id").val()
          },
        })
          .done(function (response) {
            if(response.code == 1){
              Swal.fire({
                title: 'Notificación',
                html: response.msj,
                icon: 'success'
              }).then(()=>{
                window.location.replace(URL + "area/terminados")
              })
            }
          })
          .fail(function () {
            Swal.fire('Oops...', 'Problemas con la conexiÃ³n a internet!', 'error');
          });
      });
    }
  })

  // reset input range
  inputRange.value = 0;
};

// bind events
inputRange.addEventListener('mousedown', unlockStartHandler, false);
inputRange.addEventListener('mousestart', unlockStartHandler, false);
inputRange.addEventListener('mouseup', unlockEndHandler, false);
inputRange.addEventListener('touchend', unlockEndHandler, false);

$(".verificar").on("click", function(){
  if($("#pwd_bloqueo").val().trim() === $("#pwd").val()){
    Toast.fire({
      title: 'Correcto',
      html: 'Contraseña correcta',
      icon: 'success' 
    })
    
    $(".container_pass").fadeOut("fast", ()=>{
      $(".container_details").fadeIn("fast");
    })
  }else{
    Toast.fire({
      title: 'Error',
      html: 'Contraseña incorrecta',
      icon: 'error' 
    })
  }
})