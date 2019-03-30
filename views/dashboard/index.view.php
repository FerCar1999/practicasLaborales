<?php
$title = "Inicio";
$page = "Inicio";
$active = "dashboard";
?>
<?php include APP_PATH . '/views/templates/head.view.php' ?>

<?php include APP_PATH . '/views/templates/header.view.php' ?>

<?php include APP_PATH . '/views/templates/sidebar.view.php' ?>

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="card box-shadow-md mt-none">
                <div class="card-content">
                    <div class="row">
                        <span class="card-title">Registro de las citas de hoy</span>
                    </div>
                    <table id="table-quotes" class="responsive hover no-wrap row-border striped w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo de cita</th>
                                <th>Codi Tipo</th>
                                <th>Afiliación del paciente</th>
                                <th>Estado Paci</th>
                                <th>Doctor</th>
                                <th>Estado de cita</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div class="row mt-1">
                        <div class="col s12">
                            <a href="reportCita.php" target="_blank" class="btn blue darken-1"><i class="material-icons left">folder_open</i>Generar Reporte</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- SCRIPTS -->
<script src="<?= WEB_PATH ?>js/quotesDay.js"></script>

<?php include APP_PATH . '/views/templates/footer.view.php' ?>