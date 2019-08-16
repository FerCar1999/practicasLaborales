<?php 
session_start();
if (isset($_SESSION['codi_usua'])) {
    header('Location: dashboard/index');
} else {
    header('Location: dashboard/login');
}

 ?>