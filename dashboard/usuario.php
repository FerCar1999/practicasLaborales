<?php
//Llamando archivo app
require_once '../config/app.php';
//Llamando archivo de vista de categoria
require_once APP_PATH . '/views/usuario/index.view.php';
if (isset($_SESSION['codi_usua'])) {
} else {
	header('Location: dashboard/login');
}
