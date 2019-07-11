<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/IntermediaAcreditacionDocente.php';

try {
	//inicializando la clase de categoria
	$intermediaAcreditacionDocente = new IntermediaAcreditacionDocente;
	//si el post es para llenar campos que no tienen que ver en el crud de categoria
	if (isset($_POST['type'])) {
		//se obtiene la lista sin array asociativo
		$data = $intermediaAcreditacionDocente->getIntermediaAcreditacionDocenteN();
		//imprimiendo la lista en tipo json
		echo json_encode($data);
	}
	//si el post es para una de las acciones del crud
	if (isset($_POST['accion'])) {
		//Validando las fotos del formulario
		$_POST = $intermediaAcreditacionDocente->validateForm($_POST);
		//switch para verificar que accion es la que se va a realizar
		switch ($_POST['accion']) {
		//en el caso que la accion sea de crear una nueva categoria
		case 'create':
			//si se setea con exito el nombre de la categoria
			if ($intermediaAcreditacionDocente->setCodiAcre($_POST['codiAcre'])) {
				if ($intermediaAcreditacionDocente->setCodiDoce($_POST['codiDoce'])) {
					//creando nueva categoria
					if ($intermediaAcreditacionDocente->createIntermediaAcreditacionDocente()) {
						//se envia un mensaje de exito
						throw new Exception('Exito');
					} else {
						//se envia un mensaje de error
						throw new Exception('No se pudo agregar la nueva categoria');
					}
				} else {
					throw new Exception('Seleccione una acreditacion');
				}
			} else {
				//se envia mensaje de error
				throw new Exception('No se encontro el docente');
			}
			break;
		//en el caso que la accion sea de crear una nueva categoria
		case 'update':
			//si se setea con exito el nombre de la categoria
			if ($intermediaAcreditacionDocente->setCodiInteAcreDoce($_POST['codiInteAcreDoceUpda'])) {
				if ($intermediaAcreditacionDocente->setCodiAcre($_POST['codiAcreUpda'])) {
					if ($intermediaAcreditacionDocente->setCodiDoce($_POST['codiDoceUpda'])) {
						//creando nueva categoria
						if ($intermediaAcreditacionDocente->updateIntermediaAcreditacionDocente()) {
							//se envia un mensaje de exito
							throw new Exception('Exito');
						} else {
							//se envia un mensaje de error
							throw new Exception('No se pudo modificar la acreditacion');
						}
					} else {
						throw new Exception('Seleccione una acreditacion');
					}
				} else {
					//se envia mensaje de error
					throw new Exception('No se encontro el docente');
				}
			} else {
				throw new Exception('Error');
			}
			break;
		//en el caso que la accion sea de crear una nueva categoria
		case 'delete':
			//si se setea con exito el nombre de la categoria
			if ($intermediaAcreditacionDocente->setCodiInteAcreDoce($_POST['codiInteAcreDoceDele'])) {
				//creando nueva categoria
				if ($intermediaAcreditacionDocente->deleteIntermediaAcreditacionDocente()) {
					//se envia un mensaje de exito
					throw new Exception('Exito');
				} else {
					//se envia un mensaje de error
					throw new Exception('No se pudo eliminar la acreditacion');
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
