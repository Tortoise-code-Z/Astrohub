<?php

require_once './controllers/BaseController.php';
require_once './models/UserLoginModel.php';
require_once './models/UserDataModel.php';
require_once './models/NoticiasModel.php';
require_once './config/error-log.php';
/**
 * Clase para representar el controlador de administración de los usuarios.
 *
 * Esta clase realiza funciones para renderizar, crear, borrar y editar usuarios desde
 * administración.
 *
 * @package    Controladores
 * @subpackage    Usuarios Administración
 * @author     Víctor Pérez
 */

class UsersAdminController extends BaseController
{

    /**
     *  Renderiza la vista de administración de usuarios
     *
     * @return void
     */
    public function renderUsers()
    {
        $this->requireAdmin();
        $userLoginModel = new UserLoginModel();
        $users = $userLoginModel->getAllUsersLogin();
        $this->render('usuarios-administracion', ['users' => $users], true);
    }

    /**
     *  Renderiza la vista de administración de creación de usuarios
     *
     * @return void
     */
    public function renderCreateUser()
    {
        $this->requireAdmin();
        $this->render('create-usuarios-administracion', [], true);
    }

    /**
     *  Renderiza la vista de administración de edición de usuarios
     *
     * @return void
     */
    public function renderEditUser()
    {
        $this->requireAdmin();

        $userModel = new UserDataModel();
        $user = $userModel->getUserById($_GET['id']);

        if (!$user) {
            $this->redirect("./index.php?controller=adminUsers&status=ko");
            return;
        }

        $userLoginModel = new UserLoginModel();
        $userLogin = $userLoginModel->getUserLoginByUserId($user['idUser']);

        $this->render('edit-usuarios-administracion', ['userData' => $user, 'userLogin' => $userLogin], true);
    }

    /**
     *  Crea un usuario
     *
     * @return void
     */
    public function createUser()
    {
        $userDataModel = new UserDataModel();
        $userLoginModel = new UserLoginModel();

        $data = [
            'username' => ['input' => $_POST['username'], 'type' => 'string', 'canEmpty' => false],
            'password' => ['input' => $_POST['password'], 'type' => 'string', 'canEmpty' => false],
            'email' => ['input' => $_POST['email'], 'type' => 'email', 'canEmpty' => false],
            'name' => ['input' => $_POST['name'], 'type' => 'string', 'canEmpty' => false],
            'surname' => ['input' => $_POST['surname'], 'type' => 'string', 'canEmpty' => false],
            'tel' => ['input' => $_POST['tel'], 'type' => 'string', 'canEmpty' => false],
            'date' => ['input' => $_POST['dateBirth'], 'type' => 'date', 'canEmpty' => false],
            'dir' => ['input' => $_POST['dir'], 'type' => 'string', 'canEmpty' => true],
            'sex' => ['input' => $_POST['sex'], 'type' => 'string', 'canEmpty' => false],
            'rol' => ['input' => $_POST['rol'], 'type' => 'string', 'canEmpty' => false],
        ];

        $sanitize = new Sanitized($data);
        $sanitize->sanitize();
        $isValid = $sanitize->isValid();

        if (!$isValid) {
            $this->createSessionVarKO($sanitize, ['password']);
            $this->statusKO("adminCreateUser", null);
        }

        $user = $userLoginModel->getUserByUsername($sanitize->getSanitizeInput('username'));
        $email = $userDataModel->getEmail($sanitize->getSanitizeInput('email'));

        if ($email) {
            $sanitize->setError('email', ERR_EMAIL);
            $this->createSessionVarKO($sanitize, ['password']);
            $this->statusKO('adminCreateUser', null);
        }

        if ($user) {
            $sanitize->setError('username', ERR_USERNAME_REG);
            $this->createSessionVarKO($sanitize, ['password']);
            $this->statusKO('adminCreateUser', null);
        }

        $userData = [
            'name' => $sanitize->getSanitizeInput('name'),
            'surname' => $sanitize->getSanitizeInput('surname'),
            'email' => $sanitize->getSanitizeInput('email'),
            'tel' => $sanitize->getSanitizeInput('tel'),
            'dateBirth' => $sanitize->getSanitizeInput('date'),
            'dir' => $sanitize->getSanitizeInput('dir'),
            'sex' => $sanitize->getSanitizeInput('sex')
        ];

        $userDataModel->createUser($userData);

        $idUser = $userDataModel->getIdUserByEmail($sanitize->getSanitizeInput('email'));
        $passwordHash = password_hash($sanitize->getSanitizeInput('password'), PASSWORD_BCRYPT);

        $loginData = [
            'idUser' => $idUser,
            'username' => $sanitize->getSanitizeInput('username'),
            'password' => $passwordHash,
            'rol' => $sanitize->getSanitizeInput('rol')
        ];

        $userLoginModel->createUserLogin($loginData);
        $this->statusOK();
    }

