<?php

/**
 * Clase para representar funciones generales.
 *
 * Esta clase realiza funciones generales, funciones que se puedan repetir
 * en varios archivos, etc.
 *
 * @package    Utils
 * @subpackage    Utils
 * @author     Víctor Pérez
 */

class Utils
{
    /**
     * Obtiene un error específico de la sesión
     *
     * @return string
     */
    public static function getError($value)
    {
        return isset($_SESSION['errors'][$value]) ? $_SESSION['errors'][$value] : '';
    }

    /**
     * Obtiene un valor específico de la sesión
     *
     * @return string
     */
    public static function getErrorValues($value)
    {
        return isset($_SESSION['old_values'][$value]) ? $_SESSION['old_values'][$value] : '';
    }

    public static function getErrClass($err)
    {
        return empty($err) ? '' : 'err-inp';
    }

    /**
     * Revisa si todos los campos recibidos cumplen una condición
     *
     * @return boolean
     */
    public static function array_every($array, $callback)
    {
        foreach ($array as $element) {
            if (!$callback($element)) {
                return false;
            }
        }
        return true;
    }
}
