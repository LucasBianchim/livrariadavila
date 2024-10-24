<?php

if (!isset($_SESSION)) {
    session_start();

}
require_once('../conexao/conecta.php');

//BUSCANDO NO BANCO DE DADOS TABELA CATEGORIA
$sql_categoria = "SELECT * FROM categoria WHERE status = 1";
$resultado_categoria = mysqli_query($conexao, $sql_categoria);

//BUSCANDO NO BANCO DE DADOS TABELA EDITORA
$sql_editora = "SELECT *FROM editora WHERE status = 1";
$resultado_editora = mysqli_query($conexao, $sql_editora);

//BUSCANDO NO BANCO DE DADOS TABELA EDITORA
$sql_autor = "SELECT *FROM autor WHERE status = 1";
$resultado_autor = mysqli_query($conexao, $sql_autor);

// BUSCANDO NO BANCO AS INFORMAÇÕES DO LIVRO SELECIONADA
if (isset($_GET['codigo_livro']) && $_GET['codigo_livro'] != '') {

    $codigo_livro = $_GET['codigo_livro'];

    $sql = "SELECT * FROM livro WHERE  codigo_livro = '$codigo_livro'";
    $resultado = mysqli_query($conexao, $sql);
    $linha = mysqli_fetch_assoc($resultado);
}

if (isset($_POST['alterar']) && $_POST['alterar'] == 'altera_produto') {
    $codigo_livro = $_POST['codigo_livro'];
    $nome = $_POST['titulo'];
    $ano_publicacao = $_POST['ano_publicacao'];
    $status = $_POST['status'];
    $preco_custo = $_POST['preco_custo'];
    $lucro = $_POST['lucro'];
    $qtde_estoque = $_POST['qtde_estoque'];
    $promocao = $_POST['promocao'];
    $preco_promocao = $_POST['preco_promocao'];
    $preco_venda = $_POST['preco_venda'];
    $codigo_categoria = $_POST['codigo_categoria'];
    $codigo_editora = $_POST['codigo_editora'];
    $descricao = $_POST['descricao'];
    $autores = isset($_POST['autores']) ? $_POST['autores'] : [];


    // Armazenando o nome do arquivo para upload
    $imagem = basename($_FILES['imagem']['name']);
    // Armazenando um caminho temporário para a pasta tmp
    $temp = $_FILES['imagem']['tmp_name'];
    // Caminho Final
    $final = "../assets/img/" . $imagem;

    if ($imagem == '') {
        $imagem = $_POST['imagem_inv'];
    }

    // Atualiza os dados do livro
    $sql = "UPDATE livro SET status = $status, titulo = '$nome', ano_publicacao = '$ano_publicacao', imagem = '$imagem', promocao = $promocao, preco_custo = '$preco_custo', preco_venda = '$preco_venda', preco_promocao = '$preco_promocao', lucro = '$lucro', qtde_estoque = '$qtde_estoque', codigo_categoria = $codigo_categoria, codigo_editora = $codigo_editora, descricao = '$descricao' WHERE codigo_livro = $codigo_livro";

    if (mysqli_query($conexao, $sql)) {
        // Remove as associações antigas na tabela 'precisa'
        $sql_delete_autores = "DELETE FROM precisa WHERE codigo_livro = '$codigo_livro'";
        mysqli_query($conexao, $sql_delete_autores);

        // Adiciona as novas associações de autores
        foreach ($autores as $autor_id) {
            $sql_livro_autor = "INSERT INTO precisa (codigo_livro, codigo_autor) VALUES ('$codigo_livro', '$autor_id')";
            mysqli_query($conexao, $sql_livro_autor);
        }

        // Redireciona para a página de produtos
        header('Location: produtos.php');
    } else {
        die("Erro ao atualizar: " . $sql . "<br>" . mysqli_error($conexao));
    }


}

