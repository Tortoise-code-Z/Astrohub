<?php
require_once './controllers/BaseController.php';
require_once './models/CitacionesModel.php';

/**
 * Clase para representar el controlador de las citas.
 *
 * Esta clase realiza funciones para renderizar, crear, borrar y editar citas.
 *
 * @package    Controladores
 * @subpackage    Citas
 * @author     Víctor Pérez
 */

class CitasController extends BaseController
{
    /**
     *  Renderiza la vista del usuario
     *
     * @return void
     */
    public function appointments()
    {
        $this->requireLogin();

        $citasModel = new CitacionesModel();
        $citas = $citasModel->getCitasByIdUser($_SESSION['user']['idUser']);

        $this->render('citaciones', ['citas' => $citas], false);
    }

    public function deleteCita()
    {
        $citacionesModel = new CitacionesModel();
        $cita = $citacionesModel->getCitaById($_GET['id']);

        if (!$cita) {
            $this->statusKO('citas', false);
            return;
        }

        $citacionesModel->deleteCita($_GET['id']);
        $this->statusOK('delete');
    }

    /**
     * Crea una cita
     *
     * @return void
     */
    public function createAppointment()
    {
        $data = [
            'appointment_reason' => ['input' => $_POST['appointment_reason'], 'type' => 'string', 'canEmpty' => false],
            'appointment_date' => ['input' => $_POST['appointment_date'], 'type' => 'date', 'canEmpty' => false],
        ];

        $sanitize = new Sanitized($data);
        $sanitize->sanitize();
        $isValid = $sanitize->isValid();

        if (!$isValid) {
            $this->createSessionVarKO($sanitize, []);
            $this->statusKO('citas', false);
        }

        $citacionesModel = new CitacionesModel();

        $data = [
            'idUser' => $_SESSION['user']['idUser'],
            'fecha_cita' => $sanitize->getSanitizeInput('appointment_date'),
            'motivo_cita' => $sanitize->getSanitizeInput('appointment_reason'),
        ];

        $citacionesModel->createCita($data);
        $this->statusOK('create');
    }

    /**
     * Actualiza una cita
     *
     * @return void
     */
    public function checkAppointment()
    {
        $data = [
            'h-appointment_reason' => ['input' => $_POST['h-reason'], 'type' => 'string', 'canEmpty' => false],
            'h-appointment_date' => ['input' => $_POST['h-date'], 'type' => 'date', 'canEmpty' => false],
        ];

        $sanitize = new Sanitized($data);
        $sanitize->sanitize();
        $isValid = $sanitize->isValid();

        if (!$isValid) {
            $this->createSessionVarKO($sanitize, []);
            $this->statusKO('citas', $_GET['id']);
        }

        $citacionesModel = new CitacionesModel();
        $citaData = $citacionesModel->getCitaById($_GET['id']);

        $dataUpdate = [
            'motivo_cita' => $sanitize->getSanitizeInput('h-appointment_reason'),
            'fecha_cita' => $sanitize->getSanitizeInput('h-appointment_date'),
        ];

        $citacionesModel->updateCita($citaData['idCita'], $dataUpdate);
        $this->statusOK('edit');
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
     * En caso de que el inicio de sesion, o el registro, sea exitoso redirige a la página que corresponda en cada caso
     *
     * @return void
     */
    public function statusOK($action)
    {
        $_SESSION["success-$action"] = true;
        $this->redirect('./index.php?controller=citas&status=ok');
    }

    /**
     * Borra una cita
     *
     * @return void
     */
}
