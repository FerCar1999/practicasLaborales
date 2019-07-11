<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/Presupuesto.php';
date_default_timezone_get();
session_start();
try {
	//inicializando la clase de categoria
	$presupuesto = new Presupuesto;
	//si el post es para la datatable del crud de categoria
	if (isset($_POST['tabla'])) {
		//se obtiene la lista en array asociativo con formato json
		$data = $presupuesto->getPresupuestoCasas(date("Y"));
		//se imprime la lista
		echo $data;
	}
	//si el post es para una de las acciones del crud
	if (isset($_POST['accion'])) {
		//Validando los datos del formulario
		$_POST = $presupuesto->validateForm($_POST);
		//switch para verificar que accion es la que se va a realizars
		switch ($_POST['accion']) {
		case 'delete':
			if ($presupuesto->setCodiPres($_POST['codiPresDele'])) {
				if ($presupuesto->obtenerCantidadSubPresupuesto() == 0) {
					if ($presupuesto->deletePresupuesto()) {
						throw new Exception('Exito');
					} else {
						throw new Exception('No se pudo eliminar el presupuesto');
					}
				} else {
					throw new Exception('No se puede eliminar el presupuesto ya que la casa ya lo ha utilizado');
				}
			} else {
				throw new Exception('No se encontro el presupuesto');
			}

			break;
		case 'verficarInfo':
			if ($_SESSION['codi_tipo_casa'] == 1) {
				echo json_encode("casas");
			} else {
				echo json_encode("casa");
			}
			break;
		case 'getCasasRestantes':
			$data = $presupuesto->obtenerCasasSinPresupuesto(date("Y"));
			echo json_encode($data);
			break;
		case 'create':
			if ($presupuesto->setCodiCasa($_POST['codiCasaIngre'])) {
				if ($presupuesto->setCodiUsua($_SESSION['codi_usua'])) {
					if ($presupuesto->setCantPres($_POST['cantPres'])) {
						if ($presupuesto->setFechPres(date('Y-m-d'))) {
							if ($presupuesto->addPresupuesto()) {
								//ENVIAR NOTIFICACION TANTO AL CORREO COMO AL DASHBOARD
								throw new Exception('Exito');
							} else {
								throw new Exception('No se pudo agregar al presupuesto');
							}
						} else {
							throw new Exception('Error con la fecha');
						}
					} else {
						throw new Exception('La cantidad debe ser mayor a 0');
					}
				} else {
					throw new Exception('No se encontro el usuario');
				}
			} else {
				throw new Exception('Debe seleccionar una casa');
			}
			break;
		case 'update':
			if ($presupuesto->setCodiPres($_POST['codiPresUpda'])) {
				if ($presupuesto->setCantPres($_POST['cantPresUpda'])) {
					if ($presupuesto->obtenerCantidadSubPresupuesto() > 0) {
						if ($presupuesto->updatePresupuesto()) {
							throw new Exception('Exito');
						} else {
							throw new Exception('No se pudo modificar presupuesto');
						}
					}else{
						throw new Exception("No se puede modiifcar el presupuesto ya que la casa ya ha hecho cambios en el");
					}
				} else {
					throw new Exception('Debe agregar una cantidad de presupuesto mayor a 0');
				}
			} else {
				throw new Exception('No se encontro la casa');
			}
			break;
		}
	}

} catch (Exception $error) {
	//enviando el mensaje ya sea de exito o de error en json
	echo json_encode($error->getMessage());
}
