<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once('../conexao/conecta.php');

// BUSCANDO NO BANCO AS INFORMAÇÕES DO AUTOR SELECIONADO
if (isset($_GET['codigo_autor']) && $_GET['codigo_autor'] != '') {
    $codigo = $_GET['codigo_autor'];
    $sql = "SELECT nome FROM autor WHERE codigo_autor = $codigo";
    $resultado = mysqli_query($conexao, $sql);
    $linha = mysqli_fetch_assoc($resultado);



}

// ROTINA DE EXCLUSÃO
if (isset($_POST['excluir']) && $_POST['excluir'] == 'exclui_autor') {
    $codigo = $_POST['codigo_autor'];

    if (isset($_POST['remove']) && $_POST['remove'] == 'Excluir') {
        $sql = "DELETE FROM autor WHERE codigo_autor = $codigo";

        if (mysqli_query($conexao, $sql)) {
            header('Location: autor.php');
        } else {
            die("Erro: " . $sql . "<br>" . mysqli_error($conexao));
        }
    } else {
        header('Location: autor.php');
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
    <title>Excluir Autor</title>

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
                    <h1 class="h2">Painel Administrativo</h1>
                </div>
                <h4>Excluindo o Autor:</h4>
                <div class="col-md-8">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" maxlength="40" required class="form-control"
                                value="<?php echo htmlspecialchars($linha['nome']); ?>" readonly>
                        </div>
                        <div class="form-group mt-3">
                            <input type="hidden" name="excluir" value="exclui_autor">
                            <input type="hidden" name="codigo_autor" value="<?php echo htmlspecialchars($codigo); ?>">
                            <div class="d-flex">
                                <input type="submit" class="btn btn-danger btn-lg me-2" name="remove" value="Excluir">
                                <input type="submit" class="btn btn-primary btn-lg ms-2" name="remove" value="Cancelar">
                            </div>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

</body>

</html>