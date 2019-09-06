<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/Categoria.php';
session_start();
try {
    //inicializando la clase de categoria
    $categoria = new Categoria;
    //si el post es para llenar campos que no tienen que ver en el crud de categoria
    if (isset($_POST['type'])) {
        //se obtiene la lista sin array asociativo
        $data = $categoria->getCategoriasN($_SESSION['codi_casa']);
        //imprimiendo la lista en tipo json
        echo json_encode($data);
    }
    if (isset($_POST['tipo'])) {
        //se obtiene la lista sin array asociativo
        $data = $categoria->getCategoriasR();
        //imprimiendo la lista en tipo json
        echo json_encode($data);
    }
    //si el post es para la datatable del crud de categoria
    if (isset($_POST['tabla'])) {
        //se obtiene la lista en array asociativo con formato json
        $data = $categoria->getCategorias();
        //se imprime la lista
        echo $data;
    }
    //si el post es para una de las acciones del crud
    if (isset($_POST['accion'])) {
        //Validando las fotos del formulario
        $_POST = $categoria->validateForm($_POST);
        //switch para verificar que accion es la que se va a realizar
        switch ($_POST['accion']) {
                //en el caso que la accion sea de crear una nueva categoria
            case 'create':
                //si se setea con exito el nombre de la categoria
                if ($categoria->setNombCate($_POST['nombCate'])) {
                    if ($categoria->setCorrCate($_POST['corrCate'])) {
                        //creando nueva categoria
                        if ($categoria->createCategoria()) {
                            //se envia un mensaje de exito
                            throw new Exception('Exito');
                        } else {
                            //se envia un mensaje de error
                            throw new Exception('No se pudo agregar la nueva categoria');
                        }
                    } else {
                        throw new Exception('Debe agregar el diminutivo de la categoria');
                    }
                } else {
                    //se envia mensaje de error
                    throw new Exception('Verifique el nombre de la categoria');
                }
                break;
                //en el caso de que la accion sea de modificar la categoria
            case 'update':
                //si se setea con exito el codigo del registro
                if ($categoria->setCodiCate($_POST['codiCateUpda'])) {
                    //si se setea con exito el nombre del registro
                    if ($categoria->setNombCate($_POST['nombCateUpda'])) {
                        if ($categoria->setCorrCate($_POST['corrCateUpda'])) {
                            //si se setea con exito el estado del registro
                            if ($categoria->setEstaCate($_POST['estaCateUpda'])) {
                                if ($categoria->updateCategoria()) {
                                    throw new Exception('Exito');
                                } else {
                                    throw new Exception('No se pudo modificar la categoria');
                                }
                            } else {
                                //se envia mensaje de error
                                throw new Exception("Verifique el estado de la categoria");
                            }
                        } else {
                            throw new Exception('Debe agregar el correlativo de la categoria');
                        }
                    } else {
                        //se envia mensaje de error
                        throw new Exception('Verifique el nombre de la categoria');
                    }
                } else {
                    //se envia mensaje de error
                    throw new Exception('No se encontro la categoria');
                }
                break;
            case 'delete':
                //si se setea con exito el codigo del registro
                if ($categoria->setCodiCate($_POST['codiCateDele'])) {
                    //si se setea con exito el nombre del registro
                    if ($categoria->setNombCate($_POST['nombCateDele'])) {
                        //si se setea con exito el estado del registro
                        if ($categoria->setEstaCate($_POST['estaCateDele'])) {
                            if ($categoria->updateCategoria()) {
                                throw new Exception('Exito');
                            } else {
                                throw new Exception('No se pudo eliminar la categoria');
                            }
                        } else {
                            //se envia mensaje de error
                            throw new Exception("Verifique el estado de la categoria");
                        }
                    } else {
                        //se envia mensaje de error
                        throw new Exception('Verifique el nombre de la categoria');
                    }
                } else {
                    //se envia mensaje de error
                    throw new Exception('No se encontro la categoria');
                }
                break;
        }
    }
} catch (Exception $error) {
    //enviando el mensaje ya sea de exito o de error en json
    echo json_encode($error->getMessage());
}
