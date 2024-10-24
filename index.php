<?php

require_once('conexao/conecta.php');

if (!isset($_SESSION)) {
    session_start();
}

// BUSCANDO NO BANCO DE DADOS TABELA CATEGORIA
$sql_categoria = "SELECT * FROM categoria WHERE status = 1";
$resultado_categoria = mysqli_query($conexao, $sql_categoria);

// BUSCANDO NO BANCO DE DADOS TABELA EDITORA
$sql_editora = "SELECT * FROM editora WHERE status = 1";
$resultado_editora = mysqli_query($conexao, $sql_editora);

//BUSCANDO NO BANCO DE DADOS TABELA AUTOR
$sql_autores = "SELECT * FROM autor WHERE status = 1";


// Consultar livros
$sql = "SELECT codigo_livro, imagem, titulo, preco_venda,preco_promocao, promocao FROM livro WHERE status = 1 ORDER BY codigo_livro";
$resultado_produto = mysqli_query($conexao, $sql);
$linha = mysqli_fetch_assoc($resultado_produto);

$total_produtos = mysqli_num_rows($resultado_produto);
$produtos_exibidos = 0;
$limite_banner = 8;


// Variáveis dos filtros
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$editora = isset($_GET['editora']) ? $_GET['editora'] : '';
$preco = isset($_GET['preco']) ? $_GET['preco'] : '';

// Início da query de busca
$sql = "SELECT codigo_livro, imagem, titulo, preco_venda, preco_promocao, promocao 
        FROM livro 
        WHERE status = 1";

// Adiciona filtro de categoria, se selecionado
if ($categoria != '') {
    $sql .= " AND codigo_categoria = '$categoria'";
}

// Adiciona filtro de editora, se selecionado
if ($editora != '') {
    $sql .= " AND codigo_editora = '$editora'";
}

// Adiciona filtro de preço, se selecionado
if ($preco != '') {
    switch ($preco) {
        case '1':
            $sql .= " AND preco_venda <= 50";
            break;
        case '2':
            $sql .= " AND preco_venda BETWEEN 50 AND 100";
            break;
        case '3':
            $sql .= " AND preco_venda > 100";
            break;
    }
}

// Ordena por código do livro
$sql .= " ORDER BY codigo_livro";

// Executa a query
$resultado_produto = mysqli_query($conexao, $sql);
$linha = mysqli_fetch_assoc($resultado_produto);
$total_produtos = mysqli_num_rows($resultado_produto);


?>

<?php include("header.php") ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livraria da Vila</title>

    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="style.css">

<link rel="shortcut icon" href="../assets/img/fiveicon.png" type="image/x-icon">

<!--  A META TAG AUTOR DEfINE O AUTOR DA PAGINA WEB -->
<meta name="author" content="Lucas Poteral Bianchim">

<!--  A META TAG KEYWORDS DEFINE AS PALAVRAS CHAVES PARA BUSCA DO SITE -->
<meta name="keywords" content="livraria da vila, livraria, vila, livro">

<!-- A META TAG DESCRIPTION DEFINE UM BREVE RESUMO DE SEU SITE PARA A BUSCA -->
<meta name="description" content="A Livraria da Vila chega aos seus 39 anos em 2024. Desde 1985 trabalhamos com a firme convicção de que o livro é ferramenta essencial para uma Educação melhor para todos, talvez o pilar principal para transformar o Brasil numa nação mais justa e com mais oportunidades. ">

