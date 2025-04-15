<?php
require_once 'BaseModel.php';
require_once 'BaseModel.php';

/**
 * Clase para representar el modelo de los datos de sesión del usuario como el nombre de usuario, contraseña, rol, etc.
 *
 * Esta clase realiza operaciones CRUD para los usuarios.
 *
 * @package    Modelos
 * @subpackage    Datos Sesión Usuarios
 * @author     Víctor Pérez
 */

class UserLoginModel extends BaseModel
{
    /**
     *  Obtiene todos los nombres de usuarios
     *
     * @return array Devuelve todos los nombres de los usuarios
     */
    public function getAllUsernames()
    {
        $sql = "SELECT usuario
                FROM users_login
                ORDER BY usuario ASC;
                ";
        return $this->fetchAll($sql);
    }

    /**
     *  Obtiene todos los usuarios
     *
     * @return array Devuelve todos los usuarios
     */
    public function getAllUsersLogin()
    {
        $sql = "SELECT *
                 FROM users_login
                 ORDER BY usuario ASC;
                 ";
        return $this->fetchAll($sql);
    }

    /**
     *  Obtiene un usuario por su nombre de usuario
     *
     * @param string $username Nombre del usuario
     * @return array Devuelve el usuario correspondiente
     */
    public function getUserByUsername($username)
    {
        $sql = "SELECT * FROM users_login WHERE usuario = ?";
        return $this->fetchOne($sql, [$username]);
    }

    /**
     *  Obtiene un usuario por su id
     *
     * @param int $id identificador del usuario
     * @return array Devuelve el usuario correspondiente
     */
    public function getUserLoginByUserId($id)
    {
        $sql = "SELECT * FROM users_login WHERE idUser = ?";
        return $this->fetchOne($sql, [$id]);
    }

    /**
     *  Crea un usuario y lo introduce en la base de datos
     *
     * @param array $data array asociativo con los valores de cada campo
     * @return void
     */
    public function createUserLogin($data)
    {
        $sql = "INSERT INTO users_login (idUser, usuario, password, rol) VALUES (?, ?, ?, ?)";
        $this->query($sql, array_values($data));
    }

    /**
     *  Actualiza un usuario
     *
     * @param int $id identificador del usuario
     * @param array $data array asociativo con los valores de cada campo a actualizar
     * @return void
     */
    public function updateUserLogin($id, $data)
    {
        $fields = array_keys($data);
        $sql = "UPDATE users_login SET " . implode(' = ?, ', $fields) . " = ? WHERE idUser = $id";

        $values = array_values($data);

        $this->query($sql, $values);
    }

    /**
     *  Actualiza una columna de un usuario
     *
     * @param string $row nombre de la columna a actualizar
     * @param int $id identificador del usuario
     * @param array $data array asociativo con los valores de cada campo a actualizar
     * @return void
     */
    public function updateOne($row, $data, $id)
    {
        $sql = "UPDATE users_login SET $row = ? WHERE idLogin = ?";
        $this->query($sql, [$data, $id]);
    }

    /**
     *  Elimina un usuario
     *
     * @param int $id identificador del usuario
     * @return void
     */
    public function deleteUserLogin($id)
    {
        $sql = "DELETE FROM users_login WHERE idLogin = ?";
        $this->query($sql, [$id]);
    }
}
