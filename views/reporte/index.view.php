<?php
//Titulo de pagina
$title = "Reportes";
//Nombre de pagina
$page = "Reportes";
?>
<?php
//llamando el archivo head
include APP_PATH . '/views/templates/head.view.php' ?>

<?php
//llamando al archivo sidebar que es el que trae las diferentes opciones para los usuarios y controla el tiempo de sesion
include APP_PATH . '/views/templates/sidebar.view.php' ?>

<main>
    <div class="container-fluid">
        <div class="row col-sm-12">
            <div class="card box-shadow-md mt-none">
                <div class="card-content">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 center">
                            <span class="card-title">Reportes</span>
                        </div>
                        <br>
                        <div class="col s12 m12">
                            <div class="row center-align">
                                <div class="col s12 m6 l6 xl4">
                                    <div class="card-panel blue">
                                        <a class="btn modal-trigger waves-effect waves-light btn-large grey-text text-darken-2 white" data-target="reporteCurso"><i class="material-icons left">event</i>Cursos</a>
                                    </div>
                                </div>
                                <div class="col s12 m6 l6 xl4">
                                    <div class="card-panel blue">
                                        <a class="btn modal-trigger waves-effect waves-light btn-large grey-text text-darken-2 white" data-target="reporteContacto"><i class="material-icons left">perm_contact_calendar</i>Contactos</a>
                                    </div>
                                </div>
                                <div class="col s12 m6 l6 xl4">
                                    <div class="card-panel blue">
                                        <a class="btn modal-trigger waves-effect waves-light btn-large grey-text text-darken-2 white" data-target="reporteEvento"><i class="material-icons left">event</i>Evento</a>
                                    </div>
                                </div>
                                <div class="col s12 m6 l6 xl4">
                                    <div class="card-panel blue">
                                        <a class="btn modal-trigger waves-effect waves-light btn-large grey-text text-darken-2 white" data-target="reporteFactura"><i class="material-icons left">monetization_on</i>Factura</a>
                                    </div>
                                </div>
                                <div class="col s12 m6 l6 xl4">
                                    <div class="card-panel blue">
                                        <a class="btn modal-trigger waves-effect waves-light btn-large grey-text text-darken-2 white" data-target="reporteQuedan"><i class="material-icons left">monetization_on</i>Quedan</a>
                                    </div>
                                </div>
                                <div class="col s12 m6 l6 xl4">
                                    <div class="card-panel blue">
                                        <a class="btn modal-trigger waves-effect waves-light btn-large grey-text text-darken-2 white" data-target="reporteDocente"><i class="material-icons left">people</i>Docente</a>
                                    </div>
                                </div>
                                <div class="col m3 l3 xl4">
                                </div>
                                <div class="col s12 m6 l6 xl4">
                                    <div class="card-panel blue">
                                        <a class="btn modal-trigger waves-effect waves-light btn-large grey-text text-darken-2 white" data-target="reporteSalon"><i class="material-icons left">list</i>Salones</a>
                                    </div>
                                </div>
                                <div class="col m3 l3 xl4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include APP_PATH . '/views/salon/reporte.view.php' ?>
    <?php include APP_PATH . '/views/contacto/reporteContacto.view.php' ?>
    <?php include APP_PATH . '/views/docente/reporte.view.php' ?>
    <?php include APP_PATH . '/views/evento/reporte.view.php' ?>
    <?php include APP_PATH . '/views/factura/reporte.view.php' ?>
    <?php include APP_PATH . '/views/quedan/reporte.view.php' ?>
    <?php include APP_PATH . '/views/curso/reporte.view.php' ?>
</main>

<!-- AJAX -->
<script src="<?= WEB_PATH ?>js/AJAX/reporte.js"></script>

<?php include APP_PATH . '/views/templates/footer.view.php' ?>