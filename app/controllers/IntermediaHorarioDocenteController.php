<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/IntermediaHorarioDocente.php';
session_start();
try {
    //inicializando la clase de categoria
    $intermediaHorarioDocente = new Salon;
    //si el post es para una de las acciones del crud
    if (isset($_POST['accion'])) {
        //Validando las fotos del formulario
        $_POST = $intermediaHorarioDocente->validateForm($_POST);
        //switch para verificar que accion es la que se va a realizar
        switch ($_POST['accion']) {
            //en el caso que la accion sea de crear una nueva categoria
            case 'create':
                //si se setea con exito el nombre de la categoria
                if ($intermediaHorarioDocente->setCodiInteCursSalo($_POST['CodiInteCursSalo'])) {
                    if ($intermediaHorarioDocente->setCodiHora($_POST['codiHora'])) {
                        if ($intermediaHorarioDocente->setCodiDoce($_POST['codiDoce'])) {
                            if ($intermediaHorarioDocente->createIntermediaHorarioDocente()) {
                                throw new Exception("Exito");
                            } else {
                                throw new Exception("No se pudo agregar el horario");
                            }
                        } else {
                            throw new Exception("Debe seleccionar el docente");
                        }
                    } else {
                        //se envia mensaje de error
                        throw new Exception('Debe seleccionar el horario');
                    }
                } else {
                    throw new Exception('No se pudo');
                }

                break;
        }
    }

} catch (Exception $error) {
    //enviando el mensaje ya sea de exito o de error en json
    echo json_encode($error->getMessage());
}
