<div id="addQuedanDetalle" class="modal">
    <form id="quedanDetalle" action="" class="add" enctype="multipart/form-data">
        <div class="modal-header green darken-1 white-text">
            <h5 class="mt-none mb-none">Agregar Facturas al Quedan</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <input type="hidden" name="accion" id="accion" value="create">
                        <input type="hidden" name="codiQued" id="codiQued">
                        <div class="row" id="addDetalle">
                            <div class="col s12 m12">
                                <label for="codiFact">
                                    Facturas del quedan:
                                </label>
                                <select class="select-2 w-100" id="codiFact" name="codiFact">
                                </select>
                            </div> 
                            <div class="col s12 m12 center-align">
                            <br>
                                <button type="button" class="waves-effect waves-green btn green darken-1" onclick="agregarQuedanDetalle();">Agregar</button>
                            </div>
                        </div>
                        <div class="col s12 m12">
                        Monto : <p id="monto">$0.00</p>
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
            <button type="button" class="waves-effect waves-green btn green darken-1" onclick="enviarNotificacion();">Finalizar</button>
        </div>
    </form>
</div>