<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/Factura.php';
date_default_timezone_set("America/El_Salvador");
session_start();
try {
	//inicializando la clase de categoria
	$factura = new Factura;
	//si el post es para la datatable del crud de categoria
	if (isset($_POST['cursosPendientes'])) {
		$data = $factura->getCursosPendientesFactura(date('Y-m-d'), $_SESSION['codi_casa']);
		echo json_encode($data);
	}
	if (isset($_POST['tabla'])) {
		//se obtiene la lista en array asociativo con formato json
		$data = $factura->getListaFacturaPendientesDeQuedan($_SESSION['codi_casa']);
		//se imprime la lista
		echo $data;
	}
	//si el post es para una de las acciones del crud
	if (isset($_POST['accion'])) {
		//Validando los datos del formulario
		$_POST = $factura->validateForm($_POST);
		//switch para verificar que accion es la que se va a realizar
		switch ($_POST['accion']) {
		case 'create':
			if ($factura->setNumeFact($_POST['numeFact'])) {
				if ($factura->setFechEmisFact($_POST['fechEmisFact'])) {
					if ($factura->setFechIngr(date('Y-m-d'))) {
						if ($factura->setCantFact($_POST['cantFact'])) {
							if (is_uploaded_file($_FILES['archFact']['tmp_name'])) {
								if ($factura->setArchFact($_FILES['archFact'])) {
									$id = $factura->addFactura();
									if ($id > 0) {
										throw new Exception($id);
									} else {
										if ($factura->unsetArchFact()) {
											throw new Exception(Database::getException());
										} else {
											throw new Exception("Elimine el archivo manualmente");
										}
									}
								} else {
									throw new Exception($factura->getImageError());
								}
							} else {
								throw new Exception("Seleccione un archivo");
							}
						} else {
							throw new Exception("Debe ingresar la cantidad monetaria de la factura");
						}
					} else {
						throw new Exception("Error al ingresar la fecha");
					}
				} else {
					throw new Exception("Debe agregar una la fecha de emision de la factura");
				}
			} else {
				throw new Exception('Debe ingresar el numero de factura');
			}
			break;
		case 'update':
			if ($factura->setNumeFact($_POST['numeFactUpda'])) {
				if ($factura->setFechEmisFact($_POST['fechEmisFactUpda'])) {
					if ($factura->setCodiFact($_POST['codiFactUpda'])) {
						if ($factura->setCantFact($_POST['cantFactUpda'])) {
							if ($factura->updateFactura()) {
								throw new Exception("Exito");
							} else {
								throw new Exception("No se pudo modificar la factura");
							}
						} else {
							throw new Exception("Debe ingresar la cantidad monetaria de la factura");
						}
					} else {
						throw new Exception("No se encontro la factura");
					}
				} else {
					throw new Exception("Debe agregar una la fecha de emision de la factura");
				}
			} else {
				throw new Exception('Debe ingresar el numero de factura');
			}
			break;
		case 'updateArchivo':
			if ($factura->setCodiFact($_POST['codiFactUpdaA'])) {
				if (is_uploaded_file($_FILES['archFactUpda']['tmp_name'])) {
					if ($factura->setArchFact($_FILES['archFactUpda'])) {
						if ($factura->updateFacturaArchivo()) {
							throw new Exception("Exito");
						} else {
							if ($factura->unsetArchFact()) {
								throw new Exception(Database::getException());
							} else {
								throw new Exception("Elimine el archivo manualmente");
							}
						}
					} else {
						throw new Exception($factura->getImageError());
					}
				} else {
					throw new Exception("Seleccione un archivo");
				}
			} else {
				throw new Exception("No se encontro la factura");
			}

			break;
		case 'delete':
			if ($factura->setCodiFact($_POST['codiFactDele'])) {
				if ($factura->deleteFactura()) {
					$id = $factura->obtenerIdCurso();
					$factura->updateCursosFactura($id['codi_curs']);
					throw new Exception("Exito");
				} else {
					throw new Exception("No se pudo eliminar la factura");
				}
			} else {
				throw new Exception("No se encontro la factura");
			}

			break;
		}
	}
} catch (Exception $error) {
	//enviando el mensaje ya sea de exito o de error en json
	echo json_encode($error->getMessage());
}
