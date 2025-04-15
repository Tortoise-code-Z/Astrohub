<?php

include '../models/NoticiasModel.php';

// Obtener todas las noticias de un usuario por su id
if (isset($_GET['idUser'])) {
    $idUser = intval($_GET['idUser']);

    $newsModel = new NoticiasModel();

    $news = $newsModel->getNoticiasByIdUser($idUser);

    header('Content-Type: application/json');

    echo json_encode($news);
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'El parámetro idUser es requerido']);
}
