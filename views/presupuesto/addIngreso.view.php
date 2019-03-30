<div id="addIngreso" class="modal">
    <form id="frmAddIngre" action="" class="add">
        <div class="modal-header green darken-1 white-text">
            <h5 class="mt-none mb-none">Agregar Ingreso</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <input type="hidden" name="accion" id="accion" value="create">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">attach_money</i>
                            <input id="cantPres" name="cantPres" type="text" class="validate">
                            <label for="cantPres">Cantidad monetaria:</label>
                            <span class="helper-text" data-error="Campo requerido, ingrese numeros" data-success="Correcto"></span>
                        </div>
                        <div class=" col s12 m6">
                            <label for="codiCasaIngre">
                                Seleccione la casa:
                            </label>
                            <select class="select-2 w-100" id="codiCasaIngre" name="codiCasaIngre">
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
            <button type="button" class="waves-effect waves-green btn green darken-1" onclick="agregarIngreso();">Agregar</button>
        </div>
    </form>
</div>