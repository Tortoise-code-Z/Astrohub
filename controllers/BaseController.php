<?php

/**
 * Clase para representar el controlador base.
 *
 * Esta clase realiza funciones genéricas para renderizar, redirigir y funciones de
 * control de usuario y administrador.
 *
 * @package    Controladores
 * @subpackage    Base
 * @author     Víctor Pérez
 */

class BaseController
{
    /**
     *  Renderiza una vista
     *
     * @param string $view nombre de la vista a renderizar
     * @param array $data variables con datos para utilizar en la vista
     * @param boolean $admin saber si estamos en la carpeta de administradores
     * @return void
     */
    protected function render($view, $data = [], $admin)
    {
        extract($data);
        if ($admin) {
            include "./views/templates/admin/$view.php";
            return;
        }
        include "./views/templates/$view.php";
    }

    /**
     *  Redirecciona una vista
     *
     * @param string $url valor de la url a redirigir
     * @return void
     */
    protected function redirect($url)
    {
        header("Location: $url");
        exit();
    }

    /**
     *  Revisa si hay un usuario con la sesión iniciada
     *
     * @return void
     */
    protected function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }

    /**
     *  Revisa si hay un administrador con la sesión iniciada
     *
     * @return void
     */
    protected function isAdmin()
    {
        return isset($_SESSION['user']) && $_SESSION['user']['rol'] == 'admin';
    }

    /**
     *  Requiere que estes con la sesión iniciada
     *
     * @return void
     */
    protected function requireLogin()
    {
        if (!$this->isLoggedIn()) {
            $this->redirect('./index.php?controller=renderLogin');
        }
    }

    /**
     *  Requiere que seas administrador para acceder
     *
     * @return void
     */
    protected function requireAdmin()
    {
        if (!$this->isAdmin()) {
            if ($this->isLoggedIn()) {
                $this->redirect('./index.php?controller=home');
                return;
            }
            $this->redirect('./index.php?controller=renderLogin');
        }
    }
}