<!-- FontAwesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

    <!-- INICIO CARROSEL -->
    <section>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100 img-fluid" src="assets/img/banner-1.png" alt="Primeiro Slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 img-fluid" src="assets/img/banner-2.png" alt="Segundo Slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 img-fluid" src="assets/img/banner-3.png" alt="Terceiro Slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Próximo</span>
            </a>
        </div>
    </section>
    <!-- FIM DO CARROSEL -->

    <!-- INICIO BANNER -->
    <section class="banner">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <img src="assets/img/livraria-da-vila.jpg" alt="Imagem da Livraria da Vila" class='img-fluid'>
                </div>
                <div class="col-lg-6 col-md-12 text-center pt-5">
                    <h1 class="display-4">Bem-vindo à Livraria da Vila</h1>
                    <p class="text-muted lead">Charmosa, acolhedora e receptiva, a Livraria da Vila é o ponto de
                        encontro perfeito para os amantes de livros.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- FIM DO BANNER -->


    <section class="filtro py-5 mt-5">
    <div class="container">
        <form action="" method="GET">
            <div class="row">
                <!-- Filtro por Categoria -->
                <div class="col-md-6 col-lg-3 mb-3">
                    <label for="categoria" class="form-label">Categoria:</label>
                    <select name="categoria" class="form-select" id="categoria">
                        <option value="">Todas</option>
                        <?php while ($categoria = mysqli_fetch_assoc($resultado_categoria)) { ?>
                            <option value="<?php echo $categoria['codigo_categoria']; ?>">
                                <?php echo $categoria['nome']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Filtro por Editora -->
                <div class="col-md-6 col-lg-3 mb-3">
                    <label for="editora" class="form-label">Editora:</label>
                    <select name="editora" class="form-select" id="editora">
                        <option value="">Todas</option>
                        <?php while ($editora = mysqli_fetch_assoc($resultado_editora)) { ?>
                            <option value="<?php echo $editora['codigo_editora']; ?>">
                                <?php echo $editora['nome']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Filtro por Preço -->
                <div class="col-md-6 col-lg-3 mb-3">
                    <label for="preco" class="form-label">Preço:</label>
                    <select name="preco" class="form-select" id="preco">
                        <option value="">Qualquer</option>
                        <option value="1">Até R$ 50,00</option>
                        <option value="2">De R$ 50,00 a R$ 100,00</option>
                        <option value="3">Acima de R$ 100,00</option>
                    </select>
                </div>

                <!-- Botão de Filtro -->
                <div class="col-12 col-lg-3 d-flex align-items-end mb-3">
                    <div class="w-100 text-center">
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>


<section class="itens pt-5">
    <div class="container">
        <div id="product-list">
            <div class="row">
                <?php while ($linha) { ?>
                    <?php if ($produtos_exibidos == $limite_banner) { ?>
                        <!-- Banner 2 -->
                        <div class="col-12">
                            <section class="banner2-section">
                                <div class="carousel-inner mt-4 position-relative">
                                    <div class="carousel-item active">
                                        <img class="banner2-img img-fluid" src="./assets/img/banner2.jpg" alt="Banner">
                                    </div>
                                </div>
                            </section>
                        </div>
                        <!-- Fim do Banner 2 -->
                    <?php } ?>

                    <div class="col-lg-3 col-md-4 col-sm-6 pt-4">
                        <div class="card mx-auto position-relative">
                            <!-- Card Promoção -->
                            <?php if ($linha['promocao']) { ?>
                                <div class="position-absolute top-0 start-0 bg-danger text-white px-2 py-1">
                                    Promoção
                                </div>
                            <?php } ?>
                            
                            <img class="card-img-top img-fluid" src="assets/img/<?php echo $linha['imagem'] ?>" alt="Imagem de capa do card">
                            
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo mb_strimwidth($linha['titulo'], 0, 15, "...") ?>
                                </h5>
                                <a href="produtos.php?codigo_livro=<?php echo $linha['codigo_livro'] ?>" class="btn btn-danger d-flex justify-content-center">Ver Detalhes</a>
                            </div>
                        </div>
                    </div>

                    <?php $produtos_exibidos++; ?>
                    <?php $linha = mysqli_fetch_assoc($resultado_produto); ?>
                <?php } ?>
            </div>
        </div>
    </div>
</section>



    <section>
        <div class="col-lg-12 text-center mt-4 ">
            <h1>Conheça Nossas Lojas</h1>
        </div>
    </section>

    <!-- Seção Lojas -->
    <section class="bg-danger mt-4" style="padding-top:80px; padding-bottom: 80px;">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">

                <!-- Primeira Slide -->
                <div class="carousel-item active">
                    <div class="row text-center">
                        <div class="col-lg-3 col-md-6 col-sm-12 py-4">
                            <h5>Shopping Anália Franco</h5>
                            <p>Av. Regente Feijó, Nº 1739 - Loja L11<br>Vl. Regente Feijó - SP<br>(11) 4210-0882</p>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 py-4">
                            <h5>Flamboyant Shopping</h5>
                            <p>Av. Jamel Cecílio, Nº 3300 - Piso Térreo<br>Goiânia - GO<br>(62) 3442-0266</p>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 py-4">
                            <h5>Loja Fradique</h5>
                            <p>Rua Fradique Coutinho, Nº 915 <br>Pinheiros - SP<br>(11) 3814-5811</p>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 py-4">
                            <h5>Loja Lorena</h5>
                            <p>Alameda Lorena, Nº 1501 <br>Jardim Paulista - SP<br>(11) 3062-1063</p>
                        </div>
                    </div>
                </div>

                <!-- Segunda Slide -->
                <div class="carousel-item">
                    <div class="row text-center">
                        <div class="col-lg-3 col-md-6 col-sm-12 py-4">
                            <h5>Loja Moema</h5>
                            <p>Av. Moema, Nº 493 <br>Moema - SP<br>(11) 5052-3540</p>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 py-4">
                            <h5>Aurora Shopping Londrina</h5>
                            <p>Avenida Ayrton Senna da Silva, Nº 400- Loja 6/7 - Piso 2<br>Gleba Fazenda Palhano -
                                PR<br>(43) 3329-6776</p>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 py-4">
                            <h5>Shopping Jardim Pamplona</h5>
                            <p>Rua Pamplona, Nº 1704 - LJ 2.14<br>São Paulo - SP<br>(11) 3051-4016</p>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 py-4">
                            <h5>Shopping JK Iguatemi</h5>
                            <p>Av. Juscelino Kubitschek, Nº 2041 - Loja 335/336<br>Itaim Bibi - SP<br>(11) 5180-4790</p>
                        </div>
                    </div>
                </div>

                <!-- Terceira Slide -->
                <div class="carousel-item">
                    <div class="row text-center">
                        <div class="col-lg-3 col-md-6 col-sm-12 py-4">
                            <h5>Shopping Leblon</h5>
                            <p>Av. Afrânio de Melo Franco, Nº 290 - Loja 205-A<br>Rio de Janeiro - RJ<br>(21) 3875-5734
                            </p>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 py-4">
                            <h5>Shopping Morumbi</h5>
                            <p>Av. Roque Petroni Júnior, Nº 1089 - Loja 6031<br>São Paulo - SP<br>(11) 5189-4290</p>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 py-4">
                            <h5>Shopping Pátio Batel</h5>
                            <p>Av. do Batel, Nº 1868 - Loja 241<br>Curitiba - PR<br>(41) 3020-3373</p>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 py-4">
                            <h5>Shopping Vila Olímpia</h5>
                            <p>R. Olimpíadas, Nº 360 - Loja 317 <br>São Paulo - SP<br>(11) 5053-4297</p>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Controles do Carrossel -->
            <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Próximo</span>
            </a>
        </div>
    </section>






</body>

</html>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<?php include("footer.php") ?>