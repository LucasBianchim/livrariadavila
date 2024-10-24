<?php

require_once('conexao/conecta.php');

if (!isset($_SESSION)) {
    session_start();

}

if (isset($_GET['busca']) && $_GET['busca'] != '') {

    $busca = $_GET['busca'];


    $sql_contagem = "SELECT codigo_livro FROM livro WHERE titulo LIKE '%$busca%'";
    $resultado_contagem = mysqli_query($conexao, $sql_contagem);
    $quantidade = mysqli_num_rows($resultado_contagem);


    //ROTINA DE PÁGINAÇÃO
    $buscapag = "&busca=" . $_GET['busca'];

    if (isset($_GET['pagina']) && !empty($_GET['pagina'])) {
        $paginaatual = $_GET['pagina'];
    } else {
        $paginaatual = 1;
    }

    $url = "?pagina=";

    //QUANTIDADE DE PRODUTOS EXIBIDOS POR PÁGINA
    $paginaqtde = 8;

    //VALOR INICIAL PARA A CLÁUSULA LIMIT
    $valorinicial = ($paginaatual * $paginaqtde) - $paginaqtde;
    //(2 * 8) -8 = 8
    $paginafinal = ceil($quantidade / $paginaqtde); //CEIL ARREDONDA FRAÇÕES PARA CIMA
    $paginainicial = 1;
    $paginaproxima = $paginaatual + 1;
    $paginaanterior = $paginaatual - 1;

    $sql = "SELECT *FROM livro WHERE titulo LIKE '%$busca%' ORDER BY codigo_livro DESC LIMIT $valorinicial, $paginaqtde";
    $resultado = mysqli_query($conexao, $sql);
}

?>

<?php include("header.php") ?>

 <!-- BOOTSTRAP CSS -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="style.css">

<section class="itens pt-5">
    <div class="container">
        <div id="product-list">
            <div class="row">
                <?php
                if ($quantidade > 0) {
                    foreach ($resultado as $linha) {
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 pt-4">
                            <div class="card mx-auto">
                                <img class="card-img-top" src="assets/img/<?php echo $linha['imagem'] ?>"
                                    alt="Imagem de capa do card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo mb_strimwidth($linha['titulo'], 0, 20, "...") ?>
                                    </h5>
                                    <p class="card-text text-success">R$ <?php echo $linha['preco_venda'] ?></p>
                                    <a href="produtos.php?codigo_livro=<?php echo $linha['codigo_livro'] ?>"
                                        class="btn btn-danger d-flex justify-content-center">Ver Detalhes</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="col-12 mt-3">
                        <p>Nenhum resultado encontrado!</p>
                    </div>
                <?php }
                ?>
                <div class="col-12 d-flex justify-content-center mt-5">
                    <nav aria-label="paginacao">
                        <ul class="pagination justify-content-center">
                            <?php if ($paginaatual != $paginainicial) { ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo $url . $paginainicial . $buscapag ?>">Início</a>
                                </li>
                            <?php } ?>

                            <?php if ($paginaatual >= 2) { ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo $url . $paginaanterior . $buscapag ?>"
                                        aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php } ?>

                            <?php if ($paginaatual != $paginafinal) { ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo $url . $paginaproxima . $buscapag ?>"
                                        aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>

                                <li class="page-item">
                                    <a class="page-link" href="<?php echo $url . $paginafinal . $buscapag ?>">Final</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>



<?php include("footer.php") ?>