;


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
                <h4>Alterar Produto</h4>
                <div class="col-md-12">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="titulo">Nome</label>
                                <input type="text" class="form-control" name="titulo" placeholder="Nome" maxlength="100"
                                    required value="<?php echo $linha['titulo'] ?>">
                            </div>
                            <div class=" cpf form-group col-md-4">
                                <label for="ano_publicacai">Ano Publicado</label>
                                <input type="date" id="ano_publicacao" class=" form-control" name="ano_publicacao"
                                    autocomplete="off" maxlength="10" value="<?php echo $linha['ano_publicacao'] ?>">
                            </div>
                            <div class="form-group col-md-12 ">
                                <label for="descricao">Sinopse</label>
                                <textarea name="descricao" id="descricao"
                                    class="form-control"><?php echo $linha['descricao']; ?></textarea>
                            </div>

                        </div>

                        <div class="row g-3">
                            <div class="col-md-12 mb-3">
                                <label for="imagem" class="form-label">Imagem <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="imagem" name="imagem"
                                    value="<?php echo $linha['imagem'] ?>" accept="image/*">
                            </div>
                            <input type="hidden" value="<?php echo ($linha['imagem']) ?>" name="imagem_inv">

                            <div class="col-md-4 mb-3 card">
                                <img src="../assets/img/<?php echo ($linha['imagem']) ?>" alt="Imagem do produto"
                                    id="img-inserida" class="img-fluid w-50 " style="margin: auto 0">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="qtde_estoque">Quantidade Estoque</label>
                                <input type="text" class="form-control" name="qtde_estoque" placeholder=""
                                    id="qtde_estoque" maxlength="" value="<?php echo $linha['qtde_estoque'] ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="preco_custo">Preço Custo</label>
                                <input type="text" class="form-control" name="preco_custo" id="preco_custo"
                                    placeholder="" maxlength="" value="<?php echo $linha['preco_custo'] ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="lucro">Lucro (%)</label>
                                <input type="text" class="form-control" name="lucro" id="lucro" placeholder=""
                                    maxlength="" value="<?php echo $linha['lucro'] ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="preco_venda">Preço Venda</label>
                                <input type="text" class="form-control" id="preco_venda" name="preco_venda"
                                    placeholder="" readonly value="<?php echo $linha['preco_venda'] ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="promocao">Promoção</label>
                                <select name="promocao" class="form-select form-control" id="promocao"
                                    oninput="togglePrecoPromocao()" required>
                                    <option value="1" <?php if ($linha['promocao'] == 1)
                                        echo "selected"; ?>>Sim</option>
                                    <option value="0" <?php if ($linha['promocao'] == 0)
                                        echo "selected"; ?>>Não</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="preco_promocao">Preço Promoção</label>
                                <input type="text" class="form-control" id="preco_promocao" name="preco_promocao"
                                    placeholder="" maxlength="" value="<?php echo $linha['preco_promocao'] ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="codigo_categoria">Categorias</label>
                                <select name="codigo_categoria" id="codigo_categoria" class="form-select form-control"
                                    required>
                                    <option value="">- Selecione -</option>
                                    <?php
                                    while ($linha_categoria = mysqli_fetch_assoc($resultado_categoria)) {
                                        $selected = ($linha_categoria['codigo_categoria'] == $linha['codigo_categoria']) ? "selected" : "";
                                        echo "<option value=\"{$linha_categoria['codigo_categoria']}\" $selected>{$linha_categoria['nome']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="codigo_editora">Editora</label>
                                <select name="codigo_editora" id="codigo_editora" class="form-select form-control"
                                    required>
                                    <option value="">- Selecione -</option>
                                    <?php
                                    while ($linha_editora = mysqli_fetch_assoc($resultado_editora)) {
                                        $selected = ($linha_editora['codigo_editora'] == $linha['codigo_editora']) ? "selected" : "";
                                        echo "<option value=\"{$linha_editora['codigo_editora']}\" $selected>{$linha_editora['nome']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="status">Status</label>
                                <select name="status" class="form-select form-control" required>
                                    <option value="1" <?php if ($linha['status'] == 1)
                                        echo "selected"; ?>>Ativo</option>
                                    <option value="0" <?php if ($linha['status'] == 0)
                                        echo "selected"; ?>>Inativo
                                    </option>
                                </select>

                            </div>


                            <div class="form-group col-md-4">
                                <label for="codigo_autor">Autores</label>
                                <select name="autores[]" id="codigo_autor" class="form-select form-control" multiple
                                    required>
                                    required>
                                    <?php
                                    while ($linha_autor = mysqli_fetch_assoc($resultado_autor)) {
                                        $selected = ($linha_autor['codigo_autor'] == $linha['codigo_autor']) ? "selected" : "";
                                        echo "<option value=\"{$linha_autor['codigo_autor']}\" $selected>{$linha_autor['nome']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <hr class="my-4">
                        <input type="hidden" name="alterar" value="altera_produto">
                        <input type="hidden" name="codigo_livro" value="<?php echo $codigo_livro ?>">
                        <input type="submit" class="btn btn-primary mt-4 w-100" value="Atualizar">
                    </form>
                </div>
            </main>
        </div>
    </div>


    <!-- CKEDITOR -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#descricao'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script type="text/javascript">
        $("#ano_publicacao").mask("0000/00/00");
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
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            togglePrecoPromocao(); // Chama ao carregar a página
        });
    </script>

</body>

</html>