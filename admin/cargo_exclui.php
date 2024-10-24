<?php


if (!isset($_SESSION)) {
    session_start();

}
require_once('../conexao/conecta.php');

// BUSCANDO NO BANCO AS INFORMAÇÕES DA Cargo SELECIONADA

if (isset($_GET['codigo_cargo']) && $_GET['codigo_cargo'] != '') {

    $codigo = $_GET['codigo_cargo'];

    $sql = "SELECT nome FROM cargo WHERE  codigo_cargo = '$codigo'";
    $resultado = mysqli_query($conexao, $sql);
    $linha = mysqli_fetch_assoc($resultado);

    $sql_excluir = "SELECT funcionario.codigo_cargo, cargo.codigo_cargo FROM cargo JOIN funcionario ON cargo.codigo_cargo WHERE funcionario.codigo_cargo = $codigo ";
    $resultado_excluir = mysqli_query($conexao, $sql_excluir);

    $quantidade = mysqli_num_rows($resultado_excluir);
}

// ROTINA DE EXCLUSÃO

if (isset($_POST['excluir']) && $_POST['excluir'] == 'exclui_cargo') {
    $codigo = $_POST['codigo_cargo'];

    if (isset($_POST['remove']) && $_POST['remove'] == 'Excluir') {


        $sql = "DELETE FROM cargo WHERE codigo_cargo = '$codigo'";

        if (mysqli_query($conexao, $sql)) {
            header('Location: cargos.php');
        } else {
            die("Erro:" . $sql . "<br>" . mysqli_error($conexao));
        }
    } else {
        header('Location: cargos.php');
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
    <title>Cargos</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />

</head>

<body>

    <?php include('topo.php') ?>

    <div class="container-fluid">
        <div class="row">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">
                        Painel Administrativo
                    </h1>
                </div>
                <h4>Excluindo o Cargo:</h4>
                <div class="col-md-8">
                    <form action="" method="post">

                        <?php
                        if ($quantidade > 0) {
                            ?>

                            <h3>Não é possível excluir o Cargo <?php echo $linha['nome'] ?>, pois ele contem
                                <?php echo $quantidade ?> funcionario(as) atrelados a ele
                            </h3>

                            <div class="d-flex justifify-content-center">
                                <a href="cargos.php" class="btn btn-outline-darl w-25">Voltar</a>
                            </div>
                            <?php

                        } else {
                            ?>

                            <h2 class="text-center">
                                Tem certeza que quer excluir o Cargo <?php echo $linha['nome'] ?>
                            </h2>


                            <label for="nome">Nome</label>
                            <input type="text" name="nome" maxlength="40" required class="form-control"
                                value="<?php echo $linha['nome'] ?>">


                            <div class="form-group">


                                <input type="hidden" name="excluir" value="exclui_cargo">
                                <input type="hidden" name="codigo_cargo" value="<?php echo $codigo ?>">

                                <div class="col d-flex">
                                    <input type="submit" class="btn-danger btn-lg mt-4 w-100 me-1" name="remove"
                                        value="Excluir">
                                    <input type="submit" class="btn-primary btn-lg mt-4 w-100 ms-1" name="remove"
                                        value="Cancelar">
                                </div>
                            </div>
                        <?php } ?>

                    </form>
                </div>
            </main>
        </div>
    </div>
</body>

</html>