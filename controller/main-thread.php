<?php

include("../services/connection.php");

$type_url = $_GET['type'];
$today = date("Y-m-d H:i:s");

if (empty($type_url = $_GET['type'])) {
    header('Location: ../view/home-page.php');
}

if ($type_url === "addShip") {
    $shipID = null;
    $isOnTheCoast = null;
    $idExpedition = null;

    $checkIfHasShip = "SELECT * FROM HISTORY ORDER BY CREATED_DATE DESC LIMIT 1;";
    $result = mysqli_query($conexao, $checkIfHasShip);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $isOnTheCoast = $row["ISONTHECOAST"];
        }
    }

    if ($isOnTheCoast == true) {
        header('Location: ../view/home-page.php?error-has-ship-yet');
        exit();
    }

    mysqli_query($conexao, "begin;");

    $getFirstOfRow = "SELECT nav.REGISTRATION, nav.NAME, nav.ID_PERSON, nav.ID_SHIP, exp.ID_EXPEDITION FROM EXPEDITION_SHIP exp INNER JOIN SHIP nav on nav.ID_SHIP = exp.ID_SHIP ORDER BY EXPEDIRION_DATE DESC LIMIT 1;";
    $result = mysqli_query($conexao, $getFirstOfRow);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $shipID = $row["ID_SHIP"];
            $idExpedition = $row["ID_EXPEDITION"];
        }
    }

    if ($shipID != null && $idExpedition != null) {
        $insertShipToHistory = "INSERT INTO HISTORY (ID_SHIP, IDS_TRUCKS, CREATED_DATE, ISONTHECOAST) VALUES ('{$shipID}', '', '{$today}', true)";
        $result = mysqli_query($conexao, $insertShipToHistory);
        $result = mysqli_query($conexao, "DELETE FROM EXPEDITION_SHIP WHERE ID_EXPEDITION = {$idExpedition}");
    } else {
        header('Location: ../view/home-page.php?error-fail-to_insert-history');
        exit();
    }


    $row = mysqli_affected_rows($conexao);
    if ($row > 0) {
        mysqli_query($conexao, "commit;");
        header('Location: ../view/home-page.php');
    } else {
        mysqli_query($conexao, "rollback;");
        header('Location: ../view/home-page.php?error-fail-to_insert-history');
    }
}

if ($type_url === "removeShip") {
    $historyID = null;
    $getFirstOfRow = "SELECT * FROM `HISTORY` ORDER BY CREATED_DATE DESC LIMIT 1";
    $result = mysqli_query($conexao, $getFirstOfRow);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $historyID = $row["ID_HISTORY"];
        }
    } else {
        header('Location: ../view/home-page.php?error-port-empty');
        exit();
    }

    if ($historyID != null) {
        mysqli_query($conexao, "UPDATE HISTORY SET ISONTHECOAST = false WHERE ID_HISTORY = {$historyID}");
    }

    $row = mysqli_affected_rows($conexao);
    if ($row > 0) {
        mysqli_query($conexao, "commit;");
        header('Location: ../view/home-page.php');
    } else {
        mysqli_query($conexao, "rollback;");
        header('Location: ../view/home-page.php?error-fail-to-remove-history');
    }
}


if ($type_url === "addTruck") {
    $shipOnTheCoast = null;
    $idHistory = null;
    $truckID = null;
    $idExpedition = null;

    $checkIfHasShip = "SELECT * FROM HISTORY ORDER BY CREATED_DATE DESC LIMIT 1;";
    $result = mysqli_query($conexao, $checkIfHasShip);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $shipOnTheCoast = $row["ID_SHIP"];
            $idHistory = $row["ID_HISTORY"];
        }
    }

    if ($shipOnTheCoast == null) {
        header('Location: ../view/home-page.php?error-without-ship');
        exit();
    }

    $getFirstOfRow = "SELECT nav.BOARD, nav.NAME, nav.ID_PERSON, nav.ID_TRUCK, exp.ID_EXPEDITION FROM EXPEDITION_TRUCK exp INNER JOIN TRUCK nav on nav.ID_TRUCK = exp.ID_TRUCK ORDER BY EXPEDIRION_DATE DESC LIMIT 1;";
    $result = mysqli_query($conexao, $getFirstOfRow);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $truckID = $row["ID_TRUCK"];
            $idExpedition = $row["ID_EXPEDITION"];
        }
    }

    if ($truckID != null && $idExpedition != null) {
        $insertTruckToHistory = "UPDATE HISTORY SET IDS_TRUCKS = {$truckID} WHERE {$idHistory} = ID_HISTORY";
        $result = mysqli_query($conexao, $insertTruckToHistory);
        $result = mysqli_query($conexao, "DELETE FROM EXPEDITION_TRUCK WHERE ID_EXPEDITION = {$idExpedition}");
    } else {
        header('Location: ../view/home-page.php?error-fail-to_insert-history');
        exit();
    }


    $row = mysqli_affected_rows($conexao);
    if ($row > 0) {
        mysqli_query($conexao, "commit;");
        header('Location: ../view/home-page.php');
    } else {
        mysqli_query($conexao, "rollback;");
        header('Location: ../view/home-page.php?fail-to-insert-truck');
    }
}

if ($type_url === "removeTruck") {
    $historyID = null;
    $getFirstOfRow = "SELECT * FROM `HISTORY` ORDER BY CREATED_DATE DESC LIMIT 1";
    $result = mysqli_query($conexao, $getFirstOfRow);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $historyID = $row["ID_HISTORY"];
        }
    } else {
        header('Location: ../view/home-page.php?error-port-empty');
        exit();
    }

    if ($historyID != null) {
        mysqli_query($conexao, "UPDATE HISTORY SET IDS_TRUCKS = null WHERE ID_HISTORY = {$historyID}");
    }

    $row = mysqli_affected_rows($conexao);
    if ($row > 0) {
        mysqli_query($conexao, "commit;");
        header('Location: ../view/home-page.php');
    } else {
        mysqli_query($conexao, "rollback;");
        header('Location: ../view/home-page.php?error-fail-to-remove-truck');
    }
}
