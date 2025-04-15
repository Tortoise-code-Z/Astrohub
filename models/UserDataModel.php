<?php
require_once 'BaseModel.php';

/**
 * Clase para representar el modelo de los datos generales del usuario como el nombre, apellidos, etc.
 *
 * Esta clase realiza operaciones CRUD para los usuarios.
 *
 * @package    Modelos
 * @subpackage    Datos Generales Usuarios
 * @author     Víctor Pérez
 */

class UserDataModel extends BaseModel
{
    /**
     *  Obtiene todos los usuarios
     *
     * @return array Devuelve todos los usuarios
     */
    public function getAllUsers()
    {
        $sql = "SELECT * FROM users_data";
        return $this->fetchAll($sql);
    }

    /**
     *  Obtiene un usuario por su id
     *
     * @param int $id identificador del usuario
     * @return array Devuelve el usuario correspondiente
     */
    public function getUserById($id)
    {
        $sql = "SELECT * FROM users_data WHERE idUser = ?";
        return $this->fetchOne($sql, [$id]);
    }

    /**
     *  Obtiene el id del usuario por el email
     *
     * @param string $email email del usuario
     * @return int Devuelve el id del usuario
     */
    public function getIdUserByEmail($email)
    {
        $sql = 'SELECT idUser FROM users_data WHERE email = ?';
        $result = $this->fetchOne($sql, [$email]);
        return $result['idUser'];
    }

    /**
     *  Obtiene usuario por el email
     *
     * @param string $email email
     * @return array Devuelve los datos del usuario
     */
    public function getEmail($email)
    {
        $sql = "SELECT * FROM users_data WHERE email = ?";
        return $this->fetchOne($sql, [$email]);
    }

    /**
     *  Crea un usuario y lo introduce en la base de datos
     *
     * @param array $data array asociativo con los valores de cada campo
     * @return void
     */
    public function createUser($data)
    {
        $sql = "INSERT INTO users_data (nombre, apellidos, email, telefono, fecha_nacimiento, direccion, sexo) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $this->query($sql, array_values($data));
    }

    /**
     *  Actualiza un usuario
     *
     * @param int $id identificador del usuario
     * @param array $data array asociativo con los valores de cada campo a actualizar
     * @return void
     */
    public function updateUser($id, $data)
    {
        $fields = array_keys($data);
        $sql = "UPDATE users_data SET " . implode(' = ?, ', $fields) . " = ? WHERE idUser = $id";

        $values = array_values($data);

        $this->query($sql, $values);
    }

    /**
     *  Elimina un usuario
     *
     * @param int $id identificador del usuario
     * @return void
     */
    public function deleteUser($id)
    {
        $sql = "DELETE FROM users_data WHERE idUser = ?";
        $this->query($sql, [$id]);
    }
}
