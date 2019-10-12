<div id="reporteContacto" class="modal">
    <form id="frmReporte" action="" class="update">
        <div class="modal-header red darken-1 white-text">
            <h5 class="mt-none mb-none">Generar Viñetas</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <input type="hidden" name="accion" value="reporte">
                </div>
                <div class="col s12">
                    <h6></h6>
                </div>
                <div class="col s12">
                    <label for="codiEtiqRepoCont">Etiqueta del contacto:
                        <select class="select-2 w-100" name="codiEtiqRepoCont" id="codiEtiqRepoCont" onchange="selectContactosEtiquetas();">
                        </select>
                    </label>
                </div>
                <div class="col s12">
                    <label for="codiContRepo">Seleccione los contactos de la etiqueta:
                        <select multiple class="select-2 w-100" name="codiContRepo" id="codiContRepo">

                        </select>
                    </label>
                    <a onclick="selectTodos('codiContRepo');"">Seleccionar todos</a>
                </div>
            </div>
            <div id="preloader2" class="progress">
                <div class="indeterminate"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-close waves-effect btn-flat">Cancelar</button>
            <button type="button" class="waves-effect waves-green btn red darken-1" onclick="reporteContacto();">Generar viñetas</button>
        </div>
    </form>
</div>