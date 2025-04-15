<?php
require_once(__DIR__ . '/../config/conf.php');

/**
 * Clase para representar el modelo base.
 *
 * Esta clase realiza la conexión con la base de datos, asi como funciones
 * para ejecutar querys.
 *
 * @package    Modelos
 * @subpackage    Base
 * @author     Víctor Pérez
 */

class BaseModel
{
    /**
     * Recurso de la conexión a la base de datos.
     *
     * @var object
     */

    protected $db;

    /**
     * Constructor de la clase BaseModel.
     *
     * Establece una conexión con la base de datos.
     *
     */
    public function __construct()
    {
        $this->db = $this->connect();
    }

    /**
     * Destructor de la clase BaseModel.
     *
     * Cierra la conexión con la base de datos.
     *
     * @return void
     */
    public function __destruct()
    {
        if ($this->db) {
            $this->db->close();
        }
    }

    /**
     * Establece la conexión a la base de datos
     *
     * @return resource
     */
    private function connect()
    {
        $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($connection->connect_error) {
            die('Error de conexión (' . $connection->connect_errno . ') '
                . $connection->connect_error);
        }

        return $connection;
    }

    /**
     * Prepara una query y ejecuta una consulta
     *
     * @param string $sql consulta sql a ejecutar
     * @param array $params parámetros a asociar a la consulta
     * @return mysqli_stmt devuelve un objeto mysqli_stmt
     */
    protected function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);

        if ($params) {

            $types = '';
            foreach ($params as $param) {
                if (is_int($param)) {
                    $types .= 'i';
                } elseif (is_float($param)) {
                    $types .= 'd';
                } elseif (is_string($param)) {
                    $types .= 's';
                } else {
                    $types .= 'b';
                }
            }

            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        return $stmt;
    }

    /**
     * Ejecuta una consulta SQL y devuelve todos los resultados en un array asociativo.
     *
     * @param string $sql consulta sql a ejecutar
     * @param array $params parámetros a asociar a la consulta
     * @return array Devuelve un array asociativo que contiene todas las filas del resultado de la consulta.
     */
    protected function fetchAll($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     *  Ejecuta una consulta SQL y devuelve la primera fila del resultado como un array asociativo.
     *
     * @param string $sql consulta sql a ejecutar
     * @param array $params parámetros a asociar a la consulta
     * @return array Devuelve un array asociativo que representa la primera fila del resultado de la consulta
     */
    protected function fetchOne($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
