<div id="updaUsuario" class="modal">
    <form id="frmUpda" class="update">
        <div class="modal-header blue darken-1 white-text">
            <h5 class="mt-none mb-none">Modificar Usuario</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row mb-none">
                <div class="col s12">
                    <div class="row mb-none">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="nombUsuaUpda" name="nombUsuaUpda" type="text" class="validate">
                            <label for="nombUsuaUpda">Nombres del usuario:</label>
                            <span class="helper-text" data-error="Campo requerido, ingrese solo letras" data-success="Correcto"></span>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="apelUsuaUpda" name="apelUsuaUpda" type="text" class="validate">
                            <label for="apelUsuaUpda">Apellidos del usuario:</label>
                            <span class="helper-text" data-error="Campo requerido, ingrese solo letras" data-success="Correcto"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-none">
                <div class="col s12">
                    <div class="row mb-none">
                        <div class="input-field col s12 m12">
                            <i class="material-icons prefix">email</i>
                            <input id="correUsuaUpda" name="correUsuaUpda" type="text" class="validate">
                            <label for="correUsuaUpda">Correo del usuario:</label>
                            <span class="helper-text" data-error="Campo requerido, ingrese el correo correctamente" data-success="Correcto"></span>
                        </div>
                        <div class=" col s12 m12">
                            <label for="codiTipoUsuaUpda">Tipo de usuario</label>
                            <select name="codiTipoUsuaUpda" id="codiTipoUsuaUpda" class="select-2 w-100"></select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect btn-flat">Cancelar</a>
            <button type="button" class="waves-effect waves-green btn blue darken-1" onclick="update();">Guardar Cambios</button>
        </div>
    </form>
</div>