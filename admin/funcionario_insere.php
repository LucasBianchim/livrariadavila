<?php

if(!isset($_SESSION)){
    session_start();
    
}
require_once('../conexao/conecta.php');

//BUSCANDO NO BANCO DE DADOS TABELA CARGO
$sql_cargo = "SELECT * FROM cargo WHERE status = 1";
$resultado_cargo = mysqli_query($conexao, $sql_cargo);



if (isset($_POST['inserir']) && $_POST['inserir'] == 'insere_funcionario') {
    // Obtenha os valores do formulário
    $status = $_POST['status'] == 'Ativo' ? 1:0;
    $nome = $_POST['nome'];
    $nome_social = $_POST['nome_social'];
    $cpf = $_POST['cpf'];
    $estado_civil = $_POST['estado_civil'];
    $sexo = $_POST['sexo'];
    $data_nascimento = $_POST['data_nascimento'];
    $telefone_celular = $_POST['telefone_celular'];
    $telefone_residencial = $_POST['telefone_residencial'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $tipo_acesso = $_POST['tipo_acesso'] == 'Administrador' ? 1:0;
    $codigo_cargo = $_POST['codigo_cargo'];
    $salario = $_POST['salario'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $complemento = $_POST['complemento'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    // Prepare a consulta SQL de inserção
    $sql = "INSERT INTO funcionario (data_cadastro, status, nome, nome_social, cpf, estado_civil, sexo, data_nascimento, telefone_celular, telefone_residencial, email, usuario, senha, tipo_acesso, codigo_cargo, salario, endereco, numero, bairro, complemento, cep, cidade, estado) VALUES (NOW(), $status, '$nome', '$nome_social', '$cpf', '$estado_civil', '$sexo', '$data_nascimento', '$telefone_celular', '$telefone_residencial', '$email', '$usuario', '$senha', $tipo_acesso, $codigo_cargo, '$salario', '$endereco', '$numero', '$bairro', '$complemento', '$cep', '$cidade', '$estado')";

    // Execute a consulta
    if (mysqli_query($conexao, $sql)) {
        header('Location: funcionario.php');
        exit();
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

    <!-- Início TOPO -->
    <?php include('topo.php'); ?>
    <!-- Fim TOPO -->

    <div class="container-fluid">
        <div class="row">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Painel Administrativo</h1>
                </div>
                <h4>Novo Funcionário</h4>
                <div class="col-md-12">
                    <form action="" method="post">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" name="nome" placeholder="Nome" maxlength="40" required>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="nome_social">Nome Social</label>
                            <input type="text" class="form-control" name="nome_social" placeholder="Nome Social" maxlength="40">
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="cpf">CPF</label>
                                <input type="text" id="cpf" class="form-control" name="cpf" autocomplete="off" maxlength="14" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="estado_civil">Estado Civil</label>
                                <select name="estado_civil" class="form-select form-control" required>
                                    <option selected>Solteiro</option>
                                    <option>Casado</option>
                                    <option>Divorciado</option>
                                    <option>Viúvo</option>
                                    <option>Separado</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="sexo">Sexo</label>
                                <select name="sexo" class="form-select form-control" required>
                                    <option value="1">F</option>
                                    <option value="0">M</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="data_nascimento">Data Nascimento</label>
                                <input type="date" id="data_nascimento" class="form-control" name="data_nascimento" autocomplete="off" maxlength="10">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="telefone_celular">Celular</label>
                                <input type="text" id="telefone_celular" class="form-control" name="telefone_celular" autocomplete="off" maxlength="14">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="telefone_residencial">Tel. Residencial</label>
                                <input type="text" id="telefone_residencial" class="form-control" name="telefone_residencial" autocomplete="off" maxlength="14">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" name="email" placeholder="Email">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="usuario">Usuário</label>
                                <input type="text" class="form-control" name="usuario" placeholder="Usuário" maxlength="20" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="senha">Senha</label>
                                <input type="password" class="form-control" name="senha" placeholder="Senha" maxlength="16" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="tipo_acesso">Tipo Acesso</label>
                                <select name="tipo_acesso" class="form-select form-control" required>
                                    <option value="1">Administrador</option>
                                    <option value="0">Usuário Comum</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="codigo_cargo">Cargo</label>
                                <select name="codigo_cargo" id="codigo_cargo" class="form-select form-control" required>
                                    <option value="">- Selecione -</option>
                                    <?php
                                    while ($linha_cargo = mysqli_fetch_assoc($resultado_cargo)) {
                                        echo "<option value=\"{$linha_cargo['codigo_cargo']}\">{$linha_cargo['nome']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="salario">Salário</label>
                                <input type="text" class="form-control" name="salario" placeholder="Salário" maxlength="16" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="endereco">Endereço</label>
                                <input type="text" class="form-control" name="endereco" placeholder="Endereço" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="numero">Número</label>
                                <input type="text" class="form-control" name="numero" maxlength="5" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="bairro">Bairro</label>
                                <input type="text" class="form-control" name="bairro" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="complemento">Complemento</label>
                                <input type="text" class="form-control" name="complemento">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="cep">CEP</label>
                                <input type="text" id="cep" class="form-control" name="cep" autocomplete="off" maxlength="14">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="cidade">Cidade</label>
                                <input type="text" class="form-control" name="cidade" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="estado">Estado</label>
                                <select name="estado" class="form-select form-control" required>
                                    <option>AC</option>
                                    <option>AL</option>
                                    <option>AP</option>
                                    <option>AM</option>
                                    <option>BA</option>
                                    <option>CE</option>
                                    <option>DF</option>
                                    <option>ES</option>
                                    <option>GO</option>
                                    <option>MA</option>
                                    <option>MT</option>
                                    <option>MS</option>
                                    <option>MG</option>
                                    <option>PA</option>
                                    <option>PB</option>
                                    <option>PR</option>
                                    <option>PE</option>
                                    <option>PI</option>
                                    <option>RJ</option>
                                    <option>RN</option>
                                    <option>RS</option>
                                    <option>RO</option>
                                    <option>RR</option>
                                    <option>SC</option>
                                    <option>SP</option>
                                    <option>SE</option>
                                    <option>TO</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="status">Status</label>
                                <select name="status" class="form-select form-control" required>
                                    <option selected>Ativo</option>
                                    <option value="0">Inativo</option>
                                </select>
                            </div>
                        </div>
                        <hr class="my-4">
                        <input type="hidden" name="inserir" value="insere_funcionario">
                        <input type="submit" class="btn btn-primary mt-4 w-100" value="Cadastrar">
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

    <!-- jQuery e jQuery Mask -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <!-- Máscaras de Entrada -->
    <script type="text/javascript">
        $("#telefone_celular").mask("(00) 00000-0000");
        $("#telefone_residencial").mask("(00) 0000-0000");
        $("#cpf").mask("000.000.000-00");
        $("#cep").mask("00000-000");
    </script>

</body>

</html>
