<div class="modal" id="addEgreso">
    <form action="" class="add" id="frmAddEgreso">
        <div class="modal-header green darken-1 white-text">
            <h5 class="mt-none mb-none">
                Agregar Sub Presupuesto
            </h5>
            <i class="material-icons modal-close">
                close
            </i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <input type="hidden" name="accion" id="accion" value="create">
                        <div class="input-field col s12 m12">
                            <i class="material-icons prefix">attach_money</i>
                            <input class="validate" id="cantPresDeta" name="cantPresDeta" type="text">
                            <label for="cantPresDeta">Cantidad de dinero gastada:</label>
                        </div>
                        <div class="col s12 m12">
                            <label for="codiCate">Categoria del presupuesto:</label>
                            <select class="js-example-basic-single" name="codiCate" id="codiCate">
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="progress" id="preloader">
                <div class="indeterminate">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-close waves-effect btn-flat" type="button">
                Cancelar
            </button>
            <button class="waves-effect waves-green btn green darken-1" onclick="agregarGasto();" type="button">
                Agregar Sub Presupuesto
            </button>
        </div>
    </form>
</div>