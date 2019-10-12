//creando la variable de la tabla
var table;
//creando variable para el regex
var reAlpha = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,100}/; // Regex
$(document).ready(function () {
    $('.js-example-basic-single').select2();
    $("#tablaDoce").hide();
    $("#tabla2Doce").hide();
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        i18n: {
            months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
            weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
            weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
            weekdaysAbbrev: ["D", "L", "M", "M", "J", "V", "S"]
        },
        container: 'body'
    });
    selectDocentes();
    selectProfesiones();
    selectAcreditaciones();
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

function selectAcreditaciones() {
    $.ajax({
        type: 'POST',
        url: '../app/controllers/AcreditacionController.php',
        data: {
            type: 'acreditaciones'
        },
        dataType: 'JSON',
        success: function (data) {
            $("#codiAcre").empty().append('whatever');
            $("#codiAcre").append('<option value="0" selected disabled>Seleccione la acreditacion:</option>');
            $("#codiAcreUpda").empty().append('whatever');
            $("#codiAcreUpda").append('<option value="0" selected disabled>Seleccione la acreditacion:</option>');
            for (var i = 0; i < data.length; i++) {
                $("#codiAcre").append('<option value=' + data[i].codi_acre + '>' + data[i].tipo_acre + '</option>');
                $("#codiAcreUpda").append('<option value=' + data[i].codi_acre + '>' + data[i].tipo_acre + '</option>');
            }
        },
        error: function (data) {
            console.log("Error al traer datos");
        }
    });
}

