<?php
//llamando el archivo app

//use PHPMailer\PHPMailer\Exception;

use PHPMailer\PHPMailer\Exception;

require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/Evento.php';
date_default_timezone_set('America/El_Salvador');
session_start();
try {
    //inicializando la clase de categoria
    $evento = new Evento;
    //si el post es para la datatable del crud de categoria
    if (isset($_POST['tabla'])) {
        //se obtiene la lista en array asociativo con formato json
        $data = $evento->getEvento();
        //se imprime la lista
        echo $data;
    }
    if (isset($_POST['dashboard'])) {
        $data = $evento->getEventoAhora(date('Y-m-d'));
        echo json_encode($data);
    }
    if (isset($_POST['tipo'])) {
        $data = $evento->getEventos();
        echo json_encode($data);
    }
    //si el post es para una de las acciones del crud
    if (isset($_POST['accion'])) {
        //Validando las fotos del formulario
        $_POST = $evento->validateForm($_POST);
        //switch para verificar que accion es la que se va a realizar
        switch ($_POST['accion']) {
                //en el caso que la accion sea de crear una nueva categoria
            case 'create':
                if ($evento->setNombEven($_POST['nombEven'])) {
                    if ($evento->setDescEven($_POST['descEven'])) {
                        if ($evento->setFechEven($_POST['fechEven'])) {
                            if (is_uploaded_file($_FILES['fotoEven']['tmp_name'])) {
                                if ($evento->setImagen($_FILES['fotoEven'])) {
                                    if ($evento->createEvento($_SESSION['codi_usua'],$_POST['corrEven'])) {
                                        throw new Exception(Database::getLastRowId());
                                    } else {
                                        if ($evento->unsetImagen()) {
                                            throw new Exception(Database::getException());
                                        } else {
                                            throw new Exception("Elimine la imagen manualmente");
                                        }
                                    }
                                } else {
                                    throw new Exception($evento->getImageError());
                                }
                            } else {
                                throw new Exception("Seleccione una imagen");
                            }
                        } else {
                            throw new Exception('Debe ingresar la decha del evento');
                        }
                    } else {
                        throw new Exception('Verifique la descripcion del evento');
                    }
                } else {
                    throw new Exception('Verifique el nombre del evento');
                }
                break;
                //en el caso de que la accion sea de modificar la categoria
            case 'update':
                if ($evento->setCodiEven($_POST['codiEvenUpda'])) {
                    if ($evento->setNombEven($_POST['nombEvenUpda'])) {
                        if ($evento->setDescEven($_POST['descEvenUpda'])) {
                            if ($evento->setFechEven($_POST['fechEvenUpda'])) {
                                if ($evento->updateEvento($_POST['corrEvenUpda'])) {
                                    throw new Exception('Exito');
                                } else {
                                    throw new Exception('No se pudo modificar el evento, intentelo mas tarde');
                                }
                            } else {
                                throw new Exception('Debe ingresar la decha del evento');
                            }
                        } else {
                            throw new Exception('Verifique la descripcion del evento');
                        }
                    } else {
                        throw new Exception('Verifique el nombre del evento');
                    }
                } else {
                    throw new Exception('No se encontro el evento');
                }

                break;
            case 'delete':
                if ($evento->setCodiEven($_POST['codiEvenDele'])) {
                    if ($evento->deleteEvento()) {
                        throw new Exception('Exito');
                    } else {
                        throw new Exception('No se pudo eliminar el evento, intentelo mas tarde');
                    }
                } else {
                    throw new Exception('No se encontro el evento');
                }

                break;
        }
    }
} catch (Exception $error) {
    //enviando el mensaje ya sea de exito o de error en json
    echo json_encode($error->getMessage());
}
