<div class="modal modal-fixed-footer" id="updateCurso">
    <form action="" class="update" id="frmUpdaCurso">
        <div class="modal-header blue darken-1 white-text">
            <h5 class="mt-none mb-none">
                Modificar Curso
            </h5>
            <i class="material-icons modal-close">
                close
            </i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12 m12">
                        <div class="row" id="rowProgreso">
                            <p class="col s9" id="progresoCursoN">
                                Progreso del Curso
                            </p>
                            <p class="col s3 right-align" id="progresoCursoCN">

                            </p>
                        </div>
                        <div class="progress" id="progressAvance2N">
                            <div class="determinate" id="determinateAvanceN">
                            </div>
                        </div>
                </div>
                <div class="col s12">
                        <div class="row">
                            <input id="accion" name="accion" type="hidden" value="update"/>
                            <input id="codiCursUpda" name="codiCursUpda" type="hidden"/>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">
                                    library_books
                                </i>
                                <input class="validate" id="nombCursUpda" name="nombCursUpda" type="text"/>
                                <label for="nombCursUpda">
                                    Nombre del curso:
                                </label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">
                                    library_books
                                </i>
                                <input class="validate" id="corrCursUpda" name="corrCursUpda" type="text"/>
                                <label for="corrCursUpda">
                                    Correlativo del curso:
                                </label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">
                                    library_books
                                </i>
                                <input class="validate" id="cantPartUpda" name="cantPartUpda" type="text"/>
                                <label for="cantPartUpda">
                                    Cantidad de participantes:
                                </label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">
                                    library_books
                                </i>
                                <input class="validate" id="montEstiUpda" name="montEstiUpda" type="text"/>
                                <label for="montEstiUpda">
                                    Monto estimado de cobro:
                                </label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">
                                    date_range
                                </i>
                                <input class="datepicker" id="fechInicUpda" name="fechInicUpda" type="text"/>
                                <label for="fechInicUpda">
                                    Fecha de inicio:
                                </label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">
                                    date_range
                                </i>
                                <input class="datepicker" id="fechFinUpda" name="fechFinUpda" type="text"/>
                                <label for="fechFinUpda">
                                    Fecha de finalizacion:
                                </label>
                            </div>
                            <div class="col s12 m12">
                                <label for="codiCateUpda">
                                    Categoria del curso:
                                </label>
                                <select class="select-2 w-100" id="codiCateUpda" name="codiCateUpda">
                                </select>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-close waves-effect btn-flat" type="button">
                Cancelar
            </button>
            <button class="waves-effect waves-green btn blue darken-1" onclick="update();" type="button">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
