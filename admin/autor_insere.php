<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once('../conexao/conecta.php');

if (isset($_POST['inserir']) && $_POST['inserir'] == 'insere_autor') {
    $nome = $_POST['nome'];
    $status = $_POST['status'];
    $nacionalidade = $_POST['nacionalidade'];

    $sql = "INSERT INTO autor (data_cadastro, status, nome, nacionalidade) VALUES (NOW(), $status, '$nome', '$nacionalidade')";

    if (mysqli_query($conexao, $sql)) {
        header('Location: autor.php');
    } else {
        die("Erro: " . $sql . "<br>" . mysqli_error($conexao));
    }
}

?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Novo Autor</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">

</head>

<body>

    <?php include('topo.php') ?>

    <div class="container-fluid">
        <div class="row">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Painel Administrativo</h1>
                </div>
                <h4>Novo Autor</h4>
                <div class="col-md-8">
                    <form action="" method="post">
                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" maxlength="40" required class="form-control">
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="1">Ativo</option>
                                    <option value="0">Inativo</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="nacionalidade">Nacionalidade</label>
                                <input type="text" name="nacionalidade" maxlength="40" required class="form-control">
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <input type="hidden" name="inserir" value="insere_autor">
                                <input type="submit" class="btn btn-primary btn-lg w-100" value="Cadastrar">
                            </div>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

</body>

</html>