<?php
//definiendo el maximo tiempo de una sesion (segundos*cantidad de minutos)
define('MAX_SESSION_TIME', 60 * 5);
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
                            <a href="cuenta" class="center-align"><img class="responsive-img circle hoverable" src="'.IMG_PATH.'logos/'.$_SESSION['logo_casa'].'"></a>
                            </div>
                        </div>
                        <a href="cuenta"><h5 class="white-text">'.$_SESSION['nomb_casa'].'</h5></a>
                    </div>
                </li>
                <li>
                    <div class="divider grey lighten-1"></div>
                </li>
                <li>
                    <a class="subheader">Menú</a>
                </li>
                <li><a href="index"><i class="material-icons">dashboard</i>Dashboard</a></li>
                <li><a href="presupuesto"><i class="material-icons">monetization_on</i>Presupuesto</a></li>
                <li><a href="curso"><i class="material-icons">event</i>Cursos</a></li>
                <ul class="collapsible collapsible-accordion">
                  <li>
                    <a class="collapsible-header" id="drop">Catalogos<i class="material-icons" id="drop">arrow_drop_down</i></a>

                    <div class="collapsible-body">
                      <ul>
                ');
            //si el tipo de casa es 1 (encargada) se mostrara el menu para casas
            if ($_SESSION['codi_tipo_casa']==1) {
                print('<li><a href="casa"><i class="material-icons">domain</i>Casas</a></li>');
            }
            print('
                        <li><a href="categoria"><i class="material-icons">assignment</i>Categorias</a></li>   
                        <li><a href="docente"><i class="material-icons">people</i>Docentes</a></li>
                        <li><a href="usuario"><i class="material-icons">person</i>Usuarios</a></li>
                        <li><a href="horario"><i class="material-icons">alarm</i>Horarios</a></li>
                        <li><a href="salon"><i class="material-icons">list</i>Salones</a></li>
                      </ul>
                    </div>
                  </li>
                </ul>
                <li><a href="cuenta"><i class="material-icons">perm_identity</i>Mi Cuenta</a></li>
                <li class="red white-text"><a onClick="cerrarSesion();"><i class="material-icons">exit_to_app</i>Cerrar Sesion</a></li>
                <br>
                <br>
                <br>
            </ul>

                ');
        } else if ($_SESSION['codi_tipo_usua'] == 2) {
            print('
            <ul id="slide-out" class="sidenav sidenav-fixed blue">
                <li>
                    <div class="user-view">
                        <div class="row">
                            <div class="col s12">
                            <a href="#user" class="center-align"><img class="responsive-img circle hoverable" src="'.IMG_PATH.'logos/'.$_SESSION['logo_casa'].'"></a>
                            </div>
                        </div>
                        <a href="#name"><h5 class="white-text">'.$_SESSION['nomb_casa'].'</h5></a>
                        <a href="#name"><span class="white-text name">'.$_SESSION['nomb_usua'].'</span></a>
                    </div>
                </li>
                <li>
                    <div class="divider grey lighten-1"></div>
                </li>
                <li>
                    <a class="subheader">Menú</a>
                </li>
                <li><a href="index"><i class="material-icons">dashboard</i>Dashboard</a></li>
                <li><a href="presupuesto"><i class="material-icons">monetization_on</i>Presupuesto</a></li>
                <li><a href="cuenta"><i class="material-icons">perm_identity</i>Mi Cuenta</a></li>
                <li class="red white-text"><a href="logout"><i class="material-icons">exit_to_app</i>Cerrar Sesion</a></li>
                <br>
                <br>
                <br>
            </ul>
                ');
        } else if ($_SESSION['codi_tipo_usua']==3) {
            print('
            <ul id="slide-out" class="sidenav sidenav-fixed blue">
                <li>
                    <div class="user-view">
                        <div class="row">
                            <div class="col s12">
                            <a href="#user" class="center-align"><img class="responsive-img circle hoverable" src="'.IMG_PATH.'logos/'.$_SESSION['logo_casa'].'"></a>
                            </div>
                        </div>
                        <a href="#name"><h5 class="white-text">'.$_SESSION['nomb_casa'].'</h5></a>
                        <a href="#name"><span class="white-text name">'.$_SESSION['nomb_usua'].'</span></a>
                    </div>
                </li>
                <li>
                    <div class="divider grey lighten-1"></div>
                </li>
                <li>
                    <a class="subheader">Menú</a>
                </li>
                <li><a href="index"><i class="material-icons">dashboard</i>Dashboard</a></li>
                <li><a href="casa"><i class="material-icons">domain</i>Casas</a></li>
                <li><a href="presupuesto"><i class="material-icons">monetization_on</i>Presupuesto</a></li>
                <li><a href="categoria"><i class="material-icons">assignment</i>Categorias</a></li>
                <li><a href="curso"><i class="material-icons">event</i>Cursos</a></li>
                <li><a href="docente"><i class="material-icons">people</i>Docentes</a></li>
                <li><a href="usuario"><i class="material-icons">person</i>Usuarios</a></li>
                <li><a href="horario"><i class="material-icons">alarm</i>Horarios</a></li>
                <li><a href="salon"><i class="material-icons">list</i>Salones</a></li>
                <li><a href="cuenta"><i class="material-icons">perm_identity</i>Mi Cuenta</a></li>
                <li class="red white-text"><a href="logout"><i class="material-icons">exit_to_app</i>Cerrar Sesion</a></li>
                <br>
                <br>
                <br>
            </ul>
            ');
        }
    }
} else {
    header('location: login');
}
