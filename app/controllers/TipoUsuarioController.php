<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/TipoUsuario.php';
try {
    //inicializando la clase de categoria
    $tipoUsuario = new TipoUsuario;
    //si el post es para llenar campos que no tienen que ver en el crud de categoria
    if (isset($_POST['type'])) {
        $data = $tipoUsuario->getTipoUsuarioN();
        //imprimiendo la lista en tipo json
        echo json_encode($data);
    }
} catch (Exception $error) {
    //enviando el mensaje ya sea de exito o de error en json
    echo json_encode($error->getMessage());
}
