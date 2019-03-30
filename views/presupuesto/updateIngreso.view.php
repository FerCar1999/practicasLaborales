<div id="updateIngreso" class="modal">
    <form id="frmUpdaIngre" action="" class="update">
        <div class="modal-header blue darken-1 white-text">
            <h5 class="mt-none mb-none">Modificar Ingreso Mensual</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row ">
                <div class="col s12">
                    <div class="row">
                        <input type="hidden" name="codiPresUpda" id="codiPresUpda">
                        <input type="hidden" name="accion" id="accion" value="update">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">attach_money</i>
                            <input id="cantPresUpda" name="cantPresUpda" type="text" class="validate">
                            <label for="cantPresUpda">Cantidad monetaria:</label>
                            <span class="helper-text" data-error="Campo requerido, ingrese" data-success="Correcto"></span>
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
            <button type="button" class="waves-effect waves-green btn blue darken-1" onclick="modificarIngreso();">Agregar</button>
        </div>
    </form>
</div>