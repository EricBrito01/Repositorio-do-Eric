<?php

function listarVendas($conexao){
   
    $sql = "SELECT * FROM tb_venda join tb_cliente on (tb_venda.tb_cliente_id = tb_cliente.tb_cliente_id) order by tb_venda_id desc";
    
    $lista = array();

    $resultado = mysqli_query($conexao, $sql);

    while ($venda = mysqli_fetch_assoc($resultado)) {

        array_push($lista, $venda);
    }
    return $lista;

}
