$(document).ready(function () {
    $("#tablaFact").hide();
    dataTableFacturasCasa();
    //escondiendo el progress de guardado y modificado
    $('.progress').hide();
    $('#progress2').hide();
    //opcion para que solo se cierre el modal cuando se le de click a la x
    $('.modal').modal({
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
    //SELECT FACTURA
    selectCategorias();
});
// Cargar datos a la tabla
function dataTableFacturasCasa() {
    //llenando la variable datatable
    tableUno = $('#table-factura').DataTable({
        destroy: true,
        //realizando peticion ajax para traer datos
        ajax: {
            method: 'POST',
            //url de controlador adonde se traeran los datos
            url: '../app/controllers/FacturaController.php',
            //datos que iran por el post
            data: {
                tabla: "factura"
            },
            //agregarndole el nombre del array que se traera
            dataSrc: 'data'
        },
        //agregando datos a las columnas
        columns: [{
            //agregando datos de codigo de categoria
            data: 'codi_fact',
            //pasar a invisible esa columna
            "visible": false
        }, {
            data: 'nume_fact'
        }, {
            data: "fech_emis_fact",
            "aTargets": [0],
            "render": function (data) {
                return data.split('-').reverse().join('/');
            }
        }, {
            data: "cant_fact",
            "aTargets": [0],
            "render": function (data) {
                return '$' + data;
            }
        }, {
            data: "arch_fact",
            "aTargets": [0],
            "render": function (data) {
                return '<a class="btn green white-text"  href="../web/facturas/' + data + '" target="_blank">Mostrar Factura</a>';
            }
        }, {
            data: 'esta_fact',
            "aTargets": [0],
            "render": function (data) {
                //agregando botones para abrir el modal de modificar o de eliminar categoria
                return "<a href='#verDetalle' class='ver btn-small green darken-1 waves-effect waves-ligth modal-trigger'><i class='material-icons'>visibility</i></a>"
                    + "<a href='#notificarDeleteFactura' class='delete btn-small red darken-1 waves-effect waves-ligth modal-trigger'><i class='material-icons'>delete</i></a>"
            }
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
    getIdToUpdateFactura("#table-factura tbody", tableUno);
    getIdToDeleteFactura("#table-factura tbody", tableUno);
    getIdToSeeFactura("#table-factura tbody", tableUno);
}
// Funcion para obtener el ID
function getIdToUpdateFactura(tobyd, table) {
    $('tbody').on("click", "a.update", function () {
        var data = table.row($(this).parents("tr")).data();
        $("#numeFactUpda").next("label").addClass("active");
        $("#fechEmisFactUpda").next("label").addClass("active");
        $("#cantFactUpda").next("label").addClass("active");
        var codi_fact = $("#codiFactUpda").val(data.codi_fact),
            nume_fact = $("#numeFactUpda").val(data.nume_fact),
            fech_emis_fact = $("#fechEmisFactUpda").val(data.fech_emis_fact),
            cant_fact = $("#cantFactUpda").val(data.cant_fact);
    });
}
function getIdToSeeFactura(tobyd, table) {
    $('tbody').on("click", "a.ver", function () {
        var data = table.row($(this).parents("tr")).data();
        $("#numeFactUpda").next("label").addClass("active");
        $("#fechEmisFactUpda").next("label").addClass("active");
        $("#cantFactUpda").next("label").addClass("active");
        var codi_fact = $("#codiFactUpda").val(data.codi_fact),
            nume_fact = $("#numeFactUpda").val(data.nume_fact),
            fech_emis_fact = $("#fechEmisUpda").val(data.fech_emis_fact),
            cant_fact = $("#cantFactUpda").val(data.cant_fact);
    });
}
function getIdToDeleteFactura(tobyd, table) {
    $('tbody').on("click", "a.delete", function () {
        var data = table.row($(this).parents("tr")).data();
        var nume_fact = $("#numeFactDeleNoti").val(data.nume_fact);
    });
}
function selectCategorias() {
    $.ajax({
        type: 'POST',
        url: '../app/controllers/CategoriaController.php',
        data: {
            type: 'categoria'
        },
        dataType: 'JSON',
        success: function (data) {
            $("#codiCateRepoFact").empty().append('whatever');
            $("#codiCateRepoFact").append('<option value="0" selected disabled>Seleccione la categoria:</option>');
            for (var i = 0; i < data.length; i++) {
                $("#codiCateRepoFact").append('<option value=' + data[i].codi_cate + '>' + data[i].nomb_cate + '</option>');
            }
        },
        error: function (data) {
            console.log("Error al traer datos");
        }
    });
}
function selectFacturas() {
    $.ajax({
        type: 'POST',
        url: '../app/controllers/FacturaController',
        data: {
            facturaCategoria: 'x',
            codiCateRepoFact: $('#codiCateRepoFact').val()
        },
        dataType: 'JSON',
        success: function (data) {
            $("#codiFactRepo").empty().append('whatever');
            $("#codiFactRepo").append('<option value="0" selected disabled>Seleccione la factura:</option>');
            for (var i = 0; i < data.length; i++) {
                $("#codiFactRepo").append('<option value=' + data[i].codi_fact + '>' + data[i].nume_fact + '</option>');
            }
        },
        error: function (data) {
            console.log("Error al traer datos");
        }
    });
}
function selectCursosPendientes() {
    $.ajax({
        type: 'POST',
        url: '../app/controllers/FacturaController.php',
        data: {
            cursosPendientes: 'factura'
        },
        dataType: 'JSON',
        success: function (data) {
            $("#codiCurs").empty().append('whatever');
            $("#codiCurs").append('<option value="0" selected disabled>Seleccione un curso:</option>');
            for (var i = 0; i < data.length; i++) {
                $("#codiCurs").append('<option value=' + data[i].codi_curs + '>' + data[i].corr_curs + '</option>');
            }
        },
        error: function (data) {
            console.log("Error al traer datos");
        }
    });
}

function agregarFacturaDetalle() {
    var datos = $("#facturaDetalle").serialize();
    $.ajax({
        url: '../app/controllers/FacturaDetalleController.php',
        type: 'POST',
        data: datos,
        beforeSend: function () {
            $('.modal-footer').hide();
            //se muestra el preloader
            $('#preloader').show();
        },
        success: function (data) {
            var resp = data.indexOf("Exito");
            //si la respuesta del servidores mayor o igual a 0
            if (resp >= 0) {
                successAlert("Curso agregado a la factura con exito");
                // mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando  el preloader del modal
                $('#preloader').hide();
                $('#addFacturaDetalle').modal('close');
                //reseteando el formulario para agregar categoria
                $('#facturaDetalle')[0].reset();
                // Recargando la tabla datatable
                tableUno.ajax.reload();
                selectCursosPendientes();
            } else {
                $('.modal-footer').show();
                //ocultando  el preloader del modal
                $('#preloader').hide();
                //se obtiene el texto del json del servidor
                var message = JSON.parse(data);
                //se crear el modal para mostrar el error
                errorAlert(message);
            }
        },
        error: function () {
            errorAlert("Error al contactar con el servidor");
        }
    });
}
function agregarFactura() {
    var datos = new FormData($("#factura")[0]);
    datos.append('archFact', $("#archFact")[0].files[0]);
    $.ajax({
        url: '../app/controllers/FacturaController.php',
        type: 'POST',
        processData: false,
        contentType: false,
        data: datos,
        beforeSend: function () {
            $('.modal-footer').hide();
            //se muestra el preloader
            $('#preloader').show();
        },
        success: function (data) {
            //si la respuesta del servidores mayor o igual a 0
            if (JSON.parse(data) > 0) {
                $("#codiFact").val(JSON.parse(data));
                // mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando  el preloader del modal
                $('#preloader').hide();
                //cerrando el modal de categoria
                $('#addFacturaDetalle').modal('open');
                $('#addFactura').modal('close');
                //reseteando el formulario para agregar categoria
                $('#factura')[0].reset();

                successAlert('Factura agregada con exito');
                // Recargando la tabla datatable
                tableUno.ajax.reload();
                selectCursosPendientes();
            } else {
                $('.modal-footer').show();
                //ocultando  el preloader del modal
                $('#preloader').hide();
                //se obtiene el texto del json del servidor
                var message = JSON.parse(data);
                //se crear el modal para mostrar el error
                errorAlert(message);
            }
        },
        error: function () {
            errorAlert("Error al contactar con el servidor");
        }
    });
}
function abrirModificarArchivo() {
    $("#codiFactUpdaA").val($("#codiFactUpda").val());
    $('#updateFactura').modal('close');
    $("#updateFacturaArchivo").modal("open");
}
function updateFactura() {
    var datos = $("#facturaUpda").serialize();
    $.ajax({
        url: '../app/controllers/FacturaController.php',
        type: 'POST',
        data: datos,
        beforeSend: function () {
            $('.modal-footer').hide();
            //se muestra el preloader
            $('#preloader').show();
        },
        success: function (data) {
            var resp = data.indexOf("Exito");
            //si la respuesta del servidores mayor o igual a 0
            if (resp >= 0) {
                successAlert("Factura modificada con exito");
                // mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando  el preloader del modal
                $('#preloader').hide();
                $('#updateFactura').modal('close');
                //reseteando el formulario para agregar categoria
                $('#updateFactura')[0].reset();
                // Recargando la tabla datatable
                tableUno.ajax.reload();
                selectCursosPendientes();
            } else {
                $('.modal-footer').show();
                //ocultando  el preloader del modal
                $('#preloader').hide();
                //se obtiene el texto del json del servidor
                var message = JSON.parse(data);
                //se crear el modal para mostrar el error
                errorAlert(message);
            }
        },
        error: function () {
            errorAlert("Error al contactar con el servidor");
        }
    });
}
function updateFacturaArchivo() {
    var datos = new FormData($("#facturaFactArch")[0]);
    datos.append('archFactUpda', $("#archFactUpda")[0].files[0]);
    $.ajax({
        url: '../app/controllers/FacturaController.php',
        type: 'POST',
        processData: false,
        contentType: false,
        data: datos,
        beforeSend: function () {
            $('.modal-footer').hide();
            //se muestra el preloader
            $('#preloader').show();
        },
        success: function (data) {
            //si la respuesta del servidores mayor o igual a 0
            var resp = data.indexOf("Exito");
            if (resp >= 0) {
                // mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando  el preloader del modal
                $('#preloader').hide();
                //cerrando el modal de categoria
                $('#updateFacturaArchivo').modal('close');
                //reseteando el formulario para agregar categoria
                $('#facturaFactArch')[0].reset();

                successAlert('Factura agregada con exito');
                // Recargando la tabla datatable
                tableUno.ajax.reload();
                selectCursosPendientes();
            } else {
                $('.modal-footer').show();
                //ocultando  el preloader del modal
                $('#preloader').hide();
                //se obtiene el texto del json del servidor
                var message = JSON.parse(data);
                //se crear el modal para mostrar el error
                errorAlert(message);
            }
        },
        error: function () {
            errorAlert("Error al contactar con el servidor");
        }
    });
}
function remove() {
    var datos = $("#frmDele").serialize();
    $.ajax({
        url: '../app/controllers/FacturaController.php',
        type: 'POST',
        data: datos,
        beforeSend: function () {
            $('.modal-footer').hide();
            //se muestra el preloader
            $('#preloader').show();
        },
        success: function (data) {
            var resp = data.indexOf("Exito");
            //si la respuesta del servidores mayor o igual a 0
            if (resp >= 0) {
                successAlert("Factura eliminada con exito");
                // mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando  el preloader del modal
                $('#preloader').hide();
                $('#deleteFactura').modal('close');
                //reseteando el formulario para agregar categoria
                $('#frmDele')[0].reset();
                // Recargando la tabla datatable
                tableUno.ajax.reload();
                selectCursosPendientes();
            } else {
                $('.modal-footer').show();
                //ocultando  el preloader del modal
                $('#preloader').hide();
                //se obtiene el texto del json del servidor
                var message = JSON.parse(data);
                //se crear el modal para mostrar el error
                errorAlert(message);
            }
        },
        error: function () {
            errorAlert("Error al contactar con el servidor");
        }
    });
}
function notificarDeleteFactura() {
    var datos = $("#frmDeleteF").serialize();
    $.ajax({
        url: '../app/controllers/DashboardController.php',
        method: 'POST',
        data: datos,
        success: function (data) {
            var resp = data.indexOf("Exito");
            if (resp >= 0) {
                console.log('Exito');
            } else {
                console.log(JSON.parse(data));
            }
        }
    })
}

//REPORTE DE FACTURA
function generarReporteFactura() {
    var inicio = $('#fechInicRepoFact').val();
    var final = $('#fechFinaRepoFact').val();
    var categoria = $('#codiCateRepoFact').val();
    var factura = $('#codiFactRepo').val();
    if (categoria == null) {
        generarReporteFechas(inicio, final);
    } else {
        if (factura == null) {
            generarReporteCategoria(inicio, final, categoria);
        } else {
            generarReporteFacturaEspecifico(factura);
        }
    }
}
function generarReporteFechas(inicio, final) {
    $.ajax({
        url: '../app/controllers/FacturaDetalleController',
        method: 'POST',
        data: {
            accion: 'reporteFecha',
            fechInicRepoFact: inicio,
            fechFinaRepoFact: final
        },
        dataType: 'JSON',
        success: function (data) {
            if (data.length > 0) {
                var doc = new jsPDF({
                    orientation: 'p',
                    unit: 'mm',
                    format: 'letter'
                });
                for (var e = 0; e < data.length; e++) {
                    if (e > 0) {
                        doc.addPage();
                    }
                    $("#tablitaFact tbody").empty();
                    var estado = ["Inactivo", "Pendiente de Pago", "Agregado a Quedan"];
                    var textWidth, x;
                    var logo = new Image();
                    logo.src = '../logos/RICALDONE.jpg';
                    doc.addImage(logo, 'JPG', 95, 15, 25, 25)
                    textWidth = doc.getStringUnitWidth("Factura: " + data[e].nume_fact) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                    x = (doc.internal.pageSize.width - textWidth) / 2;
                    doc.text(x, 50, "Factura: " + data[e].nume_fact);
                    textWidth = "";
                    x = "";
                    doc.setFontSize(14);
                    textWidth = doc.getStringUnitWidth("Categoria: " + data[e].nomb_cate) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                    x = (doc.internal.pageSize.width - textWidth) / 2;
                    doc.text(x, 58, "Categoria: " + data[e].nomb_cate);
                    textWidth = "";
                    x = "";
                    doc.setFontSize(13);
                    textWidth = doc.getStringUnitWidth("Fecha de Emision: " + data[e].fech_emis_fact) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                    x = (doc.internal.pageSize.width - textWidth) / 2;
                    doc.text(x, 66, "Fecha de Emision: " + data[e].fech_emis_fact);
                    textWidth = "";
                    x = "";
                    doc.setFontSize(11);
                    textWidth = doc.getStringUnitWidth("Cantidad de la Factura: $" + data[e].cant_fact) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                    x = (doc.internal.pageSize.width - textWidth) / 2;
                    doc.text(x, 74, "Cantidad de la Factura: $" + data[e].cant_fact);
                    textWidth = "";
                    x = "";
                    doc.setFontSize(12);
                    textWidth = doc.getStringUnitWidth("Estado de la Factura: " + estado[data[e].esta_fact]) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                    x = (doc.internal.pageSize.width - textWidth) / 2;
                    doc.text(x, 82, "Estado de la Factura: " + estado[data[e].esta_fact]);
                    let finalY = 86;
                    $('#tablitaFact tbody').append('<tr>' +
                        '<td>' + data[e].corr_curs + '</td>' +
                        '<td>' + data[e].nomb_curs + '</td>' +
                        '</tr>'
                    );
                    doc.autoTable({
                        startY: finalY,
                        html: '#tablitaFact',
                        theme: 'grid'
                    });
                }
                window.open(doc.output('bloburl', 'reporte.pdf'), '_blank');
            } else {
                M.toast({ html: 'No se encontro informacion para realizar el reporte' });
            }
        },
        error: function () {
            M.toast({ html: 'Error al contactar con el servidor' });
        }
    });
}
function generarReporteCategoria(inicio, final, categoria) {
    $.ajax({
        url: '../app/controllers/FacturaDetalleController',
        method: 'POST',
        data: {
            accion: 'reporteCategoria',
            fechInicRepoFact: inicio,
            fechFinaRepoFact: final,
            codiCateRepoFact: categoria
        },
        dataType: 'JSON',
        success: function (data) {
            if (data.length > 0) {
                var doc = new jsPDF({
                    orientation: 'p',
                    unit: 'mm',
                    format: 'letter'
                });
                for (var e = 0; e < data.length; e++) {
                    if (e > 0) {
                        doc.addPage();
                    }
                    $("#tablitaFact tbody").empty();
                    var estado = ["Inactivo", "Pendiente de Pago", "Agregado a Quedan"];
                    var textWidth, x;
                    var logo = new Image();
                    logo.src = '../logos/RICALDONE.jpg';
                    doc.addImage(logo, 'JPG', 95, 15, 25, 25)
                    textWidth = doc.getStringUnitWidth("Factura: " + data[e].nume_fact) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                    x = (doc.internal.pageSize.width - textWidth) / 2;
                    doc.text(x, 50, "Factura: " + data[e].nume_fact);
                    textWidth = "";
                    x = "";
                    doc.setFontSize(14);
                    textWidth = doc.getStringUnitWidth("Categoria: " + data[e].nomb_cate) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                    x = (doc.internal.pageSize.width - textWidth) / 2;
                    doc.text(x, 58, "Categoria: " + data[e].nomb_cate);
                    textWidth = "";
                    x = "";
                    doc.setFontSize(13);
                    textWidth = doc.getStringUnitWidth("Fecha de Emision: " + data[e].fech_emis_fact) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                    x = (doc.internal.pageSize.width - textWidth) / 2;
                    doc.text(x, 66, "Fecha de Emision: " + data[e].fech_emis_fact);
                    textWidth = "";
                    x = "";
                    doc.setFontSize(11);
                    textWidth = doc.getStringUnitWidth("Cantidad de la Factura: $" + data[e].cant_fact) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                    x = (doc.internal.pageSize.width - textWidth) / 2;
                    doc.text(x, 74, "Cantidad de la Factura: $" + data[e].cant_fact);
                    textWidth = "";
                    x = "";
                    doc.setFontSize(12);
                    textWidth = doc.getStringUnitWidth("Estado de la Factura: " + estado[data[e].esta_fact]) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                    x = (doc.internal.pageSize.width - textWidth) / 2;
                    doc.text(x, 82, "Estado de la Factura: " + estado[data[e].esta_fact]);
                    let finalY = 86;
                    $('#tablitaFact tbody').append('<tr>' +
                        '<td>' + data[e].corr_curs + '</td>' +
                        '<td>' + data[e].nomb_curs + '</td>' +
                        '</tr>'
                    );
                    doc.autoTable({
                        startY: finalY,
                        html: '#tablitaFact',
                        theme: 'grid'
                    });
                }
                window.open(doc.output('bloburl', 'reporte.pdf'), '_blank');
            } else {
                M.toast({ html: 'No se encontro informacion para realizar el reporte' });
            }
        },
        error: function () {
            M.toast({ html: 'Error al contactar con el servidor' })
        }
    });
}
function generarReporteFacturaEspecifico(factura) {
    $.ajax({
        url: '../app/controllers/FacturaDetalleController',
        method: 'POST',
        data: {
            accion: 'reporteFactura',
            codiFactRepo: factura
        },
        dataType: 'JSON',
        success: function (data) {
            if (data.length > 0) {
                $("#tablitaFact tbody").empty();
                var estado = ["Inactivo", "Pendiente de Pago", "Agregado a Quedan"];
                var textWidth, x;
                var doc = new jsPDF({
                    orientation: 'p',
                    unit: 'mm',
                    format: 'letter'
                });
                var logo = new Image();
                logo.src = '../logos/RICALDONE.jpg';
                doc.addImage(logo, 'JPG', 95, 15, 25, 25)
                doc.setFontSize(15);
                textWidth = doc.getStringUnitWidth("Factura: " + data[0].nume_fact) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                x = (doc.internal.pageSize.width - textWidth) / 2;
                doc.text(x, 50, "Factura: " + data[0].nume_fact);
                textWidth = "";
                x = "";
                doc.setFontSize(14);
                textWidth = doc.getStringUnitWidth("Categoria: " + data[0].nomb_cate) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                x = (doc.internal.pageSize.width - textWidth) / 2;
                doc.text(x, 58, "Categoria: " + data[0].nomb_cate);
                textWidth = "";
                x = "";
                doc.setFontSize(13);
                textWidth = doc.getStringUnitWidth("Fecha de Emision: " + data[0].fech_emis_fact) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                x = (doc.internal.pageSize.width - textWidth) / 2;
                doc.text(x, 66, "Fecha de Emision: " + data[0].fech_emis_fact);
                textWidth = "";
                x = "";
                doc.setFontSize(11);
                textWidth = doc.getStringUnitWidth("Cantidad de la Factura: $" + data[0].cant_fact) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                x = (doc.internal.pageSize.width - textWidth) / 2;
                doc.text(x, 74, "Cantidad de la Factura: $" + data[0].cant_fact);
                textWidth = "";
                x = "";
                doc.setFontSize(12);
                textWidth = doc.getStringUnitWidth("Estado de la Factura: " + estado[data[0].esta_fact]) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                x = (doc.internal.pageSize.width - textWidth) / 2;
                doc.text(x, 82, "Estado de la Factura: " + estado[data[0].esta_fact]);
                let finalY = 86;
                for (var s = 0; s < data.length; s++) {
                    $('#tablitaFact tbody').append('<tr>' +
                        '<td>' + data[s].corr_curs + '</td>' +
                        '<td>' + data[s].nomb_curs + '</td>' +
                        '</tr>'
                    );
                }
                doc.autoTable({
                    startY: finalY,
                    html: '#tablitaFact',
                    theme: 'grid'
                });
                window.open(doc.output('bloburl', 'reporte.pdf'), '_blank');
            } else {
                M.toast({ html: 'No se encontro informacion para realizar el reporte' });
            }
        },
        error: function () {
            M.toast({ html: 'Error al contactar con el servidor' })
        }
    });
}