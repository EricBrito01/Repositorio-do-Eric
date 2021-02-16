<?php

include("../../banco/banco-carrinho.php");
include("../../banco/banco-usuario.php");
include("../../conexao.php");
include("../../banco/banco-produto.php");
session_start();
$idproduto = $_GET['idproduto'];
$clienteid = $_SESSION['nome'];
echo $idproduto;




if (deletarProduto($conexao, $idproduto, $clienteid))
{

    header('location:../Carrinho.php');
}
