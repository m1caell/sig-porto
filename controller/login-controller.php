<?php
session_start();
include("../services/connection.php");

if (empty($_POST['user']) || empty($_POST['password'])) {
    header('Location: login-page.php');
    exit();
}

$user = mysqli_real_escape_string($conexao, $_POST['user']);
$password = mysqli_real_escape_string($conexao, $_POST['password']);

$query = "select usuario from person where username = '{$user}' and password = md5('{$password}')";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if ($row == 1) {
    $_SESSION['user'] = $user;
    header('Location: ../view/home-page.php');
    exit();
} else {
    $_SESSION['nao_autenticado'] = true;
    header('Location: ../view/login-page.php?login-error');
    exit();
}
