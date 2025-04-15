<?php
require_once './controllers/BaseController.php';
require_once './models/UserLoginModel.php';
require_once './models/UserDataModel.php';
require_once './config/error-log.php';
require_once './utils/Sanitized.php';

/**
 * Clase para representar el controlador de la autenticación del usuario.
 *
 * Esta clase realiza validaciones y renderizaciones del login y el registro.
 *
 * @package    Controladores
 * @subpackage    Autenticación
 * @author     Víctor Pérez
 */

class AuthController extends BaseController
{

    /**
     * Renderiza la vista del registro
     *
     * @return void
     */
    public function renderRegister()
    {
        $this->render('registro', [], false);
    }

    /**
     * Renderiza la vista del login
     *
     * @return void
     */
    public function renderLogin()
    {
        $this->render('login', [], false);
    }

    /**
     * Revisa si el inicio de sesión es correcto
     *
     * @return void
     */
    public function loginCheck()
    {
        $userLoginModel = new UserLoginModel();

        $data = [
            'username' => ['input' => $_POST['username'], 'type' => 'string'],
            'password' => ['input' => $_POST['password'], 'type' => 'string'],
        ];

        $sanitize = new Sanitized($data);
        $sanitize->sanitize();
        $isValid = $sanitize->isValid();

        if (!$isValid) {
            $this->createSessionVarKO($sanitize, ['password']);
            $this->statusKO('renderLogin');
        }

        $user = $userLoginModel->getUserByUsername($sanitize->getSanitizeInput('username'));

        // Si el usuario no existe en la bbdd, se muestra el mensaje de error
        if (!$user) {
            $sanitize->setError('username', ERR_USERNAME);
            $this->createSessionVarKO($sanitize, ['password']);
            $this->statusKO('renderLogin');
        }

        // Si el usuario existe y la contraseña es incorrecta, se muestra el mensaje de error
        $passwordVerify = password_verify($sanitize->getSanitizeInput('password'), $user['password']);
        if (!$passwordVerify) {
            $sanitize->setError('password', ERR_PASSWORD);
            $this->createSessionVarKO($sanitize, ['password']);
            $this->statusKO('renderLogin');
        }

        $userSesion = [
            'idUser' => $user['idUser'],
            'usuario' => $user['usuario'],
            'rol' => $user['rol']
        ];

        $this->createUserSession($userSesion);
        $this->statusOK("home");
    }

    /**
     * Revisa si el registro es correcto
     *
     * @return void
     */
    public function checkRegister()
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
            'repeatPassword' => ['input' => $_POST['repeatPassword'], 'type' => 'string', 'canEmpty' => false],
            'terms' => ['input' => $_POST['terms'], 'type' => 'string', 'canEmpty' => true],
        ];

        $sanitize = new Sanitized($data);
        $sanitize->sanitize();
        $isValid = $sanitize->isValid();

        if (!$isValid) {
            $this->createSessionVarKO($sanitize, ['password', 'repeatPassword']);
            $this->statusKO('renderRegistro');
        }

        $user = $userLoginModel->getUserByUsername($sanitize->getSanitizeInput('username'));
        $email = $userDataModel->getEmail($sanitize->getSanitizeInput('email'));

        // Si el email no existe en la bbdd, se muestra el mensaje de error y se acaba el script
        if ($email) {
            $sanitize->setError('email', ERR_EMAIL);
            $this->createSessionVarKO($sanitize, ['password', 'repeatPassword']);
            $this->statusKO('renderRegistro');
        }

        // Si el usuario no existe en la bbdd, se muestra el mensaje de error y se acaba el script
        if ($user) {
            $sanitize->setError('username', ERR_USERNAME_REG);
            $this->createSessionVarKO($sanitize, ['password', 'repeatPassword']);
            $this->statusKO('renderRegistro');
        }

        // Si ambos no están registrados en la base de datos, se crea el registro del usuario en la tabla de userData
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

        // Crear registro en la tabla userLogin
        $idUser = $userDataModel->getIdUserByEmail($sanitize->getSanitizeInput('email'));
        $passwordHash = password_hash($sanitize->getSanitizeInput('password'), PASSWORD_BCRYPT);

        $loginData = [
            'idUser' => $idUser,
            'username' => $sanitize->getSanitizeInput('username'),
            'password' => $passwordHash,
            'rol' => 'user'
        ];

        $userLoginModel->createUserLogin($loginData);

        $userSesion = [
            'idUser' => $idUser,
            'usuario' => $sanitize->getSanitizeInput('username'),
            'rol' => 'user'
        ];

        $this->createUserSession($userSesion);
        $this->statusOK("home");
    }

    /**
     * Cierra sesión y redirige a la página de inicio
     *
     * @return void
     */
    public function logout()
    {
        session_destroy();
        $this->redirect('./index.php?controller=home');
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
     * @return void
     */
    public function statusKO($controller)
    {
        $this->redirect("./index.php?controller=$controller&status=ko");
        exit();
    }

    /**
     * En caso de que el inicio de sesion, o el registro, sea exitoso redirige a la página que corresponda en cada caso
     *
     * @param string $controller valor del controlador que recibirá el router index.php
     * @return void
     */
    public function statusOK($controller)
    {
        $this->redirect("./index.php?controller=$controller&status=ok");
    }

    /**
     * En caso de que el registro sea exitoso, crea la variable de sesion con los datos del usuario
     *
     * @param array $user valores de sesión del usuario
     * @return void
     */
    public function createUserSession($user)
    {
        $_SESSION['user'] = $user;
    }
}
