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
    if (isset($_POST['tabla'])) {
        //se obtiene la lista en array asociativo con formato json
        $data = null;
        if ($presupuestoD->setCodiCasa($_SESSION['codi_casa'])) {
            $data = $presupuestoD->getListaEgresos(date("m"), date("Y"));
        }
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
                if ($presupuestoD->setCodiCasa($_SESSION['codi_casa'])) {
                    $idPresMes = $presupuestoD->buscarIdPresupuestoMes(date("m"), date("Y"));
                    if ($presupuestoD->setCodiPres($idPresMes['codi_pres'])) {
                        if ($presupuestoD->setCantPresDeta($_POST['cantPresDeta'])) {
                            $cantidadIngreso = $presupuestoD->obtenerCantidadIngreso();
                            $respuesta       = $cantidadIngreso  - $_POST['cantPresDeta'];
                            if ($respuesta >= 0) {
                                if ($presupuestoD->setFechPresDeta(date('Y-m-d'))) {
                                    if ($presupuestoD->setCodiUsua($_SESSION['codi_usua'])) {
                                        if (is_uploaded_file($_FILES['archPresDeta']['tmp_name'])) {
                                            if ($presupuestoD-> setArchivoDeta($_FILES['archPresDeta'])) {
                                                if ($presupuestoD-> agregarEgreso()) {
                                                    throw new Exception('Exito');
                                                } else {
                                                    if ($presupuestoD->unsetArchivoDeta()) {
                                                        throw new Exception(Database::getException());
                                                    } else {
                                                        throw new Exception("Elimine la imagen manualmente");
                                                    }
                                                }
                                            } else {
                                                throw new Exception($presupuestoD->getImageError());
                                            }
                                        } else {
                                            throw new Exception("Seleccione un archivo");
                                        }
                                    } else {
                                        throw new Exception('No se encontro el usuario');
                                    }
                                } else {
                                    throw new Exception('Error con la fecha');
                                }
                            } else {
                                throw new Exception('La cantidad a ingresar sobrepasa el presupuesto: $' . $cantidadIngreso);
                            }
                        } else {
                            throw new Exception('La cantidad debe ser mayor a 0');
                        }
                    } else {
                        throw new Exception('Al parecer este mes no se le ha agregado su presupuesto, contactar con la casa encargada para poder solucionarlo');
                    }
                } else {
                    throw new Exception('No se encontro la casa');
                }
                break;
        }
    }
} catch (Exception $error) {
    //enviando el mensaje ya sea de exito o de error en json
    echo json_encode($error->getMessage());
}