function selectProfesiones() {
    $.ajax({
        type: 'POST',
        url: '../app/controllers/ProfesionController.php',
        data: {
            type: 'profesion'
        },
        dataType: 'JSON',
        success: function (data) {
            $("#codiProf").empty().append('whatever');
            $("#codiProf").append('<option value="0" selected disabled>Seleccione la profesion:</option>');
            $("#codiProfUpda").empty().append('whatever');
            $("#codiProfUpda").append('<option value="0" selected disabled>Seleccione la profesion:</option>');
            for (var i = 0; i < data.length; i++) {
                $("#codiProf").append('<option value=' + data[i].codi_prof + '>' + data[i].nomb_prof + '</option>');
                $("#codiProfUpda").append('<option value=' + data[i].codi_prof + '>' + data[i].nomb_prof + '</option>');
            }
        },
        error: function (data) {
            console.log("Error al traer datos");
        }
    });
}
// Cargar datos a la tabla
function dataTable() {
    //llenando la variable datatable
    table = $('#table-docente').DataTable({
        destroy: true,
        //realizando peticion ajax para traer datos
        ajax: {
            method: 'POST',
            //url de controlador adonde se traeran los datos
            url: '../app/controllers/DocenteController.php',
            //datos que iran por el post
            data: {
                tabla: "docente"
            },
            //agregarndole el nombre del array que se traera
            dataSrc: 'data'
        },
        //agregando datos a las columnas
        columns: [{
            //agregando datos de codigo de categoria
            data: 'codi_doce',
            //pasar a invisible esa columna
            "visible": false
        }, {
            //agregando datos de nombre de categoria
            data: 'nomb_doce'
        }, {
            data: 'apel_doce'
        }, {
            data: 'codi_inte_acre_doce',
            "visible": false
        }, {
            data: 'codi_acre',
            "visible": false
        }, {
            data: 'codi_inte_doce_prof',
            "visible": false
        }, {
            data: 'codi_prof',
            "visible": false
        }, {
            //agregando botones para abrir el modal de modificar o de eliminar categoria
            defaultContent: "<a href='#updaDocente' class='update btn-small blue darken-1 waves-effect waves-ligth modal-trigger'>Modificar</a>" + "  <a href='#deleDocente' class='delete btn-small red darken-1 waves-effect waves-ligth modal-trigger'>Eliminar</a>"
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
    getDataToUpdate("#table-docente tbody", table);
    // Llamamos al metodo para obtener el id del registro, para eliminar
    getIdToDelete("#table-docente tbody", table);
}
// Funcion para obtener datos para modificar
function getDataToUpdate(tbody, table) {
    $('tbody').on("click", "a.update", function () {
        var data = table.row($(this).parents("tr")).data();
        $("#nombDoceUpda").next("label").addClass("active");
        $("#apelDoceUpda").next("label").addClass("active");
        var codi_cate = $("#codiDoceUpda").val(data.codi_doce),
            nomb_cate = $("#nombDoceUpda").val(data.nomb_doce),
            apel_doce = $("#apelDoceUpda").val(data.apel_doce),
            codi_inte_acre_doce = $("#codiInteAcreDoceUpda").val(data.codi_inte_acre_doce),
            codi_acre = $("#codiAcreUpda").val(data.codi_acre),
            codi_inte_doce_prof = $("#codiInteDoceProfUpda").val(data.codi_inte_doce_prof),
            codi_prof = $("#codiProfUpda").val(data.codi_prof);
        $("#codiAcreUpda").change();
        $("#codiAcreUpda").trigger('change.select2');
        $("#codiProfUpda").change();
        $("#codiProfUpda").trigger('change.select2');
    });
}
// Funcion para obtener el ID
function getIdToDelete(tobyd, table) {
    $('tbody').on("click", "a.delete", function () {
        var data = table.row($(this).parents("tr")).data();
        var codi_doce = $("#codiDoceDele").val(data.codi_doce);
    });
}
// Funcion para agregar
function create() {
    //obteniendo los datos del formulario
    var datos = $('#frmAdd').serialize();
    //agregando la accion que se va a realizar
    var accion = "create";
    //Validando que el campo de nombre cumpla con el regex
    if (!reAlpha.test($('#nombDoce').val())) {
        //agregando clase invalid al campo del formulario
        $("#nombDoce").addClass('invalid');
    } else {
        if (!reAlpha.test($('#apelDoce').val())) {
            $('#apelDoce').addClass('invalid');
        } else {
            //realizando peticion ajax
            $.ajax({
                //metodo que se va a usar
                method: "POST",
                //ruta de controlador de categoria
                url: "../app/controllers/DocenteController.php",
                //data que se va a enviar por post
                data: datos,
                //funcion en el caso de que la peticion sea correcta
                success: function (data) {
                    //si la respuesta del servidores mayor o igual a 0
                    if (JSON.parse(data) >= 0) {
                        //se oculta el footer del modal
                        $('.modal-footer').hide();
                        //se muestra el preloader
                        $('#preloader').show();
                        $.ajax({
                            method: "POST",
                            url: "../app/controllers/IntermediaDocenteProfesionController.php",
                            data: datos + '&codiDoce=' + JSON.parse(data),
                            success: function (dato) {
                                var resp = data.indexOf("Exito");
                                if (resp > 0) {
                                    console.log('');
                                } else {
                                    console.log('');
                                }
                            }
                        });
                        $.ajax({
                            method: "POST",
                            url: "../app/controllers/IntermediaAcreditacionDocenteController.php",
                            data: datos + '&codiDoce=' + JSON.parse(data),
                            success: function (dato) {
                                var resp = data.indexOf("Exito");
                                if (resp > 0) {
                                    console.log('');
                                } else {
                                    console.log('');
                                }
                            }
                        });
                        //se muestra el mensaje de confirmación
                        successAlert("Docente agregado con exito");
                        // Recargando la tabla datatable
                        table.ajax.reload();
                        // mostrando el footer del modal
                        $('.modal-footer').show();
                        //ocultando  el preloader del modal
                        $('#preloader').hide();
                        //cerrando el modal de categoria
                        $('#addDocente').modal('close');
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
                error: function () {
                    //creando toast para el error
                    errorAlert("Error al contactar con el servidor");
                }
            });
        }
    }
}
// Funcion para modificar
function update() {
    //datos del formulario
    var datos = $("#frmUpdate").serialize();
    //accion que se va a realizar
    var accion = 'update';
    //Validando que el campo de texto concuerde con el regex
    if (!reAlpha.test($('#nombDoceUpda').val())) {
        //agregando clase invalid al campo del formulario
        $("#nombDoceUpda").addClass('invalid');
    } else {
        if (!reAlpha.test($('#apelDoceUpda').val())) {
            $('#apelDoceUpda').addClass('invalid');
        } else {
            //realizando peticion ajax
            $.ajax({
                //metodo que se va a usar
                method: "POST",
                //ruta del controlador
                url: "../app/controllers/DocenteController.php",
                //datos que se enviaran por el post
                data: datos + '&accion=' + accion,
                //funcion en el caso de que responda correctamente el servidor
                success: function (data) {
                    //obteniendo el valor de respuesta del servidor
                    var resp = data.indexOf("Exito");
                    //verificando que si sea exitosa la operacion
                    if (resp >= 0) {
                        //ocultando el footer del modal
                        $('.modal-footer').hide();
                        //mostrando el preloader
                        $('#preloader').show();
                        $.ajax({
                            method: "POST",
                            url: "../app/controllers/IntermediaAcreditacionDocenteController.php",
                            data: datos,
                            success: function (dato) {
                                var resp = data.indexOf("Exito");
                                if (resp > 0) {
                                    console.log('');
                                } else {
                                    console.log('');
                                }
                            }
                        });
                        $.ajax({
                            method: "POST",
                            url: "../app/controllers/IntermediaAcreditacionDocenteController.php",
                            data: datos,
                            success: function (dato) {
                                var resp = data.indexOf("Exito");
                                if (resp > 0) {
                                    console.log('');
                                } else {
                                    console.log('');
                                }
                            }
                        });
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
                error: function () {
                    //creando modal de error
                    errorAlert("No se pudo contactar con el servidor");
                }
            });
        }
    }
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
        url: "../app/controllers/DocenteController.php",
        //datos que se enviaran en el post
        data: datos + '&accion=' + accion,
        //funcion si el servidor responde
        success: function (data) {
            //obteniendo valor de la respuesta del servidor
            var resp = data.indexOf("Exito");
            //verificando si la respuesta es exitosa
            if (resp >= 0) {
                //ocultanod el footer del modal
                $('.modal-footer').hide();
                //mostrando el preloader 
                $('#preloader').show();
                // Mensaje de confirmación
                successAlert("Docente eliminado con exito");
                // Recargando la tabla
                table.ajax.reload();
                //mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando el preloader
                $('#preloader').hide();
                //cerrando modal de eliminar categoria
                $('#deleDocente').modal('close');
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
        error: function () {
            // Mensaje de confirmación
            errorAlert("Error al contactar con el servidor");
        }
    });
}
function selectDocentes() {
    $.ajax({
        type: 'POST',
        url: '../app/controllers/DocenteController.php',
        data: {
            type: 'categoria'
        },
        dataType: 'JSON',
        success: function (data) {
            $("#codiDoceRepo").empty().append('whatever');
            $("#codiDoceRepo").append('<option value="0" selected disabled>Seleccione el docente:</option>');
            for (var i = 0; i < data.length; i++) {
                $("#codiDoceRepo").append('<option value=' + data[i].codi_doce + '>' + data[i].nomb_doce + ' ' + data[i].apel_doce + '</option>');
            }
        },
        error: function (data) {
            console.log("Error al traer datos");
        }
    });
}
//AJAX GENERADOR DE REPORTES
function generarReporteDocente() {
    var docente = $('#codiDoceRepo').val();
    var desde = $('#fechInicRepoDoce').val();
    var hasta = $('#fechFinaRepoDoce').val();
    $.ajax({
        url: '../app/controllers/DocenteController',
        method: 'POST',
        data: {
            accion: 'reporte',
            codiDoceRepo: docente,
            fechInicRepo: desde,
            fechFinaRepo: hasta
        },
        dataType: 'JSON',
        beforeSend: function () {

        },
        success: function (data) {
            if (data.length > 0) {
                $("#tablitaDoce tbody").empty();
                var doc = new jsPDF({
                    orientation: 'p',
                    unit: 'mm',
                    format: 'letter'
                });
                var logo = new Image();
                logo.src = '../logos/RICALDONE.jpg';
                doc.addImage(logo, 'JPG', 95, 15, 25, 25)
                doc.setFontSize(15);
                var textWidth = doc.getStringUnitWidth("Docente: " + $('#codiDoceRepo option:selected').text()) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                var x = (doc.internal.pageSize.width - textWidth) / 2;
                doc.text(x, 50, "Docente: " + $('#codiDoceRepo option:selected').text());
                let finalY = 53;
                for (var s = 0; s < data.length; s++) {
                    var dias = ["", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado", "Domingo"];
                    $('#tablitaDoce tbody').append('<tr>' +
                        '<td>' + dias[data[s].codi_dia] + '</td>' +
                        '<td>' + data[s].hora + '</td>' +
                        '<td>' + data[s].nomb_salo + '</td>' +
                        '<td>' + data[s].nomb_curs + '</td>' +
                        '<td>' + (data[s].finalizacion >= 0 ? 'En curso' : 'Finalizado') + '</td>' +
                        '</tr>'
                    );
                }
                doc.autoTable({
                    startY: finalY,
                    html: '#tablitaDoce',
                    theme: 'grid'
                });
                window.open(doc.output('bloburl', 'reporte.pdf'), '_blank');
            } else {
                M.toast({ html: 'No se han encontrado datos para este salon', classes: 'rounded' });
            }
        }
    });
}
function generarReporteCompletoDocente() {
    var desde = $('#fechInicRepoDoce').val();
    var hasta = $('#fechFinaRepoDoce').val();
    $.ajax({
        url: '../app/controllers/DocenteController',
        method: 'POST',
        data: {
            accion: 'reporteCompleto',
            fechInicRepo: desde,
            fechFinaRepo: hasta
        },
        dataType: 'JSON',
        beforeSend: function () {

        },
        success: function (data) {
            if (data.length > 0) {
                $("#tablita2Doce tbody").empty();
                var doc = new jsPDF({
                    orientation: 'p',
                    unit: 'mm',
                    format: 'letter'
                });
                var logo = new Image();
                logo.src = '../logos/RICALDONE.jpg';
                doc.addImage(logo, 'JPG', 95, 15, 25, 25)
                doc.setFontSize(15);
                var textWidth = doc.getStringUnitWidth("Horarios por Docente") * doc.internal.getFontSize() / doc.internal.scaleFactor;
                var x = (doc.internal.pageSize.width - textWidth) / 2;
                doc.text(x, 50, "Horarios por Docente");
                let finalY = 53;
                for (var s = 0; s < data.length; s++) {
                    var dias = ["", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
                    $('#tablita2Doce tbody').append('<tr>' +
                        '<td>' + dias[data[s].codi_dia] + '</td>' +
                        '<td>' + data[s].hora + '</td>' +
                        '<td>' + data[s].nomb_salo + '</td>' +
                        '<td>' + data[s].nomb_curs + '</td>' +
                        '<td>' + data[s].nomb_doce + '</td>' +
                        '<td>' + (data[s].finalizacion >= 0 ? 'En curso' : 'Finalizado') + '</td>' +
                        '</tr>'
                    );
                }
                doc.autoTable({
                    startY: finalY,
                    html: '#tablita2Doce',
                    theme: 'grid'
                });
                window.open(doc.output('bloburl', 'reporte.pdf'), '_blank');
            } else {
                M.toast({ html: 'No se encontraron datos', classes: 'rounded' });
            }
        }
    });
}