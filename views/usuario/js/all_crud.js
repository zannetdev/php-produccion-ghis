/// <reference path="../../../typings/globals/jquery/index.d.ts" />
/// <reference path="../../../logic/js/functions_helpers.js" />
/// <reference path="../../../logic/js/components.js" />


$(document).ready(function () {
    ClassManager.ActiveSimpleItem('empleados');
   
});

$(document).ready(function () {
    $(".btn-save").on("click", function(){
        let data = {
            process: $("#tipo_proceso").val(),
            nombre: $('#nombre').val(),
            apellido_paterno : $('#ape_pat').val(),
            apellido_materno : $('#ape_mat').val(),
            id_rol: $("#tp_usu").val() != undefined ? $("#tp_usu").val() : '-1',
            genero: $("#gen").val(),
            telefono: $("#tel").val(),
            email: $("#email").val(),
            id_usuario: $("#id_usuario").val() != undefined ? $("#id_usuario").val() : '',
            direccion: $("#direccion").val(),
            usuario: $("#usuario").val(),
            password: $("#password").val(),
            tipo_doc : $("#tp_doc").val(),
            num_doc : $("#num_doc").val(),
        }
        if(data.apellido_mateno != '' && data.apellido_paterno != "" &&  data.direccion != "" && data.email != "" && data.genero  != ""
        && data.nombre != "" && data.id_rol != "" && data.num_doc != "" && data.password != "" && data.telefono 
        != "" && data.tipo_doc != "" && data.usuario){
            $.ajax({
                type: "POST",
                url: $("#url").val() + 'usuario/crud_usuario',
                data: data,
                dataType: 'json',
                success: function (response) {
                    if(response.code == 1){
                        Swal.fire({
                            title: 'Correcto',
                            html: response.msj,
                            icon: 'success'
                        }).then(()=>{
                            if($("#tp_usu").val() == undefined){
                                window.location.replace($("#url").val() + 'usuario/clientes')
                            }else{
                                window.location.replace($("#url").val() + 'usuario/empleados')
                            }
                        })
                    }else{
                        Swal.fire({
                            title: 'Error',
                            html: response.msj,
                            icon: 'error'
                        })
                    }
                }
            });
        }else{
            Toast.fire({
                title: 'Error',
                html: 'Favor de rellenar todos los campos requeridos',
                icon:'error' 
            })
        }
    })
});

//INIT FUNCTION
    //ESTA FUNCION SE ENCARGA DE VERIFICAR EL PROCESO QUE REQUIERE EL CONTROLADOR
    // COMO POR EJEMPLO TRAER LOS DATOS DE UN USUARIO
     (()=>{
        if($("#id_usuario").val() != undefined){
            $.ajax({
                type: "POST",
                url: $("#url").val() + 'usuario/request_data',
                data: {
                    id_usuario: $("#id_usuario").val(),
                    tipo: $("#tipo_usuario").val()
                },
                dataType: "json",
                success: function (response) {
                   if(response.code == -10){
                       Swal.fire({
                           title: 'Error',
                           html: response.msj,
                           icon: 'error',
                           allowOutsideClick: false,
                           allowEscapeKey: false,
                           showConfirmButton: false
                       })
                   }else{
                        let usuario = response.data;
                        console.log(usuario)
                        $("#nombre").val(usuario.nombre);
                        $("#ape_pat").val(usuario.apellido_paterno);
                        $("#ape_mat").val(usuario.apellido_materno);
                        $("#tp_usu").val() != undefined ? select_option("#tp_usu", usuario.id_rol) : null
                        select_option("#gen", usuario.genero);
                        $("#tel").val(usuario.telefono);
                        $("#email").val(usuario.email);
                        $("#usuario").val(usuario.username);
                        $("#direccion").val(usuario.direccion);
                        $("#password").val('');
                        select_option("#tp_doc", usuario.id_doc);
                        $("#num_doc").val(usuario.num_doc);
                   }
                }
            });
        }else{
            // PREVENIMMOS EL AUTOCOMPLETADO DEL NAVEGADOR  
            $("#password").val('');
            $("#usuario").val('');
        }
     })();   

     (()=>{
        $("#num_doc").mask('000000000000');
        $("#tel").mask("+51 (000)-(000-000)")
        $('input[type=password]').val('');
    
    })();   