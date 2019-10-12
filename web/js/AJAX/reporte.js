$(document).ready(function () {
    $('select').select2();
    $('.progress').hide();
    $('#progress2').hide();
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        i18n: {
            months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sept", "Oct", "Nov", "Dic"],
            weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
            weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
            weekdaysAbbrev: ["D", "L", "M", "M", "J", "V", "S"]
        },
        container: 'body'
    });
    //opcion para que solo se cierre el modal cuando se le de click a la x
    $('.modal').modal({
        dismissible: false
    });
    //SELECT DE CONTACTO
    selectEtiquetasContacto();
    //SELECT DE EVENTO
    selectEventosEventoE();
    //SELECT DE DOCENTE
    selectDocentes();
    //SELECT SALONES
    selectSalones();
    //SELECT FACTURA
    selectCategorias();
    //OCULTANDO TABLA EVENTO
    $("#tablitaEven").hide();
    //OCULTANDO TABLAS DOCENTE
    $("#tablaDoce").hide();
    $("#tabla2Doce").hide();
    //OCULTANDO TABLAS SALON
    $("#tablaSalo").hide();
    $("#tabla2Salo").hide();
    //OCULTANTO FACTURA
    $("#tablaFact").hide();
});

//TRAER INFORMACION PARA SELECT
//SELECT CONTACTO
function selectEtiquetasContacto() {
    $.ajax({
        type: 'POST',
        url: '../app/controllers/EtiquetaController.php',
        data: {
            tipo: 'tipo'
        },
        dataType: 'JSON',
        success: function (data) {
            $("#codiEtiq").empty().append('whatever');
            $("#codiEtiqUpda").empty().append('whatever');
            $("#codiEtiqRepoCont").empty().append('whatever');
            $("#codiEtiqTabl").empty().append('whatever');
            $("#codiEtiqTabl").append('<option value="0" selected disabled>Seleccione la etiqueta:</option>');
            for (var i = 0; i < data.length; i++) {
                $("#codiEtiq").append('<option value=' + data[i].codi_etiq + '>' + data[i].nomb_etiq + '</option>');
                $("#codiEtiqUpda").append('<option value=' + data[i].codi_etiq + '>' + data[i].nomb_etiq + '</option>');
                $("#codiEtiqRepoCont").append('<option value=' + data[i].codi_etiq + '>' + data[i].nomb_etiq + '</option>');
                $("#codiEtiqTabl").append('<option value=' + data[i].codi_etiq + '>' + data[i].nomb_etiq + '</option>');
            }
        },
        error: function (data) {
            console.log("Error al traer datos");
        }
    });
}
function selectContactosEtiquetas() {
    var etiqueta = $("#codiEtiqRepoCont").val();
    $.ajax({
        type: 'POST',
        url: '../app/controllers/ContactoController.php',
        data: {
            type: 'contacto',
            codiEtiqRepo: etiqueta
        },
        dataType: 'JSON',
        success: function (data) {
            $("#codiContRepo").empty().append('whatever');
            for (var i = 0; i < data.length; i++) {
                $("#codiContRepo").append('<option value=' + data[i].codi_cont + '>' + data[i].nomb_cont + '</option>');
            }
        },
        error: function (data) {
            console.log("Error al traer datos");
        }
    });
}
//SELECT EVENTO 
function selectEventosEventoE() {
    $.ajax({
        type: 'POST',
        url: '../app/controllers/EventoController.php',
        data: {
            tipo: 'eventos'
        },
        dataType: 'JSON',
        success: function (data) {
            $("#codiEvenRepo").empty().append('whatever');
            $("#codiEvenRepo").append('<option value="0" selected disabled>Seleccione el evento:</option>');
            for (var i = 0; i < data.length; i++) {
                $("#codiEvenRepo").append('<option value=' + data[i].codi_even + '>' + data[i].nomb_even + '</option>');
            }
        },
        error: function (data) {
            console.log("Error al traer datos");
        }
    });
}
function selectEtiquetaEventosE() {
    $.ajax({
        type: 'POST',
        url: '../app/controllers/EtiquetaController.php',
        data: {
            etiquetasEvento: 'eventos',
            codiEven: $('#codiEvenRepo').val()
        },
        dataType: 'JSON',
        success: function (data) {
            $("#codiEtiqRepoEven").empty().append('whatever');
            for (var i = 0; i < data.length; i++) {
                $("#codiEtiqRepoEven").append('<option value=' + data[i].codi_etiq + '>' + data[i].nomb_etiq + '</option>');
            }
        },
        error: function (data) {
            console.log("Error al traer datos");
        }
    });
}
//SELECT DOCENTES
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
//SELECT SALONES
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
//SELECT FACTURAS
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
//REPORTE DE CONTACTO
//posiciones de las cartas
var x = [10, 115];
var y = [20, 70, 120, 170, 220];
var info = ['Nombre: ', 'Cargo: \n', 'Empresa:', 'Dirección: \n'];
var col = 0;
function reporteContacto() {
    var codigos = $("#codiContRepo").val();
    var concatenado = "";
    for (var d = 0; d < codigos.length; d++) {
        concatenado += codigos[d];
        if (d != (codigos.length - 1)) {
            concatenado += ",";
        }
    }
    $.ajax({
        url: '../app/controllers/ContactoController',
        method: 'POST',
        data:
        {
            accion: 'reporte',
            codiContRepo: concatenado,
            codiEtiqRepo: $("#codiEtiqRepoCont").val()
        },
        dataType: 'JSON',
        success: function (data) {
            var doc = new jsPDF({
                orientation: 'p',
                unit: 'mm',
                format: 'letter'
            });
            //console.log(data);
            for (var h = 0; h < data.length; h++) {
                //verificando si se necesita otra pagina
                var modPag = h % 10;
                var posicionX = h % 2;
                //obteniedo ultimo dato de la posicion del dato
                var toText = h.toString(); //convert to string
                var lastChar = toText.slice(-1); //gets last character
                var posicionY = +(lastChar); //convert last character to number
                if (modPag == 0 & h > 0) {
                    doc.addPage();
                }
                doc.setFontSize(12);
                if (posicionX == 0) {
                    switch (posicionY) {
                        case 0: case 1:
                            for (var i = 0; i < 4; i++) {
                                switch (i) {
                                    case 0:
                                        doc.text(x[posicionX], (y[0] + col), info[i] + data[h][i]);
                                        col += 6;
                                        break;
                                    case 1:
                                        doc.text(x[posicionX], (y[0] + col), info[i] + concatenarTextoLargo(data[h][i]));
                                        col += 15;
                                        break;
                                    case 2:
                                        doc.text(x[posicionX], (y[0] + col), info[i] + data[h][i]);
                                        col += 6;
                                        break;
                                    case 3:
                                        doc.text(x[posicionX], (y[0] + col), info[i] + concatenarTextoLargo(data[h][i]));
                                        col += 6;
                                        break;
                                }
                            }
                            break;
                        case 2: case 3:
                            for (var i = 0; i < 4; i++) {
                                switch (i) {
                                    case 0:
                                        doc.text(x[posicionX], (y[1] + col), info[i] + data[h][i]);
                                        col += 6;
                                        break;
                                    case 1:
                                        doc.text(x[posicionX], (y[1] + col), info[i] + concatenarTextoLargo(data[h][i]));
                                        col += 15;
                                        break;
                                    case 2:
                                        doc.text(x[posicionX], (y[1] + col), info[i] + data[h][i]);
                                        col += 6;
                                        break;
                                    case 3:
                                        doc.text(x[posicionX], (y[1] + col), info[i] + concatenarTextoLargo(data[h][i]));
                                        col += 6;
                                        break;
                                }
                            }
                            break;
                        case 4: case 5:
                            for (var i = 0; i < 4; i++) {
                                switch (i) {
                                    case 0:
                                        doc.text(x[posicionX], (y[2] + col), info[i] + data[h][i]);
                                        col += 6;
                                        break;
                                    case 1:
                                        doc.text(x[posicionX], (y[2] + col), info[i] + concatenarTextoLargo(data[h][i]));
                                        col += 15;
                                        break;
                                    case 2:
                                        doc.text(x[posicionX], (y[2] + col), info[i] + data[h][i]);
                                        col += 6;
                                        break;
                                    case 3:
                                        doc.text(x[posicionX], (y[2] + col), info[i] + concatenarTextoLargo(data[h][i]));
                                        col += 6;
                                        break;
                                }
                            }
                            break;
                        case 6: case 7:
                            for (var i = 0; i < 4; i++) {
                                switch (i) {
                                    case 0:
                                        doc.text(x[posicionX], (y[3] + col), info[i] + data[h][i]);
                                        col += 6;
                                        break;
                                    case 1:
                                        doc.text(x[posicionX], (y[3] + col), info[i] + concatenarTextoLargo(data[h][i]));
                                        col += 15;
                                        break;
                                    case 2:
                                        doc.text(x[posicionX], (y[3] + col), info[i] + data[h][i]);
                                        col += 6;
                                        break;
                                    case 3:
                                        doc.text(x[posicionX], (y[3] + col), info[i] + concatenarTextoLargo(data[h][i]));
                                        col += 6;
                                        break;
                                }
                            }
                            break;
                        case 8: case 9:
                            for (var i = 0; i < 4; i++) {
                                switch (i) {
                                    case 0:
                                        doc.text(x[posicionX], (y[4] + col), info[i] + data[h][i]);
                                        col += 6;
                                        break;
                                    case 1:
                                        doc.text(x[posicionX], (y[4] + col), info[i] + concatenarTextoLargo(data[h][i]));
                                        col += 15;
                                        break;
                                    case 2:
                                        doc.text(x[posicionX], (y[4] + col), info[i] + data[h][i]);
                                        col += 6;
                                        break;
                                    case 3:
                                        doc.text(x[posicionX], (y[4] + col), info[i] + concatenarTextoLargo(data[h][i]));
                                        col += 6;
                                        break;
                                }
                            }
                            break;
                    }
                    col = 0;
                } else {
                    switch (posicionY) {
                        case 0: case 1:
                            for (var i = 0; i < 4; i++) {
                                switch (i) {
                                    case 0:
                                        doc.text(x[posicionX], (y[0] + col), info[i] + data[h][i]);
                                        col += 6;
                                        break;
                                    case 1:
                                        doc.text(x[posicionX], (y[0] + col), info[i] + concatenarTextoLargo(data[h][i]));
                                        col += 15;
                                        break;
                                    case 2:
                                        doc.text(x[posicionX], (y[0] + col), info[i] + data[h][i]);
                                        col += 6;
                                        break;
                                    case 3:
                                        doc.text(x[posicionX], (y[0] + col), info[i] + concatenarTextoLargo(data[h][i]));
                                        col += 6;
                                        break;
                                }
                            }
                            break;
                        case 2: case 3:
                            for (var i = 0; i < 4; i++) {
                                switch (i) {
                                    case 0:
                                        doc.text(x[posicionX], (y[1] + col), info[i] + data[h][i]);
                                        col += 6;
                                        break;
                                    case 1:
                                        doc.text(x[posicionX], (y[1] + col), info[i] + concatenarTextoLargo(data[h][i]));
                                        col += 15;
                                        break;
                                    case 2:
                                        doc.text(x[posicionX], (y[1] + col), info[i] + data[h][i]);
                                        col += 6;
                                        break;
                                    case 3:
                                        doc.text(x[posicionX], (y[1] + col), info[i] + concatenarTextoLargo(data[h][i]));
                                        col += 6;
                                        break;
                                }
                            }
                            break;
                        case 4: case 5:
                            for (var i = 0; i < 4; i++) {
                                switch (i) {
                                    case 0:
                                        doc.text(x[posicionX], (y[2] + col), info[i] + data[h][i]);
                                        col += 6;
                                        break;
                                    case 1:
                                        doc.text(x[posicionX], (y[2] + col), info[i] + concatenarTextoLargo(data[h][i]));
                                        col += 15;
                                        break;
                                    case 2:
                                        doc.text(x[posicionX], (y[2] + col), info[i] + data[h][i]);
                                        col += 6;
                                        break;
                                    case 3:
                                        doc.text(x[posicionX], (y[2] + col), info[i] + concatenarTextoLargo(data[h][i]));
                                        col += 6;
                                        break;
                                }
                            }
                            break;
                        case 6: case 7:
                            for (var i = 0; i < 4; i++) {
                                switch (i) {
                                    case 0:
                                        doc.text(x[posicionX], (y[3] + col), info[i] + data[h][i]);
                                        col += 6;
                                        break;
                                    case 1:
                                        doc.text(x[posicionX], (y[3] + col), info[i] + concatenarTextoLargo(data[h][i]));
                                        col += 15;
                                        break;
                                    case 2:
                                        doc.text(x[posicionX], (y[3] + col), info[i] + data[h][i]);
                                        col += 6;
                                        break;
                                    case 3:
                                        doc.text(x[posicionX], (y[3] + col), info[i] + concatenarTextoLargo(data[h][i]));
                                        col += 6;
                                        break;
                                }
                            }
                            break;
                        case 8: case 9:
                            for (var i = 0; i < 4; i++) {
                                switch (i) {
                                    case 0:
                                        doc.text(x[posicionX], (y[4] + col), info[i] + data[h][i]);
                                        col += 6;
                                        break;
                                    case 1:
                                        doc.text(x[posicionX], (y[4] + col), info[i] + concatenarTextoLargo(data[h][i]));
                                        col += 15;
                                        break;
                                    case 2:
                                        doc.text(x[posicionX], (y[4] + col), info[i] + data[h][i]);
                                        col += 6;
                                        break;
                                    case 3:
                                        doc.text(x[posicionX], (y[4] + col), info[i] + concatenarTextoLargo(data[h][i]));
                                        col += 6;
                                        break;
                                }
                            }
                            break;
                    }
                    col = 0;
                }
            }
            window.open(doc.output('bloburl', 'reporte.pdf'), '_blank');
        }
    });
}
//REPORTE DE EVENTO
function reporteEvento() {
    var evento = $('#codiEvenRepo').val();
    var etiqueta = $('#codiEtiqRepoEven').val();
    for (var i = 0; i < etiqueta.length; i++) {
        $.ajax({
            url: '../app/controllers/EventoDetalleController',
            method: 'POST',
            data: {
                accion: 'reporte',
                codiEvenRepo: evento,
                codiEtiqRepo: etiqueta[i]
            },
            dataType: 'JSON',
            beforeSend: function () {

            },
            success: function (data) {
                if (data.length > 0) {
                    console.log(data);
                    $("#tablitaEven tbody").empty();
                    var doc = new jsPDF({
                        orientation: 'p',
                        unit: 'mm',
                        format: 'letter'
                    });
                    var logo = new Image();
                    logo.src = '../logos/RICALDONE.jpg';
                    doc.addImage(logo, 'JPG', 95, 15, 25, 25)
                    doc.setFontSize(15);
                    var textWidth = doc.getStringUnitWidth("Evento: " + $('#codiEvenRepo option:selected').text()) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                    var x = (doc.internal.pageSize.width - textWidth) / 2;
                    doc.text(x, 50, "Evento: " + $('#codiEvenRepo option:selected').text());
                    let finalY = 60;
                    doc.setFontSize(12);
                    var textWidth = doc.getStringUnitWidth("Evento: " + data[0].nomb_etiq) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                    var equis = (doc.internal.pageSize.width - textWidth) / 2;
                    doc.text(equis, finalY, "Etiqueta: " + data[0].nomb_etiq);
                    for (var s = 0; s < data.length; s++) {
                        $('#tablitaEven tbody').append('<tr>' +
                            '<td>' + data[s].nomb_cont + '</td>' +
                            '<td>' + data[s].empr_cont + '</td>' +
                            '<td>' + (data[s].conf_even_deta == 0 ? 'No Realizada' : 'Realizada') + '</td>' +
                            '<td>' + (data[s].asis_even_deta == 0 ? 'No Realizada' : 'Realizada') + '</td>' +
                            '</tr>'
                        );
                    }
                    doc.autoTable({
                        startY: finalY + 10,
                        html: '#tablitaEven'
                    });
                    window.open(doc.output('bloburl', 'reporte.pdf'), '_blank');
                } else {
                    M.toast({ html: "No se encontraron datos de esta etiqueta", classes: 'rounded' });
                }
            }
        });
    }
}
//REPORTE DE DOCENTE
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
//REPORTE DE SALONES
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
//REPORTE DE FACTURA
function generarReporteFactura() {
    var inicio = $('#fechInicRepoFact').val();
    var final = $('#fechFinaRepoFact').val();
    var categoria = $('#codiCateRepoFact').val();
    var factura = $('#codiFactRepo').val();
    if (categoria == null) {
        generarReporteFechasFactura(inicio, final);
    } else {
        if (factura == null) {
            generarReporteCategoria(inicio, final, categoria);
        } else {
            generarReporteFacturaEspecifico(factura);
        }
    }
}
function generarReporteFechasFactura(inicio, final) {
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
//REPORTE DE QUEDAN
function generarReporteQuedan() {
    var inicio = $('#fechInicRepoFact').val();
    var final = $('#fechFinaRepoFact').val();
    var casa = $('#codiCateRepoFact').val();
    var quedan = $('#codiFactRepo').val();
    if (casa == null) {
        generarReporteFechasQuedan(inicio, final);
    } else {
        if (quedan == null) {
            generarReporteCasa(inicio, final, casa);
        } else {
            generarReporteQuedanEspecifico(quedan);
        }
    }
}
function generarReporteFechasQuedan(inicio, final) {
    $.ajax({
        url: '../app/controllers/QuedanDetalleController',
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
                    $("#tablitaQued tbody").empty();
                    var estado = ["Inactivo", "Quedan Agregado", "Quedan Abonado", "Quedan Pagado"];
                    var textWidth, x;
                    var logo = new Image();
                    logo.src = '../logos/RICALDONE.jpg';
                    doc.addImage(logo, 'JPG', 95, 15, 25, 25)
                    textWidth = doc.getStringUnitWidth("Quedan: " + data[e].nume_fact) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                    x = (doc.internal.pageSize.width - textWidth) / 2;
                    doc.text(x, 50, "Quedan: " + data[e].nume_fact);
                    textWidth = "";
                    x = "";
                    doc.setFontSize(13);
                    textWidth = doc.getStringUnitWidth("Fecha de Emision: " + data[e].fech_emis) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                    x = (doc.internal.pageSize.width - textWidth) / 2;
                    doc.text(x, 58, "Fecha de Emision: " + data[e].fech_emis);
                    textWidth = "";
                    x = "";
                    doc.setFontSize(13);
                    textWidth = doc.getStringUnitWidth("Fecha de Abono: " + data[e].fech_abon) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                    x = (doc.internal.pageSize.width - textWidth) / 2;
                    doc.text(x, 66, "Fecha de Abono: " + data[e].fech_emis_abon);
                    textWidth = "";
                    x = "";
                    doc.setFontSize(11);
                    textWidth = doc.getStringUnitWidth("Cantidad de Facturas: " + data[e].cant_fact) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                    x = (doc.internal.pageSize.width - textWidth) / 2;
                    doc.text(x, 74, "Cantidad de Facturas: " + data[e].cant_fact);
                    textWidth = "";
                    x = "";
                    doc.setFontSize(12);
                    textWidth = doc.getStringUnitWidth("Estado del Quedan: " + estado[data[e].esta_qued]) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                    x = (doc.internal.pageSize.width - textWidth) / 2;
                    doc.text(x, 82, "Estado del Quedan: " + estado[data[e].esta_fact]);
                    let finalY = 86;
                    $.ajax({
                        url: '../app/controllers/QuedanDetalleController',
                        method: 'POST',
                        data: {
                            accion: 'detalleQuedan',
                            codiQued: data[e].codi_qued
                        },
                        success: function (datax) {
                            for (var n = 0; n > datax.length; n++) {
                                $('#tablitaQued tbody').append('<tr>' +
                                    '<td>' + datax[n].nume_fact + '</td>' +
                                    '<td>' + datax[n].corr_curs + '</td>' +
                                    '<td>' + datax[n].nomb_curs + '</td>' +
                                    '<td>' + datax[n].nomb_casa + '</td>' +
                                    '</tr>'
                                );
                            }
                        }
                    })
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
//REPORTE DE CURSO