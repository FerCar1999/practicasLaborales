<?php
date_default_timezone_set('America/El_Salvador');
//llamando archivos de configuracion y de usuario
require_once '../../config/app.php';
require_once APP_PATH . '/app/models/Usuario.php';
require_once '../../config/generatorPassword.php';
require '../../config/enviandoMail.php';
//activando una nueva sesion
session_start();
try {
    //inicializando la clase usuario
    $user = new Usuario;
    if (isset($_POST['tabla'])) {
        $data = null;
        if ($user->setCodiCasa($_SESSION['codi_casa'])) {
            $data = $user->getUsuariosCasa();
        }
        echo $data;
    }
    if (isset($_POST['tipo'])) {
        echo json_encode($_SESSION['codi_tipo_usua']);
    }
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'create':
                if ($user->setNombUsua($_POST['nombUsua'])) {
                    if ($user->setApelUsua($_POST['apelUsua'])) {
                        if ($user->setCorreUsua($_POST['correUsua'])) {
                            $val = $user->verificarCorreoExistente();
                            if ($val['conteo'] == 0) {
                                $pass     = new generatorPassword();
                                $password = $pass->generator();
                                if ($user->setContUsua($password)) {
                                    if ($user->setCodiCasa($_SESSION['codi_casa'])) {
                                        if ($user->setTipoUsua($_POST['codiTipoUsua'])) {
                                            if ($_POST['codiTipoUsua']!=3) {
                                                if ($user->setCodiCate(0)) {
                                                    if ($user->createUsuario()) {
                                                        if (enviandoCorreoCuenta($_POST['correUsua'], $_POST['nombUsua'] . ' ' . $_POST['apelUsua'], $password)) {
                                                            throw new Exception('Exito');
                                                        } else {
                                                            throw new Exception('Exito');
                                                        }
                                                    } else {
                                                        throw new Exception('No se pudo agregar el usuario');
                                                    }
                                                }
                                            } else {
                                                if ($user->setCodiCate($_POST['codiCateUsua'])) {
                                                    if ($user->createUsuario()) {
                                                        if (enviandoCorreoCuenta($_POST['correUsua'], $_POST['nombUsua'] . ' ' . $_POST['apelUsua'], $password)) {
                                                            throw new Exception('Exito');
                                                        } else {
                                                            throw new Exception('Exito');
                                                        }
                                                    } else {
                                                        throw new Exception('No se pudo agregar el usuario');
                                                    }
                                                } else {
                                                    throw new Exception("Debe agregar el programa al cual estara encargado");
                                                }
                                            }
                                        } else {
                                            throw new Exception("Seleccione el tipo de usuario");
                                        }
                                    } else {
                                        throw new Exception('Seleccione la casa');
                                    }
                                } else {
                                    throw new Exception('La contraseña debe tener una longitud mayor a 6 digitos');
                                }
                            } else {
                                throw new Exception('Ya existe un usuario con ese correo');
                            }

                        } else {
                            throw new Exception('Verifique el correo del usuario');
                        }
                    } else {
                        throw new Exception('Verifique el apellido del usuario');
                    }
                } else {
                    throw new Exception('Verifique el nombre del usuario');
                }
                break;
            case 'createPrimerUsuario':
                if ($user->setNombUsua($_POST['nombUsua'])) {
                    if ($user->setApelUsua($_POST['apelUsua'])) {
                        if ($user->setCorreUsua($_POST['correUsua'])) {
                            $val = $user->verificarCorreoExistente();
                            if ($val['conteo'] == 0) {
                                $pass     = new generatorPassword();
                                $password = $pass->generator();
                                if ($user->setContUsua($password)) {
                                    if ($user->setCodiCasa($_POST['codiCasa'])) {
                                        if ($user->setTipoUsua($_POST['codiTipoUsua'])) {
                                            if ($user->createUsuario()) {
                                                if (enviandoCorreoCuenta($_POST['correUsua'], $_POST['nombUsua'] . ' ' . $_POST['apelUsua'], $password)) {
                                                    throw new Exception('Exito');
                                                } else {
                                                    throw new Exception('Exito');
                                                }
                                            } else {
                                                $user->eliminandoCasaDefinitivo();
                                                throw new Exception('No se pudo agregar el usuario');
                                            }
                                        } else {
                                            throw new Exception("Seleccione el tipo de usuario");
                                        }
                                    } else {
                                        throw new Exception('Seleccione la casa');
                                    }
                                } else {
                                    throw new Exception('La contraseña debe tener una longitud mayor a 6 digitos');
                                }
                            } else {
                                throw new Exception('Ya existe un usuario con ese correo');
                            }

                        } else {
                            throw new Exception('Verifique el correo del usuario');
                        }
                    } else {
                        throw new Exception('Verifique el apellido del usuario');
                    }
                } else {
                    throw new Exception('Verifique el nombre del usuario');
                }
                break;
            case 'updateInfo':
                if ($user->setCodiUsua($_SESSION['codi_usua'])) {
                    if ($user->setNombUsua($_POST['nombUsuaUpda'])) {
                        if ($user->setApelUsua($_POST['apelUsuaUpda'])) {
                            if ($user->setCorreUsua($_POST['correUsuaUpda'])) {
                                $val = $user->verificarCorreoPropio();
                                if ($val['conteo'] == 1) {
                                    if ($user->updateInformacionUsuario()) {
                                        throw new Exception('Exito');
                                    } else {
                                        throw new Exception('No se pudo modificar el usuario');
                                    }

                                } else {
                                    $val2 = $user->verificarCorreoExistente();
                                    if ($val2['conteo'] == 0) {
                                        if ($user->updateInformacionUsuario()) {
                                            throw new Exception('Exito');
                                        } else {
                                            throw new Exception('No se pudo modificar el usuario');
                                        }
                                    } else {
                                        throw new Exception('Ya existe un usuario con ese correo');
                                    }
                                }

                            } else {
                                throw new Exception('Verifique el correo de usuario');
                            }
                        } else {
                            throw new Exception('Verifique el apellido del usuario');
                        }
                    } else {
                        throw new Exception('Verifique el nombre del usuario');
                    }
                } else {
                    throw new Exception('No se encontro el usuario');
                }
                break;
            case 'delete':
                if ($user->setCodiUsua($_POST['codiUsuaDele'])) {
                    if ($_POST['codiUsuaDele'] != $_SESSION['codi_usua']) {
                        if ($user->deleteUsuario()) {
                            throw new Exception('Exito');
                        } else {
                            throw new Exception('No se pudo eliminar el usuario');
                        }
                    } else {
                        throw new Exception('No se puede borrar a usted mismo');
                    }

                } else {
                    throw new Exception('No se encontro el usuario');
                }
                break;
            case 'updateContra':
                if ($user->setCodiUsua($_SESSION['codi_usua'])) {
                    $contraAntigua          = $user->verificarContraseniaAntigua();
                    if (password_verify($_POST['contAnti'],$contraAntigua['cont_usua'])) {
                        if ($_POST['contNuev'] == $_POST['contNuevVeri']) {
                            if ($_POST['contNuev'] != $_POST['contAnti']) {
                                if ($user->setContUsua($_POST['contNuev'])) {
                                    if ($user->updateContraUsuario()) {
                                        if (enviandoCorreoCuentaModificaContra($_POST['correUsuaUpda'], $_POST['nombUsuaUpda'] . ' ' . $_POST['apelUsuaUpda'], $_POST['contNuev'])) {
                                                    throw new Exception('Exito');
                                                } else {
                                                    throw new Exception('Exito');
                                                }
                                    } else {
                                        throw new Exception("No se pudo modificar la contraseña");
                                    }
                                } else {
                                    throw new Exception("La contraseña debe ser mayor a 6 digitos");
                                }
                            } else {
                                throw new Exception("La contraseña nueva no puede ser igual a la antigua");
                            }
                        } else {
                            throw new Exception("Las contraseñas no concuerdan entre si");
                        }
                    } else {
                        throw new Exception("La contraseña antigua ingresada no es correcta");
                    }
                }
                break;
            case 'updateContraOlvidada':
                if ($user->setCorreUsua($_POST['corrOlvi'])) {
                    $resp = $user->verificarCorreoExistente();
                    if ($resp['conteo'] == 1) {
                        $pass     = new generatorPassword();
                        $password = $pass->generator();
                        if ($user->setContUsua($password)) {
                            if ($user->updateContraUsuarioCorreo()) {
                                if (enviandoCorreoCuentaCambioContrasenia($_POST['corrOlvi'], null, $password)) {
                                    throw new Exception("Exito");
                                } else {
                                    throw new Exception("Hemos tenido un problema al enviarle el correo. Favor anote la contraseña : ". $password);
                                }
                            } else {
                                throw new Exception("No se pudo generar a nueva contraseña. Intentelo más tarde");
                            }
                        }
                    } else {
                        throw new Exception("El correo ingresado no ha sido encontrado");
                    }
                } else {
                    throw new Exception("Verifique el correo ingresado");
                }
                break;
            case 'verficandoExistenciaUsuarios':
                $respuesta = $user->verificarExistenciaUsuarios();
                echo json_encode($respuesta['cantidad']);
                break;
            case 'login':
                if ($user->setCorreUsua($_POST['corrUsua'])) {
                    if ($user->setContUsua($_POST['contUsua'])) {
                        if ($user->checkUser()) {
                            if ($user->checkPassword()) {
                                $_SESSION['codi_usua']      = $user->getCodiUsua();
                                $_SESSION['nomb_usua']      = $user->getNombUsua() . ' ' . $user->getApelUsua();
                                $_SESSION['codi_tipo_usua'] = $user->getTipoUsua();
                                $_SESSION['codi_casa']      = $user->getCodiCasa();
                                $_SESSION['nomb_casa']      = $user->getNombCasa();
                                $_SESSION['logo_casa']      = $user->getLogoCasa();
                                $_SESSION['codi_tipo_casa'] = $user->getCodiTipoCasa();
                                $_SESSION['codi_cate'] = $user->getCodiCate();
                                throw new Exception("Exito");
                            } else {
                                throw new Exception("Verifique sus credenciales");
                            }

                        } else {
                            throw new Exception("Verifique sus credenciales");
                        }
                    } else {
                        throw new Exception("Verifique la contraseña ingresada");
                    }
                } else {
                    throw new Exception("Verifique el correo ingresado");
                }
                break;
            case 'logout':
                if ($user->logOut()) {
                    throw new Exception("Exito");
                } else {
                    throw new Exception("Error");
                }
                break;
            case 'infoUsua':
                $data = null;
                if ($user->setCodiUsua($_SESSION['codi_usua'])) {
                    $data = $user->getInfoUsuario();
                }
                echo json_encode($data);
                break;
        }
    }
} catch (Exception $error) {
    echo json_encode($error->getMessage());
}
