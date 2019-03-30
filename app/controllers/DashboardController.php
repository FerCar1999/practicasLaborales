<?php
require_once '../../config/app.php';
date_default_timezone_set('America/El_Salvador');
require_once APP_PATH . '/app/models/Quotes.php';
try {
    $quotes = new Quotes;
    $hoy    = date("Y-m-d");
    if (isset($_POST['tabla'])) {
        if ($quotes->setFechCita($hoy)) {
            $data = $quotes->getQuotes();
            echo $data;
        } else {
            throw new Exception('Fechas Error');
        }
    }
    if (isset($_POST['acci'])) {
        switch ($_POST['acci']) {
            case '1':
                if ($quotes->setCodiCita($_POST['codi'])) {
                    if ($quotes->setEstaCita(1)) {
                        if ($quotes->updateEstadoCita()) {
                            throw new Exception('Exito');
                        } else {
                            throw new Exception('No se pudo realizar');
                        }
                    }
                }
                break;
            case '2':
                if ($quotes->setCodiCita($_POST['codi'])) {
                    if ($quotes->setEstaCita(2)) {
                        if ($quotes->updateEstadoCita()) {
                            throw new Exception('Exito');
                        } else {
                            throw new Exception('No se pudo realizar');
                        }
                    }
                }
                break;
            case '3':
                if ($quotes->setEstaCita(1)) {
                    if ($quotes->setFechCita($_POST['fech'])) {
                        switch ($_POST['tipo']) {
                            case '1':
                                # code...
                                break;
                            case '2':
                                switch ($_POST['esta']) {
                                    case '1':
                                        # code...
                                        break;
                                    case '2':
                                        # code...
                                        break;
                                }
                                break;
                        }
                    }
                }
                break;
        }
    }
} catch (Exception $error) {
    echo json_encode($error->getMessage());
}
