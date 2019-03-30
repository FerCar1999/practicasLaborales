<div class="modal" id="updateCurso">
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
                <div class="col s12">
                    <ul class="tabs">
                        <li class="tab col s6">
                            <a class="active" href="#test1">
                                Información Basica
                            </a>
                        </li>
                        <li class="tab col s6">
                            <a href="#test2">
                                Horarios
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col s12">
                    <div id="test1">
                        <p></p>
                        <div class="row">
                            <input id="accion" name="accion" type="hidden" value="update"/>
                            <input id="codiCursUpda" name="codiCursUpda" type="hidden"/>
                            <div class="input-field col s12 m12">
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
                            <div class="col s12 m12 center">
                                <p>
                                </p>
                                <button class="waves-effect waves-green btn blue darken-1" onclick="update();" type="button">
                                    Modificar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12">
                    <div id="test2">
                        <div class="row">
                            <div class="col s12 m12">
                                <p>
                                </p>
                                <table class="responsive-table hover no-wrap row-border striped" id="table-horario-cursob-casa" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>
                                                Horario
                                            </th>
                                            <th>
                                                Lunes
                                            </th>
                                            <th>
                                                Martes
                                            </th>
                                            <th>
                                                Miercoles
                                            </th>
                                            <th>
                                                Jueves
                                            </th>
                                            <th>
                                                Viernes
                                            </th>
                                            <th>
                                                Sabado
                                            </th>
                                            <th>
                                                Domingo
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
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
    </form>
</div>
