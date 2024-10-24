<?php 

if(!isset($_SESSION)){
  session_start();
  
}

require_once('../conexao/conecta.php');

$sql = "SELECT livro.codigo_livro, livro.titulo, livro.preco_custo, livro.preco_venda, categoria.nome 'Categoria', editora.nome'Editora', livro.qtde_estoque, livro.data_cadastro, livro.status FROM livro JOIN categoria ON livro.codigo_categoria = categoria.codigo_categoria JOIN editora ON livro.codigo_editora = editora.codigo_editora ORDER BY livro.codigo_livro";

$resultado = mysqli_query($conexao, $sql);

if (!$resultado) {
    die("Erro na consulta: " . mysqli_error($conexao));
}

?>

<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Produtos</title>

  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap icons-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
</head>
<body>
  <?php include('topo.php'); ?>

  <div class="container-fluid">
    <div class="row">
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2 text-primary">Painel Administrativo</h1>
        </div>

        <h4>Produtos</h4>
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Preço Custo</th>
                <th scope="col">Preço Venda</th>
                <th scope="col">Categoria</th>
                <th scope="col">Editora</th>
                <th scope="col">Qtd.Estoque</th>
                <th scope="col">Data Cadastro</th>
                <th scope="col">Status</th>
                <th colspan="2" scope="col" class="text-center">
                  <a href="produto_insere.php" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-plus"></i> Inserir
                  </a>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php while ($linha = mysqli_fetch_assoc($resultado)) { ?>
                <tr>
                  <td><?php echo htmlspecialchars($linha['codigo_livro']); ?></td>
                  <td><?php echo htmlspecialchars($linha['titulo']); ?></td>
                  <td><?php echo htmlspecialchars($linha['preco_custo']); ?></td>
                  <td><?php echo htmlspecialchars($linha['preco_venda']); ?></td>
                  <td><?php echo htmlspecialchars($linha['Categoria']); ?></td>
                  <td><?php echo htmlspecialchars($linha['Editora']); ?></td>
                  <td><?php echo htmlspecialchars($linha['qtde_estoque']); ?></td>
                  <td>
                    <?php
                      $data = date_create($linha['data_cadastro']);
                      echo date_format($data, 'd/m/Y');
                    ?>
                  </td>
                  <td>
                    <?php if ($linha['status'] == 1) { ?>
                      <div class="badge bg-success text-white">Ativo</div>
                    <?php } else { ?>
                      <div class="badge bg-danger text-white">Inativo</div>
                    <?php } ?>
                  </td>
                  <td class="text-end">
                    <a href="produto_altera.php?codigo_livro=<?php echo htmlspecialchars($linha['codigo_livro']); ?>" class="btn btn-outline-warning btn-sm" title="Editar">
                      <i class="bi bi-pencil"></i>
                    </a>
                  </td>
                  <td class="text-start">
                    <a href="produto_exclui.php?codigo_livro=<?php echo htmlspecialchars($linha['codigo_livro']); ?>" class="btn btn-outline-danger btn-sm" title="Excluir">
                      <i class="bi bi-trash"></i>
                    </a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>
</body>
</html>
