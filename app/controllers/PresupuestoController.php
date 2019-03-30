<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/Presupuesto.php';
date_default_timezone_get();
session_start();
try {
    //inicializando la clase de categoria
    $presupuesto = new Presupuesto;
    //si el post es para la datatable del crud de categoria
    if (isset($_POST['tabla'])) {
        //se obtiene la lista en array asociativo con formato json
        $data = $presupuesto->getPresupuestoCasas(date("m"), date("Y"));
        //se imprime la lista
        echo $data;
    }
    //si el post es para una de las acciones del crud
    if (isset($_POST['accion'])) {
        //Validando los datos del formulario
        $_POST = $presupuesto->validateForm($_POST);
        //switch para verificar que accion es la que se va a realizars
        switch ($_POST['accion']) {
            case 'delete':
                if ($presupuesto->setCodiPres($_POST['codiPresDele'])) {
                    if ($presupuesto->obtenerCantidadEgreso()==0) {
                        if ($presupuesto->deleteIngreso()) {
                            throw new Exception('Exito');
                        } else {
                            throw new Exception('No se pudo eliminar el ingreso');
                        }  
                    } else {
                        throw new Exception('No se puede eliminar el ingreso ya que la casa ya ha realizado gastos');
                    }
                } else {
                    throw new Exception('No se encontro el presupuesto');
                }
                
                break;
            case 'verficarInfo':
                if ($_SESSION['codi_tipo_casa'] == 1) {
                    echo json_encode("casas");
                } else {
                    echo json_encode("casa");
                }
                break;
            case 'getCasasRestantes':
                $data = $presupuesto->obtenerCasasSinPresupuestoMes(date("m"), date("Y"));
                echo json_encode($data);
                break;
            case 'create':
                if ($presupuesto->setCodiCasa($_POST['codiCasaIngre'])) {
                    if ($presupuesto->setCodiUsua($_SESSION['codi_usua'])) {
                        if ($presupuesto->setCantPres($_POST['cantPres'])) {
                            if ($presupuesto->setFechPres(date('Y-m-d'))) {
                                if ($presupuesto->agregarIngreso()) {
                                    throw new Exception('Exito');
                                } else {
                                    throw new Exception('No se pudo agregar al presupuesto');
                                }
                            } else {
                                throw new Exception('Error con la fecha');
                            }
                        } else {
                            throw new Exception('La cantidad debe ser mayor a 0');
                        }
                    } else {
                        throw new Exception('No se encontro el usuario');
                    }
                } else {
                    throw new Exception('Debe seleccionar una casa');
                }
                break;
            case 'update':
                if ($presupuesto->setCodiPres($_POST['codiPresUpda'])) {
                    if ($presupuesto->setCantPres($_POST['cantPresUpda'])) {
                        $cantidadNuevaPresupuesto = $presupuesto->verificarUpdatePresupuesto();
                        if ($cantidadNuevaPresupuesto) {
                            if ($cantidadNuevaPresupuesto['nuevaCantidad']>=0) {
                                if ($presupuesto->updateIngreso()) {
                                throw new Exception('Exito');
                            } else {
                                throw new Exception('No se pudo agregar al presupuesto');
                            }
                            } else {
                                throw new Exception('Debe ingresar una cantidad mayor');
                            }
                            
                        } else {
                            if ($presupuesto->updateIngreso()) {
                                throw new Exception('Exito');
                            } else {
                                throw new Exception('No se pudo agregar al presupuesto');
                            }
                        }
                    } else {
                        throw new Exception('No se encontro el usuario');
                    }
                } else {
                    throw new Exception('Debe seleccionar una casa');
                }
                break;
        }
    }

} catch (Exception $error) {
    //enviando el mensaje ya sea de exito o de error en json
    echo json_encode($error->getMessage());
}
