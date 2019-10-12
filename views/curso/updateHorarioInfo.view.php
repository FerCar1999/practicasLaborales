<div id="updateHorarioCursoInfo" class="modal">
    <form id="frmUpdaHoraCursoInfo" action="" class="update">
        <div class="modal-header blue darken-1 white-text">
            <h5 class="mt-none mb-none">Horarios del Curso</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
          <div class="row">
              <div class="col s12">
                <div class="row">
                    <input type="hidden" name="accion" id="accion" value="update">
                    <input type="hidden" name="codiInteHoraDoceUpda" id="codiInteHoraDoceUpda">
                    <input type="hidden" name="codiInteCursSaloUpda" id="codiInteCursSaloUpda">
                    <div class="col s12 m6">
                        <label for="codiSaloUpda">
                            Salon en el que se impartira el curso:
                        </label>
                        <select class="select-2 w-100" id="codiSaloUpda" name="codiSaloUpda">
                        </select>
                    </div>
                    <div class="col s12 m6">
                        <label for="codiDoceUpda">
                            Docente que impartira el curso:
                        </label>
                        <select class="select-2 w-100" id="codiDoceUpda" name="codiDoceUpda">
                        </select>
                    </div>
                    <div class="col s12 m6">
                        <label for="codiDiaUpda">
                           Seleccione el dia para obtener su horario:
                        </label>
                        <select class="select-2 w-100" id="codiDiaUpda" name="codiDiaUpda" onchange="selectHorariosU();">
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
                        <label for="codiHoraUpda">
                            Horario en el que se impartira el curso:
                        </label>
                        <select class="select-2 w-100" id="codiHoraUpda" name="codiHoraUpda">
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
            <button type="button" class="waves-effect waves-green btn blue darken-1" onclick="updateHorario();">Guardar Cambios</button>
        </div>
    </form>
</div>
