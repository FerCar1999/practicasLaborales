<?php
//Titulo de pagina
$title = "Contacto";
//Nombre de pagina
$page = "Contacto";
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
                            <span class="card-title">Registro de Contactos</span>
                        </div>
                    </div>
                        <table id="table-contacto" class="responsive-table hover no-wrap row-border striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Id Profesion</th>
                                    <th>Profesion</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Empresa</th>
                                    <th>Cargo</th>
                                    <th>Direccion</th>
                                    <th>Correo</th>
                                    <th>Celular</th>
                                    <th>Telefono</th>
                                    <th>Observacion</th>
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
        <button class="btn modal-trigger waves-effect waves-circle waves-light btn-floating btn-large blue darken-1 tooltipped" data-position="left" data-tooltip="Agregar Contacto" data-target="addContacto">
            <i class="large material-icons">add</i>
        </button>
        <a class="btn modal-trigger waves-effect waves-circle waves-light btn-floating btn-large red darken-1 tooltipped" data-position="left" data-tooltip="Generar Viñetas" data-target="reporteContacto">
            <i class="large material-icons">contact_mail</i>
        </a>
    </div>

    <!-- Modal para agregar categoria -->
    <?php include APP_PATH . '/views/contacto/addContacto.view.php' ?>
    <!-- Modal para modificar categoria -->
    <?php include APP_PATH . '/views/contacto/updateContacto.view.php' ?>
    <!-- Modal para eliminar categoria -->
    <?php include APP_PATH . '/views/contacto/deleteContacto.view.php' ?>
    <?php include APP_PATH . '/views/contacto/reporteContacto.view.php' ?>
</main>

<!-- AJAX -->
<script src="<?= WEB_PATH ?>js/AJAX/contacto.js"></script>

<?php include APP_PATH . '/views/templates/footer.view.php' ?>