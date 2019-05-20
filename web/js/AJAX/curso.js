var tableUno, tableDos, tableTres;
$(document).ready(function () {
  $('.progress').hide();
  $('#progressAvance2').show();
  $('#progressAvance2N').show();  
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
  selectHorarios();
  selectSalones();
  $("#tablaHoraN").hide();
});
//Funcion para saber si va a mostrar los cursos de las otras casas o solo los propios
function verificarCursoMostrar() {
  $.ajax({
    url: '../app/controllers/CursoController',
    type: 'POST',
    data: {
      'accion': 'verificarInfo'
    },
    success: function (data) {
      if (JSON.parse(data) == 'casa') {
        $('[href="#casas"]').closest('li').hide();
        dataTableCursoCasa();
      } else {
        dataTableCursoCasa();
        dataTableCursoCasas();
      }
    },
    error: function () {
      console.log("Error")
    }
  });
}
//funcion para llenar select de categorias
function selectCategorias() {
  $.ajax({
    type: 'POST',
    url: '../app/controllers/CategoriaController',
    data: {
      type: 'categoria'
    },
    dataType: 'JSON',
    success: function (data) {
      $("#codiCate").empty().append('whatever');
      $("#codiCate").append('<option value="0" selected disabled>Seleccione la categoria:</option>');
      $("#codiCateUpda").empty().append('whatever');
      $("#codiCateUpda").append('<option value="0" selected disabled>Seleccione la categoria:</option>');
      for (var i = 0; i < data.length; i++) {
        $("#codiCate").append('<option value=' + data[i].codi_cate + '>' + data[i].nomb_cate + '</option>');
        $("#codiCateUpda").append('<option value=' + data[i].codi_cate + '>' + data[i].nomb_cate + '</option>');
      }
    },
    error: function (data) {
      console.log("Error al traer datos");
    }
  });
}
//Funcion para llenar los select de horarios
function selectHorarios() {
  var codiDia = $('#codiDia').val();
  $.ajax({
    type: 'POST',
    url: '../app/controllers/HorarioController',
    data: {
      type: 'categoria',
      codiDia: codiDia
    },
    dataType: 'JSON',
    success: function (data) {
      $("#codiHora").empty().append('whatever');
      $("#codiHora").append('<option value="0" selected disabled>Seleccione el horario:</option>');
      //$("#codiHoraUpda").empty().append('whatever');
      //$("#codiHoraUpda").append('<option value="0" selected disabled>Seleccione el horario:</option>');
      for (var i = 0; i < data.length ; i++) {
        $("#codiHora").append('<option value=' + data[i].codi_hora + '>' + data[i].hora_inic + ' - ' + data[i].hora_fin + '</option>');
        //$("#codiHoraUpda").append('<option value=' + data[i].codi_hora + '>' + data[i].hora_inic + ' - ' + data[i].hora_fin + '</option>');
      }
    },
    error: function (data) {
      console.log("Error al traer datos");
    }
  });
}
function selectHorariosU() {
  var codiDia = $('#codiDiaUpda').val();
  $.ajax({
    type: 'POST',
    url: '../app/controllers/HorarioController',
    data: {
      type: 'categoria',
      codiDia: codiDia
    },
    dataType: 'JSON',
    success: function (data) {
      $("#codiHoraUpda").empty().append('whatever');
      $("#codiHoraUpda").append('<option value="0" selected disabled>Seleccione el horario:</option>');
      for (var i = 0; i < data.length ; i++) {
        $("#codiHoraUpda").append('<option value=' + data[i].codi_hora + '>' + data[i].hora_inic + ' - ' + data[i].hora_fin + '</option>');
      }
    },
    error: function (data) {
      console.log("Error al traer datos");
    }
  });
}
//Funcion para llenar select de horarios de update
function selectHorariosUpda(codiDia) {
  $.ajax({
    type: 'POST',
    url: '../app/controllers/HorarioController',
    data: {
      type: 'categoria',
      codiDia: codiDia
    },
    dataType: 'JSON',
    success: function (data) {
      $("#codiHoraUpda").empty().append('whatever');
      $("#codiHoraUpda").append('<option value="0" selected disabled>Seleccione el horario:</option>');
      for (var i = 0; i < data.length; i++) {
        $("#codiHoraUpda").append('<option value=' + data[i].codi_hora + '>' + data[i].hora_inic + ' - ' + data[i].hora_fin + '</option>');
      }
    },
    error: function (data) {
      console.log("Error al traer datos");
    }
  });
}
//Funcion para llenar el select de horarios de create horario
function selectHorariosN() {
  var codiDia = $('#codiDiaN').val();
  $.ajax({
    type: 'POST',
    url: '../app/controllers/HorarioController',
    data: {
      type: 'categoria',
      codiDia: codiDia
    },
    dataType: 'JSON',
    success: function (data) {
      $("#codiHoraN").empty().append('whatever');
      $("#codiHoraN").append('<option value="0" selected disabled>Seleccione el horario:</option>');
      for (var i = 0; i < data.length; i++) {
        $("#codiHoraN").append('<option value=' + data[i].codi_hora + '>' + data[i].hora_inic + ' - ' + data[i].hora_fin + '</option>');
      }
    },
    error: function (data) {
      console.log("Error al traer datos");
    }
  });
}
//Funcion para llenar los select de los salones
function selectSalones() {
  $.ajax({
    type: 'POST',
    url: '../app/controllers/SalonController',
    data: {
      type: 'categoria'
    },
    dataType: 'JSON',
    success: function (data) {
      $("#codiSalo").empty().append('whatever');
      $("#codiSalo").append('<option value="0" selected disabled>Seleccione el salon:</option>');
      $("#codiSaloN").empty().append('whatever');
      $("#codiSaloN").append('<option value="0" selected disabled>Seleccione el salon:</option>');
      $("#codiSaloUpda").empty().append('whatever');
      $("#codiSaloUpda").append('<option value="0" selected disabled>Seleccione el salon:</option>');
      for (var i = 0; i < data.length; i++) {
        $("#codiSalo").append('<option value=' + data[i].codi_salo + '>' + data[i].nomb_salo + '</option>');
        $("#codiSaloN").append('<option value=' + data[i].codi_salo + '>' + data[i].nomb_salo + '</option>');
        $("#codiSaloUpda").append('<option value=' + data[i].codi_salo + '>' + data[i].nomb_salo + '</option>');
      }
    },
    error: function (data) {
      console.log("Error al traer datos");
    }
  });
}
//funcion para llenar los select de los docentes
function selectDocentes() {
  $.ajax({
    type: 'POST',
    url: '../app/controllers/DocenteController',
    data: {
      type: 'categoria'
    },
    dataType: 'JSON',
    success: function (data) {
      $("#codiDoce").empty().append('whatever');
      $("#codiDoce").append('<option value="0" selected disabled>Seleccione el docente:</option>');
      $("#codiDoceN").empty().append('whatever');
      $("#codiDoceN").append('<option value="0" selected disabled>Seleccione el docente:</option>');
      $("#codiDoceUpda").empty().append('whatever');
      $("#codiDoceUpda").append('<option value="0" selected disabled>Seleccione el docente:</option>');
      for (var i = 0; i < data.length; i++) {
        $("#codiDoce").append('<option value=' + data[i].codi_doce + '>' + data[i].nomb_doce + ' ' + data[i].apel_doce + '</option>');
        $("#codiDoceN").append('<option value=' + data[i].codi_doce + '>' + data[i].nomb_doce + ' ' + data[i].apel_doce + '</option>');
        $("#codiDoceUpda").append('<option value=' + data[i].codi_doce + '>' + data[i].nomb_doce + ' ' + data[i].apel_doce + '</option>');
      }
    },
    error: function (data) {
      console.log("Error al traer datos");
    }
  });
}
//PARTE DE UNA CASA
//funcion que llena la tabla de los cursos de la casa logeada
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
        "<a href='#updateHorarioCurso' class='update btn-small blue darken-1 waves-effect waves-light modal-trigger'><i class='material-icons'>list</i></a> " +
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
  getIdToUpdateHorarioCurso("#table-curso-casa tbody", tableUno);
  getIdToDeleteCurso("#table-curso-casa tbody", tableUno);
}
// Funcion para obtener la informacion de el elemento a modificar
function getIdToUpdateCurso(tobyd, table) {
  $('tbody').on("click", "a.update", function () {
    var data = table.row($(this).parents("tr")).data();
    var fechInic = new Date(data.fech_inic).getTime();
    var fechFina = new Date(data.fech_fin).getTime();
    //Obteneindo cantidad de dias entre la fecha inicial y la fechafinal del curso
    var cantDiasGlob = (fechFina-fechInic)/(1000*60*60*24);
    //Obteniendo cantidad de dias entre la fecha inicial y la fecha actual
    var hoy = new Date();
    var cantDiasAct = (fechFina-hoy.getTime())/(1000*60*60*24);
    //porcentaje de dias que han pasado entre las fechas
    var porcDiasPasa = 1-(cantDiasAct/cantDiasGlob);
    //sacando el valor procentual de los dias
    if (porcDiasPasa<0) {
      var porcDiasCien = (0*100);
    } else {
      if (porcDiasPasa>1) {
        var porcDiasCien = (1*100);
      } else {
        var porcDiasCien = (porcDiasPasa.toFixed(2)*100);
      }
    }
    //agregando width al progress de avance de proyecto
    $("#determinateAvanceN").width(porcDiasCien+"%");
    //agregando cantidad de progreso
    $("#progresoCursoCN").text(porcDiasCien+"% / 100%");
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
//Funcion para obtener la informacion de los horarios del curso
function getIdToUpdateHorarioCurso(tobyd, table) {
  $('tbody').on("click", "a.update", function () {
    var data = table.row($(this).parents("tr")).data();
    var codi_curs = $("#codiCursHoraMod").val(data.codi_curs);
  });
}
//Funcion para enviar datos para eliminar el elemento seleccionado
function getIdToDeleteCurso(tobyd, table) {
  $('tbody').on("click", "a.delete", function () {
    var data = table.row($(this).parents("tr")).data();
    var codi_curs = $("#codiCursDele").val(data.codi_curs);
  });
}
//funcion para crear un nuevo curso
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
    beforeSend: function () {
      $('.modal-footer').hide();
      //se muestra el preloader
      $('#preloader').show();
    },
    //funcion en el caso de que la peticion sea correcta
    success: function (data) {
      //se obtiene el texto del json del servidor
      var message = JSON.parse(data);
      //si la respuesta del servidores mayor o igual a 0
      if (message > 0) {
        //se muestra el mensaje de confirmación
        successAlert("Curso agregado con exito");
        // mostrando el footer del modal
        $('.modal-footer').show();
        //ocultando  el preloader del modal
        $('#preloader').hide();
        //cerrando el modal de categoria
        $('#addCurso').modal('close');
        //Agregando id del Curso
        $("#codiCurs").val(message);
        //abriendo modal para agregar Horarios del Curso
        $('#addHorarioCurso').modal('open');
        //reseteando el formulario para agregar categoria
        $('#frmAddCurso')[0].reset();
        // Recargando la tabla datatable
        tableUno.ajax.reload();
        tableDos.ajax.reload();
      } else {
        $('.modal-footer').show();
        //ocultando  el preloader del modal
        $('#preloader').hide();
        //se crear el modal para mostrar el error
        var mensaje = data.replace(/['"]+/g, '');
        errorAlert(mensaje);
      }
    },
    //funcion en el caso de que exista un error con el servidor
    error: function () {
      //creando toast para el error
      errorAlert("Error al contactar con el servidor");
    }
  });
}
// Funcion para modificar el curso
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
    beforeSend: function () {
      //ocultando el footer del modal
      $('.modal-footer').hide();
      //mostrando el preloader
      $('#preloader').show();
    },
    //funcion en el caso de que responda correctamente el servidor
    success: function (data) {
      //obteniendo el valor de respuesta del servidor
      var resp = data.indexOf("Exito");
      //verificando que si sea exitosa la operacion
      if (resp >= 0) {
        //creando modal para el mensaje de confirmación
        successAlert("Curso modificado con exito");
        
        //Mostrando el footer del modal
        $('.modal-footer').show();
        //ocultando el preloader
        $('#preloader').hide();
        //ocultando modal para modificar la categoria
        $('#updateCurso').modal('close');
        //reseteando el formulario
        $('#frmUpdaCurso')[0].reset();
        // Recargando la tabla
        tableUno.ajax.reload();
        tableDos.ajax.reload();
      } else {
        //Mostrando el footer del modal
        $('.modal-footer').show();
        //ocultando el preloader
        $('#preloader').hide();
        ///creando el mensaje de error
        var mensaje = data.replace(/['"]+/g, '');
        errorAlert(mensaje);
      }
    },
    //funcion en el caso de que el servidor no responda
    error: function () {
      //creando modal de error
      errorAlert("No se pudo contactar con el servidor");
    }
  });
}
// Funcion para eliminar el curso
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
    beforeSend: function () {
      //ocultanod el footer del modal
      $('.modal-footer').hide();
      //mostrando el preloader
      $('#preloader').show();
    },
    //funcion si el servidor responde
    success: function (data) {
      //obteniendo valor de la respuesta del servidor
      var resp = data.indexOf("Exito");
      //verificando si la respuesta es exitosa
      if (resp >= 0) {
        // Mensaje de confirmación
        successAlert("Curso eliminado con exito");
        
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
        //crando el mensaje de error
        var mensaje = data.replace(/['"]+/g, '');
        errorAlert(mensaje);
      }
    },
    //funcion en el caso de que el servidor no responda
    error: function () {
      // Mensaje de confirmación
      errorAlert("Error al contactar con el servidor");
    }
  });
}
//PARTE DE TODAS LAS CASAS
//Funcion para obtener los cursos de todas las casas
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
//Funcion para ver la informacion de los cursos de las demas casas
function getIdSeeCursos(tobyd, table) {
  $('tbody').on("click", "a.seeC", function () {
    var data = table.row($(this).parents("tr")).data();
    var fechInic = new Date(data.fech_inic).getTime();
    var fechFina = new Date(data.fech_fin).getTime();
    //Obteneindo cantidad de dias entre la fecha inicial y la fechafinal del curso
    var cantDiasGlob = (fechFina-fechInic)/(1000*60*60*24);
    //Obteniendo cantidad de dias entre la fecha inicial y la fecha actual
    var hoy = new Date();
    var cantDiasAct = (fechFina-hoy.getTime())/(1000*60*60*24);
    console.log(cantDiasAct);
    //porcentaje de dias que han pasado entre las fechas
    var porcDiasPasa = 1-(cantDiasAct/cantDiasGlob);
    //sacando el valor procentual de los dias
    if (porcDiasPasa<0) {
      var porcDiasCien = (0*100);
    } else {
      if (porcDiasPasa>1) {
        var porcDiasCien = (1*100);
      } else {
        var porcDiasCien = (porcDiasPasa.toFixed(2)*100);
      }
    }
    //agregando width al progress de avance de proyecto
    $("#determinateAvance").width(porcDiasCien+"%");
    //agregando cantidad de progreso
    $("#progresoCursoC").text(porcDiasCien+"% / 100%");
    llenandoListaMaestros(data.codi_curs);
    //agregando informacion al formulario
    var codi_curs = $("#codiCursSee").val(data.codi_curs),
      nomb_curs = $("#tituloCurso").text(data.nomb_curs),
      fech_inic = $("#fechasCursoInic").text("Fecha Inicio del Curso : "+data.fech_inic.split('-').reverse().join('/')),
      fech_fin = $("#fechasCursoFin").text("Fecha Fin del Curso : "+data.fech_fin.split('-').reverse().join('/')),
      codi_cate = $("#categoriaCurso").text("Categoria: "+data.nomb_cate);
  });
  
}
function llenandoListaMaestros(codi) { 
  $.ajax({
    method : 'POST',
    url : '../app/controllers/DocenteController',
    data : {
      lista : 'listaMaestros',
      codiCurs : codi
    },
    dataType: 'JSON',
    success : function (data) {
      for (var s = 1; s < 10; s++) {
          $("#" + s).remove();
      }
      for (var i = 0; i < data.length; i++) {
        //agregandole los elementos a la lista
        $("#maestros").append("<li id="+(i+1)+" class='collection-item'>"+data[i].nomb_doce+" "+data[i].apel_doce+"</li> ");
      }
     }
  });
 }
