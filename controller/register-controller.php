<?php
include("../services/connection.php");

$user = mysqli_real_escape_string($conexao, $_POST['user']);
$email = mysqli_real_escape_string($conexao, $_POST['email']);
$password = mysqli_real_escape_string($conexao, $_POST['password']);

if (empty($_POST['user']) || empty($_POST['password']) || empty($_POST['email'])) {
    header('Location: ../view/register-page.php?register-error');
    exit();
}

$password = md5($password);

$query = "insert into PERSON(USERNAME, EMAIL, PASSWORD) values ('{$user}', '{$email}', '{$password}');";

$result = mysqli_query($conexao, $query);

$row = mysqli_affected_rows($conexao);


if ($row > 0) {
    header('Location: ../view/login-page.php?register-success');
    exit();
} else {
    header('Location: ../view/login-page.php?register-error');
}
