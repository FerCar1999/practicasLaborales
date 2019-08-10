$(document).ready(function () {
  finalizandoCursos();
  selectCursosPendientes();
  selectCursosPendientesInforme();
  selectCursosPendientesInformeAprobacion();
  selectCursosPendientesFactura();
  selectAbonoQuedan();
  selectNotificaciones();
});
//Funcion que obtiene los cursos pendientes de finalizar
function selectCursosPendientes() {
    $.ajax({
      type: 'POST',
      url: '../app/controllers/DashboardController.php',
      data: {
        dashboard: 'cursos'
      },
      dataType: 'JSON',
      success: function (data) {
        if (data.length>0) {
          $("#cantidadCursos").text(data.length);
        for (var i = 0; i < data.length; i++) {
          var fechInic = moment(data[i].fech_fin);
          var hoy =new Date;
          var fechHoy = moment(hoy.getFullYear()+"-0"+(hoy.getMonth()+1)+"-"+hoy.getDate());
          var cantDiasAct = (fechHoy.diff(fechInic,'days'));
          var porcDiasPasa = (Math.abs(5+cantDiasAct)/5);
          console.log(cantDiasAct)
          switch (cantDiasAct) {
            case -1:
              $("#cursosPendientes").append("<a id='boton1' href='curso' class='collection-item black-text'>"+data[i].nomb_curs+"<br>Porcentaje de dias para finalizar (1 dia restante): "+(porcDiasPasa*100).toFixed(2)+"%<div class='progress cuatro' id='progress'><div class='determinate cuatro' style='width: "+(porcDiasPasa*100).toFixed(2)+"%'></div></div></a>");
              break;
            case -2:
              $("#cursosPendientes").append("<a id='boton1' href='curso' class='collection-item black-text'>"+data[i].nomb_curs+"<br>Porcentaje de dias para finalizar (2 dias restantes): "+(porcDiasPasa*100).toFixed(2)+"%<div class='progress tres' id='progress'><div class='determinate tres' style='width: "+(porcDiasPasa*100).toFixed(2)+"%'></div></div></a>");
              break;
            case -3:
              $("#cursosPendientes").append("<a id='boton1' href='curso' class='collection-item black-text'>"+data[i].nomb_curs+"<br>Porcentaje de dias para finalizar (3 dias restantes): "+(porcDiasPasa*100).toFixed(2)+"%<div class='progress dos' id='progress'><div class='determinate dos' style='width: "+(porcDiasPasa*100).toFixed(2)+"%'></div></div></a>");
              break;
            case -4:
              $("#cursosPendientes").append("<a id='boton1' href='curso' class='collection-item black-text'>"+data[i].nomb_curs+"<br>Porcentaje de dias para finalizar (4 dias restantes): "+(porcDiasPasa*100).toFixed(2)+"%<div class='progress uno' id='progress'><div class='determinate uno' style='width: "+(porcDiasPasa*100).toFixed(2)+"%'></div></div></a>");
              break;
            case -5:
              $("#cursosPendientes").append("<a id='boton1' href='curso' class='collection-item black-text'>"+data[i].nomb_curs+"<br>Porcentaje de dias para finalizar (5 dias restantes): "+(porcDiasPasa*100).toFixed(2)+"%<div class='progress cero' id='progress'><div class='determinate cero' style='width: "+(porcDiasPasa*100).toFixed(2)+"%'></div></div></a>");
              break;
          }
        }
        } else {
          $("#ulPendienteFinalizar").hide();
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
    url: '../app/controllers/CursoController.php',
    data: {
      finalizar : 'curso'
    },
    success: function (data) {
      //console.log(data);
    }
  });
}
function selectCursosPendientesInforme() {
  $.ajax({
    type: 'POST',
    url: '../app/controllers/DashboardController.php',
    data: {
      informe: 'cursos'
    },
    dataType: 'JSON',
    success: function (data) {
      if (data.length>0) {
        $("#cantidadCursosInforme").text(data.length);
        for (var i = 0; i < data.length; i++) {
          $("#cantidadCursosInforme").text(data.length);
          var fechInic = moment(data[i].fech_fin);
          var hoy =new Date;
          var fechHoy = moment(hoy.getFullYear()+"-0"+(hoy.getMonth()+1)+"-"+hoy.getDate());
          var cantDiasAct = (fechHoy.diff(fechInic,'days'));
          var porcDiasPasa = ((cantDiasAct)/5);
          if (cantDiasAct>=0) {
            switch (cantDiasAct) {
              case 0:
                $("#cursosPendientesInforme").append("<a id='penFa"+data[i].codi_curs+"' onClick='enviarCodigo("+data[i].codi_curs+");' href='#informeAgregado' class='collection-item modal-trigger black-text'>"+data[i].nomb_curs+"<br>Porcentaje de dias restantes para agregar informe (5 dia restantes): "+(porcDiasPasa*100).toFixed(2)+"%<div class='progress cero' id='progress'><div class='determinate cero' style='width: "+(porcDiasPasa*100).toFixed(2)+"%'></div></div></a>");
                break;
              case 1:
                $("#cursosPendientesInforme").append("<a id='penFa"+data[i].codi_curs+"' onClick='enviarCodigo("+data[i].codi_curs+");' href='#informeAgregado' class='collection-item modal-trigger black-text'>"+data[i].nomb_curs+"<br>Porcentaje de dias restantes para agregar informe (4 dia restantes): "+(porcDiasPasa*100).toFixed(2)+"%<div class='progress uno' id='progress'><div class='determinate uno' style='width: "+(porcDiasPasa*100).toFixed(2)+"%'></div></div></a>");
                break;
              case 2:
                $("#cursosPendientesInforme").append("<a id='penFa"+data[i].codi_curs+"' onClick='enviarCodigo("+data[i].codi_curs+");' href='#informeAgregado' class='collection-item modal-trigger black-text'>"+data[i].nomb_curs+"<br>Porcentaje de dias restantes para agregar informe (3 dia restantes): "+(porcDiasPasa*100).toFixed(2)+"%<div class='progress dos' id='progress'><div class='determinate dos' style='width: "+(porcDiasPasa*100).toFixed(2)+"%'></div></div></a>");
                break;
              case 3:
                $("#cursosPendientesInforme").append("<a id='penFa"+data[i].codi_curs+"' onClick='enviarCodigo("+data[i].codi_curs+");' href='#informeAgregado' class='collection-item modal-trigger black-text'>"+data[i].nomb_curs+"<br>Porcentaje de dias restantes para agregar informe (2 dia restantes): "+(porcDiasPasa*100).toFixed(2)+"%<div class='progress tres' id='progress'><div class='determinate tres' style='width: "+(porcDiasPasa*100).toFixed(2)+"%'></div></div></a>");
                break;
              case 4:
                alerta('alerta',data[i].nomb_curs, 1);
                $("#cursosPendientesInforme").append("<a id='penFa"+data[i].codi_curs+"' onClick='enviarCodigo("+data[i].codi_curs+");' href='#informeAgregado' class='collection-item modal-trigger black-text'>"+data[i].nomb_curs+"<br>Porcentaje de dias restantes para agregar informe (1 dia restante): "+(porcDiasPasa*100).toFixed(2)+"%<div class='progress cuatro' id='progress'><div class='determinate cuatro' style='width: "+(porcDiasPasa*100).toFixed(2)+"%'></div></div></a>");
                break;
              case 5:
                var porcDiasPasa = 1;
                $("#cursosPendientesInforme").append("<a id='penFa"+data[i].codi_curs+"' onClick='enviarCodigo("+data[i].codi_curs+");' href='#informeAgregado' class='collection-item modal-trigger black-text'>"+data[i].nomb_curs+"<br>Porcentaje de dias restantes para agregar informe (ULTIMO DIA PARA ENVIAR EL INFORME): "+(porcDiasPasa*100).toFixed(2)+"%<div class='progress cinco' id='progress'><div class='determinate cinco' style='width: "+(porcDiasPasa*100).toFixed(2)+"%'></div></div></a>");
                break;
              default:
                  var porcDiasPasa = 1;
                  $("#cursosPendientesInforme").append("<a id='penFa"+data[i].codi_curs+"' onClick='enviarCodigo("+data[i].codi_curs+");' href='#informeAgregado' class='collection-item modal-trigger black-text'>"+data[i].nomb_curs+"<br>Dias en los que se ha tardado("+(cantDiasAct-5)+") : "+(porcDiasPasa*100).toFixed(2)+"%<div class='progress cinco' id='progress'><div class='determinate cinco' style='width: "+(porcDiasPasa*100).toFixed(2)+"%'></div></div></a>");
                break;
            }
          } else {

          }
        }
      } else {
        $("#ulPendienteInforme").hide();
      }
    },
    error: function (data) {
      console.log("Error al traer datos");
    }
  });
}
function alerta(alert,identificador, nume) { 
  $.ajax({
    url : '../app/controllers/DashboardController.php',
    method: 'POST',
    data:{
      alerta: alert,
      identificador : identificador,
      nume : nume
    }
  })
}
function enviarCodigo(x) {  
  $("#codiCurs").val(x);
}
function cambiarEstadoInforme() {  
  var datos = $("#frmInformeAgregado").serialize();
  var codi = $("#codiCurs").val();
  $.ajax({
    type: 'POST',
    url: '../app/controllers/CursoController.php',
    data: datos,
    success: function (data) {  
      var res = data.indexOf("Exito");
      if (res>=0) {
        successAlert("Curso modificado con exito");
        selectCursosPendientes();
        $("#penFa"+codi).remove();
        $('#informeAgregado').modal('close');
      } else {
        errorAlert(JSON.parse(data));  
      }
    }
  })
}
function selectCursosPendientesInformeAprobacion() {
  $.ajax({
    type: 'POST',
    url: '../app/controllers/DashboardController.php',
    data: {
      informeAprov: 'cursos'
    },
    dataType: 'JSON',
    success: function (data) {
      if (data.length) {
        $("#cantidadCursosInformeAprov").text(data.length);
        for (var i = 0; i < data.length; i++) {
          alerta("alertaAprov",data[i].nomb_curs, 2);
          $("#informesPendientesAprovacion").append("<a id='penAp"+data[i].codi_curs+"' onClick='enviarCodigoAp("+data[i].codi_curs+");' href='#informeAprovacion' class='collection-item modal-trigger black-text'>"+data[i].nomb_curs+"<br>Pedir Informe a: "+data[i].nomb_usua+" "+data[i].apel_usua+"</a>");
        }
      } else {
        $('#ulPendienteAprobacion').hide();
      }
    },
    error: function (data) {
      console.log("Error al traer datos");
    }
  });
}
function enviarCodigoAp(x) {  
  $("#codiCursAp").val(x);
}
function cambiarEstadoInformeAprobacion() {  
  var datos = $("#frmInformeAprovacion").serialize();
  var codi = $("#codiCursAp").val();
  $.ajax({
    type: 'POST',
    url: '../app/controllers/CursoController.php',
    data: datos,
    success: function (data) {  
      var res = data.indexOf("Exito");
      if (res>=0) {
        successAlert("Curso verificado con exito");
        selectCursosPendientesInformeAprobacion();
        $("#penAp"+codi).remove();
        $('#informeAprovacion').modal('close');
      } else {
        errorAlert(JSON.parse(data));  
      }
    }
  })
}
function selectCursosPendientesFactura() {
  $.ajax({
    type: 'POST',
    url: '../app/controllers/DashboardController.php',
    data: {
      factura: 'cursos'
    },
    dataType: 'JSON',
    success: function (data) {
      if (data.length>0) {
        $("#pendientesFactura").text(data.length);
        $("#x").remove();
        for (var i = 0; i < data.length; i++) {
          var fechInic = moment(data[i].fech_info);
          var hoy =new Date;
          var fechHoy = moment(hoy.getFullYear()+"-0"+(hoy.getMonth()+1)+"-"+hoy.getDate());
          var cantDiasAct = (fechHoy.diff(fechInic,'days'));
          var porcDiasPasa = ((cantDiasAct)/20);
          if (cantDiasAct>=0 & cantDiasAct<4) {
            $("#cursosPendientesFactura").append("<a id='x' href='factura' class='collection-item black-text'>"+data[i].nomb_curs+"<br>Porcentaje de Avance: (Faltan "+(20-cantDiasAct)+" dias para recibir respuesta de INSAFORP sobre el informe de este curso): "+Math.round(porcDiasPasa*100)+"%<div class='progress cero' id='progress'><div class='determinate cero' style='width: "+Math.round(porcDiasPasa*100)+"%'></div></div></a>");
          } else {
            if (cantDiasAct>=4 & cantDiasAct<8) {
              $("#cursosPendientesFactura").append("<a id='x' href='factura' class='collection-item black-text'>"+data[i].nomb_curs+"<br>Porcentaje de Avance: (Faltan "+(20-cantDiasAct)+" dias para recibir respuesta de INSAFORP sobre el informe de este curso): "+Math.round(porcDiasPasa*100)+"%<div class='progress uno' id='progress'><div class='determinate uno' style='width: "+Math.round(porcDiasPasa*100)+"%'></div></div></a>");
            } else {
              if (cantDiasAct>=8 & cantDiasAct<12){
                $("#cursosPendientesFactura").append("<a id='x' href='factura' class='collection-item black-text'>"+data[i].nomb_curs+"<br>Porcentaje de Avance: (Faltan "+(20-cantDiasAct)+" dias para recibir respuesta de INSAFORP sobre el informe de este curso): "+Math.round(porcDiasPasa*100)+"%<div class='progress dos' id='progress'><div class='determinate dos' style='width: "+Math.round(porcDiasPasa*100)+"%'></div></div></a>");
              } else {
                if (cantDiasAct>=12 & cantDiasAct<16) {
                  $("#cursosPendientesFactura").append("<a id='x' href='factura' class='collection-item black-text'>"+data[i].nomb_curs+"<br>Porcentaje de Avance: (Faltan "+(20-cantDiasAct)+" dias para recibir respuesta de INSAFORP sobre el informe de este curso): "+Math.round(porcDiasPasa*100)+"%<div class='progress tres' id='progress'><div class='determinate tres' style='width: "+Math.round(porcDiasPasa*100)+"%'></div></div></a>");
                } else {
                  if (cantDiasAct>=16 & cantDiasAct<20) {
                    alerta('alertaFact', data[i].nomb_curs, 3);
                    $("#cursosPendientesFactura").append("<a id='x' href='factura' class='collection-item black-text'>"+data[i].nomb_curs+"<br>Porcentaje de Avance: (Faltan "+(20-cantDiasAct)+" dias para recibir respuesta de INSAFORP sobre el informe de este curso): "+Math.round(porcDiasPasa*100)+"%<div class='progress cuatro' id='progress'><div class='determinate cuatro' style='width: "+Math.round(porcDiasPasa*100)+"%'></div></div></a>");
                  } else {
                    if (cantDiasAct==20) {
                      $("#cursosPendientesFactura").append("<a id='x' href='factura' class='collection-item black-text'>"+data[i].nomb_curs+"<br>Porcentaje de Avance: (Hoy es el ULTIMO dia para recibir respuesta de INSAFORP sobre el informe de este curso): "+Math.round(porcDiasPasa*100)+"%<div class='progress cinco' id='progress'><div class='determinate cinco' style='width: "+Math.round(porcDiasPasa*100)+"%'></div></div></a>");
                    } else {
                      if (cantDiasAct>20) {
                        $("#cursosPendientesFactura").append("<a id='x' href='factura' class='collection-item black-text'>"+data[i].nomb_curs+"<br>Porcentaje de Avance: (Se ha retrasado  "+Math.abs(cantDiasAct)+" dias para recibir respuesta de INSAFORP sobre el informe de este curso): "+Math.round(1*100)+"%<div class='progress cinco' id='progress'><div class='determinate cinco' style='width: "+Math.round(porcDiasPasa*100)+"%'></div></div></a>");
                      } 
                    }
                  }
                }
              }
            }
          }
        }
      } else {
        $("#ulPendienteFactura").hide();
      }
    },
    error: function (data) {
      console.log("Error al traer datos");
    }
  });
}
function selectAbonoQuedan() {
  $.ajax({
    type: 'POST',
    url: '../app/controllers/DashboardController.php',
    data: {
      abono: 'abono'
    },
    dataType: 'JSON',
    success: function (data) {
      if (data.length>0) {
        for (var i = 0; i < data.length; i++) {
        $("#cantidadCursosInforme").text(data.length);
          var fechInic = moment(data[i].fech_fin);
          var hoy =new Date;
          var fechHoy = moment(hoy.getFullYear()+"-0"+(hoy.getMonth()+1)+"-"+hoy.getDate());
          var cantDiasAct = (fechHoy.diff(fechInic,'days'));
          var porcDiasPasa = ((cantDiasAct)/5);
            $("#cursosPendientesFactura").append("<a href='quedan' class='collection-item'>"+data[i].numb_qued+"<br>Porcentaje de Avance: "+Math.round(porcDiasPasa*100)+"%<div class='progress' id='progress'><div class='determinate' style='width: "+Math.round(porcDiasPasa*100)+"%'></div></div></a>");
        }
      } else {
        $("#ulPendienteQuedan").hide();
      }
    },
    error: function (data) {
      console.log("Error al traer datos");
    }
  });
}
function selectNotificaciones() {
  $.ajax({
    type: 'POST',
    url: '../app/controllers/DashboardController.php',
    data: {
      notificaciones: 'notificaciones'
    },
    dataType: 'JSON',
    success: function (data) {
      $("#notififcacionesPendientes").text(data.length);
      for (var i = 0; i < data.length; i++) {
        $("#todasNotificaciones").append("<a href='factura' class='collection-item active'>"+data[i].acci_noti+"</a>");
      }
    },
    error: function (data) {
      console.log("Error al traer datos");
    }
  });
}