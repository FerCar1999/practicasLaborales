<?php include APP_PATH . '/views/templates/head.view.php'?>
<div class="row mb-none">
    <div class="flex-container-column blue darken-2">
        <div class="card z-depth-4">
            <div class="card-content center-align">
                <div id="registro">
                    <span class="card-title">
                        PRIMER USUARIO
                    </span>
                    <ul class="stepper linear">
                        <li class="step active">
                            <div class="step-title waves-effect">
                                Informacion Personal
                            </div>
                            <div class="step-content">
                                <form id="infoPersonal" class="update">
                                <input type="hidden" name="accion" value="createPrimerUsuario">
                                    <input type="hidden" name="codiTipoUsua" value="1">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">
                                                account_circle
                                            </i>
                                            <input id="nombUsua" name="nombUsua" type="text">
                                                <label for="nombUsua">
                                                    Ingrese su nombre:
                                                </label>
                                            </input>
                                        </div>
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">
                                                account_circle
                                            </i>
                                            <input id="apelUsua" name="apelUsua" type="text">
                                                <label for="apelUsua">
                                                    Ingrese su apellido:
                                                </label>
                                            </input>
                                        </div>
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">
                                                email
                                            </i>
                                            <input id="correUsua" name="correUsua" type="email">
                                                <label for="correUsua">
                                                    Ingrese su correo:
                                                </label>
                                            </input>
                                        </div>
                                    </div>
                                </form>
                                <div class="step-actions">
                                    <button class="waves-effect waves-dark btn next-step" data-feedback="someFunction" data-validation="validationFunction">
                                        SIGUIENTE
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="step">
                            <div class="step-title waves-effect">
                                Informacion de la Casa
                            </div>
                            <div class="step-content">
                                <form id="infoCasa" enctype="multipart/form-data">
                                    <div class="row">
                                    <input type="hidden" name="accion" value="create">
                                    <input type="hidden" name="codiTipoCasa" value="1">
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">
                                                domain
                                            </i>
                                            <input id="nombCasa" name="nombCasa" type="text">
                                                <label for="nombCasa">
                                                    Ingrese el nombre de la casa:
                                                </label>
                                            </input>
                                        </div>
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">
                                                add_location
                                            </i>
                                            <textarea id="direCasa" name="direCasa" class="materialize-textarea"></textarea>
                                                <label for="direCasa">
                                                    Ingrese la direccion de la casa:
                                                </label>
                                        </div>
                                        <div class="file-field input-field col s12">
                                            <div class="waves-effect waves-teal btn-flat">
                                                <span>Logo</span>
                                                <input type="file" id="logoCasa">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text" id="nombLogoCasa" disabled >
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="step-actions" id="accionesRegistro"> 
                                    <button class="waves-effect waves-dark btn next-step white-text" onClick="guardarUsuario()">
                                    Finalizar
                                    </button>
                                    <button class="waves-effect waves-dark btn-flat previous-step">
                                        ATRAS
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div id="login">
                    <span class="card-title">
                        INICIAR SESIÓN
                    </span>
                    <form autocomplete="off" class="update" id="frmLogin">
                        <div class="row">
                            <div class="col s12">
                                <div class="row">
                                    <input type="hidden" name="accion" id="accion" value="login">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">
                                            email
                                        </i>
                                        <input id="corrUsua" name="corrUsua" type="text">
                                            <label for="corrUsua">
                                                Ingrese su correo electronico:
                                            </label>
                                    </div>
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">
                                            lock
                                        </i>
                                        <input id="contUsua" name="contUsua" type="password">
                                            <label for="contUsua">
                                                Ingrese su contraseña:
                                            </label>
                                    </div>
                                    <div class="col s12">
                                        <a class="waves-effect waves-teal btn-flat right" onClick="recuperar();">¿Has olvidado tu contraseña?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12">
                                <a class="btn blue darken-1 waves-effect waves-light w-100" onClick="iniciarSesion();">INICIAR SESION</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="recuperarContra">
                    <span class="card-title">
                        RECUPERAR CONTRASEÑA
                    </span>
                    <span>Se le enviara a su correo una nueva contraseña</span>
                    <form autocomplete="off" class="update" id="frmRecuperar">
                        <div class="row">
                            <div class="col s12">
                                <div class="row">
                                    <input type="hidden" id="accion" name="accion" value="updateContraOlvidada">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">
                                            email
                                        </i>
                                        <input id="corrOlvi" name="corrOlvi" type="text">
                                            <label for="corrOlvi">
                                                Ingrese su correo electronico:
                                            </label>
                                        </input>
                                    </div>

                                </div>
                            </div>
                            <div id="preloader">
                                <div class="progress">
                                    <div class="indeterminate"></div>
                                </div>
                            </div>
                            <div id="elementosRegisto">
                                <div class="col s6">
                                    <a class="waves-effect waves-teal btn-flat right" onClick="recuperar();">REGRESAR</a>
                                </div>
                                <div class="col s6">
                                    <a onClick="recuperando();" class="btn blue darken-1 waves-effect waves-light w-100">RECUPERAR</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= WEB_PATH ?>/js/AJAX/login.js" charset="utf-8"></script>
<?php include APP_PATH . '/views/templates/footer.view.php'?>
