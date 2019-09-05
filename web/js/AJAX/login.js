$("#frmLogin").on('keypress', function (event) {
    if (event.which == 13) {
        iniciarSesion();
    }
});
$(document).ready(function () {
    $('#elementosRegisto').show();
    //se muestra el preloader
    $('#preloader').hide();
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
//Funcion para el login
function iniciarSesion() {
    //obteniendo toda la informacion del formulario del login
    var formularioLogin = $("#frmLogin").serialize();
    //peticion ajax
    $.ajax({
        method: "POST",
        url: "../app/controllers/UsuarioController.php",
        data: formularioLogin,
        success: function (response) {
            //si la respuesta de la peticion es exito
            var resp = response.indexOf("Exito");
            if (resp >= 0) {
                //obteniedo url de navegaodr
                var url = window.location.pathname;
                //quitando el login de la url
                var ruta = url.replace('login', '')
                //enviando al index de la pagina
                window.location.replace(ruta + 'index');
            } else {
                //toast con error encontrado
                M.toast({ html: JSON.parse(response), classes: 'rounded' });
            }
        },
        error: function (param) {
            M.toast({ html: 'Error al contactar al servidor', classes: 'rounded' });
        }
    });
}
//Funcion para recuperar contrasenia
function recuperando() {
    //obteniendo los datos del formulario de recuperar
    var valoresForm = $("#frmRecuperar").serialize();
    $.ajax({
        type: "POST",
        url: "../app/controllers/UsuarioController.php",
        data: valoresForm,
        beforeSend: function () {
            //ocultando botones mientras se realiza la peticion
            $('#elementosRegisto').hide();
            //se muestra el preloader
            $('#preloader').show();
        },
        success: function (response) {
            //si la respuesta tiene exito
            var resp = response.indexOf("Exito");
            if (resp >= 0) {
                //llamando a la funcion recuperar
                recuperar();
                //mostrando botones de registro
                $('#elementosRegisto').show();
                //se muestra el preloader
                $('#preloader').hide();
                //mensaje de exito
                M.toast({ html: 'Se le ha enviado un correo con la nueva contraseña', classes: 'rounded' });
            } else {
                //mostrando botones de registro
                $('#elementosRegisto').show();
                //se muestra el preloader
                $('#preloader').hide();
                //mensaje de error
                M.toast({ html: JSON.parse(response), classes: 'rounded' ,displayLength: Infinity});
            }
        },
        error: function () {
            M.toast({ html: "Error al contactar con el servidor", classes: 'rounded' });
        }
    });
}
//Funcion para mostrar u ocultar el login y mostrar el formulario de recuperacion de contrasenia
function recuperar() {
    $("#login").toggle("slow");
    $("#recuperarContra").toggle("slow");
}
//funcion para verificar si existen usuarios en la base de datos
function verificandoExistencia() {
    $.ajax({
        method: "POST",
        url: '../app/controllers/UsuarioController.php',
        data: {
            accion: 'verficandoExistenciaUsuarios'
        },
        success: function (data) {
            //si la respuesta es cero
            var respuesta = data.indexOf("0");
            if (respuesta >= 0) {
                //se muestra el formulario de registro
                $("#registro").show();
                //se ocultan los formularios de login y de recuperar contrasenia
                $("#login").hide();
                $("#recuperarContra").hide();
            } else {
                //se oculta el formulario de registro
                $("#registro").hide();
                //se muestra el formulario de login
                $("#login").show();
                //se oculta el formulario de recuperar contrasenia
                $("#recuperarContra").hide();
            }
        },
        error: function (data) {
            M.toast({ html: "Error al contactar con el servidor", classes: 'rounded' });
        }
    });
}
//Funcion para crear el primer usuario
function guardarUsuario() {
    //creando formdata con la informacion del formulario de casa
    var formularioCasa = new FormData($("#infoCasa")[0]);
    //agregando la imagen de la casa que se ingresara
    formularioCasa.append("logoCasa", $("#logoCasa")[0].files[0]);
    //creando una variable con toda la informacion del usuario
    var formularioPersonal = $("#infoPersonal").serialize();
    $.ajax({
        method: "POST",
        url: "../app/controllers/CasaController.php",
        data: formularioCasa,
        processData: false,
        contentType: false,
        success: function (data) {
            var codiCasa = data.replace(/['"]+/g, '');
            $.ajax({
                method: "POST",
                url: "../app/controllers/UsuarioController.php",
                data: formularioPersonal + '&codiCasa=' + codiCasa,
                beforeSend: function () {
                    //ocultando botones mientras se realiza la peticion
                    $('#accionesRegistro').hide();
                },
                success: function (data2) {
                    var resp = data2.indexOf("Exito");
                    if (resp >= 0) {
                        //ocultando botones mientras se realiza la peticion
                        $('#accionesRegistro').hide();
                        //mensaje de exito
                        M.toast({ html: "Cuenta creada con exito", classes: 'rounded' });
                        //se oculta el formulario de registro
                        $("#registro").hide();
                        //se muestra el formulario de login
                        $("#login").show();
                    } else {
                        M.toast({ html: JSON.parse(data2), classes: 'rounded' });
                    }
                },
                error: function () {
                    M.toast({ html: 'Error al contactar con el servidor', classes: 'rounded' });
                }
            });
        },
        error: function (resp) {
            M.toast({ html: 'Error al contactar con el servidor', classes: 'rounded' });
        }
    })
}