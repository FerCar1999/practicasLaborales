<?php
$title = "Usuarios";
$page = "Usuarios";
?>
<?php include APP_PATH . '/views/templates/head.view.php' ?>

<?php include APP_PATH . '/views/templates/sidebar.view.php' ?>

<main>
    <div class="container-fluid">
        <div class="row col-sm-12">
            <div class="card box-shadow-md mt-none">
                <div class="card-content">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <span class="card-title">Registro de Usuarios</span>
                        </div>
                    </div>
                    <table id="table-usuario" class="responsive-table hover no-wrap row-border striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Correo</th>
                                <th>codiTipoUsua</th>
                                <th>Tipo de usuario</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Agregar registro -->
    <div class="fixed-action-btn">
        <button class="btn modal-trigger waves-effect waves-circle waves-light btn-floating btn-large blue darken-2" data-target="addUsuario">
            <i class="large material-icons">add</i>
        </button>
    </div>

    <!-- Modal para agregar usuario -->
    <?php include APP_PATH . '/views/usuario/addUsuario.view.php' ?>
    <!-- Modal para modificar usuario -->
    <?php include APP_PATH . '/views/usuario/updateUsuario.view.php' ?>
    <!-- Modal para eliminar usuario -->
    <?php include APP_PATH . '/views/usuario/deleteUsuario.view.php' ?>
</main>
<script src="<?= WEB_PATH ?>js/AJAX/usuario.js"></script>
<?php include APP_PATH . '/views/templates/footer.view.php' ?>