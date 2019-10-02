<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/EventoDetalle.php';
require_once '../../config/enviandoMail.php';
session_start();
try {
    //inicializando la clase de categoria
    $eventodetalle = new EventoDetalle;
    //si el post es para la datatable del crud de categoria
    if (isset($_POST['tabla'])) {
        //se obtiene la lista en array asociativo con formato json
        if ($eventodetalle->setCodiEven($_POST['codiEven'])) {
            $data = $eventodetalle->getEventoDetalle();
        }
        //se imprime la lista
        echo $data;
    }
    //si el post es para una de las acciones del crud
    if (isset($_POST['accion'])) {
        //Validando las fotos del formulario
        $_POST = $eventodetalle->validateForm($_POST);
        //switch para verificar que accion es la que se va a realizar
        switch ($_POST['accion']) {
                //en el caso que la accion sea de crear una nueva categoria
            case 'create':
                if (isset($_POST['codiEtiq'])) {
                    if (isset($_POST['codiCont'])) {
                        if ($eventodetalle->setCodiEven($_POST['codiEven'])) {
                            if ($eventodetalle->setCodiEtiq($_POST['codiEtiq'])) {
                                if ($eventodetalle->updateEstadoEvento()) {
                                    $codigos = explode(",", $_POST['codiCont']);
                                    for ($i = 0; $i < count($codigos); $i++) {
                                        $token = bin2hex(openssl_random_pseudo_bytes(64));
                                        if ($eventodetalle->setCodiCont($codigos[$i])) {
                                            if ($eventodetalle->createEventoDetalle($token)) { } else {
                                                throw new Exception('No se pudo agregar el invitado al evento');
                                            }
                                        } else {
                                            throw new Exception('No se encontro el contacto, intentelo mas tarde');
                                        }
                                    }
                                    throw new Exception('Exito');
                                } else {
                                    throw new Exception('No se pudo modificar el estado del evento');
                                }
                            }
                        } else {
                            throw new Exception('No se encontro el evento');
                        }
                    } else {
                        throw new Exception('No se encontro el contacto');
                    }
                } else {
                    throw new Exception('Debe seleccionar una etiqueta');
                }
                break;
            case 'delete':
                if ($eventodetalle->setCodiEvenDeta($_POST['codiEvenDetaDele'])) {
                    if ($eventodetalle->deleteEventoDetalle()) {
                        throw new Exception('Exito');
                    } else {
                        throw new Exception('No se pudo eliminar el invitado del evento');
                    }
                } else {
                    throw new Exception('No se encontro el invitado');
                }

                break;
            case 'asistencia':
                if ($eventodetalle->setCodiEvenDeta($_POST['codiEvenDetaAsis'])) {
                    if ($eventodetalle->setCodiUsua($_SESSION['codi_usua'])) {
                        if ($eventodetalle->updateAsistenciaEvento()) {
                            throw new Exception('Exito');
                        } else {
                            throw new Exception('No se pudo pasar asistencia, favor hablar con el administrador del sitio');
                        }
                    } else {
                        throw new Exception('No se encontro el usuario');
                    }
                } else {
                    throw new Exception('No se encontro el invitado');
                }
                break;

            case 'confirmacion':
                $asistencia = $eventodetalle->obtenerConfirmacion($_POST['token']);
                $existencia = $eventodetalle->existenciaToken($_POST['token']);
                if ($existencia['existe'] > 0) {
                    if ($asistencia['conf_even_deta'] == 0) {
                        if ($eventodetalle->confirmarAsistenciaEvento($_POST['token'])) {
                            $infoUsuario = $eventodetalle->getInfoUsuario($_POST['token']);
                            $infoContacto = $eventodetalle->getInfoUsuarioConfirmacion($_POST['token']);
                            //Informacion de la persona
                            if (enviarCorreoConfirmacionPersona($infoContacto['nomb_cont'], $infoContacto['corr_cont'], $infoContacto['nomb_even'], $infoContacto['corr_even'])) {
                                //informacion del encargado del evento
                                if (enviarCorreoConfirmacionEncargado($infoUsuario['nomb_usua'], $infoUsuario['corre_usua'], $infoUsuario['nomb_even'], $infoUsuario['nomb_cont'])) {
                                    throw new Exception('Exito');
                                } else {
                                    throw new Exception('No se pudo enviar el correo');
                                }
                            } else {
                                throw new Exception('No se pudo enviar el correo');
                            }
                        } else {
                            throw new Exception('No se pudo confirmar la asistencia');
                        }
                    } else {
                        throw new Exception('Ya ha confirmado su asistencia, lo esperamos');
                    }
                } else {
                    throw new Exception('Al parecer no se pudo encontrar su asistencia, favor contactarse directamente para confirmar su asistencia al evento');
                }
                break;
            case 'enviarInvitacion':
                if ($eventodetalle->setCodiEven($_POST['codiEven'])) {
                    $evento = $eventodetalle->infoEvento();
                    $contactos = $eventodetalle->infoContacto();
                    foreach ($contactos as $contacto) {
                        if (enviarCorreoInvitacion($contacto['toke_conf'], $evento['nomb_even'],  $contacto['corr_cont'], $contacto['nomb_cont'], $evento['foto_even'], $evento['corr_even'], $contacto['nomb_prof'])) { } else {
                            throw new Exception('No se pudo enviar el correo');
                        }
                    }
                    $eventodetalle->modificarEstadoAsistenciaEnviada();
                    throw new Exception('Exito');
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
