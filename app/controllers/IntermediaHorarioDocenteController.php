<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/IntermediaHorarioDocente.php';
session_start();
try {
	//inicializando la clase de categoria
	$intermediaHorarioDocente = new IntermediaHorarioDocente;
	//si el post es para una de las acciones del crud
	if (isset($_POST['accion'])) {
		//Validando las fotos del formulario
		$_POST = $intermediaHorarioDocente->validateForm($_POST);
		//switch para verificar que accion es la que se va a realizar
		switch ($_POST['accion']) {
		//en el caso que la accion sea de crear una nueva categoria
		case 'create':
			//si se setea con exito el nombre de la categoria
			if ($intermediaHorarioDocente->setCodiInteCursSalo($_POST['codiInteCursSalo'])) {
				if ($intermediaHorarioDocente->setCodiHora($_POST['codiHora'])) {
					if ($intermediaHorarioDocente->setCodiDoce($_POST['codiDoce'])) {
						$curso = $intermediaHorarioDocente->obtenerCodigoCurso();
						if ($intermediaHorarioDocente->verificarExistenciaHorario($curso['codi_curs'], $_POST['codiSalo'])['cant'] == 0) {
							$curso2 = $intermediaHorarioDocente->obtenerCodigoCurso();
							if ($intermediaHorarioDocente->verificarExistenciaHorarioDocente($curso2['codi_curs'])) {
								if ($intermediaHorarioDocente->createIntermediaHorarioDocente()) {
									throw new Exception("Exito");
								} else {
									$intermediaHorarioDocente->eliminarHorarioCompleto();
									throw new Exception("No se pudo agregar el horario");
								}
							} else {
								$intermediaHorarioDocente->eliminarHorarioCompleto();
								throw new Exception("Al parecer el maestro seleccionado ya esta ocupado en este horario");
							}

						} else {
							$intermediaHorarioDocente->eliminarHorarioCompleto();
							throw new Exception("Al parecer ya hay un curso utilizando ese horario en ese dia");
						}
					} else {
						throw new Exception("Debe seleccionar el docente");
					}
				} else {
					//se envia mensaje de error
					throw new Exception('Debe seleccionar el horario');
				}
			} else {
				throw new Exception('No se pudo');
			}

			break;
		//en el caso que la accion sea de crear una nueva categoria
		case 'createN':
			//si se setea con exito el nombre de la categoria
			if ($intermediaHorarioDocente->setCodiInteCursSalo($_POST['codiInteCursSaloN'])) {
				if ($intermediaHorarioDocente->setCodiHora($_POST['codiHoraN'])) {
					if ($intermediaHorarioDocente->setCodiDoce($_POST['codiDoceN'])) {
						$curso = $intermediaHorarioDocente->obtenerCodigoCurso();
						if ($intermediaHorarioDocente->verificarExistenciaHorario($curso['codi_curs'], $_POST['codiSaloN'])['cant'] == 0) {
							$curso2 = $intermediaHorarioDocente->obtenerCodigoCurso();
							if ($intermediaHorarioDocente->verificarExistenciaHorarioDocente($curso2['codi_curs'])['cant'] == 0) {
								if ($intermediaHorarioDocente->createIntermediaHorarioDocente()) {
									throw new Exception("Exito");
								} else {
									$intermediaHorarioDocente->eliminarHorarioCompleto();
									throw new Exception("No se pudo agregar el horario");
								}
							} else {
								$intermediaHorarioDocente->eliminarHorarioCompleto();
								throw new Exception("Al parecer el maestro seleccionado ya esta ocupado en este horario");
							}

						} else {
							$intermediaHorarioDocente->eliminarHorarioCompleto();
							throw new Exception("Al parecer ya hay un curso utilizando ese horario en ese dia");
						}
					} else {
						throw new Exception("Debe seleccionar el docente");
					}
				} else {
					//se envia mensaje de error
					throw new Exception('Debe seleccionar el horario');
				}
			} else {
				throw new Exception('No se pudo');
			}
			break;
		//en el caso de que la accion sea de modificar la categoria
		case 'update':
			//si se setea con exito el codigo del registro
			if ($intermediaHorarioDocente->setCodiInteCursSalo($_POST['codiInteCursSaloUpda'])) {
				if (isset($_POST['codiHoraUpda'])) {
					if ($intermediaHorarioDocente->setCodiHora($_POST['codiHoraUpda'])) {
						if ($intermediaHorarioDocente->setCodiDoce($_POST['codiDoceUpda'])) {
							if ($intermediaHorarioDocente->updateIntermediaHorarioDocente()) {
								throw new Exception("Exito");
							} else {
								throw new Exception("No se pudo modificar el horario de curso");
							}
						} else {
							throw new Exception("Debe seleccionar un docente");
						}
					} else {
						//se envia mensaje de error
						throw new Exception('No se pudo encontrar el horario');
					}
				} else {
					throw new Exception('Debe seleccionar un horario');
				}

			} else {
				//se envia mensaje de error
				throw new Exception('Debe ingresar el salon');
			}
			break;
		}
	}

} catch (Exception $error) {
	//enviando el mensaje ya sea de exito o de error en json
	echo json_encode($error->getMessage());
}
