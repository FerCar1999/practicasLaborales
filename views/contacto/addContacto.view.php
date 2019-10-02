<div id="addContacto" class="modal modal-fixed-footer">
    <form id="frmAdd" action="" class="add">
        <div class="modal-header green darken-1 white-text">
            <h5 class="mt-none mb-none">Agregar Contacto</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <input type="hidden" name="accion" value="create">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="nombCont" name="nombCont" type="text" class="validate">
                            <label for="nombCont">Nombre del Contacto:</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="apelCont" name="apelCont" type="text" class="validate">
                            <label for="apelCont">Apellido del contacto:</label>
                        </div>
                        <div class="col s6">
                            <label for="codiProf">Profesion del contacto:
                                <select class="select-2 w-100" name="codiProf" id="codiProf">
                                </select>
                            </label>
                        </div>
                        <div class="col s6">
                            <label for="codiEtiq">Etiqueta del contacto:
                                <select multiple class="select-2 w-100" name="codiEtiq" id="codiEtiq">

                                </select>
                            </label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">library_books</i>
                            <input id="corrCont" name="corrCont" type="text" class="validate">
                            <label for="corrCont">Correo del contacto:</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">library_books</i>
                            <input id="teleCeluCont" name="teleCeluCont" type="text" class="validate">
                            <label for="teleCeluCont">Celular del contacto:</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">library_books</i>
                            <input id="emprCont" name="emprCont" type="text" class="validate">
                            <label for="emprCont">Empresa del contacto:</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">library_books</i>
                            <input id="direCont" name="direCont" type="text" class="validate">
                            <label for="direCont">Direccion de la empresa::</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">library_books</i>
                            <input id="teleFijoCont" name="teleFijoCont" type="text" class="validate">
                            <label for="teleFijoCont">Telefono fijo de la empresa:</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">library_books</i>
                            <input id="cargCont" name="cargCont" type="text" class="validate">
                            <label for="cargCont">Cargo del contacto:</label>
                        </div>

                    </div>
                </div>
            </div>
            <div id="preloader" class="progress">
                <div class="indeterminate"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-close waves-effect btn-flat">Cancelar</button>
            <button type="button" class="waves-effect waves-green btn green darken-1" onclick="create();">Agregar</button>
        </div>
    </form>
</div>