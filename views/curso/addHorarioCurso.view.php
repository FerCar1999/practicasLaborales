<div id="addHorarioCurso" class="modal modal-fixed-footer">
    <form id="frmAddHoraCurso" action="" class="add">
        <div class="modal-header green darken-1 white-text">
            <h5 class="mt-none mb-none">Agregar Horario Curso</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <input type="hidden" name="accion" id="accion" value="create">
                        <input type="hidden" name="codiCurs" id="codiCurs">
                        <div class="col s12 m6">
                            <label for="codiSalo">
                                Salon en el que se impartira el curso:
                            </label>
                            <select class="select-2 w-100" id="codiSalo" name="codiSalo">
                            </select>
                        </div>
                        <div class="col s12 m6">
                            <label for="codiDoce">
                                Docente que impartira el curso:
                            </label>
                            <select class="select-2 w-100" id="codiDoce" name="codiDoce">
                            </select>
                        </div>
                        <div class="col s12 m6">
                            <label for="codiDia">
                               Seleccione el dia para obtener su horario:
                            </label>
                            <select class="select-2 w-100" id="codiDia" name="codiDia" onchange="selectHorarios();">
                                <option value="0" selected disabled>Seleccione el dia:</option>
                                <option value="1">Lunes</option>
                                <option value="2">Martes</option>
                                <option value="3">Miercoles</option>
                                <option value="4">Jueves</option>
                                <option value="5">Viernes</option>
                                <option value="6">Sabado</option>
                                <option value="7">Domingo</option>
                            </select>
                        </div>
                        <div class="col s12 m6">
                            <label for="codiHora">
                                Horario en el que se impartira el curso:
                            </label>
                            <select class="select-2 w-100" id="codiHora" name="codiHora">
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div id="preloader" class="progress">
                <div class="indeterminate"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-close waves-effect btn-flat">Cancelar</button>
            <button type="button" class="waves-effect waves-green btn green darken-1" onclick="agregarHorario();">Agregar</button>
        </div>
    </form>
</div>
