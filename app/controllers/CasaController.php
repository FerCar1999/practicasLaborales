<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/Casa.php';
session_start();
try {
    //inicializando la clase de categoria
    $casa = new Casa;
    //si el post es para llenar campos que no tienen que ver en el crud de categoria
    if (isset($_POST['type'])) {
        //se obtiene la lista sin array asociativo
        $data = $casa->getCasasN();
        //imprimiendo la lista en tipo json
        echo json_encode($data);
    }
    //si el post es para la datatable del crud de categoria
    if (isset($_POST['tabla'])) {
        //se obtiene la lista en array asociativo con formato json
        $data = $casa->getCasas();
        //se imprime la lista
        echo $data;
    }
    //si el post es para una de las acciones del crud
    if (isset($_POST['accion'])) {
        //Validando los datos del formulario
        $_POST = $casa->validateForm($_POST);
        //switch para verificar que accion es la que se va a realizar
        switch ($_POST['accion']) {
            case 'getCasa':
                if ($casa->setCodiCasa($_SESSION['codi_casa'])) {
                    $data = $casa->getInfoCasa();

                } else {
                    throw new Exception('No se encontro la casa');
                }
                echo json_encode($data);

                break;
            //en el caso que la accion sea de crear una nueva categoria
            case 'create':
                //si se setea con exito el nombre de la categoria
                if ($casa->setNombCasa($_POST['nombCasa'])) {
                    if ($casa->setDireCasa($_POST['direCasa'])) {
                        if ($casa->setCodiTipoCasa($_POST['codiTipoCasa'])) {
                            if (is_uploaded_file($_FILES['logoCasa']['tmp_name'])) {
                                if ($casa->setImagen($_FILES['logoCasa'])) {
                                    if ($casa->createCasa()) {
                                        throw new Exception($casa->obtenerIdUltimaCasaCreadad());
                                    } else {
                                        if ($casa->unsetImagen()) {
                                            throw new Exception(Database::getException());
                                        } else {
                                            throw new Exception("Elimine la imagen manualmente");
                                        }
                                    }
                                } else {
                                    throw new Exception($casa->getImageError());
                                }
                            } else {
                                throw new Exception("Seleccione una imagen");
                            }
                        } else {
                            throw new Exception("Error con el tipo de casa");
                        }

                    } else {
                        throw new Exception("Verifique la direccion de la casa");
                    }

                } else {
                    //se envia mensaje de error
                    throw new Exception('Verifique el nombre de la casa');
                }
                break;
            //en el caso de que la accion sea de modificar la categoria
            case 'update':
                if ($casa->setCodiCasa($_POST['codiCasa'])) {
                    if ($casa->setNombCasa($_POST['nombCasa'])) {
                        if ($casa->setDireCasa($_POST['direCasa'])) {
                            if (is_uploaded_file($_FILES['logoCasa']['tmp_name'])) {
                                if (!$casa->setImagen($_FILES['logoCasa'])) {
                                    throw new Exception($casa->getImageError());
                                }
                            }
                            if ($casa->updateCasa()) {
                                throw new Exception("Exito");
                            } else {
                                throw new Exception(Database::getException());
                            }

                        } else {
                            throw new Exception("Verifique la direccion de la casa");
                        }

                    } else {
                        //se envia mensaje de error
                        throw new Exception('Verifique el nombre de la casa');
                    }
                } else {
                    throw new Exception('No se encontro la casa');
                }

                break;
            case 'updateLogo':
                if ($casa->setCodiCasa($_SESSION['codi_casa'])) {
                    if (is_uploaded_file($_FILES['logoCasaUpda']['tmp_name'])) {
                        if (!$casa->setImagen($_FILES['logoCasaUpda'])) {
                            throw new Exception($casa->getImageError());
                        }
                    }
                    if ($casa->updateCasaLogo()) {
                        throw new Exception("Exito");
                    } else {
                        throw new Exception(Database::getException());
                    }
                } else {
                    throw new Exception('No se encontro la casa');
                }
                break;
            case 'updateCuenta':
                if ($casa->setCodiCasa($_SESSION['codi_casa'])) {
                    if ($casa->setNombCasa($_POST['nombCasaUpda'])) {
                        if ($casa->setDireCasa($_POST['direCasaUpda'])) {
                            if ($casa->updateCasa()) {
                                throw new Exception("Exito");
                            } else {
                                throw new Exception(Database::getException());
                            }

                        } else {
                            throw new Exception("Verifique la direccion de la casa");
                        }

                    } else {
                        //se envia mensaje de error
                        throw new Exception('Verifique el nombre de la casa');
                    }
                } else {
                    throw new Exception('No se encontro la casa');
                }

                break;
            case 'delete':
                //si se setea con exito el codigo del registro
                if ($casa->setCodiCasa($_POST['codiCasaDele'])) {
                    //si se setea con exito el nombre del registro
                    if ($casa->deleteCasa()) {
                        throw new Exception("Exito");
                    } else {
                        //se envia mensaje de error
                        throw new Exception('No se pudo eliminar');
                    }
                } else {
                    //se envia mensaje de error
                    throw new Exception('No se encontro la casa');
                }
                break;
        }
    }

} catch (Exception $error) {
    //enviando el mensaje ya sea de exito o de error en json
    echo json_encode($error->getMessage());
}
