<div id="reporteCurso" class="modal modal-fixed-footer">
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
                            <input type="text" class="datepicker" name="fechInicRepoCurs" id="fechInicRepoCurs">
                            <label for="fechInicRepoCurs">Fecha desde:</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">date_range</i>
                            <input type="text" class="datepicker" name="fechFinaRepoCurs" id="fechFinaRepoCurs">
                            <label for="fechFinaRepoCurs">Fecha hasta:</label>
                        </div>
                        <div class="col s12 m6">
                            <label for="codiCateRepoCurs">Seleccione la categoria:
                                <select class="select-2 w-100" name="codiCateRepoCurs" id="codiCateRepoCurs" onchange="selectCursos();">
                                </select>
                            </label>
                        </div>
                        <div class="col s12 m6">
                            <label for="codiCursRepo">Seleccione el curso:
                                <select class="select-2 w-100" name="codiCursRepo" id="codiCursRepo">
                                </select>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-close waves-effect btn-flat">Cancelar</button>
            <button type="button" class="waves-effect waves-green btn red darken-1" onclick="generarReporteCurso();">Generar Reporte</button>
        </div>
    </form>
</div>