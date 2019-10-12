<div id="reporteFactura" class="modal modal-fixed-footer">
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
                            <input type="text" class="datepicker" name="fechInicRepoFact" id="fechInicRepoFact">
                            <label for="fechInicRepoFact">Fecha desde:</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">date_range</i>
                            <input type="text" class="datepicker" name="fechFinaRepoFact" id="fechFinaRepoFact">
                            <label for="fechFinaRepoFact">Fecha hasta:</label>
                        </div>
                        <div class="col s12 m6">
                            <label for="codiCateRepoFact">Seleccione la categoria:
                                <select class="select-2 w-100" name="codiCateRepoFact" id="codiCateRepoFact" onchange="selectFacturas();">
                                </select>
                            </label>
                        </div>
                        <div class="col s12 m6">
                            <label for="codiFactRepo">Seleccione la factura:
                                <select class="select-2 w-100" name="codiFactRepo" id="codiFactRepo">
                                </select>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="tablaFact">
                    <table id="tablitaFact">
                        <thead>
                            <tr>
                                <th>Correlativo del Curso</th>
                                <th>Nombre del Curso</th>
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
            <button type="button" class="waves-effect waves-green btn red darken-1" onclick="generarReporteFactura();">Generar Reporte</button>
        </div>
    </form>
</div>