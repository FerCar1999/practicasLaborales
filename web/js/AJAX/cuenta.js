$(document).ready(function() {
	$('.collapsible').collapsible();
    $('.tabs').tabs();
    misDatos();
    datosCasa();
    dataTable();
    selectTipoTele();
    $('#preloader').hide();
    $('.progress').hide();
    $(".modal").modal({
        dismissible: false
    });
});
// Cargar datos a la tabla
function dataTable() {
    table = $('#table-telefono').DataTable({
        destroy: true,
        ajax: {
            url: '../app/controllers/TelefonoController.php',
            method: 'POST',
            data: {
                tabla: "telelfono"
            },
            dataSrc: 'data'
        },
        columns: [{
            data: 'codi_tele',
            "visible": false
        }, {
            data: 'codi_tipo_tele',
            "visible": false
        }, {
            data: 'nomb_tipo_tele'
        }, {
            data: 'nume_tele'
        }, {
            defaultContent: "<a href='#updaTelefono' class='update btn-small blue darken-2 waves-effect waves-ligth modal-trigger'>Modificar</a>"+
            "  <a href='#deleTelefono' class='delete btn-small red darken-1 waves-effect waves-ligth modal-trigger'>Eliminar</a>"
        }],
        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        iDisplayLength: 5
    });
    $('select').select2();
    // Llamamos al metodo para obtener los datos, para actualizar
    getDataToUpdate("#table-telefono tbody", table);
    // Llamamos al metodo para obtener el id del registro, para eliminar
    getIdToDelete("#table-telefono tbody", table);
}
// Funcion para obtener datos
function getDataToUpdate(tbody, table) {
    $('tbody').on("click", "a.update", function() {
        var data = table.row($(this).parents("tr")).data();
        $("#numeTeleUpda").next("label").addClass("active");
        var codi_tele = $("#codiTeleUpda").val(data.codi_tele),
            nume_tele = $("#numeTeleUpda").val(data.nume_tele),
            codi_tipo_tele = $("#codiTipoTeleUpda").val(data.codi_tipo_tele);
        $("#codiTipoTeleUpda").change();
        $("#codiTipoTeleUpda").trigger('change.select2');
    });
}
// Funcion para obtener el ID
function getIdToDelete(tbody, table) {
    $('tbody').on("click", "a.delete", function() {
        var data = table.row($(this).parents("tr")).data();
        var codi_tele = $("#codiTeleDele").val(data.codi_tele);
    });
}

