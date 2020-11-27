<?php

include("./../../conexao.php");
include("../../banco/vendas-admin.php");
include("../../banco/banco-carrinho.php");

SESSION_start();
if (empty($_SESSION['loginADM'])) {
    header('location:.././admin/Login-admin.php');
}

$idvenda = $_GET['idvenda'];
echo $idvenda;

$lista = listarCarrinhoPendente($conexao, $idvenda);

foreach ($lista as $produto) {
    $quantidade = $produto['tb_carrinho_quantidade'];
    $idproduto = $produto['tb_produto_id'];
    $carrinhoid= $produto['tb_carrinho_id'];
} 
  
if (CancelarVenda($conexao, $idvenda)) {

    if(DeletarCarrinhoVenda($conexao,$carrinhoid)){
    echo $quantidade;
    AumentarEstoque($conexao, $idproduto, $quantidade);
    header('location:Listar-vendas.php');
    }
  
}
