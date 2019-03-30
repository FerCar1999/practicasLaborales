<div id="deleUsuario" class="modal">
    <form id="frmDele">
        <div class="modal-header red darken-1 white-text">
            <h5 class="mt-none mb-none">Eliminar Usuario</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <input type="hidden" id="codiUsuaDele" name="codiUsuaDele">
        <div class="modal-content">
            <div class="row">
                <p>¿Desea eliminar el siguiente registro?</p>
                <p><b>Nota: </b>Recordar una vez eliminado el registro y no se puede recuperar una vez realizada la operación</p>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect btn-flat">Cancelar</a>
            <button type="button" class="waves-effect waves-green btn red darken-1" onclick="remove();">Eliminar</button>
        </div>
    </form>
</div>