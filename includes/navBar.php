 <?php
    include_once './utils/Utils.php';
    // Clase para representar en que vista se encuentra el cliente
    $classActive = 'active';
    ?>


 <!-- Barra de navegación -->
 <nav class="navBar navBar-onTop navBar-show">
     <!-- Logo -->
     <a href="./index.php?controller=home" class="logo-container txt-primary-color">
         <img class="logo-nav" src="./assets/images/Logo/logo.png" alt="Logo web" />
         <span class="name-logo"> Astrohub </span>
     </a>

     <!-- Barra de navegación -->
     <div class="navList-login ">
         <ul class="nav-list">
             <li class="list-item">
                 <a href="./index.php?controller=home" title="Inicio" class="item-link txt-primary-color 
                 <?php if (isset($_GET['controller'])) {
                        if ($_GET['controller'] === 'home') {
                            echo $classActive;
                        }
                    } else {
                        echo $classActive;
                    } ?>">Inicio</a>
             </li>
             <li class="list-item">
                 <a href="./index.php?controller=noticias"
                     class="item-link txt-primary-color 
                     <?php if (isset($_GET['controller'])) {
                            if ($_GET['controller'] === 'noticias') {
                                echo $classActive;
                            }
                        } ?>" title="Noticias">Noticias</a>
             </li>
             <li class="list-item">
                 <a href="#" class="item-link txt-primary-color" title="Explorar">Explorar</a>
             </li>
             <li class="list-item">
                 <a href="#" class="item-link txt-primary-color" title="Eventos">Eventos</a>
             </li>

             <!-- SEGÚN EL ROL -->

             <!-- USUARIOS -->
             <?php if (isset($_SESSION['user']) && $_SESSION['user']['rol'] === 'user'): ?>

                 <!-- citas -->
                 <li class="list-item">
                     <a href="./index.php?controller=citas"
                         class="item-link txt-primary-color <?php if (isset($_GET['controller'])) {
                                                                if ($_GET['controller'] === 'citas') {
                                                                    echo $classActive;
                                                                }
                                                            } ?>" title="Citaciones">Citaciones</a>
                 </li>

             <?php endif; ?>

             <!-- ADMINS -->
             <?php if (isset($_SESSION['user']) && $_SESSION['user']['rol'] === 'admin'): ?>

                 <!-- administration dropdown -->
                 <li class="list-item dropdown">
                     <button type="button" class="admin-btn dropdown-btn" title="Administración">
                         Administracion
                         <svg class="txt-primary-color dropdown-arrow" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                             <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9l6 6l6-6" />
                         </svg>
                     </button>

                     <ul class="dropdown-admin dropdown-list dropdown-close" id="admin-dropdown-menu">
                         <!-- users -->
                         <li class="dropdown-item">
                             <a href="./index.php?controller=adminUsers"
                                 class="dropdown-link txt-primary-color" title="Usuarios">Usuarios</a>
                         </li>
                         <!-- news -->
                         <li class="dropdown-item">
                             <a href="./index.php?controller=adminNews"
                                 class="dropdown-link txt-primary-color" title="Noticias">Noticias</a>
                         </li>
                         <!-- appointments -->
                         <li class="dropdown-item">
                             <a href="./index.php?controller=adminCitas"
                                 class="dropdown-link txt-primary-color" title="Citas">Citas</a>
                         </li>
                     </ul>
                 </li>

             <?php endif; ?>

         </ul>

         <!-- Sesión -->
         <?php

            // Si estamos en la vista de login o registro, no se muestran los botones de inicio de sesión y registro
            $isNotLoginRegisterView = true;
            $isUser = isset($_SESSION['user']);

            if (isset($_GET['controller'])) {
                $isNotLoginRegisterView = Utils::array_every(['renderLogin', 'loginCheck', 'renderRegistro', 'checkRegistro'], function ($value) {
                    return $value !== $_GET['controller'];
                });
            }

            if ($isNotLoginRegisterView && !$isUser): ?>

             <div class="login">
                 <a href="./index.php?controller=renderLogin" class="btn btn-secondary btn-login" title="Iniciar sesión">Iniciar sesión</a>
                 <a href="./index.php?controller=renderRegistro" class="btn btn-primary btn-register" title="Suscribirse">Suscribirse</a>
             </div>

         <?php endif; ?>

         <!-- Perfil -->
         <?php if (isset($_SESSION['user'])): ?>
             <div class="dropdown dropdown-perfil" id="perfil-dropdown">
                 <button type="button" class="perfil-btn dropdown-btn" title="Perfil">

                     <!-- Si es usuario: usuario svg-->
                     <?php if ($_SESSION['user']['rol'] === 'user'): ?>

                         <svg class="user-svg" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                             <g fill="none" fill-rule="evenodd">
                                 <path d="m12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036q-.016-.004-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.016-.018m.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01z" />
                                 <path fill="currentColor" d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2M8.5 9.5a3.5 3.5 0 1 1 7 0a3.5 3.5 0 0 1-7 0m9.758 7.484A7.99 7.99 0 0 1 12 20a7.99 7.99 0 0 1-6.258-3.016C7.363 15.821 9.575 15 12 15s4.637.821 6.258 1.984" />
                             </g>
                         </svg>

                     <?php endif; ?>

                     <!-- Si es administrador: admin svg -->
                     <?php if ($_SESSION['user']['rol'] === 'admin'): ?>

                         <svg class="admin-svg" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                             <path fill="currentColor" fill-rule="evenodd" d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991zM14 9a2 2 0 1 1-4 0a2 2 0 0 1 4 0m-2 8c4 0 4-.895 4-2s-1.79-2-4-2s-4 .895-4 2s0 2 4 2" clip-rule="evenodd" />
                         </svg>

                     <?php endif; ?>

                     <svg class="txt-primary-color dropdown-arrow" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                         <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9l6 6l6-6" />
                     </svg>
                 </button>
                 <!-- perfil dropdown -->
                 <ul class="dropdown-list dropdown-close" id="perfil-dropdown-menu">
                     <li class="dropdown-item">
                         <a href="./index.php?controller=perfil" class="dropdown-link txt-primary-color" title="Perfil">Perfil</a>
                     </li>
                     <!-- logout -->
                     <li class="dropdown-item">
                         <a href="./index.php?controller=logout" class="dropdown-link txt-primary-color logout" title="Cerrar sesión">
                             <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                 <path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h7v2H5v14h7v2zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z" />
                             </svg>
                             <span>Cerrar sesión</span>
                         </a>
                     </li>
                 </ul>
             </div>
         <?php endif; ?>

         <!-- BURGUER MENU -->

         <button type="button" class="burguer-btn btn" title="Menu desplegable">
             <svg class="txt-primary-color" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                 <path fill="currentColor"
                     d="M4 18h16c.55 0 1-.45 1-1s-.45-1-1-1H4c-.55 0-1 .45-1 1s.45 1 1 1m0-5h16c.55 0 1-.45 1-1s-.45-1-1-1H4c-.55 0-1 .45-1 1s.45 1 1 1M3 7c0 .55.45 1 1 1h16c.55 0 1-.45 1-1s-.45-1-1-1H4c-.55 0-1 .45-1 1" />
             </svg>
         </button>

         <ul class="burguer-navList burguer-close">
             <button type="button" class="close-menu txt-secondary-color" title="Cerrar">
                 <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                     <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 18V6m-4 6H4m8-4s4 2.946 4 4s-4 4-4 4" color="currentColor" />
                 </svg>
             </button>
             <!-- home -->
             <li class="b-list-item">
                 <a href="./index.php?controller=home"
                     class="b-item-link txt-primary-color" title="Inicio">Inicio</a>
             </li>
             <!-- news -->
             <li class="b-list-item">
                 <a href="./index.php?controller=noticias"
                     class="b-item-link txt-primary-color" title="Noticias">Noticias</a>
             </li>
             <!-- explore -->
             <li class="b-list-item">
                 <a href="#" class="b-item-link txt-primary-color" title="Explorar">Explorar</a>
             </li>
             <!-- events -->
             <li class="b-list-item">
                 <a href="#" class="b-item-link txt-primary-color" title="Eventos">Eventos</a>
             </li>

             <!-- SEGÚN EL ROL -->
             <!-- Usuarios -->
             <?php if (isset($_SESSION['user']) && $_SESSION['user']['rol'] === 'user'): ?>

                 <li class="b-list-item">
                     <a href="./index.php?controller=citas"
                         class="b-item-link txt-primary-color" title="Citaciones">Citaciones</a>
                 </li>

             <?php endif; ?>

             <!-- Admins -->
             <?php if (isset($_SESSION['user']) && $_SESSION['user']['rol'] === 'admin'): ?>

                 <li class="b-list-item">
                     <a href="./index.php?controller=adminUsers"
                         class="b-item-link txt-primary-color" title="Administración de usuarios">Usuarios-administracion</a>
                 </li>
                 <li class="b-list-item">
                     <a href="./index.php?controller=adminNews"
                         class="b-item-link txt-primary-color" title="Administración de noticias">Noticias-administracion</a>
                 </li>
                 <li class="b-list-item">
                     <a href="./index.php?controller=adminCitas"
                         class="b-item-link txt-primary-color" title="Administración de citas">Citas-administracion</a>
                 </li>

             <?php endif; ?>

         </ul>
     </div>
 </nav>