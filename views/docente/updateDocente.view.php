<div id="updaDocente" class="modal">
    <form id="frmUpdate" action="" class="update">
        <div class="modal-header blue darken-1 white-text">
            <h5 class="mt-none mb-none">Modificar Docente</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <input type="hidden" name="accion" id="accion" value="update">
                        <input type="hidden" id="codiDoceUpda" name="codiDoceUpda">
                        <input type="hidden" id="codiInteAcreDoceUpda" name="codiInteAcreDoceUpda">
                        <input type="hidden" id="codiInteDoceProfUpda" name="codiInteDoceProfUpda">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">people</i>
                            <input id="nombDoceUpda" name="nombDoceUpda" type="text" class="validate">
                            <label for="nombDoceUpda">Nombres del docente:</label>
                            <span class="helper-text" data-error="Campo requerido, ingrese solo letras" data-success="Correcto"></span>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">people</i>
                            <input id="apelDoceUpda" name="apelDoceUpda" type="text" class="validate">
                            <label for="apelDoceUpda">Apellidos del docente:</label>
                            <span class="helper-text" data-error="Campo requerido, ingrese solo letras" data-success="Correcto"></span>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">contacts</i>
                            <input id="duiDoceUpda" name="duiDoceUpda" type="text" class="validate" onkeypress="agregarGuionDui();">
                            <label for="duiDoceUpda">DUI del docente:</label>
                        </div>
                        <div class="col s12 m6">
                            <label for="codiProfUpda">Seleccionela profesion del docente:
                                <select class="select-2 w-100" name="codiProfUpda" id="codiProfUpda">
                                </select>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div id="preloader2" class="progress">
                <div class="indeterminate"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-close waves-effect btn-flat">Cancelar</button>
            <button type="button" class="waves-effect waves-green btn blue darken-1" onclick="update();">Guardar Cambios</button>
        </div>
    </form>
</div>
