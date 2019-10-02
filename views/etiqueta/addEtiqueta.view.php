<div id="addEtiqueta" class="modal modal-fixed-footer">
    <form id="frmAdd" action="" class="add">
        <div class="modal-header green darken-1 white-text">
            <h5 class="mt-none mb-none">Agregar Etiqueta</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <input type="hidden" name="accion" value="create">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="nombEtiq" name="nombEtiq" type="text" class="validate">
                            <label for="nombEtiq">Nombre de la etiqueta:</label>
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