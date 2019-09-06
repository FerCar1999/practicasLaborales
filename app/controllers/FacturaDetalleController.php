<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/FacturaDetalle.php';
date_default_timezone_set("America/El_Salvador");
session_start();
try {
	//inicializando la clase de categoria
	$facturaD = new FacturaDetalle;
	//si el post es para la datatable del crud de categoria
	if (isset($_POST['cursosFa'])) {
		//se obtiene la lista en array asociativo con formato json
		$data = null;
		if ($facturaD->setCodiFact($_POST['codiFact'])) {
			$data = $facturaD->obtenerCursosDeFactura();
		}
		//se imprime la lista
		echo json_encode($data);
	}
	//si el post es para una de las acciones del crud
	if (isset($_POST['accion'])) {
		//Validando los datos del formulario
		$_POST = $facturaD->validateForm($_POST);
		//switch para verificar que accion es la que se va a realizar
		switch ($_POST['accion']) {
			case 'create':
				if ($facturaD->setCodiFact($_POST['codiFact'])) {
					if ($facturaD->setCodiCurs($_POST['codiCurs'])) {
						if ($facturaD->cambiandoEstadoDeLaFactura(1)) {
							if ($facturaD->addFacturaDetalle()) {
								if ($facturaD->modificarEstadoCurso()) {
									throw new Exception('Exito');
								} else {
									throw new Exception('No se pudo modificar el estado del curso');
								}
							} else {
								throw new Exception('No se pudo agregar el curso a la factura');
							}
						} else {
							throw new Exception('No se pudo cambiar el estado de la factura');
						}
					} else {
						throw new Exception('Debe seleccionar un curso para agregarlo');
					}
				} else {
					throw new Exception('No se encontro la factura');
				}
				break;
			case 'createFactInforme':
				if ($facturaD->setCodiFact($_POST['codiFact'])) {
					if ($facturaD->setCodiCurs($_POST['codiCurs'])) {
						$fecha = date("Y-m-d");
						if ($facturaD->cambiandoEstadoDelCurso($fecha)) {
							if ($facturaD->addFacturaDetalle()) {
								throw new Exception('Exito');
							} else {
								throw new Exception('No se pudo agregar el curso a la factura');
							}
						}
					} else {
						throw new Exception('Debe seleccionar un curso para agregarlo');
					}
				} else {
					throw new Exception('No se encontro la factura');
				}
				break;
		}
	}
} catch (Exception $error) {
	//enviando el mensaje ya sea de exito o de error en json
	echo json_encode($error->getMessage());
}
