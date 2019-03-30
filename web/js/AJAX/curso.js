var tableUno, tableDos;
$(document).ready(function() {
    $('.progress').hide();
    $('#progressAvance').show();
    $('#progressAvance2').show();
    $(".modal").modal({
        dismissible: false
    });
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
    verificarCursoMostrar();
    selectCategorias();
    selectDocentes();
    selectHorarios();
    selectSalones();
});

function dataTableCursoCasa() {
    //llenando la variable datatable
    tableUno = $('#table-curso-casa').DataTable({
        destroy: true,
        //realizando peticion ajax para traer datos
        ajax: {
            method: 'POST',
            //url de controlador adonde se traeran los datos
            url: '../app/controllers/CursoController',
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
            data: 'codi_curs',
            //pasar a invisible esa columna
            "visible": false
        }, {
            data: "codi_cate",
            "visible": false
        }, {
            //agregando datos de nombre de categoria
            data: 'nomb_cate'
        }, {
            //agregando dato de estado de categoria
            data: 'nomb_curs'
        }, {
            data: 'fech_inic'
        }, {
            data: 'fech_fin'
        }, {
            //agregando botones para abrir el modal de modificar o de eliminar categoria
            defaultContent: "<div class='center-btn'>" + 
            "<a href='#updateCurso' class='update  btn-small blue darken-1 waves-effect waves-light modal-trigger'><i class='material-icons'>create</i></a> " + 
            "<a href='#deleteCurso' class='delete btn-small red waves-effect waves-light modal-trigger'><i class='material-icons'>delete</i></a>" + 
            "</div>"
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
    // Llamamos al metodo para obtener el id del registro, para eliminar
    getIdToUpdateCurso("#table-curso-casa tbody", tableUno);
    getIdToDeleteCurso("#table-curso-casa tbody", tableUno);
}
// Funcion para obtener el ID
function getIdToUpdateCurso(tobyd, table) {
    $('tbody').on("click", "a.update", function() {
        var data = table.row($(this).parents("tr")).data();
        $("#nombCursUpda").next("label").addClass("active");
        $("#fechInicUpda").next("label").addClass("active");
        $("#fechFinUpda").next("label").addClass("active");
        var codi_curs = $("#codiCursUpda").val(data.codi_curs),
            nomb_curs = $("#nombCursUpda").val(data.nomb_curs),
            fech_inic = $("#fechInicUpda").val(data.fech_inic),
            fech_fin = $("#fechFinUpda").val(data.fech_fin),
            codi_cate = $("#codiCateUpda").val(data.codi_cate);
        $("#codiCateUpda").change();
        $("#codiCateUpda").trigger('change.select2');
    });
}

function getIdToDeleteCurso(tobyd, table) {
    $('tbody').on("click", "a.delete", function() {
        var data = table.row($(this).parents("tr")).data();
        var codi_curs = $("#codiCursDele").val(data.codi_curs);
    });
}

function dataTableCursoCasas() {
    //llenando la variable datatable
    tableDos = $('#table-curso-casas').DataTable({
        destroy: true,
        //realizando peticion ajax para traer datos
        ajax: {
            method: 'POST',
            //url de controlador adonde se traeran los datos
            url: '../app/controllers/CursoController',
            //datos que iran por el post
            data: {
                tabla: "casas"
            },
            //agregarndole el nombre del array que se traera
            dataSrc: 'data'
        },
        //agregando datos a las columnas
        columns: [{
            //agregando datos de codigo de categoria
            data: 'codi_curs',
            //pasar a invisible esa columna
            "visible": false
        }, {
            data: "codi_cate",
            "visible": false
        }, {
            //agregando datos de nombre de categoria
            data: 'nomb_cate'
        }, {
            data: 'codi_casa',
            "visible": false
        }, {
            //agregando dato de estado de categoria
            data: 'nomb_casa'
        }, {
            data: 'nomb_curs'
        }, {
            data: 'fech_inic'
        }, {
            data: 'fech_fin'
        }, {
            //agregando botones para abrir el modal de modificar o de eliminar categoria
            defaultContent: "<a href='#verCurso' class='seeC btn-small light-blue waves-effect waves-ligth modal-trigger'><i class='material-icons'>visibility</i></a>"
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
    getIdSeeCursos("#table-curso-casas tbody", tableDos);
}

function getIdSeeCursos(tobyd, table) {
    $('tbody').on("click", "a.seeC", function() {
        var data = table.row($(this).parents("tr")).data();
    });
}
// Funcion para obtener el ID
function verificarCursoMostrar() {
    $.ajax({
        url: '../app/controllers/CursoController',
        type: 'POST',
        data: {
            'accion': 'verificarInfo'
        },
        success: function(data) {
            if (JSON.parse(data) == 'casa') {
                $('#casas').hide();
                dataTableCursoCasa();
            } else {
                dataTableCursoCasa();
                dataTableCursoCasas();
            }
        },
        error: function() {
            console.log("Error")
        }
    });
}

function selectCategorias() {
    $.ajax({
        type: 'POST',
        url: '../app/controllers/CategoriaController',
        data: {
            type: 'categoria'
        },
        dataType: 'JSON',
        success: function(data) {
            $("#codiCate").empty().append('whatever');
            $("#codiCate").append('<option value="0" selected disabled>Seleccione la categoria:</option>');
            $("#codiCateUpda").empty().append('whatever');
            $("#codiCateUpda").append('<option value="0" selected disabled>Seleccione la categoria:</option>');
            for (var i = 0; i < data.length; i++) {
                $("#codiCate").append('<option value=' + data[i].codi_cate + '>' + data[i].nomb_cate + '</option>');
                $("#codiCateUpda").append('<option value=' + data[i].codi_cate + '>' + data[i].nomb_cate + '</option>');
            }
        },
        error: function(data) {
            console.log("Error al traer datos");
        }
    });
}
function selectHorarios() {
    var codiDia = $('#codiDia').val();
    console.log($('#codiDia').val());
    $.ajax({
        type: 'POST',
        url: '../app/controllers/HorarioController',
        data: {
            type: 'categoria',
            codiDia : codiDia
        },
        dataType: 'JSON',
        success: function(data) {
            $("#codiHora").empty().append('whatever');
            $("#codiHora").append('<option value="0" selected disabled>Seleccione el horario:</option>');
            $("#codiHoraUpda").empty().append('whatever');
            $("#codiHoraUpda").append('<option value="0" selected disabled>Seleccione el horario:</option>');
            for (var i = 0; i < data.length; i++) {
                $("#codiHora").append('<option value=' + data[i].codi_hora + '>' + data[i].hora_inic + ' - ' + data[i].hora_fin + '</option>');
                $("#codiHoraUpda").append('<option value=' + data[i].codi_hora + '>' + data[i].hora_inic + ' - ' + data[i].hora_fin + '</option>');
            }
        },
        error: function(data) {
            console.log("Error al traer datos");
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
        success: function(data) {
            $("#codiSalo").empty().append('whatever');
            $("#codiSalo").append('<option value="0" selected disabled>Seleccione el salon:</option>');
            $("#codiSaloUpda").empty().append('whatever');
            $("#codiSaloUpda").append('<option value="0" selected disabled>Seleccione el salon:</option>');
            for (var i = 0; i < data.length; i++) {
                $("#codiSalo").append('<option value=' + data[i].codi_salo + '>' + data[i].nomb_salo + '</option>');
                $("#codiSaloUpda").append('<option value=' + data[i].codi_salo + '>' + data[i].nomb_salo + '</option>');
            }
        },
        error: function(data) {
            console.log("Error al traer datos");
        }
    });
}
function selectDocentes() {
    $.ajax({
        type: 'POST',
        url: '../app/controllers/DocenteController',
        data: {
            type: 'categoria'
        },
        dataType: 'JSON',
        success: function(data) {
            $("#codiDoce").empty().append('whatever');
            $("#codiDoce").append('<option value="0" selected disabled>Seleccione el docente:</option>');
            $("#codiDoceUpda").empty().append('whatever');
            $("#codiDoceUpda").append('<option value="0" selected disabled>Seleccione el docente:</option>');
            for (var i = 0; i < data.length; i++) {
                $("#codiDoce").append('<option value=' + data[i].codi_doce + '>' + data[i].nomb_doce + ' '+data[i].apel_doce+'</option>');
                $("#codiDoceUpda").append('<option value=' + data[i].codi_doce + '>' + data[i].nomb_doce + ' '+data[i].apel_doce+'</option>');
            }
        },
        error: function(data) {
            console.log("Error al traer datos");
        }
    });
}

function create() {
    //obteniendo los datos del formulario
    var datos = $('#frmAddCurso').serialize();
    //realizando peticion ajax
    $.ajax({
        //metodo que se va a usar
        method: "POST",
        //ruta de controlador de categoria
        url: "../app/controllers/CursoController",
        //data que se va a enviar por post
        data: datos,
        beforeSend: function() {
            $('.modal-footer').hide();
            //se muestra el preloader
            $('#preloader').show();
        },
        //funcion en el caso de que la peticion sea correcta
        success: function(data) {
            //se obtiene el texto del json del servidor
                var message = JSON.parse(data);
            //si la respuesta del servidores mayor o igual a 0
            if (message > 0) {
                //se muestra el mensaje de confirmación
                successAlert("Curso agregado con exito");
                // Recargando la tabla datatable
                tableUno.ajax.reload();
                tableDos.ajax.reload();
                // mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando  el preloader del modal
                $('#preloader').hide();
                //cerrando el modal de categoria
                $('#addCurso').modal('close');
                //reseteando el formulario para agregar categoria
                $('#frmAddCurso')[0].reset();
            } else {
                $('.modal-footer').show();
                //ocultando  el preloader del modal
                $('#preloader').hide();
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
    var datos = $("#frmUpdaCurso").serialize();
    //realizando peticion ajax
    $.ajax({
        //metodo que se va a usar
        method: "POST",
        //ruta del controlador
        url: "../app/controllers/CursoController",
        //datos que se enviaran por el post
        data: datos,
        beforeSend: function() {
            //ocultando el footer del modal
            $('.modal-footer').hide();
            //mostrando el preloader
            $('#preloader').show();
        },
        //funcion en el caso de que responda correctamente el servidor
        success: function(data) {
            //obteniendo el valor de respuesta del servidor
            var resp = data.indexOf("Exito");
            //verificando que si sea exitosa la operacion
            if (resp >= 0) {
                //creando modal para el mensaje de confirmación
                successAlert("Curso modificado con exito");
                // Recargando la tabla
                tableUno.ajax.reload();
                tableDos.ajax.reload();
                //Mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando el preloader
                $('#preloader').hide();
                //ocultando modal para modificar la categoria
                $('#updateCurso').modal('close');
                //reseteando el formulario
                $('#frmUpdaCurso')[0].reset();
            } else {
                //Mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando el preloader
                $('#preloader').hide();
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
    var datos = $("#frmDeleCurso").serialize();
    //realizando peticion ajax
    $.ajax({
        //metodo que se va a utilizar
        method: "POST",
        //url del controlador
        url: "../app/controllers/CursoController",
        //datos que se enviaran en el post
        data: datos,
        beforeSend: function() {
            //ocultanod el footer del modal
            $('.modal-footer').hide();
            //mostrando el preloader 
            $('#preloader').show();
        },
        //funcion si el servidor responde
        success: function(data) {
            //obteniendo valor de la respuesta del servidor
            var resp = data.indexOf("Exito");
            //verificando si la respuesta es exitosa
            if (resp >= 0) {
                // Mensaje de confirmación
                successAlert("Curso eliminado con exito");
                // Recargando la tabla
                tableUno.ajax.reload();
                tableDos.ajax.reload();
                //mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando el preloader
                $('#preloader').hide();
                //cerrando modal de eliminar categoria
                $('#deleteCurso').modal('close');
                //reseateando formulario
                $('#frmDeleCurso')[0].reset();
            } else {
                //mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando el preloader
                $('#preloader').hide();
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