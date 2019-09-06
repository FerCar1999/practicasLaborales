<div id="informeAgregadoFactura" class="modal">
    <form id="informefactura" action="" class="add" enctype="multipart/form-data">
        <div class="modal-header green darken-1 white-text">
            <h5 class="mt-none mb-none">Ingresar Factura e Informe</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div id="facturaAdd">
            <div class="modal-content">
                <div class="row">
                    <div class="col s12">
                            <p>¿Ya envio el informe y la factura a INSAFORP?</p>
                            <p><b>Nota: </b>Esta operacion se tiene que realizar una vez que usted le haya enviado el
                                informe y la factura de este curso a INSAFORP.</p>
                        <div class="row">
                            <input type="hidden" id="codiCursFact" name="codiCursFact">
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">
                                    account_circle
                                </i>
                                <label for="numeFact">
                                    Ingrese el numero de la factura:
                                </label>
                                <input id="numeFact" name="numeFact" type="text" required>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">
                                    timer
                                </i>
                                <input class="datepicker" id="fechEmisFact" name="fechEmisFact" type="text">
                                <label for="fechEmisFact">
                                    Fecha de emision de factura:
                                </label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">
                                    email
                                </i>
                                <input id="cantFact" name="cantFact" type="text" required>
                                <label for="cantFact">
                                    Cantidad monetaria de la factural:
                                </label>
                            </div>
                            <div class="file-field input-field col s12 m6">
                                <div class="btn green">
                                    <span>Factura</span>
                                    <input type="file" id="archFact" required>
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" id="nombArchFact">
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
                <button type="button" class="waves-effect waves-green btn green darken-1"
                    onclick="agregarFacturaInforme();">Agregar</button>
            </div>
        </div>
    </form>
</div>