<?php

require_once('../conexao/conecta.php');

if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LojaCosméticos</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="admin.php">Livraria da Vila</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="cargos.php">Cargos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="funcionario.php">Funcionários</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categorias.php">Categorias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="editora.php">Editora</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="produtos.php">Produtos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="autor.php">Autor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase ml-4" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Olá, <?php echo $_SESSION['USER']; ?></a>
                </li>
                <form action="logoff.php" method="post">
                    <button type="submit" class="btn btn-danger">Desconectar</button>
                </form>
            </ul>


        </div>
    </nav>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha384-t4fB6FbAPTxqcfI4SuLq9OHw0lPI5f6ArXjw9YxFPz8Y4mP3kc7VXr2KVR6ElI4G"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaWqEaQga24GIgaTh+0bBo4b5PHWLkTsiKvA"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>

</html>