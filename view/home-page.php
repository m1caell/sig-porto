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
    include_once('../services/check-login.php');
    include_once('../services/connection.php')
    ?>

    <h2>Olá, <?php echo $_SESSION['user']; ?></h2>
    <h2><a href="../controller/logout-controller.php">Sair</a></h2>

    <hr>
    <a href="./register-ship.php">Cadastro de navios</a>
    <a href="./register-truck.php">Cadastro de caminhões</a>
    <hr>

    <h3>Fila de espera</h3>
    <h4>Selecione o navio</h4>

    <form action="../controller/expedition-controller.php" method="post">
        <label for="">Adicionar Navio</label>
        <select>
            <?php
            $sql = "select * from SHIP";
            $result = $conexao->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value={$row["ID_SHIP"]}>{$row["NAME"]}</option>";
                }
            } else {
                echo "0 results";
            }
            ?>
        </select>
        <input type="hidden" name="parameter" value="add-ship">
        <button type="submit">Adicionar</button>
    </form>

    <h4>Selecione o caminhão</h4>

    <form action="../controller/expedition-controller.php" method="post">
        <label for="">Adicionar Caminhão</label>
        <select>
            <?php
            $sql = "select * from TRUCK";
            $result = $conexao->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value={$row["ID_TRUCK"]}>{$row["NAME"]}</option>";
                }
            } else {
                echo "0 results";
            }
            $conexao->close();
            ?>
        </select>
        <input type="hidden" name="parameter" value="add-truck">
        <button type="submit">Adicionar</button>
    </form>
</body>

</html>