//PARTE DE LOS HORARIOS DE MI CASA
//Funcion para agregar los horarios cuando se crea el curso
function agregarHorario() {
  var datos = $("#frmAddHoraCurso").serialize();
  //realizando peticion ajax
  $.ajax({
    //metodo que se va a utilizar
    method: "POST",
    //url del controlador
    url: "../app/controllers/IntermediaCursoSalonController",
    //datos que se enviaran en el post
    data: datos,
    beforeSend: function () {
      //ocultanod el footer del modal
      $('.modal-footer').hide();
      //mostrando el preloader
      $('#preloader').show();
    },
    //funcion si el servidor responde
    success: function (data) {
      //obteniendo valor de la respuesta del servidor
      var message = JSON.parse(data);
      //verificando si la respuesta es exitosa
      if (message > 0) {
        agregarHorarioDocente(message);

      } else {
        //mostrando el footer del modal
        $('.modal-footer').show();
        //ocultando el preloader
        $('#preloader').hide();
        //crando el mensaje de error
        var mensaje = data.replace(/['"]+/g, '');
        errorAlert(mensaje);
      }
    },
    //funcion en el caso de que el servidor no responda
    error: function () {
      // Mensaje de confirmación
      errorAlert("Error al contactar con el servidor");
    }
  });
}
//funcion para agregar el horario
function agregarHorarioN() {
  var datos = $("#frmAddHoraCursoN").serializeArray();
  //realizando peticion ajax
  $.ajax({
    //metodo que se va a utilizar
    method: "POST",
    //url del controlador
    url: "../app/controllers/IntermediaCursoSalonController",
    //datos que se enviaran en el post
    data: datos,
    beforeSend: function () {
      //ocultanod el footer del modal
      $('.modal-footer').hide();
      //mostrando el preloader
      $('#preloader').show();
    },
    //funcion si el servidor responde
    success: function (data) {
      //obteniendo valor de la respuesta del servidor
      var message = JSON.parse(data);
      //verificando si la respuesta es exitosa
      if (message > 0) {
        agregarHorarioDocenteN(message);
        $('.modal-footer').show();
        //ocultando el preloader
        $('#preloader').hide();
      } else {
        //mostrando el footer del modal
        $('.modal-footer').show();
        //ocultando el preloader
        $('#preloader').hide();
        //crando el mensaje de error
        var mensaje = data.replace(/['"]+/g, '');
        errorAlert(mensaje);
      }
    },
    //funcion en el caso de que el servidor no responda
    error: function () {
      // Mensaje de confirmación
      errorAlert("Error al contactar con el servidor");
    }
  });
}
//funcion para agregar el horario al docente
function agregarHorarioDocenteN(codi) {
  var datos = $("#frmAddHoraCursoN").serializeArray();
  datos.push({
    name: "codiInteCursSaloN",
    value: codi
  });
  //realizando peticion ajax
  $.ajax({
    //metodo que se va a utilizar
    method: "POST",
    //url del controlador
    url: "../app/controllers/IntermediaHorarioDocenteController",
    //datos que se enviaran en el post
    data: datos,
    beforeSend: function () {
      //ocultanod el footer del modal
      $('.modal-footer').hide();
      //mostrando el preloader
      $('#preloader').show();
    },
    //funcion si el servidor responde
    success: function (data) {
      //obteniendo valor de la respuesta del servidor
      var resp = data.indexOf("Exito");
      //verificando si la respuesta es exitosa
      if (resp >= 0) {
        // Mensaje de confirmación
        successAlert("Horario agregado con exito");
        
        //mostrando el footer del modal
        $('.modal-footer').show();
        //ocultando el preloader
        $('#preloader').hide();
        //reseateando formulario
        //$('#frmAddHoraCurso')[0].reset();
        tableUno.ajax.reload();
        tableTres.ajax.reload();
        tableDos.ajax.reload();
      } else {
        //mostrando el footer del modal
        $('.modal-footer').show();
        //ocultando el preloader
        $('#preloader').hide();
        //crando el mensaje de error
        var mensaje = data.replace(/['"]+/g, '');
        errorAlert(mensaje);
      }
    },
    //funcion en el caso de que el servidor no responda
    error: function () {
      // Mensaje de confirmación
      errorAlert("Error al contactar con el servidor");
    }
  });
}
//funcion para agregar el horario al docente cuando se crea el curso
function agregarHorarioDocente(codi) {
  var datos = $("#frmAddHoraCurso").serializeArray();
  datos.push({
    name: "codiInteCursSalo",
    value: codi
  });
  //realizando peticion ajax
  $.ajax({
    //metodo que se va a utilizar
    method: "POST",
    //url del controlador
    url: "../app/controllers/IntermediaHorarioDocenteController",
    //datos que se enviaran en el post
    data: datos,
    //funcion si el servidor responde
    success: function (data) {
      //obteniendo valor de la respuesta del servidor
      var resp = data.indexOf("Exito");
      //verificando si la respuesta es exitosa
      if (resp >= 0) {
        // Mensaje de confirmación
        successAlert("Horario agregado con exito");
        //mostrando el footer del modal
        $('.modal-footer').show();
        //ocultando el preloader
        $('#preloader').hide();
        //reseateando formulario
        //$('#frmAddHoraCurso')[0].reset();
        // Recargando la tabla de horarios
        tableUno.ajax.reload();
        tableTres.ajax.reload();
        tableDos.ajax.reload();
      } else {
        //mostrando el footer del modal
        $('.modal-footer').show();
        //ocultando el preloader
        $('#preloader').hide();
        //crando el mensaje de error
        var mensaje = data.replace(/['"]+/g, '');
        errorAlert(mensaje);
      }
    },
    //funcion en el caso de que el servidor no responda
    error: function () {
      // Mensaje de confirmación
      errorAlert("Error al contactar con el servidor");
    }
  });
}
//funcion para llamar el horario del curso dependiendo del dia que se seleccione
function selectHorarioCurso() {
  var dia = $("#codiDia").val();
  var curs = $("#codiCursHora").val();
  $("#tablaHoraN").show();
  dataTableCursoHorario();
}
//funcion para llenar la tabla de los horarios de mis cursos
function dataTableCursoHorario() {
  //llenando la variable datatable
  var dia = $("#codiDiaHoraCurs").val();
  var curs = $("#codiCursHoraMod").val();
  tableTres = $('#table-horario-curso-casax').DataTable({
    destroy: true,
    //realizando peticion ajax para traer datos
    ajax: {
      method: 'POST',
      //url de controlador adonde se traeran los datos
      url: '../app/controllers/CursoController',
      //datos que iran por el post
      data: {
        tabla: "cursoHorario",
        codi_dia: dia,
        codi_curs: curs
      },
      //agregarndole el nombre del array que se traera
      dataSrc: 'data'
    },
    //agregando datos a las columnas
    columns: [{
      //agregando datos de codigo de categoria
      data: 'codi_inte_hora_doce',
      //pasar a invisible esa columna
      "visible": false
    }, {
      data: "codi_inte_curs_salo",
      "visible": false
    }, {
      data: "codi_salo",
      "visible": false
    }, {
      data: "codi_doce",
      "visible": false
    }, {
      data: "codi_dia",
      "visible": false
    }, {
      data: "codi_hora",
      "visible": false
    }, {
      //agregando datos de nombre de categoria
      data: 'hora_inic'
    }, {
      //agregando dato de estado de categoria
      data: 'hora_fin'
    }, {
      data: 'info'
    }, {
      //agregando botones para abrir el modal de modificar o de eliminar categoria
      defaultContent: "<div class='center-btn'>" +
        "<a href='#updateHorarioCursoInfo' class='update btn-small blue darken-1 waves-effect waves-light modal-trigger'><i class='material-icons'>list</i></a> " +
        "<a href='#deleteHorarioCurso' class='delete btn-small red waves-effect waves-light modal-trigger'><i class='material-icons'>delete</i></a>" +
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
  getIdToUpdateHorarioInfo("#table-horario-curso-casax tbody", tableTres);
  getIdToDeleteHorarioInfo("#table-horario-curso-casax tbody", tableTres);
}
// Funcion para obtener la informacion de el elemento a modificar
function getIdToUpdateHorarioInfo(tobyd, table) {
  $('tbody').on("click", "a.update", function () {
    var data = table.row($(this).parents("tr")).data();
    console.log(data.codi_dia);
    selectHorariosUpda(data.codi_dia);
    var codi_inte_hora_doce = $("#codiInteHoraDoceUpda").val(data.codi_inte_hora_doce),
      codi_inte_curs_salo = $("#codiInteCursSaloUpda").val(data.codi_inte_curs_salo),
      codi_salo = $("#codiSaloUpda").val(data.codi_salo),
      codi_doce = $("#codiDoceUpda").val(data.codi_doce),
      codi_dia = $("#codiDiaUpda").val(data.codi_dia);
    $("#codiSaloUpda").change();
    $("#codiSaloUpda").trigger('change.select2');
    $("#codiDoceUpda").change();
    $("#codiDoceUpda").trigger('change.select2');
    $("#codiDiaUpda").change();
    $("#codiDiaUpda").trigger('change.select2');
  });
}
//Funcion para enviar datos para eliminar el elemento seleccionado
function getIdToDeleteHorarioInfo(tobyd, table) {
  $('tbody').on("click", "a.delete", function () {
    var data = table.row($(this).parents("tr")).data();
    var codi_inte_curs_salo = $("#codiInteCursSaloDele").val(data.codi_inte_curs_salo);
  });
}
//enviar codigo de curso al campo de crear
function sendCodiCurs() {
  var codi = $("#codiCursHoraMod").val();
  $("#codiCursN").val(codi);
}
//funcion para limpiar la tabla de cursos
function limpiarTablaHorario() {
  tableTres.clear().draw();
}
// Funcion para eliminar el curso
function removeHorario() {
  //datos del formulario
  var datos = $("#frmDeleHoraCurso").serialize();
  //realizando peticion ajax
  $.ajax({
    //metodo que se va a utilizar
    method: "POST",
    //url del controlador
    url: "../app/controllers/IntermediaCursoSalonController",
    //datos que se enviaran en el post
    data: datos,
    beforeSend: function () {
      //ocultanod el footer del modal
      $('.modal-footer').hide();
      //mostrando el preloader
      $('#preloader').show();
    },
    //funcion si el servidor responde
    success: function (data) {
      //obteniendo valor de la respuesta del servidor
      var resp = data.indexOf("Exito");
      //verificando si la respuesta es exitosa
      if (resp >= 0) {
        // Mensaje de confirmación
        successAlert("Horario eliminado con exito");
        
        //mostrando el footer del modal
        $('.modal-footer').show();
        //ocultando el preloader
        $('#preloader').hide();
        //cerrando modal de eliminar categoria
        $('#deleteHorarioCurso').modal('close');
        //reseateando formulario
        $('#frmDeleCurso')[0].reset();
        // Recargando la tabla
        tableUno.ajax.reload();
        tableTres.ajax.reload();
        tableDos.ajax.reload();
      } else {
        //mostrando el footer del modal
        $('.modal-footer').show();
        //ocultando el preloader
        $('#preloader').hide();
        //crando el mensaje de error
        var mensaje = data.replace(/['"]+/g, '');
        errorAlert(mensaje);
      }
    },
    //funcion en el caso de que el servidor no responda
    error: function () {
      // Mensaje de confirmación
      errorAlert("Error al contactar con el servidor");
    }
  });
}
// Funcion para modificar el curso
function updateHorario() {
  if ($("#codiHoraUpda").val() == 0) {
    errorAlert("Debe seleccionar un horario");
  } else {
    //datos del formulario
  var datos = $("#frmUpdaHoraCursoInfo").serialize();
  //realizando peticion ajax
  $.ajax({
    //metodo que se va a usar
    method: "POST",
    //ruta del controlador
    url: "../app/controllers/IntermediaCursoSalonController",
    //datos que se enviaran por el post
    data: datos,
    beforeSend: function () {
      //ocultando el footer del modal
      $('.modal-footer').hide();
      //mostrando el preloader
      $('#preloader').show();
    },
    //funcion en el caso de que responda correctamente el servidor
    success: function (data) {
      //obteniendo el valor de respuesta del servidor
      var resp = data.indexOf("Exito");
      //verificando que si sea exitosa la operacion
      if (resp >= 0) {
        updateHorario2();
      } else {
        //Mostrando el footer del modal
        $('.modal-footer').show();
        //ocultando el preloader
        $('#preloader').hide();
        ///creando el mensaje de error
        var mensaje = data.replace(/['"]+/g, '');
        errorAlert(mensaje);
      }
    },
    //funcion en el caso de que el servidor no responda
    error: function () {
      //creando modal de error
      errorAlert("No se pudo contactar con el servidor");
    }
  });
  }
}
// Funcion para modificar el curso
function updateHorario2() {
  //datos del formulario
  var datos = $("#frmUpdaHoraCursoInfo").serialize();
  //realizando peticion ajax
  $.ajax({
    //metodo que se va a usar
    method: "POST",
    //ruta del controlador
    url: "../app/controllers/IntermediaHorarioDocenteController",
    //datos que se enviaran por el post
    data: datos,
    beforeSend: function () {
      //ocultando el footer del modal
      $('.modal-footer').hide();
      //mostrando el preloader
      $('#preloader').show();
    },
    //funcion en el caso de que responda correctamente el servidor
    success: function (data) {
      //obteniendo el valor de respuesta del servidor
      var resp = data.indexOf("Exito");
      //verificando que si sea exitosa la operacion
      if (resp >= 0) {
        //creando modal para el mensaje de confirmación
        successAlert("Horario de curso modificado con exito");
        
        //Mostrando el footer del modal
        $('.modal-footer').show();
        //ocultando el preloader
        $('#preloader').hide();
        //ocultando modal para modificar la categoria
        $('#updateHorarioCursoInfo').modal('close');
        //reseteando el formulario
        $('#frmUpdaHoraCursoInfo')[0].reset();
        // Recargando la tabla
        tableUno.ajax.reload();
        tableTres.ajax.reload();
        tableDos.ajax.reload();
      } else {
        //Mostrando el footer del modal
        $('.modal-footer').show();
        //ocultando el preloader
        $('#preloader').hide();
        ///creando el mensaje de error
        var mensaje = data.replace(/['"]+/g, '');
        errorAlert(mensaje);
      }
    },
    //funcion en el caso de que el servidor no responda
    error: function () {
      //creando modal de error
      errorAlert("No se pudo contactar con el servidor");
    }
  });
}