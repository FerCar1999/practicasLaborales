//creando la variable de la tabla
var table;
$(document).ready(function() {
    //ejecutando la funcion datatable
    dataTable();
    //escondiendo el progress de guardado y modificado
    $('.progress').hide();
    $('#progress2').hide();
    //opcion para que solo se cierre el modal cuando se le de click a la x
    $('.modal').modal({
        dismissible: false
    });
});
// Cargar datos a la tabla
function dataTable() {
    //llenando la variable datatable
    table = $('#table-horario').DataTable({
        destroy: true,
        //realizando peticion ajax para traer datos
        ajax: {
            method: 'POST',
            //url de controlador adonde se traeran los datos
            url: '../app/controllers/HorarioController.php',
            //datos que iran por el post
            data: {
                tabla: "horario"
            },
            //agregarndole el nombre del array que se traera
            dataSrc: 'data'
        },
        //agregando datos a las columnas
        columns: [{
            //agregando datos de codigo de categoria
            data: 'codi_hora',
            //pasar a invisible esa columna
            "visible": false
        }, {
            //agregando datos de nombre de categoria
            data: 'codi_dia',
            "visible": false
        }, {
            data: 'dia'
        }, {
            data: 'hora_inic'
        }, {
            data: 'hora_fin'
        }, {
            //agregando botones para abrir el modal de modificar o de eliminar categoria
            defaultContent: "<a href='#updaHorario' class='update btn-small blue darken-1 waves-effect waves-ligth modal-trigger'>Modificar</a>" + "  <a href='#deleHorario' class='delete btn-small red darken-1 waves-effect waves-ligth modal-trigger'>Eliminar</a>"
        }],
        //cambiando el idioma de las diferentes opciones
        language: {
            //procesando informacion
            "sProcessing": "Procesando...",
            //Drop para mostrar diferentes cantidades de registros
            "sLengthMenu": "Mostrar cantidad de registros  _MENU_ ",
            //cuando no se encuentran registros
            "sZeroRecords": "No se encontraron resultados",
            //cuando no hay ningun dato en la tabla
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            //informacion de los registros que se estan viendo y el total de registros
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            //informacion de registros nulos
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            //total de registros que concuerdan con el filtro de buscar
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            //Buscar
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            //cargando datos
            "sLoadingRecords": "Cargando...",
            //paginacion
            "oPaginate": {
                //primer dato
                "sFirst": "Primero",
                //ultimo dato
                "sLast": "Último",
                //siguiente
                "sNext": "Siguiente",
                //anterior
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        //cantidad de datos que se van a mostrar al cargar los datos por defecto
        iDisplayLength: 5
    });
    $('select').select2();
    // Llamamos al metodo para obtener los datos, para actualizar
    getDataToUpdate("#table-horario tbody", table);
    // Llamamos al metodo para obtener el id del registro, para eliminar
    getIdToDelete("#table-horario tbody", table);
}
// Funcion para obtener datos para modificar
function getDataToUpdate(tbody, table) {
    $('tbody').on("click", "a.update", function() {
        var data = table.row($(this).parents("tr")).data();
        $("#horaInicUpda").next("label").addClass("active");
        $("#horaFinUpda").next("label").addClass("active");
        var codi_hora = $("#codiDoceUpda").val(data.codi_hora),
            codi_dia = $("#codiDiaUpda").val(data.codi_dia),
            hora_inic = $("#horaInicUpda").val(data.hora_inic),
            hora_fin = $("#horaFinUpda").val(data.hora_fin);
        $("#codiDiaUpda").change();
        $("#codiDiaUpda").trigger('change.select2');
    });
}
// Funcion para obtener el ID
function getIdToDelete(tobyd, table) {
    $('tbody').on("click", "a.delete", function() {
        var data = table.row($(this).parents("tr")).data();
        var codi_hora = $("#codiHoraDele").val(data.codi_hora);
    });
}
// Funcion para agregar
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
        url: "../app/controllers/HorarioController.php",
        //data que se va a enviar por post
        data: datos + '&accion=' + accion,
        //funcion en el caso de que la peticion sea correcta
        success: function(data) {
            //obteniendo valor de la respuesta del servidor
            var resp = data.indexOf("Exito");
            //si la respuesta del servidores mayor o igual a 0
            if (resp >= 0) {
                //se oculta el footer del modal
                $('.modal-footer').hide();
                //se muestra el preloader
                $('#preloader').show();
                //se muestra el mensaje de confirmación
                successAlert("Horario agregado con exito");
                // Recargando la tabla datatable
                table.ajax.reload();
                // mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando  el preloader del modal
                $('#preloader').hide();
                //cerrando el modal de categoria
                $('#addHorario').modal('close');
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
// Funcion para modificar
function update() {
    //datos del formulario
    var datos = $("#frmUpdate").serialize();
    //accion que se va a realizar
    var accion = 'update';
    //realizando peticion ajax
    $.ajax({
        //metodo que se va a usar
        method: "POST",
        //ruta del controlador
        url: "../app/controllers/DocenteController.php",
        //datos que se enviaran por el post
        data: datos + '&accion=' + accion,
        //funcion en el caso de que responda correctamente el servidor
        success: function(data) {
            //obteniendo el valor de respuesta del servidor
            var resp = data.indexOf("Exito");
            //verificando que si sea exitosa la operacion
            if (resp >= 0) {
                //ocultando el footer del modal
                $('.modal-footer').hide();
                //mostrando el preloader
                $('#preloader').show();
                //creando modal para el mensaje de confirmación
                successAlert("Docente modificado con exito");
                // Recargando la tabla
                table.ajax.reload();
                //Mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando el preloader
                $('#preloader').hide();
                //ocultando modal para modificar la categoria
                $('#updaDocente').modal('close');
                //reseteando el formulario
                $('#frmUpdate')[0].reset();
            } else {
                //obteniendo el mensaje de respuesta
                var message = JSON.parse(data);
                ///creando el mensaje de error
                errorAlert(message);
            }
        },
        //funcion en el caso de que el servidor no responda
        error: function() {
            //creando modal de error
            errorAlert("No se pudo contactar con el servidor");
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
        url: "../app/controllers/HorarioController.php",
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
                successAlert("Horario eliminado con exito");
                // Recargando la tabla
                table.ajax.reload();
                //mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando el preloader
                $('#preloader').hide();
                //cerrando modal de eliminar categoria
                $('#deleHorario').modal('close');
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