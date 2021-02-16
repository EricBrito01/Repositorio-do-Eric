<?php

function cadastrarCarrinho($conexao, $idproduto, $quantidade, $valorproduto, $clienteid)
{

    $valortotal = $quantidade * $valorproduto;

    $sql  = "insert into tb_carrinho (tb_produto_id,tb_carrinho_quantidade,tb_carrinho_preco,tb_cliente_id,tb_carrinho_ativo) "
        . "values ($idproduto,$quantidade,$valortotal,$clienteid,1)";

    return mysqli_query($conexao, $sql);
}

function deletarProduto($conexao, $idproduto, $clienteid)
{

    $sql = "delete from tb_carrinho where tb_produto_id = $idproduto and tb_cliente_id = $clienteid and tb_carrinho_ativo = 1";

    return mysqli_query($conexao, $sql);
}

function deletarCarrinho($conexao, $clienteid)
{

    $sql = "delete from tb_carrinho where tb_cliente_id= $clienteid";

    return mysqli_query($conexao, $sql);
}


function listarCarrinho($conexao, $clienteid)
{

    $sql = "select *  from tb_carrinho inner join tb_produto on tb_produto.tb_produto_id = tb_carrinho.tb_produto_id
    inner join tb_imagens_prdt on tb_imagens_prdt.tb_imagens_prdt_id = tb_produto.tb_imagens_prdt_id
     where tb_cliente_id = $clienteid and tb_carrinho_ativo=1;";

    $lista = array();

    $resultado = mysqli_query($conexao, $sql);

    while ($carrinho = mysqli_fetch_assoc($resultado)) {

        array_push($lista, $carrinho);
    }
    return $lista;
}

function somarCarrinho($conexao, $clienteid)
{

    $sql = "select sum(tb_carrinho_preco) from tb_carrinho where tb_cliente_id  = $clienteid and tb_carrinho_ativo = 1";

    $lista = array();

    $resultado = mysqli_query($conexao, $sql);

    while ($soma = mysqli_fetch_assoc($resultado)) {
        array_push($lista, $soma);
    }

    return $lista;
}

function finalizarCarrinho($conexao, $data, $clienteid, $carrinhoid,$metodopag)
{

    $sql = "insert tb_venda(tb_venda_data,tb_cliente_id,tb_carrinho_id,tb_venda_metodopag) values('$data',$clienteid,$carrinhoid,$metodopag);";

    return mysqli_query($conexao, $sql);
}

function PagamentoPendente($conexao, $carrinhoid)
{
    $sql = "UPDATE tb_carrinho SET tb_carrinho_ativo=2 where tb_carrinho_id = $carrinhoid;";

    return mysqli_query($conexao, $sql);
}

function AtualizarQuantidadeCarrinho($conexao, $carrinhoid, $quantidade,$valorproduto)
{
    $sql = "UPDATE tb_carrinho SET tb_carrinho_quantidade=tb_carrinho_quantidade+$quantidade, tb_carrinho_preco = tb_carrinho_preco + ($valorproduto*$quantidade) where tb_carrinho_id = $carrinhoid; ";

    return mysqli_query($conexao, $sql);
}

function verificarCarrinho($conexao,$clienteid,$idproduto){
    $sql = "SELECT COUNT(*) FROM tb_carrinho WHERE tb_cliente_id= $clienteid and tb_carrinho_ativo=1 and tb_produto_id=$idproduto; ";

    $resultado = mysqli_query($conexao, $sql);
    $valor = mysqli_fetch_assoc($resultado);
    $valor = implode('',$valor);
    return $valor;
}

function DiminuirEstoque($conexao,$idproduto,$quantidade){
    $sql = "UPDATE tb_produto SET tb_produto_estoque=tb_produto_estoque - $quantidade where tb_produto_id= $idproduto ";

    return mysqli_query($conexao, $sql);
}

function AumentarEstoque($conexao,$idproduto,$quantidade){
    $sql = "UPDATE tb_produto SET tb_produto_estoque=tb_produto_estoque + $quantidade where tb_produto_id= $idproduto ";

    return mysqli_query($conexao, $sql);
}

function listarCarrinhoPendente($conexao, $idvenda)
{

    $sql = "select *  from tb_venda inner join tb_carrinho on tb_carrinho.tb_carrinho_id = tb_venda.tb_carrinho_id 
    join tb_produto on tb_produto.tb_produto_id = tb_carrinho.tb_produto_id 
    where tb_venda_id = $idvenda and tb_carrinho_ativo=2;";

    $lista = array();

    $resultado = mysqli_query($conexao, $sql);

    while ($carrinho = mysqli_fetch_assoc($resultado)) {

        array_push($lista, $carrinho);
    }
    return $lista;
}

function ContarCarrinho($conexao,$clienteid){
    $sql = "SELECT COUNT(*) FROM tb_carrinho where tb_carrinho_ativo=1 and tb_cliente_id=$clienteid; ";

    $resultado = mysqli_query($conexao, $sql);
    $valor = mysqli_fetch_assoc($resultado);
    $valor = implode('',$valor);
    return $valor;
}

function DeletarCarrinhoVenda($conexao,$carrinhoid){
    $sql="delete from tb_carrinho where tb_carrinho_id = $carrinhoid;";

    return mysqli_query($conexao, $sql);
}