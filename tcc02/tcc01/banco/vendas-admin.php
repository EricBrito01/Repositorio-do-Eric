<?php
function listarVendasId($conexao,$clienteid){
   
    $sql = "SELECT * FROM tb_venda join tb_carrinho on (tb_venda.tb_carrinho_id =  tb_carrinho.tb_carrinho_id)
    join tb_cliente on (tb_carrinho.tb_cliente_id =  tb_cliente.tb_cliente_id)
    join tb_produto on (tb_carrinho.tb_produto_id =  tb_produto.tb_produto_id)
    where tb_cliente.tb_cliente_id = 1
    order by tb_carrinho_ativo desc; ";
    
    $lista = array();

    $resultado = mysqli_query($conexao, $sql);

    while ($venda = mysqli_fetch_assoc($resultado)) {

        array_push($lista, $venda);
    }
    return $lista;

}

function listarVendas($conexao){
   
    $sql = "SELECT * FROM tb_venda join tb_carrinho on (tb_venda.tb_carrinho_id =  tb_carrinho.tb_carrinho_id)
    join tb_cliente on (tb_carrinho.tb_cliente_id =  tb_cliente.tb_cliente_id)
    join tb_produto on (tb_carrinho.tb_produto_id =  tb_produto.tb_produto_id)
    order by tb_carrinho_ativo desc;";
    
    $lista = array();

    $resultado = mysqli_query($conexao, $sql);

    while ($venda = mysqli_fetch_assoc($resultado)) {

        array_push($lista, $venda);
    }
    return $lista;

}

function CancelarVenda($conexao,$vendaid){
    $sql="delete from tb_venda where tb_venda_id = $vendaid";

    return mysqli_query($conexao, $sql);
}


function AprovarVenda($conexao,$carrinhoid){
    $sql="UPDATE tb_carrinho SET tb_carrinho_ativo=0  where tb_carrinho_id = $carrinhoid;";

    return mysqli_query($conexao, $sql);
}
function ContarVendas($conexao){
    $sql = "SELECT COUNT(*) FROM tb_venda inner join tb_carrinho on tb_carrinho.tb_carrinho_id = tb_venda.tb_carrinho_id  where tb_carrinho_ativo=2; ";

    $resultado = mysqli_query($conexao, $sql);
    $valor = mysqli_fetch_assoc($resultado);
    $valor = implode('',$valor);
    return $valor;
}


function PesquisarVenda($conexao,$tabela,$pesquisa) {

    $sql = "select * from tb_venda inner join tb_carrinho on tb_carrinho.tb_carrinho_id = tb_venda.tb_carrinho_id 
    join tb_cliente on (tb_carrinho.tb_cliente_id =  tb_cliente.tb_cliente_id)
    join tb_produto on (tb_carrinho.tb_produto_id =  tb_produto.tb_produto_id)
    where  $tabela like  '%$pesquisa%';" ;

    $lista = array();

    $resultado = mysqli_query($conexao, $sql);

    while ($venda = mysqli_fetch_assoc($resultado)) {

        array_push($lista, $venda);
    }
    return $lista;
}