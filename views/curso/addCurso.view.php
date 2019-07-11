<div id="addCurso" class="modal">
    <form id="frmAddCurso" action="" class="add">
        <div class="modal-header green darken-1 white-text">
            <h5 class="mt-none mb-none">Agregar Curso</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <input type="hidden" name="accion" id="accion" value="create">
                        <div class="input-field col s12 m12">
                            <i class="material-icons prefix">library_books</i>
                            <input id="nombCurs" name="nombCurs" type="text" class="validate">
                            <label for="nombCurs">Nombre del curso:</label>
                        </div>
                        <div class="input-field col s12 m6">
                                <i class="material-icons prefix">
                                    library_books
                                </i>
                                <input class="validate" id="cantPart" name="cantPart" type="text"/>
                                <label for="cantPart">
                                    Cantidad de participantes:
                                </label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">
                                    library_books
                                </i>
                                <input class="validate" id="montEsti" name="montEsti" type="text"/>
                                <label for="montEsti">
                                    Monto estimado de cobro:
                                </label>
                            </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">date_range</i>
                            <input type="text" class="datepicker" name="fechInic" id="fechInic">
                            <label for="fechInic">Fecha de inicio:</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">date_range</i>
                            <input type="text" class="datepicker" name="fechFin" id="fechFin">
                            <label for="fechFin">Fecha de finalizacion:</label>
                        </div>
                        <div class="col s12 m12">
                            <label for="codiCate">
                                Categoria del curso:
                            </label>
                            <select class="select-2 w-100" id="codiCate" name="codiCate">
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
            <button type="button" class="waves-effect waves-green btn green darken-1" onclick="create();">Agregar</button>
        </div>
    </form>
</div>