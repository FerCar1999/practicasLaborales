<?php
$title = "Horarios";
$page = "Horarios";
?>
<?php include APP_PATH . '/views/templates/head.view.php' ?>

<?php include APP_PATH . '/views/templates/sidebar.view.php' ?>

<main>
    <div class="container-fluid">
        <div class="row col-sm-12">
            <div class="card box-shadow-md mt-none">
                <div class="card-content">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <span class="card-title center">Registro de Horarios</span>
                        </div>
                        <div class="col-md-6 right"><a id="helperx" class="waves-effect waves-green btn-flat btn-small" href="../web/manuales/horario.pdf" target="_blank"><i class="material-icons">help</i></a></div>
                    </div>
                    <table id="table-horario" class="responsive-table hover no-wrap row-border striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>CodiDia</th>
                                <th>Dia</th>
                                <th>Hora de inicio</th>
                                <th>Hora de finalización</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Agregar registro -->
    <div class="fixed-action-btn">
        <button class="btn modal-trigger waves-effect waves-circle waves-light btn-floating btn-large blue darken-2" data-target="addHorario">
            <i class="large material-icons">add</i>
        </button>
    </div>

    <!-- Modal para agregar Referencia -->
    <?php include APP_PATH . '/views/horario/addHorario.view.php' ?>
    <!-- Modal para modificar Referencia -->
    <?php include APP_PATH . '/views/horario/updateHorario.view.php' ?>
    <!-- Modal para eliminar Referencia -->
    <?php include APP_PATH . '/views/horario/deleteHorario.view.php' ?>
</main>
<script type="text/javascript">
    $(document).ready(function() {
        $('.timepicker').timepicker({
        i18n: {
            cancel: 'Cancelar',
            clear: 'Limpiar',
            done: 'OK'
        },
        twelveHour: false,
        container: 'body'
    });
            //inicializando select 2
    $('.select2').select2();
});
</script>
<script src="<?= WEB_PATH ?>js/AJAX/horario.js"></script>
<?php include APP_PATH . '/views/templates/footer.view.php' ?>
