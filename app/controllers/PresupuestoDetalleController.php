<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/PresupuestoDetalle.php';
date_default_timezone_get();
session_start();
try {
    //inicializando la clase de categoria
    $presupuestoD = new PresupuestoDetalle;
    //si el post es para la datatable del crud de categoria
    if (isset($_POST['categorias'])) {
        $data = $presupuestoD->obtenerCategoriasSinPresupuesto($_SESSION['codi_casa'], date("Y"));
        echo json_encode($data);
    }
    if (isset($_POST['tabla'])) {
        //se obtiene la lista en array asociativo con formato json
        $data = $presupuestoD->getListaSubPresupuesto(date("Y"),$_SESSION['codi_casa']);
        //se imprime la lista
        echo $data;
    }
    //si el post es para una de las acciones del crud
    if (isset($_POST['accion'])) {
        //Validando los datos del formulario
        $_POST = $presupuestoD-> validateForm($_POST);
        //switch para verificar que accion es la que se va a realizar
        switch ($_POST['accion']) {
            case 'delete':
                if ($presupuestoD->setCodiPresDeta($_POST['codiPresDetaDele'])) {
                    if ($presupuestoD->deleteEgreso()) {
                        throw new Exception('Exito');
                    } else {
                        throw new Exception('No se pudo eliminar el gasto');
                    }
                } else {
                    throw new Exception('No se encontro el gasto');
                }
                break;
            case 'verficarInfo':
                if ($_SESSION['codi_tipo_casa'] == 1) {
                    echo json_encode("casas");
                } else {
                    echo json_encode("casa");
                }
                break;
            case 'create':
                    $idPresupuesto = $presupuestoD->buscarIDPresupuesto($_SESSION['codi_casa'], date("Y"));
                    if ($presupuestoD->setCodiPres($idPresupuesto['codi_pres'])) {
                        if ($presupuestoD->setCantPresDeta($_POST['cantPresDeta'])) {
                            $cantidadPresupuestoRestante = $presupuestoD->obtenerCantidadIngreso();
                            $cantidad = $cantidadPresupuestoRestante['cant_pres']-$_POST['cantPresDeta'];
                            if ($cantidad >= 0) {
                                if ($presupuestoD->setFechPresDeta(date('Y-m-d'))) {
                                    if ($presupuestoD->setCodiUsua($_SESSION['codi_usua'])) {
                                            if ($presupuestoD-> setCodiCate($_POST['codiCate'])) {
                                                if ($presupuestoD-> agregarEgreso()) {
                                                    throw new Exception('Exito');
                                                } else {
                                                    throw new Exception('No se pudo agregar el dinero a la categoria');
                                                }
                                            } else {
                                                throw new Exception("Debe de seleccionar la categoria a la cual ira el dinero");
                                            }
                                    } else {
                                        throw new Exception('No se encontro el usuario');
                                    }
                                } else {
                                    throw new Exception('Error con la fecha');
                                }
                            } else {
                                throw new Exception('La cantidad a ingresar sobrepasa el presupuesto: $' . $cantidadPresupuestoRestante['cant_pres']);
                            }
                        } else {
                            throw new Exception('La cantidad debe ser mayor a 0');
                        }
                    } else {
                        throw new Exception('Al parecer este mes no se le ha agregado su presupuesto, contactar con la casa encargada para poder solucionarlo');
                    }
                break;
        }
    }
} catch (Exception $error) {
    //enviando el mensaje ya sea de exito o de error en json
    echo json_encode($error->getMessage());
}
