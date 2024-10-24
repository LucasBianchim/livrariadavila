<?php

if (!isset($_SESSION)) {
    session_start();

}
require_once('../conexao/conecta.php');

// BUSCANDO NO BANCO DE DADOS TABELA CATEGORIA
$sql_categoria = "SELECT * FROM categoria WHERE status = 1";
$resultado_categoria = mysqli_query($conexao, $sql_categoria);
$linha_categoria = mysqli_fetch_assoc($resultado_categoria);

// BUSCANDO NO BANCO DE DADOS TABELA EDITORA
$sql_editora = "SELECT * FROM editora WHERE status = 1";
$resultado_editora = mysqli_query($conexao, $sql_editora);
$linha_editora = mysqli_fetch_assoc($resultado_editora);

//BUSCANDO NO BANCO DE DADOS TABELA AUTOR
$sql_autor = "SELECT * FROM autor WHERE status = 1";
$resultado_autor = mysqli_query($conexao, $sql_autor);
$linha_autor = mysqli_fetch_assoc($resultado_autor);

if (isset($_POST['inserir']) && $_POST['inserir'] == 'insere_produto') {
    $nome = $_POST['titulo'];
    $ano_publicacao = $_POST['ano_publicacao'];
    $status = $_POST['status'];
    $preco_custo = $_POST['preco_custo'];
    $lucro = $_POST['lucro'];
    $qtde_estoque = $_POST['qtde_estoque'];
    $promocao = $_POST['promocao'];
    $preco_promocao = $_POST['preco_promocao'];
    $preco_venda = $_POST['preco_venda'];
    $categoria = $_POST['codigo_categoria'];
    $editora = $_POST['codigo_editora'];
    $descricao = $_POST['descricao'];
    $autores = $_POST['autor'];


    // Armazenando o nome do arquivo para upload
    $imagem = basename($_FILES['imagem']['name']);
    // Armazenando um caminho temporário para a pasta tmp
    $temp = $_FILES['imagem']['tmp_name'];
    // Caminho Final
    $final = "../assets/img/" . $imagem;

    move_uploaded_file($temp, $final);



    $sql = "INSERT INTO livro (data_cadastro, status, titulo, ano_publicacao, imagem, promocao, preco_custo, preco_venda, preco_promocao, lucro, qtde_estoque, codigo_categoria, codigo_editora, descricao) VALUES (NOW(), $status, '$nome', '$ano_publicacao', '$imagem', $promocao, '$preco_custo', '$preco_venda', '$preco_promocao', '$lucro', '$qtde_estoque', $categoria, $editora, '$descricao')";

    if (mysqli_query($conexao, $sql)) {
        $livro_id = mysqli_insert_id($conexao);
        foreach ($autores as $autor_id) {
            $sql_livro_autor = "INSERT INTO precisa (codigo_livro, codigo_autor) VALUES ('$livro_id', '$autor_id')";
            mysqli_query($conexao, $sql_livro_autor);
        }
        header('Location: produtos.php');
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
    <title>Produtos</title>

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
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Painel Administrativo</h1>
                </div>
                <h4>Novo Produto</h4>
                <div class="col-md-12">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="titulo">Nome</label>
                                <input type="text" class="form-control" name="titulo" placeholder="Nome" maxlength="100"
                                    required>
                            </div>
                            <div class="form-group col-md-4 ml-0">
                                <label for="ano_publicacao">Ano de Publicação</label>
                                <input type="date" id="ano_publicacao" class="form-control" name="ano_publicacao"
                                    autocomplete="off">
                            </div>
                            <div class="form-group col-md-12 ">
                                <label for="descricao">Sinopse</label>
                                <textarea name="descricao" id="descricao" class="form-control">
                        </textarea>
                            </div>
                        </div>


                        <div class="row g-3">
                            <div class="col-sm-12">
                                <label for="imagem" class="form-label">Imagem</label>
                                <input type="file" class="form-control " id="imagem" name="imagem" accept="image/*">

                            </div>
                        </div>

                        <div class="col-md-6 mb-3 card">
                            <img src="../assets/img/" alt="" id="img-inserida" class="img-fluid w-50"
                                style="margin: auto 0">
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="qtde_estoque">Quantidade Estoque</label>
                                <input type="number" class="form-control" name="qtde_estoque">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="preco_custo">Preço Custo</label>
                                <input type="number" step="0.01" class="form-control" id="preco_custo"
                                    name="preco_custo">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="lucro">Lucro (%)</label>
                                <input type="number" step="0.01" class="form-control" id="lucro" name="lucro">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="preco_venda">Preço Venda</label>
                                <input type="number" step="0.01" class="form-control" id="preco_venda"
                                    name="preco_venda" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="promocao">Produto em Promoção:</label>
                                <select name="promocao" class="form-select form-control" id="promocao"
                                    oninput="togglePrecoPromocao()" required>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="preco_promocao">Preço Promoção</label>
                                <input type="number" step="0.01" class="form-control" name="preco_promocao"
                                    id="preco_promocao">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="categoria">Categoria</label>
                                <select name="codigo_categoria" id="categoria" class="form-select form-control">

                                    <?php while ($linha_categoria = mysqli_fetch_assoc($resultado_categoria)) { ?>
                                        <option value="<?php echo $linha_categoria['codigo_categoria'] ?>">
                                            <?php echo $linha_categoria['nome'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="editora">Editora</label>
                                <select name="codigo_editora" class="form-select form-control">

                                    <?php while ($linha_editora = mysqli_fetch_assoc($resultado_editora)) { ?>
                                        <option value="<?php echo $linha_editora['codigo_editora'] ?>">
                                            <?php echo $linha_editora['nome'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="status">Status</label>
                                <select name="status" class="form-select form-control" required>
                                    <option value="1" selected>Ativo</option>
                                    <option value="0">Inativo</option>
                                </select>
                            </div>
                            <div class=" form-group col-md-4">
                                <label for="autor">Autores:</label>
                                <select name="autor[]" multiple class="form-select form-control">
                                    <?php foreach ($resultado_autor as $linha_autor) { ?>
                                        <option value="<?php echo $linha_autor['codigo_autor'] ?>">
                                            <?php echo $linha_autor['nome'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <hr class="my-4">
                        <input type="hidden" name="inserir" value="insere_produto">
                        <input type="submit" class="btn btn-primary mt-4 w-100" value="Cadastrar">
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>

</html>

<!-- CKEDITOR -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#descricao'))
        .catch(error => {
            console.error(error);
        });
</script>

<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script type="text/javascript">

    document.getElementById('preco_custo').addEventListener('input', calculoVenda);
    document.getElementById('lucro').addEventListener('input', calculoVenda);

    function calculoVenda() {
        const preco_custo = parseFloat(document.getElementById('preco_custo').value) || 0;
        const lucro = parseFloat(document.getElementById('lucro').value) || 0;
        const preco_venda = preco_custo + (preco_custo * (lucro / 100));
        document.getElementById('preco_venda').value = preco_venda.toFixed(2);
    }

    function togglePrecoPromocao() {
        var promocao = document.getElementById("promocao");
        var precoPromocao = document.getElementById("preco_promocao");

        if (promocao.value === "1") {
            precoPromocao.disabled = false;
        } else {
            precoPromocao.disabled = true;
        }
    }

</script>

<script>
    document.getElementById('imagem').addEventListener('change', function (event) {
        var file = event.target.files[0]; // Pega o primeiro arquivo selecionado
        var reader = new FileReader(); // Cria um objeto FileReader

        reader.onload = function (e) {
            // Atualiza a imagem exibida com o novo arquivo selecionado
            document.getElementById('img-inserida').src = e.target.result;
        }

        if (file) {
            reader.readAsDataURL(file); // Lê o arquivo como uma URL de dados
        }
    });
</script>+


</body>

</html>