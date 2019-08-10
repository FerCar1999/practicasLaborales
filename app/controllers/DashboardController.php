<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/Notificacion.php';
date_default_timezone_set("America/El_Salvador");
session_start();
require '../../config/enviandoMail.php';
try {
	//inicializando la clase de categoria
	$notificacion = new Notificacion;
	//si el post es para llenar campos que no tienen que ver en el crud de categoria
	if (isset($_POST['alerta'])) {
		$data = null;
		//Obteniendo ID de usuario ADMINSITRADOR de la casa
		if ($notificacion->setCodiCasa($_SESSION['codi_casa'])) {
			$datas = $notificacion->obtenerInfoUsuariosCasa();
			foreach ($datas as $row) {
				$nombreReceptor = $row['nomb_usua']." ".$row['apel_usua'];
				enviandoCorreoAlerta("Alertas de Sitio", "alertas@administracion.com", $nombreReceptor, $row['corre_usua'],$_POST['identificador'],$_POST['nume']);
			}
			throw new Exception('Exito');
		}
	}
	if (isset($_POST['alertaFact'])) {
		$data = null;
		//Obteniendo ID de usuario ADMINSITRADOR de la casa
		if ($notificacion->setCodiCasa($_SESSION['codi_casa'])) {
			$datas = $notificacion->obtenerInfoUsuariosCasa();
			foreach ($datas as $row) {
				$nombreReceptor = $row['nomb_usua']." ".$row['apel_usua'];
				enviandoCorreoAlerta("Alertas de Sitio", "alertas@administracion.com", $nombreReceptor, $row['corre_usua'],$_POST['identificador'],$_POST['nume']);
			}
			throw new Exception('Exito');
		}
	}
	if (isset($_POST['alertaAprov'])) {
		$data = null;
		//Obteniendo ID de usuario ADMINSITRADOR de la casa
		if ($notificacion->setCodiCasa($_SESSION['codi_casa'])) {
			$id = $notificacion->obtenerIdAdministradorCasa();
				$nombreReceptor = $id['nomb_usua']." ".$id['apel_usua'];
				enviandoCorreoAlerta("Alertas de Sitio", "alertas@administracion.com", $nombreReceptor, $id['corre_usua'],$_POST['identificador'],$_POST['nume']);
			throw new Exception('Exito');
		}
	}
	if (isset($_POST['deleteQuedan'])) {
		$data = null;
		//Obteniendo ID de usuario ADMINSITRADOR de la casa
		if ($notificacion->setCodiCasa($_SESSION['codi_casa'])) {
			$id = $notificacion->obtenerIdAdministradorCasa();
			$correoEmisor = $notificacion->obtenerCorreoEmisor($_SESSION['codi_usua']);
			$nombreEmisor = $id['nomb_usua']." ".$id['apel_usua'];
			if (enviandoCorreoPeticion($_SESSION['nomb_usua'],$correoEmisor['corre_usua'], $nombreEmisor, $id['corre_usua'], $_POST['numeQuedDeleNoti'], 2)) {
				throw new Exception('Exito');
			} else {
				throw new Exception("Error al enviar el correo");
			}
		}
	}
	if (isset($_POST['deleteFactura'])) {
		$data = null;
		//Obteniendo ID de usuario ADMINSITRADOR de la casa
		if ($notificacion->setCodiCasa($_SESSION['codi_casa'])) {
			$id = $notificacion->obtenerIdAdministradorCasa();
			$correoEmisor = $notificacion->obtenerCorreoEmisor($_SESSION['codi_usua']);
			$nombreEmisor = $id['nomb_usua']." ".$id['apel_usua'];
			if (enviandoCorreoPeticion($_SESSION['nomb_usua'], $correoEmisor['corre_usua'], $nombreEmisor, $id['corre_usua'], $_POST['numeFactDeleNoti'], 1)) {
				throw new Exception('Exito');
			} else {
				throw new Exception('Exito');
			}
		}
	}
	if (isset($_POST['dashboard'])) {
		//se obtiene la lista sin array asociativo
		$data = null;
		if ($notificacion->setCodiCasa($_SESSION['codi_casa'])) {
			$data = $notificacion->getCursosFinalizarPronto(date("Y-m-d"));
		}
		//imprimiendo la lista en tipo json
		echo json_encode($data);
	}
	if (isset($_POST['informe'])) {
		//se obtiene la lista sin array asociativo
		$data = null;
		if ($notificacion->setCodiCasa($_SESSION['codi_casa'])) {
			if ($_SESSION['codi_cate']!=0) {
				$data = $notificacion->getCursosFinalizadosInformeEncargado(date('Y-m-d'),$_SESSION['codi_cate']);
			}else{
				$data = $notificacion->getCursosFinalizadosInforme(date('Y-m-d'));
			}
		}
		//imprimiendo la lista en tipo json
		echo json_encode($data);
	}
	if (isset($_POST['informeAprov'])) {
		//se obtiene la lista sin array asociativo
		$data = null;
		if ($notificacion->setCodiCasa($_SESSION['codi_casa'])) {
			$data = $notificacion->getCursosFinalizadosInformeAprovacion(date('Y-m-d'));
		}
		//imprimiendo la lista en tipo json
		echo json_encode($data);
	}
	if (isset($_POST['factura'])) {
		//se obtiene la lista sin array asociativo
		$data = null;
		if ($notificacion->setCodiCasa($_SESSION['codi_casa'])) {
			$data = $notificacion->getCursosPendientesFactura(date('Y-m-d'));
		}
		//imprimiendo la lista en tipo json
		echo json_encode($data);
	}
	if (isset($_POST['quedan'])) {
		//se obtiene la lista sin array asociativo
		$data = null;
		if ($notificacion->setCodiCasa($_SESSION['codi_casa'])) {
			$data = $notificacion->getFacturasPendientesDeQuedan(date('Y-m-d'));
		}
		//imprimiendo la lista en tipo json
		echo json_encode($data);
	}
	if (isset($_POST['notificaciones'])) {
		//se obtiene la lista sin array asociativo
		$data = null;
		if ($notificacion->setCodiCasa($_SESSION['codi_casa'])) {
			$data = $notificacion->getOtrasNotificaciones();
		}
		//imprimiendo la lista en tipo json
		echo json_encode($data);
	}
	if (isset($_POST['abono'])) {
		//se obtiene la lista sin array asociativo
		$data = null;
		if ($notificacion->setCodiCasa($_SESSION['codi_casa'])) {
			$data = $notificacion->getQuedanPendientesDeAbonar(date('Y-m-d'));
		}
		//imprimiendo la lista en tipo json
		echo json_encode($data);
	}
} catch (Exception $error) {
	//enviando el mensaje ya sea de exito o de error en json
	echo json_encode($error->getMessage());
}
