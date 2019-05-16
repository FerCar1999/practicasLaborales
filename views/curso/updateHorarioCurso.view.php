<div id="updateHorarioCurso" class="modal">
    <form id="frmUpdaHoraCurso" action="" class="update">
        <div class="modal-header blue darken-1 white-text">
            <h5 class="mt-none mb-none">Horarios del Curso</h5>
            <i class="material-icons modal-close" onclick="limpiarTablaHorario()">close</i>
        </div>
        <div class="modal-content">
          <div class="row">
            <input type="hidden" name="codiCursHoraMod" id="codiCursHoraMod">
            <div class="col s12 m12">
              <label for="codiDia">
                 Seleccione un dia para obtener su horario:
              </label>
              <select class="select-2 w-100" id="codiDiaHoraCurs" name="codiDiaHoraCurs" onchange="selectHorarioCurso();">
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
              <div class="col s12 m12" id="tablaHoraN" name="tablaHoraN">
                  <table class="responsive-table hover no-wrap row-border striped" id="table-horario-curso-casax" style="width:100%">
                      <thead>
                          <tr>
                            <th>
                              codi_inter_hora_doce
                            </th>
                            <th>
                              codi_inte_curs_salo
                            </th>
                            <th>
                              codi_salo
                            </th>
                            <th>
                              codi_doce
                            </th>
                            <th>
                              codi_dia
                            </th>
                            <th>
                              codi_hora
                            </th>
                              <th>
                                  Hora Inicio
                              </th>
                              <th>
                                  Hora Fin
                              </th>
                              <th>
                                  Información
                              </th>
                              <th>
                                  Opciones
                              </th>
                          </tr>
                      </thead>
                  </table>
              </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-close waves-effect btn-flat" onclick="limpiarTablaHorario()">Cancelar</button>
            <button type="button" class="waves-effect btn green darken-1 modal-trigger" data-target="addHorarioCursoN" onclick="sendCodiCurs();">Agregar Horario</button>
        </div>
    </form>
</div>
