<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/IntermediaCursoSalon.php';
session_start();
try {
	//inicializando la clase de categoria
	$intermediaCursoSalon = new IntermediaCursoSalon;
	//si el post es para una de las acciones del crud
	if (isset($_POST['accion'])) {
		//Validando las fotos del formulario
		$_POST = $intermediaCursoSalon->validateForm($_POST);
		//switch para verificar que accion es la que se va a realizar
		switch ($_POST['accion']) {
		//en el caso que la accion sea de crear una nueva categoria
		case 'create':
			//si se setea con exito el nombre de la categoria
			if ($intermediaCursoSalon->setCodiCurs($_POST['codiCurs'])) {
				if ($intermediaCursoSalon->setCodiSalo($_POST['codiSalo'])) {
					if ($intermediaCursoSalon->createIntermediaCursoSalon()) {
						throw new Exception($intermediaCursoSalon->obtenerIdUltimo());
					} else {
						throw new Exception("No se pudo agregar el curso");
					}
				} else {
					throw new Exception("No se encontro el salon");
				}
			} else {
				//se envia mensaje de error
				throw new Exception('No se encontro el curso');
			}
			break;
		//en el caso que la accion sea de crear una nueva categoria
		case 'createN':
			//si se setea con exito el nombre de la categoria
			if ($intermediaCursoSalon->setCodiCurs($_POST['codiCursN'])) {
				if ($intermediaCursoSalon->setCodiSalo($_POST['codiSaloN'])) {
					if ($intermediaCursoSalon->createIntermediaCursoSalon()) {
						throw new Exception($intermediaCursoSalon->obtenerIdUltimo());
					} else {
						throw new Exception("No se pudo agregar el curso");
					}
				} else {
					throw new Exception("No se encontro el salon");
				}
			} else {
				//se envia mensaje de error
				throw new Exception('No se encontro el curso');
			}
			break;
		//en el caso de que la accion sea de modificar la categoria
		case 'update':
			//si se setea con exito el codigo del registro
			if ($intermediaCursoSalon->setCodiSalo($_POST['codiSaloUpda'])) {
				if ($intermediaCursoSalon->setCodiInteCursSalo($_POST['codiInteCursSaloUpda'])) {
					if ($intermediaCursoSalon->updateIntermediaCursoSalon()) {
						throw new Exception("Exito");
					} else {
						throw new Exception("No se pudo modificar el horario de curso");
					}
				} else {
					//se envia mensaje de error
					throw new Exception('No se pudo encontrar el horario');
				}
			} else {
				//se envia mensaje de error
				throw new Exception('Debe ingresar el salon');
			}
			break;
		case 'delete':
			if ($intermediaCursoSalon->setCodiInteCursSalo($_POST['codiInteCursSaloDele'])) {
				if ($intermediaCursoSalon->eliminarHorarioCompleto()) {
					throw new Exception("Exito");
				} else {
					throw new Exception("No se pudo eliminar el horario de curso");
				}
			} else {
				//se envia mensaje de error
				throw new Exception('No se pudo encontrar el horario');
			}
			break;
		}
	}

} catch (Exception $error) {
	//enviando el mensaje ya sea de exito o de error en json
	echo json_encode($error->getMessage());
}
