<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Home</title>
</head>

<body>
    <?php
    include_once('../services/check-login.php');
    include_once('../services/connection.php');

    $currentUser = $_SESSION['userId'];
    $userType = $_SESSION['type'];
    ?>

    <h2>Olá, <?php echo $userType," ", $_SESSION['user']; ?></h2>
    <h2><a href="../controller/logout-controller.php">Sair</a></h2>

    <hr>
    <a href="./register-ship.php">Cadastro de navios</a>
    <a href="./register-truck.php">Cadastro de caminhões</a>
    <hr>

    <h3>Fila de espera</h3>
    <h4>Selecione o navio</h4>

    <form action="../controller/expedition-controller.php" method="post">
        <label for="">Adicionar Navio</label>
        <select name="idItem">
            <?php
            $sql = "select * from SHIP where ISEXPEDITION = false";
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
        <select name="idItem">
            <?php
            $sql = "select * from TRUCK where ISEXPEDITION = false";
            $result = $conexao->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value={$row["ID_TRUCK"]}>{$row["NAME"]}</option>";
                }
            } else {
                echo "0 results";
            }
            ?>
        </select>
        <input type="hidden" name="parameter" value="add-truck">
        <button type="submit">Adicionar</button>
    </form>

    <h4>Fila de Navios</h4>
    <ol>
        <?php
        $queryRow = "SELECT nav.REGISTRATION, nav.NAME, nav.ID_PERSON, nav.ID_SHIP, exp.ID_EXPEDITION FROM EXPEDITION_SHIP exp INNER JOIN SHIP nav on nav.ID_SHIP = exp.ID_SHIP ORDER BY EXPEDIRION_DATE DESC";
        $result = $conexao->query($queryRow);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<li>";
                echo "<div>{$row["REGISTRATION"]}</div>";
                echo "<div>{$row["NAME"]}</div>";
                echo "<div>";
                if ($row["ID_PERSON"] === $currentUser) {
                    echo "<button onclick='removeFromRowShip({$row['ID_EXPEDITION']}, {$row['ID_SHIP']})'>Remove</button>";
                }
                echo "</div>";
                echo "</li>";
            }
        } else {
            echo "Não há fila";
        }

        ?>
    </ol>

    <script>
        function removeFromRowShip(id, idVehicle) {
            window.location.href = `/sig-porto/controller/remove.php?id=${id}&type=ship&vehicle=${idVehicle}`
            return false;
        }
    </script>

    <?php $conexao->close(); ?>
</body>

</html>