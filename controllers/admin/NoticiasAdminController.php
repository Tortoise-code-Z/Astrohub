<?php
require_once './controllers/BaseController.php';
require_once './models/UserLoginModel.php';
require_once './models/NoticiasModel.php';
require_once './config/error-log.php';

/**
 * Clase para representar el controlador de administración de las noticias.
 *
 * Esta clase realiza funciones para renderizar, crear, borrar y editar noticias desde
 * administración.
 *
 * @package    Controladores
 * @subpackage    Noticias Administración
 * @author     Víctor Pérez
 */

class NoticiasAdminController extends BaseController
{

    /**
     *  Renderiza la vista de administración de noticias
     *
     * @return void
     */
    public function renderNoticiasController()
    {
        $this->requireAdmin();
        $userLoginModel = new UserLoginModel();
        $users = $userLoginModel->getAllUsersLogin();
        $this->render('noticias-administracion', ['users' => $users], true);
    }

    /**
     *  Renderiza la vista de administración de creación de noticias
     *
     * @return void
     */
    public function renderCreateNew()
    {
        $this->requireAdmin();
        $userLoginModel = new UserLoginModel();
        $users = $userLoginModel->getAllUsernames();
        $this->render('create-noticias-administracion', ['users' => $users], true);
    }


    /**
     *  Renderiza la vista de administración de edición de noticias
     *
     * @return void
     */
    public function renderEditNews()
    {
        $this->requireAdmin();

        $newsModel = new NoticiasModel();
        $new = $newsModel->getNoticiaById($_GET['id']);

        if (!$new) {
            $this->redirect('./index.php?controller=adminNews&status=ko');
            return;
        }

        $userLoginModel = new UserLoginModel();
        $user = $userLoginModel->getUserLoginByUserId($new['idUser']);

        $this->render('edit-noticias-administracion', ['new' => $new, 'user' => $user], true);
    }

    /**
     *  Elimina una noticia
     *
     * @return void
     */
    public function deleteNew()
    {
        $noticiasModel = new NoticiasModel();
        $noticia = $noticiasModel->getNoticiaById($_GET['id']);

        if (!$noticia) {
            $this->statusKO('adminNews', false);
            return;
        }

        // Eliminar la noticia
        $noticiasModel->deleteNoticia($_GET['id']);

        $this->statusOK();
    }

    /**
     *  Actualiza una noticia
     *
     * @return void
     */
    public function checkNew()
    {
        $data = [
            'new_title' => ['input' => $_POST['title'], 'type' => 'string', 'canEmpty' => false],
            'date' => ['input' => $_POST['date'], 'type' => 'date', 'canEmpty' => false],
            'new_desc' => ['input' => $_POST['description'], 'type' => 'string', 'canEmpty' => false],
            'image' => ['input' => $_POST['image'], 'type' => 'string', 'canEmpty' => false],
        ];

        $sanitize = new Sanitized($data);
        $sanitize->sanitize();
        $isValid = $sanitize->isValid();

        if (!$isValid) {
            $this->createSessionVarKO($sanitize, []);
            $this->statusKO('adminEditNews', $_GET['id']);
        }

        $newsModel = new NoticiasModel();
        $newData = $newsModel->getNoticiaById($_GET['id']);

        $dataUpdate = [
            'titulo' => $sanitize->getSanitizeInput('new_title'),
            'imagen' => $sanitize->getSanitizeInput('image'),
            'texto' => $sanitize->getSanitizeInput('new_desc'),
            'fecha' => $sanitize->getSanitizeInput('date'),
        ];

        $newsModel->updateNoticia($newData['idNoticia'], $dataUpdate);

        $this->statusOK();
    }

    /**
     *  Crea una noticia
     *
     * @return void
     */
    public function createNew()
    {
        $data = [
            'username' => ['input' => $_POST['username'], 'type' => 'string', 'canEmpty' => false],
            'new_title' => ['input' => $_POST['title'], 'type' => 'string', 'canEmpty' => false],
            'date' => ['input' => $_POST['date'], 'type' => 'date', 'canEmpty' => false],
            'new_desc' => ['input' => $_POST['description'], 'type' => 'string', 'canEmpty' => false],
            'image' => ['input' => $_POST['image'], 'type' => 'string', 'canEmpty' => false],
        ];

        $sanitize = new Sanitized($data);
        $sanitize->sanitize();
        $isValid = $sanitize->isValid();

        if (!$isValid) {
            $this->createSessionVarKO($sanitize, []);
            $this->statusKO('adminCreateNew', false);
        }

        $newsModel = new NoticiasModel();
        $userLoginModel = new UserLoginModel();

        $user = $userLoginModel->getUserByUsername($sanitize->getSanitizeInput('username'));
        $idUser = $user['idUser'];

        if (!$idUser) {
            $_SESSION['errors'] = ['username' => ERR_USERNAME];
            $_SESSION['old_values'] = $sanitize->getAllSanitizedInputs();
            $this->statusKO('adminCreateNew', false);
        }

        $data = [
            'titulo' => $sanitize->getSanitizeInput('new_title'),
            'imagen' => $sanitize->getSanitizeInput('image'),
            'texto' => $sanitize->getSanitizeInput('new_desc'),
            'fecha' => $sanitize->getSanitizeInput('date'),
            'idUser' => $idUser,
        ];

        $newsModel->createNoticia($data);
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
     * @param int $id identificador de la noticia
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
        $this->redirect('./index.php?controller=adminNews&status=ok');
    }
}
