<?php
include("../services/connection.php");

$id_url = $_GET['id'];
$type_url = $_GET['type'];
$id_vehicle = $_GET['vehicle'];

if (empty($_GET['id']) || empty($type_url = $_GET['type']) || empty($_GET['vehicle'])) {
    header('Location: ../view/home-page.php');
}

if ($type_url === 'ship') {
    $queryShip = "DELETE FROM EXPEDITION_SHIP WHERE ID_EXPEDITION = {$id_url};";
    $queryUpdate = "UPDATE SHIP set ISEXPEDITION = false WHERE ID_SHIP = {$id_vehicle};";

    $result = mysqli_query($conexao, $queryShip);
    $resultUpdate = mysqli_query($conexao, $queryUpdate);

    $row = mysqli_affected_rows($conexao);
} elseif ($type_url === 'truck') {
    $queryTruck = "DELETE FROM EXPEDITION_TRUCK WHERE ID_EXPEDITION = {$id_url};";
    $queryUpdate = "UPDATE TRUCK set ISEXPEDITION = false WHERE ID_TRUCK = {$id_vehicle};";

    $result = mysqli_query($conexao, $queryTruck);
    $resultUpdate = mysqli_query($conexao, $queryUpdate);

    $row = mysqli_affected_rows($conexao);
}

header('Location: ../view/home-page.php');
