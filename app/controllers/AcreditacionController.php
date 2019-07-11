<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/Acreditacion.php';

try {
	//inicializando la clase de categoria
	$acreditacion = new Acreditacion;
	//si el post es para llenar campos que no tienen que ver en el crud de categoria
	if (isset($_POST['tabla'])) {
		//se obtiene la lista sin array asociativo
		$data = $acreditacion->getAcreditacion();
		//imprimiendo la lista en tipo json
		echo $data;
	}
	if (isset($_POST['type'])) {
		//se obtiene la lista sin array asociativo
		$data = $acreditacion->getAcreditacionN();
		//imprimiendo la lista en tipo json
		echo json_encode($data);
	}
	//si el post es para una de las acciones del crud
	if (isset($_POST['accion'])) {
		//Validando las fotos del formulario
		$_POST = $acreditacion->validateForm($_POST);
		//switch para verificar que accion es la que se va a realizar
		switch ($_POST['accion']) {
		//en el caso que la accion sea de crear una nueva categoria
		case 'create':
			//si se setea con exito el nombre de la categoria
			if ($acreditacion->setTipoAcre($_POST['nombAcre'])) {
				//creando nueva categoria
				if ($acreditacion->createAcreditacion()) {
					//se envia un mensaje de exito
					throw new Exception('Exito');
				} else {
					//se envia un mensaje de error
					throw new Exception('No se pudo agregar la nueva acreditacion');
				}
			} else {
				//se envia mensaje de error
				throw new Exception('Verifique el nombre de la acreditacion');
			}
			break;
		case 'update':
			if ($acreditacion->setCodiAcre($_POST['codiAcreUpda'])) {
				//si se setea con exito el nombre de la categoria
				if ($acreditacion->setTipoAcre($_POST['nombAcreUpda'])) {
					//creando nueva categoria
					if ($acreditacion->updateAcreditacion()) {
						//se envia un mensaje de exito
						throw new Exception('Exito');
					} else {
						//se envia un mensaje de error
						throw new Exception('No se pudo modificar la nueva acreditacion');
					}
				} else {
					//se envia mensaje de error
					throw new Exception('Verifique el nombre de la acreditacion');
				}
			} else {
				throw new Exception('No se encontro la acreditacion');
			}

			break;
		case 'delete':
			//si se setea con exito el nombre de la categoria
			if ($acreditacion->setCodiAcre($_POST['codiAcreDele'])) {
				//creando nueva categoria
				if ($acreditacion->deleteAcreditacion()) {
					//se envia un mensaje de exito
					throw new Exception('Exito');
				} else {
					//se envia un mensaje de error
					throw new Exception('No se pudo eliminar la nueva acreditacion');
				}
			} else {
				//se envia mensaje de error
				throw new Exception('No se encontro la acreditacion');
			}
			break;
		}
	}
} catch (Exception $error) {
	//enviando el mensaje ya sea de exito o de error en json
	echo json_encode($error->getMessage());
}