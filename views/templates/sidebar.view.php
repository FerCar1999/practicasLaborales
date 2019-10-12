<?php
//definiendo el maximo tiempo de una sesion (segundos*cantidad de minutos)
define('MAX_SESSION_TIME', 60 * 60);
//verificando la existencia de las variables de sesion importantes
if (isset($_SESSION['codi_usua']) && isset($_SESSION['codi_tipo_usua'])) {
    //verificando si existe la variable de sesion de ultima actividad y verificando si el tiempo actual menos el tiempo de la ultima actividad es mayor a la maxima cantidad de tiempo de una sesion
    if (isset($_SESSION['ULTIMA_ACTIVIDAD']) && (time() - $_SESSION['ULTIMA_ACTIVIDAD'] > MAX_SESSION_TIME)) {
        //destruyendo sesion
        session_destroy();
        //enviando al login
        header('location: login');
    } else {
        //ingresando tiempo actual a nuestra ultima actividad
        $_SESSION['ULTIMA_ACTIVIDAD'] = time();
        //si el tipo de usuario es 1(administrador) se le mostrara ese menu
        if ($_SESSION['codi_tipo_usua'] == 1) {
            print('
            <ul id="slide-out" class="sidenav sidenav-fixed blue darken-2">
                <li>
                    <div class="user-view">
                        <div class="row">
                            <div class="col s12">
                            <a href="index" class="center-align"><img class="responsive-img" src="' . IMG_PATH . 'logos/' . $_SESSION['logo_casa'] . '"></a>
                            </div>
                        </div>
                        <a href="index"><h6 class="white-text">' . $_SESSION['nomb_casa'] . '</h6>
                    <h6 class="white-text">' . $_SESSION['nomb_usua'] . '</h6>
                    </a>
                    </div>
                </li>
                <li>
                    <div class="divider grey lighten-1"></div>
                </li>
                <li>
                    <a class="subheader">Menú</a>
                </li>
                <li><a href="index"><i class="material-icons">dashboard</i>Dashboard</a></li>
                <li><a href="curso"><i class="material-icons">event</i>Cursos</a></li>
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <a class="collapsible-header" id="drop">Eventos<i class="material-icons" id="drop">arrow_drop_down</i></a>
                            <div class="collapsible-body">
                            <ul>
                                <li><a href="contacto"><i class="material-icons">perm_identity</i>Contactos</a></li>
                                <li><a href="etiqueta"><i class="material-icons">import_contacts</i>Etiquetas</a></li>
                                <li><a href="evento"><i class="material-icons">event</i>Eventos</a></li>
                            </ul>
                            </div>
                        </a>
                    </li>
                </ul>
                <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header" id="drop">Financiero<i class="material-icons" id="drop">arrow_drop_down</i></a>
                    <div class="collapsible-body">
                      <ul>
                        <li><a href="factura"><i class="material-icons">monetization_on</i>Facturas</a></li>
                        <li><a href="quedan"><i class="material-icons">monetization_on</i>Quedan</a></li>
                        <li><a href="presupuesto"><i class="material-icons">monetization_on</i>Presupuesto</a></li>
                      </ul>
                    </div>
                    </a>
                </li>
                </ul>
                <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header" id="drop">Catalogos<i class="material-icons" id="drop">arrow_drop_down</i></a>
                    <div class="collapsible-body">
                      <ul>
                        <li><a href="acreditacion"><i class="material-icons">assignment</i>Acreditacion</a></li>
                           <li><a href="docente"><i class="material-icons">people</i>Docentes</a></li>
                           <li><a href="horario"><i class="material-icons">alarm</i>Horarios</a></li>
                           <li><a href="profesion"><i class="material-icons">assignment</i>Profesion</a></li>
                           <li><a href="salon"><i class="material-icons">list</i>Salones</a></li>
                           <li><a href="usuario"><i class="material-icons">person</i>Usuarios</a></li>
                ');
            //si el tipo de casa es 1 (encargada) se mostrara el menu para casas
            if ($_SESSION['codi_tipo_casa'] == 1) {
                print('<li><a href="casa"><i class="material-icons">domain</i>Casas</a></li>
                           <li><a href="categoria"><i class="material-icons">assignment</i>Categorias</a></li>');
            }
            print('
                      </ul>
                    </div>
                  </li>
                  <li><a href="reporte"><i class="material-icons">picture_as_pdf</i>Reportes</a></li>
                  <li><a href="cuenta"><i class="material-icons">perm_identity</i>Mi Cuenta</a></li>
                  <li class="red white-text"><a onClick="cerrarSesion();"><i class="material-icons">exit_to_app</i>Cerrar Sesion</a></li>
                </ul>
            </ul>

                ');
            //Encargado financiero
        } else if ($_SESSION['codi_tipo_usua'] == 2) {
            print('
            <ul id="slide-out" class="sidenav sidenav-fixed blue">
            <li>
                <div class="user-view">
                    <div class="row">
                        <div class="col s12">
                        <a href="index" class="center-align"><img class="responsive-img" src="' . IMG_PATH . 'logos/' . $_SESSION['logo_casa'] . '"></a>
                        </div>
                    </div>
                    <a href="index"><h6 class="white-text">' . $_SESSION['nomb_casa'] . '</h6>
                    <h6 class="white-text">' . $_SESSION['nomb_usua'] . '</h6>
                    </a>
                </div>
            </li>
                <li>
                    <div class="divider grey lighten-1"></div>
                </li>
                <li>
                    <a class="subheader">Menú</a>
                </li>
                <li><a href="index"><i class="material-icons">dashboard</i>Dashboard</a></li>
                <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header" id="drop">Financiero<i class="material-icons" id="drop">arrow_drop_down</i></a>
                    <div class="collapsible-body">
                      <ul>
                        <li><a href="factura"><i class="material-icons">monetization_on</i>Facturas</a></li>
                        <li><a href="quedan"><i class="material-icons">monetization_on</i>Quedan</a></li>
                        <li><a href="presupuesto"><i class="material-icons">monetization_on</i>Presupuesto</a></li>
                      </ul>
                    </div>
                    </a>
                </li>
                </ul>
                <li><a href="reporte"><i class="material-icons">picture_as_pdf</i>Reportes</a></li>
                <li><a href="cuenta"><i class="material-icons">perm_identity</i>Mi Cuenta</a></li>
                <li class="red white-text"><a onClick="cerrarSesion();"><i class="material-icons">exit_to_app</i>Cerrar Sesion</a></li>
            </ul>
                ');

            //Encargado Informativo
        } else if ($_SESSION['codi_tipo_usua'] == 4) {
            print('
            <ul id="slide-out" class="sidenav sidenav-fixed blue">
            <li>
                <div class="user-view">
                    <div class="row">
                        <div class="col s12">
                        <a href="index" class="center-align"><img class="responsive-img" src="' . IMG_PATH . 'logos/' . $_SESSION['logo_casa'] . '"></a>
                        </div>
                    </div>
                    <a href="index"><h6 class="white-text">' . $_SESSION['nomb_casa'] . '</h6>
                    <h6 class="white-text">' . $_SESSION['nomb_usua'] . '</h6>
                    </a>
                </div>
            </li>
                <li>
                    <div class="divider grey lighten-1"></div>
                </li>
                <li>
                    <a class="subheader">Menú</a>
                </li>
                <li><a href="index"><i class="material-icons">dashboard</i>Dashboard</a></li>
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <a class="collapsible-header" id="drop">Eventos<i class="material-icons" id="drop">arrow_drop_down</i></a>
                            <div class="collapsible-body">
                            <ul>
                                <li><a href="contacto"><i class="material-icons">perm_identity</i>Contactos</a></li>
                                <li><a href="etiqueta"><i class="material-icons">import_contacts</i>Etiquetas</a></li>
                                <li><a href="evento"><i class="material-icons">event</i>Eventos</a></li>
                            </ul>
                            </div>
                        </a>
                    </li>
                </ul>
                <li><a href="reporte"><i class="material-icons">picture_as_pdf</i>Reportes</a></li>
                <li><a href="cuenta"><i class="material-icons">perm_identity</i>Mi Cuenta</a></li>
                <li class="red white-text"><a onClick="cerrarSesion();"><i class="material-icons">exit_to_app</i>Cerrar Sesion</a></li>
            </ul>
                ');

            //Encargado Informativo
        } else if ($_SESSION['codi_tipo_usua'] == 5) {
            print('
            <ul id="slide-out" class="sidenav sidenav-fixed blue">
            <li>
                <div class="user-view">
                    <div class="row">
                        <div class="col s12">
                        <a href="index" class="center-align"><img class="responsive-img" src="' . IMG_PATH . 'logos/' . $_SESSION['logo_casa'] . '"></a>
                        </div>
                    </div>
                    <a href="index"><h6 class="white-text">' . $_SESSION['nomb_casa'] . '</h6>
                    <h6 class="white-text">' . $_SESSION['nomb_usua'] . '</h6>
                    </a>
                </div>
            </li>
                <li>
                    <div class="divider grey lighten-1"></div>
                </li>
                <li>
                    <a class="subheader">Menú</a>
                </li>
                <li><a href="index"><i class="material-icons">dashboard</i>Dashboard</a></li>
                <li><a href="cuenta"><i class="material-icons">perm_identity</i>Mi Cuenta</a></li>
                <li class="red white-text"><a onClick="cerrarSesion();"><i class="material-icons">exit_to_app</i>Cerrar Sesion</a></li>
            </ul>
                ');

            //Encargado Informativo
        } else if ($_SESSION['codi_tipo_usua'] == 3) {
            print('
            <ul id="slide-out" class="sidenav sidenav-fixed blue darken-2">
                <li>
                    <div class="user-view">
                        <div class="row">
                            <div class="col s12">
                            <a href="index" class="center-align"><img class="responsive-img " src="' . IMG_PATH . 'logos/' . $_SESSION['logo_casa'] . '"></a>
                            </div>
                        </div>
                        <a href="index"><h6 class="white-text">' . $_SESSION['nomb_casa'] . '</h6>
                    <h6 class="white-text">' . $_SESSION['nomb_usua'] . '</h6>
                    </a>
                    </div>
                </li>
                <li>
                    <div class="divider grey lighten-1"></div>
                </li>
                <li>
                    <a class="subheader">Menú</a>
                </li>
                <li><a href="index"><i class="material-icons">dashboard</i>Dashboard</a></li>
                <li><a href="curso"><i class="material-icons">event</i>Cursos</a></li>
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <a class="collapsible-header" id="drop">Eventos<i class="material-icons" id="drop">arrow_drop_down</i></a>
                            <div class="collapsible-body">
                            <ul>
                                <li><a href="contacto"><i class="material-icons">perm_identity</i>Contactos</a></li>
                                <li><a href="etiqueta"><i class="material-icons">import_contacts</i>Etiquetas</a></li>
                                <li><a href="evento"><i class="material-icons">event</i>Eventos</a></li>
                            </ul>
                            </div>
                        </a>
                    </li>
                </ul>
                <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header" id="drop">Catalogos<i class="material-icons" id="drop">arrow_drop_down</i></a>
                    <div class="collapsible-body">
                      <ul>
                        <li><a href="acreditacion"><i class="material-icons">assignment</i>Acreditacion</a></li>
                           <li><a href="docente"><i class="material-icons">people</i>Docentes</a></li>
                           <li><a href="horario"><i class="material-icons">alarm</i>Horarios</a></li>
                           <li><a href="profesion"><i class="material-icons">assignment</i>Profesion</a></li>
                           <li><a href="salon"><i class="material-icons">list</i>Salones</a></li>
                ');
            //si el tipo de casa es 1 (encargada) se mostrara el menu para casas
            if ($_SESSION['codi_tipo_casa'] == 1) {
                print('<li><a href="casa"><i class="material-icons">domain</i>Casas</a></li>
                           <li><a href="categoria"><i class="material-icons">assignment</i>Categorias</a></li>');
            }
            print('
                      </ul>
                    </div>
                  </li>
                  <li><a href="reporte"><i class="material-icons">picture_as_pdf</i>Reportes</a></li>
                  <li><a href="cuenta"><i class="material-icons">perm_identity</i>Mi Cuenta</a></li>
                  <li class="red white-text"><a onClick="cerrarSesion();"><i class="material-icons">exit_to_app</i>Cerrar Sesion</a></li>
                </ul>
            </ul>
                ');
        }
        print('<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>');
    }
} else {
    header('location: login');
}
