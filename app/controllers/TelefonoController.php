<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/Telefono.php';
session_start();
try {
    //inicializando la clase de categoria
    $telefono = new Telefono;
    //si el post es para la datatable del crud de categoria
    if (isset($_POST['tabla'])) {
        $data = null;
        if ($telefono->setCodiCasa($_SESSION['codi_casa'])) {
            $data = $telefono->getTelefonos();
        }
        //se imprime la lista
        echo $data;
    }
    //si el post es para una de las acciones del crud
    if (isset($_POST['accion'])) {
        //Validando las fotos del formulario
        $_POST = $telefono->validateForm($_POST);
        //switch para verificar que accion es la que se va a realizar
        switch ($_POST['accion']) {
            //en el caso que la accion sea de crear una nueva categoria
            case 'create':
                //si se setea con exito el nombre de la categoria
                if ($telefono->setCodiTipoTele($_POST['codiTipoTele'])) {
                    if ($telefono->setNumeTele($_POST['numeTele'])) {
                        if ($telefono->setCodiCasa($_SESSION['codi_casa'])) {
                            if ($telefono->createTelefono()) {
                                throw new Exception("Exito");
                            } else {
                                throw new Exception("No se pudo agregar el telefono");
                            }
                        } else {
                            throw new Exception("No se encontro la casa");
                        }
                    } else {
                        throw new Exception("El número tiene que iniciar con 2, 6 o 7 y ser de 8 digitos");
                    }
                } else {
                    //se envia mensaje de error
                    throw new Exception('Seleccione el tipo de telefono');
                }
                break;
            //en el caso de que la accion sea de modificar la categoria
            case 'update':
                //si se setea con exito el codigo del registro
                if ($telefono->setCodiTele($_POST['codiTeleUpda'])) {
                    if ($telefono->setCodiTipoTele($_POST['codiTipoTeleUpda'])) {
                        if ($telefono->setNumeTele($_POST['numeTeleUpda'])) {
                            if ($telefono->updateTelefono()) {
                                throw new Exception("Exito");
                            } else {
                                throw new Exception("No se pudo modificar el telefono");
                            }
                        } else {
                            throw new Exception("El número tiene que iniciar con 2, 6 o 7 y ser de 8 digitos");
                        }
                    } else {
                        //se envia mensaje de error
                        throw new Exception('Seleccione el tipo de telefono');
                    }
                } else {
                    //se envia mensaje de error
                    throw new Exception('No se encontro el docente');
                }
                break;
            case 'delete':
                //si se setea con exito el codigo del registro
                if ($telefono->setCodiTele($_POST['codiTeleDele'])) {
                    if ($telefono->deleteTelefono()) {
                        throw new Exception("Exito");
                    } else {
                        throw new Exception("No se pudo eliminar el telefono");
                    }
                } else {
                    //se envia mensaje de error
                    throw new Exception('No se encontro el telefono');
                }
                break;
        }
    }

} catch (Exception $error) {
    //enviando el mensaje ya sea de exito o de error en json
    echo json_encode($error->getMessage());
}
