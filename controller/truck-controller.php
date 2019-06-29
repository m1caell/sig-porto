<?php
include("../services/connection.php");

session_start();

$parameter = $_POST['parameter'];
$name = mysqli_real_escape_string($conexao, $_POST['name']);
$board = mysqli_real_escape_string($conexao, $_POST['board']);

if (empty($_POST['parameter']) || empty($_POST['name']) || empty($_POST['board'])) {
    header('Location: ../view/register-truck.php?missing-data');
    exit();
}

if ($parameter == "create") {
    $password = md5($password);

    $query = "insert into TRUCK(NAME, BOARD, ID_PERSON) values ('{$name}', '{$board}', '{$_SESSION['userId']}');";

    $result = mysqli_query($conexao, $query);

    $row = mysqli_affected_rows($conexao);


    if ($row > 0) {
        header('Location: ../view/register-truck.php?register-success');
        exit();
    } else {
        header('Location: ../view/register-truck.php?register-error');
    }
}
