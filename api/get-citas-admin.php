<?php

include '../models/CitacionesModel.php';

// Obtener todas las citas de un usuario por su id
if (isset($_GET['idUser'])) {
    $idUser = intval($_GET['idUser']);

    $citasModel = new CitacionesModel();

    $citas = $citasModel->getCitasByIdUser($idUser);

    header('Content-Type: application/json');

    echo json_encode($citas);
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'El parámetro idUser es requerido']);
}
