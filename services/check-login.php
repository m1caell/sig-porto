<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: ../index.php');
    exit();
}
