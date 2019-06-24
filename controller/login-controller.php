<?php
include("../services/connection.php");

if (empty($_POST['user']) || empty($_POST['password'])) {
    exit();
}

$user = mysqli_real_escape_string($conexao, $_POST['user']);
$password = mysqli_real_escape_string($conexao, $_POST['password']);

$password = md5($password);
$query = "select * from PERSON where PASSWORD = '{$password}' and USERNAME = '{$user}';";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if ($row == 1) {
    session_start();
    $_SESSION['user'] = $user;
    header('Location: ../view/home-page.php');
    exit();
} else {
    $_SESSION['nao_autenticado'] = true;
    header('Location: ../view/login-page.php?login-error');
    exit();
}
