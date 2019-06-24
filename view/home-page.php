<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <?php
    include('../services/check-login.php');
    ?>

    <h2>Olá, <?php echo $_SESSION['user']; ?></h2>
    <h2><a href="../controller/logout-controller.php">Sair</a></h2>
    <hr>
    <button>Cadastro de navios</button>
    <button>Descarregar navio</button>
    <button>Cadastro de caminhões</button>
    <button>Descarregar caminhão</button>
</body>

</html>