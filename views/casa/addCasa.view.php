<div id="addCasa" class="modal">
        <div class="modal-header green darken-1 white-text">
            <h5 class="mt-none mb-none">Agregar Casa</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                <ul class="stepper linear">
                        <li class="step active">
                            <div data-step-label="Ingrese la informacion del usuario a cargo de la casa" class="step-title waves-effect">
                                Informacion Personal
                            </div>
                            <div class="step-content">
                                <form id="infoPersonal" class="add">
                                <input type="hidden" name="accion" value="createPrimerUsuario">
                                    <input type="hidden" name="codiTipoUsua" value="1">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">
                                                account_circle
                                            </i>
                                            <input id="nombUsua" name="nombUsua" type="text" required>
                                                <label for="nombUsua">
                                                    Ingrese nombres del usuario encargado:
                                                </label>
                                            </input>
                                        </div>
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">
                                                account_circle
                                            </i>
                                            <input id="apelUsua" name="apelUsua" type="text" required >
                                                <label for="apelUsua">
                                                    Ingrese apellidos del usuario encargado:
                                                </label>
                                            </input>
                                        </div>
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">
                                                email
                                            </i>
                                            <input id="correUsua" name="correUsua" type="email" required >
                                                <label for="correUsua">
                                                    Ingrese correo del usuario encargado:
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
                            <div data-step-label="Informacion basica de la casa" class="step-title waves-effect">
                                Informacion de la Casa
                            </div>
                            <div class="step-content">
                                <form id="infoCasa" class="add" enctype="multipart/form-data">
                                    <div class="row">
                                    <input type="hidden" name="accion" value="create">
                                    <input type="hidden" name="codiTipoCasa" value="2">
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">
                                                domain
                                            </i>
                                            <input id="nombCasa" name="nombCasa" type="text" required >
                                                <label for="nombCasa">
                                                    Ingrese el nombre de la casa:
                                                </label>
                                            </input>
                                        </div>
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">
                                                add_location
                                            </i>
                                            <textarea id="direCasa" name="direCasa" class="materialize-textarea" required ></textarea>
                                                <label for="direCasa">
                                                    Ingrese la direccion de la casa:
                                                </label>
                                        </div>
                                        <div class="file-field input-field col s12">
                                            <div class="btn green">
                                                <span>Logo</span>
                                                <input type="file" id="logoCasa" required>
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text" id="nombLogoCasa">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="step-actions">
                                    <button class="waves-effect waves-dark btn-flat previous-step">ATRAS</button>
                                    <button type="button" class="waves-effect waves-green btn green darken-1" onclick="create();">Agregar</button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
</div>