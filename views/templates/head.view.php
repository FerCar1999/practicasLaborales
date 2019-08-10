<?php
session_start();
ini_set("date.timezone","America/El_Salvador");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?? '' ?></title>
    <link rel="stylesheet" href="<?= WEB_PATH ?>css/materialize.min.css">
    <link rel="stylesheet" href="<?= WEB_PATH ?>css/mstepper.css">
    <link rel="stylesheet" href="<?= WEB_PATH ?>css/material-icons.css">
    <link rel="stylesheet" href="<?= WEB_PATH ?>css/select2-materialize.css">
    <link rel="stylesheet" href="<?= WEB_PATH ?>css/datatables.css">
    <link rel="stylesheet" href="<?= WEB_PATH ?>css/jquery-confirm.min.css">
    <link rel="stylesheet" href="<?= WEB_PATH ?>css/styles.css">
    <script src="<?= WEB_PATH ?>js/jquery.min.js"></script>
    <script src="<?= WEB_PATH ?>js/materialize.min.js"></script>
    <script src="<?= WEB_PATH ?>js/moment.js"></script>
    <script src="<?= WEB_PATH ?>js/es.js"></script>
    <script src="<?= WEB_PATH ?>js/select2.js"></script>
    <script src="<?= WEB_PATH ?>js/sweetalert2.js"></script>
    <script src="<?= WEB_PATH ?>js/datatables.js"></script>
    <script src="<?= WEB_PATH ?>js/jquery-confirm.min.js"></script>
    <script src="<?= WEB_PATH ?>js/mstepper.js"></script>
    <script src="<?= WEB_PATH ?>js/initialize.js"></script>
    <script src="<?= WEB_PATH ?>js/alertas.js"></script>
</head>
<body>
