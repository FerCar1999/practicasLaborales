<div id="deleteHorarioCurso" class="modal">
    <form id="frmDeleHoraCurso" action="">
        <div class="modal-header red darken-1 white-text">
            <h5 class="mt-none mb-none">Eliminar Horario Curso</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <input type="hidden" id="codiInteCursSaloDele" name="codiInteCursSaloDele">
                <input type="hidden" id="accion" name="accion" value="delete">
                <p>¿Desea eliminar el siguiente registro?</p>
                <p><b>Nota: </b>Recordar una vez eliminado el registro y no se puede recuperar una vez realizada la operación</p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-close waves-effect btn-flat">Cancelar</button>
            <button type="button" class="waves-effect waves-green btn red darken-1" onclick="removeHorario();">Eliminar</button>
        </div>
    </form>
</div>