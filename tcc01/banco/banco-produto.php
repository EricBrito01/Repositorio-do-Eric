<?php

function cadastrarProduto($conexao, $produto_nome, $produto_qtd, $produto_preco, $fornecedor_id)
{      
    $sql = "Insert into tb_produto (tb_produto_nome, tb_produto_estoque, tb_produto_preco, tb_fornecedor_id) values ('$produto_nome', $produto_qtd, $produto_preco, $fornecedor_id)";

    return mysqli_query($conexao, $sql);
}

function listarProduto($conexao)
{

    $sql = "select *  from tb_produto inner join tb_fornecedor on tb_fornecedor.tb_fornecedor_id = tb_produto.tb_fornecedor_id order by tb_produto_id desc ";

    $lista = array();

    $resultado = mysqli_query($conexao, $sql);

    while ($produto = mysqli_fetch_assoc($resultado)) {

        array_push($lista, $produto);
    }
    return $lista;
}

function pesquisarProduto($conexao, $nome_produto)
{

    $sql = "select *  from tb_produto inner join tb_fornecedor
on tb_fornecedor.tb_fornecedor_id = tb_produto.tb_fornecedor_id
 where tb_produto_nome like  '%$nome_produto%'";

    $lista = array();

    $resultado = mysqli_query($conexao, $sql);

    while ($produto = mysqli_fetch_assoc($resultado)) {
        array_push($lista, $produto);
    }
    return $lista;
}

function listaridProduto($conexao, $idproduto)
{
    $sql = "select *  from tb_produto inner join tb_fornecedor 
on tb_fornecedor.tb_fornecedor_id = tb_produto.tb_fornecedor_id 
where tb_produto_id = $idproduto order by tb_produto_id desc";

    $lista = array();

    $resultado = mysqli_query($conexao, $sql);

    while ($produto = mysqli_fetch_assoc($resultado)) {
        array_push($lista, $produto);
    }
    return $lista;
}

function alterarProduto($conexao, $produto_nome, $idproduto, $produto_qtd, $produto_preco, $fornecedor_id)
{
    $sql = "update tb_produto set tb_produto_nome = '$produto_nome', tb_produto_estoque = $produto_qtd,
            tb_produto_preco = $produto_preco, tb_fornecedor_id = $fornecedor_id where tb_produto_id = $idproduto";

    return mysqli_query($conexao, $sql);
}

function excluirProduto($conexao, $produto_id)
{
    $sql = "Delete from tb_produto where tb_produto_id = $produto_id";
    return mysqli_query($conexao, $sql);
}

