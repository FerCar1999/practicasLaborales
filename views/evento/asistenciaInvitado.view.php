<div id="updateInvitado" class="modal">
    <form id="frmUpdateInvitado" action="">
        <div class="modal-header blue darken-1 white-text">
            <h5 class="mt-none mb-none">Asistencia de Invitado</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <input type="hidden" name="accion" value="asistencia">
                <input type="hidden" id="codiEvenDetaAsis" name="codiEvenDetaAsis">
                <p>¿Esta seguro de tomar la asistencia del invitado?</p>
                <p><b>Nota: </b>Una vez realizada esta operacion no se puede retroceder</p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-close waves-effect btn-flat">Cancelar</button>
            <button type="button" class="waves-effect waves-green btn blue darken-1" onclick="asistencia();">Tomar Asistencia</button>
        </div>
    </form>
</div>