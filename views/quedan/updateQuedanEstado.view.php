<div id="updateQuedanEstado" class="modal">
    <form id="updateQuedEsta" action="">
        <div class="modal-header blue darken-1 white-text">
            <h5 class="mt-none mb-none">Quedan Abonado</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
            <input type="hidden" id="accion" name="accion" value="abono">
                <input type="hidden" id="codiQuedUpdaEsta" name="codiQuedUpdaEsta">
                <p>¿Desea notificar que se ha abonado el Quedan?</p>
                <p><b>Nota: </b>Al dar aceptar se le notificara a casa del quedan que se ha abonado</p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-close waves-effect btn-flat">Cancelar</button>
            <button type="button" class="waves-effect waves-green btn blue darken-1" onclick="notificarAbono();">Aceptar</button>
        </div>
    </form>
</div>