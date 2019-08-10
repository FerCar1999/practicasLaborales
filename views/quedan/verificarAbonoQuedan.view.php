<div id="verificarQuedanEstado" class="modal">
    <form id="veriQuedEsta" action="">
        <div class="modal-header blue darken-1 white-text">
            <h5 class="mt-none mb-none">Quedan Abonado</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
            <input type="hidden" id="accion" name="accion" value="abonoVerificado">
                <input type="hidden" id="codiQuedUpdaFinEsta" name="codiQuedUpdaFinEsta">
                <p>¿Desea notificar que se ha abonado el Quedan?</p>
                <p><b>Nota: </b>Al dar aceptar se le notificara a la  casa que abono el quedan que se ha comprobado que ya fue recibido el abono</p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-close waves-effect btn-flat">Cancelar</button>
            <button type="button" class="waves-effect waves-green btn blue darken-1" onclick="notificarVerificacionAbono();">Aceptar</button>
        </div>
    </form>
</div>