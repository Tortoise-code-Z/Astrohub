<?php
require_once './controllers/BaseController.php';
require_once './models/NoticiasModel.php';
/**
 * Clase para representar el controlador de la página de inicio.
 *
 * Esta clase realiza funciones de renderizado del inicio.
 *
 * @package    Controladores
 * @subpackage    Inicio
 * @author     Víctor Pérez
 */
class HomeController extends BaseController
{
    /**
     *  Renderizar la vista del inicio
     *
     * @return void
     */
    public function home()
    {
        $newsModel = new NoticiasModel;
        $news = $newsModel->getLimitNoticias(6);
        $this->render('home', ['news' => $news], false);
    }
}
