<?php
require_once 'BaseModel.php';

/**
 * Clase para representar el modelo de las citas.
 *
 * Esta clase realiza operaciones CRUD para las citas.
 *
 * @package    Modelos
 * @subpackage    Citas
 * @author     Víctor Pérez
 */

class CitacionesModel extends BaseModel
{
    /**
     *  Obtiene todas las citas
     *
     * @return array Devuelve todas las citas
     */
    public function getAllCitas()
    {
        $sql = "SELECT * FROM citas";
        return $this->fetchAll($sql);
    }

    /**
     *  Obtiene una cita por su id
     *
     * @param int $id identificador de la cita
     * @return array Devuelve la cita correspondiente
     */
    public function getCitaById($id)
    {
        $sql = "SELECT * FROM citas WHERE idCita = ?";
        return $this->fetchOne($sql, [$id]);
    }

    /**
     *  Obtiene todas las citas de un usuario
     *
     * @param int $id identificador del usuario
     * @return array Devuelve las citas del usuario
     */
    public function getCitasByIdUser($id)
    {
        $sql = "SELECT * FROM citas WHERE idUser = $id";
        return $this->fetchAll($sql);
    }

    /**
     *  Crea una cita y la introduce en la base de datos
     *
     * @param array $data array asociativo con los valores de cada campo
     * @return void
     */
    public function createCita($data)
    {
        $sql = "INSERT INTO citas (idUser, fecha_cita, motivo_cita) VALUES (?, ?, ?)";
        $this->query($sql, array_values($data));
    }

    /**
     *  Actualiza una cita
     *
     * @param int $id identificador de la cita
     * @param array $data array asociativo con los valores de cada campo a actualizar
     * @return void
     */
    public function updateCita($id, $data)
    {
        $fields = array_keys($data);
        $sql = "UPDATE citas SET " . implode(' = ?, ', $fields) . " = ? WHERE idCita = $id";

        $values = array_values($data);

        $this->query($sql, $values);
    }

    /**
     *  Elimina una cita
     *
     * @param int $id identificador de la cita
     * @return void
     */
    public function deleteCita($id)
    {
        $sql = "DELETE FROM citas WHERE idCita = ?";
        $this->query($sql, [$id]);
    }
}
