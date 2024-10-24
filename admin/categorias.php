<?php 

if(!isset($_SESSION)){
  session_start();
  
}

require_once('../conexao/conecta.php');

$sql = "SELECT * FROM categoria";
$resultado = mysqli_query($conexao,$sql);
$linha = mysqli_fetch_assoc($resultado);

?>

<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Categorias</title>

  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap icons-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />

</head>
<body class="bg-light">
  <?php
    #Início TOPO
    include('topo.php');
    #Final TOPO
  ?>

  <div class="container-fluid">
    <div class="row">
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2 text-primary">Painel Administrativo</h1>
        </div>

        <h4 class="text-secondary">Categorias de Produtos</h4>
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered ">
            <thead class="table-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Categoria</th>
                <th scope="col">Observação</th>
                <th scope="col">Data Cadastro</th>
                <th scope="col">Status</th>
                <th colspan="2" scope="col" class="text-center"><a href="categoria_insere.php" class="btn btn-outline-light table-bordered btn-sm"><i class="bi bi-plus"></i> Inserir</a></th>
              </tr>
            </thead>
            <tbody>
            <?php do{ ?>
              <tr>
                <td><?php echo $linha['codigo_categoria'] ?></td>
                <td><?php echo $linha['nome'] ?></td>
                <td><?php echo $linha['observacao'] ?></td>
                  <?php
                    $data = date_create($linha['data_cadastro']);
                    echo '<td>' . date_format($data, 'd/m/Y') . '</td>';
                  ?>
                <td>
                  <?php if($linha['status'] == 1) { ?>
                    <div class="badge bg-success text-white">Ativo</div>
                  <?php } else { ?>
                    <div class="badge bg-danger text-white">Inativo</div>
                  <?php } ?>
                </td>
                <td class="text-end"><a href="categoria_altera.php?codigo_categoria=<?php echo $linha['codigo_categoria']?>" class="btn btn-outline-warning btn-sm" title="Editar"><i class="bi bi-pencil"></i></a></td>
                <td class="text-start"><a href="categoria_exclui.php?codigo_categoria=<?php echo $linha['codigo_categoria']?>" class="btn btn-outline-danger btn-sm" title="Excluir"><i class="bi bi-trash"></i></a></td>
              </tr>
            <?php } while($linha = mysqli_fetch_assoc($resultado)) ?>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>
</body>
</html>
