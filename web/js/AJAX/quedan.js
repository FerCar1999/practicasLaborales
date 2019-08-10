$(document).ready(function() {
    dataTableQuedanCasa();
    selectFacturasPendientes();
    
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
function dataTableQuedanCasa() {
    //llenando la variable datatable
    tableUno = $('#table-quedan').DataTable({
        destroy: true,
        //realizando peticion ajax para traer datos
        ajax: {
            method: 'POST',
            //url de controlador adonde se traeran los datos
            url: '../app/controllers/QuedanController.php',
            //datos que iran por el post
            data: {
                tabla: "quedan"
            },
            //agregarndole el nombre del array que se traera
            dataSrc: 'data'
        },
        //agregando datos a las columnas
        columns: [{
            //agregando datos de codigo de categoria
            data: 'codi_qued',
            //pasar a invisible esa columna
            "visible": false
        }, {
            data: 'nume_qued'
        }, {
            data: "fech_emis",
            "aTargets": [0],
            "render": function(data) {
                return data.split('-').reverse().join('/');
            }
        }, {
            data: "cant_fact"
        }, {
            data: "arch_qued",
            "aTargets": [0],
            "render": function(data) {
                return '<a class="btn green white-text"  href="../web/quedan/'+data+'" target="_blank">Mostrar Quedan</a>';
            }
        }, {
            data: "esta_qued",
            "aTargets":[0],
            "render": function (data) { 
                if (data == 1) {
                   return "<a href='#notificarDeleteQuedan' class='delete btn-small red darken-1 waves-effect waves-ligth modal-trigger'><i class='material-icons'>delete</i></a>" + "  <a href='#updateQuedanEstado' class='updateEs btn-small blue darken-1 waves-effect waves-ligth modal-trigger'><i class='material-icons'>attach_money</i></a>";
                } else {
                    if (data==2) {
                        return "<a href='#verificarQuedanEstado' class='updateVe btn-small green darken-1 waves-effect waves-ligth modal-trigger'><i class='material-icons'>attach_money</i></a>";
                    } else {
                        if (data==3) {
                            return " ";
                        }
                    }
                }
             }
            //agregando botones para abrir el modal de modificar o de eliminar categoria
            
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
    getIdToUpdateQuedan("#table-quedan tbody", tableUno);
    getIdToDeleteQuedan("#table-quedan tbody", tableUno);
    getIdToUpdateEstadoQuedan("#table-quedan tbody", tableUno);
    getIdToVerificarEstadoQuedan("#table-quedan tbody", tableUno);
}
// Funcion para obtener el ID
function getIdToUpdateQuedan(tobyd, table) {
    $('tbody').on("click", "a.delete", function() {
        var data = table.row($(this).parents("tr")).data();
        var codi_qued = $("#codiQuedaDele").val(data.codi_qued);
    });
}

function getIdToDeleteQuedan(tobyd, table) {
    $('tbody').on("click", "a.delete", function() {
        var data = table.row($(this).parents("tr")).data();
        var nume_qued = $("#numeQuedDeleNoti").val(data.nume_qued);
    });
}
function getIdToUpdateEstadoQuedan(tobyd, table) {
    $('tbody').on("click", "a.updateEs", function() {
        var data = table.row($(this).parents("tr")).data();
        var codi_qued = $("#codiQuedUpdaEsta").val(data.codi_qued);
    });
}
function getIdToVerificarEstadoQuedan(tobyd, table) {
    $('tbody').on("click", "a.updateVe", function() {
        var data = table.row($(this).parents("tr")).data();
        var codi_qued = $("#codiQuedUpdaFinEsta").val(data.codi_qued);
    });
}
function selectFacturasPendientes() {
    $.ajax({
        type: 'POST',
        url: '../app/controllers/QuedanController.php',
        data: {
            facturasP: 'factura'
        },
        dataType: 'JSON',
        success: function(data) {
            $("#codiFact").empty().append('whatever');
            $("#codiFact").append('<option value="0" selected disabled>Seleccione una factura:</option>');
                for (var i = 0; i < data.length; i++) {
                    $("#codiFact").append('<option value=' + data[i].codi_fact + '>' + data[i].nume_fact + '</option>');
                }
        },
        error: function(data) {
            console.log("Error al traer datos");
        }
    });
}

function agregarQuedanDetalle() {
    var datos = $("#quedanDetalle").serialize();
            $.ajax({
                url: '../app/controllers/QuedanDetalleController.php',
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
                        successAlert("Factura agregada al quedan con exito");
                        // mostrando el footer del modal
                        $('.modal-footer').show();
                        //ocultando  el preloader del modal
                        $('#preloader').hide();
                        //reseteando el formulario para agregar categoria
                        $('#quedanDetalle')[0].reset();
                        // Recargando la tabla datatable
                        tableUno.ajax.reload();
                        selectFacturasPendientes();
                        obtenerMonto();
                    } else {
                        if (data.indexOf("Limite")>=0) {
                            errorAlert("Al parecer ya no puede agregarle mas facturas al quedan");
                            $("#addDetalle").hide();
                        } else {
                            $('.modal-footer').show();
                            //ocultando  el preloader del modal
                            $('#preloader').hide();
                            //se obtiene el texto del json del servidor
                            var message = JSON.parse(data);
                            //se crear el modal para mostrar el error
                            errorAlert(message);
                        }
                    }
                },
                error: function() {
                    errorAlert("Error al contactar con el servidor");
                }
            });
        }
        function obtenerMonto() {  
            var codi = $("#codiQued").val();
            $.ajax({
                url: '../app/controllers/QuedanDetalleController.php',
                type: 'POST',
                data: {
                    codiQued : codi,
                    accion : 'monto'
                }, 
                success: function (data) { 
                    console.log(data);
                    $("#monto").text("$"+JSON.parse(data))
                 }
            });
        }
function agregarQuedan(){
    var datos = new FormData($("#quedan")[0]);
    datos.append('archQuedan', $("#archQuedan")[0].files[0]);
            $.ajax({
                url: '../app/controllers/QuedanController.php',
                type: 'POST',
                processData: false,
                contentType :false,
                data: datos,
                beforeSend: function() {
                    $('.modal-footer').hide();
                    //se muestra el preloader
                    $('#preloader').show();
                },
                success: function(data) {
                    //si la respuesta del servidores mayor o igual a 0
                    if (JSON.parse(data) > 0) {
                        $("#codiQued").val(JSON.parse(data));
                        // mostrando el footer del modal
                        $('.modal-footer').show();
                        //ocultando  el preloader del modal
                        $('#preloader').hide();
                        //cerrando el modal de categoria
                        $('#addQuedanDetalle').modal('open');
                        $('#addQuedan').modal('close');
                        //reseteando el formulario para agregar categoria
                        $('#quedan')[0].reset();
                        
                        successAlert('Quedan agregado con exito');
                        // Recargando la tabla datatable
                        tableUno.ajax.reload();
                        selectFacturasPendientes();
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
function notificarAbono() {  
    var datos = $("#updateQuedEsta").serialize();
    $.ajax({
        url: '../app/controllers/QuedanController.php',
        type: 'POST',
        data : datos,
        beforeSend : function () {  
            $('.modal-footer').hide();
        },
        success : function (data) {  
            var resp = data.indexOf("Exito");
            if (resp>=0) {
                $('.modal-footer').show();
                $('#updateQuedanEstado').modal('close');
                        //reseteando el formulario para agregar categoria
                        $('#updateQuedEsta')[0].reset();
                        successAlert('Notificacion enviada con exito');
                        // Recargando la tabla datatable
                        tableUno.ajax.reload();
            } else {
                $('.modal-footer').show();
                        var message = JSON.parse(data);
                        //se crear el modal para mostrar el error
                        errorAlert(message);
            }
        }
    });
}
function notificarVerificacionAbono() {  
    var datos = $("#veriQuedEsta").serialize();
    $.ajax({
        url: '../app/controllers/QuedanController.php',
        type: 'POST',
        data : datos,
        beforeSend : function () {  
            $('.modal-footer').hide();
        },
        success : function (data) {  
            var resp = data.indexOf("Exito");
            if (resp>=0) {
                $('.modal-footer').show();
                $('#verificarQuedanEstado').modal('close');
                        //reseteando el formulario para agregar categoria
                        $('#veriQuedEsta')[0].reset();
                        successAlert('Notificacion enviada con exito');
                        // Recargando la tabla datatable
                        tableUno.ajax.reload();
            } else {
                $('.modal-footer').show();
                        var message = JSON.parse(data);
                        //se crear el modal para mostrar el error
                        errorAlert(message);
            }
        }
    });
}
function enviarNotificacion() {  
    var datos = $("#codiQued").val();
    $.ajax({
        url: '../app/controllers/QuedanDetalleController.php',
        type: 'POST',
        data : {
            accion : 'agregandoQuedan',
            codiQuedNoti: datos
        },
        beforeSend : function () {  
            $('.modal-footer').hide();
        },
        success : function (data) {  
            var resp = data.indexOf("Exito");
            if (resp>=0) {
                $('.modal-footer').show();
                $('#addQuedanDetalle').modal('close');
                        //reseteando el formulario para agregar categoria
                        $('#quedanDetalle')[0].reset();
                        successAlert('Notificacion enviada con exito');
                        // Recargando la tabla datatable
                        tableUno.ajax.reload();
            } else {
                $('.modal-footer').show();
                        var message = JSON.parse(data);
                        //se crear el modal para mostrar el error
                        errorAlert(message);
            }
        }
    });
}
function notificarDeleteQuedan() {
    var datos = $("#frmDeleteQ").serialize();
    $.ajax({
        url : '../app/controllers/DashboardController.php',
        method: 'POST',
        data: datos,
        success : function (data) {
            var resp = data.indexOf("Exito");
            if (resp>=0) {
                console.log('Exito');
            } else {
                console.log(JSON.parse(data));
            }
        }
    })
}