

<?php 


if(!isset($_SESSION)){
    session_start();
    
  }
  
require_once('../conexao/conecta.php');

if(isset($_POST['inserir']) && $_POST['inserir'] == 'insere_cargo')
{
    $nome = $_POST['nome'];
    $status = $_POST['status'];
    $observacao = $_POST['observacao'];

    $sql = "INSERT INTO cargo (data_cadastro, status, nome, observacao) VALUES (NOW(), $status,'$nome', '$observacao' )";

    if(mysqli_query($conexao, $sql))
    {
        header('Location: cargos.php');
    }

    else
    {
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
    <title>Cargos</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />

</head>

<body>

    <!-- Início TOPO -->
    <?php include('topo.php') ?>
    <!-- Fim TOPO -->

    <div class="container">
        <div class="row">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Painel Administrativo</h1>
                </div>
                <h4>Novo Cargo</h4>
                <div class="col-md-12">
                    <form action="" method="post">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" maxlength="40" required class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-select form-control">
                                    <option value="1">Ativo</option>
                                    <option value="0">Inativo</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="observacao">Observação</label>
                            <textarea name="observacao" id="observacao" class="form-control"></textarea>
                        </div>
                        <input type="hidden" name="inserir" value="insere_cargo">
                        <input type="submit" class="btn btn-primary btn-lg mt-4 w-100" value="Cadastrar">
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
