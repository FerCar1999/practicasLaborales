<div id="addQuedan" class="modal">
    <form id="quedan" action="" class="add" enctype="multipart/form-data">
        <div class="modal-header green darken-1 white-text">
            <h5 class="mt-none mb-none">Agregar Quedan</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <input type="hidden" name="accion" id="accion" value="create">
                        <div class="input-field col s12 m6">
                                            <i class="material-icons prefix">
                                                account_circle
                                            </i>
                                            <label for="numeQued">
                                                    Ingrese el numero del quedan:
                                                </label>
                                            <input id="numeQued" name="numeQued" type="text" required>
                                        </div>
                                        <div class="input-field col s12 m6">
                                            <i class="material-icons prefix">
                                                timer
                                            </i>
                                            <input class="datepicker" id="fechEmis" name="fechEmis" type="text">
                                                <label for="fechEmis">
                                                    Fecha de emision del quedan:
                                                </label>
                                        </div>
                                        <div class="input-field col s12 m6">
                                            <i class="material-icons prefix">
                                                email
                                            </i>
                                            <input id="cantFact" name="cantFact" type="text" required >
                                                <label for="cantFact">
                                                    Cantidad de facturas:
                                                </label>
                                        </div>
                                        <div class="file-field input-field col s12 m6">
                                            <div class="btn green">
                                                <span>Quedan</span>
                                                <input type="file" id="archQuedan" required>
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text" id="nombArchQuedan">
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
            <button type="button" class="waves-effect waves-green btn green darken-1" onclick="agregarQuedan();">Agregar</button>
        </div>
    </form>
</div>

