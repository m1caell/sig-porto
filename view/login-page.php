<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>

<body>
    <form action="../controller/login-controller.php" method="POST">
        <label for="">Usuário</label>
        <input type="text" name="user">
        <label for="">Senha</label>
        <input type="password" name="password">
        <button type="submit" name="entrar">Entrar</button>
    </form>

    <script>
        if(window.location.search === "?login-error") {
            console.log("Falha ao logar")
        }
    </script>
</body>

</html>