<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/Quedan.php';
date_default_timezone_set("America/El_Salvador");
session_start();
require '../../config/enviandoMail.php';
try {
    //inicializando la clase de categorias
    $quedan = new Quedan;
    //si el post es para la datatable del crud de categoria
    if (isset($_POST['tabla'])) {
        //se obtiene la lista en array asociativo con formato json
        $data = null;
        if ($_SESSION['codi_tipo_casa']==1) {
            $data = $quedan->getListaQuedanCasaEncargada($_SESSION['codi_casa']);
        } else {
            $data = $quedan->getListaQuedanCasa($_SESSION['codi_casa']);
        }
        //se imprime la lista
        echo $data;
    }
    if (isset($_POST['facturasP'])) {
        $data = $quedan->getFacturasPendientesQuedan();
        echo json_encode($data);
    }
    //si el post es para una de las acciones del crud
    if (isset($_POST['accion'])) {
        //Validando los datos del formulario
        $_POST = $quedan-> validateForm($_POST);
        //switch para verificar que accion es la que se va a realizar
        switch ($_POST['accion']) {
            case 'create':
                if ($quedan->setNumeQued($_POST['numeQued'])) {
                    if ($quedan->setFechEmis($_POST['fechEmis'])) {
                        if ($quedan->setFechIngr(date('Y-m-d'))) {
                                if ($quedan->setCantFact($_POST['cantFact'])) {
                                    if (is_uploaded_file($_FILES['archQuedan']['tmp_name'])) {
                                        if ($quedan->setArchQued($_FILES['archQuedan'])) { 
                                            if ($quedan->addQuedan()) {
                                                throw new Exception(Database::getLastRowId());
                                            } else {
                                                if ($quedan->unsetArchQued()) {
                                                    throw new Exception(Database::getException());
                                                } else {
                                                    throw new Exception("Elimine el quedan manualmente");
                                                }
                                            }
                                        } else {
                                            throw new Exception($quedan->getImageError());
                                        }
                                    } else {
                                        throw new Exception("Seleccione un archivo");
                                    }
                                } else {
                                    throw new Exception("Debe ingresar la cantidad de facturas");
                                }
                        } else {
                            throw new Exception('Error con la fecha');
                        }
                } else {
                    throw new Exception('Debe ingresar la fecha del quedan');
                }
            }else{
                throw new Exception('Debe ingresar el numero del quedan');
            }
                break;
            case 'abono':
            if ($quedan->setCodiQued($_POST['codiQuedUpdaEsta'])) {
                if ($quedan->setFechAbon(date("Y-m-d"))) {
                    if ($quedan->abonarQuedan()) {
                        $casas = $quedan->obtenerInfoCasaQuedan();
                        $quedan->updateEstadoQuedan(2);
                        $obtenerCorreoEmisor = $quedan->obtenerCorreoEmisor($_SESSION['codi_usua']);
                        foreach ($casas as $row) { 
                            $nombreReceptor = $row['nomb_usua']." ".$row['apel_usua'];
				            enviandoCorreoQuedanAbono($_SESSION['nomb_usua'], $obtenerCorreoEmisor['corre_usua'],$_SESSION['nomb_casa'], $nombreReceptor, $row['corre_usua'],$row['nume_qued'],$row['nume_fact']);
                        }
                        $quedan->updateEstadoQuedan(2);
                        throw new Exception("Exito");
                    } else {
                        throw new Exception("No se pudo agregar el abono, notificar al administrador");
                    }
                } else {
                    throw new Exception("Error con la fecha de abono");
                }
            } else {
                throw new Exception("No se encontro el codigo del quedan");
            }
            break;
            case 'abonoVerificado':
            if ($quedan->setCodiQued($_POST['codiQuedUpdaFinEsta'])) {
                //obtener informacion de casa que ingreso el quedan
                $row = $quedan->obtenerInfoCasaQuedanAbono();
                //modificar el estado del quedan para que ya no aparezca
                $quedan->updateEstadoQuedan(3);
                $obtenerCorreoEmisor = $quedan->obtenerCorreoEmisor($_SESSION['codi_usua']);
                //enviando correo a la cas que lo agrego que si se confirmo el abono
                $nombreReceptor = $row['nomb_usua']." ".$row['apel_usua'];
                enviandoCorreoQuedanFin($_SESSION['nomb_usua'], $obtenerCorreoEmisor['corre_usua'],$_SESSION['nomb_casa'], $nombreReceptor, $row['corre_usua'],$row['nume_qued']);
                throw new Exception("Exito");
            } else {
                throw new Exception("No se encontro el codigo del quedan");
            }
            break;
        }
    }
} catch (Exception $error) {
    //enviando el mensaje ya sea de exito o de error en json
    echo json_encode($error->getMessage());
}
