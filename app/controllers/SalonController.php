<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/Salon.php';
session_start();
try {
    //inicializando la clase de categoria
    $salon = new Salon;
    //si el post es para llenar campos que no tienen que ver en el crud de categoria
    if (isset($_POST['type'])) {
        //se obtiene la lista sin array asociativo
        $data = null;
        if ($salon->setCodiCasa($_SESSION['codi_casa'])) {
            $data = $salon->getSalonesN();
        }
        //imprimiendo la lista en tipo json
        echo json_encode($data);
    }
    //si el post es para la datatable del crud de categoria
    if (isset($_POST['tabla'])) {
        $data = null;
        if ($salon->setCodiCasa($_SESSION['codi_casa'])) {
            $data = $salon->getSalones();
        }
        //se imprime la lista
        echo $data;
    }
    //si el post es para una de las acciones del crud
    if (isset($_POST['accion'])) {
        //Validando las fotos del formulario
        $_POST = $salon->validateForm($_POST);
        //switch para verificar que accion es la que se va a realizar
        switch ($_POST['accion']) {
            //en el caso que la accion sea de crear una nueva categoria
            case 'create':
                //si se setea con exito el nombre de la categoria
                if ($salon->setNombSalo($_POST['nombSalo'])) {
                    if ($salon->setCodiCasa($_SESSION['codi_casa'])) {
                        if ($salon->createSalon()) {
                            throw new Exception("Exito");
                        } else {
                            throw new Exception("No se pudo agregar el salon");
                        }
                    } else {
                        throw new Exception("No se encontro la casa");
                    }
                } else {
                    //se envia mensaje de error
                    throw new Exception('Verifique el nombre del salon');
                }
                break;
            //en el caso de que la accion sea de modificar la categoria
            case 'update':
                //si se setea con exito el codigo del registro
                if ($salon->setCodiSalo($_POST['codiSaloUpda'])) {
                    if ($salon->setNombSalo($_POST['nombSaloUpda'])) {
                        if ($salon->updateSalon()) {
                            throw new Exception("Exito");
                        } else {
                            throw new Exception("No se pudo agregar el salon");
                        }
                    } else {
                        //se envia mensaje de error
                        throw new Exception('Verifique el nombre del salon');
                    }
                } else {
                    //se envia mensaje de error
                    throw new Exception('No se encontro el docente');
                }
                break;
            case 'delete':
                //si se setea con exito el codigo del registro
                if ($salon->setCodiSalo($_POST['codiSaloDele'])) {
                    if ($salon->deleteSalon()) {
                        throw new Exception("Exito");
                    } else {
                        throw new Exception("No se pudo eliminar el salon");
                    }
                } else {
                    //se envia mensaje de error
                    throw new Exception('No se encontro el salon');
                }
                break;
        }
    }

} catch (Exception $error) {
    //enviando el mensaje ya sea de exito o de error en json
    echo json_encode($error->getMessage());
}
