<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livraria da Vila</title>

    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
    <header class="topo navbar-light bg-light">
        <nav class="container navbar navbar-expand-lg">
            <!-- Logotipo -->
            <a class="navbar-brand" href="index.php">
                <img src="assets/img/logo-01.png" alt="Livraria da Vila" class="img-fluid" style="width: 125px;">
            </a>
            <!-- Ícone do menu mobile -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado"
                aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navegação -->
            <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
                <ul class="navbar-nav ml-auto mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Página Inicial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" target="_blank" href="admin">Administrador</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0 ml-auto" action="busca.php">
                    <input class="form-control mr-sm-2" type="search" placeholder="Digite aqui o que procura :)"
                        aria-label="Pesquisar" name="busca">
                    <button class="btn btn-outline-danger my-2 my-sm-0 ml-2" type="submit"><i
                            class="bi bi-search"></i></button>
                </form>
            </div>
        </nav>
    </header>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+8b/1fbOeK8Fj4nF2bZqWhS6xkzQ3MT1O8MzG1C4"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>

</html>