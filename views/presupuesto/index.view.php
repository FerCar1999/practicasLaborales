<?php
//Titulo de pagina
$title = "Presupuesto";
//Nombre de pagina
$page = "Presupuesto";
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
                                    Mi Presupuesto
                                </a>
                            </li>
                            <li class="tab" id="casasLi">
                                <a href="#casas">
                                    Presupuesto Casas
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-content grey lighten-4">
                        <div id="casa">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 center">
                                    <span class="card-title">
                                        Mi Presupuesto
                                    </span>
                                </div>
                                <div class="col-md-6 right"><a id="helperx" class="waves-effect waves-green btn-flat btn-small" href="../web/manuales/presupuesto.pdf" target="_blank"><i class="material-icons">help</i></a></div>
                            </div>
                            <div class="row center-align" id="modificarLogoCasa">
                                <div class="col s12">
                                    <a class="waves-effect waves-green btn green darken-2 modal-trigger" href="#addEgreso">
                                        Modificar Presupuesto
                                    </a>
                                </div>
                            </div>
                            <table class="responsive-table hover no-wrap row-border striped" id="table-presupuesto-casa" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            codi_cate
                                        </th>
                                        <th>
                                            Categoria
                                        </th>
                                        <th>
                                            Cantidad
                                        </th>
                                        <th>
                                            Fecha
                                        </th>
                                        <th>
                                            Opciones
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div id="casas">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 center">
                                    <span class="card-title">
                                        Presupuesto Casas
                                    </span>
                                </div>
                                <div class="col-md-6 right"><a id="helperx" class="waves-effect waves-green btn-flat btn-small" href="../web/manuales/presupuesto_casas.pdf" target="_blank"><i class="material-icons">help</i></a></div>
                            </div>
                            <div class="row center-align" id="agregarIngreso">
                                <div class="col s12">
                                    <a class="waves-effect waves-green btn green darken-2 modal-trigger" href="#addIngreso">
                                        Agregar Presupuesto
                                    </a>
                                </div>
                            </div>
                            <table class="responsive-table hover no-wrap row-border striped" id="table-presupuesto-casas" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Casa
                                        </th>
                                        <th>
                                            Cantidad Inicial
                                        </th>
                                        <th>
                                            Cantidad Restante
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
<?php include APP_PATH . '/views/presupuesto/addEgreso.view.php' ?>
<?php include APP_PATH . '/views/presupuesto/addIngreso.view.php' ?>
<!-- Modal para modificar categoria -->
<?php include APP_PATH . '/views/presupuesto/updateIngreso.view.php' ?>
<!-- Modal para eliminar categoria -->
<?php include APP_PATH . '/views/presupuesto/deleteEgreso.view.php' ?>
<?php include APP_PATH . '/views/presupuesto/deleteIngreso.view.php' ?>
<?php include APP_PATH . '/views/presupuesto/verEgresoCasa.view.php' ?>
<?php include APP_PATH . '/views/presupuesto/generarReporteFechas.view.php' ?>
<!-- AJAX -->
<script src="<?= WEB_PATH ?>js/AJAX/presupuesto.js">
</script>
<?php include APP_PATH . '/views/templates/footer.view.php' ?>
