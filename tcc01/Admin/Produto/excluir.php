<?php
SESSION_start();
if (empty($_SESSION['loginADM']))
{
    header('location:../admin/Login-admin.php');
}
$produto_id = $_GET['idproduto'];
include ("./../../conexao.php");
include("../../banco/banco-produto.php");

if (excluirProduto($conexao, $produto_id))
{
    header('location:Listar-produto.php');
}
else{
    echo 'Este produto faz parte de um carrinho  !';
}