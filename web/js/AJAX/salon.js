//creando la variable de la tabla
var table;
//creando variable para el regex
var reAlpha = /^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ\s\.,-]{1,100}/; // Regex
$(document).ready(function () {
    //ejecutando la funcion datatable
    dataTable();
    $("#tablaSalo").hide();
    $("#tabla2Salo").hide();
    //escondiendo el progress de guardado y modificado
    $('.progress').hide();
    $('#progress2').hide();
    //opcion para que solo se cierre el modal cuando se le de click a la x
    $('.modal').modal({
        dismissible: false
    });
    selectSalones();
    $('select').select2();
});
// Cargar datos a la tabla
function dataTable() {
    //llenando la variable datatable
    table = $('#table-salon').DataTable({
        destroy: true,
        //realizando peticion ajax para traer datos
        ajax: {
            method: 'POST',
            //url de controlador adonde se traeran los datos
            url: '../app/controllers/SalonController.php',
            //datos que iran por el post
            data: {
                tabla: "salon"
            },
            //agregarndole el nombre del array que se traera
            dataSrc: 'data'
        },
        //agregando datos a las columnas
        columns: [{
            //agregando datos de codigo de categoria
            data: 'codi_salo',
            //pasar a invisible esa columna
            "visible": false
        }, {
            //agregando datos de nombre de categoria
            data: 'nomb_salo'
        }, {
            //agregando botones para abrir el modal de modificar o de eliminar categoria
            defaultContent: "<a href='#updaSalon' class='update btn-small blue darken-1 waves-effect waves-ligth modal-trigger'>Modificar</a>" +
                "  <a href='#deleSalon' class='delete btn-small red darken-1 waves-effect waves-ligth modal-trigger'>Eliminar</a>"
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
    getDataToUpdate("#table-salon tbody", table);
    // Llamamos al metodo para obtener el id del registro, para eliminar
    getIdToDelete("#table-salon tbody", table);
}
// Funcion para obtener datos para modificar
function getDataToUpdate(tbody, table) {
    $('tbody').on("click", "a.update", function () {
        var data = table.row($(this).parents("tr")).data();
        $("#nombSaloUpda").next("label").addClass("active");
        var codi_salo = $("#codiSaloUpda").val(data.codi_salo),
            nomb_salo = $("#nombSaloUpda").val(data.nomb_salo);
    });
}
// Funcion para obtener el ID
function getIdToDelete(tobyd, table) {
    $('tbody').on("click", "a.delete", function () {
        var data = table.row($(this).parents("tr")).data();
        var codi_salo = $("#codiSaloDele").val(data.codi_salo);
    });
}
// Funcion para agregar
function create() {
    //obteniendo los datos del formulario
    var datos = $('#frmAdd').serialize();
    //agregando la accion que se va a realizar
    var accion = "create";
    //Validando que el campo de nombre cumpla con el regex
    if (!reAlpha.test($('#nombSalo').val())) {
        //agregando clase invalid al campo del formulario
        $("#nombSalo").addClass('invalid');
    } else {
        //realizando peticion ajax
        $.ajax({
            //metodo que se va a usar
            method: "POST",
            //ruta de controlador de categoria
            url: "../app/controllers/SalonController.php",
            //data que se va a enviar por post
            data: datos + '&accion=' + accion,
            //funcion en el caso de que la peticion sea correcta
            success: function (data) {
                //obteniendo valor de la respuesta del servidor
                var resp = data.indexOf("Exito");
                //si la respuesta del servidores mayor o igual a 0
                if (resp >= 0) {
                    //se oculta el footer del modal
                    $('.modal-footer').hide();
                    //se muestra el preloader
                    $('#preloader').show();
                    //se muestra el mensaje de confirmación
                    M.toast({ html: 'Salon agregado con exito', classes: 'rounded' });
                    // Recargando la tabla datatable
                    table.ajax.reload();
                    // mostrando el footer del modal
                    $('.modal-footer').show();
                    //ocultando  el preloader del modal
                    $('#preloader').hide();
                    //cerrando el modal de categoria
                    $('#addSalon').modal('close');
                    //reseteando el formulario para agregar categoria
                    $('#frmAdd')[0].reset();
                } else {
                    //se obtiene el texto del json del servidor
                    var message = JSON.parse(data);
                    //se crear el modal para mostrar el error
                    M.toast({ html: message, classes: 'rounded' });
                }
            },
            //funcion en el caso de que exista un error con el servidor
            error: function () {
                //creando toast para el error
                M.toast({ html: 'Error al contactar con el servidor', classes: 'rounded' });
            }
        });
    }
}
// Funcion para modificar
function update() {
    //datos del formulario
    var datos = $("#frmUpdate").serialize();
    //accion que se va a realizar
    var accion = 'update';
    //Validando que el campo de texto concuerde con el regex
    if (!reAlpha.test($('#nombSaloUpda').val())) {
        //agregando clase invalid al campo del formulario
        $("#nombSaloUpda").addClass('invalid');
    } else {
        //realizando peticion ajax
        $.ajax({
            //metodo que se va a usar
            method: "POST",
            //ruta del controlador
            url: "../app/controllers/SalonController.php",
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
                    //creando modal para el mensaje de confirmación
                    M.toast({ html: 'Salon modificado con exito', classes: 'rounded' });
                    // Recargando la tabla
                    table.ajax.reload();
                    //Mostrando el footer del modal
                    $('.modal-footer').show();
                    //ocultando el preloader
                    $('#preloader').hide();
                    //ocultando modal para modificar la categoria
                    $('#updaSalon').modal('close');
                    //reseteando el formulario
                    $('#frmUpdate')[0].reset();
                } else {
                    //obteniendo el mensaje de respuesta
                    var message = JSON.parse(data);
                    ///creando el mensaje de error
                    M.toast({ html: message, classes: 'rounded' });
                }
            },
            //funcion en el caso de que el servidor no responda
            error: function () {
                //creando modal de error
                M.toast({ html: 'Erro al contactar con el servidor', classes: 'rounded' });
            }
        });
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
        url: "../app/controllers/SalonController.php",
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
                M.toast({ html: 'Salon eliminado con exito', classes: 'rounded' });
                // Recargando la tabla
                table.ajax.reload();
                //mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando el preloader
                $('#preloader').hide();
                //cerrando modal de eliminar categoria
                $('#deleSalon').modal('close');
                //reseateando formulario
                $('#frmDele')[0].reset();
            } else {
                //obteniendo valor de respuesta
                var message = JSON.parse(data);
                //crando el mensaje de error
                M.toast({ html: message, classes: 'rounded' });
            }
        },
        //funcion en el caso de que el servidor no responda
        error: function () {
            // Mensaje de confirmación
            M.toast({ html: 'Error al contactar con el servidor', classes: 'rounded' });
        }
    });
}
function selectSalones() {
    $.ajax({
        type: 'POST',
        url: '../app/controllers/SalonController',
        data: {
            type: 'categoria'
        },
        dataType: 'JSON',
        success: function (data) {
            $("#codiSaloRepo").empty().append('whatever');
            $("#codiSaloRepo").append('<option value="0" selected disabled>Seleccione el salon:</option>');
            for (var i = 0; i < data.length; i++) {
                $("#codiSaloRepo").append('<option value=' + data[i].codi_salo + '>' + data[i].nomb_salo + '</option>');
            }
        },
        error: function (data) {
            console.log("Error al traer datos");
        }
    });
}
//AJAX GENERADOR DE REPORTES
function generarReporteSalon() {
    var salon = $('#codiSaloRepo').val();
    $.ajax({
        url: '../app/controllers/SalonController',
        method: 'POST',
        data: {
            accion: 'reporte',
            codiSaloRepo: salon
        },
        dataType: 'JSON',
        beforeSend: function () {

        },
        success: function (data) {
            if (data.length > 0) {
                $("#tablitaSalo tbody").empty();
                var doc = new jsPDF({
                    orientation: 'p',
                    unit: 'mm',
                    format: 'letter'
                });
                var logo = new Image();
                logo.src = '../logos/RICALDONE.jpg';
                doc.addImage(logo, 'JPG', 95, 15, 25, 25)
                doc.setFontSize(15);
                var textWidth = doc.getStringUnitWidth("Salón: " + $('#codiSaloRepo option:selected').text()) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                var x = (doc.internal.pageSize.width - textWidth) / 2;
                doc.text(x, 50, "Salón: " + $('#codiSaloRepo option:selected').text());
                let finalY = 53;
                for (var s = 0; s < data.length; s++) {
                    var dias = ["", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado", "Domingo"];
                    $('#tablitaSalo tbody').append('<tr>' +
                        '<td>' + dias[data[s].codi_dia] + '</td>' +
                        '<td>' + data[s].hora + '</td>' +
                        '<td>' + data[s].nomb_curs + '</td>' +
                        '<td>' + data[s].nomb_doce + '</td>' +
                        '</tr>'
                    );
                }
                doc.autoTable({
                    startY: finalY,
                    html: '#tablitaSalo',
                    theme: 'grid'
                });
                window.open(doc.output('bloburl', 'reporte.pdf'), '_blank');
            } else {
                M.toast({ html: 'No se han encontrado datos para este salon', classes: 'rounded' });
            }
        }
    });
}
function generarReporteCompletoSalon() {
    $.ajax({
        url: '../app/controllers/SalonController',
        method: 'POST',
        data: {
            accion: 'reporteCompleto'
        },
        dataType: 'JSON',
        beforeSend: function () {

        },
        success: function (data) {
            if (data.length > 0) {
                $("#tablita2Salo tbody").empty();
                var doc = new jsPDF({
                    orientation: 'p',
                    unit: 'mm',
                    format: 'letter'
                });
                var logo = new Image();
                logo.src = '../logos/RICALDONE.jpg';
                doc.addImage(logo, 'JPG', 95, 15, 25, 25)
                doc.setFontSize(15);
                var textWidth = doc.getStringUnitWidth("Horarios por Salon") * doc.internal.getFontSize() / doc.internal.scaleFactor;
                var x = (doc.internal.pageSize.width - textWidth) / 2;
                doc.text(x, 50, "Horarios por Salón");
                let finalY = 53;
                for (var s = 0; s < data.length; s++) {
                    var dias = ["", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
                    $('#tablita2Salo tbody').append('<tr>' +
                        '<td>' + dias[data[s].codi_dia] + '</td>' +
                        '<td>' + data[s].hora + '</td>' +
                        '<td>' + data[s].nomb_salo + '</td>' +
                        '<td>' + data[s].nomb_curs + '</td>' +
                        '<td>' + data[s].nomb_doce + '</td>' +
                        '</tr>'
                    );
                }
                doc.autoTable({
                    startY: finalY,
                    html: '#tablita2Salo',
                    theme: 'grid'
                });
                window.open(doc.output('bloburl', 'reporte.pdf'), '_blank');
            } else {
                M.toast({ html: 'No se encontraron datos', classes: 'rounded' });
            }
        }
    });
}