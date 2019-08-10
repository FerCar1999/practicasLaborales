<div id="deleteQuedan" class="modal">
    <form id="frmDelete" action="">
        <div class="modal-header red darken-1 white-text">
            <h5 class="mt-none mb-none">Eliminar Quedan</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <input type="hidden" id="codiQuedDele" name="codiQuedDele">
                <p>¿Desea eliminar el siguiente registro?</p>
                <p><b>Nota: </b>Recordar una vez eliminado el registro y no se puede recuperar una vez realizada la operación. Tambien cambiaran el estado de las facturas para poder ser ingresados en otro quedan</p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-close waves-effect btn-flat">Cancelar</button>
            <button type="button" class="waves-effect waves-green btn red darken-1" onclick="remove();">Eliminar</button>
        </div>
    </form>
</div>