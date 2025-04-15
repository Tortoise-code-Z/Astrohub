<?php
require_once './controllers/BaseController.php';
require_once './models/UserDataModel.php';
require_once './models/UserLoginModel.php';
require_once './utils/Sanitized.php';
require_once './config/error-log.php';

/**
 * Clase para representar el controlador de los usuarios (perfil).
 *
 * Esta clase realiza funciones para renderizar, crear, borrar y editar datos de un usuario.
 *
 * @package    Controladores
 * @subpackage    Usuarios/Perfil
 * @author     Víctor Pérez
 */

class UserController extends BaseController
{

    /**
     *  Renderiza la vista del perfil
     *
     * @return void
     */
    public function renderProfile()
    {
        $this->requireLogin();
        $userDataModel = new UserDataModel();
        $user = $userDataModel->getUserById($_SESSION['user']['idUser']);

        $this->render('perfil', $user, false);
    }

    /**
     *  Actualiza los datos del usuario
     *
     * @return void
     */
    public function updateUserData()
    {
        $data = [
            'name' => ['input' => $_POST['name'], 'type' => 'string', 'canEmpty' => false],
            'surname' => ['input' => $_POST['surname'], 'type' => 'string', 'canEmpty' => false],
            'email' => ['input' => $_POST['email'], 'type' => 'email', 'canEmpty' => false],
            'dir' => ['input' => $_POST['dir'], 'type' => 'string', 'canEmpty' => true],
            'sex' => ['input' => $_POST['sex'], 'type' => 'string', 'canEmpty' => false],
            'tel' => ['input' => $_POST['tel'], 'type' => 'string', 'canEmpty' => false],
            'date' => ['input' => $_POST['dateBirth'], 'type' => 'date', 'canEmpty' => false],
        ];

        $sanitize = new Sanitized($data);
        $sanitize->sanitize();
        $isValid = $sanitize->isValid();

        if (!$isValid) {
            $this->createSessionVarKO($sanitize, []);
            $this->statusKO('perfil', 'data');
        }

        $dataModel = new UserDataModel();
        $idUser = $_SESSION['user']['idUser'];

        $emailRecord = $dataModel->getEmail($sanitize->getSanitizeInput('email'));
        $isCurrentUser = $emailRecord && $emailRecord['idUser'] === intval($idUser);

        if ($emailRecord && !$isCurrentUser) {
            $sanitize->setError('email', ERR_EMAIL);
            $this->createSessionVarKO($sanitize, []);
            $this->statusKO('perfil', 'data');
        }

        $dataUpdate = [
            'nombre' => $sanitize->getSanitizeInput('name'),
            'apellidos' => $sanitize->getSanitizeInput('surname'),
            'email' => $sanitize->getSanitizeInput('email'),
            'direccion' => $sanitize->getSanitizeInput('dir'),
            'sexo' => $sanitize->getSanitizeInput('sex'),
            'telefono' => $sanitize->getSanitizeInput('tel'),
            'fecha_nacimiento' => $sanitize->getSanitizeInput('date'),
        ];

        $dataModel->updateUser($idUser, $dataUpdate);
        $this->statusOK('perfil', 'data');
    }

    /**
     *  Actualiza la contraseña del usuario
     *
     * @return void
     */
    public function updatePassword()
    {
        $userLoginModel = new userLoginModel();

        $data = [
            'password' => ['input' => $_POST['password'], 'type' => 'string', 'canEmpty' => false],
            'repeatPassword' => ['input' => $_POST['repeatPassword'], 'type' => 'string', 'canEmpty' => false],
        ];

        $sanitize = new Sanitized($data);
        $sanitize->sanitize();
        $isValid = $sanitize->isValid();

        if (!$isValid) {
            $this->createSessionVarKO($sanitize, ['password', 'repeatPassword']);
            $this->statusKO('perfil', 'password');
        }

        if ($sanitize->getSanitizeInput('password') !== $sanitize->getSanitizeInput('repeatPassword')) {
            $this->createSessionVarKO($sanitize, ['password', 'repeatPassword']);
            $this->statusKO('perfil', 'password');
        }

        $idUser = $_SESSION['user']['idUser'];
        $passwordHash = password_hash($sanitize->getSanitizeInput('password'), PASSWORD_BCRYPT);

        $userLoginModel->updateOne('password', $passwordHash, $idUser);
        $_SESSION['user']['password'] = $passwordHash;

        $this->statusOK('perfil', 'password');
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
    public function statusKO($controller, $action)
    {
        $_SESSION["error-$action"] = false;
        $this->redirect("./index.php?controller=$controller&status=ko");
        exit();
    }

    /**
     * En caso de que la acción sea exitosa, redirige a la página correspondiente
     *
     * @return void
     */
    public function statusOK($controller, $action)
    {
        $_SESSION["success-$action"] = true;
        $this->redirect("./index.php?controller=$controller&status=ok");
    }
}
