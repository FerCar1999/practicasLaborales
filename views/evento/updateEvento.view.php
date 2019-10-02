<div id="updateEvento" class="modal">
    <form id="frmUpdate" action="" class="update">
        <div class="modal-header blue darken-1 white-text">
            <h5 class="mt-none mb-none">Modificar Acreditacion</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <input type="hidden" name="accion" value="update">
                        <input type="hidden" id="codiEvenUpda" name="codiEvenUpda">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">library_books</i>
                            <input id="nombEvenUpda" name="nombEvenUpda" type="text">
                            <label for="nombEvenUpda">Nombre de evento:</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">library_books</i>
                            <textarea id="descEvenUpda" name="descEvenUpda" class="materialize-textarea"></textarea>
                            <label for="descEvenUpda">Descripcion de evento:</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">library_books</i>
                            <input id="fechEvenUpda" name="fechEvenUpda" type="text" class="datepicker">
                            <label for="fechEvenUpda">Fecha del evento:</label>
                        </div>
                        <div class="col s12 m6">
                            <label for="corrEvenUpda">Seleccione la institucion con la que se ralizara la invitacion:
                                <select class="select-2 w-100" name="corrEvenUpda" id="corrEvenUpda">
                                    <option selected value="1">Instituto Tecnico Ricaldone</option>
                                    <option value="2">CFP</option>
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
            <button type="button" class="waves-effect waves-green btn blue darken-1" onclick="update();">Modificar</button>
        </div>
    </form>
</div>