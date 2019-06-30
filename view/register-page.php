<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <title>Cadastro</title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="../index.php">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./login-page.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./register-page.php">Cadastro</a>
                    </li>
            </div>
        </nav>
        <br><br>

        <main class="my-main">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="https://c8.alamy.com/compde/dhgg55/containerhafen-straddle-carrier-hebe-kran-neue-gross-dhgg55.jpg" class="card-img" alt="container">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Cadastro</h5>
                            <form action="../controller/register-controller.php" method="POST">
                                <div class="form-group">
                                    <label for="exampleInputUser">Usuário</label>
                                    <input name="user" type="text" class="form-control" id="exampleInputUser" aria-describedby="emailHelp" placeholder="Digite seu usuário">
                                    <small id="emailHelp" class="form-text text-muted">Nome do usuário para acesso.</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail">Email</label>
                                    <input name="email" type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Digite seu email">
                                    <small id="emailHelp" class="form-text text-muted">Email do usuário.</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Senha</label>
                                    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Didite sua senha">
                                </div>
                                <div id="my-alert-error" class="alert alert-danger" role="alert">
                                    Falha ao cadastrar.
                                </div>
                                <button name="entrar" type="submit" class="btn btn-primary">Criar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <script>
        if (window.location.search === "?register-error") {
            $('#my-alert-error').alert('dispose')
        } else {
            $('#my-alert-error').alert('close')
        }
    </script>
</body>

</html>