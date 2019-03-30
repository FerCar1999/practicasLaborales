$("#contUsua").on('keypress', function(event) {
    if (event.which ==13) {
            iniciarSesion();
        }
});
$(document).ready(function () {

    var stepper = document.querySelector('.stepper');
    var stepperInstace = new MStepper(stepper, {
        // Default active step.
        firstActive: 0,
        // Allow navigation by clicking on the next and previous steps on linear steppers.
        linearStepsNavigation: true,
        // Auto focus on first input of each step.
        autoFocusInput: false,
        // Set if a loading screen will appear while feedbacks functions are running.
        showFeedbackPreloader: true
    });
    verificandoExistencia();
});
function iniciarSesion() { 
    var formularioLogin = $("#frmLogin").serialize();
    $.ajax({
        method: "POST",
        url: "../app/controllers/UsuarioController.php",
        data: formularioLogin,
        success: function (response) {
            console.log(response);
            var url = window.location.pathname;
            var ruta = url.replace('login', '')
            window.location.replace(ruta+'index');
        },
        error: function (param) { 
            console.log('Error al contactar al servidor');
         }
    });
 }
function recuperando() { 
    var valoresForm = $("#frmRecuperar").serialize();
    $.ajax({
        type: "POST",
        url: "../app/controllers/UsuarioController.php",
        data: valoresForm,
        success: function (response) {
            recuperar();
            console.log(response);
        },
        error: function () { 
            console.log("Error al contactar con el servidor");
         }
    });
 }
function recuperar() { 
    $("#login").toggle("slow");
    $("#recuperarContra").toggle("slow");
 }
function verificandoExistencia() {
    $.ajax({
        method: "POST",
        url: '../app/controllers/UsuarioController.php',
        data: {
            accion: 'verficandoExistenciaUsuarios'
        },
        success: function(data) {
            var respuesta = data.indexOf("0");
            if (respuesta >= 0) {
                $("#registro").show();
                $("#login").hide();
                $("#recuperarContra").hide();
            } else {
                $("#registro").hide();
                $("#login").show();
                $("#recuperarContra").hide();
            }
        },
        error: function(data) {
            console.log('Error');
        }
    });
}
function guardarUsuario(){
    //creando formdata con la informacion del formulario de casa
    var formularioCasa =new FormData($("#infoCasa")[0]);
    //agregando la imagen de la casa que se ingresara
    formularioCasa.append("logoCasa",$("#logoCasa")[0].files[0]);
    //creando una variable con toda la informacion del usuario
    var formularioPersonal = $("#infoPersonal").serialize();
        $.ajax({
            method : "POST",
            url : "../app/controllers/CasaController.php",
            data : formularioCasa,
            processData: false,
            contentType: false,
            success : function(data){
                var codiCasa = data.replace(/['"]+/g, '');
                $.ajax({
                    method : "POST",
                    url : "../app/controllers/UsuarioController.php",
                    data : formularioPersonal + '&codiCasa='+codiCasa,
                    success : function (data2) { 
                        console.log(data2);
                     },
                     error : function () { 
                         console.log("Error de server");
                      }
                });
            },
            error : function(resp){
                console.log("Error de server");
            }
        })
}
