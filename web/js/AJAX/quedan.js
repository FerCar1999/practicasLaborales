$(document).ready(function() {
    verificarPresupuestoMostrar();
    selectCasasRestantes();
    //ejecutando la funcion datatable
    //escondiendo el progress de guardado y modificado
    $('.progress').hide();
    $('#progress2').hide();
    //opcion para que solo se cierre el modal cuando se le de click a la x
    $('.modal').modal({
        dismissible: false
    });
});
// Cargar datos a la tabla
function dataTablePresupuestoCasa() {
    //llenando la variable datatable
    tableUno = $('#table-presupuesto-casa').DataTable({
        destroy: true,
        //realizando peticion ajax para traer datos
        ajax: {
            method: 'POST',
            //url de controlador adonde se traeran los datos
            url: '../app/controllers/PresupuestoDetalleController.php',
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
            data: 'codi_pres_deta',
            //pasar a invisible esa columna
            "visible": false
        }, {
            data: 'codi_cate',
            "visible": false
        }, {
            data: 'nomb_cate'
        }, {
            data: "cant_pres_deta",
            "aTargets": [0],
            "render": function(data) {
                return '$' + data;
            }
        }, {
            data: 'fech_pres_deta'
        }, {
            //agregando dato de estado de categoria
            data: 'arch_pres_deta',
            "aTargets": [0],
            "render": function(data) {
                return '<a class="btn green white-text" target="_blank" href="../web/documentos/' + data + '"> Ver Comprobate</a>';
            }
        }, {
            //agregando botones para abrir el modal de modificar o de eliminar categoria
            defaultContent: "<a href='#deleteEgreso' class='delete btn-small red darken-1 waves-effect waves-ligth modal-trigger'>Eliminar</a>"
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
    getIdToUpdateCasa("#table-presupuesto-casa tbody", tableUno);
    getIdToDeleteCasa("#table-presupuesto-casa tbody", tableUno);
}
// Funcion para obtener el ID
function getIdToUpdateCasa(tobyd, table) {
    $('tbody').on("click", "a.delete", function() {
        var data = table.row($(this).parents("tr")).data();
        var codi_pres_deta = $("#codiPresDetaUpda").val(data.codi_pres_deta);
    });
}

function getIdToDeleteCasa(tobyd, table) {
    $('tbody').on("click", "a.delete", function() {
        var data = table.row($(this).parents("tr")).data();
        var codi_pres_deta = $("#codiPresDetaDele").val(data.codi_pres_deta);
    });
}

function dataTablePresupuestoCasas() {
    //llenando la variable datatable
    tableDos = $('#table-presupuesto-casas').DataTable({
        destroy: true,
        //realizando peticion ajax para traer datos
        ajax: {
            method: 'POST',
            //url de controlador adonde se traeran los datos
            url: '../app/controllers/PresupuestoController.php',
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
            data: 'codi_pres',
            //pasar a invisible esa columna
            "visible": false
        }, {
            data: "nomb_casa"
        }, {
            //agregando datos de nombre de categoria
            data: 'cant_pres',
            "aTargets": [0],
            "render": function(data) {
                return '$' + data;
            }
        }, {
            //agregando dato de estado de categoria
            data: 'cant_rest',
            "aTargets": [0],
            "render": function(data) {
                return '$' + data;
            }
        }, {
            //agregando botones para abrir el modal de modificar o de eliminar categoria
            defaultContent: "<a href='#updateIngreso' class='delete btn-small blue darken-1 waves-effect waves-ligth modal-trigger'><i class='material-icons'>create</i></a> " + "<a href='#deleteIngreso' class='delete btn-small red darken-1 waves-effect waves-ligth modal-trigger'><i class='material-icons'>delete</i></a>"
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
    getIdToUpdateCasas("#table-presupuesto-casa tbody", tableDos);
    getIdToDeleteCasas("#table-presupuesto-casa tbody", tableDos);
}
// Funcion para obtener el ID
function getIdToUpdateCasas(tobyd, table) {
    $('tbody').on("click", "a.delete", function() {
        var datax = table.row($(this).parents("tr")).data();
        $("#cantPresUpda").next("label").addClass("active");
        var codi_pres = $("#codiPresUpda").val(datax.codi_pres),
            cant_pres = $('#cantPresUpda').val(datax.cant_pres);
    });
}

function getIdToDeleteCasas(tobyd, table) {
    $('tbody').on("click", "a.delete", function() {
        var datax = table.row($(this).parents("tr")).data();
        var codi_pres = $("#codiPresDele").val(datax.codi_pres);
    });
}

function verificarPresupuestoMostrar() {
    $.ajax({
        url: '../app/controllers/PresupuestoController',
        type: 'POST',
        data: {
            'accion': 'verficarInfo'
        },
        success: function(data) {
            if (JSON.parse(data) == 'casa') {
                $('[href="#casas"]').closest('li').hide();
                dataTablePresupuestoCasa();
            } else {
                dataTablePresupuestoCasa();
                dataTablePresupuestoCasas();
            }
        },
        error: function() {
            console.log("Error")
        }
    });
}

function agregarIngreso() {
    var formularioIngreso = $("#frmAddIngre").serialize();
    if (isNaN($("#cantPres").val())) {
        $('#cantPres').addClass('invalid');
        errorAlert("El valor tiene que ser un número")
    } else {
        if ($('#cantPres').val() != 0) {
            $.ajax({
                url: '../app/controllers/PresupuestoController',
                type: 'POST',
                data: formularioIngreso,
                beforeSend: function() {
                    $('.modal-footer').hide();
                    //se muestra el preloader
                    $('#preloader').show();
                },
                success: function(data) {
                    var resp = data.indexOf("Exito");
                    //si la respuesta del servidores mayor o igual a 0
                    if (resp >= 0) {
                        //se oculta el footer del modal
                        //se muestra el mensaje de confirmación
                        successAlert("Ingreso agregado con exito");
                        
                        // mostrando el footer del modal
                        $('.modal-footer').show();
                        //ocultando  el preloader del modal
                        $('#preloader').hide();
                        //cerrando el modal de categoria
                        $('#addIngreso').modal('close');
                        //reseteando el formulario para agregar categoria
                        $('#frmAddIngre')[0].reset();
                        selectCasasRestantes();
                        // Recargando la tabla datatable
                        tableUno.ajax.reload();
                        tableDos.ajax.reload();
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
        } else {
            warningAlert("Debe agregar una cantidad mayor a 0");
        }
    }
}

function selectCasasRestantes() {
    $.ajax({
        type: 'POST',
        url: '../app/controllers/PresupuestoController.php',
        data: {
            accion: 'getCasasRestantes'
        },
        dataType: 'JSON',
        success: function(data) {
            if ($.isEmptyObject(data)) {
                $("#agregarIngreso").hide();
            } else {
                $("#agregarIngreso").show();
                $("#codiCasaIngre").empty().append('whatever');
                $("#codiCasaIngre").append('<option value="0" selected disabled>Seleccione la casa:</option>');
                for (var i = 0; i < data.length; i++) {
                    $("#codiCasaIngre").append('<option value=' + data[i].codi_casa + '>' + data[i].nomb_casa + '</option>');
                }
            }
        },
        error: function(data) {
            console.log("Error al traer datos");
        }
    });
}

function agregarGasto() {
    var formularioGasto = new FormData($("#frmAddEgreso")[0]);
    formularioGasto.append('archPresDeta', $("#archPresDeta")[0].files[0]);
    if (isNaN($("#cantPresDeta").val())) {
        $('#cantPresDeta').addClass('invalid');
        errorAlert("El valor tiene que ser un número")
    } else {
        if ($('#cantPresDeta').val() != 0) {
            $.ajax({
                url: '../app/controllers/PresupuestoDetalleController',
                type: 'POST',
                processData: false,
                contentType: false,
                data: formularioGasto,
                beforeSend: function() {
                    $('.modal-footer').hide();
                    //se muestra el preloader
                    $('#preloader').show();
                },
                success: function(data) {
                    var resp = data.indexOf("Exito");
                    //si la respuesta del servidores mayor o igual a 0
                    if (resp >= 0) {
                        //se oculta el footer del modal
                        //se muestra el mensaje de confirmación
                        successAlert("Ingreso agregado con exito");
                        
                        // mostrando el footer del modal
                        $('.modal-footer').show();
                        //ocultando  el preloader del modal
                        $('#preloader').hide();
                        //cerrando el modal de categoria
                        $('#addEgreso').modal('close');
                        //reseteando el formulario para agregar categoria
                        $('#frmAddEgreso')[0].reset();
                        // Recargando la tabla datatable
                        tableUno.ajax.reload();
                        tableDos.ajax.reload();
                        selectCasasRestantes();
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
        } else {
            warningAlert("Debe agregar una cantidad mayor a 0");
        }
    }
}

function modificarIngreso() {
    var formularioIngreso = $("#frmUpdaIngre").serialize();
    if (isNaN($("#cantPresUpda").val())) {
        $('#cantPresUpda').addClass('invalid');
        errorAlert("El valor tiene que ser un número")
    } else {
        if ($('#cantPresUpda').val() != 0) {
            $.ajax({
                url: '../app/controllers/PresupuestoController',
                type: 'POST',
                data: formularioIngreso,
                beforeSend: function() {
                    $('.modal-footer').hide();
                    //se muestra el preloader
                    $('#preloader').show();
                },
                success: function(data) {
                    var resp = data.indexOf("Exito");
                    //si la respuesta del servidores mayor o igual a 0
                    if (resp >= 0) {
                        //se oculta el footer del modal
                        //se muestra el mensaje de confirmación
                        successAlert("Ingreso agregado con exito");
                        
                        // mostrando el footer del modal
                        $('.modal-footer').show();
                        //ocultando  el preloader del modal
                        $('#preloader').hide();
                        //cerrando el modal de categoria
                        $('#updateIngreso').modal('close');
                        //reseteando el formulario para agregar categoria
                        $('#frmUpdaIngre')[0].reset();
                        selectCasasRestantes();
                        // Recargando la tabla datatable
                        tableUno.ajax.reload();
                        tableDos.ajax.reload();
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
        } else {
            warningAlert("Debe agregar una cantidad mayor a 0");
        }
    }
}

function deleteIngreso() {
    var formularioIngreso = $("#frmDeleIngre").serialize();
    $.ajax({
        url: '../app/controllers/PresupuestoController',
        type: 'POST',
        data: formularioIngreso,
        beforeSend: function() {
            $('.modal-footer').hide();
            //se muestra el preloader
        },
        success: function(data) {
            var resp = data.indexOf("Exito");
            //si la respuesta del servidores mayor o igual a 0
            if (resp >= 0) {
                //se oculta el footer del modal
                //se muestra el mensaje de confirmación
                successAlert("Ingreso eliminado con exito");
                
                selectCasasRestantes();
                // mostrando el footer del modal
                $('.modal-footer').show();
                //cerrando el modal de categoria
                $('#deleteIngreso').modal('close');
                //reseteando el formulario para agregar categoria
                $('#frmDeleIngre')[0].reset();
                // Recargando la tabla datatable
                tableUno.ajax.reload();
                tableDos.ajax.reload();
            } else {
                $('.modal-footer').show();
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
function deleteGasto() {
    var formularioIngreso = $("#frmDeleEgre").serialize();
    $.ajax({
        url: '../app/controllers/PresupuestoDetalleController',
        type: 'POST',
        data: formularioIngreso,
        beforeSend: function() {
            $('.modal-footer').hide();
            //se muestra el preloader
        },
        success: function(data) {
            var resp = data.indexOf("Exito");
            //si la respuesta del servidores mayor o igual a 0
            if (resp >= 0) {
                //se oculta el footer del modal
                //se muestra el mensaje de confirmación
                successAlert("Gasto eliminado con exito");
                
                // mostrando el footer del modal
                $('.modal-footer').show();
                //cerrando el modal de categoria
                $('#deleteEgreso').modal('close');
                //reseteando el formulario para agregar categoria
                $('#frmDeleEgre')[0].reset();
                selectCasasRestantes();
                // Recargando la tabla datatable
                tableUno.ajax.reload();
                tableDos.ajax.reload();
            } else {
                $('.modal-footer').show();
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