<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/Contacto.php';
session_start();
try {
    //inicializando la clase de contacto
    $contacto = new Contacto;
    //si el post es para llenar campos que no tienen que ver en el crud de categoria
    if (isset($_POST['type'])) {
        //se obtiene la lista sin array asociativo
        $data = $contacto->getContactoN($_POST['codiEtiqRepo']);
        //imprimiendo la lista en tipo json
        echo json_encode($data);
    }
    if (isset($_POST['tipo'])) {
        //se obtiene la lista sin array asociativo
        $data = $contacto->getContactoR($_POST['codiEtiq'], $_POST['codiEven']);
        //imprimiendo la lista en tipo json
        echo json_encode($data);
    }
    //si el post es para la datatable del crud de categoria
    if (isset($_POST['tabla'])) {
        //se obtiene la lista en array asociativo con formato json
        $data = $contacto->getContacto();
        //se imprime la lista
        echo $data;
    }
    //si el post es para una de las acciones del crud
    if (isset($_POST['accion'])) {
        //Validando las fotos del formulario
        $_POST = $contacto->validateForm($_POST);
        //switch para verificar que accion es la que se va a realizar
        switch ($_POST['accion']) {
            case 'reporte':
                //$codigo = json_decode($_POST['codiContRepo']);
                if ($_POST['codiContRepo'] != "") {
                    $codigos = "AND co.codi_cont IN (" . $_POST['codiContRepo'] . ")";
                    $data = $contacto->getContactosEtiqueta($_POST['codiEtiqRepo'], $codigos);
                    echo json_encode($data);
                } else {
                    $data = $contacto->getContactosEtiqueta($_POST['codiEtiqRepo'], "");
                    echo json_encode($data);
                }
                break;
                //en el caso que la accion sea de crear una nueva categoria
            case 'create':
                if (isset($_POST['codiProf'])) {
                    if ($contacto->setCodiProf($_POST['codiProf'])) {
                        if ($contacto->setNombCont($_POST['nombCont'])) {
                            if ($contacto->setApelCont($_POST['apelCont'])) {
                                if ($contacto->setCargCont($_POST['cargCont'])) {
                                    if ($contacto->setEmprCont($_POST['emprCont'])) {
                                        if ($contacto->setDireCont($_POST['direCont'])) {
                                            if ($contacto->setCorrCont($_POST['corrCont'])) {
                                                if ($contacto->setTeleFijoCont($_POST['teleFijoCont'])) {
                                                    if ($contacto->setTeleCeluCont($_POST['teleCeluCont'])) {
                                                        if ($contacto->createContacto()) {
                                                            throw new Exception(Database::getLastRowId());
                                                        } else {
                                                            throw new Exception('No se pudo agregar el nuevo contacto, por favor contactarse con el administrador del sitio.');
                                                        }
                                                    } else {
                                                        throw new Exception('Debe ingresar el celular del contacto, de preferencia que inicie con 2, 6 o 7');
                                                    }
                                                } else {
                                                    throw new Exception('Debe ingresar el telefono fijo del contacto, de preferencia que inicie con 2, 6 o 7');
                                                }
                                            } else {
                                                throw new Exception('Debe ingresar el correo del contacto');
                                            }
                                        } else {
                                            throw new Exception('Debe ingresar la direccion del contacto');
                                        }
                                    } else {
                                        throw new Exception('Debe ingresar la empresa a la cual el contacto pertenece');
                                    }
                                } else {
                                    throw new Exception('Debe ingresar el cargo del contacto');
                                }
                            } else {
                                throw new Exception('Debe ingresar los apellidos del contacto');
                            }
                        } else {
                            throw new Exception('Debe ingresar los nombres del contacto');
                        }
                    }
                } else {
                    throw new Exception('Seleccione la profesion del contacto');
                }
                break;
            case 'update':
                //en el caso de que la accion sea de modificar la categoria
                if (isset($_POST['codiProfUpda'])) {
                    if ($contacto->setCodiProf($_POST['codiProfUpda'])) {
                        if ($contacto->setNombCont($_POST['nombContUpda'])) {
                            if ($contacto->setApelCont($_POST['apelContUpda'])) {
                                if ($contacto->setCargCont($_POST['cargContUpda'])) {
                                    if ($contacto->setEmprCont($_POST['emprContUpda'])) {
                                        if ($contacto->setDireCont($_POST['direContUpda'])) {
                                            if ($contacto->setCorrCont($_POST['corrContUpda'])) {
                                                if ($contacto->setTeleFijoCont($_POST['teleFijoContUpda'])) {
                                                    if ($contacto->setTeleCeluCont($_POST['teleCeluContUpda'])) {
                                                        if ($contacto->setObseCont($_POST['obseContUpda'])) {
                                                            if ($contacto->setCodiCont($_POST['codiContUpda'])) {
                                                                if ($contacto->updateContacto()) {
                                                                    throw new Exception('Exito');
                                                                } else {
                                                                    throw new Exception('No se pudo modificar el nuevo contacto, por favor contactarse con el administrador del sitio.');
                                                                }
                                                            } else {
                                                                throw new Exception('No se encontro el contacto');
                                                            }
                                                        } else {
                                                            throw new Exception('Debe ingresar la observacion del contacto');
                                                        }
                                                    } else {
                                                        throw new Exception('Debe ingresar el celular del contacto, de preferencia que inicie con 2, 6 o 7');
                                                    }
                                                } else {
                                                    throw new Exception('Debe ingresar el telefono fijo del contacto, de preferencia que inicie con 2, 6 o 7');
                                                }
                                            } else {
                                                throw new Exception('Debe ingresar el correo del contacto');
                                            }
                                        } else {
                                            throw new Exception('Debe ingresar la direccion del contacto');
                                        }
                                    } else {
                                        throw new Exception('Debe ingresar la empresa a la cual el contacto pertenece');
                                    }
                                } else {
                                    throw new Exception('Debe ingresar el cargo del contacto');
                                }
                            } else {
                                throw new Exception('Debe ingresar los apellidos del contacto');
                            }
                        } else {
                            throw new Exception('Debe ingresar los nombres del contacto');
                        }
                    }
                } else {
                    throw new Exception('Seleccione la profesion del contacto');
                }
                break;
            case 'delete':
                //si se setea con exito el codigo del registro
                if ($contacto->setCodiCont($_POST['codiContDele'])) {
                    if ($contacto->deleteContacto()) {
                        throw new Exception('Exito');
                    } else {
                        throw new Exception('No se pudo eliminar el contacto');
                    }
                } else {
                    throw new Exception('No se encontro el contacto');
                }
                break;
        }
    }
} catch (Exception $error) {
    //enviando el mensaje ya sea de exito o de error en json
    echo json_encode($error->getMessage());
}
