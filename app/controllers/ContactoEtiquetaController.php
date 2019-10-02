<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla acreditacion
require_once APP_PATH . '/app/models/ContactoEtiqueta.php';

try {
    //inicializando la clase de categoria
    $contactoetiqueta = new ContactoEtiqueta;

    if (isset($_POST['type'])) {
        //se obtiene la lista sin array asociativo
        $data = $contactoetiqueta->getEtiquetasContacto($_POST['codiContEtiq']);
        //imprimiendo la lista en tipo json
        echo json_encode($data);
    }
    //si el post es para una de las acciones del crud
    if (isset($_POST['accion'])) {
        //Validando las fotos del formulario
        $_POST = $contactoetiqueta->validateForm($_POST);
        //switch para verificar que accion es la que se va a realizar
        switch ($_POST['accion']) {
                //en el caso que la accion sea de crear una nueva categoria
            case 'create':
                //si se setea con exito el nombre de la categoria
                if ($contactoetiqueta->setCodiCont($_POST['codiCont'])) {
                    $etiquetas = explode(",", $_POST['codiEtiq']);
                    for ($i = 0; $i < count($etiquetas); $i++) {
                        if ($contactoetiqueta->setCodiEtiq($etiquetas[$i])) {
                            if ($contactoetiqueta->createContactoEtiqueta()) { } else {
                                throw new Exception('Error al agregar al contacto a las etiquetas');
                            }
                        } else {
                            throw new Exception('No se encontro la etiqueta');
                        }
                    }
                    throw new Exception('Exito');
                } else {
                    throw new Exception('No se encontro el contacto');
                }
                break;
            case 'update':
                //si se setea con exito el nombre de la categoria
                if ($contactoetiqueta->setCodiCont($_POST['codiContUpda'])) {
                    $etiquetas = explode(",", $_POST['codiEtiqUpda']);
                    $contactoetiqueta->deleteContactoEtiqueta();
                    for ($i = 0; $i < count($etiquetas); $i++) {
                        if ($contactoetiqueta->setCodiEtiq($etiquetas[$i])) {
                            if ($contactoetiqueta->createContactoEtiqueta()) { } else {
                                throw new Exception('Error al modificar al contacto a las etiquetas');
                            }
                        } else {
                            throw new Exception('No se encontro la etiqueta');
                        }
                    }
                    throw new Exception('Exito');
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
