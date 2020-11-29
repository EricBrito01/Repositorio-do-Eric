<?php

function cadastrarCarrinho($conexao,$idproduto,$quantidade,$valorproduto,$clienteid){
    
    $valortotal = $quantidade * $valorproduto; 
   
    $sql  = "insert into tb_carrinho (tb_produto_id,tb_carrinho_quantidade,tb_carrinho_preco,tb_cliente_id,tb_carrinho_ativo) "
            . "values ($idproduto,$quantidade,$valortotal,$clienteid,1)";
    
    return mysqli_query($conexao, $sql);
    
}

function deletarProduto($conexao,$idproduto,$clienteid){
    
    $sql = "delete from tb_carrinho where tb_produto_id = $idproduto and tb_cliente_id = $clienteid";
    
    return mysqli_query($conexao, $sql);
}

function deletarCarrinho($conexao,$clienteid){
    
    $sql = "delete from tb_carrinho where tb_cliente_id= $clienteid";
    
    return mysqli_query($conexao, $sql);
}


function listarCarrinho($conexao,$clienteid){
    
    $sql = "select *  from tb_carrinho inner join tb_produto on tb_produto.tb_produto_id = tb_carrinho.tb_produto_id where tb_cliente_id = $clienteid and tb_carrinho_ativo=1;";
    
    $lista = array();

    $resultado = mysqli_query($conexao, $sql);

    while ($carrinho = mysqli_fetch_assoc($resultado))
    {

        array_push($lista, $carrinho);
    }
    return $lista;
}

function somarCarrinho($conexao,$clienteid){
    
    $sql = "select sum(tb_carrinho_preco) from tb_carrinho where tb_cliente_id  = $clienteid";
    
    $lista = array();
    
    $resultado = mysqli_query($conexao,$sql);
    
    while ($soma = mysqli_fetch_assoc($resultado)){
    array_push($lista, $soma);
    }
    
    return $lista;
}

function finalizarCarrinho($conexao,$total,$data,$clienteid,$carrinhoid){
    
    $sql = "insert tb_venda(tb_venda_total,tb_venda_data,tb_cliente_id,tb_carrinho_id) values($total,$clienteid,$data,$clienteid,$carrinhoid)";
    
    return mysqli_query($conexao, $sql);
  
}