    /**
     *  Elimina un usuario
     *
     * @return void
     */
    public function deleteUser()
    {
        $userDataModel = new UserDataModel();
        $user = $userDataModel->getUserById($_GET['id']);

        if (!$user) {
            $this->redirect('./index.php?controller=adminUsers&status=ko');
            return;
        }

        $userDataModel->deleteUser($_GET['id']);
        $this->redirect('./index.php?controller=adminUsers&status=ok');
    }

    /**
     *  Actauliza un usuario
     *
     * @return void
     */
    public function checkUser()
    {
        $data = [
            'email' => ['input' => $_POST['email'], 'type' => 'email', 'canEmpty' => false],
            'name' => ['input' => $_POST['name'], 'type' => 'string', 'canEmpty' => false],
            'surname' => ['input' => $_POST['surname'], 'type' => 'string', 'canEmpty' => false],
            'tel' => ['input' => $_POST['tel'], 'type' => 'string', 'canEmpty' => false],
            'date' => ['input' => $_POST['dateBirth'], 'type' => 'date', 'canEmpty' => false],
            'dir' => ['input' => $_POST['dir'], 'type' => 'string', 'canEmpty' => true],
            'sex' => ['input' => $_POST['sex'], 'type' => 'string', 'canEmpty' => false],
            'rol' => ['input' => $_POST['rol'], 'type' => 'string', 'canEmpty' => false],
        ];

        $sanitize = new Sanitized($data);
        $sanitize->sanitize();
        $isValid = $sanitize->isValid();

        if (!$isValid) {
            $this->createSessionVarKO($sanitize, []);
            $this->statusKO('adminEditUser', $_GET['id']);
        }

        $userDataModel = new UserDataModel();
        $userLoginModel = new UserLoginModel();

        $emailRecord = $userDataModel->getEmail($sanitize->getSanitizeInput('email'));
        $isCurrentUser = $emailRecord && $emailRecord['idUser'] === intval($_GET['id']);

        if ($emailRecord && !$isCurrentUser) {
            $sanitize->setError('email', ERR_EMAIL);
            $this->createSessionVarKO($sanitize, []);
            $this->statusKO('adminEditUser',  $_GET['id']);
        }

        $userData = $userDataModel->getUserById($_GET['id']);

        $dataUpdate = [
            'nombre' => $sanitize->getSanitizeInput('name'),
            'apellidos' => $sanitize->getSanitizeInput('surname'),
            'email' => $sanitize->getSanitizeInput('email'),
            'telefono' => $sanitize->getSanitizeInput('tel'),
            'fecha_nacimiento' => $sanitize->getSanitizeInput('date'),
            'direccion' => $sanitize->getSanitizeInput('dir'),
            'sexo' => $sanitize->getSanitizeInput('sex')
        ];

        $dataRol = ['rol' => $sanitize->getSanitizeInput('rol')];

        $userDataModel->updateUser($userData['idUser'], $dataUpdate);
        $userLoginModel->updateUserLogin($userData['idUser'], $dataRol);

        $user = $userLoginModel->getUserLoginByUserId($userData['idUser']);

        // Si el usuario que se está cambiando es un administrador y tiene la sesión iniciada, se le cambia el rol de sesión en caso de cambio
        if ($user['usuario'] === $_SESSION['user']['usuario']) {
            if ($_SESSION['user']['rol'] !== $sanitize->getSanitizeInput('rol')) {
                $_SESSION['user']['rol'] = $sanitize->getSanitizeInput('rol');
            }
        }

        $this->statusOK();
    }

    /**
     * Crea variable de sesion de error y de valores a recuperar
     *
     * @param Sanitize $sanitize instancia de saneamiento
     * @param array $sensibleInputs array con inputs sensibles los cuales no deben recuperarse
     * @return void
     */
    public function createSessionVarKO($sanitize, $sensibleInputs)
    {
        $_SESSION['errors'] = $sanitize->getErrors();
        $sanitize->deleteSensibleInputs($sensibleInputs);
        $_SESSION['old_values'] = $sanitize->getAllSanitizedInputs();
    }

    /**
     * En caso de que algo salga mal, redirige a la página correspondiente
     *
     * @param string $controller valor del controlador que recibirá el router index.php
     * @param int $id identificador del usuario
     * @return void
     */
    public function statusKO($controller, $id)
    {
        $idGet = $id ? "&id=$id" : "";
        $this->redirect("./index.php?controller=$controller$idGet&status=ko");
        exit();
    }

    /**
     * En caso de que la acción sea exitosa, redirige a la página que corresponda
     *
     * @return void
     */
    public function statusOK()
    {
        $this->redirect('./index.php?controller=adminUsers&status=ok');
    }
}
