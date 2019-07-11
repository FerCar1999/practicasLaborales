<?php
//Titulo de pagina
$title = "Profesion";
//Nombre de pagina
$page = "Profesion";
?>
<?php
//llamando el archivo head
include APP_PATH . '/views/templates/head.view.php'?>

<?php
//llamando al archivo sidebar que es el que trae las diferentes opciones para los usuarios y controla el tiempo de sesion
include APP_PATH . '/views/templates/sidebar.view.php'?>

<main>
    <div class="container-fluid">
        <div class="row col-sm-12">
            <div class="card box-shadow-md mt-none">
                <div class="card-content">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 center">
                            <span class="card-title">Registro de Profesiones</span>
                        </div>
                    </div>
                    <table id="table-profesion" class="responsive-table hover no-wrap row-border striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Profesion</th>
                                <th>Estado</th>
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
        <button class="btn modal-trigger waves-effect waves-circle waves-light btn-floating btn-large blue darken-1" data-target="addProfesion">
            <i class="large material-icons">add</i>
        </button>
    </div>

    <!-- Modal para agregar categoria -->
    <?php include APP_PATH . '/views/profesion/addProfesion.view.php'?>
    <!-- Modal para modificar categoria -->
    <?php include APP_PATH . '/views/profesion/updateProfesion.view.php'?>
    <!-- Modal para eliminar categoria -->
    <?php include APP_PATH . '/views/profesion/deleteProfesion.view.php'?>
</main>

<!-- AJAX -->
<script src="<?=WEB_PATH?>js/AJAX/profesion.js"></script>

<?php include APP_PATH . '/views/templates/footer.view.php'?>