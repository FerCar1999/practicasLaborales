<div id="reporteEvento" class="modal modal-fixed-footer">
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
                            <label for="codiEvenRepo">Seleccione el evento:
                                <select class="select-2 w-100" name="codiEvenRepo" id="codiEvenRepo" onchange="selectEtiquetaEventosE();">
                                </select>
                            </label>
                        </div>
                        <div class="col s12 m12">
                            <label for="codiEtiqRepoEven">Seleccione la etiqueta:
                                <select multiple class="select-2 w-100" name="codiEtiqRepoEven" id="codiEtiqRepoEven">
                                </select>
                            </label>
                            <a onclick="selectTodos('codiEtiqRepoEven');"">Seleccionar todos</a>
                        </div>
                        <div id="tablaEven">
                                <table id="tablitaEven">
                                    <thead>
                                        <tr>
                                            <th>Nombre de Contacto</th>
                                            <th>Empresa de Contacto</th>
                                            <th>Confirmacion</th>
                                            <th>Asistencia</th>
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
            <button type="button" class="waves-effect waves-green btn red darken-1" onclick="reporteEvento();">Generar Reporte</button>
        </div>
    </form>
</div>