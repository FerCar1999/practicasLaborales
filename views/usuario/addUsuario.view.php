<div class="modal" id="addUsuario">
    <form autocomplete="off" class="add" id="frmAdd">
        <div class="modal-header green darken-1 white-text">
            <h5 class="mt-none mb-none">
                Agregar Usuario
            </h5>
            <i class="material-icons modal-close">
                close
            </i>
        </div>
        <div class="modal-content">
            <div class="row mb-none">
                <div class="col s12">
                    <div class="row mb-none">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">
                                account_circle
                            </i>
                            <input class="validate" id="nombUsua" name="nombUsua" type="text">
                                <label for="nombUsua">
                                    Nombres del usuario:
                                </label>
                                <span class="helper-text" data-error="Campo requerido, ingrese solo letras" data-success="Correcto">
                                </span>
                            </input>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">
                                account_circle
                            </i>
                            <input class="validate" id="apelUsua" name="apelUsua" type="text">
                                <label for="apelUsua">
                                    Apellidos del usuario:
                                </label>
                                <span class="helper-text" data-error="Campo requerido, ingrese solo letras" data-success="Correcto">
                                </span>
                            </input>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-none">
                <div class="col s12">
                    <div class="row mb-none">
                        <div class="input-field col s12 m12">
                            <i class="material-icons prefix">
                                email
                            </i>
                            <input class="validate" id="correUsua" name="correUsua" type="text">
                                <label for="correUsua">
                                    Correo del usuario:
                                </label>
                                <span class="helper-text" data-error="Campo requerido, ingrese el correo correctamente" data-success="Correcto">
                                </span>
                            </input>
                        </div>
                        <div class=" col s12 m6">
                            <label for="codiTipoUsua">
                                Tipo de usuario
                            </label>
                            <select class="select-2 w-100" id="codiTipoUsua" name="codiTipoUsua" onchange="mostrarCategorias()">
                            </select>
                        </div>
                        <div id="categoria" class=" col s12 m6">
                            <label for="codiTipoUsua">
                                Categoria
                            </label>
                            <select class="select-2 w-100" id="codiCateUsua" name="codiCateUsua">
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="preloader" class="progress">
                <div class="indeterminate"></div>
            </div>
        <div class="modal-footer">
            <button class="modal-close waves-effect btn-flat" type="button">
                Cancelar
            </button>
            <button class="waves-effect waves-green btn green darken-1" onclick="create();" type="button">
                Agregar
            </button>
        </div>
    </form>
</div>