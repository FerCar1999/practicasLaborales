//creando la variable de la tabla
var table;

$(document).ready(function () {
    //ejecutando la funcion datatable
    dataTable();
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
    //escondiendo el progress de guardado y modificado
    $('.progress').hide();
    $('#progress2').hide();
    //opcion para que solo se cierre el modal cuando se le de click a la x
    $('.modal').modal({
        dismissible: false
    });
    $('select').select2();
    selectEtiquetas();
});
// Cargar datos a la tabla
function dataTable() {
    //llenando la variable datatable
    table = $('#table-evento').DataTable({
        destroy: true,
        //realizando peticion ajax para traer datos
        ajax: {
            method: 'POST',
            //url de controlador adonde se traeran los datos
            url: '../app/controllers/EventoController.php',
            //datos que iran por el post
            data: {
                tabla: "evento"
            },
            //agregarndole el nombre del array que se traera
            dataSrc: 'data'
        },
        //agregando datos a las columnas
        columns: [{
            //agregando datos de codigo de categoria
            data: 'codi_even',
            //pasar a invisible esa columna
            "visible": false
        }, {
            //agregando datos de nombre de categoria
            data: 'nomb_even'
        }, {
            data: 'desc_even'
        }, {
            //agregando dato de estado de categoria
            data: 'fech_even'
        }, {
            //agregando botones para abrir el modal de modificar o de eliminar categoria
            defaultContent: "<a href='#updateEvento' class='update btn-small blue darken-1 waves-effect waves-ligth modal-trigger'>Modificar</a>"
                + "  <a href='#deleteEvento' class='delete btn-small red darken-1 waves-effect waves-ligth modal-trigger'>Eliminar</a>"
                + "  <a href='#addEventoDetalle' class='ver btn-small blue darken-1 waves-effect waves-ligth modal-trigger'>Invitados</a>"
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
    getDataToSee("#table-evento tbody", table);
    // Llamamos al metodo para obtener los datos, para actualizar
    getDataToUpdate("#table-evento tbody", table);
    // Llamamos al metodo para obtener el id del registro, para eliminar
    getIdToDelete("#table-evento tbody", table);
}
// Funcion para obtener datos para modificar
function getDataToUpdate(tbody, table) {
    $('tbody').on("click", "a.update", function () {
        var data = table.row($(this).parents("tr")).data();
        $("#nombEvenUpda").next("label").addClass("active");
        $("#descEvenUpda").next("label").addClass("active");
        $("#fechEvenUpda").next("label").addClass("active");
        var codi_even = $("#codiEvenUpda").val(data.codi_even),
            nomb_even = $("#nombEvenUpda").val(data.nomb_even),
            desc_even = $("#descEvenUpda").val(data.desc_even),
            fech_even = $("#fechEvenUpda").val(data.fech_even);
    });
    M.textareaAutoResize($('#descEvenUpda'));
}
// Funcion para obtener el ID
function getDataToSee(tobyd, table) {
    $('tbody').on("click", "a.ver", function () {
        var data = table.row($(this).parents("tr")).data();
        var codi_even = $("#codiInviX").val(data.codi_even);
        llenadoTabla(data.codi_even)
    });
}
function getIdToDelete(tobyd, table) {
    $('tbody').on("click", "a.delete", function () {
        var data = table.row($(this).parents("tr")).data();
        var codi_even = $("#codiEvenDele").val(data.codi_even)
    });
}
function llenadoTabla(id) {
    //llenando la variable datatable
    tablex = $('#table-evento-detalle').DataTable({
        destroy: true,
        //realizando peticion ajax para traer datos
        ajax: {
            method: 'POST',
            //url de controlador adonde se traeran los datos
            url: '../app/controllers/EventoDetalleController.php',
            //datos que iran por el post
            data: {
                tabla: "evento",
                codiEven: id
            },
            //agregarndole el nombre del array que se traera
            dataSrc: 'data'
        },
        //agregando datos a las columnas
        columns: [{
            //agregando datos de codigo de categoria
            data: 'codi_even_deta',
            //pasar a invisible esa columna
            "visible": false
        }, {
            //agregando datos de nombre de categoria
            data: 'nomb_cont'
        }, {
            //agregando datos de nombre de categoria
            data: 'empr_cont'
        }, {
            data: 'nomb_etiq'
        }, {
            data: 'conf_even_deta',
            "aTargets": [0],
            "render": function (data) {
                if (data == 0) {
                    return "<a class='disabled update btn-small green darken-1 waves-effect waves-ligth modal-trigger'>No Realizada</a>";
                } else {
                    if (data == 1) {
                        return "<a class='disabled btn-small green darken-1 waves-effect waves-ligth modal-trigger'>Realizada</a>";
                    }
                }
            }
        }, {
            data: 'asis_even_deta',
            "aTargets": [0],
            "render": function (data) {
                if (data == 0) {
                    return "<a class='disabled update btn-small green darken-1 waves-effect waves-ligth modal-trigger'>No Realizada</a>";
                } else {
                    if (data == 1) {
                        return "<a class='disabled btn-small green darken-1 waves-effect waves-ligth modal-trigger'>Realizada</a>";
                    }
                }
            }
        }, {
            //agregando botones para abrir el modal de modificar o de eliminar categoria
            defaultContent: "<div class='center-btn'>" +
                "<a href='#deleteInvitado' class='delete btn-small red waves-effect waves-light modal-trigger'><i class='material-icons'>delete</i></a>" +
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
    getDataToDelete("#table-evento-detalle tbody", tablex);
}
function getDataToDelete(tobyd, table) {
    $('tbody').on("click", "a.delete", function () {
        var data = table.row($(this).parents("tr")).data();
        var codi_even_deta = $("#codiEvenDetaDele").val(data.codi_even_deta)
    });
}
// Funcion para agregar
function create() {
    //obteniendo los datos del formulario
    //creando formdata con la informacion del formulario de casa
    var datos = new FormData($("#frmAdd")[0]);
    //agregando la imagen de la casa que se ingresara
    datos.append("fotoEven", $("#fotoEven")[0].files[0]);
    //var datos = $('#frmAdd').serialize();
    $.ajax({
        //metodo que se va a usar
        method: "POST",
        //ruta de controlador de categoria
        url: "../app/controllers/EventoController.php",
        //data que se va a enviar por post
        data: datos,
        processData: false,
        contentType: false,
        beforeSend: function () {
            //se oculta el footer del modal
            $('.modal-footer').hide();
            //se muestra el preloader
            $('#preloader').show();
        },
        //funcion en el caso de que la peticion sea correcta
        success: function (data) {
            //obteniendo valor de la respuesta del servidor
            var resp = data.indexOf("Exito");
            //si la respuesta del servidores mayor o igual a 0
            if (JSON.parse(data) > 0) {
                //se muestra el mensaje de confirmación
                M.toast({ html: "Evento agregada con exito", classes: 'rounded' });
                // Recargando la tabla datatable
                table.ajax.reload();
                // mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando  el preloader del modal
                $('#preloader').hide();
                //cerrando el modal de categoria
                $('#addEvento').modal('close');
                $("#codiInviX").val(JSON.parse(data));
                $('#addEventoDetalle').modal('open');
                //reseteando el formulario para agregar categoria
                $('#frmAdd')[0].reset();
            } else {
                //se obtiene el texto del json del servidor
                var message = JSON.parse(data);
                //se crear el modal para mostrar el error
                M.toast({ html: message, classes: 'rounded' });
                $('.modal-footer').show();
                //ocultando  el preloader del modal
                $('#preloader').hide();
            }
        },
        //funcion en el caso de que exista un error con el servidor
        error: function () {
            M.toast({ html: 'Error al contactar con el servidor', classes: 'rounded' });
        }
    });
}
// Funcion para agregar
function createEventoDetalle() {
    //obteniendo los datos del formulario
    var etiqueta = $("#codiEtiq").val();
    var codigos = $("#codiCont").val();
    var concatenado = "";
    for (var d = 0; d < codigos.length; d++) {
        concatenado += codigos[d];
        if (d != (codigos.length - 1)) {
            concatenado += ",";
        }
    }
    //var datos = $('#frmAddInvitado').serialize();
    $.ajax({
        //metodo que se va a usar
        method: "POST",
        //ruta de controlador de categoria
        url: "../app/controllers/EventoDetalleController.php",
        //data que se va a enviar por post
        data: {
            accion: 'create',
            codiEtiq: etiqueta,
            codiEven: $("#codiEven").val(),
            codiCont: concatenado
        },
        beforeSend: function () {
            //se oculta el footer del modal
            $('.modal-footer').hide();
            //se muestra el preloader
            $('#preloader').show();
        },
        //funcion en el caso de que la peticion sea correcta
        success: function (data) {
            //obteniendo valor de la respuesta del servidor
            var resp = data.indexOf("Exito");
            //si la respuesta del servidores mayor o igual a 0
            if (resp >= 0) {
                //se muestra el mensaje de confirmación
                M.toast({ html: "Invitado agregado con exito", classes: 'rounded' });
                // Recargando la tabla datatable
                llenadoTabla($("#codiEven").val());
                // mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando  el preloader del modal
                $('#preloader').hide();
                //reseteando el formulario para agregar categoria
                $('#frmAddInvitado')[0].reset();
                $('#addInvitado').modal('close');
            } else {
                //se obtiene el texto del json del servidor
                var message = JSON.parse(data);
                //se crear el modal para mostrar el error
                M.toast({ html: message, classes: 'rounded' });
                $('.modal-footer').show();
                //ocultando  el preloader del modal
                $('#preloader').hide();
            }
        },
        //funcion en el caso de que exista un error con el servidor
        error: function () {
            M.toast({ html: 'Error al contactar con el servidor', classes: 'rounded' });
        }
    });
}
// Funcion para modificar
function update() {
    //datos del formulario
    var datos = $("#frmUpdate").serialize();
    $.ajax({
        //metodo que se va a usar
        method: "POST",
        //ruta del controlador
        url: "../app/controllers/EventoController.php",
        //datos que se enviaran por el post
        data: datos,
        beforeSend: function () {
            //se oculta el footer del modal
            $('.modal-footer').hide();
            //se muestra el preloader
            $('#preloader').show();
        },
        //funcion en el caso de que responda correctamente el servidor
        success: function (data) {
            //obteniendo el valor de respuesta del servidor
            var resp = data.indexOf("Exito");
            //verificando que si sea exitosa la operacion
            if (resp >= 0) {
                //creando modal para el mensaje de confirmación
                M.toast({ html: "Evento modificada con exito", classes: 'rounded' });
                // Recargando la tabla
                table.ajax.reload();
                //Mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando el preloader
                $('#preloader').hide();
                //ocultando modal para modificar la categoria
                $('#updateEvento').modal('close');
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
            M.toast({ html: "Error al contactar con el servidor", classes: 'rounded' });
        }
    });
}
function asistencia(codi) {
    //obteniendo los datos del formulario
    $.ajax({
        //metodo que se va a usar
        method: "POST",
        //ruta de controlador de categoria
        url: "../app/controllers/EventoDetalleController.php",
        //data que se va a enviar por post
        data: {
            accion: 'asistencia',
            codiEvenDetaAsis: codi
        },
        beforeSend: function () {
            //se oculta el footer del modal
            $('.modal-footer').hide();
            //se muestra el preloader
            $('#preloader').show();
        },
        //funcion en el caso de que la peticion sea correcta
        success: function (data) {
            //obteniendo valor de la respuesta del servidor
            var resp = data.indexOf("Exito");
            //si la respuesta del servidores mayor o igual a 0
            if (resp >= 0) {
                location.reload();
            } else {
                //se obtiene el texto del json del servidor
                var message = JSON.parse(data);
                //se crear el modal para mostrar el error
                M.toast({ html: message, classes: 'rounded' });
                $('.modal-footer').show();
                //ocultando  el preloader del modal
                $('#preloader').hide();
            }
        },
        //funcion en el caso de que exista un error con el servidor
        error: function () {
            M.toast({ html: 'Error al contactar con el servidor', classes: 'rounded' });
        }
    });
}
// Funcion para eliminar
function remove() {
    //datos del formulario
    var datos = $("#frmDele").serialize();
    $.ajax({
        //metodo que se va a utilizar
        method: "POST",
        //url del controlador
        url: "../app/controllers/EventoController.php",
        //datos que se enviaran en el post
        data: datos,
        beforeSend: function () {
            //se oculta el footer del modal
            $('.modal-footer').hide();
            //se muestra el preloader
            $('#preloader').show();
        },
        //funcion si el servidor responde
        success: function (data) {
            //obteniendo valor de la respuesta del servidor
            var resp = data.indexOf("Exito");
            //verificando si la respuesta es exitosa
            if (resp >= 0) {
                M.toast({ html: "Evento eliminado con exito", classes: 'rounded' });
                // Recargando la tabla
                table.ajax.reload();
                //mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando el preloader
                $('#preloader').hide();
                //cerrando modal de eliminar categoria
                $('#deleteEvento').modal('close');
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
            M.toast({ html: "Error al contactar con el servidor", classes: 'rounded' });
        }
    });
}
function removeInvitado() {
    //datos del formulario
    var datos = $("#frmDeleInvitado").serialize();
    $.ajax({
        //metodo que se va a utilizar
        method: "POST",
        //url del controlador
        url: "../app/controllers/EventoDetalleController.php",
        //datos que se enviaran en el post
        data: datos,
        beforeSend: function () {
            //se oculta el footer del modal
            $('.modal-footer').hide();
            //se muestra el preloader
            $('#preloader').show();
        },
        //funcion si el servidor responde
        success: function (data) {
            //obteniendo valor de la respuesta del servidor
            var resp = data.indexOf("Exito");
            //verificando si la respuesta es exitosa
            if (resp >= 0) {
                M.toast({ html: "Invitado eliminado con exito", classes: 'rounded' });
                // Recargando la tabla
                tablex.ajax.reload();
                //mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando el preloader
                $('#preloader').hide();
                //cerrando modal de eliminar categoria
                $('#deleteInvitado').modal('close');
                //reseateando formulario
                $('#frmDeleInvitado')[0].reset();
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
            M.toast({ html: "Error al contactar con el servidor", classes: 'rounded' });
        }
    });
}

function selectEtiquetas() {
    $.ajax({
        type: 'POST',
        url: '../app/controllers/EtiquetaController.php',
        data: {
            tipo: 'tipo'
        },
        dataType: 'JSON',
        success: function (data) {
            $("#codiEtiq").empty().append('whatever');
            $("#codiEtiq").append('<option value="0" selected disabled>Seleccione la etiqueta:</option>');
            for (var i = 0; i < data.length; i++) {
                $("#codiEtiq").append('<option value=' + data[i].codi_etiq + '>' + data[i].nomb_etiq + '</option>');
            }
        },
        error: function (data) {
            console.log("Error al traer datos");
        }
    });
}
function selectContactosEtiquetas() {
    var etiqueta = $("#codiEtiq").val();
    var codigo = $("#codiEven").val();
    $.ajax({
        type: 'POST',
        url: '../app/controllers/ContactoController.php',
        data: {
            tipo: 'contacto',
            codiEtiq: etiqueta,
            codiEven: codigo
        },
        dataType: 'JSON',
        success: function (data) {
            $("#codiCont").empty().append('whatever');
            for (var i = 0; i < data.length; i++) {
                $("#codiCont").append('<option value=' + data[i].codi_cont + '>' + data[i].nomb_cont + '</option>');
            }
        },
        error: function (data) {
            console.log("Error al traer datos");
        }
    });
}
function enviarCodigoEvento() {
    $("#codiEven").val($("#codiInviX").val());
}
function enviarInvitaciones() {
    Swal.fire({
        title: 'Estas seguro/a?',
        text: "Una vez enviados los correos no se puede revertir esta accion",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, envialos!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            var codigo = $("#codiInviX").val();
            $.ajax({
                url: '../app/controllers/EventoDetalleController',
                method: 'POST',
                data: {
                    accion: 'enviarInvitacion',
                    codiEven: codigo
                },
                success: function (data) {
                    var resp = data.indexOf("Exito");
                    if (resp >= 0) {
                        Swal.fire(
                            'Enviadas con exito!',
                            'Las invitaciones se han enviado correctamente.',
                            'success'
                        )
                    } else {
                        M.toast({ html: JSON.parse(data), classes: 'rounded' });
                    }
                },
                error: function () {
                    M.toast({ html: "Error al contactar con el servidor", classes: 'rounded' });
                }
            })
        }
    })
}
function selectTodos() {
    $('#codiCont option').prop('selected', true);
    $('#codiCont').change();
    $('#codiCont').trigger('change.select2');
}