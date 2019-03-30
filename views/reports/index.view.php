<?php
$title = "Reportes";
$page = "Reportes";
$active = "reports";
?>
<?php include APP_PATH . '/views/templates/head.view.php' ?>
<?php include APP_PATH . '/views/templates/header.view.php' ?>

<?php include APP_PATH . '/views/templates/sidebar.view.php' ?>
<script src="<?= WEB_PATH ?>js/reports.js"></script>

<main>
    <div class="container-fluid">
        <div class="row col s12">
            <div class="card box-shadow-md mt-none">
                <div class="card-content">
                    
                    <ul id="tabsReports" class="tabs">
                        <li class="tab col s3"><a href="#medico" class="active">Reporte Encefalograma</a></li>
                        <li class="tab col s3"><a href="#paciente">Reporte Neurofisiologia</a></li>
                        <li class="tab col s3"><a href="#historico">Reporte General</a></li>
                    </ul>
                    <div class="row">
                        <div id="medico" class="col s12">
                            <div class="row">
                                <div class="card">
                                    <span class="card-title center-align">Reporte general de medico de Encefalograma</span>
                                    <div class="card-content ">
                                        <form id="enceRep">
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <?php
                                                    print("<select class='select2 w-100' name='$name1' id='$name1' style='width: 100%' required>");
                                                    if ($data1) {
                                                        if (!$value1) {
                                                            print("<option value='' disabled selected>Seleccione una opción</option>");
                                                        }
                                                        foreach ($data1 as $row1) {
                                                            if ($value1 == $row1[0]) {
                                                                print("<option value='$row1[0]' selected>$row1[1]"." "."$row1[2]</option>");
                                                            } else {
                                                                print("<option value='$row1[0]'>$row1[1]"." "."$row1[2]</option>");
                                                            }
                                                        }
                                                    } else {
                                                        print("<option value='' disabled selected>No hay opciones disponibles</option>");
                                                    }
                                                    print("</select>");
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12 m6">
                                                    <input type="text" name="fechaEnce2" id="fechaEnce1" class="datepicker">
                                                    <label for="fechaInicio">Fecha de inicio:</label>
                                                </div>
                                                <div class="input-field col s12 m6">
                                                    <input type="text" name="fechaEnce2" id="fechaEnce2" class="datepicker">
                                                    <label for="fechaFin">Fecha de fin:</label>
                                                </div>         
                                            </div>
                                            <div class="row">
                                                <button class="waves-effect waves-green btn green darken-1" type="button" name="ence" id="ence" onClick="reportEnce();">Generar reporte</button>
                                            </div>  
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="paciente" class="col s12">
                            <div class="row">
                                <div class="card">
                                    <span class="card-title center-align">Reporte general del medico de Neurofisiologia</span>
                                    <div class="card-content ">
                                        <form id="neuroRep">
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <?php
                                                    print("<select class='select2 w-100' name='$name2' id='$name2' style='width: 100%' required>");
                                                    if ($data2) {
                                                        if (!$value2) {
                                                            print("<option value='' disabled selected>Seleccione una opción</option>");
                                                        }
                                                        foreach ($data2 as $row2) {
                                                            if ($value2 == $row2[0]) {
                                                                print("<option value='$row2[0]' selected>$row2[1]"." "."$row2[2]</option>");
                                                            } else {
                                                                print("<option value='$row2[0]'>$row2[1]"." "."$row2[2]</option>");
                                                            }
                                                        }
                                                    } else {
                                                        print("<option value='' disabled selected>No hay opciones disponibles</option>");
                                                    }
                                                    print("</select>");
                                                    ?>
                                                    </div>
                                                <div class="input-field col s12 m6">
                                                    <input type="text" name="fechaNeuro1" id="fechaNeuro1" class="datepicker">
                                                    <label for="fechaInicio">Fecha de inicio:</label>
                                                </div>
                                                <div class="input-field col s12 m6">
                                                    <input type="text" name="fechaNeuro2" id="fechaNeuro2" class="datepicker">
                                                    <label for="fechaFin">Fecha de fin:</label>
                                                </div>                                                
                                            </div>
                                            <div class="row">
                                                <button class="waves-effect waves-green btn green darken-1" type="button" name="neuro" id="neuro" onClick="reportNeuro();">Generar reporte</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="historico" class="col s12">
                            <div class="row">
                                <div class="card">
                                    <span class="card-title center-align">Reporte general</span>
                                    <div class="card-content ">
                                        <form id="generalRep">
                                            <div class="row">
                                                <div class="input-field col s12 m6">
                                                    <input type="text" name="fechaInicio" id="fechaGeneral1" class="datepicker">
                                                    <label for="fechaInicio">Fecha de inicio:</label>
                                                </div>
                                                <div class="input-field col s12 m6">
                                                    <input type="text" name="fechaFin" id="fechaGeneral2" class="datepicker">
                                                    <label for="fechaFin">Fecha de fin:</label>
                                                </div>    
                                            </div>
                                            <div class="row">
                                                <button class="waves-effect waves-green btn green darken-1" type="button" name="general" id="general" onClick="reportGeneral();">Generar reporte</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                </div>
            </div>
        </div>
    </div>
</main>

<script src="<?= WEB_PATH ?>js/reports.js"></script>

<?php include APP_PATH . '/views/templates/footer.view.php' ?>