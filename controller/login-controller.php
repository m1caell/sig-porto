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
$userId = null;
$userType = null;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $userId = $row["USER_ID"];
        $userType = $row["TYPE"];
    }
}

$row = mysqli_num_rows($result);

if ($row == 1) {
    session_start();
    $_SESSION['user'] = $user;
    $_SESSION['userId'] = $userId;
    $_SESSION['type'] = $userType;
    header('Location: ../view/home-page.php');
    exit();
} else {
    $_SESSION['nao_autenticado'] = true;
    header('Location: ../view/login-page.php?login-error');
    exit();
}
