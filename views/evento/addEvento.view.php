<div id="addEvento" class="modal modal-fixed-footer">
    <form id="frmAdd" action="" class="add" enctype="multipart/form-data">
        <div class="modal-header green darken-1 white-text">
            <h5 class="mt-none mb-none">Agregar Evento</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <input type="hidden" name="accion" value="create">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">library_books</i>
                            <input id="nombEven" name="nombEven" type="text">
                            <label for="nombEven">Nombre de evento:</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">library_books</i>
                            <textarea id="descEven" name="descEven" class="materialize-textarea"></textarea>
                            <label for="descEven">Descripcion de evento:</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">library_books</i>
                            <input id="fechEven" name="fechEven" type="text" class="datepicker">
                            <label for="fechEven">Fecha del evento:</label>
                        </div>
                        <div class="file-field input-field col s12 m6">
                            <div class="btn green">
                                <span>Foto del Evento:</span>
                                <input type="file" id="fotoEven" required>
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" id="nombFotoEven">
                            </div>
                        </div>
                        <div class="col s12 m12">
                            <label for="corrEven">Seleccione la institucion con la que se ralizara la invitacion:
                                <select class="select-2 w-100" name="corrEven" id="corrEven">
                                    <option selected value="1">Instituto Tecnico Ricaldone</option>
                                    <option value="2">CFP</option>
                                </select>
                            </label>
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