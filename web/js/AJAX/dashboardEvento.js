$(document).ready(function () {
  $("#preloader").hide();
  $('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    i18n: {
      months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
      monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sept", "Oct", "Nov", "Dic"],
      weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
      weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
      weekdaysAbbrev: ["D", "L", "M", "M", "J", "V", "S"]
    }
  });
  evento();
});
function evento() {
  $.ajax({
    url: '../app/controllers/EventoController',
    method: 'POST',
    data: {
      dashboard: 'evento'
    },
    dataType: 'JSON',
    success: function (data) {
      $('#eventoNombre').text("Evento: " + data[0].nomb_even);
      dataTableEvento(data[0].codi_even)
    }
  })
}
function dataTableEvento(codi) {
  //llenando la variable datatable
  tableUno = $('#table-evento-detalle-dashboard').DataTable({
    destroy: true,
    //realizando peticion ajax para traer datos
    ajax: {
      method: 'POST',
      //url de controlador adonde se traeran los datos
      url: '../app/controllers/EventoDetalleController.php',
      //datos que iran por el post
      data: {
        tabla: "casa",
        codiEven: codi
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
      data: "nomb_cont"
    }, {
      data: "empr_cont"
    }, {
      //agregando datos de nombre de categoria
      data: 'nomb_etiq'
    }, {
      data: 'asis_even_deta',
      "aTargets": [0],
      "render": function (data) {
        if (data == 0) {
          return "<a href='#updateInvitado' class='update btn-small green darken-1 waves-effect waves-ligth modal-trigger'>Tomar Asistencia</a>"
        } else {
          if (data == 1) {
            return "<a class='disabled btn-small green darken-1 waves-effect waves-ligth modal-trigger'>Asistencia Tomada</a>"
          }
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
  getIdToAsitencia("#table-evento-detalle-dashboard tbody", tableUno);
}
// Funcion para obtener la informacion de el elemento a modificar
function getIdToAsitencia(tobyd, table) {
  $('tbody').on("click", "a.update", function () {
    var data = table.row($(this).parents("tr")).data();
    var codi_even_deta = $("#codiEvenDetaAsis").val(data.codi_even_deta);
  });
}
function asistencia() {
  //obteniendo los datos del formulario
  var datos = $("#frmUpdateInvitado").serialize();
  $.ajax({
    //metodo que se va a usar
    method: "POST",
    //ruta de controlador de categoria
    url: "../app/controllers/EventoDetalleController.php",
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
      var resp = data.indexOf("Exito");
      //si la respuesta del servidores mayor o igual a 0
      if (resp >= 0) {
        //creando modal para el mensaje de confirmación
        M.toast({ html: "Asistencia tomada con exito", classes: 'rounded' });
        // Recargando la tabla
        evento();
        //Mostrando el footer del modal
        $('.modal-footer').show();
        //ocultando el preloader
        $('#preloader').hide();
        //ocultando modal para modificar la categoria
        $('#updateInvitado').modal('close');
        //reseteando el formulario
        $('#frmUpdateInvitado')[0].reset();
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