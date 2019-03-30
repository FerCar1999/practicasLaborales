<div class="modal" id="addHorario">
    <form action="" class="add" id="frmAdd">
        <div class="modal-header green darken-1 white-text">
            <h5 class="mt-none mb-none">
                Agregar Horario
            </h5>
            <i class="material-icons modal-close">
                close
            </i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <div class="col s12">
                            <select class="select2 w-100" id="codiDia" name="codiDia">
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
                            <input class="timepicker" id="horaInic" name="horaInic" type="text">
                                <label for="horaInic">
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
                            <input class="timepicker" id="horaFin" name="horaFin" type="text">
                                <label for="horaFin">
                                    Hora de finalización:
                                </label>
                                <span class="helper-text" data-error="Error campo requerido, ingrese una hora (00:00)" data-success="Correcto">
                                </span>
                            </input>
                        </div>
                    </div>
                </div>
            </div>
            <div class="progress" id="preloader">
                <div class="indeterminate">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-close waves-effect btn-flat" type="button">
                Cancelar
            </button>
            <button class="waves-effect waves-green btn green darken-1" onclick="create();" type="button">
                Agregar
            </button>
        </div>
    </form>
</div>
