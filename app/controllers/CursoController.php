<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/Curso.php';
date_default_timezone_get();
session_start();
try {
    //inicializando la clase de categoria
    $curso = new Curso;
    //si el post es para la datatable del crud de categoria
    if (isset($_POST['tabla'])) {
        switch ($_POST['tabla']) {
            case 'casa':
                if ($curso->setCodiCasa($_SESSION['codi_casa'])) {
                    if (isset($_POST['fechInic']) && isset($_POST['fechFin'])) {
                        $anioInicial = date('Y', strtotime($_POST['fechInic']));
                        $anioFinal   = date('Y', strtotime($_POST['fechFin']));
                        $data        = $curso->getCursoCasa($anioInicial, $anioFinal);
                        echo $data;
                    } else {
                        $data = $curso->getCursoCasa(date('Y'), date('Y'));
                        echo $data;
                    }
                }
                break;
            case 'casas':
                if (isset($_POST['fechInicC']) && isset($_POST['fechFinC'])) {
                    $anioInicialC = date('Y', strtotime($_POST['fechInicC']));
                    $anioFinalC   = date('Y', strtotime($_POST['fechFinC']));
                    $dataC        = $curso->getCursoCasas($anioInicialC, $anioFinalC);
                    echo $dataC;
                } else {
                    $dataC = $curso->getCursoCasas(date('Y'), date('Y'));
                    echo $dataC;
                }
                break;
        }
    }
    //si el post es para una de las acciones del crud
    if (isset($_POST['accion'])) {
        //Validando los datos del formulario
        $_POST = $curso->validateForm($_POST);
        //switch para verificar que accion es la que se va a realizar
        switch ($_POST['accion']) {
            case 'verificarInfo':
                if ($_SESSION['codi_casa'] == 1) {
                    throw new Exception('casas');
                } else {
                    throw new Exception('casa');
                }
                break;
            //en el caso que la accion sea de crear una nueva categoria
            case 'create':
                if ($curso->setCodiCate($_POST['codiCate'])) {
                    if ($curso->setCodiCasa($_SESSION['codi_casa'])) {
                        if ($curso->setNombCurs($_POST['nombCurs'])) {
                            if ($curso->setFechInic($_POST['fechInic'])) {
                                if ($curso->setFechFin($_POST['fechFin'])) {
                                    $fechaInicio = strtotime($curso->getFechInic());
                                    $fechaFin    = strtotime($curso->getFechFin());
                                    if ($fechaInicio < $fechaFin) {
                                        if ($curso->createCurso()) {
                                            throw new Exception($curso->obtenerIdUltimo());
                                        } else {
                                            throw new Exception("No se pudo crear el curso");
                                        }
                                    } else {
                                        throw new Exception("La fecha inicial no puede ser mayor a la final");
                                    }
                                } else {
                                    throw new Exception("Verifique la fecha final");
                                }
                            } else {
                                throw new Exception("Verifique la fecha inicial");
                            }
                        } else {
                            throw new Exception("Verifique el nombre del curso");
                        }
                    } else {
                        throw new Exception("No se encontro la casa");
                    }
                } else {
                    throw new Exception("Seleccione la categoria del curso");
                }
                break;
            //en el caso de que la accion sea de modificar la categoria
            case 'update':
                if ($curso->setCodiCurs($_POST['codiCursUpda'])) {
                    if ($curso->setCodiCate($_POST['codiCateUpda'])) {
                        if ($curso->setNombCurs($_POST['nombCursUpda'])) {
                            if ($curso->setFechInic($_POST['fechInicUpda'])) {
                                if ($curso->setFechFin($_POST['fechFinUpda'])) {
                                    $fechaInicio = strtotime($curso->getFechInic());
                                    $fechaFin    = strtotime($curso->getFechFin());
                                    if ($fechaInicio < $fechaFin) {
                                        if ($curso->updateCurso()) {
                                            throw new Exception("Exito");
                                        } else {
                                            throw new Exception("No se pudo crear el curso");
                                        }
                                    } else {
                                        throw new Exception("La fecha inicial no puede ser mayor a la final");
                                    }
                                } else {
                                    throw new Exception("Verifique la fecha final");
                                }
                            } else {
                                throw new Exception("Verifique la fecha inicial");
                            }
                        } else {
                            throw new Exception("Verifique el nombre del curso");
                        }
                    } else {
                        throw new Exception("Debe seleccionar la categoria");
                    }
                } else {
                    throw new Exception("No se ha encontrado el curso");
                }
                break;
            case 'delete':
                //si se setea con exito el codigo del registro
                if ($curso->setCodiCurs($_POST['codiCursDele'])) {
                    //si se setea con exito el nombre del registro
                    if ($curso->deleteCurso()) {
                        throw new Exception("Exito");
                    } else {
                        //se envia mensaje de error
                        throw new Exception('No se pudo eliminar el curso');
                    }
                } else {
                    //se envia mensaje de error
                    throw new Exception('No se encontro el curso');
                }
                break;
        }
    }

} catch (Exception $error) {
    //enviando el mensaje ya sea de exito o de error en json
    echo json_encode($error->getMessage());
}
