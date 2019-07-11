<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/Profesion.php';

try {
	//inicializando la clase de categoria
	$profesion = new Profesion;
	//si el post es para llenar campos que no tienen que ver en el crud de categoria
	if (isset($_POST['tabla'])) {
		//se obtiene la lista sin array asociativo
		$data = $profesion->getProfesion();
		//imprimiendo la lista en tipo json
		echo $data;
	}
	if (isset($_POST['type'])) {
		//se obtiene la lista sin array asociativo
		$data = $profesion->getProfesionN();
		//imprimiendo la lista en tipo json
		echo json_encode($data);
	}
	//si el post es para una de las acciones del crud
	if (isset($_POST['accion'])) {
		//Validando las fotos del formulario
		$_POST = $profesion->validateForm($_POST);
		//switch para verificar que accion es la que se va a realizar
		switch ($_POST['accion']) {
		//en el caso que la accion sea de crear una nueva categoria
		case 'create':
			//si se setea con exito el nombre de la categoria
			if ($profesion->setNombProf($_POST['nombProf'])) {
				//creando nueva categoria
				if ($profesion->createProfesion()) {
					//se envia un mensaje de exito
					throw new Exception('Exito');
				} else {
					//se envia un mensaje de error
					throw new Exception('No se pudo agregar la profesion');
				}
			} else {
				//se envia mensaje de error
				throw new Exception('Verifique el nombre de la profesion');
			}
			break;
		case 'update':
			if ($profesion->setCodiProf($_POST['codiProfUpda'])) {
				//si se setea con exito el nombre de la categoria
				if ($profesion->setNombProf($_POST['nombProfUpda'])) {
					//creando nueva categoria
					if ($profesion->updateProfesion()) {
						//se envia un mensaje de exito
						throw new Exception('Exito');
					} else {
						//se envia un mensaje de error
						throw new Exception('No se pudo modificar la profesion');
					}
				} else {
					//se envia mensaje de error
					throw new Exception('Verifique el nombre de la profesion');
				}
			} else {
				throw new Exception('No se encontro la profesion');
			}

			break;
		case 'delete':
			//si se setea con exito el nombre de la categoria
			if ($profesion->setCodiProf($_POST['codiProfDele'])) {
				//creando nueva categoria
				if ($profesion->deleteProfesion()) {
					//se envia un mensaje de exito
					throw new Exception('Exito');
				} else {
					//se envia un mensaje de error
					throw new Exception('No se pudo eliminar la profesion');
				}
			} else {
				//se envia mensaje de error
				throw new Exception('No se encontro la profesion');
			}
			break;
		}
	}
} catch (Exception $error) {
	//enviando el mensaje ya sea de exito o de error en json
	echo json_encode($error->getMessage());
}