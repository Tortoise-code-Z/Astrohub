<?php
require_once './controllers/BaseController.php';
require_once './models/UserLoginModel.php';
require_once './models/CitacionesModel.php';

/**
 * Clase para representar el controlador de administración de las citas.
 *
 * Esta clase realiza funciones para renderizar, crear, borrar y editar citas desde
 * administración.
 *
 * @package    Controladores
 * @subpackage    Citas Administración
 * @author     Víctor Pérez
 */

class CitasAdminController extends BaseController
{
    /**
     *  Renderiza la vista de administración de citas
     *
     * @return void
     */
    public function renderCitasController()
    {
        $this->requireAdmin();
        $userLoginModel = new UserLoginModel();
        $users = $userLoginModel->getAllUsersLogin();
        $this->render('citaciones-administracion', ['users' => $users], true);
    }

    /**
     *  Renderiza la vista de administración de creación de citas
     *
     * @return void
     */
    public function renderCreateAppointment()
    {
        $this->requireAdmin();
        $userLoginModel = new UserLoginModel();
        $users = $userLoginModel->getAllUsernames();
        $this->render('create-citaciones-administracion', ['users' => $users], true);
    }

    /**
     *  Renderiza la vista de administración de edición de citas
     *
     * @return void
     */
    public function renderEditCitas()
    {
        $this->requireAdmin();

        $citacionesModel = new CitacionesModel();
        $cita = $citacionesModel->getCitaById($_GET['id']);

        if (!$cita) {
            $this->redirect('./index.php?controller=adminCitas&status=ko');
            return;
        }

        $userLoginModel = new UserLoginModel();
        $user = $userLoginModel->getUserLoginByUserId($cita['idUser']);

        $this->render('edit-citaciones-administracion', ['cita' => $cita, 'user' => $user], true);
    }

    /**
     *  Borra una cita
     *
     * @return void
     */
    public function deleteCita()
    {
        $citacionesModel = new CitacionesModel();
        $cita = $citacionesModel->getCitaById($_GET['id']);

        if (!$cita) {
            $this->redirect('./index.php?controller=adminCitas&status=ko');
            return;
        }

        $citacionesModel->deleteCita($_GET['id']);
        $this->redirect('./index.php?controller=adminCitas&status=ok');
    }

    /**
     *  Actualiza una cita
     *
     * @return void
     */
    public function checkAppointment()
    {
        $data = [
            'appointment_reason' => ['input' => $_POST['reason'], 'type' => 'string', 'canEmpty' => false],
            'appointment_date' => ['input' => $_POST['date'], 'type' => 'date', 'canEmpty' => false],
        ];

        $sanitize = new Sanitized($data);
        $sanitize->sanitize();
        $isValid = $sanitize->isValid();

        if (!$isValid) {
            $this->createSessionVarKO($sanitize, []);
            $this->statusKO('adminEditCita', $_GET['id']);
        }

        $citacionesModel = new CitacionesModel();
        $citaData = $citacionesModel->getCitaById($_GET['id']);

        $dataUpdate = [
            'motivo_cita' => $sanitize->getSanitizeInput('appointment_reason'),
            'fecha_cita' => $sanitize->getSanitizeInput('appointment_date'),
        ];

        $citacionesModel->updateCita($citaData['idCita'], $dataUpdate);
        $this->statusOK();
    }

    /**
     *  Crea una cita
     *
     * @return void
     */
    public function createAppointment()
    {
        $data = [
            'username' => ['input' => $_POST['username'], 'type' => 'string', 'canEmpty' => false],
            'appointment_reason' => ['input' => $_POST['reason'], 'type' => 'string', 'canEmpty' => false],
            'appointment_date' => ['input' => $_POST['date'], 'type' => 'date', 'canEmpty' => false],
        ];

        $sanitize = new Sanitized($data);
        $sanitize->sanitize();
        $isValid = $sanitize->isValid();

        if (!$isValid) {
            $this->createSessionVarKO($sanitize, []);
            $this->statusKO('adminCreateCita', false);
        }

        $citacionesModel = new CitacionesModel();
        $userLoginModel = new UserLoginModel();

        $user = $userLoginModel->getUserByUsername($sanitize->getSanitizeInput('username'));
        $idUser = $user['idUser'];

        if (!$idUser) {
            $_SESSION['errors'] = ['username' => ERR_USERNAME];
            $_SESSION['old_values'] = $sanitize->getAllSanitizedInputs();
            $this->statusKO('adminCreateCita', false);
        }

        $data = [
            'idUser' => $idUser,
            'fecha_cita' => $sanitize->getSanitizeInput('appointment_date'),
            'motivo_cita' => $sanitize->getSanitizeInput('appointment_reason'),
        ];

        $citacionesModel->createCita($data);
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
     * @param int $id identificador de la cita
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
        $this->redirect('./index.php?controller=adminCitas&status=ok');
    }
}
