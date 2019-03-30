<div id="updaTelefono" class="modal">
    <form id="frmUpdate" action="" class="add">
        <div class="modal-header blue darken-1 white-text">
            <h5 class="mt-none mb-none">Modificar Telefono</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <input type="hidden" name="codiTeleUpda" id="codiTeleUpda">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">phone</i>
                            <input id="numeTeleUpda" name="numeTeleUpda" type="text" class="validate">
                            <label for="numeTeleUpda">Numero de telefono:</label>
                            <span class="helper-text" data-error="Campo requerido, ingrese" data-success="Correcto"></span>
                        </div>
                        <div class=" col s12 m6">
                            <label for="codiTipoTeleUpda">
                                Tipo de telefono:
                            </label>
                            <select class="select-2 w-100" id="codiTipoTeleUpda" name="codiTipoTeleUpda">
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div id="preloader" class="progress">
                <div class="indeterminate"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-close waves-effect btn-flat">Cancelar</button>
            <button type="button" class="waves-effect waves-green btn blue darken-1" onclick="update();">Modificar</button>
        </div>
    </form>
</div>