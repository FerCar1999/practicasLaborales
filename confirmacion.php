<?php
require_once 'config/app.php';
require_once APP_PATH . '/app/models/EventoDetalle.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmación de Evento</title>
    <link rel="stylesheet" href="web/css/materialize.min.css">
    <link rel="stylesheet" href="web/css/material-icons.css">
    <script src="web/js/jquery.min.js"></script>
    <script src="web/js/materialize.min.js"></script>
    <script src="web/js/sweetalert2.js"></script>
</head>

<body class="grey lighten-3">
    <?php
    try {
        $eventodetalle = new EventoDetalle;
        $eventod = $eventodetalle->infoEventoDetalle($_GET['token']);
        if ($eventodetalle->setCodiEven($eventod['codi_even'])) { }

        $evento = $eventodetalle->infoEvento();
        if (isset($_GET['token'])) {
            print '
            <div class="row">
                <div class="col m1 l1"></div>
                <div class="col s12 m10 l10">
                    <div class="card-panel white">
                        <div class="row">
                            <div class="col m4 l4"></div>
                            <div class="col s12 m4">
                                <center>
                                <img width="60%" src="logos/RICALDONE.png">
                                </center>
                            </div>
                            <div class="col m4 l4"></div>
                            <div class="col s12 m12 center-align">
                                <h5>Te invita:</h5>
                                <center>
                                    <img width="53%" class="materialboxed" src="web/eventos/' . $evento['foto_even'] . '">
                                </center>
                                <br>
                                <a id="boton" class="waves-effect waves-light btn blue" onClick="confirmar(\'' . $_GET['token'] . '\');">Confirmar Asistencia</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col m1 l1"></div>
            </div>
                ';
        } else { }
    } catch (Exception $error) {
        //enviando el mensaje ya sea de exito o de error en json
        echo json_encode($error->getMessage());
    }

    ?>
    <script>
        $(document).ready(function() {
            $('.materialboxed').materialbox();
        });

        function confirmar(token) {
            $.ajax({
                url: 'app/controllers/EventoDetalleController',
                method: 'POST',
                data: {
                    accion: 'confirmacion',
                    token: token
                },
                success: function(data) {
                    var resp = data.indexOf("Exito");
                    if (resp >= 0) {
                        Swal.fire({
                            type: 'success',
                            title: 'Asistencia confirmada con exito',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $("#boton").hide();
                    } else {
                        M.toast({
                            html: JSON.parse(data)
                        });
                    }
                }
            })
        }
    </script>
</body>

</html>