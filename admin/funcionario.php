<?php

if (!isset($_SESSION)) {
    session_start();

}
require_once('../conexao/conecta.php');


// Alterar a consulta para incluir nomes de cargo

$sql = " SELECT funcionario.codigo_funcionario ,funcionario.nome, funcionario.data_cadastro, cargo.nome'Cargo' , funcionario.usuario, funcionario.sexo, funcionario.tipo_acesso, funcionario.status FROM funcionario JOIN cargo ON funcionario.codigo_cargo = cargo.codigo_cargo ORDER BY funcionario.codigo_funcionario";

$resultado = mysqli_query($conexao, $sql);
$linha = mysqli_fetch_assoc($resultado);



?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Categorias</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />

</head>

<body>
    <?php
    #Início TOPO
    include('topo.php');
    #Final TOPO
    ?>

    <div class="container-fluid">
        <div class="row">

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2 text-primary">Painel Administrativo</h1>
                </div>

                <h4>Funcionários</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Data Cadastro</th>
                                <th scope="col">Cargo</th>
                                <th scope="col">Usuário</th>
                                <th scope="col">Sexo</th>
                                <th scope="col">Tipo Acesso</th>
                                <th scope="col">Status</th>
                                <th colspan="2" scope="col" class="text-center"><a href="funcionario_insere.php"
                                        class="btn btn-outline-light btn-sm"><i class="bi bi-plus"></i>Inserir</a></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php do { ?>

                                <tr>
                                    <td><?php echo $linha['codigo_funcionario'] ?></td>
                                    <td><?php echo $linha['nome'] ?></td>

                                    <?php
                                    $data = date_create($linha['data_cadastro']);
                                    echo '<td>' . date_format($data, 'd/m/Y') . '</td>'
                                        ?>
                                    <td><?php echo $linha['Cargo'] ?></td>
                                    <td><?php echo $linha['usuario'] ?></td>

                                    <td><?php if ($linha['sexo'] == 1) { ?>

                                            <div class="badge bg-danger text-white">Feminino</div>

                                        <?php } else { ?>

                                            <div class="badge bg-primary text-white">Masculino</div>
                                        <?php } ?>
                                    </td>


                                    <td><?php if ($linha['tipo_acesso'] == 1) { ?>

                                            <div class="badge bg-info text-white">Administrador</div>

                                        <?php } else { ?>

                                            <div class="badge bg-secondary text-white">Usuário Comum</div>
                                        <?php } ?>
                                    </td>

                                    <td><?php if ($linha['status'] == 1) { ?>

                                            <div class="badge bg-success text-white">Ativo</div>

                                        <?php } else { ?>

                                            <div class="badge bg-danger text-white">Inativo</div>
                                        <?php } ?>
                                    </td>



                                    <td class="text-end"><a
                                            href="funcionario_altera.php?codigo_funcionario=<?php echo $linha['codigo_funcionario'] ?>"
                                            class="btn btn-outline-warning btn-sm" title="Editar"><i
                                                class="bi bi-pencil"></i></a></td>
                                    <td class="text-start"><a
                                            href="funcionario_exclui.php?codigo_funcionario=<?php echo $linha['codigo_funcionario'] ?>"
                                            class="btn btn-outline-danger btn-sm" title="Excluir"><i
                                                class="bi bi-trash"></i></a></td>
                                </tr>

                            <?php } while ($linha = mysqli_fetch_assoc($resultado)) ?>


                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>

</html>