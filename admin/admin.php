<?php

require_once('../conexao/conecta.php');

if (!isset($_SESSION)) {
    session_start();
}



$sql = "SELECT codigo_funcionario from funcionario";
$resultado = mysqli_query($conexao, $sql);
$contagem = mysqli_num_rows($resultado);

$sql = "SELECT codigo_cliente from cliente";
$resultado = mysqli_query($conexao, $sql);
$contagemcliente = mysqli_num_rows($resultado);

$sql = "SELECT codigo_livro from livro";
$resultado = mysqli_query($conexao, $sql);
$contagemlivro = mysqli_num_rows($resultado);

$sql = "SELECT SUM(qtde_estoque) AS total_estoque FROM livro";
$resultado = mysqli_query($conexao, $sql);
$linha = mysqli_fetch_assoc($resultado);

$sql = "SELECT livro.titulo 'Nome' FROM livro JOIN itens ON livro.codigo_livro = itens.codigo_livro GROUP BY livro.titulo ORDER BY SUM(itens.qtde) DESC LIMIT 1";
$resultado_livro = mysqli_query($conexao, $sql);
$linha_livro = mysqli_fetch_assoc($resultado_livro);

?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Painel Administrativo">
    <meta name="author" content="">
    <title>Painel Administrativo</title>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
    <!-- Custom CSS -->
    <style>
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .card-text {
            font-size: 1rem;
        }
        .card {
            border: 1px solid #e0e0e0;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 1.5rem;
        }
        .container-fluid {
            padding: 2rem;
        }
        .page-header {
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 0.5rem;
        }
        .page-header h1 {
            font-size: 2rem;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Início TOPO -->
    <?php include('topo.php'); ?>
    <!-- Final TOPO -->



    <div class="container-fluid">
        <div class="row">
            <main class="col-md-12 col-lg-10 mx-auto px-md-4">
                <div class="page-header">
                    <h1>Painel Administrativo</h1>
                </div>

                <!-- Cards Section -->
                <div class="row">
                    <!-- Card 1 -->
                    <div class="col-sm-12 col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Informações sobre o Painel</h5>
                                <p class="card-text">Este painel é projetado para gerenciar e otimizar as operações da
                                    livraria. Aqui, você pode acessar informações detalhadas sobre livros, autores,
                                    editoras e categorias. As funcionalidades incluem a adição, remoção e atualização de
                                    registros de livros e outros dados relevantes. Apenas administradores têm a
                                    autorização para realizar essas operações, garantindo uma gestão eficiente e segura
                                    do acervo da livraria.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-sm-12 col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Informação da Livraria</h5>
                                <p class="card-text">A Livraria da Vila é uma renomada rede de livrarias que se destaca
                                    pela excelência em curadoria de livros e atendimento personalizado. Fundada com a
                                    missão de oferecer uma experiência de leitura única, a livraria combina um acervo
                                    diversificado de títulos com um ambiente acolhedor e sofisticado. Com um compromisso
                                    em apoiar autores e editoras, a Livraria da Vila também promove eventos culturais,
                                    lançamentos de livros e sessões de autógrafos.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Funcionários Cadastrados</h5>
                                <p class="card-text"><?php echo $contagem; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Clientes Cadastrados</h5>
                                <p class="card-text"><?php echo $contagemcliente; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 5 -->
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Livros Cadastrados</h5>
                                <p class="card-text"><?php echo $contagemlivro; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 6 -->
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Livros em Estoque</h5>
                                <p class="card-text"><?php echo $linha['total_estoque']; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 7 -->
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Livro Mais Vendido</h5>
                                <p class="card-text"><?php echo mb_strimwidth($linha_livro['Nome'], 0, 60, "...") ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS e dependências -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
</body>

</html>
