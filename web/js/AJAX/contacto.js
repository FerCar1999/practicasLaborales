//creando la variable de la tabla
var table;

$(document).ready(function () {
    $('.tooltipped').tooltip();
    $('select').select2();
    //ejecutando la funcion datatable
    //$("#tabla").hide();
    dataTable();
    //escondiendo el progress de guardado y modificado
    $('.progress').hide();
    $('#progress2').hide();
    //opcion para que solo se cierre el modal cuando se le de click a la x
    $('.modal').modal({
        dismissible: false
    });
    selectEtiquetasContacto();
    selectProfesionesContacto();
});
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

function selectProfesionesContacto() {
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

function dataTable() {
    //$("#tabla").show();
    //var codi = $("#codiEtiqTabl").val();
    //llenando la variable datatable
    table = $('#table-contacto').DataTable({
        destroy: true,
        //realizando peticion ajax para traer datos
        ajax: {
            method: 'POST',
            //url de controlador adonde se traeran los datos
            url: '../app/controllers/ContactoController.php',
            //datos que iran por el post
            data: {
                tabla: "contacto"
                //codiEtiqTabl: codi
            },
            //agregarndole el nombre del array que se traera
            dataSrc: 'data'
        },
        //agregando datos a las columnas
        columns: [{
            //agregando datos de codigo de categoria
            data: 'codi_cont',
            //pasar a invisible esa columna
            "visible": false
        }, {
            //agregando datos de codigo de categoria
            data: 'codi_prof',
            //pasar a invisible esa columna
            "visible": false
        }, {
            //agregando datos de codigo de categoria
            data: 'nomb_prof',
            "visible": false
        }, {
            //agregando datos de codigo de categoria
            data: 'nomb_cont'
        }, {
            //agregando datos de nombre de categoria
            data: 'apel_cont'
        }, {
            //agregando datos de codigo de categoria
            data: 'empr_cont'
        }, {
            //agregando datos de codigo de categoria
            data: 'carg_cont'
        }, {
            //agregando datos de codigo de categoria
            data: 'dire_cont',
            //pasar a invisible esa columna
            "visible": false
        }, {
            //agregando datos de codigo de categoria
            data: 'corr_cont'
        }, {
            //agregando datos de codigo de categoria
            data: 'tele_celu_cont'
        }, {
            //agregando datos de codigo de categoria
            data: 'tele_fijo_cont',
            //pasar a invisible esa columna
            "visible": false
        }, {
            //agregando datos de codigo de categoria
            data: 'obse_cont',
            //pasar a invisible esa columna
            "visible": false
        }, {
            //agregando botones para abrir el modal de modificar o de eliminar categoria
            defaultContent: "<a href='#updateContacto' class='update btn-small blue darken-1 waves-effect waves-ligth modal-trigger'>Modificar</a>"
                + "  <a href='#deleteContacto' class='delete btn-small red darken-1 waves-effect waves-ligth modal-trigger'>Eliminar</a>"
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
    getDataToUpdate("#table-contacto tbody", table);
    // Llamamos al metodo para obtener el id del registro, para eliminar
    getIdToDelete("#table-contacto tbody", table);
    //table.ajax.reload();
}
// Funcion para obtener datos para modificar
function getDataToUpdate(tbody, table) {
    //table.ajax.reload();
    $('tbody').on("click", "a.update", function () {
        var data = table.row($(this).parents("tr")).data();
        $("#nombContUpda").next("label").addClass("active");
        $("#apelContUpda").next("label").addClass("active");
        $("#corrContUpda").next("label").addClass("active");
        $("#teleCeluContUpda").next("label").addClass("active");
        $("#emprContUpda").next("label").addClass("active");
        $("#direContUpda").next("label").addClass("active");
        $("#teleFijoContUpda").next("label").addClass("active");
        $("#cargContUpda").next("label").addClass("active");
        $("#obseContUpda").next("label").addClass("active");
        var codi_cont = $("#codiContUpda").val(data.codi_cont),
            codi_prof = $("#codiProfUpda").val(data.codi_prof),
            nomb_cont = $("#nombContUpda").val(data.nomb_cont),
            apel_cont = $("#apelContUpda").val(data.apel_cont),
            corr_cont = $("#corrContUpda").val(data.corr_cont),
            tele_celu_cont = $("#teleCeluContUpda").val(data.tele_celu_cont),
            tele_fijo_cont = $("#teleFijoContUpda").val(data.tele_fijo_cont),
            empr_cont = $("#emprContUpda").val(data.empr_cont),
            dire_cont = $("#direContUpda").val(data.dire_cont),
            carg_cont = $("#cargContUpda").val(data.carg_cont),
            obse_cont = $("#obseContUpda").val(data.obse_cont);
        setCodiSelect(data.codi_cont);
        $("#codiProfUpda").change();
        $("#codiProfUpda").trigger('change.select2');
    });
}
function setCodiSelect(codi) {
    $.ajax({
        url: '../app/controllers/ContactoEtiquetaController',
        method: 'POST',
        data: {
            type: 'x',
            codiContEtiq: codi
        },
        dataType: 'JSON',
        success: function (data) {
            var concatenado = new Array();
            for (var d = 0; d < data.length; d++) {
                concatenado[d] = data[d].codi_etiq;
            }
            console.log(concatenado);
            $("#codiEtiqUpda").val(concatenado);
            $("#codiEtiqUpda").change();
            $("#codiEtiqUpda").trigger('change.select2');
        }
    });
}
// Funcion para obtener el ID
function getIdToDelete(tobyd, table) {
    $('tbody').on("click", "a.delete", function () {
        var data = table.row($(this).parents("tr")).data();
        var codi_cont = $("#codiContDele").val(data.codi_cont)
    });
}
// Funcion para agregar
function create() {
    //obteniendo los datos del formulario
    var datos = $('#frmAdd').serialize();
    $.ajax({
        //metodo que se va a usar
        method: "POST",
        //ruta de controlador de categoria
        url: "../app/controllers/ContactoController.php",
        //data que se va a enviar por post
        data: datos,
        beforeSend: function () {
            //se oculta el footer del modal
            $('.modal-footer').hide();
            //se muestra el preloader
            $('#preloader').show();
        },
        //funcion en el caso de que la peticion sea correcta
        success: function (data) {
            //obteniendo valor de la respuesta del servidor
            //var resp = data.indexOf("Exito");
            //si la respuesta del servidores mayor o igual a 0
            if (JSON.parse(data) > 0) {
                createEtiquetaContacto(JSON.parse(data));
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
function createEtiquetaContacto(codiCont) {
    var codigos = $("#codiEtiq").val();
    var concatenado = "";
    for (var d = 0; d < codigos.length; d++) {
        concatenado += codigos[d];
        if (d != (codigos.length - 1)) {
            concatenado += ",";
        }
    }
    $.ajax({
        url: '../app/controllers/ContactoEtiquetaController',
        method: 'POST',
        data: {
            accion: 'create',
            codiCont: codiCont,
            codiEtiq: concatenado
        },
        success: function (data) {
            var resp = data.indexOf("Exito");
            if (resp >= 0) {
                //se muestra el mensaje de confirmación
                M.toast({ html: "Contacto agregado con exito", classes: 'rounded' });
                // Recargando la tabla datatable
                table.ajax.reload();
                // mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando  el preloader del modal
                $('#preloader').hide();
                //cerrando el modal de categoria
                $('#addContacto').modal('close');
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
        url: "../app/controllers/ContactoController.php",
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
                updateEtiquetaContacto();
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
function updateEtiquetaContacto() {
    var codigos = $("#codiEtiqUpda").val();
    var concatenado = "";
    for (var d = 0; d < codigos.length; d++) {
        concatenado += codigos[d];
        if (d != (codigos.length - 1)) {
            concatenado += ",";
        }
    }
    $.ajax({
        url: '../app/controllers/ContactoEtiquetaController',
        method: 'POST',
        data: {
            accion: 'update',
            codiContUpda: $("#codiContUpda").val(),
            codiEtiqUpda: concatenado
        },
        success: function (data) {
            var resp = data.indexOf("Exito");
            if (resp >= 0) {
                //creando modal para el mensaje de confirmación
                M.toast({ html: "Contacto modificado con exito", classes: 'rounded' });
                // Recargando la tabla
                table.ajax.reload();
                //Mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando el preloader
                $('#preloader').hide();
                //ocultando modal para modificar la categoria
                $('#updateContacto').modal('close');
                //reseteando el formulario
                $('#frmUpdate')[0].reset();
            } else {
                //se obtiene el texto del json del servidor
                var message = JSON.parse(data);
                //se crear el modal para mostrar el error
                M.toast({ html: message, classes: 'rounded' });
                $('.modal-footer').show();
                //ocultando  el preloader del modal
                $('#preloader').hide();
            }
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
        url: "../app/controllers/ContactoController.php",
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
                M.toast({ html: "Contacto eliminado con exito", classes: 'rounded' });
                // Recargando la tabla
                table.ajax.reload();
                //mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando el preloader
                $('#preloader').hide();
                //cerrando modal de eliminar categoria
                $('#deleteContacto').modal('close');
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
                var modPag = h%10;
                var posicionX = h%2;
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
                    col=0;
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