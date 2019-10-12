<div id="addEventoDetalle" class="modal modal-fixed-footer">
    <div class="modal-header green darken-1 white-text">
        <h5 class="mt-none mb-none">Registro de Invitados</h5>
        <i class="material-icons modal-close">close</i>
    </div>
    <div class="modal-content">
        <div class="row col-sm-12">
            <div class="card box-shadow-md mt-none">
                <div class="card-content">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 center">
                            <span class="card-title">Registro de Invitados</span>
                        </div>
                    </div>
                    <input type="hidden" name="codiInviX" id="codiInviX">
                    <table class="responsive-table hover no-wrap row-border striped" id="table-evento-detalle" style="width:100%">
                        <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Nombre de Invitado
                                </th>
                                <th>
                                    Empresa
                                </th>
                                <th>
                                    Telefonos
                                </th>
                                <th>
                                    Etiqueta de Invitado
                                </th>
                                <th>Confirmacion</th>
                                <th>
                                    Asistencia
                                </th>
                                <th>
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="modal-close waves-effect btn-flat">Cancelar</button>
        <button type="button" class="waves-effect btn green darken-1 modal-trigger" data-target="addInvitado" onclick="enviarCodigoEvento();">Agregar Invitado</button>
        <button type="button" class="waves-effect btn green darken-1" onclick="enviarInvitaciones();">Enviar Invitaciones</button>
    </div>
</div>