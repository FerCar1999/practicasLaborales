<?php
$title = "Inicio";
$page = "Inicio";
?>
<?php include APP_PATH . '/views/templates/head.view.php' ?>
<?php include APP_PATH . '/views/templates/sidebar.view.php' ?>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="card box-shadow-md mt-none">
                <div class="card-content">
                    <div class="row">
                        <span class="card-title">Dashboard</span>
                    </div>
                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header">
                                <i class="material-icons">filter_drama</i>
                                Cursos a punto de finalizar
                                <span data-badge-caption="Pendientes" id="cantidadCursos" name="cantidadCursos" class="new badge red"></span>
                            </div>
                            <div class="collapsible-body">
                                <div class="collection" id="cursosPendientes" name="cursosPendientes">
                                    
                                </div>
                            </div>
                        </li>
                    </ul>
                    
                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header">
                                <i class="material-icons">filter_drama</i>
                                Cursos a finalizados pendientes de informe
                                <span data-badge-caption="Pendientes" id="cantidadCursosInforme" name="cantidadCursosInforme" class="new badge red"></span>
                            </div>
                            <div class="collapsible-body">
                                <div class="collection" id="cursosPendientesInforme" name="cursosPendientesInforme">
                                    
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header">
                                <i class="material-icons">filter_drama</i>
                                Cursos Pendientes de Factura
                                <span data-badge-caption="Pendientes" id="pendientesFactura" name="pendientesFactura" class="new badge red"></span>
                            </div>
                            <div class="collapsible-body">
                                <div class="collection" id="cursosPendientesFactura" name="cursosPendientesFactura">
                                    
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header">
                                <i class="material-icons">filter_drama</i>
                                Otras Notificaciones
                                <span data-badge-caption="Nuevas" id="notififcacionesPendientes" name="notififcacionesPendientes" class="new badge blue">4</span>
                            </div>
                            <div class="collapsible-body">
                                <div class="collection" id="todasNotificaciones" name="todasNotificaciones">
                                    <a href="#!" class="collection-item">Alvin</a>
                                    <a href="#!" class="collection-item active">Alvin</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- SCRIPTS -->
<script src="<?= WEB_PATH ?>js/AJAX/dashboard.js"></script>
<?php include APP_PATH . '/views/curso/informeAgregado.view.php' ?>
<?php include APP_PATH . '/views/templates/footer.view.php' ?>