<div id="informeAgregado" class="modal">
    <form id="frmInformeAgregado" action="">
        <div class="modal-header blue darken-1 white-text">
            <h5 class="mt-none mb-none">Informe de INSAFORP</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <input type="hidden" id="codiCurs" name="codiCurs">
                    <input type="hidden" id="accion" name="accion" value="informe">
                    <p>¿Ya envio el informe a INSAFORP?</p>
                    <p><b>Nota: </b>Esta operacion se tiene que realizar una vez que usted le haya enviado el informe de este curso a INSAFORP. Despues de esto se le estara notificando para recordarle sobre la factura que se le entregara</p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-close waves-effect btn-flat">Cancelar</button>
            <button type="button" class="waves-effect waves-green btn blue darken-1" onclick="cambiarEstadoInforme();">Realizar</button>
        </div>
    </form>
</div>