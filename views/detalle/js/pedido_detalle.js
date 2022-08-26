$(function () {
    ClassManager.ActiveSimpleItem('trabajos')
  });
  $(function () {
    $("#tabs").tabs();
  });
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
  $(".b-t").on("click", function (e) {
    let id = e.currentTarget.id;
    $(".b-t").removeClass("active")
    $("#" + id).addClass("active");
  })