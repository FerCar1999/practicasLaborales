<div id="updateFacturaArchivo" class="modal">
    <form id="facturaFactArch" action="" class="update" enctype="multipart/form-data">
        <div class="modal-header green darken-1 white-text">
            <h5 class="mt-none mb-none">Modificar Archivo de Factura</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <input type="hidden" name="accion" id="accion" value="updateArchivo">
                        <input type="text" name="codiFactUpdaA" id="codiFactUpdaA">
                                        <div class="file-field input-field col s12 m6">
                                            <div class="btn green">
                                                <span>Factura</span>
                                                <input type="file" id="archFactUpda" required>
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text" id="nombArchFactUpda">
                                            </div>
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
            <button type="button" class="waves-effect waves-green btn green darken-1" onclick="updateFacturaArchivo();">Agregar</button>
        </div>
    </form>
</div>