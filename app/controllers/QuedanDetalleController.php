<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/QuedanDetalle.php';
date_default_timezone_set("America/El_Salvador");
session_start();
require '../../config/enviandoMail.php';
try {
	//inicializando la clase de categoria
	$quedanD = new QuedanDetalle;
	//si el post es para la datatable del crud de categoria
	if (isset($_POST['quedanDetalle'])) {
		//se obtiene la lista en array asociativo con formato json
		$data = $quedanD->getQuedanDetalle();
		//se imprime la lista
		echo $data;
	}
	//si el post es para una de las acciones del crud
	if (isset($_POST['accion'])) {
		//Validando los datos del formulario
		$_POST = $quedanD->validateForm($_POST);
		//switch para verificar que accion es la que se va a realizar
		switch ($_POST['accion']) {
		case 'monto':
			if ($quedanD->setCodiQued($_POST['codiQued'])) {
				$data = $quedanD->getMontoQuedan();
				echo json_encode($data['mont']);
			} else {
				echo json_encode(null);
			}
			break;
		case 'create':
			if ($quedanD->setCodiQued($_POST['codiQued'])) {
				if ($quedanD->setCodiFact($_POST['codiFact'])) {
					$cantidad = $quedanD->getCantidadDeQuedanRestantes();
					if ($cantidad['cant'] > 0) {
						if ($quedanD->updateEstadoQuedan()) {
							if ($quedanD->updateFactura(2)) {
								if ($quedanD->addQuedanDetalle()) {
									throw new Exception('Exito');
								} else {
									throw new Exception('No se pudo agregarla factura');
								}
							} else {
								throw new Exception('No se pudo modificar la factura');
							}
						} else {
							throw new Exception('No se pudo modificar el quedan');
						}
					} else {
						throw new Exception('Limite');
					}

				} else {
					throw new Exception('Debe de seleccionar una factura');
				}
			} else {
				throw new Exception('No se encontro el quedan');
			}
			break;
		case 'agregandoQuedan':
			if ($quedanD->setCodiQued($_POST['codiQuedNoti'])) {
				$admin = $quedanD->obtenerCorreoEmisor($_SESSION['codi_usua']);
			$datas = $quedanD->obtenerInfoCasaQuedan();
			foreach ($datas as $row) {
				$nombreReceptor = $row['nomb_usua']." ".$row['apel_usua'];
				enviandoCorreoQuedan($_SESSION['nomb_usua'], $admin['corre_usua'],$_SESSION['nomb_casa'], $nombreReceptor, $row['corre_usua'],$row['nume_qued'],$row['nume_fact']);
			}
			throw new Exception("Exito");
			} else {
				throw new Exception("No se encontro el quedan");
			}
			
			break;
		case 'delete':

			break;
		case 'update':

			break;
		}
	}
} catch (Exception $error) {
	//enviando el mensaje ya sea de exito o de error en json
	echo json_encode($error->getMessage());
}
