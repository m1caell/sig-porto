<?php
include("../services/connection.php");

$parameter = $_POST['parameter'];
$name = mysqli_real_escape_string($conexao, $_POST['name']);
$registration = mysqli_real_escape_string($conexao, $_POST['registration']);

if (empty($_POST['parameter']) || empty($_POST['name']) || empty($_POST['registration'])) {
    header('Location: ../view/register-ship.php?missing-data');
    exit();
}

if ($parameter == "create") {
    $password = md5($password);

    $query = "insert into SHIP(NAME, REGISTRATION) values ('{$name}', '{$registration}');";

    $result = mysqli_query($conexao, $query);

    $row = mysqli_affected_rows($conexao);


    if ($row > 0) {
        header('Location: ../view/register-ship.php?register-success');
        exit();
    } else {
        header('Location: ../view/register-ship.php?register-error');
    }
}
