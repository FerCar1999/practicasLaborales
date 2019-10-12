//creando la variable de la tabla
var table;
//creando variable para el regex
var reAlpha = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,100}/; // Regex
$(document).ready(function() {
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
    })
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
    table = $('#table-casa').DataTable({
        destroy: true,
        //realizando peticion ajax para traer datos
        ajax: {
            method: 'POST',
            //url de controlador adonde se traeran los datos
            url: '../app/controllers/CasaController.php',
            //datos que iran por el post
            data: {
                tabla: "casa"
            },
            //agregarndole el nombre del array que se traera
            dataSrc: 'data'
        },
        //agregando datos a las columnas
        columns: [{
            //agregando datos de codigo de categoria
            data: 'codi_casa',
            //pasar a invisible esa columna
            "visible": false
        }, {
            data: "logo_casa",
            "aTargets": [0],
            "render": function(data) {
                return '<img class="circle" width="100px" src="../web/img/logos/' + data + '" />';
            }
        }, {
            //agregando datos de nombre de categoria
            data: 'nomb_casa'
        }, {
            //agregando dato de estado de categoria
            data: 'dire_casa',
        }, {
            data: 'esta_casa',
            "visible": false
        }, {
            //agregando botones para abrir el modal de modificar o de eliminar categoria
            defaultContent: "<a href='#deleCasa' class='delete btn-small red darken-1 waves-effect waves-ligth modal-trigger'>Eliminar</a>"
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
    $('select').formSelect();
    // Llamamos al metodo para obtener el id del registro, para eliminar
    getIdToDelete("#table-casa tbody", table);
}
// Funcion para obtener el ID
function getIdToDelete(tobyd, table) {
    $('tbody').on("click", "a.delete", function() {
        var data = table.row($(this).parents("tr")).data();
        var codi_casa = $("#codiCasaDele").val(data.codi_casa);
    });
}

function create() {
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
        beforeSend: function (param) { 
            M.toast({ html: "Cargando...", classes: 'rounded' });
        },
        success: function(data) {
            var codiCasa = data.replace(/['"]+/g, '');
            if (codiCasa>0) {
                $.ajax({
                    method: "POST",
                    url: "../app/controllers/UsuarioController.php",
                    data: formularioPersonal + '&codiCasa=' + codiCasa,
                    success: function(data2) {
                        //obteniendo valor de la respuesta del servidor
                        var resp = data2.indexOf("Exito");
                        //si la respuesta del servidores mayor o igual a 0
                        if (resp >= 0) {
                            //se oculta el footer del modal
                            $('.modal-footer').hide();
                            //se muestra el preloader
                            $('#preloader').show();
                            //se muestra el mensaje de confirmación
                            M.toast({ html: "Casa agregada con exito", classes: 'rounded' });
                            // Recargando la tabla datatable
                            table.ajax.reload();
                            // mostrando el footer del modal
                            $('.modal-footer').show();
                            //ocultando  el preloader del modal
                            $('#preloader').hide();
                            //cerrando el modal de categoria
                            $('#addCasa').modal('close');
                            //reseteando el formulario para agregar categoria
                            $("#infoCasa")[0].reset();
                            $("#infoPersonal")[0].reset();
                        } else {
                            //se obtiene el texto del json del servidor
                            M.toast({ html: JSON.parse(data2), classes: 'rounded' });
                        }
                    },
                    error: function() {
                        M.toast({ html: "Error al contactar con el servidor", classes: 'rounded' });
                    }
                });
            } else {
                M.toast({ html: data, classes: 'rounded' });
            }
        },
        error: function(resp) {
            M.toast({ html: 'Error al contactar con el servidor', classes: 'rounded' });
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
        url: "../app/controllers/CasaController.php",
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
                M.toast({ html: "Casa eliminada con exito", classes: 'rounded' });
                // Recargando la tabla
                table.ajax.reload();
                //mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando el preloader
                $('#preloader').hide();
                //cerrando modal de eliminar categoria
                $('#deleCasa').modal('close');
                //reseateando formulario
                $('#frmDele')[0].reset();
            } else {
                //obteniendo valor de respuesta
                M.toast({ html: JSON.parse(data), classes: 'rounded' });
            }
        },
        //funcion en el caso de que el servidor no responda
        error: function() {
            // Mensaje de confirmación
            M.toast({ html: "Error al contactar con el servidor", classes: 'rounded' });
        }
    });
}