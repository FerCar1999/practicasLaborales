<div id="informeAprovacion" class="modal">
    <form id="frmInformeAprovacion" action="">
        <div class="modal-header blue darken-1 white-text">
            <h5 class="mt-none mb-none">Aprobacion de Informe del Curso</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <input type="hidden" id="codiCursAp" name="codiCursAp">
                    <input type="hidden" id="codiCateAp" name="codiCateAp">
                    <input type="hidden" id="accion" name="accion" value="informeAprovacion">
                    <p>¿Ya recibio el informe de este curso?</p>
                    <p><b>Nota: </b>Esta operacion se tiene que realizar una vez ya haya revisado fisicamente el informe que se enviara a INSAFORP, una vez aceptado el informe LA RESPONSABILIDAD de esta accion caera en usted</p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-close waves-effect btn-flat">Cancelar</button>
            <button type="button" class="waves-effect waves-green btn blue darken-1" onclick="cambiarEstadoInformeAprobacion();">Realizar</button>
        </div>
    </form>
</div>