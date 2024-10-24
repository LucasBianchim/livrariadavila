<?php  

$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'livraria_vila';

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco) ;

if(mysqli_connect_errno())
{
    die('Falha na conexao ' .mysqli_connect_error());
}

?>