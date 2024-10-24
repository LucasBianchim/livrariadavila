<?php

if(!isset($_SESSION)){
    session_start();
    
  }
require_once ('../conexao/conecta.php');

//BUSCANDO NO BANCO DE DADOS TABELA CARGO
$sql_cargo = "SELECT * FROM cargo WHERE status = 1";
$resultado_cargo = mysqli_query($conexao, $sql_cargo);

// BUSCANDO NO BANCO AS INFORMAÇÕES DO FUNCIONARIO SELECIONADA
if (isset($_GET['codigo_funcionario']) && $_GET['codigo_funcionario'] != '') {

    $codigo_funcionario = $_GET['codigo_funcionario'];

    $sql = "SELECT * FROM funcionario WHERE  codigo_funcionario = '$codigo_funcionario'";
    $resultado = mysqli_query($conexao, $sql);
    $linha = mysqli_fetch_assoc($resultado);
}

if (isset($_POST['alterar']) && $_POST['alterar'] == 'altera_funcionario') {
    $codigo_funcionario = $_POST['codigo_funcionario']; 
    $status = $_POST['status'];
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
    $tipo_acesso = $_POST['tipo_acesso'];
    $codigo_cargo = $_POST['codigo_cargo'];
    $salario = $_POST['salario'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $complemento = $_POST['complemento'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    $sql = "UPDATE funcionario SET
                status = $status,
                nome = '$nome',
                nome_social = '$nome_social',
                cpf = '$cpf',
                estado_civil = '$estado_civil',
                sexo = '$sexo',
                data_nascimento = '$data_nascimento',
                telefone_celular = '$telefone_celular',
                telefone_residencial = '$telefone_residencial',
                email = '$email',
                usuario = '$usuario',
                senha = '$senha',
                tipo_acesso = $tipo_acesso,
                codigo_cargo = $codigo_cargo,
                salario = '$salario',
                endereco = '$endereco',
                numero = '$numero',
                bairro = '$bairro',
                complemento = '$complemento',
                cep = '$cep',
                cidade = '$cidade',
                estado = '$estado'
            WHERE codigo_funcionario = $codigo_funcionario";

    if (mysqli_query($conexao, $sql)) {
        header('Location: funcionario.php');
        exit();
    } else {
        die("Erro ao atualizar: " . $sql . "<br>" . mysqli_error($conexao));
    }
}
?>




<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Construindo página de inserção de funcionários</title>
</head>

<body>
    <?php include ('topo.php') ?>

    <div class="container-fluid">
        <div class="row">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">
                        Painel Administrativo
                    </h1>
                </div>
                <h4>Novo Funcionário</h4>
                <div class="col-md-12">
                    <form action="" method="post">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" name="nome" placeholder="Nome" maxlength="40"
                                    value="<?php echo $linha['nome'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="nome_social">Nome Social</label>
                            <input type="text" class="form-control" name="nome_social" placeholder="Nome Social"
                                maxlength="40" value="<?php echo $linha['nome_social'] ?>">
                        </div>

                        <div class="row">
                            <div class=" cpf form-group col-md-4">
                                <label for="cpf">CPF</label>
                                <input type="text" id="cpf" class=" form-control" name="cpf" autocomplete="off"
                                    maxlength="14" value="<?php echo $linha['cpf'] ?>" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="estado_civil">Estado Civil</label>
                                <select name="estado_civil" class="form-select form-control" required>
                                    <option value="Solteiro" <?php if ($linha['estado_civil'] == 'Solteiro')
                                        echo "selected"; ?>>Solteiro</option>


                                    <option value="Casado" <?php if ($linha['estado_civil'] == 'Casado')
                                        echo "selected"; ?>>Casado</option>


                                    <option value="Divorciado" <?php if ($linha['estado_civil'] == 'Divorciado')
                                        echo "selected"; ?>>Divorciado</option>


                                    <option value="Viúvo" <?php if ($linha['estado_civil'] == 'Viúvo')
                                        echo "selected"; ?>>Viúvo</option>
                                    <option value="Separado" <?php if ($linha['estado_civil'] == 'Separado')
                                        echo "selected"; ?>>Separado</option>

                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="sexo">Sexo</label>
                                <select name="sexo" class="form-select form-control" required>


                                    <option value="1" <?php if ($linha['sexo'] == 1)
                                        echo "selected"; ?>>Feminino</option>


                                    <option value="0" <?php if ($linha['sexo'] == 0)
                                        echo "selected"; ?>>Masculino
                                    </option>

                                </select>
                            </div>

                            <div class=" cpf form-group col-md-4">
                                <label for="data_nascimento">Data Nascimento</label>
                                <input type="date" id="data_nascimento" class=" form-control" name="data_nascimento"
                                    autocomplete="off" maxlength="10" value="<?php echo $linha['data_nascimento'] ?>">

                            </div>

                            <div class="  form-group col-md-4">
                                <label for="telefone_celular">Celular</label>
                                <input type="text" id="telefone_celular" class=" form-control" name="telefone_celular"
                                    autocomplete="off" maxlength="14" value="<?php echo $linha['telefone_celular'] ?>">

                            </div>

                            <div class="  form-group col-md-4">
                                <label for="telefone_residencial">Tel. Residencial</label>
                                <input type="text" id="telefone_residencial" class=" form-control"
                                    name="telefone_residencial" autocomplete="off" maxlength="14"
                                    value="<?php echo $linha['telefone_residencial'] ?>">

                            </div>

                            <div class="form-group col-md-4">
                                <label for="email">E-mail</label>
                                <input type="text" class="form-control" name="email" placeholder="Email"
                                    value="<?php echo $linha['email'] ?>">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="usuario">Usuário</label>
                                <input type="text" class="form-control" name="usuario" placeholder="Usuário"
                                    maxlength="20" required value="<?php echo $linha['usuario'] ?>">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="senha">Senha</label>
                                <input type="text" class="form-control" name="senha" placeholder="Senha" maxlength="16"
                                    required value="<?php echo $linha['senha'] ?>">
                            </div>

                            <div class="form-group col-md-4 ">
                                <label for="tipo_acesso">Tipo Acesso</label>
                                <select name="tipo_acesso" class="form-select form-control" required>
                                    <option value="1" <?php if ($linha['tipo_acesso'] == 1)
                                        echo "selected"; ?>>
                                        Administrador</option>
                                    <option value="0" <?php if ($linha['tipo_acesso'] == 0)
                                        echo "selected"; ?>>Usuário
                                        Comum</option>
                                </select>
                            </div>


                            <div class="form-group col-md-4">
                                <label for="codigo_cargo">Cargo</label>
                                <select name="codigo_cargo" id="codigo_cargo" class="form-select form-control" required>
                                    <option value="">- Selecione -</option>
                                    <?php
                                    while ($linha_cargo = mysqli_fetch_assoc($resultado_cargo)) {
                                        $selected = ($linha_cargo['codigo_cargo'] == $linha['codigo_cargo']) ? "selected" : "";
                                        echo "<option value=\"{$linha_cargo['codigo_cargo']}\" $selected>{$linha_cargo['nome']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="salario">Salário</label>
                                <input type="text" class="form-control" name="salario" placeholder="Salário"
                                    maxlength="16" required value="<?php echo $linha['salario'] ?>">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="endereco">Endereço</label>
                                <input type="text" class="form-control" name="endereco" placeholder="Endereço"
                                    value="<?php echo $linha['endereco'] ?>" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="numero">Número</label>
                                <input type="text" class="form-control" name="numero" maxlength="5"
                                    value="<?php echo $linha['numero'] ?>" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="bairro">Bairro</label>
                                <input type="text" class="form-control" name="bairro"
                                    value="<?php echo $linha['bairro'] ?>" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="complemento">Complemento</label>
                                <input type="text" class="form-control" name="complemento"
                                    value="<?php echo $linha['complemento'] ?>">
                            </div>


                            <div class="  form-group col-md-4">
                                <label for="cep">CEP</label>
                                <input type="text" id="cep" class=" form-control" name="cep" autocomplete="off"
                                    maxlength="14" value="<?php echo $linha['cep'] ?>">


                            </div>

                            <div class="form-group col-md-4">
                                <label for="cidade">Cidade</label>
                                <input type="text" class="form-control" name="cidade"
                                    value="<?php echo $linha['cidade'] ?>" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="estado">Estado</label>
                                <select name="estado" class="form-select  form-control" required>


                                    <option value="AC" <?php if ($linha['estado'] == 'AC')
                                        echo "selected"; ?>>AC</option>
                                    <option value="AL" <?php if ($linha['estado'] == 'AL')
                                        echo "selected"; ?>>AL</option>
                                    <option value="AP" <?php if ($linha['estado'] == 'AP')
                                        echo "selected"; ?>>AP</option>


                                    <option value="AM" <?php if ($linha['estado'] == 'AM')
                                        echo "selected"; ?>>AM</option>


                                    <option value="BA" <?php if ($linha['estado'] == 'BA')
                                        echo "selected"; ?>>BA</option>


                                    <option value="CE" <?php if ($linha['estado'] == 'CE')
                                        echo "selected"; ?>>CE</option>


                                    <option value="DF" <?php if ($linha['estado'] == 'DF')
                                        echo "selected"; ?>>DF</option>
                                    <option value="ES" <?php if ($linha['estado'] == 'ES')
                                        echo "selected"; ?>>ES</option>
                                    <option value="GO" <?php if ($linha['estado'] == 'GO')
                                        echo "selected"; ?>>GO</option>
                                    <option value="MA" <?php if ($linha['estado'] == 'MA')
                                        echo "selected"; ?>>MA</option>
                                    <option value="MT" <?php if ($linha['estado'] == 'MT')
                                        echo "selected"; ?>>MT</option>
                                    <option value="MS" <?php if ($linha['estado'] == 'MS')
                                        echo "selected"; ?>>MS</option>
                                    <option value="MG" <?php if ($linha['estado'] == 'MG')
                                        echo "selected"; ?>>MG</option>


                                    <option value="PA" <?php if ($linha['estado'] == 'PA')
                                        echo "selected"; ?>>PA</option>
                                    <option value="PB" <?php if ($linha['estado'] == 'PB')
                                        echo "selected"; ?>>PB</option>


                                    <option value="PR" <?php if ($linha['estado'] == 'PR')
                                        echo "selected"; ?>>PR</option>
                                    <option value="PE" <?php if ($linha['estado'] == 'PE')
                                        echo "selected"; ?>>PE</option>
                                    <option value="PI" <?php if ($linha['estado'] == 'PI')
                                        echo "selected"; ?>>PI</option>
                                    <option value="RJ" <?php if ($linha['estado'] == 'RJ')
                                        echo "selected"; ?>>RJ</option>


                                    <option value="RN" <?php if ($linha['estado'] == 'RN')
                                        echo "selected"; ?>>RN</option>
                                    <option value="RS" <?php if ($linha['estado'] == 'RS')
                                        echo "selected"; ?>>RS</option>


                                    <option value="RO" <?php if ($linha['estado'] == 'RO')
                                        echo "selected"; ?>>RO</option>
                                    <option value="RR" <?php if ($linha['estado'] == 'RR')
                                        echo "selected"; ?>>RR</option>


                                    <option value="SC" <?php if ($linha['estado'] == 'SC')
                                        echo "selected"; ?>>SC</option>


                                    <option value="SP" <?php if ($linha['estado'] == 'SP')
                                        echo "selected"; ?>>SP</option>
                                    <option value="SE" <?php if ($linha['estado'] == 'SE')
                                        echo "selected"; ?>>SE</option>


                                    <option value="TO" <?php if ($linha['estado'] == 'TO')
                                        echo "selected"; ?>>TO</option>
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

                        </div>
                        <hr class="my-4">
                        <input type="hidden" name="alterar" value="altera_funcionario">
                        <input type="hidden" name="codigo_funcionario" value="<?php echo $codigo_funcionario ?>">
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
            .create(document.querySelector('#observacao'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <script type="text/javascript">
        $("#telefone_celular").mask("(00)00000-0000");
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <script type="text/javascript">
        $("#telefone_residencial").mask("(00)0000-0000");
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <script type="text/javascript">
        $("#cpf").mask("000.000.000-00");
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <script type="text/javascript">
        $("#cep").mask("00000-000");
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <!-- <script type="text/javascript">
        $("#data_nascimento").mask("0000/00/00");
    </script> -->
</body>

</html>