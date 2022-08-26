/// <reference path="../../typings/index.d.ts" />
/// <reference path="../../logic/js/components.js" />


class Services {
  static UpdateSession(){
    $.ajax({
      type: "POST",
      url: URL + 'service/update_session',
    });
  }
  static GetPedidos() {
    $.ajax({
      type: "POST",
      url: URL + 'service/update_pedidos',
      data: {
        id_usuario: $("#id_usu").val(),
        id_area: $("#id_area").val()
      },
      dataType: "json",
      success: function (response) {
        if (response.code == 1) {
          SoundNotifier.NewPedido();
          Toast.fire({
            title: 'Notificación',
            html: response.msj,
            icon: 'success'
          })
        }
      }
    });
  }
  static UpdateActivity(){
    $.ajax({
      type: "POST",
      url: URL + 'service/UpdateLastActivity',
    });
  }
}
class SoundNotifier {
  static NewMessage() {
    try {
      var sound = new buzz.sound(ASSETS + 'sounds/' + 'message', {
        formats: ["ogg"]
      });
      sound.play()
    } catch (err) {
      console.error(err)
    }
  }
  static NewPedido() {
    try {
      var sound = new buzz.sound(ASSETS + 'sounds/' + 'pedido', {
        formats: ["ogg"]
      });
      sound.play()
    } catch (err) {
      console.error(err)
    }
  }
  static Done() {
    try {
      var sound = new buzz.sound(ASSETS + 'sounds/' + 'done', {
        formats: ["ogg"]
      });
      sound.play()
    } catch (err) {
      console.error(err)
    }
  }
  static LoginAccess() {
    try {
      var sound = new buzz.sound(ASSETS + 'sounds/' + 'access', {
        formats: ["ogg"]
      });
      sound.play()
    } catch (err) {
      console.error(err)
    }
  }
  static Error() {
    try {
      var sound = new buzz.sound(ASSETS + 'sounds/' + 'error', {
        formats: ["ogg"]
      });
      sound.play()
    } catch (err) {
      console.error(err)
    }
  }
  static Okay() {
    try {
      var sound = new buzz.sound(ASSETS + 'sounds/' + 'okay', {
        formats: ["ogg"]
      });
      sound.play()
    } catch (err) {
      console.error(err)
    }
  }
}
//FUNCION INIT QUE ACTUALIZA DATOS CONSTANTEMENTE
(()=>{
  Services.UpdateSession();
  Services.GetPedidos();
  setInterval(()=>{
    Services.GetPedidos()
  }, 3000);
  setInterval(() => {
    Services.UpdateActivity();
  }, 10000);
})();