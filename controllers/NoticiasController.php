<?php
require_once './controllers/BaseController.php';
require_once './models/NoticiasModel.php';
require_once './models/UserLoginModel.php';

/**
 * Clase para representar el controlador de las noticias.
 *
 * Esta clase realiza funciones para renderizar, crear, borrar y editar noticias.
 *
 * @package    Controladores
 * @subpackage    Noticias
 * @author     Víctor Pérez
 */

class NoticiasController extends BaseController
{

    /**
     *  Renderizar la vista de las noticias
     *
     * @return void
     */
    public function news()
    {
        $noticiasModel = new NoticiasModel();
        $getNews = $noticiasModel->getAllNoticias();

        $news = $this->orderedNews($getNews);
        $destNews = $this->getDestNews($getNews);

        $this->render('noticias', ['news' => $news, 'destNews' => $destNews], false);
    }

    /**
     *  Ordena las noticias de mayor a menor
     *
     * @param array $news todas las noticias de la web
     * @return array $this->addUsername($orderedNews) todas las noticias ordenadas
     */
    public function orderedNews($news)
    {
        $orderedNews = $news;

        usort($orderedNews, function ($a, $b) {
            $fechaA = strtotime($a['fecha']);
            $fechaB = strtotime($b['fecha']);
            return $fechaB - $fechaA;
        });

        return $this->addUsername($orderedNews);
    }

    /**
     *  Obtiene tres noticias (seccion de destacadas)
     *
     * @param array $news todas las noticias de la web
     * @return array $this->addUsername($destNews) las noticias destacadas
     */
    public function getDestNews($news)
    {
        $newsCopy = $news;

        if (count($newsCopy) <= 3) {
            return $this->addUsername($newsCopy);
        }

        shuffle($newsCopy);

        $destNews = array_slice($newsCopy, 0, 3);

        return $this->addUsername($destNews);
    }

    /**
     *  Añade el nombre del usuario creador de cada noticia
     *
     * @param array $news todas las noticias de la web
     * @return array $news todas las noticias con los nombres de usuario que la crearon
     */
    private function addUsername($news)
    {
        $userLoginModel = new UserLoginModel();

        foreach ($news as &$new) {
            $usuario = $userLoginModel->getUserLoginByUserId($new['idUser']);
            $new['usuario'] = $usuario['usuario'];
        }

        return $news;
    }
}
