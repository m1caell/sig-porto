<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <title>Home</title>
</head>

<body>
    <div class="container">
        <?php
        include_once('../services/check-login.php');
        include_once('../services/connection.php');

        $currentUser = $_SESSION['userId'];
        $userType = $_SESSION['type'];
        ?>

        <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="./home-page.php">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./register-ship.php">Cadastro de navios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./register-truck.php">Cadastro de caminhões</a>
                    </li>
                </ul>
                <div class="nav-item">
                    <a class="nav-link" href="../controller/logout-controller.php">Logout</a>
                </div>
            </div>
        </nav>

        <div id="my-alert-ship" class="alert alert-danger" role="alert">
            Há navio em processo ainda.
        </div>
        <div id="my-alert-fail-to-insert" class="alert alert-danger" role="alert">
            Falha ao colocar no processo.
        </div>
        <div id="my-alert-error-port-empty" class="alert alert-danger" role="alert">
            Processo está vazio.
        </div>
        <div id="my-alert-error-fail-to-remove-history" class="alert alert-danger" role="alert">
            Falha ao encerrar processo do caminhão do navio.
        </div>
        <div id="my-alert-error-without-ship" class="alert alert-danger" role="alert">
            Não há navio em processo
        </div>
        <div id="my-alert-fail-to-insert-truck" class="alert alert-danger" role="alert">
            Falha ao inserir caminhão no processo.
        </div>
        <div id="my-alert-error-fail-to-remove-truck" class="alert alert-danger" role="alert">
            Não há caminhão em processo.
        </div>

        <br>
        <br>
        <h2>Olá, <?php echo $userType, " ", $_SESSION['user']; ?></h2>
        <br>
        <br>

        <h3>Fila de espera</h3>
        <br>
        <main class="my-sections" style="display:flex">
            <section class="section">
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
                <br>
                <h4>Fila de Navios</h4>
                <ol class="ordenad-list">
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
                            } else {
                                echo "<div />";
                            }
                            echo "</div>";
                            echo "</li>";
                        }
                    } else {
                        echo "Não há fila";
                    }

                    ?>
                </ol>
            </section>
            <section class="section">
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
                <br>
                <h4>Fila de Caminhões</h4>
                <ol class="ordenad-list">
                    <?php
                    $queryRowTruck = "SELECT nav.BOARD, nav.NAME, nav.ID_PERSON, nav.ID_TRUCK, exp.ID_EXPEDITION FROM EXPEDITION_TRUCK exp INNER JOIN TRUCK nav on nav.ID_TRUCK = exp.ID_TRUCK ORDER BY EXPEDIRION_DATE DESC";
                    $resultTruck = $conexao->query($queryRowTruck);

                    if ($resultTruck->num_rows > 0) {
                        while ($row = $resultTruck->fetch_assoc()) {
                            echo "<li>";
                            echo "<div>{$row["BOARD"]}</div>";
                            echo "<div>{$row["NAME"]}</div>";
                            echo "<div>";
                            if ($row["ID_PERSON"] === $currentUser) {
                                echo "<button onclick='removeFromRowTruck({$row['ID_EXPEDITION']}, {$row['ID_TRUCK']})'>Remove</button>";
                            } else {
                                echo "<div />";
                            }
                            echo "</div>";
                            echo "</li>";
                        }
                    } else {
                        echo "Não há fila";
                    }

                    ?>
                </ol>
            </section>
        </main>
        <br>
        <div class="emabarcation">
            <h3>Navio em processo</h3>
            <ul class="list-group">
                <?php
                $queryRow = "select s.REGISTRATION, s.NAME from HISTORY h INNER JOIN SHIP s on h.ID_SHIP = s.ID_SHIP WHERE h.ISONTHECOAST = true;";
                $result = $conexao->query($queryRow);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<li class='list-group-item disabled' aria-disabled='true'>";
                        echo "<div>{$row["REGISTRATION"]}</div>";
                        echo "<div>{$row["NAME"]}</div>";
                        echo "<div>";
                        echo "</li>";
                    }
                } else {
                    echo "<li class='list-group-item disabled' aria-disabled='true'>Não há navio em processo</li>";
                }
                ?>
            </ul>
        </div>
        <br><br>
        <div class="truck-progress">
            <h3>Caminhão em processo</h3>
            <ul class="list-group">
                <?php
                $queryRow = "SELECT t.BOARD, t.NAME FROM HISTORY h INNER JOIN TRUCK t on t.ID_TRUCK = CAST(h.IDS_TRUCKS as INT) WHERE h.ISONTHECOAST = true;";
                $result = $conexao->query($queryRow);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<li class='list-group-item disabled' aria-disabled='true'>";
                        echo "<div>{$row["BOARD"]}</div>";
                        echo "<div>{$row["NAME"]}</div>";
                        echo "<div>";
                        echo "</li>";
                    }
                } else {
                    echo "<li class='list-group-item disabled' aria-disabled='true'>Não há caminhão em processo</li>";
                }
                ?>
            </ul>
        </div>
        <br><br>
        <?php if ($userType === 'operador') { ?>
            <footer class="footer">
                <div class="port-controls">
                    <div class="controls">
                        <button type="button" onclick="addShipToCoast()" class="btn btn-primary btn-lg btn-block">Carregar embarcação</button>
                        <button type="button" onclick="removeShipToCoast()" class="btn btn-secondary btn-lg btn-block">Descarregar embarcação</button>
                    </div>
                    <br>
                    <div class="controls">
                        <button type="button" onclick="addTruckToShip()" class="btn btn-primary btn-lg btn-block">Carregar caminhão</button>
                        <button type="button" onclick="removeTruckToShip()" class="btn btn-secondary btn-lg btn-block">Descarregar caminhão</button>
                    </div>
                </div>
                <br>
            </footer>
        <?php } ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <script>
        function removeFromRowShip(id, idVehicle) {
            window.location.href = `/sig-porto/controller/remove.php?id=${id}&type=ship&vehicle=${idVehicle}`
        }

        function removeFromRowTruck(id, idVehicle) {
            window.location.href = `/sig-porto/controller/remove.php?id=${id}&type=truck&vehicle=${idVehicle}`
        }

        function addShipToCoast() {
            window.location.href = `/sig-porto/controller/main-thread.php?type=addShip`
        }

        function removeShipToCoast() {
            window.location.href = `/sig-porto/controller/main-thread.php?type=removeShip`
        }

        function addTruckToShip() {
            window.location.href = `/sig-porto/controller/main-thread.php?type=addTruck`
        }

        function removeTruckToShip() {
            window.location.href = `/sig-porto/controller/main-thread.php?type=removeTruck`
        }

        if (window.location.search === "?error-has-ship-yet") {
            $('#my-alert-ship').alert('dispose')
        } else {
            $('#my-alert-ship').alert('close')
        }

        if (window.location.search === "?error-fail-to_insert-history") {
            $('#my-alert-fail-to-insert').alert('dispose')
        } else {
            $('#my-alert-fail-to-insert').alert('close')
        }

        if (window.location.search === "?error-port-empty") {
            $('#my-alert-error-port-empty').alert('dispose')
        } else {
            $('#my-alert-error-port-empty').alert('close')
        }

        if (window.location.search === "?error-fail-to-remove-history") {
            $('#my-alert-error-fail-to-remove-history').alert('dispose')
        } else {
            $('#my-alert-error-fail-to-remove-history').alert('close')
        }

        if (window.location.search === "?error-without-ship") {
            $('#my-alert-error-without-ship').alert('dispose')
        } else {
            $('#my-alert-error-without-ship').alert('close')
        }

        if (window.location.search === "?fail-to-insert-truck") {
            $('#my-alert-fail-to-insert-truck').alert('dispose')
        } else {
            $('#my-alert-fail-to-insert-truck').alert('close')
        }

        if (window.location.search === "?error-fail-to-remove-truck") {
            $('#my-alert-error-fail-to-remove-truck').alert('dispose')
        } else {
            $('#my-alert-error-fail-to-remove-truck').alert('close')
        }
    </script>

    <?php $conexao->close(); ?>
</body>

</html>