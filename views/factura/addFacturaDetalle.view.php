<div id="addFacturaDetalle" class="modal">
    <form id="facturaDetalle" action="" class="add" enctype="multipart/form-data">
        <div class="modal-header green darken-1 white-text">
            <h5 class="mt-none mb-none">Agregar Factura</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <input type="hidden" name="accion" id="accion" value="create">
                        <input type="hidden" name="codiFact" id="codiFact">
                        <div class="col s12 m12">
                            <label for="codiCate">
                                Cursos de la factura:
                            </label>
                            <select class="select-2 w-100" id="codiCurs" name="codiCurs">
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
            <button type="button" class="waves-effect waves-green btn green darken-1" onclick="agregarFacturaDetalle();">Agregar</button>
        </div>
    </form>
</div>