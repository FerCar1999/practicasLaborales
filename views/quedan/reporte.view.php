<div id="reporteQuedan" class="modal modal-fixed-footer">
    <form id="frmReporte" action="" class="add">
        <div class="modal-header red darken-1 white-text">
            <h5 class="mt-none mb-none">Generar Reporte</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <input type="hidden" name="accion" value="reporte">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">date_range</i>
                            <input type="text" class="datepicker" name="fechInicRepoQued" id="fechInicRepoQued">
                            <label for="fechInicRepoQued">Fecha desde:</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">date_range</i>
                            <input type="text" class="datepicker" name="fechFinaRepoQued" id="fechFinaRepoQued">
                            <label for="fechFinaRepoQued">Fecha hasta:</label>
                        </div>
                        <div class="col s12 m12">
                            <label for="codiQuedRepo">Seleccione el quedan:
                                <select class="select-2 w-100" name="codiQuedRepo" id="codiQuedRepo">
                                </select>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="tablaQued">
                    <table id="tablitaQued">
                        <thead>
                            <tr>
                                <th>Numero de Factura</th>
                                <th>Nombre del Curso</th>
                                <th>Correlativo del Curso</th>
                                <th>Casa del Curso</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-close waves-effect btn-flat">Cancelar</button>
            <button type="button" class="waves-effect waves-green btn red darken-1" onclick="generarReporteQuedan();">Generar Reporte</button>
        </div>
    </form>
</div>