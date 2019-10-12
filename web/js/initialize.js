$(document).ready(function () {
    //Inicializando stepper
    $('.collapsible').collapsible();
    $('.dropdown-trigger').dropdown();
    //inicializando sidenav
    $('.sidenav').sidenav();
    //opcion de cierre de sidenav
    $('.sidenav-close').sidenav('close');
    //inicializando tooltip
    $('.tooltipped').tooltip();
    //inicializando floated button
    $('.fixed-action-btn').floatingActionButton();
    //inicializando modal
    $('.modal').modal();
    //inicializando tabs
    $('.tabs').tabs();
    //inicializando time picker con sus opciones de idiom
    //inicializando select 2
    $('.select2').select2();
});

function someFunction(destroyFeedback) {
    setTimeout(() => {
        destroyFeedback(true);
    }, 1000);
}

function concatenarTextoLargo(texto) {
    concatenar = "";
    if (!texto == "") {
        cadena = texto.split(" ");
        for (let m = 0; m < cadena.length; m++) {
            mod = m % 5;
            if (mod == 0 && m != 0) {
                concatenar += "\n";
            }
            concatenar += cadena[m] + " ";
        }
    }
    return concatenar;
}
//SELECCIONAR TODOS LOS ELEMENTOS DE UN MULTIPLE SELECT
function selectTodos(select) {
    $('#' + select + ' option').prop('selected', true);
    $('#' + select + '').change();
    $('#' + select + '').trigger('change.select2');
}
function cerrarSesion() {
    $.ajax({
        method: "POST",
        url: "../app/controllers/UsuarioController.php",
        data: {
            accion: "logout"
        },
        success: function (response) {
            console.log(response);
            var url = window.location.pathname;
            var urlSplit = url.split("/");
            var ruta = url.replace(urlSplit.pop(), '');
            window.location.replace(ruta + 'login');
        },
        error: function (param) {
            console.log('Error al contactar al servidor');
        }
    });
}