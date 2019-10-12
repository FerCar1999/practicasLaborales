<div id="updateContacto" class="modal">
    <form id="frmUpdate" action="" class="update">
        <div class="modal-header blue darken-1 white-text">
            <h5 class="mt-none mb-none">Modificar Contacto</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <input type="hidden" name="accion" value="update">
                <input type="hidden" name="codiContUpda" id="codiContUpda">
                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="nombContUpda" name="nombContUpda" type="text" class="validate">
                    <label for="nombContUpda">Nombre del Contacto:</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="apelContUpda" name="apelContUpda" type="text" class="validate">
                    <label for="apelContUpda">Apellido del contacto:</label>
                </div>
                <div class="col s6">
                    <label for="codiProfUpda">Profesion del contacto:
                        <select class="select-2 w-100" name="codiProfUpda" id="codiProfUpda">
                        </select>
                    </label>
                </div>
                <div class="col s6">
                    <label for="codiEtiqUpda">Etiqueta del contacto:
                        <select multiple class="select-2 w-100" name="codiEtiqUpda[]" id="codiEtiqUpda">

                        </select>
                    </label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">library_books</i>
                    <input id="corrContUpda" name="corrContUpda" type="text" class="validate">
                    <label for="corrContUpda">Correo del contacto:</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">library_books</i>
                    <input id="teleCeluContUpda" name="teleCeluContUpda" type="text" class="validate">
                    <label for="teleCeluContUpda">Celular del contacto:</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">library_books</i>
                    <input id="emprContUpda" name="emprContUpda" type="text" class="validate">
                    <label for="emprContUpda">Empresa del contacto:</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">library_books</i>
                    <input id="direContUpda" name="direContUpda" type="text" class="validate">
                    <label for="direContUpda">Direccion de la empresa::</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">library_books</i>
                    <input id="teleFijoContUpda" name="teleFijoContUpda" type="text" class="validate">
                    <label for="teleFijoContUpda">Telefono fijo de la empresa:</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">library_books</i>
                    <input id="cargContUpda" name="cargContUpda" type="text" class="validate">
                    <label for="cargContUpda">Cargo del contacto:</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">library_books</i>
                    <input id="obseContUpda" name="obseContUpda" type="text" class="validate">
                    <label for="obseContUpda">Observacion del contacto:</label>
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