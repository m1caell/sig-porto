<?php
include("../services/connection.php");
date_default_timezone_set('America/Sao_Paulo');

$parameter = $_POST['parameter'];
$id = mysqli_real_escape_string($conexao, $_POST['idItem']);
$today = date("Y-m-d H:i:s");

if (empty($_POST['parameter']) || empty($_POST['idItem'])) {
    header('Location: ../view/home-page.php?missing-data');
    exit();
}

if ($parameter == "add-truck") {
    $queryInsert = "insert into EXPEDITION_TRUCK(ID_TRUCK, EXPEDIRION_DATE) values ('{$id}', '{$today}');";
    $queryUpdate = "update TRUCK set ISEXPEDITION = true WHERE ID_TRUCK = '{$id}';";

    $resultInsert = mysqli_query($conexao, $queryInsert);
    $resultUpdate = mysqli_query($conexao, $queryUpdate);

    $row = mysqli_affected_rows($conexao);

    if ($row > 0) {
        header('Location: ../view/home-page.php?add-success');
        exit();
    } else {
        header('Location: ../view/home-page.php?add-error');
    }
} elseif ($parameter == "add-ship") {
    $queryInsert = "insert into EXPEDITION_SHIP(ID_SHIP, EXPEDIRION_DATE) values ('{$id}', '{$today}');";
    $queryUpdate = "update SHIP set ISEXPEDITION = true WHERE ID_SHIP = '{$id}';";

    $resultInsert = mysqli_query($conexao, $queryInsert);
    $resultUpdate = mysqli_query($conexao, $queryUpdate);

    $row = mysqli_affected_rows($conexao);

    if ($row > 0) {
        header('Location: ../view/home-page.php?add-success');
        exit();
    } else {
        header('Location: ../view/home-page.php?add-error');
    }
}
