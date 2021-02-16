<?php

function validaCPF($cpf) {
 
    // Extrair somente os números
    $cpf = preg_replace("/[^0-9]/", "", $cpf);

    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }
    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match("/(\d)\1{10}/", $cpf)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;

}
function cadastrarCliente($conexao, $nome, $endereco, $email, $senha, $cpf, $bairro, $cidade, $tel, $complemento)
{
    $cpf = preg_replace("/[^0-9]/", "", $cpf);
    
    $sql = "insert into tb_cliente(tb_cliente_nome,tb_cliente_endereco,tb_cliente_email,tb_cliente_senha,tb_cliente_cpf,tb_cliente_bairro,tb_cliente_cidade,tb_cliente_tel,tb_cliente_complemento)"
        . " values ('$nome','$endereco','$email','$senha',$cpf,'$bairro','$cidade','$tel','$complemento')";

    return mysqli_query($conexao, $sql);
}


function logarCliente($conexao, $email, $senha)
{

    $sql = "select * from tb_cliente where tb_cliente_email = '$email' and tb_cliente_senha= '$senha' limit 1";

    $resultado =  mysqli_query($conexao, $sql);

    return mysqli_fetch_assoc($resultado);
}

function listaridCliente($conexao, $email)
{

    $sql = "select * from tb_cliente where tb_cliente_email = '$email'";

    $lista = array();

    $resultado = mysqli_query($conexao, $sql);

    while ($cliente = mysqli_fetch_assoc($resultado)) {

        array_push($lista, $cliente);
    }
    return $lista;
}

function listarCliente($conexao)
{

    $sql = "select * from tb_cliente";

    $lista = array();

    $resultado = mysqli_query($conexao, $sql);

    while ($cliente = mysqli_fetch_assoc($resultado)) {

        array_push($lista, $cliente);
    }
    return $lista;
}

function listarClienteid($conexao, $clienteid)
{

    $sql = "select * from tb_cliente where tb_cliente_id =$clienteid ";

    $lista = array();

    $resultado = mysqli_query($conexao, $sql);

    while ($cliente = mysqli_fetch_assoc($resultado)) {

        array_push($lista, $cliente);
    }
    return $lista;
}

function PesquisarUsuario($conexao, $tabela, $pesquisa)
{

    $sql = "select * from tb_cliente where  $tabela like  '%$pesquisa%' ";

    $lista = array();

    $resultado = mysqli_query($conexao, $sql);

    while ($cliente = mysqli_fetch_assoc($resultado)) {

        array_push($lista, $cliente);
    }
    return $lista;
}

function listarClienteSession($conexao, $email)
{

    $sql = "select * from tb_cliente where tb_cliente_email = '$email'";

    $lista = array();

    $resultado = mysqli_query($conexao, $sql);

    while ($cliente = mysqli_fetch_assoc($resultado)) {

        array_push($lista, $cliente);
    }
    return $lista;
}

function alterarClienteEndereco($conexao, $clienteid, $endereco, $bairro, $cidade)
{
    $sql = "update tb_cliente set tb_cliente_endereco = '$endereco', tb_cliente_bairro = '$bairro', tb_cliente_cidade = '$cidade' where tb_cliente_id = $clienteid;";

    return mysqli_query($conexao, $sql);
}

function AlterarCliente($conexao, $nome, $endereco, $email, $senha, $cpf, $bairro, $cidade, $tel, $complemento,$clienteid)
{

    $sql = "update tb_cliente set tb_cliente_nome='$nome',tb_cliente_endereco='$endereco',tb_cliente_email='$email',tb_cliente_senha='$senha',tb_cliente_cpf='$cpf',tb_cliente_bairro='$bairro',tb_cliente_cidade='$cidade',tb_cliente_tel='$tel',tb_cliente_complemento='$complemento'where tb_cliente_id = $clienteid;";

    return mysqli_query($conexao, $sql);
}

function RecuperarSenha($conexao, $email, $cpf)
{

    $sql = "select * from tb_cliente where tb_cliente_email = '$email' and tb_cliente_cpf= '$cpf' limit 1";

    $resultado =  mysqli_query($conexao, $sql);

    return mysqli_fetch_assoc($resultado);
}

function MudarSenha($conexao,$clienteid,$senha){

    $sql = "update tb_cliente set tb_cliente_senha = '$senha' where tb_cliente_id = $clienteid";

    return mysqli_query($conexao, $sql);
}

