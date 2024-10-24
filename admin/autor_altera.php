<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once('../conexao/conecta.php');

// BUSCANDO NO BANCO AS INFORMAÇÕES DO AUTOR SELECIONADO
if (isset($_GET['codigo_autor']) && $_GET['codigo_autor'] != '') {
    $codigo = $_GET['codigo_autor'];
    $sql = "SELECT * FROM autor WHERE codigo_autor = $codigo";
    $resultado = mysqli_query($conexao, $sql);
    $linha = mysqli_fetch_assoc($resultado);
}

// ROTINA DE ATUALIZAÇÃO
if (isset($_POST['alterar']) && $_POST['alterar'] == 'altera_autor') {
    $codigo = $_POST['codigo_autor'];
    $nome = $_POST['nome'];
    $status = $_POST['status'];
    $nacionalidade = $_POST['nacionalidade'];

    $sql = "UPDATE autor SET nome = '$nome', status = $status, nacionalidade = '$nacionalidade' WHERE codigo_autor = $codigo";

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
    <title>Alterar Autor</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Favicon -->
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
                <h4>Alterar Autor</h4>
                <div class="col-md-8">
                    <form action="" method="post">
                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" maxlength="40" required
                                    value="<?php echo htmlspecialchars($linha['nome']); ?>" class="form-control">
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="status">Status</label>
                                <select name="status" class="form-select">
                                    <option value="1" <?php if ($linha['status'] == 1)
                                        echo "selected"; ?>>Ativo</option>
                                    <option value="0" <?php if ($linha['status'] == 0)
                                        echo "selected"; ?>>Inativo</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="nacionalidade">Nacionalidade</label>
                                <input type="text" name="nacionalidade" maxlength="40" required
                                    value="<?php echo htmlspecialchars($linha['nacionalidade']); ?>"
                                    class="form-control">
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <input type="hidden" name="alterar" value="altera_autor">
                                <input type="hidden" name="codigo_autor"
                                    value="<?php echo htmlspecialchars($codigo); ?>">
                                <input type="submit" class="btn btn-primary btn-lg w-100" value="Atualizar">
                            </div>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <!-- CKEDITOR -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#observacao'))
            .catch(error => {
                console.error(error);
            });
    </script>

</body>

</html>