<div class="modal modal-fixed-footer" id="verCurso">
    <div class="modal-header light-blue darken-1 white-text">
        <h5 class="mt-none mb-none">
            Informacion del Curso
        </h5>
        <i class="material-icons modal-close">
            close
        </i>
    </div>
    <div class="modal-content">
        <div class="row">
            <div class="col s12">
                <div class="row">
                    <input id="accion" name="accion" type="hidden" value="see"/>
                    <input id="codiCursSee" name="codiCursSee" type="hidden"/>
                    <div class="col s12 m12">
                        <p id="tituloCurso">
                            
                        </p>
                    </div>
                    <div class="col s12 m12">
                        <div class="row" id="rowProgreso">
                            <p class="col s9" id="progresoCurso">
                                Progreso del Curso
                            </p>
                            <p class="col s3 right-align" id="progresoCursoC">
                                
                            </p>
                        </div>
                        <div class="progress" id="progressAvance2">
                            <div class="determinate" id="determinateAvance">
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <p id="categoriaCurso">
                        </p>
                    </div>
                    <div class="col s12 m6 right-align">
                        <p id="fechasCursoInic">            
                        </p>
                        <p id="fechasCursoFin">
                        </p>
                    </div>
                    <div class="col s12 m12">
                        <ul class="collection with-header" name="maestros" id="maestros">
                            <li class='collection-header'><h5>Maestros del Curso</h5></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="modal-close waves-effect btn-flat" type="button">
            Cancelar
        </button>
    </div>
</div>