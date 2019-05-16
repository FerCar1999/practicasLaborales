<div id="updaHorario" class="modal">
    <form action="" class="update" id="frmUpdate">
        <div class="modal-header blue darken-1 white-text">
            <h5 class="mt-none mb-none">Modificar Horario</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                <input type="hidden" id="codiHoraUpda" name="codiHoraUpda">
                    <div class="row">
                        <div class="col s12">
                            <select class="select2 w-100" id="codiDiaUpda" name="codiDiaUpda">
                                    <option value="0" selected disabled>Seleccione un dia</option>
                                    <option value="1">Lunes</option>
                                    <option value="2">Martes</option>
                                    <option value="3">Miercoles</option>
                                    <option value="4">Jueves</option>
                                    <option value="5">Viernes</option>
                                    <option value="6">Sabado</option>
                                    <option value="7">Domingo</option>
                                </select>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">
                                timer
                            </i>
                            <input class="timepicker" id="horaInicUpda" name="horaInicUpda" type="text">
                                <label for="horaInicUpda">
                                    Hora de inicio:
                                </label>
                                <span class="helper-text" data-error="Error campo requerido, ingrese una hora (00:00)" data-success="Correcto">
                                </span>
                            </input>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">
                                timer_off
                            </i>
                            <input class="timepicker" id="horaFinUpda" name="horaFinUpda" type="text">
                                <label for="horaFinUpda">
                                    Hora de finalización:
                                </label>
                                <span class="helper-text" data-error="Error campo requerido, ingrese una hora (00:00)" data-success="Correcto">
                                </span>
                            </input>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <div class="modal-footer">
            <button class="modal-close waves-effect btn-flat">Cancelar</button>
            <button type="button" onclick="update();" class="waves-effect waves-green btn blue darken-1">Modificar</button>
        </div>
    
</div>