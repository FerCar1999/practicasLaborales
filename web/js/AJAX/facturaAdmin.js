$(document).ready(function() {
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
            "render": function(data) {
                return data.split('-').reverse().join('/');
            }
        }, {
            data: "cant_fact",
            "aTargets": [0],
            "render": function(data) {
                return '$'+data;
            }
        }, {
            data: "arch_fact",
            "aTargets": [0],
            "render": function(data) {
                return '<a class="btn green white-text"  href="../web/facturas/'+data+'" target="_blank">Mostrar Factura</a>';
            }
        }, {
            data: 'esta_fact',
            "aTargets": [0],
            "render": function (data) { 
                if (data==1) {
                    //agregando botones para abrir el modal de modificar o de eliminar categoria
                    return "<a href='#updateFactura' class='update btn-small blue darken-1 waves-effect waves-ligth modal-trigger'><i class='material-icons'>build</i></a>"+
                    "  <a href='#deleteFactura' class='delete btn-small red darken-1 waves-effect waves-ligth modal-trigger'><i class='material-icons'>delete</i></a>"
                } else {
                    return "<a href='#verDetalle' class='ver btn-small green darken-1 waves-effect waves-ligth modal-trigger'><i class='material-icons'>visibility</i></a>"
                }
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
    $('tbody').on("click", "a.update", function() {
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
    $('tbody').on("click", "a.ver", function() {
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
    $('tbody').on("click", "a.delete", function() {
        var data = table.row($(this).parents("tr")).data();
        var codi_fact = $("#codiFactDele").val(data.codi_fact);
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
        success: function(data) {
            $("#codiCurs").empty().append('whatever');
            $("#codiCurs").append('<option value="0" selected disabled>Seleccione un curso:</option>');
                for (var i = 0; i < data.length; i++) {
                    $("#codiCurs").append('<option value=' + data[i].codi_curs + '>' + data[i].corr_curs + '</option>');
                }
        },
        error: function(data) {
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
                beforeSend: function() {
                    $('.modal-footer').hide();
                    //se muestra el preloader
                    $('#preloader').show();
                },
                success: function(data) {
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
                error: function() {
                    errorAlert("Error al contactar con el servidor");
                }
            });
        }
function agregarFactura(){
    var datos = new FormData($("#factura")[0]);
    datos.append('archFact', $("#archFact")[0].files[0]);
            $.ajax({
                url: '../app/controllers/FacturaController.php',
                type: 'POST',
                processData: false,
                contentType: false,
                data: datos,
                beforeSend: function() {
                    $('.modal-footer').hide();
                    //se muestra el preloader
                    $('#preloader').show();
                },
                success: function(data) {
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
                error: function() {
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
                beforeSend: function() {
                    $('.modal-footer').hide();
                    //se muestra el preloader
                    $('#preloader').show();
                },
                success: function(data) {
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
                error: function() {
                    errorAlert("Error al contactar con el servidor");
                }
            });
        }
function updateFacturaArchivo(){
    var datos = new FormData($("#facturaFactArch")[0]);
    datos.append('archFactUpda', $("#archFactUpda")[0].files[0]);
            $.ajax({
                url: '../app/controllers/FacturaController.php',
                type: 'POST',
                processData: false,
                contentType: false,
                data: datos,
                beforeSend: function() {
                    $('.modal-footer').hide();
                    //se muestra el preloader
                    $('#preloader').show();
                },
                success: function(data) {
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
                error: function() {
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
                beforeSend: function() {
                    $('.modal-footer').hide();
                    //se muestra el preloader
                    $('#preloader').show();
                },
                success: function(data) {
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
                error: function() {
                    errorAlert("Error al contactar con el servidor");
                }
            });
        }