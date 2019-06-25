<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de Navio</title>
</head>

<body>
    <h1>Cadastro de Navio</h1>

    <form action="../controller/ship-controller.php" method="POST">
        <label for="">Nome</label>
        <input type="text" name="name">
        <label for="">Matricula</label>
        <input type="text" name="registration">
        <input type="hidden" name="parameter" value="create">
        <button type="submit" name="entrar">Confirmar</button>
    </form>

    <script>
        if (window.location.search === "?create-error") {
            console.log("Falha ao cadastrar")
        }
    </script>
</body>

</html>