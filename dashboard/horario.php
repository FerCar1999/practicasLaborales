<?php
//Llamando archivo app
require_once '../config/app.php';
//Llamando archivo de vista de categoria
require_once APP_PATH . '/views/horario/index.view.php';
if (isset($_SESSION['codi_usua'])) {
} else {
	header('Location: dashboard/login');
}
