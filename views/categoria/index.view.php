<?php
//Titulo de pagina
$title = "Categoría";
//Nombre de pagina
$page = "Categoría";
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
                            <span class="card-title">Registro de Categorías</span>
                        </div>
                        <div class="col-md-6 right"><a id="helperx" class="waves-effect waves-green btn-flat btn-small" href="../web/manuales/categorias.pdf" target="_blank"><i class="material-icons">help</i></a></div>
                    </div>
                    <table id="table-categoria" class="responsive-table hover no-wrap row-border striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Diminutivo</th>
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
        <button class="btn modal-trigger waves-effect waves-circle waves-light btn-floating btn-large blue darken-1" data-target="addCategoria">
            <i class="large material-icons">add</i>
        </button>
    </div>

    <!-- Modal para agregar categoria -->
    <?php include APP_PATH . '/views/categoria/addCategoria.view.php' ?>
    <!-- Modal para modificar categoria -->
    <?php include APP_PATH . '/views/categoria/updateCategoria.view.php' ?>
    <!-- Modal para eliminar categoria -->
    <?php include APP_PATH . '/views/categoria/deleteCategoria.view.php' ?>
</main>

<!-- AJAX -->
<script src="<?= WEB_PATH ?>js/AJAX/categoria.js"></script>

<?php include APP_PATH . '/views/templates/footer.view.php' ?>