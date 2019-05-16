<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/Horario.php';
session_start();
try {
    //inicializando la clase de categoria
    $horario = new Horario;
    //si el post es para llenar campos que no tienen que ver en el crud de categoria
    if (isset($_POST['type'])) {
        //se obtiene la lista sin array asociativo
        $data = null;
        if ($horario->setCodiCasa($_SESSION['codi_casa'])) {
            if ($horario->setCodiDia($_POST['codiDia'])) {
                $data = $horario->getHorariosN();
            }
        }
        //imprimiendo la lista en tipo json
        echo json_encode($data);
    }
    //si el post es para la datatable del crud de categoria
    if (isset($_POST['tabla'])) {
        $data = null;
        if ($horario->setCodiCasa($_SESSION['codi_casa'])) {
            $data = $horario->getHorarios();
        }
        //se imprime la lista
        echo $data;
    }
    //si el post es para una de las acciones del crud
    if (isset($_POST['accion'])) {
        //Validando las fotos del formulario
        $_POST = $horario->validateForm($_POST);
        //switch para verificar que accion es la que se va a realizar
        switch ($_POST['accion']) {
            //en el caso que la accion sea de crear una nueva categoria
            case 'create':
                //si se setea con exito el nombre de la categoria
                if ($horario->setHoraInic($_POST['horaInic'])) {
                    if ($horario->setHoraFin($_POST['horaFin'])) {
                        if (strtotime($_POST['horaInic'])<strtotime($_POST['horaFin'])) {
                            if ($horario->setCodiDia($_POST['codiDia'])) {
                                if ($horario->setCodiCasa($_SESSION['codi_casa'])) {
                                    if ($horario->verificarHorarioDia()['cant']<=0) {
                                        if ($horario->createHorario()) {
                                            throw new Exception("Exito");
                                        } else {
                                            throw new Exception("No se pudo agregar el horario");
                                        }
                                    } else {
                                        throw new Exception("La hora que ingreso choca con un horario que ha creado antes");
                                    }
                                } else {
                                    throw new Exception("No se encontro la casa");
                                }
                            } else {
                                throw new Exception("Ingrese el dia del horario");
                            }

                        } else {
                            throw new Exception("La hora final no puede ser menor o igual a la inicial");
                        }
                    } else {
                        throw new Exception("Verifique la hora de fin");
                    }
                } else {
                    //se envia mensaje de error
                    throw new Exception('Verifique la hora de inicio');
                }
                break;
            //en el caso de que la accion sea de modificar la categoria
            case 'update':
                //si se setea con exito el codigo del registro
                if ($horario->setCodiHora($_POST['codiHoraUpda'])) {
                    if ($horario->setHoraInic($_POST['horaInicUpda'])) {
                        if ($horario->setHoraFin($_POST['horaFinUpda'])) {
                            if ($horario->setCodiDia($_POST['codiDiaUpda'])) {
                                if ($horario->updateHorario()) {
                                    throw new Exception("Exito");
                                } else {
                                    throw new Exception("No se pudo modificar el horario");
                                }
                            } else {
                                throw new Exception("Ingrese el dia del horario");
                            }

                        } else {
                            throw new Exception("Verifique la hora de fin");
                        }
                    } else {
                        //se envia mensaje de error
                        throw new Exception('Verifique la hora de inicio');
                    }
                } else {
                    //se envia mensaje de error
                    throw new Exception('No se encontro el docente');
                }
                break;
            case 'delete':
                //si se setea con exito el codigo del registro
                if ($horario->setCodiHora($_POST['codiHoraDele'])) {
                    if ($horario->deleteHorario()) {
                        throw new Exception("Exito");
                    } else {
                        throw new Exception("No se pudo eliminar el horario");
                    }
                } else {
                    //se envia mensaje de error
                    throw new Exception('No se encontro el horario');
                }
                break;
        }
    }

} catch (Exception $error) {
    //enviando el mensaje ya sea de exito o de error en json
    echo json_encode($error->getMessage());
}