function create() {
    //obteniendo los datos del formulario
    var datos = $('#frmAdd').serialize();
    //agregando la accion que se va a realizar
    var accion = "create";
    //realizando peticion ajax
    $.ajax({
        //metodo que se va a usar
        method: "POST",
        //ruta de controlador de categoria
        url: "../app/controllers/TelefonoController.php",
        //data que se va a enviar por post
        data: datos + '&accion=' + accion,
        beforeSend: function() {
            $('.modal-footer').hide();
            //se muestra el preloader
            $('#preloader').show();
        },
        //funcion en el caso de que la peticion sea correcta
        success: function(data) {
            //obteniendo valor de la respuesta del servidor
            var resp = data.indexOf("Exito");
            //si la respuesta del servidores mayor o igual a 0
            if (resp >= 0) {
                //se oculta el footer del modal
                //se muestra el mensaje de confirmación
                successAlert("Telefono agregado con exito");
                // Recargando la tabla datatable
                table.ajax.reload();
                // mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando  el preloader del modal
                $('#preloader').hide();
                //cerrando el modal de categoria
                $('#addTelefono').modal('close');
                //reseteando el formulario para agregar categoria
                $('#frmAdd')[0].reset();
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
        //funcion en el caso de que exista un error con el servidor
        error: function() {
            //creando toast para el error
            errorAlert("Error al contactar con el servidor");
        }
    });
}
function update() {
    //obteniendo los datos del formulario
    var datos = $('#frmUpdate').serialize();
    //agregando la accion que se va a realizar
    var accion = "update";
    //realizando peticion ajax
    $.ajax({
        //metodo que se va a usar
        method: "POST",
        //ruta de controlador de categoria
        url: "../app/controllers/TelefonoController.php",
        //data que se va a enviar por post
        data: datos + '&accion=' + accion,
        beforeSend: function() {
            $('.modal-footer').hide();
            //se muestra el preloader
            $('#preloader').show();
        },
        //funcion en el caso de que la peticion sea correcta
        success: function(data) {
            //obteniendo valor de la respuesta del servidor
            var resp = data.indexOf("Exito");
            //si la respuesta del servidores mayor o igual a 0
            if (resp >= 0) {
                //se oculta el footer del modal
                //se muestra el mensaje de confirmación
                successAlert("Telefono mofificado con exito");
                // Recargando la tabla datatable
                table.ajax.reload();
                // mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando  el preloader del modal
                $('#preloader').hide();
                //cerrando el modal de categoria
                $('#updaTelefono').modal('close');
                //reseteando el formulario para agregar categoria
                $('#frmAdd')[0].reset();
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
        //funcion en el caso de que exista un error con el servidor
        error: function() {
            //creando toast para el error
            errorAlert("Error al contactar con el servidor");
        }
    });
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
        url: "../app/controllers/TelefonoController.php",
        //datos que se enviaran en el post
        data: datos + '&accion=' + accion,
        //funcion si el servidor responde
        success: function(data) {
            //obteniendo valor de la respuesta del servidor
            var resp = data.indexOf("Exito");
            //verificando si la respuesta es exitosa
            if (resp >= 0) {
                //ocultanod el footer del modal
                $('.modal-footer').hide();
                //mostrando el preloader 
                $('#preloader').show();
                // Mensaje de confirmación
                successAlert("Telefono eliminado con exito");
                // Recargando la tabla
                table.ajax.reload();
                //mostrando el footer del modal
                $('.modal-footer').show();
                //ocultando el preloader
                $('#preloader').hide();
                //cerrando modal de eliminar categoria
                $('#deleTelefono').modal('close');
                //reseateando formulario
                $('#frmDele')[0].reset();
            } else {
                $('.modal-footer').show();
                //ocultando  el preloader del modal
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

function selectTipoTele() {
    $.ajax({
        type: 'POST',
        url: '../app/controllers/TipoTelefonoController.php',
        data: {
            'type': 'tipo'
        },
        dataType: 'JSON',
        success: function(data) {
            $("#codiTipoTele").empty().append('whatever');
            $("#codiTipoTele").append('<option value="0" selected disabled>Seleccione el tipo de telefono:</option>');
            $("#codiTipoTeleUpda").empty().append('whatever');
            $("#codiTipoTeleUpda").append('<option value="0" selected disabled>Seleccione el tipo de telefono:</option>');
            for (x in data) {
                $("#codiTipoTele").append('<option value=' + data[x].codi_tipo_tele + '>' + data[x].nomb_tipo_tele + '</option>');
                 $("#codiTipoTeleUpda").append('<option value=' + data[x].codi_tipo_tele + '>' + data[x].nomb_tipo_tele + '</option>');
            }
        },
        error: function(data) {
            console.log("Error al traer datos");
        }
    });
}
function updateInfo() {
	var datosUsuario = $("#miCuenta").serialize();
	var accion = 'updateInfo';
	$.ajax({
		url: '../app/controllers/UsuarioController',
		type: 'POST',
		data: datosUsuario + "&accion="+accion,
		beforeSend: function() {
			$('.progress').show();
			$("#modificarInformacion").hide();
		},
		success: function(data) {
            //obteniendo valor de la respuesta del servidor
            var resp = data.indexOf("Exito");
            //si la respuesta del servidores mayor o igual a 0
            if (resp >= 0) {
                //se muestra el mensaje de confirmación
                successAlert("Informacion cambiada con exito");
                //reseteando el formulario para agregar categoria
                $('#miCuenta')[0].reset();
                $('.progress').hide();
				$("#modificarInformacion").show();
                misDatos();
            } else {
            	$('.progress').hide();
				$("#modificarInformacion").show();
                //se obtiene el texto del json del servidor
                var message = JSON.parse(data);
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
function updateLogoCasa() {
	var formularioCasa = new FormData($("#frmUpdateLogo")[0]);
    //agregando la imagen de la casa que se ingresara
    formularioCasa.append("logoCasaUpda", $("#logoCasaUpda")[0].files[0]);
    	$.ajax({
		url: '../app/controllers/CasaController',
		type: 'POST',
		data:formularioCasa,
		processData: false,
        contentType: false,
		beforeSend: function() {
			$('.progress').show();
			$(".modal-footer").hide();
		},
		success: function(data) {
            //obteniendo valor de la respuesta del servidor
            var resp = data.indexOf("Exito");
            //si la respuesta del servidores mayor o igual a 0
            if (resp >= 0) {
                //se muestra el mensaje de confirmación
                successAlert("Informacion cambiada con exito");
                //reseteando el formulario para agregar categoria
                $('#frmUpdateLogo')[0].reset();
                $('.progress').hide();
				$(".modal-footer").show();
				$("#updateLogoCasa").modal('close');
                datosCasa();
            } else {
                $('.progress').hide();
				$(".modal-footer").show();
                //se obtiene el texto del json del servidor
                var message = JSON.parse(data);
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
function updateInfoCasa() {
	var formularioCasa = new FormData($("#infoCasa")[0]);
	$.ajax({
		url: '../app/controllers/CasaController',
		type: 'POST',
		data:formularioCasa,
		processData: false,
        contentType: false,
		beforeSend: function() {
			$('.progress').show();
			$("#modificarInformacionCasa").hide();
		},
		success: function(data) {
            //obteniendo valor de la respuesta del servidor
            var resp = data.indexOf("Exito");
            //si la respuesta del servidores mayor o igual a 0
            if (resp >= 0) {
                //se muestra el mensaje de confirmación
                successAlert("Informacion cambiada con exito");
                //reseteando el formulario para agregar categoria
                $('#infoCasa')[0].reset();
                $('.progress').hide();
				$("#modificarInformacionCasa").show();
                datosCasa();
            } else {
            	$('.progress').hide();
				$("#modificarInformacionCasa").show();
                //se obtiene el texto del json del servidor
                var message = JSON.parse(data);
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
function updateContra() {
	var datosUsuario = $("#miCuenta").serialize();
	var accion = 'updateContra';
	$.ajax({
		url: '../app/controllers/UsuarioController',
		type: 'POST',
		data: datosUsuario + "&accion="+accion,
		beforeSend: function() {
			$('.progress').show();
			$("#modificarContra").hide();
		},
		success: function(data) {
            //obteniendo valor de la respuesta del servidor
            var resp = data.indexOf("Exito");
            //si la respuesta del servidores mayor o igual a 0
            if (resp >= 0) {
                //se muestra el mensaje de confirmación
                successAlert("Informacion cambiada con exito");
                //reseteando el formulario para agregar categoria
                $('#miCuenta')[0].reset();
                $('.progress').hide();
				$("#modificarContra").show();
                misDatos();
            } else {
            	$('.progress').hide();
				$("#modificarContra").show();
                //se obtiene el texto del json del servidor
                var message = JSON.parse(data);
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

function misDatos() {
    $("#nombUsuaUpda").next("label").addClass("active");
    $("#apelUsuaUpda").next("label").addClass("active");
    $("#correUsuaUpda").next("label").addClass("active");
    $.ajax({
        type: 'POST',
        url: '../app/controllers/UsuarioController.php',
        data: {
            'accion': 'infoUsua'
        },
        dataType: 'JSON',
        success: function(data) {
            $("#nombUsuaUpda").val(data.nomb_usua);
            $("#apelUsuaUpda").val(data.apel_usua);
    		$("#correUsuaUpda").val(data.corre_usua);
        },
        error: function(data) {
        	errorAlert("Error al contactar con el servidor");
        }
    });
}
function datosCasa() {
    $("#nombCasaUpda").next("label").addClass("active");
    $("#direCasaUpda").next("label").addClass("active");
    $.ajax({
        type: 'POST',
        url: '../app/controllers/CasaController.php',
        data: {
            'accion': 'getCasa'
        },
        dataType: 'JSON',
        success: function(data) {
        	$('#logo').attr('src', '../web/img/logos/'+data.logo_casa);
            $("#nombCasaUpda").val(data.nomb_casa);
            $("#direCasaUpda").val(data.dire_casa);

        },
        error: function(data) {
        	errorAlert("Error al contactar con el servidor");
        }
    });
}