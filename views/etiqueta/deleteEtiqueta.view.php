<div id="deleteEtiqueta" class="modal">
    <form id="frmDele" action="">
        <div class="modal-header red darken-1 white-text">
            <h5 class="mt-none mb-none">Eliminar Etiqueta</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <input type="hidden" name="accion" value="delete">
                <input type="hidden" id="codiEtiqDele" name="codiRtiqDele">
                <p>¿Desea eliminar el siguiente registro?</p>
                <p><b>Nota: </b>Recordar una vez eliminado el registro y no se puede recuperar una vez realizada la operación</p>
                <div class="col s12">
                    <label for="codiEtiqNuev">Nueva etiqueta del contacto:
                        <select class="select-2 w-100" name="codiEtiqNuev" id="codiEtiqNuev">

                        </select>
                    </label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-close waves-effect btn-flat">Cancelar</button>
            <button type="button" class="waves-effect waves-green btn red darken-1" onclick="remove();">Eliminar</button>
        </div>
    </form>
</div>