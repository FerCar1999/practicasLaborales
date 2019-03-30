<div id="updaCategoria" class="modal">
    <form id="frmUpdate" action="" class="update">
        <div class="modal-header blue darken-1 white-text">
            <h5 class="mt-none mb-none">Modificar Categoría</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <input type="hidden" id="codiCateUpda" name="codiCateUpda">
                        <input type="hidden" id="estaCateUpda" name="estaCateUpda">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">library_books</i>
                            <input id="nombCateUpda" name="nombCateUpda" type="text" class="validate">
                            <label for="nombCateUpda">Nombre de categoría:</label>
                            <span class="helper-text" data-error="Campo requerido, ingrese solo letras" data-success="Correcto"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="preloader2" class="progress">
                <div class="indeterminate"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-close waves-effect btn-flat">Cancelar</button>
            <button type="button" class="waves-effect waves-green btn blue darken-1" onclick="update();">Modificar</button>
        </div>
    </form>
</div>