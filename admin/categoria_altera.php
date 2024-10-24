<?php 

if(!isset($_SESSION)){
    session_start();
    
  }
    require_once('../conexao/conecta.php');

    // BUSCANDO NO BANCO AS INFORMAÇÕES DA CATEGORIA SELECIONADA
    if(isset($_GET['codigo_categoria']) && $_GET ['codigo_categoria'] != ''){

        $codigo = $_GET['codigo_categoria'];

        $sql = "SELECT * FROM categoria WHERE  codigo_categoria = '$codigo'";
        $resultado = mysqli_query($conexao, $sql);
        $linha = mysqli_fetch_assoc($resultado);
    }

    // ROTINA DE ATUALIZAÇÃO

    if(isset ($_POST['alterar']) && $_POST ['alterar'] == 'altera_categoria'){

        $codigo = $_POST['codigo_categoria'];
        $nome = $_POST['nome'];
        $status = $_POST['status'];
        $observacao = $_POST ['observacao'];

        $sql = "UPDATE  categoria SET nome = '$nome', status = $status, observacao = '$observacao' WHERE codigo_categoria = '$codigo'";

        if(mysqli_query($conexao, $sql)){
            header('Location: categorias.php');
        }
        else{
            die("Erro:" . $sql . "<br>" . mysqli_error($conexao));
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
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">
                        Painel Administrativo
                    </h1>
                </div>
                <h4>Alterar Categoria</h4>
                <div class="col-md-12">
                    <form action="" method="post">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" maxlength="40" required  value = "<?php echo $linha ['nome'] ?>" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="status">Status</label>
                                <select name="status" id="" class="form-select form-control">
                                    <option value="1" <?php if($linha ['status'] == 1) echo "selected"; ?>>Ativo</option>
                                    <option value="0" <?php if($linha ['status'] == 0) echo "selected"; ?>>Inativo</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="observacao">Observação</label>
                            <textarea name="observacao" id="observacao" class="form-control">
                            <?php echo $linha ['observacao'] ?>
                        </textarea>

                            <input type="hidden" name="alterar" value="altera_categoria">
                            <input type="hidden" name ="codigo_categoria" value ="<?php echo $codigo ?>">
                            <input type="submit" class="btn-primary btn-lg mt-4 w-100" value="Atualizar">
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