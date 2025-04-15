<?php
require_once 'BaseModel.php';

/**
 * Clase para representar el modelo de las noticias.
 *
 * Esta clase realiza operaciones CRUD para las noticias.
 *
 * @package    Modelos
 * @subpackage    Noticias
 * @author     Víctor Pérez
 */

class NoticiasModel extends BaseModel
{
    /**
     *  Obtiene todas las noticias
     *
     * @return array Devuelve todas las noticias
     */
    public function getAllNoticias()
    {
        $sql = "SELECT noticias.*, users_login.usuario 
        FROM noticias
        JOIN users_login ON noticias.idUser = users_login.idUser
        ORDER BY noticias.fecha DESC";

        return $this->fetchAll($sql);
    }

    /**
     *  Obtiene un determinado número de noticias
     *
     * @param int $limit numero de noticias a recoger
     * @return array Devuelve las noticias
     */
    public function getLimitNoticias($limit)
    {
        $sql = "SELECT noticias.*, users_login.usuario 
        FROM noticias
        JOIN users_login ON noticias.idUser = users_login.idUser
        ORDER BY noticias.fecha DESC
        LIMIT ?";

        return $this->fetchAll($sql, [$limit]);
    }

    /**
     *  Obtiene una noticia por su id
     *
     * @param int $id identificador de la noticia
     * @return array Devuelve la noticia correspondiente
     */
    public function getNoticiaById($id)
    {
        $sql = "SELECT * FROM noticias WHERE idNoticia = ?";
        return $this->fetchOne($sql, [$id]);
    }

    /**
     *  Obtiene todas las noticias de un usuario
     *
     * @param int $id identificador del usuario
     * @return array Devuelve las noticias del usuario
     */
    public function getNoticiasByIdUser($id)
    {
        $sql = "SELECT * FROM noticias WHERE idUser = $id";
        return $this->fetchAll($sql);
    }

    /**
     *  Crea una noticia y la introduce en la base de datos
     *
     * @param array $data array asociativo con los valores de cada campo
     * @return void
     */
    public function createNoticia($data)
    {
        $sql = "INSERT INTO noticias (titulo, imagen, texto, fecha, idUser) VALUES (?, ?, ?, ?, ?)";
        $this->query($sql, array_values($data));
    }

    /**
     *  Actualiza una noticia
     *
     * @param int $id identificador de la noticia
     * @param array $data array asociativo con los valores de cada campo a actualizar
     * @return void
     */
    public function updateNoticia($id, $data)
    {
        $fields = array_keys($data);
        $sql = "UPDATE noticias SET " . implode(' = ?, ', $fields) . " = ? WHERE idNoticia = $id";

        $values = array_values($data);

        $this->query($sql, $values);
    }

    /**
     *  Eliminar una noticia
     *
     * @param int $id identificador de la noticia
     * @return void
     */
    public function deleteNoticia($id)
    {
        $sql = "DELETE FROM noticias WHERE idNoticia = ?";
        $this->query($sql, [$id]);
    }
}
