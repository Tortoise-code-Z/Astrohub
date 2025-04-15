<?php
require_once(__DIR__ . '/../config/error-log.php');

/**
 * Clase para representar la sanación de datos.
 *
 * Esta clase realiza la sanación de los datos enviados a la bbdd.
 *
 * @package    Utils
 * @subpackage    Sanitizar
 * @author     Víctor Pérez
 */

class Sanitized
{
    /**
     * Datos a sanar de los formularios 
     *
     * @var array
     */
    public $data;

    /**
     * Datos sanados + información extra
     *
     * @var array
     */
    public $dataSanitizedInfo = [];

    /**
     * Datos sanados
     *
     * @var array
     */
    public $dataSanitized = [];

    /**
     * Errores de cada campo
     *
     * @var array
     */
    public $errors = [];

    /**
     * Constructor de la clase Sanitized.
     *
     * Recoge los datos a sanar.
     *
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Guarda los campos sanados en sus variables
     *
     * @return void
     */
    public function sanitize()
    {
        foreach ($this->data as $key => $value) {

            switch ($value['type']) {
                case 'string':
                    $sanitize = htmlspecialchars(stripslashes(trim($value['input'])));
                    break;
                case 'email':
                    $sanitize = filter_var(trim($value['input']), FILTER_SANITIZE_EMAIL);
                    break;
                case 'int':
                    $sanitize = filter_var($value['input'], FILTER_SANITIZE_NUMBER_INT);
                    break;
                case 'float':
                    $sanitize = filter_var($value['input'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    break;
                default:
                    $sanitize = htmlspecialchars(stripslashes(trim($value['input'])));
            }

            $this->dataSanitizedInfo[$key] = ['value' => $sanitize, 'canEmpty' => $value['canEmpty'], 'type' => $value['type']];
            $this->dataSanitized[$key] = $sanitize;
        }
    }

    /**
     * Revisa si los campos son válidos.
     *
     * @return boolean
     */
    public function isValid()
    {
        foreach (
            $this->dataSanitizedInfo as $key => $value
        ) {
            if ($value['type'] === 'string') {
                if (!$value['value'] && !$value['canEmpty']) {
                    $this->setError($key, ERR_EMPTY);
                    continue;
                }

                // Si el campo es un teléfono.
                if ($key === 'tel') {
                    if (!preg_match('/^\d{7,15}$/', $value['value'])) {
                        $this->setError($key, ERR_TEL_SAN);
                        continue;
                    }
                }

                // Si el campo es para el sexo del usuario.
                if ($key === 'sex') {
                    if (
                        $value['value'] !== "Masculino" &&
                        $value['value'] !== "Femenino" &&
                        $value['value'] !== "Sin definir"
                    ) {
                        $this->setError($key, ERR_SEX_SAN);
                        continue;
                    }
                }

                // Si el campo es para el rol del usuario.
                if ($key === 'rol') {
                    if (
                        $value['value'] !== "user" &&
                        $value['value'] !== "admin"
                    ) {
                        $this->setError($key, ERR_ROL_SAN);
                        continue;
                    }
                }

                // Para el usuario
                if ($key === 'username') {
                    if (!preg_match('/^[a-zA-Z0-9._]{3,20}$/', $value['value'])) {
                        $this->setError($key, ERR_USERNAME_SAN);
                        continue;
                    }
                }

                // Para la contraseña
                if ($key === 'password') {
                    if (!preg_match('/^.{6,}$/', $value['value'])) {
                        $this->setError($key, ERR_PASSWORD_SAN);
                        continue;
                    }
                }

                // Para la contraseña de repetición de campo.
                if ($key === 'repeatPassword') {
                    if ($value['value'] !== $this->dataSanitizedInfo['password']['value']) {
                        $this->setError($key, ERR_REPEAT_PASSWORD_SAN);
                        continue;
                    }
                }

                // Para la el nombre 
                if ($key === 'name') {
                    if (!preg_match('/^[a-zA-ZáéíóúñÁÉÍÓÚÑ ]{2,50}$/', $value['value'])) {
                        $this->setError($key, ERR_NAME_SAN);
                        continue;
                    }
                }

                // Para la el apellido
                if ($key === 'surname') {
                    if (!preg_match('/^[a-zA-ZáéíóúñÁÉÍÓÚÑ  ]{2,50}$/', $value['value'])) {
                        $this->setError($key, ERR_SURNAME_SAN);
                        continue;
                    }
                }

                // Para la la direccion
                if ($key === 'dir') {
                    if (strlen($value['value']) > 100) {
                        $this->setError($key, ERR_DIR_SAN);
                        continue;
                    }
                }

                // Para la el motivo de las citas
                if ($key === 'appointment_reason' || $key === 'h-appointment_reason') {
                    if (!preg_match('/^[a-zA-Z0-9.,-_áéíóúñÁÉÍÓÚÑ ]{3,100}$/', $value['value'])) {
                        $this->setError($key, ERR_MOTIVO_CITA_SAN);
                        continue;
                    }
                }

                // Para la el titulo de las noticias
                if ($key === 'new_title') {
                    if (!preg_match('/^[a-zA-Z0-9.,-_áéíóúñÁÉÍÓÚÑ ]{3,70}$/', $value['value'])) {
                        $this->setError($key, ERR_TITULO_NOTICIA_SAN);
                        continue;
                    }
                }

                // Para la la descripción de las noticias.
                if ($key === 'new_desc') {
                    if (!preg_match('/^[a-zA-Z0-9.,-_áéíóúñÁÉÍÓÚÑ ]{3,170}$/', $value['value'])) {
                        $this->setError($key, ERR_DESC_NOTICIA_SAN);
                        continue;
                    }
                }

                // Para la las imagenes de las noticias.
                if ($key === 'image') {
                    if (!preg_match('/^[\w,\s-]+\.(jpg|jpeg|png)$/', $value['value'])) {
                        $this->setError($key, ERR_IMAGE_SAN);
                        continue;
                    }
                }

                // Para la las imagenes de las noticias.
                if ($key === 'terms') {
                    if ($value['value'] !== 'checked') {
                        $this->setError($key, ERR_TERMS);
                        continue;
                    }
                }
            }

            if ($value['type'] === 'email') {
                if (!filter_var($value['value'], FILTER_VALIDATE_EMAIL)) {
                    $this->setError($key, "El email no es válido.");
                }
                continue;
            }

            if ($value['type'] === 'int') {
                if (!filter_var($value['value'], FILTER_VALIDATE_INT)) {
                    $this->setError($key, "Debe ser un número entero.");
                }
                continue;
            }

            if ($value['type'] === 'float') {
                if (!filter_var($value['value'], FILTER_VALIDATE_FLOAT)) {
                    $this->setError($key, "Debe ser un número decimal.");
                }
                continue;
            }

            if ($value['type'] === 'date') {

                if (!$value['value'] && !$value['canEmpty']) {
                    $this->setError($key, ERR_EMPTY);
                    continue;
                }

                if (!$this->validarFecha($value['value'], 'Y-m-d')) {
                    $this->setError($key, "La fecha no es válida. Debe estar en formato YYYY-MM-DD.");
                    continue;
                }

                // Para la fecha de las citas
                if ($key === 'appointment_date' || $key === 'h-appointment_date') {
                    $actualDate = new DateTime();
                    $date = new DateTime($value['value']);
                    if ($date < $actualDate) {
                        $this->setError($key, "La fecha debe ser posterior al día de hoy.");
                        continue;
                    }
                }
            }
        }

        return count($this->errors) === 0  ? true : false;
    }

    /**
     * Valida si una fecha tiene el formato correcto.
     *
     * @param string $fecha
     * @param string $formato (por defecto Y-m-d)
     * @return bool
     */
    public function validarFecha($fecha, $formato = 'Y-m-d')
    {
        $date = DateTime::createFromFormat($formato, $fecha);
        return $date && $date->format($formato) === $fecha;
    }

    /**
     * Obtiene los errores
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Envía los errores
     *
     * @return void
     */
    public function setError($name, $value)
    {
        $this->errors[$name] = $value;
    }

    /**
     * Obtiene todos los campos sanados
     *
     * @return array
     */
    public function getAllSanitizedInputs()
    {
        return $this->dataSanitized;
    }

    /**
     * Elimina campos sensibles al recuperar datos, como contraseñas
     *
     * @return void
     */
    public function deleteSensibleInputs($sensibleInputs)
    {
        foreach ($sensibleInputs as $value) {
            unset($this->dataSanitized[$value]);
        }
    }

    /**
     * Obtiene el valor de un input sanado
     *
     * @return string
     */
    public function getSanitizeInput($value)
    {
        return $this->dataSanitized[$value];
    }
}
