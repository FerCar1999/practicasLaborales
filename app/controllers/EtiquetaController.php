<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/Etiqueta.php';
session_start();
try {
    //inicializando la clase de contacto
    $etiqueta = new Etiqueta;
    //si el post es para llenar campos que no tienen que ver en el crud de categoria
    if (isset($_POST['type'])) {
        //se obtiene la lista sin array asociativo
        $data = $etiqueta->getEtiquetasN($_POST['codiEtiqDele']);
        //imprimiendo la lista en tipo json
        echo json_encode($data);
    }
    if (isset($_POST['tipo'])) {
        //se obtiene la lista sin array asociativo
        $data = $etiqueta->getEtiquetasT();
        //imprimiendo la lista en tipo json
        echo json_encode($data);
    }
    if (isset($_POST['etiquetasEvento'])) {
        //se obtiene la lista sin array asociativo
        $data = $etiqueta->getEtiquetasEvento($_POST['codiEven']);
        //imprimiendo la lista en tipo json
        echo json_encode($data);
    }
    //si el post es para la datatable del crud de categoria
    if (isset($_POST['tabla'])) {
        //se obtiene la lista en array asociativo con formato json
        $data = $etiqueta->getEtiquetas();
        //se imprime la lista
        echo $data;
    }
    //si el post es para una de las acciones del crud
    if (isset($_POST['accion'])) {
        //Validando las fotos del formulario
        $_POST = $etiqueta->validateForm($_POST);
        //switch para verificar que accion es la que se va a realizar
        switch ($_POST['accion']) {
                //en el caso que la accion sea de crear una nueva categoria
            case 'create':
                if ($etiqueta->setNombEtiq($_POST['nombEtiq'])) {
                    if ($etiqueta->createEtiqueta()) {
                        throw new Exception('Exito');
                    } else {
                        throw new Exception('No se pudo crear la etiqueta');
                    }
                } else {
                    throw new Exception('Ingrese el nombre de la etiqueta');
                }
                break;
            case 'update':
                if ($etiqueta->setCodiEtiq($_POST['codiEtiqUpda'])) {
                    if ($etiqueta->setNombEtiq($_POST['nombEtiqUpda'])) {
                        if ($etiqueta->updateEtiqueta()) {
                            throw new Exception('Exito');
                        } else {
                            throw new Exception('No se pudo modificar la etiqueta');
                        }
                    } else {
                        throw new Exception('Ingrese el nombre de la etiqueta');
                    }
                } else {
                    throw new Exception('No se encontro la etiqueta');
                }

                break;
            case 'delete':
                if ($etiqueta->setCodiEtiq($_POST['codiEtiqDele'])) {
                    if ($etiqueta->updateContactosEtiqueta($_POST['codiEtiqNuev'])) {
                        if ($etiqueta->deleteEtiqueta()) {
                            throw new Exception('Exito');
                        } else {
                            throw new Exception('No se pudo eliminar la etiqueta');
                        }
                    } else {
                        throw new Exception('No se pudieron pasar los contactos a la etiqueta seleccionada');
                    }
                } else {
                    throw new Exception('Seleccione la profesion del contacto');
                }
                break;
        }
    }
} catch (Exception $error) {
    //enviando el mensaje ya sea de exito o de error en json
    echo json_encode($error->getMessage());
}
