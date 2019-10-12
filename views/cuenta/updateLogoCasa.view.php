<div class="modal" id="updateLogoCasa">
    <form action="" class="update" id="frmUpdateLogo">
        <div class="modal-header blue darken-1 white-text">
            <h5 class="mt-none mb-none">
                Modificar Logo
            </h5>
            <i class="material-icons modal-close">
                close
            </i>
        </div>
        <div class="modal-content">
            <input type="hidden" name="accion" value="updateLogo">
            <div class="file-field input-field col s12">
                <div class="btn green">
                    <span>
                        Cambiar Imagen
                    </span>
                    <input id="logoCasaUpda" required="" type="file">
                    </input>
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" id="nombLogoCasa" readonly="" required="" type="text">
                    </input>
                </div>
            </div>
            <div class="progress">
                <div class="indeterminate">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-close waves-effect btn-flat" type="button">
                Cancelar
            </button>
            <button class="waves-effect waves-green btn blue darken-2" onclick="updateLogoCasa();" type="button">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
