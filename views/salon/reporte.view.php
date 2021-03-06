<div id="reporteSalon" class="modal modal-fixed-footer">
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
                        <div class="col s12 m12">
                            <label for="codiSaloRepo">Seleccione el salón:
                                <select class="select-2 w-100" name="codiSaloRepo" id="codiSaloRepo">
                                </select>
                            </label>
                        </div>
                        <div id="tablaSalo">
                            <table id="tablitaSalo">
                                <thead>
                                    <tr>
                                        <th>Día</th>
                                        <th>Horario</th>
                                        <th>Curso</th>
                                        <th>Docente</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div id="tabla2Salo">
                            <table id="tablita2Salo">
                                <thead>
                                    <tr>
                                        <th>Día</th>
                                        <th>Horario</th>
                                        <th>Salón</th>
                                        <th>Curso</th>
                                        <th>Docente</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-close waves-effect btn-flat">Cancelar</button>
            <button type="button" class="waves-effect waves-green btn red darken-1" onclick="generarReporteSalon();">Generar Reporte</button>
            <button type="button" class="waves-effect waves-green btn red darken-1" onclick="generarReporteCompletoSalon();">Mostrar Todos</button>
        </div>
    </form>
</div>