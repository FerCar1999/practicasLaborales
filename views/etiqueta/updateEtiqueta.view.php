<div id="updateEtiqueta" class="modal">
    <form id="frmUpdate" action="" class="update">
        <div class="modal-header blue darken-1 white-text">
            <h5 class="mt-none mb-none">Modificar Contacto</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <input type="hidden" name="accion" value="update">
                <input type="hidden" name="codiEtiqUpda" id="codiEtiqUpda">
                <div class="input-field col s12">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="nombEtiqUpda" name="nombEtiqUpda" type="text" class="validate">
                    <label for="nombEtiqUpda">Nombre de la Etiqueta:</label>
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