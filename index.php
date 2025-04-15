<?php

// Iniciar la sesión
session_start();

// Cargamos los controladores necesarios
require_once './controllers/HomeController.php';
require_once './controllers/AuthController.php';
require_once './controllers/UserController.php';
require_once './controllers/CitasController.php';
require_once './controllers/NoticiasController.php';
require_once './controllers/admin/CitasAdminController.php';
require_once './controllers/admin/NoticiasAdminController.php';
require_once './controllers/admin/UsuariosAdminController.php';

// Establecer el controlador del inicio como principal
const DEFAULT_CONTROLLER = "home";

// Obtener el controlador de la URL o usar el por defecto
$controller = !empty($_GET["controller"]) ? $_GET["controller"] : DEFAULT_CONTROLLER;

switch ($controller) {
    case 'home':
        $controllerInstance = new HomeController();
        $controllerInstance->home();
        break;
    case 'noticias':
        $controllerInstance = new NoticiasController();
        $controllerInstance->news();
        break;
    case 'citas':
        $controllerInstance = new CitasController();
        $controllerInstance->appointments();
        break;

    case 'createAppointment':
        $controllerInstance = new CitasController();
        $controllerInstance->createAppointment();
        break;
    case 'deleteCita':
        $controllerInstance = new CitasController();
        $controllerInstance->deleteCita();
        break;

    case 'editAppointment':
        $controllerInstance = new CitasController();
        $controllerInstance->checkAppointment();
        break;

    case 'loginCheck':
        $controllerInstance = new AuthController();
        $controllerInstance->loginCheck();
        break;
    case 'renderLogin':
        $controllerInstance = new AuthController();
        $controllerInstance->renderLogin();
        break;
    case 'renderRegistro':
        $controllerInstance = new AuthController();
        $controllerInstance->renderRegister();
        break;
    case 'checkRegistro':
        $controllerInstance = new AuthController();
        $controllerInstance->checkRegister();
        break;

    case 'perfil':
        $controllerInstance = new UserController();
        $controllerInstance->renderProfile();
        break;
    case 'changePassword':
        $controllerInstance = new UserController();
        $controllerInstance->updatePassword();
        break;
    case 'changeUserdata':
        $controllerInstance = new UserController();
        $controllerInstance->updateUserData();
        break;
    case 'adminCitas':
        $controllerInstance = new CitasAdminController();
        $controllerInstance->renderCitasController();
        break;
    case 'adminDeleteCita':
        $controllerInstance = new CitasAdminController();
        $controllerInstance->deleteCita();
        break;
    case 'adminNews':
        $controllerInstance = new NoticiasAdminController();
        $controllerInstance->renderNoticiasController();
        break;
    case 'deleteNew':
        $controllerInstance = new NoticiasAdminController();
        $controllerInstance->deleteNew();
        break;
    case 'adminUsers':
        $controllerInstance = new UsersAdminController();
        $controllerInstance->renderUsers();
        break;
    case 'deleteUser':
        $controllerInstance = new UsersAdminController();
        $controllerInstance->deleteUser();
        break;

    case 'adminEditCita':
        $controllerInstance = new CitasAdminController();
        $controllerInstance->renderEditCitas();
        break;

    case 'adminCitasEditCheck':
        $controllerInstance = new CitasAdminController();
        $controllerInstance->checkAppointment();
        break;

    case 'adminEditNews':
        $controllerInstance = new NoticiasAdminController();
        $controllerInstance->renderEditNews();
        break;

    case 'adminNewsEditCheck':
        $controllerInstance = new NoticiasAdminController();
        $controllerInstance->checkNew();
        break;

    case 'adminEditUser':
        $controllerInstance = new UsersAdminController();
        $controllerInstance->renderEditUser();
        break;

    case 'adminUserEditCheck':
        $controllerInstance = new UsersAdminController();
        $controllerInstance->checkUser();
        break;

    case 'adminCreateUser':
        $controllerInstance = new UsersAdminController();
        $controllerInstance->renderCreateUser();
        break;

    case 'adminTryCreateUser':
        $controllerInstance = new UsersAdminController();
        $controllerInstance->createUser();
        break;

    case 'adminCreateNew':
        $controllerInstance = new NoticiasAdminController();
        $controllerInstance->renderCreateNew();
        break;

    case 'adminTryCreateNew':
        $controllerInstance = new NoticiasAdminController();
        $controllerInstance->createNew();
        break;

    case 'adminCreateCita':
        $controllerInstance = new CitasAdminController();
        $controllerInstance->renderCreateAppointment();
        break;

    case 'adminTryCreateCita':
        $controllerInstance = new CitasAdminController();
        $controllerInstance->createAppointment();
        break;

    case 'logout':
        $controllerInstance = new AuthController();
        $controllerInstance->logout();
        break;

    default:
        http_response_code(404);
        echo "Página no encontrada.";
        break;
}
