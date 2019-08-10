<div id="updateFactura" class="modal">
    <form id="facturaUpda" action="" class="update">
        <div class="modal-header blue darken-1 white-text">
            <h5 class="mt-none mb-none">Modificar Factura</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <input type="hidden" name="accion" id="accion" value="update">
                        <input type="hidden" name="codiFactUpda" id="codiFactUpda">
                        <div class="input-field col s12 m12">
                                            <i class="material-icons prefix">
                                                account_circle
                                            </i>
                                            <label for="numeFactUpda">
                                                    Ingrese el numero de la factura:
                                                </label>
                                            <input id="numeFactUpda" name="numeFactUpda" type="text" required>
                                        </div>
                                        <div class="input-field col s12 m6">
                                            <i class="material-icons prefix">
                                                timer
                                            </i>
                                            <input class="datepicker" id="fechEmisFactUpda" name="fechEmisFactUpda" type="text">
                                                <label for="fechEmisFactUpda">
                                                    Fecha de emision de factura:
                                                </label>
                                        </div>
                                        <div class="input-field col s12 m6">
                                            <i class="material-icons prefix">
                                                email
                                            </i>
                                            <input id="cantFactUpda" name="cantFactUpda" type="text" required >
                                                <label for="cantFactUpda">
                                                    Cantidad monetaria de la factural:
                                                </label>
                                        </div>
                        <div class="col s12 m12">
                            <label for="codiCursUpda">
                                Cursos de la factura:
                            </label>
                            <select class="select-2 w-100" id="codiCursUpda" name="codiCursUpda">
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
            <button type="button" class="waves-effect waves-green btn green darken-1" onclick="updateFactura();">Agregar</button>
            <button type="button" class='waves-effect waves-blue btn blue darken-1' onclick="abrirModificarArchivo();">Modificar Archivo</button>
        </div>
    </form>
</div>