<div id="fechasReporte" class="modal">
    <form id="frmRepo" action="">
        <div class="modal-header red darken-4 white-text">
            <h5 class="mt-none mb-none">Seleccione Fechas</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12 m6">
                    <label for="fechInic">Ingrese la fecha inicial:</label>
                    <input type="text" class="datepicker" name="fechInic" id="fechInic">
                </div>
                <div class="col s12 m6">
                    <label for="fechFin">Ingrese la fecha final:</label>
                    <input type="text" class="datepicker" name="fechFin" id="fechFin">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-close waves-effect btn-flat">Cancelar</button>
            <button type="button" class="waves-effect waves-green btn red darken-1" onclick="generarReporte();">Generar Reporte</button>
        </div>
    </form>
</div>