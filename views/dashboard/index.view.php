<?php
$title = "Inicio";
$page = "Inicio";
?>
<?php include APP_PATH . '/views/templates/head.view.php'?>
<?php include APP_PATH . '/views/templates/sidebar.view.php'?>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="card box-shadow-md mt-none">
                <div class="card-content">
                    <div class="row">
                        <span class="card-title">Dashboard</span>
                    </div>
                    <ul class="collapsible" id="ulPendienteFinalizar">
                        <li>
                            <div class="collapsible-header">
                                <i class="material-icons">timer</i>
                                Cursos a punto de finalizar
                                <span data-badge-caption="Pendientes" id="cantidadCursos" name="cantidadCursos" class="new badge blue"></span>
                            </div>
                            <div class="collapsible-body">
                                <div class="collection" id="cursosPendientes" name="cursosPendientes">

                                </div>
                            </div>
                        </li>
                    </ul>
<?php
if ($_SESSION['codi_tipo_usua'] == 2 || $_SESSION['codi_tipo_usua'] == 3) {
    if ($_SESSION['codi_cate']==4) {
        print('<ul class="collapsible" id="ulPendienteInformeFactura">
        <li>
            <div class="collapsible-header">
                <i class="material-icons">library_books</i>
                Cursos a finalizados pendientes informe y factura
                <span data-badge-caption="Pendientes" id="cantidadCursosInformeFactura" name="cantidadCursosInformeFactura" class="new badge blue"></span>
            </div>
            <div class="collapsible-body">
                <div class="collection" id="cursosPendientesInformeFactura" name="cursosPendientesInformeFactura">

                </div>
            </div>
        </li>
    </ul>');
    } else {
        print('
                    <ul class="collapsible" id="ulPendienteInforme">
                        <li>
                            <div class="collapsible-header">
                                <i class="material-icons">library_books</i>
                                Cursos a finalizados pendientes informe
                                <span data-badge-caption="Pendientes" id="cantidadCursosInforme" name="cantidadCursosInforme" class="new badge blue"></span>
                            </div>
                            <div class="collapsible-body">
                                <div class="collection" id="cursosPendientesInforme" name="cursosPendientesInforme">

                                </div>
                            </div>
                        </li>
                    </ul>
                    ');
    }
}
?>
<?php
if ($_SESSION['codi_tipo_usua'] == 1) {
	print("
                        <ul class='collapsible' id='ulPendienteAprobacion'>
                            <li>
                                <div class='collapsible-header'>
                                    <i class='material-icons'>list_alt</i>
                                    Cursos pendientes de aprobacion de informe
                                    <span data-badge-caption='Pendiente' id='cantidadCursosInformeAprov' name='cantidadCursosInformeAprov' class='new badge blue'></span>
                                </div>
                                <div class='collapsible-body'>
                                    <div class='collection' id='informesPendientesAprovacion' name='informesPendientesAprovacion'>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        ");
}
?>
<?php
if ($_SESSION['codi_tipo_usua'] == 2) {
	print('
        <ul class="collapsible" id="ulPendienteFactura">
                        <li>
                            <div class="collapsible-header">
                                <i class="material-icons">attach_money</i>
                                Cursos Pendientes de Factura
                                <span data-badge-caption="Pendientes" id="pendientesFactura" name="pendientesFactura" class="new badge blue"></span>
                            </div>
                            <div class="collapsible-body">
                                <div class="collection" id="cursosPendientesFactura" name="cursosPendientesFactura">

                                </div>
                            </div>
                        </li>
                    </ul>
        ');
}
?>
<?php
if ($_SESSION['codi_tipo_usua'] == 2) {
	print("
                        <ul class='collapsible' id='ulPendienteQuedan'>
                        <li>
                            <div class='collapsible-header'>
                                <i class='material-icons'>list_alt</i>
                                Quedan pendientes de abonar
                                <span data-badge-caption='Pendientes' id='pendientesQuedan' name='pendientesQuedan' class='new badge blue'></span>
                            </div>
                            <div class='collapsible-body'>
                                <div class='collection' id='quedanPendientesAbono' name='quedanPendientesAbono'>
                                </div>
                            </div>
                        </li>
                    </ul>
                        ");
}
?>
                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header">
                                <i class="material-icons">notifications</i>
                                Otras Notificaciones
                                <span data-badge-caption="Nuevas" id="notififcacionesPendientes" name="notififcacionesPendientes" class="new badge blue">4</span>
                            </div>
                            <div class="collapsible-body">
                                <div class="collection" id="todasNotificaciones" name="todasNotificaciones">
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
<script src="<?=WEB_PATH?>js/AJAX/dashboard.js"></script>
<?php include APP_PATH . '/views/curso/informeAgregado.view.php'?>
<?php include APP_PATH . '/views/curso/informeAgregadoFactura.view.php'?>
<?php include APP_PATH . '/views/curso/informeAprovacion.view.php'?>
<?php include APP_PATH . '/views/templates/footer.view.php'?>