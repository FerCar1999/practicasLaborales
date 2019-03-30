var table;
var reAlpha = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,150}/; // Regex
var rePass = /^[a-zA-ZñÑ0-9]{6,10}/;
var reAlphaNumeric = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,150}/; // Regex
var reAlias = /^[A-Z]{1}[0-9]{6}/;

$(document).ready(function () {
    dataTable();
    selectTipoUsua();
    $('#preloader').hide();
    $('.progress').hide();
    $(".modal").modal({
        dismissible: false
    });
});
// Cargar datos a la tabla
function dataTable() {
    table = $('#table-usuario').DataTable({
        destroy: true,
        ajax: {
            url: '../app/controllers/UsuarioController.php',
            method: 'POST',
            data: {
                tabla: "usuario"
            },
            dataSrc: 'data'
        },
        columns: [{
            data: 'codi_usua',
            "visible": false
        }, {
            data: 'nomb_usua'
        }, {
            data: 'apel_usua'
        }, {
            data: 'corre_usua'
        }, {
            data: 'codi_tipo_usua',
            "visible": false
        }, {
            data: 'nomb_tipo_usua'
        }, {
            defaultContent:"<a href='#deleUsuario' class='delete btn-small red darken-1 waves-effect waves-ligth modal-trigger'>Eliminar</a>"
        }],
        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        iDisplayLength: 5
    });
    $('select').select2();
    // Llamamos al metodo para obtener los datos, para actualizar
    getDataToUpdate("#table-usuario tbody", table);
    // Llamamos al metodo para obtener el id del registro, para eliminar
    getIdToDelete("#table-usuario tbody", table);
}
// Funcion para obtener datos
function getDataToUpdate(tbody, table) {
    $('tbody').on("click", "a.update", function () {
        var data = table.row($(this).parents("tr")).data();
        $("#nombUsuaUpda").next("label").addClass("active");
        $("#apelUsuaUpda").next("label").addClass("active");
        $("#correUsuaUpda").next("label").addClass("active");
        var codi_usua = $("#codiUsuaUpda").val(data.codi_usua),
            nomb_usua = $("#nombUsuaUpda").val(data.nomb_usua),
            apel_usua = $("#apelUsuaUpda").val(data.apel_usua),
            corre_usua = $("#correUsuaUpda").val(data.corre_usua),
            codi_tipo_usua = $("#codiTipoUsuaUpda").val(data.codi_tipo_usua);
        $("#codiTipoUsuaUpda").change();
        $("#codiTipoUsuaUpda").trigger('change.select2');
    });
}
// Funcion para obtener el ID
function getIdToDelete(tbody, table) {
    $('tbody').on("click", "a.delete", function () {
        var data = table.row($(this).parents("tr")).data();
        var codi_usua = $("#codiUsuaDele").val(data.codi_usua);
    });
}
function create() {
    //obteniendo los datos del formulario
    var datos = $('#frmAdd').serialize();
    //agregando la accion que se va a realizar
    var accion = "create";
    //realizando peticion ajax
    $.ajax({
        //metodo que se va a usar
        method: "POST",
        //ruta de controlador de categoria
        url: "../app/controllers/UsuarioController.php",
        //data que se va a enviar por post
        data: datos + '&accion=' + accion,
        beforeSend: function() {
            $('.modal-footer').hide();
                //se muestra el preloader
                $('#preloader').show();
        },
        //funcion en el caso de que la peticion sea correcta
        success: function(data) {
            //obteniendo valor de la respuesta del servidor
            var resp = data.indexOf("Exito");
            //si la respuesta del servidores mayor o igual a 0
            if (resp >= 0) {
                //se oculta el footer del modal
                //se muestra el mensaje de confirmación
                successAlert("Usuario agregado con exito");
                // Recargando la tabla datatable
                table.ajax.reload();
                // mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando  el preloader del modal
                $('#preloader').hide();
                //cerrando el modal de categoria
                $('#addUsuario').modal('close');
                //reseteando el formulario para agregar categoria
                $('#frmAdd')[0].reset();
            } else {
                //se obtiene el texto del json del servidor
                var message = JSON.parse(data);
                //se crear el modal para mostrar el error
                errorAlert(message);
            }
        },
        //funcion en el caso de que exista un error con el servidor
        error: function() {
            //creando toast para el error
            errorAlert("Error al contactar con el servidor");
        }
    });
}
// Funcion para eliminar
function remove() {
    //datos del formulario
    var datos = $("#frmDele").serialize();
    //accion que se va a realizar
    var accion = 'delete';
    //realizando peticion ajax
    $.ajax({
        //metodo que se va a utilizar
        method: "POST",
        //url del controlador
        url: "../app/controllers/UsuarioController.php",
        //datos que se enviaran en el post
        data: datos + '&accion=' + accion,
        //funcion si el servidor responde
        success: function(data) {
            //obteniendo valor de la respuesta del servidor
            var resp = data.indexOf("Exito");
            //verificando si la respuesta es exitosa
            if (resp >= 0) {
                //ocultanod el footer del modal
                $('.modal-footer').hide();
                //mostrando el preloader 
                $('#preloader').show();
                // Mensaje de confirmación
                successAlert("Usuario eliminado con exito");
                // Recargando la tabla
                table.ajax.reload();
                //mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando el preloader
                $('#preloader').hide();
                //cerrando modal de eliminar categoria
                $('#deleUsuario').modal('close');
                //reseateando formulario
                $('#frmDele')[0].reset();
            } else {
                //obteniendo valor de respuesta
                var message = JSON.parse(data);
                //crando el mensaje de error
                errorAlert(message);
            }
        },
        //funcion en el caso de que el servidor no responda
        error: function() {
            // Mensaje de confirmación
            errorAlert("Error al contactar con el servidor");
        }
    });
}
function selectTipoUsua() {
    $.ajax({
        type: 'POST',
        url: '../app/controllers/TipoUsuarioController.php',
        data: {
            'type': 'tipo'
        },
        dataType: 'JSON',
        success: function (data) {
            $("#codiTipoUsua").empty().append('whatever');
            $("#codiTipoUsua").append('<option value="0" selected disabled>Seleccione el tipo de usuario:</option>');
            $("#codiTipoUsuaUpda").empty().append('whatever');
            $("#codiTipoUsuaUpda").append('<option value="0" selected disabled>Seleccione el diagnostico:</option>');
            for (x in data) {
                $("#codiTipoUsua").append('<option value=' + data[x].codi_tipo_usua + '>' + data[x].nomb_tipo_usua + '</option>');
                $("#codiTipoUsuaUpda").append('<option value=' + data[x].codi_tipo_usua + '>' + data[x].nomb_tipo_usua + '</option>');
                
            }
        },
        error: function (data) {
            console.log("Error al traer datos");
        }
    });
}