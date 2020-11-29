<?php


function cadastrarCliente($conexao, $nome,$endereco,$email,$senha) {

    $sql = "insert into tb_cliente(tb_cliente_nome,tb_cliente_endereco,tb_cliente_email,tb_cliente_senha)"
            . " values ('$nome','$endereco','$email','$senha')";

    return mysqli_query($conexao, $sql);
}


function logarCliente($conexao,$email, $senha){
    
    $sql = "select * from tb_cliente where tb_cliente_email = '$email' and tb_cliente_senha= '$senha' limit 1";
    
    $resultado=  mysqli_query($conexao,$sql);
      
    return mysqli_fetch_assoc($resultado);
}

function listaridCliente($conexao,$email) {

    $sql = "select * from tb_cliente where tb_cliente_email = '$email'";

    $lista = array();

    $resultado = mysqli_query($conexao, $sql);

    while ($cliente = mysqli_fetch_assoc($resultado)) {

        array_push($lista, $cliente);
    }
    return $lista;
}

