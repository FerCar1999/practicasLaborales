$(document).ready(function () {
  finalizandoCursos();
  selectCursosPendientes();
  selectCursosPendientesInforme();
  selectCursosPendientesFactura();
});
function selectCursosPendientes() {
    $.ajax({
      type: 'POST',
      url: '../app/controllers/DashboardController',
      data: {
        dashboard: 'cursos'
      },
      dataType: 'JSON',
      success: function (data) {
        $("#cantidadCursos").text(data.length);
        for (var i = 0; i < data.length; i++) {
            $("#cursosPendientes").append("<a href='curso' class='collection-item'>"+data[i].nomb_curs+"</a>");
        }
      },
      error: function (data) {
        console.log("Error al traer datos");
      }
    });
}
function finalizandoCursos() { 
  $.ajax({
    type: 'POST',
    url: '../app/controllers/CursoController',
    data: {
      finalizar : 'curso'
    },
    success: function (data) {

    }
  });
}
function selectCursosPendientesInforme() {
  $.ajax({
    type: 'POST',
    url: '../app/controllers/DashboardController',
    data: {
      informe: 'cursos'
    },
    dataType: 'JSON',
    success: function (data) {
      $("#cantidadCursosInforme").text(data.length);
      for (var i = 0; i < data.length; i++) {
          $("#cursosPendientesInforme").append("<a onClick='enviarCodigo("+data[i].codi_curs+");' href='#informeAgregado' class='collection-item modal-trigger'>"+data[i].nomb_curs+"</a>");
      }
    },
    error: function (data) {
      console.log("Error al traer datos");
    }
  });
}
function enviarCodigo(x) {  
  $("#codiCurs").val(x);
}
function cambiarEstadoInforme() {  
  var datos = $("#frmInformeAgregado").serialize();
  $.ajax({
    type: 'POST',
    url: '../app/controllers/CursoController',
    data: datos,
    success: function (data) {  
      var res = data.indexOf("Exito");
      if (res>=0) {
        successAlert("Curso modificado con exito");
        selectCursosPendientes();
        selectCursosPendientesInforme();
        $('#informeAgregado').modal('close');
      } else {
        errorAlert(JSON.parse(data));  
      }
    }
  })
}
function selectCursosPendientesFactura() {
  $.ajax({
    type: 'POST',
    url: '../app/controllers/DashboardController',
    data: {
      factura: 'cursos'
    },
    dataType: 'JSON',
    success: function (data) {
      $("#pendientesFactura").text(data.length);
      for (var i = 0; i < data.length; i++) {
          $("#cursosPendientesFactura").append("<a href='factura' class='collection-item'>"+data[i].nomb_curs+"</a>");
      }
    },
    error: function (data) {
      console.log("Error al traer datos");
    }
  });
}