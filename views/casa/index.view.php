<?php
//Titulo de pagina
$title = "Casas";
//Nombre de pagina
$page = "Casas";
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
                            <span class="card-title">Registro de Casas Salesianas</span>
                        </div>
                        <div class="col-md-6 right"><a id="helperx" class="waves-effect waves-green btn-flat btn-small" href="../web/manuales/casas.pdf" target="_blank"><i class="material-icons">help</i></a></div>
                    </div>
                    <table id="table-casa" class="responsive-table hover no-wrap row-border striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Logo</th>
                                <th>Nombre</th>
                                <th>Direccion</th>
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
        <button class="btn modal-trigger waves-effect waves-circle waves-light btn-floating btn-large blue darken-2" data-target="addCasa">
            <i class="large material-icons">add</i>
        </button>
    </div>

    <!-- Modal para agregar categoria -->
    <?php include APP_PATH . '/views/casa/addCasa.view.php' ?>
    <!-- Modal para modificar categoria -->
    <?php include APP_PATH . '/views/casa/updateCasa.view.php' ?>
    <!-- Modal para eliminar categoria -->
    <?php include APP_PATH . '/views/casa/deleteCasa.view.php' ?>
</main>

<!-- AJAX -->
<script src="<?= WEB_PATH ?>js/AJAX/casa.js"></script>

<?php include APP_PATH . '/views/templates/footer.view.php' ?>