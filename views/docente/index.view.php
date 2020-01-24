<?php
//Titulo de pagina
$title = "Docentes";
//Nombre de pagina
$page = "Docentes";
//Nav activo
$active = "docentes";
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
                            <span class="card-title">Registro de Docentes</span>
                        </div>
                        <div class="col-md-6 right"><a id="helperx" class="waves-effect waves-green btn-flat btn-small" href="../web/manuales/docente.pdf" target="_blank"><i class="material-icons">help</i></a></div>
                    </div>
                    <table id="table-docente" class="responsive-table hover no-wrap row-border striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>DUI</th>
                                <th>codil</th>
                                <th>codi_prof</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Boton para activar modal para agregar registro -->
    <div class="fixed-action-btn">
        <button class="btn modal-trigger waves-effect waves-circle waves-light btn-floating btn-large blue darken-2" data-target="addDocente">
            <i class="large material-icons">add</i>
        </button>
        <button class="btn modal-trigger waves-effect waves-circle waves-light btn-floating btn-large red darken-1" data-target="reporteDocente">
            <i class="large material-icons">picture_as_pdf</i>
        </button>
    </div>

    <!-- Modal para agregar categoria -->
    <?php include APP_PATH . '/views/docente/addDocente.view.php' ?>
    <!-- Modal para modificar categoria -->
    <?php include APP_PATH . '/views/docente/updateDocente.view.php' ?>
    <!-- Modal para eliminar categoria -->
    <?php include APP_PATH . '/views/docente/deleteDocente.view.php' ?>

    <?php include APP_PATH . '/views/docente/reporte.view.php' ?>
</main>

<!-- AJAX -->
<script src="<?= WEB_PATH ?>js/AJAX/docente.js"></script>

<?php include APP_PATH . '/views/templates/footer.view.php' ?>