<?php
require_once('conexao/conecta.php');

if (!isset($_SESSION)) {
    session_start();
}

// Busca os detalhes do produto no banco de dados
$codigo = $_GET['codigo_livro'];
$sql = "SELECT titulo, preco_venda, imagem, livro.promocao AS promocao, livro.preco_promocao AS preco_promocao, categoria.nome AS Categoria, editora.nome AS Editora, livro.descricao FROM livro JOIN categoria ON categoria.codigo_categoria = livro.codigo_categoria JOIN editora ON editora.codigo_editora = livro.codigo_editora WHERE codigo_livro = $codigo";
$resultado = mysqli_query($conexao, $sql);
$linha = mysqli_fetch_assoc($resultado);

// BUSCA DO AUTOR NO DETALHE DO PRODUTO
$sql_autor = "SELECT autor.nome AS Nome FROM autor 
            JOIN precisa ON autor.codigo_autor = precisa.codigo_autor 
            JOIN livro ON livro.codigo_livro = precisa.codigo_livro 
            WHERE precisa.codigo_livro = $codigo";
$resultado_autor = mysqli_query($conexao, $sql_autor);

// Armazenar os autores em uma lista
$autores = [];
while ($linha_autor = mysqli_fetch_assoc($resultado_autor)) {
    $autores[] = $linha_autor['Nome'];
}
?>

<?php include("header.php"); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto</title>

    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="style.css">

    <link rel="shortcut icon" href="assets/img/fiveicon.png" type="icone browser">

<!--  A META TAG AUTOR DEfINE O AUTOR DA PAGINA WEB -->
<meta name="author" content="Lucas Poteral Bianchim">

<!--  A META TAG KEYWORDS DEFINE AS PALAVRAS CHAVES PARA BUSCA DO SITE -->
<meta name="keywords" content="livraria da vila, livraria, vila, livro">

<!-- A META TAG DESCRIPTION DEFINE UM BREVE RESUMO DE SEU SITE PARA A BUSCA -->
<meta name="description" content="A Livraria da Vila chega aos seus 39 anos em 2024. Desde 1985 trabalhamos com a firme convicção de que o livro é ferramenta essencial para uma Educação melhor para todos, talvez o pilar principal para transformar o Brasil numa nação mais justa e com mais oportunidades. ">

<!-- FontAwesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body style="background-color: #E6E6E6;">
    <div class="container pt-5">
        <section id="produto-top" class="bg-white rounded mb-5 shadow p-4">
            <div class="row">
                <div class="col-lg-4 text-center">
                    <img class="img-fluid rounded" src="assets/img/<?php echo $linha['imagem'] ?>"
                        alt="<?= $linha['titulo'] ?>">
                </div>
                <div class="col-lg-8">
                    <h2 class="mb-3"><?= $linha['titulo'] ?></h2>
                    <p class="text-info mb-2">Autor(es): <?php echo implode(', ', $autores); ?></p>
                    <p class="text-danger mb-2">Categoria: <?= $linha['Categoria'] ?></p>
                    <p class="text-primary mb-4">Editora: <?= $linha['Editora'] ?></p>

                    <!-- Verifica se o produto está em promoção -->
                    <?php if ($linha['promocao'] == 1) { ?>
                        <p class="text-muted mb-2">
                            <del>Valor: R$ <?= number_format($linha['preco_venda'], 2, ',', '.') ?></del>
                        </p>
                        <p class="text-success h4 mb-0">
                            Valor Promocional: R$ <?= number_format($linha['preco_promocao'], 2, ',', '.') ?>
                        </p>
                    <?php } else { ?>
                        <p class="text-success h4 mb-0">Valor: R$ <?= number_format($linha['preco_venda'], 2, ',', '.') ?></p>
                    <?php } ?>
                </div>
            </div>
        </section>

        <section id="sinopse" class="bg-white rounded shadow p-4">
            <h5 class="font-weight-bold text-center mb-3">Sinopse</h5>
            <p class="text-warning"><?= $linha['descricao'] ?></p>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

    <?php include("footer.php"); ?>
</body>

</html>
