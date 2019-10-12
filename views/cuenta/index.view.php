<?php
$title = "Cuenta";
$page = "Cuenta";
?>
<?php include APP_PATH . '/views/templates/head.view.php' ?>
<?php include APP_PATH . '/views/templates/sidebar.view.php' ?>
<main>
    <div class="container-fluid">
        <div class="row col-sm-12">
            <div class="card box-shadow-md mt-none">
                <div class="card-content">
                    <div class="card-tabs">
                        <ul class="tabs tabs-fixed-width">
                            <li class="tab">
                                <a class="active" href="#miCuenta">
                                    Mi Cuenta
                                </a>
                            </li>
                            <li class="tab">
                                <a href="#cuentaCasa">
                                    Cuenta de Casa
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-content grey lighten-4">
                        <form autocomplete="off" class="update" id="miCuenta">
                            <div id="miCuenta">
                                <ul class="collapsible popout">
                                    <li>
                                        <div class="collapsible-header">
                                            <i class="material-icons">
                                                filter_drama
                                            </i>
                                            Información Personal
                                        </div>
                                        <div class="collapsible-body">
                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <i class="material-icons prefix">
                                                        account_circle
                                                    </i>
                                                    <input id="nombUsuaUpda" name="nombUsuaUpda" required="" type="text">
                                                        <label for="nombUsuaUpda">
                                                            Ingrese sus nombres:
                                                        </label>
                                                    </input>
                                                </div>
                                                <div class="input-field col s6">
                                                    <i class="material-icons prefix">
                                                        account_circle
                                                    </i>
                                                    <input id="apelUsuaUpda" name="apelUsuaUpda" required="" type="text">
                                                        <label for="apelUsuaUpda">
                                                            Ingrese sus apellidos:
                                                        </label>
                                                    </input>
                                                </div>
                                                <div class="input-field col s12">
                                                    <i class="material-icons prefix">
                                                        email
                                                    </i>
                                                    <input id="correUsuaUpda" name="correUsuaUpda" readonly="" required="" type="email">
                                                        <label for="correUsuaUpda">
                                                            Ingrese su correo:
                                                        </label>
                                                    </input>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="indeterminate">
                                                </div>
                                            </div>
                                            <div class="row center-align" id="modificarInformacion">
                                                <div class="col s12">
                                                    <button class="waves-effect waves-green btn blue darken-2" onclick="updateInfo();" type="button">
                                                        Guardar Cambios
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="collapsible-header">
                                            <i class="material-icons">
                                                place
                                            </i>
                                            Cambio de contraseña
                                        </div>
                                        <div class="collapsible-body">
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <i class="material-icons prefix">
                                                        account_circle
                                                    </i>
                                                    <input id="contAnti" name="contAnti" required="" type="password">
                                                        <label for="contAnti">
                                                            Ingrese su contraseña antigua:
                                                        </label>
                                                    </input>
                                                </div>
                                                <div class="input-field col s12">
                                                    <i class="material-icons prefix">
                                                        account_circle
                                                    </i>
                                                    <input id="contNuev" name="contNuev" required="" type="password">
                                                        <label for="contNuev">
                                                            Ingrese su nueva contraseña:
                                                        </label>
                                                    </input>
                                                </div>
                                                <div class="input-field col s12">
                                                    <i class="material-icons prefix">
                                                        email
                                                    </i>
                                                    <input id="contNuevVeri" name="contNuevVeri" required="" type="password">
                                                        <label for="contNuevVeri">
                                                            Ingrese su nueva contraseña de nuevo:
                                                        </label>
                                                    </input>
                                                </div>
                                                <div class="progress">
                                                    <div class="indeterminate">
                                                    </div>
                                                </div>
                                                <div class="row center-align" id="modificarContra">
                                                    <div class="col s12">
                                                        <button class="waves-effect waves-green btn blue darken-2" onclick="updateContra();" type="button">
                                                            Modificar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </form>
                        <div id="cuentaCasa">
                            <ul class="collapsible popout">
                                <li>
                                    <div class="collapsible-header">
                                        <i class="material-icons">
                                            filter_drama
                                        </i>
                                        Información Basica
                                    </div>
                                    <div class="collapsible-body">
                                        <form class="update" enctype="multipart/form-data" id="infoCasa">
                                            <input id="accion" name="accion" type="hidden" value="updateCuenta">
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <i class="material-icons prefix">
                                                            domain
                                                        </i>
                                                        <input id="nombCasaUpda" name="nombCasaUpda" required="" type="text">
                                                            <label for="nombCasaUpda">
                                                                Ingrese el nombre de la casa:
                                                            </label>
                                                        </input>
                                                    </div>
                                                    <div class="input-field col s12">
                                                        <i class="material-icons prefix">
                                                            add_location
                                                        </i>
                                                        <textarea class="materialize-textarea" id="direCasaUpda" name="direCasaUpda" required="">
                                                        </textarea>
                                                        <label for="direCasaUpda">
                                                            Ingrese la direccion de la casa:
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="indeterminate">
                                                    </div>
                                                </div>
                                                <div class="row center-align" id="modificarInformacionCasa">
                                                    <div class="col s12">
                                                        <button class="waves-effect waves-green btn blue darken-2" onclick="updateInfoCasa();" type="button">
                                                            Guardar Cambios
                                                        </button>
                                                    </div>
                                                </div>
                                            </input>
                                        </form>
                                    </div>
                                </li>
                                <li>
                                    <div class="collapsible-header">
                                        <i class="material-icons">
                                            add_a_photo
                                        </i>
                                        Logo de Casa
                                    </div>
                                    <div class="collapsible-body">
                                        <div class="row center-align">
                                            <div class="row">
                                                <div class="col s12">
                                                    <img alt="logo" class="responsive-img circle" id="logo" style="width: 30%;">
                                                    </img>
                                                </div>
                                            </div>
                                            <div class="row center-align" id="modificarLogoCasa">
                                                <div class="col s12">
                                                    <a class="waves-effect waves-green btn blue darken-2 modal-trigger" href="#updateLogoCasa">
                                                        Guardar Cambios
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="collapsible-header">
                                        <i class="material-icons">
                                            place
                                        </i>
                                        Información Extra
                                    </div>
                                    <div class="collapsible-body">
                                        <div class="row">
                                            <div class="col s12">
                                                <div class="row center-align">
                                                    <div class="col s12">
                                                        <a class="btn modal-trigger waves-effect waves-light blue darken-2" href="#addTelefono">Agregar Telefono</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s12">
                                                <table class="responsive-table hover no-wrap row-border striped" id="table-telefono" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                ID
                                                            </th>
                                                            <th>
                                                                CodiTipoTele
                                                            </th>
                                                            <th>
                                                                Tipo de Telefono
                                                            </th>
                                                            <th>
                                                                Numero de telefono
                                                            </th>
                                                            <th>
                                                                Opciones
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Modal para agregar usuario -->
<?php include APP_PATH . '/views/cuenta/addTelefono.view.php' ?>
<?php include APP_PATH . '/views/cuenta/updateLogoCasa.view.php' ?>
<?php include APP_PATH . '/views/cuenta/updateTelefono.view.php' ?>
<?php include APP_PATH . '/views/cuenta/deleteTelefono.view.php' ?>
<script src="<?= WEB_PATH ?>js/AJAX/cuenta.js">
</script>
<?php include APP_PATH . '/views/templates/footer.view.php' ?>
