<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/Docente.php';
session_start();
try {
	//inicializando la clase de categoria
	$docente = new Docente;
	if (isset($_POST['lista'])) {
		//se obtiene la lista sin array asociativo
		$data = null;
		$data = $docente->obtenerListaMaestros($_POST['codiCurs']);
		//imprimiendo la lista en tipo json
		echo json_encode($data);
	}
	//si el post es para llenar campos que no tienen que ver en el crud de categoria
	if (isset($_POST['type'])) {
		//se obtiene la lista sin array asociativo
		$data = null;
		if ($docente->setCodiCasa($_SESSION['codi_casa'])) {
			$data = $docente->getDocentesN();
		}
		//imprimiendo la lista en tipo json
		echo json_encode($data);
	}
	//si el post es para la datatable del crud de categoria
	if (isset($_POST['tabla'])) {
		$data = null;
		if ($docente->setCodiCasa($_SESSION['codi_casa'])) {
			$data = $docente->getDocentes();
		}
		//se imprime la lista
		echo $data;
	}
	//si el post es para una de las acciones del crud
	if (isset($_POST['accion'])) {
		//Validando las fotos del formulario
		$_POST = $docente->validateForm($_POST);
		//switch para verificar que accion es la que se va a realizar
		switch ($_POST['accion']) {
				//en el caso que la accion sea de crear una nueva categoria
			case 'create':
				//si se setea con exito el nombre de la categoria
				if ($docente->setNombDoce($_POST['nombDoce'])) {
					if ($docente->setApelDoce($_POST['apelDoce'])) {
						if ($docente->setDuiDoce($_POST['duiDoce'])) {
							$dui= $docente->verificarExistenciaDui();
							if ($dui['cantidad']==0) {
								if ($docente->setCodiCasa($_SESSION['codi_casa'])) {
									if ($docente->createDocente()) {
										throw new Exception(Database::getLastRowId());
									} else {
										throw new Exception("No se pudo agregar el docente");
									}
								} else {
									throw new Exception("No se encontro la casa");
								}
							} else {
								# code...
							}
							
						} else {
							throw new Exception('Ingrese un DUI correcto');
						}
					} else {
						throw new Exception("Verifique los apellidos del docente");
					}
				} else {
					//se envia mensaje de error
					throw new Exception('Verifique los nombres del docente');
				}
				break;
				//en el caso de que la accion sea de modificar la categoria
			case 'update':
				//si se setea con exito el codigo del registro
				if ($docente->setCodiDoce($_POST['codiDoceUpda'])) {
					if ($docente->setNombDoce($_POST['nombDoceUpda'])) {
						if ($docente->setApelDoce($_POST['apelDoceUpda'])) {
							if ($docente->setDuiDoce($_POST['duiDoceUpda'])) {
								if ($docente->setCodiCasa($_SESSION['codi_casa'])) {
									if ($docente->updateDocente()) {
										throw new Exception("Exito");
									} else {
										throw new Exception("No se pudo agregar el docente");
									}
								} else {
									throw new Exception("No se encontro la casa");
								}
							} else {
								throw new Exception("Debe agregar un dui correcto");
							}
						} else {
							throw new Exception("Verifique los apellidos del docente");
						}
					} else {
						//se envia mensaje de error
						throw new Exception('Verifique los nombres del docente');
					}
				} else {
					//se envia mensaje de error
					throw new Exception('No se encontro el docente');
				}
				break;
			case 'delete':
				//si se setea con exito el codigo del registro
				if ($docente->setCodiDoce($_POST['codiDoceDele'])) {
					if ($docente->deleteDocente()) {
						throw new Exception("Exito");
					} else {
						throw new Exception("No se pudo eliminar el docente");
					}
				} else {
					//se envia mensaje de error
					throw new Exception('No se encontro el docente');
				}
				break;
			case 'reporte':
				if ($docente->setCodiDoce($_POST['codiDoceRepo'])) {
					$data = $docente->reporteDocenteEspecifico($_POST['fechInicRepo'], $_POST['fechFinaRepo']);
					echo json_encode($data);
				} else {
					throw new Exception("No se encontro el salon");
				}
				break;
			case 'reporteCompleto':
				$data = $docente->reporteDocenteCompleto($_POST['fechInicRepo'], $_POST['fechFinaRepo']);
				echo json_encode($data);
				break;
		}
	}
} catch (Exception $error) {
	//enviando el mensaje ya sea de exito o de error en json
	echo json_encode($error->getMessage());
}
