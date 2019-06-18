<?php
define('HOST', '192.168.64.2');
define('USER', 'system');
define('PASSWORD', 'root');
define('DB', 'PORTODB');

$conexao = mysqli_connect(HOST, USER, PASSWORD, DB) or die ('Não foi possível conectar');