<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/Notificacion.php';
session_start();
try {
    //inicializando la clase de categoria
    $notificacion = new Notificacion;
    //si el post es para llenar campos que no tienen que ver en el crud de categoria
    if (isset($_POST['dashboard'])) {
        //se obtiene la lista sin array asociativo
        $data = null;
        if ($notificacion->setCodiCasa($_SESSION['codi_casa'])) {
            $data = $notificacion->getCursosFinalizarPronto(date('Y-m-d'));
        }
        //imprimiendo la lista en tipo json
        echo json_encode($data);
    }
    if (isset($_POST['informe'])) {
        //se obtiene la lista sin array asociativo
        $data = null;
        if ($notificacion->setCodiCasa($_SESSION['codi_casa'])) {
            $data = $notificacion->getCursosFinalizadosInforme(date('Y-m-d'));
        }
        //imprimiendo la lista en tipo json
        echo json_encode($data);
    }
    if (isset($_POST['factura'])) {
        //se obtiene la lista sin array asociativo
        $data = null;
        if ($notificacion->setCodiCasa($_SESSION['codi_casa'])) {
            $data = $notificacion->getCursosPendientesFactura(date('Y-m-d'));
        }
        //imprimiendo la lista en tipo json
        echo json_encode($data);
    }
} catch (Exception $error) {
    //enviando el mensaje ya sea de exito o de error en json
    echo json_encode($error->getMessage());
}
