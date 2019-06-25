<?php
    include_once('../services/check-login.php');
    header('Location: ../index.php');
    session_destroy();
?>