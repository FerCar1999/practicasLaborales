<div id="addHorarioCursoN" class="modal">
    <form id="frmAddHoraCursoN" action="" class="add">
        <div class="modal-header green darken-1 white-text">
            <h5 class="mt-none mb-none">Agregar Horario Curso</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <input type="hidden" name="accion" id="accion" value="createN">
                        <input type="hidden" name="codiCursN" id="codiCursN">
                        <div class="col s12 m6">
                            <label for="codiSaloN">
                                Salon en el que se impartira el curso:
                            </label>
                            <select class="select-2 w-100" id="codiSaloN" name="codiSaloN">
                            </select>
                        </div>
                        <div class="col s12 m6">
                            <label for="codiDoceN">
                                Docente que impartira el curso:
                            </label>
                            <select class="select-2 w-100" id="codiDoceN" name="codiDoceN">
                            </select>
                        </div>
                        <div class="col s12 m6">
                            <label for="codiDiaN">
                               Seleccione el dia para obtener su horario:
                            </label>
                            <select class="select-2 w-100" id="codiDiaN" name="codiDiaN" onchange="selectHorariosN();">
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
                            <label for="codiHoraN">
                                Horario en el que se impartira el curso:
                            </label>
                            <select class="select-2 w-100" id="codiHoraN" name="codiHoraN">
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
            <button type="button" class="waves-effect waves-green btn green darken-1" onclick="agregarHorarioN();">Agregar</button>
        </div>
    </form>
</div>
