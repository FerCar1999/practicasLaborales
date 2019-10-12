<div id="reporteDocente" class="modal modal-fixed-footer">
    <form id="frmReporte" action="" class="add">
        <div class="modal-header red darken-1 white-text">
            <h5 class="mt-none mb-none">Generar Reporte</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">date_range</i>
                            <input type="text" class="datepicker" name="fechInicRepoDoce" id="fechInicRepoDoce">
                            <label for="fechInicRepoDoce">Fecha desde:</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">date_range</i>
                            <input type="text" class="datepicker" name="fechFinaRepoDoce" id="fechFinaRepoDoce">
                            <label for="fechFinaRepoDoce">Fecha hasta:</label>
                        </div>
                        <div class="col s12 m12">
                            <label for="codiDoceRepo">Seleccione el docente:
                                <select class="select-2 w-100" name="codiDoceRepo" id="codiDoceRepo">
                                </select>
                            </label>
                        </div>
                        <div id="tablaDoce">
                            <table id="tablitaDoce">
                                <thead>
                                    <tr>
                                        <th>Día</th>
                                        <th>Horario</th>
                                        <th>Salón</th>
                                        <th>Curso</th>
                                        <th>Estado del Curso</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div id="tabla2Doce">
                            <table id="tablita2Doce">
                                <thead>
                                    <tr>
                                        <th>Día</th>
                                        <th>Horario</th>
                                        <th>Salón</th>
                                        <th>Curso</th>
                                        <th>Docente</th>
                                        <th>Estado del Curso</th>
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
            <button type="button" class="waves-effect waves-green btn red darken-1" onclick="generarReporteDocente();">Generar Reporte</button>
            <button type="button" class="waves-effect waves-green btn red darken-1" onclick="generarReporteCompletoDocente();">Mostrar Todos</button>
        </div>
    </form>
</div>