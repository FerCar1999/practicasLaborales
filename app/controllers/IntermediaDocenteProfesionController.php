<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/IntermediaDocenteProfesion.php';

try {
	//inicializando la clase de categoria
	$intermediaDocenteProfesion = new IntermediaDocenteProfesion;
	//si el post es para llenar campos que no tienen que ver en el crud de categoria
	if (isset($_POST['type'])) {
		//se obtiene la lista sin array asociativo
		$data = $intermediaDocenteProfesion->getIntermediaDocenteProfesionN();
		//imprimiendo la lista en tipo json
		echo json_encode($data);
	}
	//si el post es para una de las acciones del crud
	if (isset($_POST['accion'])) {
		//Validando las fotos del formulario
		$_POST = $intermediaDocenteProfesion->validateForm($_POST);
		//switch para verificar que accion es la que se va a realizar
		switch ($_POST['accion']) {
		//en el caso que la accion sea de crear una nueva categoria
		case 'create':
			//si se setea con exito el nombre de la categoria
			if ($intermediaDocenteProfesion->setCodiProf($_POST['codiProf'])) {
				if ($intermediaDocenteProfesion->setCodiDoce($_POST['codiDoce'])) {
					//creando nueva categoria
					if ($intermediaDocenteProfesion->createIntermediaDocenteProfesion()) {
						//se envia un mensaje de exito
						throw new Exception('Exito');
					} else {
						//se envia un mensaje de error
						throw new Exception('No se pudo agregar la profesion al docente');
					}
				} else {
					throw new Exception('No se encontro el docente');
				}
			} else {
				//se envia mensaje de error
				throw new Exception('Seleccione una profesion');
			}
			break;
		//en el caso que la accion sea de crear una nueva categoria
		case 'update':
			//si se setea con exito el nombre de la categoria
			if ($intermediaDocenteProfesion->setCodiInteDoceProf($_POST['codiInteDoceProfUpda'])) {
				if ($intermediaDocenteProfesion->setCodiAcre($_POST['codiProfUpda'])) {
					if ($intermediaDocenteProfesion->setCodiDoce($_POST['codiDoceUpda'])) {
						//creando nueva categoria
						if ($intermediaDocenteProfesion->updateIntermediaDocenteProfesion()) {
							//se envia un mensaje de exito
							throw new Exception('Exito');
						} else {
							//se envia un mensaje de error
							throw new Exception('No se pudo modificar la profesion');
						}
					} else {
						throw new Exception('No se encontro el docente');
					}
				} else {
					//se envia mensaje de error
					throw new Exception('Seleccione la profesion');
				}
			} else {
				throw new Exception('Error');
			}
			break;
		//en el caso que la accion sea de crear una nueva categoria
		case 'delete':
			//si se setea con exito el nombre de la categoria
			if ($intermediaDocenteProfesion->setCodiInteDoceProf($_POST['codiInteDoceProfDele'])) {
				//creando nueva categoria
				if ($intermediaDocenteProfesion->deleteIntermediaDocenteProfesion()) {
					//se envia un mensaje de exito
					throw new Exception('Exito');
				} else {
					//se envia un mensaje de error
					throw new Exception('No se pudo eliminar la profesion');
				}
			} else {
				//se envia mensaje de error
				throw new Exception('No se encontro el docente');
			}
			break;
		}
	}

} catch (Exception $error) {
	//enviando el mensaje ya sea de exito o de error en json
	echo json_encode($error->getMessage());
}
