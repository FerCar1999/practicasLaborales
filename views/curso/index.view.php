<?php
//Titulo de pagina
$title = "Cursos";
//Nombre de pagina
$page = "Cursos";
?>
<?php
//llamando el archivo head
include APP_PATH . '/views/templates/head.view.php' ?>
<?php
//llamando al archivo sidebar que es el que trae las diferentes opciones para los usuarios y controla el tiempo de sesion
include APP_PATH . '/views/templates/sidebar.view.php' ?>
<main>
    <div class="container-fluid">
        <div class="row col-sm-12">
            <div class="card box-shadow-md mt-none">
                <div class="card-content">
                    <div class="card-tabs">
                        <ul class="tabs tabs-fixed-width">
                            <li class="tab" id="casaLi">
                                <a class="active" href="#casa">
                                    Mis Cursos
                                </a>
                            </li>
                            <li class="tab" id="casasLi">
                                <a href="#casas">
                                    Cursos de  otras Casas
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-content grey lighten-4">
                        <div id="casa">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 center">
                                    <span class="card-title">
                                        Mis Cursos
                                    </span>
                                </div>
                            </div>
                            <table class="responsive-table hover no-wrap row-border striped" id="table-curso-casa" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            codiCate
                                        </th>
                                        <th>
                                            Categoria
                                        </th>
                                        <th>
                                            Nombre de Curso
                                        </th>
                                        <th>
                                            Fecha Inicio
                                        </th>
                                        <th>
                                            Fecha Fin
                                        </th>
                                        <th>
                                            Opciones
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                            <div class="fixed-action-btn">
                                <button class="btn modal-trigger waves-effect waves-circle waves-light btn-floating btn-large blue darken-2" data-target="addCurso">
                                    <i class="large material-icons">add</i>
                                </button>
                            </div>
                        </div>
                        <div id="casas">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 center">
                                    <span class="card-title">
                                        Cursos de otras Casas
                                    </span>
                                </div>
                            </div>
                            <table class="responsive-table hover no-wrap row-border striped" id="table-curso-casas" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            codiCate
                                        </th>
                                        <th>
                                            Categoria
                                        </th>
                                        <th>
                                            codiCasa
                                        </th>
                                        <th>
                                            Casa
                                        </th>
                                        <th>
                                            Nombre de Curso
                                        </th>
                                        <th>
                                            Fecha Inicio
                                        </th>
                                        <th>
                                            Fecha Fin
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
            </div>
        </div>
    </div>
</main>
<!-- Modal para agregar categoria -->
<?php include APP_PATH . '/views/curso/addCurso.view.php' ?>
<?php include APP_PATH . '/views/curso/addHorarioCurso.view.php' ?>
<?php include APP_PATH . '/views/curso/addHorarioCursoN.view.php' ?>
<?php include APP_PATH . '/views/curso/updateCurso.view.php' ?>
<?php include APP_PATH . '/views/curso/updateHorarioCurso.view.php' ?>
<?php include APP_PATH . '/views/curso/updateHorarioInfo.view.php' ?>
<!-- Modal para modificar categoria -->
<?php include APP_PATH . '/views/curso/deleteCurso.view.php' ?>
<?php include APP_PATH . '/views/curso/deleteHorarioCurso.view.php' ?>
<!-- Modal para eliminar categoria -->
<?php include APP_PATH . '/views/curso/verCurso.view.php' ?>
<!-- AJAX -->
<script src="<?= WEB_PATH ?>js/AJAX/curso.js">
</script>
<?php include APP_PATH . '/views/templates/footer.view.php' ?>
