<?php

function cadastrarAdmin($conexao, $nome_admin, $senha_admin)
{

    $sql = "insert into tb_admin (tb_admin_nome, tb_admin_senha)"
            . "values ('$nome_admin', '$senha_admin')";

    return mysqli_query($conexao, $sql);
}

function excluirAdmin($conexao, $admin_id)
{

    $sql = "delete from tb_admin where tb_admin_id = $admin_id ";

    return mysqli_query($conexao, $sql);
}

function alterarAdmin($conexao, $nome_admin, $senha_admin, $admin_id)
{
    //comando sql
    $sql = "update tb_admin set "
            . "tb_admin_nome = '$nome_admin',"
            . "tb_admin_senha = '$senha_admin'"
            . " where tb_admin_id = $admin_id";
    
    return mysqli_query($conexao, $sql);
}

function listarAdmins($conexao)
{

    $sql = "select * from tb_admin where tb_admin_id != 1 order by tb_admin_id desc";

    $lista = array();

    $resultado = mysqli_query($conexao, $sql);

    while ($admin = mysqli_fetch_assoc($resultado))
    {

        array_push($lista, $admin);
    }
    return $lista;
}

function listarIDadmin($conexao, $admin_id)
{

    $sql = "select * from tb_admin where tb_admin_id = $admin_id";

    $listaid = array();

    $resultado = mysqli_query($conexao, $sql);

    while ($admin = mysqli_fetch_assoc($resultado))
    {
        array_push($listaid, $admin);
    }
    return $listaid;
}

function login($conexao,$nome, $senha){
    
    $sql = "select * from tb_admin where tb_admin_nome = '$nome' and tb_admin_senha= '$senha' limit 1";
    
    $resultado=  mysqli_query($conexao,$sql);
      
    return mysqli_fetch_assoc($resultado);
}

function PesquisarAdmins($conexao,$tabela,$pesquisa) {

    $sql = "select * from tb_admin where  $tabela like  '%$pesquisa%' and tb_admin_id != 1 " ;

    $lista = array();

    $resultado = mysqli_query($conexao, $sql);

    while ($admin = mysqli_fetch_assoc($resultado)) {

        array_push($lista, $admin);
    }
    return $lista;
}

