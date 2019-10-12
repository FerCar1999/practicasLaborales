<div id="addInvitado" class="modal modal-fixed-footer">
    <form id="frmAddInvitado" action="" class="add">
        <div class="modal-header green darken-1 white-text">
            <h5 class="mt-none mb-none">Agregar Invitado</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <input type="hidden" name="accion" value="create">
                        <input type="hidden" name="codiEven" id="codiEven">
                        <div class="col s12">
                            <label for="codiEtiq">Etiqueta del contacto:
                                <select class="select-2 w-100" name="codiEtiq" id="codiEtiq" onchange="selectContactosEtiquetasC();">
                                </select>
                            </label>

                        </div>
                        <div class="col s12">
                            <label for="codiCont">Seleccione los contactos de la etiqueta:
                                <select multiple class="select-2 w-100" name="codiCont[]" id="codiCont">
                                </select>
                            </label>
                            <a onclick="selectTodos('codiCont');"">Seleccionar todos</a>
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
            <button type="button" class="waves-effect waves-green btn green darken-1" onclick="createEventoDetalle();">Agregar</button>
        </div>
    </form>
</div>